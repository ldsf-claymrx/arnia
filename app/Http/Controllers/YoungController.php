<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Young;

class YoungController extends Controller
{
    public function index() {
        $persons = Person::select('id', 'name', 'lastname', 'category', 'sex', 'phone_number')->whereIn('category', [3, 4])->get();
        return view('dashboard.youthassistance', [
            'persons' => $persons
        ]);
    }

    public function create(Request $request) {
        $Young = new Young;
        $Young->id_person = $request->input('id_person');
        $name = $request->input('name');
        $Young->date_assitance = date('Y-m-d');
        $Young->who_registered = $request->input('who_registered');
        $Young->save();
        return redirect()->back()->with('success', '¡La asistencia de '.$name.' ha sido confirmada!');
    }
}
