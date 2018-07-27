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
        $audios= Storage::allFiles('/'.$campana.'/');
        $userId = Auth::id();
        $campaigns_user = Campaign_User::all();
        $campaigns= Campaign::all();
        $campaign_selected='';
        return view('audio.index', compact('audios', 'campaigns_user', 'userId', 'campaigns', 'campaign_selected'));
    }


    //Función para descargar el archivo de la carpeta
    public function download( $campana, $file){
        $rootPath = '/home/cesar/Audios/'.$campana.'/';
        $client = Storage::createLocalDriver(['root' => $rootPath]);
//        Config::set('filesystems.disks', $client);
        return response()->download( $client->getDriver()->getAdapter()->applyPathPrefix($file));
    }
}
