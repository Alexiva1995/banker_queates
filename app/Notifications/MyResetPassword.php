<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class MyResetPassword extends Notification
{
    use Queueable;

    public $token;
    public $email;
  
  

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email )
    {
      
        $this->token = $token;
        $this->email = $email;
    
        
        
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('Recuperar contraseña')
        ->view('mails.resetPass', ['logo' => public_path('/images') . '/login/connect.png'])
        ->line('Hola!')
        ->greeting('¿Una nueva Contraseña?')
        ->line('No hay problema, crea una nueva contraseña y continua disfrutando de nuestro servicio')
        ->action('Recuperar contraseña', route('password.reset',['token' => $this->token,'m' => base64_encode($this->email)]))
        ->line('Si no solicitaste el cambio de contraseña, continuara siendo la misma.')
        ->line('¿Tienes problema para acceder?.')
        ->salutation('Escribenos a soporte@connect.com');

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

        ];
    }
}
