<h2 class="my-10 text-2xl text-gray-700">Busca una vacante</h2>
<form
    action="{{ route('vacantes.search') }}"
    class="max-w-lg mx-auto my-10"
    method="post"
>
    @csrf
    <div class="mb-5">
        <label
            class="block text-gray-700 text-sm mb-2"
            for="categoria"
        >Categoría: </label>
        <select
            id="categoria"
            name="categoria"
            class="p-3 block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight bg-gray-100
                    focus:outline-none focus:bg-white focus:border-gray-500 required  @error('categoria') border-red-500 border @enderror"
        >
            <option disabled selected>- Selecciona -</option>
            @foreach($categorias as $categoria)
                <option
                    value="{{ $categoria->id }}"
                    {{ old('categoria') == $categoria->id ? 'selected' : null }}
                >{{ $categoria->nombre }}</option>
            @endforeach
        </select>
        @error('categoria')
            <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{ $message }}</span>
            </div>
        @enderror
    </div>
    <div class="mb-5">
        <label
            class="block text-gray-700 text-sm mb-2"
            for="ubicacion"
        >Ubicación: </label>
        <select
            id="ubicacion"
            name="ubicacion"
            class="p-3 block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight bg-gray-100
                    focus:outline-none focus:bg-white focus:border-gray-500 required @error('ubicacion') border-red-500 border @enderror"
        >
            <option disabled selected>- Selecciona -</option>
            @foreach($ubicaciones as $ubicacion)
                <option
                    {{ old('ubicacion') == $ubicacion->id ? 'selected' : null }}
                    value="{{ $ubicacion->id }}"
                >{{ $ubicacion->nombre }}</option>
            @endforeach
        </select>
        @error('ubicacion')
            <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                <strong class="font-bold">Error!</strong>
                <span class="block">{{ $message }}</span>
            </div>
        @enderror
    </div>

    <button
        type="submit"
        class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline-none focus:shadow-outline uppercase mt-10 rounded"
    >Buscar vacantes</button>
</form>
