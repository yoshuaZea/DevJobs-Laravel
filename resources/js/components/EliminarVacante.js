import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import Swal from 'sweetalert2'
import axios from 'axios'

const EliminarVacante = (props) => {

    const { id } = props

    // Funciones
    const handleChange = e => {
        // Elemento
        const elemento = e.target

        Swal.fire({
            title: '¿Deseas eliminar esta vacante?',
            text: "Una vacante eliminada no se puede recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#38b2ac',
            cancelButtonColor: '#e53e3e',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'No',
          }).then(async (result) => {
            if (result.isConfirmed) {

                const params = {
                    id,
                    _method: 'delete'
                }

                // Enviar a axios
                await axios.post(`/vacantes/${id}`, params)
                    .then(response => {
                        // console.log(response)
                        Swal.fire({
                            title: 'Eliminado!',
                            text: response.data.msg,
                            icon: 'success',
                            confirmButtonColor: '#a6dc86'
                        })

                        // Eliminar del DOM
                        elemento.parentNode.parentNode.parentNode.parentNode.removeChild(elemento.parentNode.parentNode.parentNode)
                    })
                    .catch(error => console.log(error.response))

            }
          })
    }

    return (
        <button
            type="button"
            className="text-red-600 hover:text-red-900  mr-5"
            onClick={(e) => handleChange(e) }
        >Eliminar</button>
    )
}

export default EliminarVacante

// Extraer todos los ID similares
const elements = [...document.querySelectorAll('[id^=EliminarVacante_]')]

if (elements) {
    elements.forEach(element => {
        const component = document.getElementById(element.id)
        const props = Object.assign({}, component.dataset)
        ReactDOM.render(<EliminarVacante {...props} />, component);
    })
}
