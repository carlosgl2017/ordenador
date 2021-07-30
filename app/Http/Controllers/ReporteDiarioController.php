<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Alert;
use PDF;

class ReporteDiarioController extends Controller
{
    public function reportediario(Request $request)
    {        

        $fecha = Carbon::parse($request->input('fecha'));
       
        $option = $request->input('area');
        switch ($option) {
            case "CAJA":
                $tickets = DB::table('tickets')
                ->where('emitido', '>', $fecha->format('d-m-Y') . ' 00:00:00')
                ->where('emitido', '<', $fecha->format('d-m-Y') . ' 23:59:00')
                ->where('servicio', 'CAJA')
                ->get();
                break;
            case "ATEN-PLAT":
                $tickets = DB::table('tickets')
                ->where('emitido', '>', $fecha->format('d-m-Y') . ' 00:00:00')
                ->where('emitido', '<', $fecha->format('d-m-Y') . ' 23:59:00')
                ->where('servicio', 'ATEN-PLAT')
                ->get();
                break;
            case "GENERAL":
                $tickets = DB::table('tickets')
                ->where('emitido', '>', $fecha->format('d-m-Y') . ' 00:00:00')
                ->where('emitido', '<', $fecha->format('d-m-Y') . ' 23:59:00')
                ->get();
                break;
            case "CREDITOS":
                $tickets = DB::table('tickets')
                ->where('emitido', '>', $fecha->format('d-m-Y') . ' 00:00:00')
                ->where('emitido', '<', $fecha->format('d-m-Y') . ' 23:59:00')
                ->whereIn('servicio',['CREDITOS 1','CREDITOS 2','CREDITOS 3','CREDITOS E'])
                ->get();
                break;
        }
        // dd($this->totalregistros($tickets));
        $date = $request->input('fecha');
        $pdf = PDF::loadView('reporte.reficienciadiaria', ['tickets' => $tickets, 'date' => $date, 'indice' => $this->indicediario($this->totalregistros($tickets), $this->totalmayor($tickets)), 'total' => $this->totalregistros($tickets), 'totalmayor' => $this->totalmayor($tickets),'area'=>$request->input('area')]);
        $pdf->setPaper('a4', 'portrait');
        return $pdf->download('reporte_tiempo_espera_atencion_'.$request->input('area').'_'.$request->input('fecha').'.pdf');
    }

    //Total registro a fecha
    public function totalregistros($array)
    {
        $contador = 0;
        foreach ($array as &$ti) {
            $contador++;
        }
        return $contador;
    }
    //Tiempo en segundos
    public function totalmayor($array)
    {
        $contador = 0;
        foreach ($array as &$ar) {
            $seconds = Carbon::parse($ar->atendido)->diffInSeconds(Carbon::parse($ar->emitido));
            if ($seconds > 1800) {
                $contador++;
            }
        }
        return $contador;
    }
    //Indice de Eficiencia parcial de atencion en cajas
    public function indicediario($totalregistros, $totalmayor)
    {
        $indice = ($totalmayor / $totalregistros) * 100;
        return $indice;
    }
}
