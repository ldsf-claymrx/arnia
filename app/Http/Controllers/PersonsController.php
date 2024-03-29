<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Person;

class PersonsController extends Controller
{
    public function index() {
        $categories = Category::all();
        $persons = Person::all();
        return view('dashboard.persons', [
            'categories' => $categories,
            'persons' => $persons
        ]);
    }

    public function create(Request $request) {
        try {
            $Todos = Person::all();

            foreach ($Todos as $t) {
                if($t->name == $request->input('name') && $t->lastname == $request->input('lastname')) {
                    return "Esta persona ya esta registrada!";
                }
            }

            $Person = new Person;

            $Person->name = $request->input('name');
            $Person->lastname = $request->input('lastname');
            $Person->phone_number = $request->input('phone_number');
            $Person->email = $request->input('email');
            $Person->address = $request->input('address');
            $Person->birthdate = $request->input('birthdate');
            $Person->nickname = $request->input('nickname');
            $Person->who_registered = $request->input('who_registered'); 
            
            $Person->date_register = date('Y-m-d');
            
            $id_category = $request->input('id_category');
            $sex = $request->input('sex');

            if($id_category == "0"){
                return redirect()->back();
            }
            else if($sex == "0") {
                return redirect()->back();
            }
            else {
                $Person->id_category = $id_category;
                $Person->sex = $sex;

                $Person->save();
                return redirect('/dashboard/personas');
            }
            
        } catch (\Throwable $th) {
            
        }
    }


    public function update(Request $request, $id){
        try {
            $Person = Person::find($id);

            $Person->name = $request->input('name');
            $Person->lastname = $request->input('lastname');
            $Person->phone_number = $request->input('phone_number');
            $Person->email = $request->input('email');
            $Person->address = $request->input('address');
            $Person->birthdate = $request->input('birthdate');
            $Person->nickname = $request->input('nickname');

            

            

            $id_category = $request->input('id_category');
            $sex = $request->input('sex');

            if($id_category == "0"){
                return redirect()->back();
            }
            else if($sex == "0") {
                return redirect()->back();
            }
            else {
                $Person->id_category = $id_category;
                $Person->sex = $sex;

                $Person->update();
                return redirect('/dashboard/personas');
            }
        } catch (\Throwable $th) {
            //return redirect()->back();
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
