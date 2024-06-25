<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Woman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

class WomanController extends Controller
{
    public function index() {
        $persons = Person::select('id', 'name', 'lastname', 'category', 'sex', 'phone_number')->whereIn('category', [2, 4])->get();
        return view('dashboard.womanassistance', [
            'persons' => $persons
        ]);
    }

    public function create(Request $request) {

        $id_search = $request->input('id_person');
        $current_date = Carbon::now()->toDateString();

        $recorded_assists = Woman::where('id_person', $id_search)->whereDate('date_assitance', $current_date)->first();

        if ($recorded_assists) {
            return redirect()->back()->with('error', 'No se puede confirmar dos veces a la misma persona');
        } else {
            $Woman = new Woman;
            $Woman->id_person = $request->input('id_person');
            $name = $request->input('name');
            $Woman->date_assitance = Carbon::now();
            $Woman->who_registered = $request->input('who_registered');
            $Woman->save();
            return redirect()->back()->with('success', '¡La asistencia de '.$name.' ha sido confirmada!');
        }
    }

    public function getWednesday() {
        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now();

        $wednesdays = [];
        
        while ($start_date->lte($end_date)) {
            if ($start_date->isWednesday()) {
                $wednesdays[] = $start_date->toDateString();
            }
            $start_date->addDay();
        }
        return $wednesdays;
    }

    public function getInassistance() {

        $fechas = $this->getWednesday();

        $miercolesSQL = implode(' UNION ', array_map(function ($fecha) {
            return "SELECT '$fecha' AS fecha";
        }, $fechas));

        $sql = "
            WITH Miercoles AS (
                $miercolesSQL
            ),
            Inasistencias AS (
                SELECT p.id, p.name, p.lastname, m.fecha FROM persons p
                CROSS JOIN Miercoles m LEFT JOIN womanAssistance r ON p.id = r.id_person AND r.date_assitance = m.fecha
                WHERE r.id IS NULL and p.category = 2
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
            'category' => 2
        ]);
    }

    public function generatePDF() {
        $fechas = $this->getWednesday();

        $miercolesSQL = implode(' UNION ', array_map(function ($fecha) {
            return "SELECT '$fecha' AS fecha";
        }, $fechas));

        $sql = "
            WITH Miercoles AS (
                $miercolesSQL
            ),
            Inasistencias AS (
                SELECT p.id, p.name, p.lastname, m.fecha FROM persons p
                CROSS JOIN Miercoles m LEFT JOIN womanAssistance r ON p.id = r.id_person AND r.date_assitance = m.fecha
                WHERE r.id IS NULL and p.category = 2
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
            'category' => 2
        ]);

        return $pdf->download('reporte-mujeres.pdf');
    }
}
