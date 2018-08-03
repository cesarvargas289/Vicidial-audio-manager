<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Carbon\Carbon;
use Storage;
use Response;
use Yajra\Datatables\Datatables;
use App\Campaign_User;
use Illuminate\Support\Facades\Auth;
use App\Campaign;
use Config;
use Illuminate\Support\Facades\Input;
use App\User;

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
    public function indexGet()
    {
        $userId = Auth::id();
        $campaigns_user = Campaign_User::all();
        $campaigns= Campaign::all();

        $campaign_selected='';


        return view('audio.index', compact('campaigns_user', 'userId', 'campaigns', 'campaign_selected'));
    }

    public function indexPost(Request $request){
        $campana = $request->get('campaigns');
        $mes = $request->input('mes');
        $audios= Storage::allFiles('/'.$campana.'/'.$mes.'/');
        
        $userId = Auth::id();
        $campaigns_user = Campaign_User::all();
        $campaigns= Campaign::all();
        $campaign_selected='';
        return view('audio.index', compact('audios', 'campaigns_user', 'userId', 'campaigns', 'campaign_selected'));
    }


    //Función para descargar el archivo de la carpeta
    public function download( $campana, $mes, $file){
        $rootPath = '/home/cesar/Audios/'.$campana.'/'.$mes.'/';
        $client = Storage::createLocalDriver(['root' => $rootPath]);
//        Config::set('filesystems.disks', $client);
        return response()->download( $client->getDriver()->getAdapter()->applyPathPrefix($file));
    }

    public function meses(Request $request){

        $campana = Input::get('campaigns');
        $lista_meses= Storage::alldirectories('/'.$campana.'/');
        $array= (array) $lista_meses;
        $array2 = array();
        foreach($array as $mes){

            $mes_actualizado = explode($campana."/", $mes);
          //  $array[$mes] = $mes_actualizado;
            $prueba = implode('', $mes_actualizado);
            $array2[]= $prueba;
        }
        return Response::json($array2);
    }



}
