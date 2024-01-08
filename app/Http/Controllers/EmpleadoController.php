<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::get();
        $empleado = DB::table('departamentos')
            ->join('empleados', 'departamentos.id', '=', 'empleados.depa_id')
            ->select('empleados.*', 'departamentos.nombreDepa')
            ->where('empleados.estado', true)
            ->get();
            
        return view('depaemple.empleados', compact('departamentos', 'empleado'));
    }

    public function store(Request $request)
    {
        $empleado = new Empleado();
        $empleado->nombre            = $request->nombre;
        $empleado->apellido          = $request->apellido;
        $empleado->puesto            = $request->puesto;
        $empleado->salario          = $request->salario;
        $empleado->depa_id           = $request->depa_id;
        $empleado->save();
        return back();
    }
    public function delete($id)
    {
        $empleado = Empleado::find($id);
        if ($empleado) {
            $empleado->estado = false;
            $empleado->save();
            return back();
        }
    }


    public function showEmpleado($id)
{
    // Obtener todos los departamentos
    $departamentos = Departamento::get();

    // Buscar un empleado por su ID en la base de datos
    $empleado = Empleado::where('id', $id)->first();

    // Devolver una vista llamada 'depaemple.bono' con los datos de departamentos y empleado
    return view('depaemple.bono', compact('departamentos', 'empleado'));
}


    public function bonos($id, Request $request)
    {
        $empleado = Empleado::where('id', $id)->first();
        $alm = 0;        //se utilizará para almacenar la nueva cantidad en stock.
        $message = "";
        if ($request->bonoempleado == 0) {
            $message = "No ha realizado Bonos";
        } else {
            $alm =  $empleado->salario + $request->bonoempleado;
            $empleado->salario = $alm;

            $message = "Usted ha realizado un bono de $request->bonoempleado dolares a $empleado->nombre $empleado->apellido ";
        }
        $empleado->save();
        return redirect('/empleado')->with('status', $message);
    }
}
