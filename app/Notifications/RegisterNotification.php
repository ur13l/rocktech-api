<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
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
                    ->subject('Bienvenido a Brain Race')
                    ->greeting('¡Gracias por tu registro!')
                    ->line('<img src="rocktech.mx/assets/img/brainrace.png">')
                    ->line('Has completado la primera etapa para la participación en Brain Race, de momento tu participación ha quedado registrada '
                        . 'y nosotros nos haremos cargo de informarte si tu idea cumple con los requerimientos para pasar a la siguiente etapa.')
                    ->line(' Si deseas verificar el estatus de tu idea, por favor, valida este correo dando click en el botón Activar cuenta, solo debes hacerlo una vez'
                        . ' y a partir de ese momento podrás entrar a rocktech.mx, iniciar sesión y ver en qué etapa se encuentra tu idea.')
                    ->action('Activa tu cuenta', env('APP_URL') ."activar/" . $this->user->verify_token)
                    ->line('Seguiremos en contacto, saludos');
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
