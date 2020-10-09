import Swal from 'sweetalert2'

export const in_array = (needle, haystack) => {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

export  const ShowMessageLoading = () => {
    $(".text-loader").remove();
    let load = $("#contenedor_carga");
    load.append("<h5 class='text-loader' style='width: 200px; text-align: center'>Guardando datos por favor espera...</h5>");
    load.css("visibility","");
    load.css("opacity","");
    window.addEventListener('focus', HideMessageLoading, false);
}

export const HideMessageLoading = () => {
    window.removeEventListener('focus', HideMessageLoading, false);                   
    let contenedor = $("#contenedor_carga");
    contenedor.css("visibility","hidden");
    contenedor.css("opacity","0");
}

export const msj_error = (msj) => {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: msj,
        confirmButtonColor: '#dc3545',
    });
}

export const msj_success = (msj) => {
    Swal.fire({
        position: 'center',
        icon: 'success',
        html: msj,
        confirmButtonColor: '#AED36C'
        // showConfirmButton: false,
        // timer: 2500
    });
}

export const msj_warning = (msj) => {
    Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        html: msj,
        confirmButtonColor: '#ffc107',
    });
}

export const validarForm = (array) => {
    //Variables para mensaje de error
    let div = document.createElement('div')
    div.setAttribute("id", "msj-error")
    div.classList.add('alerta')
    let error = document.querySelector('#msj-error')

    //Tipo de mensajes por defualt
    let Mensaje1 = 'Ingresa el valor solicitado.',
        Mensaje2 = 'Selecciona una opción.',
        Mensaje3 = 'Selecciona un archivo.'

    for (let elem of array) {
        //Si contiene la clase required
        if(elem.classList.contains('required')){
            //Elimina el mensaje de error
            if (error !== null) error.remove()
            elem.classList.remove('no-valido')
            elem.parentElement.classList.remove('no-valido')

            // Eliminar clase a trixeditor
            if(document.querySelector(`[input="${elem.name}"]`))
                document.querySelector(`[input="${elem.name}"]`).classList.remove('no-valido')
    
            if (elem.nodeName == "INPUT" && elem.value == "" && elem.type !== "file") {
                // Validar si es trixeditor
                if(document.querySelector(`[input="${elem.name}"]`)){
                    const trix = document.querySelector(`[input="${elem.name}"]`)
                    div.innerHTML = Mensaje1
                    trix.parentElement.parentElement.appendChild(div)
                    trix.classList.add('no-valido')
                    trix.focus()
                    return false
                } else {
                    div.innerHTML = Mensaje1
                    elem.parentElement.parentElement.appendChild(div)
                    elem.classList.add('no-valido')
                    elem.focus()
                    return false
                }
            } else if (elem.nodeName == "SELECT" && elem.selectedIndex === 0) {
                div.innerHTML = Mensaje2
                elem.parentElement.parentElement.appendChild(div)
                elem.parentElement.classList.add('no-valido')
                elem.focus()
                return false
            } else if (elem.nodeName == "TEXTAREA" && elem.value == "") {
                div.innerHTML = Mensaje1
                elem.parentElement.parentElement.appendChild(div)
                elem.classList.add('no-valido')
                elem.focus()
                return false
            } else if (elem.type == "file" && elem.value == "" && elem.files.length == 0) {
                div.innerHTML = Mensaje3;
                elem.parentElement.parentElement.appendChild(div);
                elem.classList.add('no-valido');
                elem.focus();
                return false;
            }
        }
    }

    return true
}

// Listener a los inputs
export const listenersInputs = inputs => {
    inputs.forEach(input => {
        if(input.classList.contains('required')){
            input.addEventListener('blur', (e) => validarInput(e))
        }
    })

    inputs.forEach(input => {
        if(input.classList.contains('required')){
            input.addEventListener('input', (e) => validarInput(e))
        }
    })
}

const validarInput = (e) => {
    const estado = ['valido', 'no-valido', 'border-red-500', 'border']
    let clase
    
    if(e.target.value != "" && e.target.value.length != 0 && e.target.selectedIndex != 0) {
        clase = estado[0]
    } else {
        clase = estado[1]
    }

    // Eliminar clases previas
    e.target.classList.remove(...estado)
    e.target.classList.add(clase)
    
    // Agregar de acuerdo a la condición
    if(clase == 'no-valido')
        e.target.classList.add('border-red-500', 'border')
    else 
        e.target.classList.add(clase)

    // inyectar dinamicamente el div con el error
    if ( clase === 'no-valido') {
        if(e.target.nextElementSibling === null) {
            // construir un mensaje de error
            const errorDiv = document.createElement('div')
            errorDiv.appendChild( document.createTextNode('Este campo es obligatorio') )
            errorDiv.classList.add('bg-red-100', 'border-l-4', 'border', 'border-red-500', 'text-red-700', 'px-4', 'py-2', 'w-full', 'mt-3', 'text-sm')
            // insertar el error
            e.target.parentElement.insertBefore(errorDiv, e.target.nextElementSibling )
        }
    } else {
        // limpiar el mensaje de error si existe
        if(e.target.nextElementSibling !== null) {
            e.target.nextElementSibling.remove()
        }
    }
}

// Solo número
export const input_numerico = element => {
    const input = document.querySelector(element)
    input.addEventListener('keyup', () => {
        let datos = input.value.replace(/\D/g, "")
        input.value = datos
        input.focus()
    })
}

// Solo dinero
export const input_dinero = element => {
    const input = document.querySelector(element)
    input.addEventListener('keyup', (element) => {
        let datos = element.target.value.replace(/\D/g, "")
                                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        element.target.value = datos;
        element.target.focus();
    })
}

// Ordernamiento de array object
Array.prototype.orderBy = function (field, type = 'asc') {
    if(type == 'asc'){
        this.sort((a,b) => {
            if(a[field] < b[field]) return -1
            if(a[field] > b[field]) return 1
            return 0
        })
    } else if(type == 'desc') {
        this.sort((a,b) => {
            if(a[field] > b[field]) return -1
            if(a[field] < b[field]) return 1
            return 0
        })
    }
}

export const spinner = document.createElement('div')
spinner.classList.add('sk-chase-relative', 'sk-sm')
spinner.innerHTML = `<div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>
                    <div class="sk-chase-dot"></div>`

export const spinnerText = `<div class="sk-chase-relative">
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                                <div class="sk-chase-dot"></div>
                            </div>`