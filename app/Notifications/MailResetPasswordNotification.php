<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\HtmlString;

class MailResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
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
		$html = '
<html>
<head>
</head>
<body>
<table width="635">
<tbody>
<tr>
<td>
<div><img src="https://dev.podcastsante.fr/assets/logo_podcast.499a4817.png" width="310" height="77" /></div>
<br /><br />
<div style="font-family: Arial,Helvetica,sans-serif; color: #415e81;">
<div>Bonjour '.$notifiable->name.',<br /><br /> Cet email vous a &eacute;t&eacute; envoy&eacute; suite &agrave; une demande de recouvrement de mot de passe . <br />R&eacute;initialisez votre mot de passe par le lien suivant:</div>
<div><br /><hr /><strong>Lien: </strong>  <a href="https://dev.podcastsante.fr/reset-password/'.$this->token.'">Réinitialiser le mot de passe</a> <br /> <br /><hr /></div>
<br /><br /> Votre nouveau&nbsp;mot de passe vous donnent acc&eacute;s au site <a href="https://dev.podcastsante.fr/">PODCAST SANTÉ</a> <br /><br />
<div align="right">L\'equipe Fr&eacute;quence Medicale &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br /></div>
</div>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
</body>
</html>';
        return (new MailMessage)
					->subject('Réinitialisation du mot de passe du PODCAST SANTÉ')
                    //->line('<img src="https://dev.podcastsante.fr/assets/logo_podcast.499a4817.png" width="250">')
                    //->action('Réinitialiser le mot de passe', 'https://dev.podcastsante.f/reset-password/'.$this->token)
                    ->line(new HtmlString($html));
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
