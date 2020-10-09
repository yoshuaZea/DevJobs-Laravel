<aside class="md:w-2/5 bg-teal-500 p-5 rounded m-3">
    <h2 class="text-2xl my-3 text-white fond-bold text-center">Contacta al reclutador</h2>
    <form action="{{ route('candidatos.store') }}" method="post" id="contactar-reclutador" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="nombre" class="block text-white text-sm text-bold mb-4">Nombre: </label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                class="p-3 bg-gray-100 rounded form-input w-full required @error('nombre') border border-red-500 @enderror"
                placeholder="¿Cuál es tu nombre?"
                value="{{ old('nombre') }}"
            />
            @error('nombre')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-white text-sm text-bold mb-4">Correo: </label>
            <input
                type="email"
                id="email"
                name="email"
                class="p-3 bg-gray-100 rounded form-input w-full required @error('email') border border-red-500 @enderror"
                placeholder="¿Cuál es tu correo electrónico?"
                value="{{ old('email') }}"
            />
            @error('email')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="cv" class="block text-white text-sm text-bold mb-4">Curriculum (PDF): </label>
            <input
                type="file"
                id="cv"
                name="cv"
                class="p-3 rounded form-input w-full required @error('cv') border border-red-500 @enderror"
                accept="application/pdf"
            />
            @error('cv')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <input type="hidden" name="vacante" value="{{ $vacante->id }}">

        <input
            type="submit"
            class="bg-teal-600 w-full hover:bg-teal-700 text-gray-100 p-3 focus:outline-none focus:shadow-outline uppercase cursor-pointer"
            value="Contactar"
        />
    </form>
</aside>
