<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;


class CodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $codeEmail;
    public function __construct($codeEmail)
    {
        $this->codeEmail = $codeEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $user =  User::where('email', $this->codeEmail )->first();
       
        $email = Crypt::decrypt($user->token_sistem);

        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
        ->view('mails.CodeEmail')
        ->subject('Se a activado la verificacion de 2fa')
        ->with(compact('email'));
    }
}
