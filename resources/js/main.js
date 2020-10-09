import { msj_error, msj_warning, msj_success, listenersInputs } from './helpers'

// Elementos del DOM
const actionMsg = document.querySelector('#actionMsg')
const NuevaVacante = document.querySelector('#nueva-vacante')
const ContacarReclutador = document.querySelector('#contactar-reclutador')

document.addEventListener('DOMContentLoaded', () => {
    // Validación formularios
    if(NuevaVacante) listenersInputs([...NuevaVacante.elements])
    if(ContacarReclutador) listenersInputs([...ContacarReclutador.elements])

     // Validar msg
     if(actionMsg) showNotification()
})

// Mostrar mensaje
const showNotification = () => {
    let type = actionMsg.dataset.type.trim()
    let msg = actionMsg.dataset.msg.trim()
    if(type == 'success') msj_success(msg)
    else if(type == 'warning') msj_warning(msg)
    else if(type == 'error') msj_error(msg)
}
