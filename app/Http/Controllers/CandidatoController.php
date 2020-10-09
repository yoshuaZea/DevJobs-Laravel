<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Candidato;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\NuevoCandidato;

class CandidatoController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        // Obtener ID actual
        $vacanteId = $request->get('id');

        $vacante = Vacante::findOrFail($vacanteId);

        // Aplicar policy
        $this->authorize('view', $vacante);

        return view('candidatos.index', compact('vacante'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // Validación
        $data = $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'vacante' => 'required|integer'
        ]);

        // Si adjunta PDF
        if($request->cv){
            $data = array_merge($data, $request->validate(['cv' => 'required|mimes:pdf|max:1000']));
        }

        // Almacenar archivo pdf
        if($request->file('cv')){
            $archivo = $request->file('cv');
            $nombreArchivo = time() . '.' . $archivo->extension();
            $ubicacion = public_path('/storage/cv');
            $archivo->move($ubicacion, $nombreArchivo);
        }

        // FORMAS DE ALMACENAR DATOS
        // Primera forma
        // $candidato = new Candidato(); // Instanciar objeto
        // $candidato->nombre = $data['nombre'];
        // $candidato->email = $data['email'];
        // $candidato->cv = $data['cv'];
        // $candidato->vacante_id = $data['vacante'];
        // $candidato->save();

        // Segunda forma
        // $candidato = new Candidato($data); // Instanciar objeto
        // $candidato->vacante_id = $data['vacante'];
        // $candidato->save();

        // Tercera forma
        // $candidato = new Candidato(); // Instanciar objeto
        // $candidato->fill($data);
        // $candidato->vacante_id = $data['vacante'];
        // $candidato->save();

        // Cuarta forma (mediante una relación)
        $vacante = Vacante::find($data['vacante']);

        $vacante->candidatos()->create([
            'nombre' => Str::title($data['nombre']),
            'email' => $data['email'],
            'cv' => $nombreArchivo ?? null,
            'vacante_id' => $data['vacante'],
        ]);

        // Enviar notifiación por correo
        $vacante->usuario->notify(new NuevoCandidato($vacante->titulo, $vacante->id));

        return back()->with('type', 'success')->with('msg', 'Tu CV ha sido enviado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato){
        //
    }
}
