<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use App\Models\Vacante;
use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(){

        // Vacantes del usuario autenticado
        // $vacantes = auth()->user()->vacantes;
        $vacantes = Vacante::latest()
                            ->where('user_id', auth()->user()->id)
                            ->simplePaginate(5);

        return view('vacantes.index', compact('vacantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        $categorias = Categoria::orderBy('nombre', 'asc')->get();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::orderBy('nombre', 'asc')->get();
        $salarios = Salario::all();

        return view('vacantes.create', compact('categorias', 'experiencias', 'ubicaciones', 'salarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required|integer',
            'experiencia' => 'required|integer',
            'ubicacion' => 'required|integer',
            'salario' => 'required|integer',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required|min:3'
        ]);

        try {
            // Almacenar en la BD
            auth()->user()->vacantes()->create([
                'titulo' => $data['titulo'],
                'imagen' => $data['imagen'],
                'descripcion' => $data['descripcion'],
                'skills' => $data['skills'],
                'categoria_id' => $data['categoria'],
                'experiencia_id' => $data['experiencia'],
                'ubicacion_id' => $data['ubicacion'],
                'salario_id' => $data['salario'],
            ]);

            return redirect()
                    ->action('VacanteController@index')
                    ->with('type', 'success')
                    ->with('msg', 'Vacante registrada correctamente');

        } catch (\Throwable $th) {
            return back()
                ->with('msg', 'Hubo un error al crear la vacante - ' . $th->getMessage())
                ->with('type', 'error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante){
        // Solo mostrar activas
        // if($vacante->activa === 0) return abort(404);

        return view('vacantes.show', compact('vacante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante){
        // Aplicar policy
        $this->authorize('view', $vacante);

        $categorias = Categoria::orderBy('nombre', 'asc')->get();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::orderBy('nombre', 'asc')->get();
        $salarios = Salario::all();

        return view('vacantes.edit', compact('vacante', 'categorias', 'experiencias', 'ubicaciones', 'salarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante){
        // Aplicar policy
        $this->authorize('update', $vacante);

        $data = $request->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required|integer',
            'experiencia' => 'required|integer',
            'ubicacion' => 'required|integer',
            'salario' => 'required|integer',
            'descripcion' => 'required|min:50',
            'imagen' => 'required',
            'skills' => 'required|min:3'
        ]);

        try {
            // Actualizar en la BD
            $vacante->titulo = $data['titulo'];
            $vacante->imagen = $data['imagen'];
            $vacante->descripcion = $data['descripcion'];
            $vacante->skills = $data['skills'];
            $vacante->categoria_id = $data['categoria'];
            $vacante->experiencia_id = $data['experiencia'];
            $vacante->ubicacion_id = $data['ubicacion'];
            $vacante->salario_id = $data['salario'];

            // Guardar cambios
            $vacante->save();

            return redirect()
                    ->action('VacanteController@index')
                    ->with('type', 'success')
                    ->with('msg', 'Vacante actualizada correctamente');

        } catch (\Throwable $th) {
            return back()
                ->with('msg', 'Hubo un error al crear la vacante - ' . $th->getMessage())
                ->with('type', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Vacante $vacante){
        // Aplicar policy
        $this->authorize('delete', $vacante);

        // Eliminar vacante
        $vacante->delete();

        return response()->json(['msg' => 'Se eliminó la vacante ' . $vacante->titulo], 200);
    }

    // UPLOAD FILE WITH DROPZONE
    public function upload(Request $request){
        // Leer archivo
        $imagen = $request->file('file');

        // Nombre del archivo
        $nombreImagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/vacantes'), $nombreImagen);

        return response()->json(['correcto' => $nombreImagen]);
    }

    public function deleteimage(Request $request){
        if($request->ajax()){
            $imagen = $request->get('imagen');

            if(File::exists('storage/vacantes/' . $imagen)){
                File::delete('storage/vacantes/' . $imagen);
            }

            return response('Imagen eliminada', 200);
        }
    }

    public function changeState(Request $request, Vacante $vacante){
        // Extraer estado
        $estado = (int) $request->estado;

        // Asignar y guardar en BD
        $vacante->activa = $estado;
        $vacante->save();

        return response()->json(['status' => true], 200);
    }

    // Buscador
    public function search(Request $request){
        // Validar
        $data = $request->validate([
            'categoria' => 'required|integer',
            'ubicacion' => 'required|integer',
        ]);

        // Asignar valores
        $categoria = $data['categoria'];
        $ubicacion = $data['ubicacion'];

        $vacantes = Vacante::latest()
                            ->where('categoria_id', $categoria)
                            ->where('ubicacion_id', $ubicacion)
                            ->get();

        // CONSULTAS CON DIFERENTES WHERE
        // $vacante = Vacante::where([
        //                             'categoria_id' => $categoria,
        //                             'ubicacion_id' => $ubicacion,
        //                         ])->get();

        return view('buscar.index', compact('vacantes'));
    }
}
