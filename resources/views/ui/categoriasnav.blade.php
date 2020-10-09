{{-- MOSTRAR SI ESTA LOGUEAOD --}}
@if(auth()->user())
    <a
        class="text-white text-sm uppercase font-bold p-3 bg-teal-500"
        href="{{ route('vacantes.index') }}"
    >Mis vacantes</a>
@endif
@foreach($categorias as $categoria)
    <a
        class="text-white text-sm uppercase font-bold p-3"
        href="{{ route('categorias.show', ['categoria' => $categoria->id]) }}"
    >{{ $categoria->nombre }}</a>
@endforeach
