<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Auth;

class ClaveUnicaController extends Controller
{
    public function autenticar(Request $request)
    {
        /* Primer paso, redireccionar al login de clave única */
        $url_base       = "https://accounts.claveunica.gob.cl/openid/authorize/";
        $client_id      = env("CLAVEUNICA_CLIENT_ID");
        $redirect_uri   = urlencode(env("CLAVEUNICA_CALLBACK"));

        $state = csrf_token();
        $scope      = 'openid run name';

        $params     = '?client_id='.$client_id.
                      '&redirect_uri='.$redirect_uri.
                      '&scope='.$scope.
                      '&response_type=code'.
                      '&state='.$state;

        return redirect()->to($url_base.$params)->send();
    }

    public function callback(Request $request) {
        /* Segundo paso, el usuario ya se autentificó correctamente en CU y retornó a nuestro sistema */

        /* Recepcionamos los siguientes parametros desde CU */
        $code   = $request->input('code');
        $state  = $request->input('state'); 

        /* Acá deberías validar que el state que recibiste, sea el mismo que enviamos a Clave Única */
        // if($sate != csrf_token()) { die('el token enviado es distinto del recibido'); }
        
        $url_base       = "https://accounts.claveunica.gob.cl/openid/token/";
        $client_id      = env("CLAVEUNICA_CLIENT_ID");
        $client_secret  = env("CLAVEUNICA_SECRET_ID");
        $redirect_uri   = urlencode(env("CLAVEUNICA_CALLBACK"));

        $scope = 'openid+run+name';

        $response = Http::asForm()->post($url_base, [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri'  => $redirect_uri,
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'state'         => $state,
        ]);

       
        $access_token = json_decode($response)->access_token;

        /* Paso 3, obtener los datos del usuario en base al $access_token */
        $url_base = "https://www.claveunica.gob.cl/openid/userinfo/";
        $response = Http::withToken(json_decode($response)->access_token)->post($url_base);
        
        $userClaveUnica = json_decode($response);
        
        echo '<pre>';
        print_r($userClaveUnica);
        echo '</pre>';

        /* Acá debería almacenar el usuario y finalmente redireccionar a otra ruta */
        /* ejemplo:

        $user = new user();
        $user->lastName = $userClaveUnica['name']['apellidos'][0];
        $user....
        $user->save();

        // Iniciar sesión con ese usuario
        Auth::login($user, true);

        return redirect()->route('home');

        */



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

    public function logout() {
        /* Nos iremos al cerrar sesión en clave única y luego volvermos a nuestro sistema */
        if(env('APP_ENV') == 'local')
        {
            /* Si estamos desarrollando cerramos localmente no más */
            return redirect()->route('logout');
        }
        else
        {
            /* Url para cerrar sesión en clave única */
            $url_logout     = "https://accounts.claveunica.gob.cl/api/v1/accounts/app/logout?redirect=";
            /* Url para luego cerrar sesión en nuestro sisetema */
            $url_redirect   = "https://www.saludiquique.app/logout";
            $url            = $url_logout.urlencode($url_redirect);
        }        

        return redirect()->to($url)->send();
    }
}
