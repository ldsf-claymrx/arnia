<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $usuarios = User::all();
        return view('admin.usersarnia', [
            'usuarios' => $usuarios
        ]);
    }

    public function create(Request $request) {
        $Usuarios = new User;
        $Usuarios->name = $request->input('name');
        $Usuarios->lastname = $request->input('lastname');
        $Usuarios->key_access = $request->input('key_access');
        $Usuarios->email = $request->input('email');
        $Usuarios->password = Hash::make($request->input('password'));

        $id_cargo = $request->input('position');
        $activo = $request->input('activo');
        $nivel = $request->input('authorization_level');

            

        if ($id_cargo == "") {
            return "Cargo";
        } else if($activo == "") {
            return "Activo";
        } else if($nivel == "") {
            return "Nivel";
        } else {

            $Usuarios->position = $id_cargo;
            $Usuarios->authorization_level = $nivel;

            $Usuarios->save();
            return redirect()->back();
        }
    }


    public function update(Request $request, $id){
        $Usuarios = User::find($id);

        $Usuarios->name = $request->input('name');
        $Usuarios->lastname = $request->input('lastname');
        $Usuarios->key_access = $request->input('key_access');
        $Usuarios->email = $request->input('email');
        $Usuarios->password = Hash::make($request->input('password'));

        $position = $request->input('position');
        $activo = $request->input('activo');
        $authorization_level = $request->input('authorization_level');
            

        if ($position == "") {
            return "Cargo";
        } else if($activo == "") {
            return "Activo";
        } else if($authorization_level == "") {
            return "Autorizacion";
        } else {
            $Usuarios->position = $position;
            $Usuarios->authorization_level = $authorization_level;
            $Usuarios->update();
            return redirect()->back();
        }
    }


    public function destroy($id) {
        $Usuarios = User::find($id);
        $Usuarios->delete();
        return redirect()->back();
    }
}
