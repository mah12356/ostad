<?php

namespace App\Http\Controllers;

use App\Models\Master;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    function skill(Request $request){
        $skills = array_unique(explode(',', $request->input('url')));
        $q=Master::query();
        foreach ($skills as $qs){
            $q->Where('skills','like','%'.$qs.'%');
        }
        $return=$q->get();
        return response()->json($return);
    }
    function masters(Request $request)
    {
        $query=Master::query();
        $explode=array_unique(explode(',', $request->input('url')));
        if($request->input('online') == null || !isset($request['online'])){
            $online = 23099234908;
        }else{
            $online = $request->input('online');
        }
        if(!isset($request['offline']) || $request->input('offline') === null){
            $offline = 3000;
        }else{
            $offline = $request->input('offline');
        }
        if($request->input('city') == null || !isset($request['city'])){
            foreach ($explode as $ex){
                $query->where('skills','like','%'.$ex.'%')
                    ->where('online_price','<=',$online)
                    ->where('offline_price','<=',$offline);
            }
        }else{
            foreach ($explode as $ex){
                $query->where('skills','like','%'.$ex.'%')
                    ->where('online_price','<=',$online)
                    ->where('offline_price','<=',$offline)
                    ->where(['city'=>$request->input('city')]);
            }
        }
        $return=$query->get();
        if(count($return) === 0){
            return response()->json(['massage'=>'استادی پیدا نشد']);
        }else{
            return response()->json($return);
        }
    }
}
