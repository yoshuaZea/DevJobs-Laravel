import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'
import axios from 'axios'

const EstadoVacante = (props) => {

    const { id } = props

    // State del component
    const [estado, setEstado] = useState(Number(props.estado))
    const [actualizar, setActualizar] = useState(false)

    useEffect( () => {
        // Actualizar solo cuando sea true
        if(actualizar)
            actualizarEstado()
    }, [estado])

    // Funciones
    const handleChange = async e => {
        if(estado == 1){
            e.target.classList.remove('bg-green-100', 'text-green-800')
            e.target.classList.add('bg-red-100', 'text-red-800')
            e.target.textContent = 'Inactiva'
            setEstado(0)
        } else {
            e.target.classList.add('bg-green-100', 'text-green-800')
            e.target.classList.remove('bg-red-100', 'text-red-800')
            e.target.textContent = 'Activa'
            setEstado(1)
        }

         // Cambiar status de actualizar
         setActualizar(true)
    }

    // Actualizar en BD
    const actualizarEstado = async () => {
        // Params
        const params = {
            estado
        }

        // Enviar a axios
        await axios.post(`/vacantes/${id}`, params)
            .then(response => console.log(response.data))
            .catch(error => console.log(error.response.data))

        // Cambiar status de actualizar
        setActualizar(false)
    }

    return (
        <span
            className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full cursor-pointer ${estado == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`}
            onClick={ (e) => handleChange(e) }
        >{ estado == 1 ? 'Activa' : 'Inactiva'}</span>
    )
}

export default EstadoVacante

// Extraer todos los ID similares
const elements = [...document.querySelectorAll('[id^=EstadoVacante_]')]

if (elements) {
    elements.forEach(element => {
        const component = document.getElementById(element.id)
        const props = Object.assign({}, component.dataset)
        ReactDOM.render(<EstadoVacante {...props} />, component);
    })
}
