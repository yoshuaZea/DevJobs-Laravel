<a
    class="text-white text-sm uppercase font-bold p-3 {{ Request::is('vacantes') ? 'bg-teal-500' : '' }}"
    href="{{ route('vacantes.index') }}"
>Ver vacantes</a>
<a
    class="text-white text-sm uppercase font-bold p-3 {{ Request::is('vacantes/create') ? 'bg-teal-500' : '' }}"
    href="{{ route('vacantes.create') }}"
>Nueva vacante</a>
