<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
   <form class="block" wire:submit="create">
       <select wire:model="selected_client_id">
           @if($clients)
               @foreach($clients as $client)
                   <option wire:key="{{$client->id}}" value="{{$client->id}}">
                       {{$client->name}}
                   </option>
               @endforeach
           @endif
       </select>
       <input wire:model="name" placeholder="Название">
       <input wire:model="description" placeholder="Описание">
       <button class="bg-white" type="submit" wire:loading.attr="disabled">Сохранить</button>
   </form>
</div>
