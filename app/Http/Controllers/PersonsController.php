<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonsController extends Controller
{
    public function index() {
        $persons = Person::all();
        return view('dashboard.persons', [
            'persons' => $persons
        ]);
    }

    public function create(Request $request) {
        try {
            $Person = new Person;
            $Person->name = ucwords(strtolower($request->input('name')));
            $Person->lastname = ucwords(strtolower($request->input('lastname')));
            $Person->birthdate = $request->input('birthdate');
            $Person->category = $request->input('category');
            $Person->sex = $request->input('sex');
            $Person->civil_status = $request->input('civil_status');
            $Person->address = $request->input('address');
            $Person->phone_number = $request->input('phone_number');
            $Person->facebook = $request->input('facebook');
            $Person->email = $request->input('email');
            $Person->media = $request->input('media');
            $Person->personal_invitation = $request->input('personal_invitation');
            $Person->do_you_congregate = $request->input('do_you_congregate');
            $Person->reminders = $request->input('reminders');
            $Person->who_registered = $request->input('who_registered'); 
            $Person->date_register = date('Y-m-d');
            $Person->save();
            return redirect()->back();
            
        } catch (\Throwable $th) {
            return 'Paso un error';
        }
    }


    public function update(Request $request, $id){
        try {
            $Person = Person::find($id);
            $Person->name = ucwords(strtolower($request->input('name')));
            $Person->lastname = ucwords(strtolower($request->input('lastname')));
            $Person->birthdate = $request->input('birthdate');
            $Person->category = $request->input('category');
            $Person->sex = $request->input('sex');
            $Person->civil_status = $request->input('civil_status');
            $Person->address = $request->input('address');
            $Person->phone_number = $request->input('phone_number');
            $Person->facebook = $request->input('facebook');
            $Person->email = $request->input('email');
            $Person->media = $request->input('media');
            $Person->personal_invitation = $request->input('personal_invitation');
            $Person->do_you_congregate = $request->input('do_you_congregate');
            $Person->reminders = $request->input('reminders');
            $Person->update();
            return redirect()->back();

        } catch (\Throwable $th) {
            return 'Paso un error';
        }
    }


    public function destroy($id) {
        try {
            $Person = Person::find($id);
            $Person->delete();
            return redirect('/dashboard/personas');
            
        } catch (\Throwable $th) {
            
        }
    }
}
