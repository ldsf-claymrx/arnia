<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Woman;

class WomanController extends Controller
{
    public function index() {
        $persons = Person::select('id', 'name', 'lastname', 'category', 'sex', 'phone_number')->where('category', 2)->get();
        return view('dashboard.womanassistance', [
            'persons' => $persons
        ]);
    }

    public function create(Request $request) {
        $Woman = new Woman;
        $Woman->id_person = $request->input('id_person');
        $name = $request->input('name');
        $Woman->date_assitance = date('Y-m-d');
        $Woman->who_registered = $request->input('who_registered');
        $Woman->save();
        return redirect()->back()->with('success', '¡La asistencia de '.$name.' ha sido confirmada!');
    }
}
