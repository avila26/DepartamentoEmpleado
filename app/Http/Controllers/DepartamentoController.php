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
        // Obtiene todos los registros de la tabla 'departamentos'
        $depa = Departamento::get();
        
        // Realiza una consulta para obtener empleados junto con el nombre del departamento al que pertenecen
        $empleados = DB::table('empleados')
            ->join('departamentos', 'depa_id', '=', 'departamentos.id') // Une la tabla 'empleados' con 'departamentos' usando 'depa_id' como clave foránea
            ->where('empleados.estado', 1) // Filtra los empleados cuyo estado es 1 (probablemente activos)
            ->select('empleados.*', 'departamentos.nombreDepa') // Selecciona todos los campos de 'empleados' y el campo 'nombreDepa' de 'departamentos'
            ->get();
        
        // Retorna una vista llamada 'depaemple.departamentos' con los datos de 'empleados' y 'depa'
        return view('depaemple.departamentos', compact('empleados', 'depa'));
    }
    
    public function store(Request $request)
    {
        // Crea una nueva instancia del modelo 'Departamento'
        $depa = new Departamento();
        
        // Asigna los valores del request a los campos correspondientes del nuevo departamento
        $depa->nombreDepa = $request->nombreDepa;
        $depa->ubicacion = $request->ubicacion;
        
        // Guarda el nuevo departamento en la base de datos
        $depa->save();
        
        // Redirige de vuelta a la página anterior
        return back();
    }
    
    public function mostrarEmpleados(Request $request) //buscarempleado
    {
        // Obtiene todos los registros de la tabla 'departamentos'
        $depa = Departamento::get();
        
        // Almacena el valor del campo 'datoFiltrado' enviado en el request
        $datoFiltrado = $request->datoFiltrado;
        
        // Inicializa un mensaje vacío
        $message = " ";
    
        // Realiza una consulta para obtener empleados que pertenecen al departamento filtrado
        $empleados = DB::table('empleados')
            ->join('departamentos', 'depa_id', '=', 'departamentos.id') // Une la tabla 'empleados' con 'departamentos'
            ->where('empleados.estado', 1) // Filtra los empleados cuyo estado es 1 (probablemente activos)
            ->where('departamentos.id', '=', $datoFiltrado) // Filtra los empleados por el departamento seleccionado
            ->select('empleados.*', 'departamentos.nombreDepa') // Selecciona todos los campos de 'empleados' y 'nombreDepa' de 'departamentos'
            ->get();
    
        // Cuenta cuántos empleados fueron encontrados en el departamento seleccionado
        $countEmpleados = $empleados->count();
    
        // Verifica si se encontraron empleados y construye un mensaje acorde
        if ($countEmpleados > 0) {
            $message = "Se encontraron $countEmpleados empleados en el departamento seleccionado.";
        } else {
            $message = "No hay empleados en el departamento seleccionado.";
        }
    
        // Guarda el mensaje en la sesión para mostrarlo en la vista
        session()->flash('message', $message);
        
        // Retorna una vista llamada 'depaemple.mostrarEmple' con los datos de 'empleados', 'depa', 'countEmpleados' y el mensaje
        return view('depaemple.mostrarEmple', compact('empleados', 'depa', 'countEmpleados', 'message'));
    }
    
}
