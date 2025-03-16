<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    // Каналы уведомлений
    public function via($notifiable)
    {
        $channels = ['database', 'broadcast']; // База данных + вебсокеты
        if (!$notifiable->isOnline()) { // Проверяем, был ли пользователь в сети
            $channels[] = 'mail'; // Если оффлайн, отправляем письмо
        }
        return $channels;
    }

    // Уведомление для вебсокетов (Real-Time)
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'task_id' => $this->task->id,
            'message' => "Вы назначены ответственным за задачу: {$this->task->name}",
        ]);
    }

    // Уведомление в базу данных
    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'message' => "Вы назначены ответственным за задачу: {$this->task->title}",
        ];
    }

    // Уведомление по e-mail
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Вы назначены на задачу')
            ->line("Вам назначена новая задача: {$this->task->name}")
            ->action('Посмотреть задачу', url("/tasks/{$this->task->id}"));
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
