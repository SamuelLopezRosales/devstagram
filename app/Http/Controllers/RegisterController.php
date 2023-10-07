<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    //
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request){

        $request->request->add(['username'=>Str::slug($request->username)]);

        $this->validate($request,[
            'name'=> 'required|max:30',
            'username'=> 'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6'
          ]);

          // gyardar usuario 
          User::create([
            'name'=>$request->name,
            'username'=> $request->username,
            'email'=>$request->email,
            'password'=>$request->password
          ]);

          // autenticar usuario 
          /*auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password
          ]);*/

          auth()->attempt($request->only('email','password'));

          return redirect()->route('posts.index');

    }

    public function prueba(Request $request){
        return response()->json(["msj"=>"Registros cargados correctamente"]);
    }

}
