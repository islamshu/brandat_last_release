<?php

namespace App\Notifications\V3;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Follower;

class SellerFollow extends Notification
{
    use Queueable;
    public $follow;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Follow $follow)
    {
        $this->follow= $follow;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
      public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase()
    {
     return [
    'id'=>$this->follow->id,
    'title_ar'=>'لديك متابة جديدة',
    'title_en'=>'You have a new follow',
    'route_api'=>'',

    
];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

