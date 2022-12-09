<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class IndexController extends Controller
{
    //index
    public function index(){

        if( Auth::check() ){
            return redirect()->route('dashboard');
        }

        return view('auth.index');
    }


    // userManuals
    public function userManuals(Request $request){

        //dd($request->all(), $request['name']);

        $path = public_path('/manuals/'.$request['name']);

        $infoPath = pathinfo($path);
        $extension = $infoPath['extension'];

        if($extension == 'pdf'){
            $file = file_get_contents($path);
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $base64 = base64_encode($file);
            return response()->json($base64);
        }

    }


    // auth_check
    public function auth_check(){
        if( Auth::check() ){
            return true;
        }
        return false;
    }
}
