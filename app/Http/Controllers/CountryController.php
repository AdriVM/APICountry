<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    // Función para la búsqueda de países según lo recibido en la URL con el parámetro "q"
    public function search(Request $request)
    {
        /**
         * NOTA: Puede causarse el error  CURL ERROR (60) que indica un problema con el certificado SSL
         * 1.- 'phpinfo();' para ver la información de PHP
         * 2.- Buscamos el apartado 'Loaded Configuration File' que nos indica donde se encuentra nuestro 'php.ini' (NUNCA TOCAR NADA DE VENDOR)
         * 3.- En el archivo 'php.ini' buscaremos: ;curl.cainfo
         * 4.- Descargamos el archivo  'http://curl.haxx.se/ca/cacert.pem'
         * 5.- Descomentamos curl.cainfo y ponemos la ruta donde guardemos el archivo descargado, por ejemplo: curl.cainfo = "C:\wamp64\bin\php\php7.1.9\cacert.pem"
         * 6.- Reiniciamos el servidor y ya estaría solucionado.
         */

        // Hacemos la llamada a https://restcountries.eu/rest/v2/name/ pasando el valor 'q' recibido por la url.
        $response = Http::get('https://restcountries.eu/rest/v2/name/' . $request['q']);


        // Formateamos la respuesta recibida en un json.
        $countries = $response->json();

        // Devolvemos el json con los paises que se ajustan a nuestra búsqueda al front.
        return response()->json($countries);
    }

    // Función que recibe los codigos de país que hacen frontera y devuelve los objetos de dichos paises.
    public function border(Request $request)
    {

        // Formateamos los códigos recibidos para que encajen con el formato de la búsqueda.
        $codigos = str_replace('"', '', $request['codes']);
        $codigos = str_replace(',', ';', $codigos);

        // Hacemos la llamada a https://restcountries.eu/rest/v2/alpha?codes= pasando nuestros códigos formateados.
        $response = Http::get('https://restcountries.eu/rest/v2/alpha?codes=' . $codigos);

        // Formateamos la respuesta recibida en un json.
        $countries = $response->json();

        // Devolvemos el json con los paises que hacen frontera al front.
        return response()->json($countries);
    }
}