@extends('layouts.app')

@section('nav')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Notificaciones</h1>

    @if(count($notificaciones) > 0)
        <ul class="max-w-md mx-auto mt-10">
            @foreach($notificaciones as $notificacion)
                @php
                    $data = $notificacion->data
                @endphp
                <li class="p-5 border border-gray-400 mb-5 {{ !$notificacion->read_at ? 'bg-teal-500' : null}}">
                    <p class="mb-4">
                        Tienes un nuevo candidato en:
                        <span class="font-bold">{{ $data['vacante'] }}</span>
                    </p>
                    <p class="mb-4">
                        Te escribió:
                        <span class="font-bold">{{ $notificacion->created_at->diffForHumans() }}</span>
                    </p>
                    <a
                        class="{{ !$notificacion->read_at ? 'bg-white text-teal-500': 'bg-teal-500 text-white'}} p-3 inline-block text-xs uppercase font-bold"
                        href="{{ route('candidatos.index', ['id' => $data['vacante_id']]) }}">
                        Ver candidatos
                    </a>
                </li>
            @endforeach
        </ul>
        {{ $notificaciones->links() }}
    @else
        <p class="text-center mt-5 text-gray-700">No tienes notificaciones por revisar</p>
    @endif
@endsection
