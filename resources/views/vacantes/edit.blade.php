@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />
@endsection

@section('nav')
   @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center mt-10">Editar vacante {{ $vacante->titulo }}</h1>

    <form
        id="nueva-vacante"
        class="max-w-lg mx-auto my-10"
        action="{{ route('vacantes.update', ['vacante' => $vacante->id]) }}"
        method="post"
    >
        @csrf
        @method('put')
        <div class="mb-5">
            <label
                class="block text-gray-700 text-sm mb-2"
                for="titulo"
            >Titulo vacante: </label>
            <input
                type="text"
                class="p-3 bg-white rounded form-input w-full required @error('titulo') border-red-500 border @enderror"
                id="titulo"
                name="titulo"
                placeholder="¿Cuál es el nombre de la vacante?"
                value="{{ $vacante->titulo }}"
            />
            @error('titulo')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label
                class="block text-gray-700 text-sm mb-2"
                for="categoria"
            >Categoría: </label>
            <select
                id="categoria"
                name="categoria"
                class="p-3 block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight
                        focus:outline-none focus:bg-white focus:border-gray-500 required  @error('categoria') border-red-500 border @enderror"
            >
                <option disabled selected>- Selecciona -</option>
                @foreach($categorias as $categoria)
                    <option
                        value="{{ $categoria->id }}"
                        {{ $vacante->categoria_id == $categoria->id ? 'selected' : null }}
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
                for="experiencia"
            >Experiencia: </label>
            <select
                id="experiencia"
                name="experiencia"
                class="p-3 block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight
                        focus:outline-none focus:bg-white focus:border-gray-500 required @error('experiencia') border-red-500 border @enderror"
            >
                <option disabled selected>- Selecciona -</option>
                @foreach($experiencias as $experiencia)
                    <option
                        {{ $vacante->experiencia_id == $experiencia->id ? 'selected' : null }}
                        value="{{ $experiencia->id }}"
                    >{{ $experiencia->nombre }}</option>
                @endforeach
            </select>
            @error('experiencia')
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
                class="p-3 block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight
                        focus:outline-none focus:bg-white focus:border-gray-500 required @error('ubicacion') border-red-500 border @enderror"
            >
                <option disabled selected>- Selecciona -</option>
                @foreach($ubicaciones as $ubicacion)
                    <option
                        {{ $vacante->ubicacion_id == $ubicacion->id ? 'selected' : null }}
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

        <div class="mb-5">
            <label
                class="block text-gray-700 text-sm mb-2"
                for="salario"
            >Salarios: </label>
            <select
                id="salario"
                name="salario"
                class="p-3 block appearance-none w-full border-gray-200 text-gray-700 rounded leading-tight
                        focus:outline-none focus:bg-white focus:border-gray-500 required @error('salario') border-red-500 border @enderror"
            >
                <option disabled selected>- Selecciona -</option>
                @foreach($salarios as $salario)
                    <option
                        {{ $vacante->salario_id == $salario->id ? 'selected' : null }}
                        value="{{ $salario->id }}"
                    >{{ $salario->nombre }}</option>
                @endforeach
            </select>
            @error('salario')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label
                class="block text-gray-700 text-sm mb-2"
                for="descripcion"
            >Descripción del puesto: </label>
            <div class="editable p-3 bg-gray-100 rounded form-input w-full text-gray-700"></div>

            <input
                type="hidden"
                id="descripcion"
                name="descripcion"
                value="{{ $vacante->descripcion }}"
            />
            @error('descripcion')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label
                class="block text-gray-700 text-sm mb-5"
                for="skills"
            >Habilidades y conocimientos: <span class="text-xs">(3 mínimo)</span></label>

            @php
                $skills = ['HTML5', 'CSS3', 'CSSGrid', 'Flexbox', 'JavaScript', 'jQuery', 'Node', 'Angular', 'VueJS', 'ReactJS', 'React Hooks', 'Redux', 'Apollo', 'GraphQL', 'TypeScript', 'PHP', 'Laravel', 'Symfony', 'Python', 'Django', 'ORM', 'Sequelize', 'Mongoose', 'SQL', 'MVC', 'SASS', 'WordPress', 'Express', 'Deno', 'React Native', 'Flutter', 'MobX', 'C#', 'Ruby on Rails']
            @endphp

            <div
                id="listado-skills"
                data-skills="{{ json_encode($skills) }}"
                data-old-skills={{ $vacante->skills }}
            ></div>

            @error('skills')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <label
                class="block text-gray-700 text-sm mb-2"
                for="imagen"
            >Imagen vacante: </label>
            <div class="dropzone rounded bg-gray-100" id="dropzoneDevJobs"></div>
            <input
                type="hidden"
                id="imagen"
                name="imagen"
                value="{{ $vacante->imagen }}"
            />
            <p id="error"></p>

            @error('imagen')
                <div class="bg-red-100 border-l-4 border border-red-500 text-red-700 px-4 py-2 w-full mt-3 text-sm">
                    <strong class="font-bold">Error!</strong>
                    <span class="block">{{ $message }}</span>
                </div>
            @enderror
        </div>

        <button
            type="submit"
            class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline-none focus:shadow-outline uppercase"
        >Actualizar vacante</button>
    </form>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js" integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA==" crossorigin="anonymous"></script>
    <script>
        Dropzone.autoDiscover = false

        document.addEventListener('DOMContentLoaded', () => {
            // MEDIUM EDITOR
            const editor = new MediumEditor('.editable', {
                toolbar: {
                    buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', 'orderedlist', 'unorderedlist', 'h2', 'h3'],
                    static: true,
                    sticky: true
                },
                placeholder: {
                    text: 'Información de la vacante...'
                }
            })

            // Agrega en el input hidden el texto que se escribe en medium editor
            editor.subscribe('editableInput', function(event, editable){
                const contenido = editor.getContent()
                document.querySelector('#descripcion').value = contenido
            })

            // Llena el editor con el contenido del input hidden
            editor.setContent(document.querySelector('#descripcion').value)


            // DROPZONE
            const dropzoneDevJobs = new Dropzone('#dropzoneDevJobs', {
                url: '/vacantes/imagen',
                dictDefaultMessage: 'Sube aquí tu archivo',
                acceptedFiles: '.png,.jpg,.jpeg,.gif,.bmp',
                addRemoveLinks: true,
                dictRemoveFile: 'Borrar archivo',
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                init: function(){
                    // Si hay una imagen cargada y hubo un error al enviar el form
                    if(document.querySelector('#imagen').value.trim()){
                        let imagenPublicada = {}
                        imagenPublicada.size = 1234
                        imagenPublicada.name = document.querySelector('#imagen').value
                        imagenPublicada.nombreServidor = document.querySelector('#imagen').value

                        // Cargar imagen en el dropzone
                        this.options.addedfile.call(this, imagenPublicada)
                        this.options.thumbnail.call(this, imagenPublicada, `/storage/vacantes/${imagenPublicada.name}`)

                        // Agregar preview al dropzone
                        imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
                    }
                },
                success: function(file, response){
                    document.querySelector('#error').textContent = ''
                    // console.log(response)

                    // Coloca respuesta del servidor en el input
                    document.querySelector('#imagen').value = response.correcto

                    // Añadir al objeto de archivo el nombre del servidor
                    file.nombreServidor = response.correcto
                },
                error: function(file, response){
                    // console.log(file)
                    console.log(response)
                    document.querySelector('#error').textContent = 'Formato no válido'
                },
                maxfilesexceeded: function(file){
                    // console.log(file)
                    if(this.files[1] != null){
                        this.removeFile(this.files[0]) // Borrar archivo anterior
                        this.addFile(file) // Agregar el nuevo archivo

                        // Eliminar del DOM
                        file.previewElement.previousElementSibling.remove()
                    }
                },
                removedfile: function(file, response){
                    // console.log('El archivo borrado fue: ', file)

                    // Eliminar imagen previa
                    file.previewElement.parentNode.removeChild(file.previewElement)

                    const params = {
                        imagen: file.nombreServidor
                    }

                    axios.post('/vacantes/borrar-imagen', params)
                        .then(response => console.log(response))
                        .catch(error => console.log(error.response))
                }
            })
        })
    </script>
@endsection
