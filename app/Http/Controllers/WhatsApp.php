<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class WhatsApp extends Controller
{
    public function verifyToken(Request $request){
        //return response()->json(["msj"=>"Verificando el token"]);
        $token = 'EAAOUp21BcMwBO3sOqw1PGmrjXiQcQWDKZCN1o0JuT0de1VSZCre5ZB2HHrjtK9BZAY9JWBurr0cGYaB9Gfh31TIIJmG5fqypCVXiLD2dvGzJZBfb2oIEiki7ZACKYKkOdHYE0ieeHLNJtx6g8xqEv4SqfgWkWpZAPt4yi0eiELRf7B9FYgalqgyRZBwK9FkXOO9y4Lt3StHIX1mQVVIhyjoXfBs05WLYZBSQXsmNqGsYZD';
        $telefono = '528341147395';
        $url = 'https://graph.facebook.com/v17.0/131022730088864/messages';

        //CONFIGURACION DEL MENSAJE
        $mensaje = ''
        . '{'
        . '"messaging_product": "whatsapp", '
        . '"to": "'.$telefono.'", '
        . '"text": '
        . '{'
        . '     "preview_url": true,'
        . '     "body":"Porvafor verifica está url Samuel https://youtu.be/hpltvTEiRrY va a inspirar tu día!" '
        . '} '
        . '}';
        
        
        //DECLARAMOS LAS CABECERAS
        $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
        //INICIAMOS EL CURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
        $response = json_decode(curl_exec($curl), true);
        //IMPRIMIMOS LA RESPUESTA 
        //print_r($response);
        //OBTENEMOS EL CODIGO DE LA RESPUESTA
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        //CERRAMOS EL CURL
        curl_close($curl);
        return back();
    }

    public function ReceivedMessge(Request $request){
        return response()->json(["msj"=>"Recibe mensaje"]);
    }

    public function sendMessage(Request $request){
        return response()->json(["msj"=>"Recibe mensaje"]);
    }
}
