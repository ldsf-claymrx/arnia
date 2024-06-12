<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        $usuarios = User::all();
        return view('admin.usersys', [
            'usuarios' => $usuarios
        ]);
    }

    public function create(Request $request) {

        $requiredFields = ['name', 'lastname', 'email', 'password', 'position', 'active', 'sex', 'authorization_level'];

        if ($this->emptyDataValidation($request, $requiredFields)) {
            return "Some of the fields are empty!";
        }

        $Usuarios = new User;
        $Usuarios->name = $request->input('name');
        $Usuarios->lastname = $request->input('lastname');
        $Usuarios->email = $request->input('email');
        $Usuarios->password = Hash::make($request->input('password'));
        $Usuarios->position = $request->input('position');
        $Usuarios->active = $request->input('active');
        $Usuarios->sex = $request->input('sex');
        $Usuarios->authorization_level = $request->input('authorization_level');
        $Usuarios->save();
        return redirect()->back()->with('success', '¡Usuario Registrado con Exito!');
    }


    public function update(Request $request, $id){
        $Usuarios = User::find($id);

        $requiredFields = ['name', 'lastname', 'email', 'position', 'active', 'sex', 'authorization_level'];

        if ($this->emptyDataValidation($request, $requiredFields)) {
            return "Some of the fields are empty!";
        }

        $Usuarios->name = $request->input('name');
        $Usuarios->lastname = $request->input('lastname');
        $Usuarios->email = $request->input('email');
        $Usuarios->position = $request->input('position');
        $Usuarios->active = $request->input('active');
        $Usuarios->sex = $request->input('sex');
        $Usuarios->authorization_level = $request->input('authorization_level');
        
        $Usuarios->update();
        return redirect()->back()->with('success', '¡Informacion del Usuario Actualizado!');
    }


    public function destroy($id) {
        $Usuarios = User::find($id);
        $Usuarios->delete();
        return redirect()->back()->with('success', '¡Usuario Eliminado con Exito!');
    }

    /**
     * Metodo que verifica si algun
     * dato extraido de $_POST esta vacio
     * funcion emptyDataValidation() => validacion de datos vacios
     */

    public function emptyDataValidation($request, $requiredFields){
        foreach ($requiredFields as $fields) {
            if (empty(trim($request->input($fields)))) {
                return true;
            }
        }
        return false;
    }
}
