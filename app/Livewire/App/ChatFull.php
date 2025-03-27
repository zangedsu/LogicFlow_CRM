<?php

namespace App\Livewire\App;

use App\Events\NewTeamMessage;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatFull extends Component
{
    public $new_message_text = '';

    public $chat_list;

    public $selected_chat;

    public $selected_chat_messages;

    public $chat_search;

    public $team_contacts;

    public function sendMessage(): void
    {
        if ($this->selected_chat && $this->new_message_text) {

            ChatMessage::create([
                'sender_id' => Auth::id(),
                'chat_id' => $this->selected_chat->id,
                'message' => $this->new_message_text,
            ]);
            NewTeamMessage::dispatch(Auth::user()->currentTeam()->first()->id, $this->new_message_text, Auth::id(), $this->getChatName($this->selected_chat));
            $this->reset('new_message_text');
            $this->updateMessages();

        }

    }

    public function getListeners(): array
    {
        return [

            'echo-private:team.'.Auth::user()->currentTeam()->first()->id.',NewTeamMessage' => 'updateMessages',
            //            "echo-private:team.1,NewTeamMessage" => 'updateMessages',
        ];
    }

    public function selectChat($chat)
    {
        if ($chat == 'team') {
            $this->selected_chat = Chat::where('team_id', '=', Auth::user()->currentTeam()->first()->id)->first() ??
                Chat::create([
                    'team_id' => Auth::user()->currentTeam()->first()->id,
                    'chat_type' => 'team',
                ]);
        } else {
            $this->selected_chat = Chat::find($chat);
        }
        $this->markChatMessagesAsRead($this->selected_chat->id);
        $this->updateMessages();
    }

    public function selectChatFromSearch($type, $id = null): void
    {
        if ($id) {
            if ($type == 'private') {
                $chat = Auth::user()->chats()->where('chat_type', '=', 'private')->whereHas('members', function ($query) use ($id) {
                    $query->where('users.id', '=', $id);
                })->first();
                if (! $chat) {
                    $chat = Chat::create([
                        'chat_type' => 'private',
                    ]);
                    $chat->members()->attach([Auth::id(), $id]);
                }
                $this->selected_chat = $chat;
                $this->reset('chat_search');
                $this->updateMessages();
            }
            $this->updateChatList();
        }
    }

    public function markChatMessagesAsRead($chat_id)
    {
        $unreaded = ChatMessage::where('chat_id', '=', $chat_id)->whereDoesntHave('reads', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        foreach ($unreaded as $message) {
            // Проверяем, существует ли уже запись для данного пользователя и сообщения
            if (!$message->reads()->where('user_id', Auth::id())->exists()) {
                $message->reads()->attach(
                   Auth::id()
                );
            }
        }
    }




    //    #[On('echo:test,TestEvent')]

    public function updateMessages()
    {
        $this->selected_chat_messages = $this->selected_chat?->messages->sortByDesc('created_at');
        $this->markChatMessagesAsRead($this->selected_chat->id);

    }

    public function getChatName(Chat $chat)
    {
        return match ($chat->chat_type) {
            'team' => 'Чат команды '.Team::find($chat->team_id)->name,
            'group' => $chat->name ?? 'Групповой чат',
            'private' => $chat->members()->where('users.id', '!=', Auth::id())->first()->name,
            default => null,
        };
    }

    public function updateChatList()
    {
        $this->chat_list = Auth::user()->chats()->get();
        //        dd(Chat::first()->messages()->latest()->take(1)->first()->message);
    }

    public function unreadMessagesCount($chat_id) : int
    {
        return ChatMessage::where('chat_id', '=', $chat_id)->whereDoesntHave('reads', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();
    }

    public function render()
    {
        $this->team_contacts = Auth::user()->currentTeam()->first()->members()->where('name', 'like', '%'.$this->chat_search.'%')->get();
        $this->updateChatList();

        return view('livewire.app.chat-full');
    }
}
