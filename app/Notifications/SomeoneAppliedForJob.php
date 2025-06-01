<?php

namespace App\Notifications;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class SomeoneAppliedForJob extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public jobApplication $jobApplication,
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->markdown('mail.someone-applied-for-job',
                [
                    'application' => $this->jobApplication,
                ])
            ->attach(
                storage_path('app/private/' . $this->jobApplication->cv_path)
            );
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'application_id' => $this->jobApplication->id,
            'created_at' => $this->jobApplication->created_at,
            'user_id' => $this->jobApplication->user_id,
            'job_id' => $this->jobApplication->job_id,
            'job_title' => $this->jobApplication->job->title,
            'user_name' => $this->jobApplication->user->name,
        ];
    }


}
