<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pevents;
use App\Models\Person;
use App\Models\Church;
use App\Models\Event;

class PersonsEventController extends Controller
{
    public function index() {
        $personsEvents = Pevents::all();
        $persons = Person::all();
        $churchs = Church::all();
        $events = Event::all();
        return view('dashboard.personsevent', [
            'personsEvents' => $personsEvents,
            'persons' => $persons,
            'churchs' => $churchs,
            'events' => $events
        ]);
    }

    public function create(Request $request) {
        try {

            $e = new Pevents;
            
            $id_person = $request->input('id_person');
            $id_church = $request->input('id_church');
            $id_event = $request->input('id_event');
            

            if($id_person == "0") {
                return "Persona";
            }
            else if($id_church == "0") {
                return "Church";
            }
            else if($id_event == "0") {
                return "Event";
            }
            else {
                
                $e->id_person = $id_person;
                $e->id_church = $id_church;
                $e->id_event = $id_event;
                $e->date_register = date('Y-m-d');

                $e->save();
                
                return redirect('/dashboard/asignarpersona');
            }
            
        } catch (\Throwable $th) {
            return $th;
        }
    }


    public function update(Request $request, $id) {
        try {

            $e = Pevents::find($id);
            
            $id_person = $request->input('id_person');
            $id_church = $request->input('id_church');
            $id_event = $request->input('id_event');
            

            if($id_person == "0") {
                return "Persona";
            }
            else if($id_church == "0") {
                return "Church";
            }
            else if($id_event == "0") {
                return "Event";
            }
            else {
                
                $e->id_person = $id_person;
                $e->id_church = $id_church;
                $e->id_event = $id_event;

                $e->update();
                
                return redirect('/dashboard/asignarpersona');
            }
            
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function destroy($id) {
        try {
            $e = Pevents::find($id);
            $e->delete();
            return redirect('/dashboard/asignarpersona');
            
        } catch (\Throwable $th) {
            
        }
    }
}
