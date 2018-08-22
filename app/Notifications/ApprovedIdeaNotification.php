<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;

class ApprovedIdeaNotification extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->date = Carbon::now()->addDays(12);
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
            ->subject('Seguimiento Brain Race')
            ->greeting('Saludos')
            ->line('<img src="https://www.rocktech.mx/assets/img/brainrace.png">')
            ->line('La idea de tu neurona ha concluido la primera vuelta con éxito, es momento de pasar por los pits para revisar detalles antes de continuar.')
            ->line('El siguiente paso es iniciar sesión en rocktech.mx/accede para completar el siguiente formulario de participación. La fecha límite es el ' . $this->date->format('d/m/Y') . '.')
            ->line('De ser considerados entre finalistas, tengan listo su pasaporte, el traslado corre por nuestra cuenta. ')
            ->action('Iniciar sesión', env('APP_URL') ."accede")
            ->line('Seguimos en contacto.');
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
