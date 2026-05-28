<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;


class VerificationEmailController extends Controller
{
    // Envia o e-mail de verificação
    public function resend(Request $request)
    {

        $user = $request->user();

            if ($user->hasVerifiedEmail()) {
                return response()->json(['message' => 'E-mail já verificado.'], 400);
            }



            //enviar email de verificação de conta.
            //$user->sendEmailVerificationNotification();

            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                now()->addMinutes(60),
                [
                    'id'    => $user->id,
                    'hash'  => sha1($user->email),
                ]
            );


            Mail::raw('Olá, este é um e-mail de texto puro enviado pelo Laravel 13. '.$verificationUrl , function ($message) {
                $message->to('wconsistemas@gmail.com')
                        ->subject('Teste de Texto Puro');
            });




            return response()->json(['message' => 'E-mail de verificação enviado.'], 200);
        }

    // Verifica o token (geralmente acessado via link, mas pode ser chamado via POST para APIs SPA)
    public function verify(Request $request)
    {


        $user = User::whereId($request->id)->first();

        if ($user->hasVerifiedEmail()) {

            return redirect('/verify'); // Redireciona para página após o sucesso

            //return para API json
            return response()->json(['message' => 'E-mail já verificado.'], 400);
        }

        $user->markEmailAsVerified();


         return redirect('/verifysend'); // Redireciona para página após o sucesso
        //return para API json
        //return response()->json(['message' => 'E-mail verificado com sucesso.'], 200);
    }
}
