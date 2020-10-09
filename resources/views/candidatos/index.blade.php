@extends('layouts.app')

@section('nav')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Candidatos para {{ $vacante->titulo }}</h1>

    @if(count($vacante->candidatos) > 0)
        <ul class="max-w-md mx-auto mt-10">
            @foreach($vacante->candidatos as $candidato)
                <li class="p-5 border border-gray-400 mb-5">
                    <p class="mb-2">
                        Nombre: <span class="font-bold">{{ $candidato->nombre }}</span>
                    </p>
                    <p class="mb-2">
                        Email: <span class="font-bold">{{ $candidato->email }}</span>
                    </p>
                    @if($candidato->cv)
                        <a
                            class="bg-teal-500 p-3 inline-block text-xs text-white uppercase font-bold"
                            target="_blank"
                            href="/storage/cv/{{ $candidato->cv }}"
                        >Ver CV</a>
                    @else
                        <p class="text-gray-700 mb-2">Sin CV adjunto</p>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-center mt-5 text-gray-700">Aún no hay candidatos postulados</p>
    @endif
@endsection
