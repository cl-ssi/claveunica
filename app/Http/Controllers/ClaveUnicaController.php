<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClaveUnicaController extends Controller
{
    public function autenticar(){
        $url_base = "https://accounts.claveunica.gob.cl/accounts/login/?next=/openid/authorize";
        $client_id = env("CLAVEUNICA_CLIENT_ID");
        $redirect_uri = urlencode(env("CLAVEUNICA_CALLBACK"));
        $state = base64_encode(csrf_token().'/monitor/report');
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
            'state' => csrf_token(),
        ]);

        $url_base = "https://www.claveunica.gob.cl/openid/userinfo/";
        $response = Http::withToken(json_decode($response)->access_token)->post($url_base);

        $user_cu = json_decode($response);

        echo '<pre>';
        echo substr(base64_decode($state), 40);
        print_r($user_cu);
        echo '</pre>';
    }

}
