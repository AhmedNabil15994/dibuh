<?php

namespace App\Services;


use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use App\Repositories\ActivationRepository;
use App\Models\User;

class ActivationService
{

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
        /*$message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);
        $this->mailer->raw($message, function (Message $m) use ($user) {
            $m->to($user->email)->subject('Activation mail');
        });*/

        $type = 2;
        $email12 = \DB::table('email_templates')->where('id','=',$type)->first();
        $phrase = $email12->subject;
        $link = route('user.activate', $token);
        $data = [
            'no-reply' => 'admin@dibuh.com',
            'name'     => 'Dibuh',
            'subject'    => $phrase,
            'link'       => $link,
            'Email'    => $user->email,
        ];
      
        \Mail::send('emails.mail2', ['data' => $data,'type'=>$type],
            function ($message) use ($data)
            {
                $message
                    ->from($data['no-reply'],$data['name'])
                    ->to($data['Email'])->subject($data['subject']);
            });

        


    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->is_activated = 1;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}