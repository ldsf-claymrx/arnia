<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Person;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        $persons_total = Person::count();
        $varones = Person::where('category', 1)->count();
        $mujeres = Person::where('category', 2)->count();
        $jovenes = Person::whereIn('category', [3, 4])->count();

        return view('dashboard.principal', [
            'persons_total' => $persons_total,
            'varones' => $varones,
            'mujeres' => $mujeres,
            'jovenes' => $jovenes
        ]);
    }

    public function showprofile() {
        return view('dashboard.profile');
    }

    public function updateMyInfo(Request $request) {

        $requiredFields = ['id', 'name', 'lastname', 'password', 'position', 'url'];

        if ($this->emptyDataValidation($request, $requiredFields)) {
            return response()->json([
                'title' => 'Falta de información',
                'text'  => 'Es necesario que todos los campos esten llenos.',
                'icon'  => 'info'
            ]);
        }

        $Usuarios = User::find($request->input('id'));
        $Usuarios->name = $request->input('name');
        $Usuarios->lastname = $request->input('lastname');
        $Usuarios->password = Hash::make($request->input('password'));
        $Usuarios->position = $request->input('position');
        
        $Usuarios->update();
        return response()->json([
            'title' => 'Actualización Exitosa',
            'text'  => 'El usuario: '.$request->input('name').' ha sido actualizado correctamente',
            'icon'  => 'success'
        ]);
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
