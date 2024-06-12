<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Men;

class MenController extends Controller
{
    public function index() {
        $persons = Person::select('id', 'name', 'lastname', 'category', 'sex', 'phone_number')->where('category', 1)->get();
        return view('dashboard.menassistance', [
            'persons' => $persons
        ]);
    }

    public function create(Request $request) {
        $Men = new Men;
        $Men->id_person = $request->input('id_person');
        $name = $request->input('name');
        $Men->date_assitance = date('Y-m-d');
        $Men->who_registered = $request->input('who_registered');
        $Men->save();
        return redirect()->back()->with('success', '¡La asistencia de '.$name.' ha sido confirmada!');
    }
}
