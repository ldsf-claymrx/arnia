<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Men;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class MenController extends Controller
{
    public function index() {
        $persons = Person::select('id', 'name', 'lastname', 'category', 'sex', 'phone_number')->whereIn('category', [1, 3])->get();
        return view('dashboard.menassistance', [
            'persons' => $persons
        ]);
    }

    public function create(Request $request) {

        $id_search = $request->input('id_person');
        $current_date = Carbon::now()->toDateString();

        $recorded_assists = Men::where('id_person', $id_search)->whereDate('date_assitance', $current_date)->first();

        if ($recorded_assists) {
            return redirect()->back()->with('error', 'No se puede confirmar dos veces a la misma persona');
        } else {
            $Men = new Men;
            $Men->id_person = $request->input('id_person');
            $name = $request->input('name');
            $Men->date_assitance = Carbon::now();
            $Men->who_registered = $request->input('who_registered');
            $Men->save();
            return redirect()->back()->with('success', '¡La asistencia de '.$name.' ha sido confirmada!');
        }
    }

    public function getTuesday() {
        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now();

        
        $tuesdays = [];

        
        while ($start_date->lte($end_date)) {
            if ($start_date->isTuesday()) {
                $tuesdays[] = $start_date->toDateString();
            }
            $start_date->addDay();
        }
        return $tuesdays;
    }

    public function getInassistance() {

        $fechas = $this->getTuesday();

        $TuesdaySQL = implode(' UNION ', array_map(function ($fecha) {
            return "SELECT '$fecha' AS fecha";
        }, $fechas));

        $sql = "
            WITH Martes AS (
                $TuesdaySQL
            ),
            Inasistencias AS (
                SELECT p.id, p.name, p.lastname, m.fecha FROM persons p
                CROSS JOIN Martes m LEFT JOIN menAssistance r ON p.id = r.id_person AND r.date_assitance = m.fecha
                WHERE r.id IS NULL and p.category = 1
            ),
            ConteoInasistencias AS (
                SELECT id, name, COUNT(*) AS total_inasistencias FROM Inasistencias
                GROUP BY id, name, lastname
            )
            SELECT ni.name, ni.lastname, ni.fecha, ci.total_inasistencias FROM Inasistencias ni
            LEFT JOIN ConteoInasistencias ci ON ni.id = ci.id
            ORDER BY total_inasistencias DESC, name, lastname, fecha;
        ";

        $results = DB::select($sql);

        // Agrupa los resultados por nombre
        $data = [];
        foreach ($results as $result) {
            if (!isset($data[$result->name])) {
                $data[$result->name] = (object)[
                    'name' => $result->name,
                    'lastname' => $result->lastname,
                    'dates' => []
                ];
            }
            $data[$result->name]->dates[] = $result->fecha;
        }

        // Retorna los resultados a la vista
        return view('dashboard.report', [
            'data' => $data,
            'start_date' => Carbon::now()->startOfMonth(),
            'end_date' => Carbon::now(),
            'category' => 1
        ]);
    }

    public function generatePDF() {
        $fechas = $this->getTuesday();

        $TuesdaySQL = implode(' UNION ', array_map(function ($fecha) {
            return "SELECT '$fecha' AS fecha";
        }, $fechas));

        $sql = "
            WITH Martes AS (
                $TuesdaySQL
            ),
            Inasistencias AS (
                SELECT p.id, p.name, p.lastname, m.fecha FROM persons p
                CROSS JOIN Martes m LEFT JOIN menAssistance r ON p.id = r.id_person AND r.date_assitance = m.fecha
                WHERE r.id IS NULL and p.category = 1
            ),
            ConteoInasistencias AS (
                SELECT id, name, COUNT(*) AS total_inasistencias FROM Inasistencias
                GROUP BY id, name, lastname
            )
            SELECT ni.name, ni.lastname, ni.fecha, ci.total_inasistencias FROM Inasistencias ni
            LEFT JOIN ConteoInasistencias ci ON ni.id = ci.id
            ORDER BY total_inasistencias DESC, name, lastname, fecha;
        ";

        $results = DB::select($sql);

        // Agrupa los resultados por nombre
        $data = [];
        foreach ($results as $result) {
            if (!isset($data[$result->name])) {
                $data[$result->name] = (object)[
                    'name' => $result->name,
                    'lastname' => $result->lastname,
                    'dates' => []
                ];
            }
            $data[$result->name]->dates[] = $result->fecha;
        }

        $pdf = PDF::loadView('dashboard.downloadPDF', [
            'data' => $data,
            'start_date' => Carbon::now()->startOfMonth(),
            'end_date' => Carbon::now(),
            'category' => 1
        ]);

        return $pdf->download('reporte-varones.pdf');
    }
}
