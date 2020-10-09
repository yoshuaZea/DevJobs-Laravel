import React, { useState, useEffect } from 'react'
import ReactDOM from 'react-dom'

import Skill from './Skill'

const ListadoSkills = (props) => {

    // State del componente
    const [skills, setSkills] = useState([])
    const [selected, setSelected] = useState(new Set())

    useEffect(() => {
        setSkills(JSON.parse(props.skills))

        // Verificar si existen ya seleccionados
        if(props.oldSkills){
            const skillsValues = props.oldSkills.split(',')
            skillsValues.forEach(skill => selected.add(skill))
        }
    }, [])

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
        <>
            <ul className="flex flex-wrap justify-center">
                {
                    skills.map((skill, i) => (
                        <Skill 
                            key={i}
                            skill={skill}
                            selected={selected}
                            setSelected={setSelected}
                        />
                        // <li 
                        //     className={`border border-gray-500 px-10 py-3 mb-3 mr-4 rounded cursor-pointer ${verificarCasilla(skill)}`}
                        //     key={`${skill}_${i}`}
                        //     value={skill}
                        //     onClick={(e) => activarSkill(e) }
                        // >{skill}</li>
                    ))
                }
            </ul>
            <input
                type="hidden"
                id="skills"
                name="skills"
                value={[...selected]}
            />
        </>
    )
}
 
export default ListadoSkills

if (document.getElementById('listado-skills')) {
    const component = document.getElementById('listado-skills')
    const props = Object.assign({}, component.dataset)
    ReactDOM.render(<ListadoSkills {...props} />, component)
}
