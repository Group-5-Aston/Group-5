<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public $productOption;
    /**
     * Create a new notification instance.
     */
    public function __construct($productOption)
    {
        $this -> productOption = $productOption;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'subject' => "Product low in stock",
            'message' => "{$this->productOption->product->name}" .
                (!empty($this->productOption->size) ? ", size '{$this->productOption->size}'" : '') .
                (!empty($this->productOption->flavor) ? ", flavour '{$this->productOption->flavor}'" : '') .
                " is low in stock, please restock.",
            'url' => route('adminproduct.show', $this->productOption->product),
            ];
    }
}
