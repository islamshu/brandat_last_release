<?php

namespace App\Notifications\V3;

use App\Models\V3\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;


class FolloweProduct extends Notification
{
    use Queueable;
    public $product;
    public $user;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Product $product,User $user)
    {
        
        $this->product= $product;
        $this->user = $user;
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
    'id'=>$this->product->id,
    'title_ar'=>'لقد قام التاجر'. $this->user->name .'بادراج منتج جديد',
    'title_ar'=>'the seller'. $this->user->name .'upload new product',
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

