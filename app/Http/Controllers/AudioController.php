<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Config;
use Storage;
use Response;
use App\User;
use App\Campaign;
use App\Campaign_User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AudioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Función para enviar la lista de campañas a la vista
    public function indexGet()
    {
        $userId = Auth::id();
        $campaigns_user = Campaign_User::all();
        //Se obtienen todas las campañas y se guardan en la variable Campañas
        $campaigns= Campaign::all();
        $campaign_selected='';
        return view('audio.index', compact('campaigns_user', 'userId', 'campaigns', 'campaign_selected'));
    }

    //Función para mostrar la lista de audios existente
    public function indexPost(Request $request){
        //Se lee la campaña seleccionada por el usuario
        $campana = $request->get('campaigns');
        //Se asigna a una variable mes, el mes introducido por el usuario
        $mes = $request->input('mes');
        //Se obtienen los audios que existen en la carpeta usando las variables como ruta
        $audios= Storage::allFiles('/'.$campana.'/'.$mes.'/');
        $audios_datatables = Datatables::of($audios);
        $userId = Auth::id();
        $campaigns_user = Campaign_User::all();
        $campaigns= Campaign::all();
        $campaign_selected='';
        return view('audio.index', compact('audios', 'campaigns_user', 'userId', 'campaigns', 'campaign_selected', 'audios_datatables'));
    }

    //Función para descargar el archivo de la carpeta, recibe como argumentos la campaña, el mes y el archivo a descargar
    public function download( $campana, $mes, $file){
        //obtiene la ruta de los archivos por mes seleccionado por el usuario
        $rootPath = '/var/spool/asterisk/monitorDONE/MP3/'.$campana.'/'.$mes.'/';
        $client = Storage::createLocalDriver(['root' => $rootPath]);
//        Config::set('filesystems.disks', $client);
        //La función retorna el archivo seleccionado
        return response()->download( $client->getDriver()->getAdapter()->applyPathPrefix($file));
    }

    //Funcion para mostrar todos los meses en segundo dropdown
    public function meses(){
        //Se guarda en variable la campaña seleccionada por el usuario
        $campana = Input::get('campaigns');
        //Se hace un listado de todas las carpetas que tiene la campaña
        $lista_meses= Storage::alldirectories('/'.$campana.'/');
        //Se hace un cast de la lista a un arreglo
        $array= (array) $lista_meses;
        $array2 = array();
        
        foreach($array as $mes){
            $mes_actualizado = explode($campana."/", $mes);
            $prueba = implode('', $mes_actualizado);
            $array2[]= $prueba;
        }
        return Response::json($array2);
    }



}
