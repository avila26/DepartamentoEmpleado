<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    public function index()
    {
        $depa = Departamento::get();
        $empleados = DB::table('empleados')
            ->join('departamentos', 'depa_id', '=', 'departamentos.id')
            ->where('empleados.estado', 1)
            ->select('empleados.*', 'departamentos.nombreDepa')
            ->get();
        return view('depaemple.departamentos', compact('empleados', 'depa'));
    }

    public function store(Request $request)
    {
        $depa = new Departamento();
        $depa->nombreDepa = $request->nombreDepa;
        $depa->ubicacion = $request->ubicacion;
        $depa->save();
        return back();
    }

    public function mostrarEmpleados(Request $request)
    {
        $depa = Departamento::get();
        $datoFiltrado = $request->datoFiltrado;
        $message = " ";

        $empleados = DB::table('empleados')
            ->join('departamentos', 'depa_id', '=', 'departamentos.id')
            ->where('empleados.estado', 1)
            ->where('departamentos.id', '=', $datoFiltrado)
            ->select('empleados.*', 'departamentos.nombreDepa')
            ->get();

        // Contar el número de empleados en el departamento seleccionado
        $countEmpleados = $empleados->count();

        // Verificar si hay empleados y construir el mensaje en consecuencia
        if ($countEmpleados > 0) {
            $message = "Se encontraron $countEmpleados empleados en el departamento seleccionado.";
        } else {
            $message = "No hay empleados en el departamento seleccionado.";
        }

        // Puedes usar compact para pasar las variables a la vista
        // return view('depaemple.mostrarEmple', compact('empleados', 'depa', 'countEmpleados', 'message'));
        session()->flash('message', $message);
        return view('depaemple.mostrarEmple', compact('empleados', 'depa', 'countEmpleados', 'message'));
    }
}
