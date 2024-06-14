<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Young;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PDF;

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

    public function getSaturdays()
    {
        $start_date = Carbon::now()->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();

        
        $saturdays = [];

        
        while ($start_date->lte($end_date)) {
            if ($start_date->isSaturday()) {
                $saturdays[] = $start_date->toDateString();
            }
            $start_date->addDay();
        }
        return $saturdays;
    }

    public function getInassistance() {

        $fechas = $this->getSaturdays();

        $sabadosSql = implode(' UNION ', array_map(function ($fecha) {
            return "SELECT '$fecha' AS fecha";
        }, $fechas));

        $sql = "
            WITH Sabados AS (
                $sabadosSql
            ),
            Inasistencias AS (
                SELECT p.id, p.name, s.fecha, 'No Asistió' AS estado 
                FROM persons p
                CROSS JOIN Sabados s 
                LEFT JOIN youthAssistance r ON p.id = r.id_person AND r.date_assitance = s.fecha
                WHERE r.id IS NULL and p.category in (3, 4)
            ),
            ConteoInasistencias AS (
                SELECT id, name, COUNT(*) AS total_inasistencias 
                FROM Inasistencias
                GROUP BY id, name
            )
            SELECT ni.name, ni.fecha, ni.estado, ci.total_inasistencias 
            FROM Inasistencias ni
            LEFT JOIN ConteoInasistencias ci ON ni.id = ci.id
            ORDER BY name, total_inasistencias DESC, fecha;
        ";

        $results = DB::select($sql);

        // Agrupa los resultados por nombre
        $data = [];
        foreach ($results as $result) {
            if (!isset($data[$result->name])) {
                $data[$result->name] = (object)[
                    'name' => $result->name,
                    'dates' => []
                ];
            }
            $data[$result->name]->dates[] = $result->fecha;
        }

        // Retorna los resultados a la vista
        return view('dashboard.report', [
            'data' => $data,
            'start_date' => Carbon::now()->startOfMonth(),
            'end_date' => Carbon::now()->endOfMonth(),
            'category' => 3
        ]);
    }

    public function generatePDF() {
        $fechas = $this->getSaturdays();

        $sabadosSql = implode(' UNION ', array_map(function ($fecha) {
            return "SELECT '$fecha' AS fecha";
        }, $fechas));

        $sql = "
            WITH Sabados AS (
                $sabadosSql
            ),
            Inasistencias AS (
                SELECT p.id, p.name, s.fecha, 'No Asistió' AS estado 
                FROM persons p
                CROSS JOIN Sabados s 
                LEFT JOIN youthAssistance r ON p.id = r.id_person AND r.date_assitance = s.fecha
                WHERE r.id IS NULL and p.category in (3, 4)
            ),
            ConteoInasistencias AS (
                SELECT id, name, COUNT(*) AS total_inasistencias 
                FROM Inasistencias
                GROUP BY id, name
            )
            SELECT ni.name, ni.fecha, ni.estado, ci.total_inasistencias 
            FROM Inasistencias ni
            LEFT JOIN ConteoInasistencias ci ON ni.id = ci.id
            ORDER BY name, total_inasistencias DESC, fecha;
        ";

        $results = DB::select($sql);

        // Agrupa los resultados por nombre
        $data = [];
        foreach ($results as $result) {
            if (!isset($data[$result->name])) {
                $data[$result->name] = (object)[
                    'name' => $result->name,
                    'dates' => []
                ];
            }
            $data[$result->name]->dates[] = $result->fecha;
        }

        $pdf = PDF::loadView('dashboard.downloadPDF', [
            'data' => $data,
            'start_date' => Carbon::now()->startOfMonth(),
            'end_date' => Carbon::now()->endOfMonth(),
            'category' => 3
        ]);

        return $pdf->download('reporte.pdf');
    }
}
