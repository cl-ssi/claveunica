<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;

class ClaveUnicaController extends Controller
{
    public function autenticar(Request $request){
        /* Primer paso, redireccionar al login de clave única */
        //$redirect = '../monitor/lab/login';
        $redirect = $request->input('redirect');
        //die($redirect);

        $url_base = "https://accounts.claveunica.gob.cl/accounts/login/?next=/openid/authorize";
        $client_id = env("CLAVEUNICA_CLIENT_ID");
        $redirect_uri = urlencode(env("CLAVEUNICA_CALLBACK"));
        $state = base64_encode(csrf_token().$redirect);
        $scope = 'openid+run+name+email';

        $url=$url_base.urlencode('?client_id='.$client_id.'&redirect_uri='.$redirect_uri.'&scope='.$scope.'&response_type=code&state='.$state);

        return redirect()->to($url)->send();
    }

    public function callback(Request $request) {
        $code = $request->input('code');
        $state = $request->input('state'); // token

        $url_base = "https://accounts.claveunica.gob.cl/openid/token/";
        $client_id = env("CLAVEUNICA_CLIENT_ID");
        $client_secret = env("CLAVEUNICA_SECRET_ID");
        $redirect_uri = urlencode(env("CLAVEUNICA_CALLBACK"));
        //$state = csrf_token();
        $scope = 'openid+run+name+email';

        $response = Http::asForm()->post($url_base, [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'state' => $state,
        ]);

        /* Paso especial de SSI */
        /* Obtengo la url del sistema al que voy a redireccionar el login true */
        $redirect     = base64_decode(substr(base64_decode($state), 40));
        $access_token = json_decode($response)->access_token;

        $url_redirect = env('APP_URL').$redirect.'/'.$access_token;

        //die($url_redirect);

        return redirect()->to($url_redirect)->send();

        // $redirect = substr(base64_decode($state), 40).'/'.json_decode($response)->access_token;
        //
        // return redirect()->to($redirect)->send();

        // $url_base = "https://www.claveunica.gob.cl/openid/userinfo/";
        // $response = Http::withToken(json_decode($response)->access_token)->post($url_base);
        //
        // $user_cu = json_decode($response);
        //
        // $user = new User();
        // $user->id = $user_cu->RolUnico->numero;
        // $user->dv = $user_cu->RolUnico->DV;
        // $user->name = implode(' ', $user_cu->name->nombres);
        // $user->fathers_family = $user_cu->name->apellidos[0];
        // $user->mothers_family = $user_cu->name->apellidos[1];
        // $user->email = $user_cu->email;
        //
        // echo '<pre>';
        // print_r($user);
        // echo '</pre>';


/*
[RolUnico] => stdClass Object
    (
        [DV] => 4
        [numero] => 44444444
        [tipo] => RUN
    )

[sub] => 2594
[name] => stdClass Object
    (
        [apellidos] => Array
            (
                [0] => Del rio
                [1] => Gonzalez
            )

        [nombres] => Array
            (
                [0] => Maria
                [1] => Carmen
                [2] => De los angeles
            )

    )

[email] => mcdla@mail.com

*/



    }
}
