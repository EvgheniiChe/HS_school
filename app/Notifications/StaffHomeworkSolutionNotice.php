<?php

namespace App\Notifications;

use App\Models\HomeworkSolution;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StaffHomeworkSolutionNotice extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly HomeworkSolution $homeworkSolution,
        private readonly User $student,
    )
    {
        $this->queue = config('app.notifications_queue');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("{$this->homeworkSolution->homework->lesson->course->type}, домашнее задание")
            ->line("Студент {$this->student->name}, тема {$this->homeworkSolution->theme}, что же он там написал?");
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
