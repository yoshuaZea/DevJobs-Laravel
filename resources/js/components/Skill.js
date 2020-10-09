import React, { useState } from 'react'

const Skill = ({skill, selected, setSelected}) => {

    // Métodos
    const activarSkill = e => {
        // console.log('Diste click', e.target.textContent)
        if(e.target.classList.contains('bg-teal-400')){
            // Quitar clase
            e.target.classList.remove('bg-teal-400')
            
            // Eliminar skills del set
            const newSelected = new Set(selected)
            newSelected.delete(e.target.textContent)
            setSelected(newSelected)
        } else {
            // Agregar clase
            e.target.classList.add('bg-teal-400')
            // Agregar skill al set
            setSelected(new Set(selected).add(e.target.textContent))
        }   
    }

    // Verificar si existe marca y cambiar color
    const verificarCasilla = skill => selected.has(skill) ? 'bg-teal-400' : ''

    return ( 
        <li 
            className={`border border-gray-500 px-10 py-3 mb-3 mr-4 rounded cursor-pointer ${verificarCasilla(skill)}`}
            value={skill}
            onClick={(e) => activarSkill(e) }
        >{skill}</li>
    )
}
 
export default Skill;