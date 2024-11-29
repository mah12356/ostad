<?php

namespace App\Http\Controllers;
use App\Models\Master;
use App\Models\User;
use Illuminate\Http\Request;
class AuthControllers extends Controller
{
    public function signup(Request $request)
    {
        $user=User::where(['phone'=>$request->input('phone')])->first();
        if($user != null){
            $user->toArray();
            return response()->json(['massage'=>$user['phone'].'در سایت وجود دارد']);
        }else{
            $file=$request->file('image');
            $file->move(public_path('images'),$file->getClientOriginalName());
            $model=new User();
            $model->phone=$request->input('phone');
            $model->image=$file->getClientOriginalName();
            $model->save();
            return response()->json(['phone'=>$request->input('phone')]);
        }
    }
    public function login(Request $request){
        $user=User::where(['phone'=>$request->input('phone')])->first();
        if($user->exists()){
            $user->toArray();
            return response()->json(['user'=>$user]);
        }else{
            return response()->json(['user'=>null]);
        }
    }
    public function userrequest(Request $request){
        $master=Master::find($request->input('masterinfo'))->toArray();
        $user=User::find($request->input('userinfo'));
        $user->free=$master['user_id'];
        $user->save();
        return response()->json(['masters'=>$master,'user'=>$user]);
    }
    public function neg(Request $request){
        $user=User::find($request->input('updateagainuser'));
        $user->free=0;
        $user->save();
        return response()->json(['user'=>$user->toArray()]);
    }
}
