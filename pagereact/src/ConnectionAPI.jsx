import { useState } from 'react'
import { useEffect } from 'react'

function Bouton(Props) {

  return (
    <>
        <button onClick={Props.onClick}>Récupérer la note</button>
    </>
  )
}

function Texte(Props) {

  return (
    <>
        <label>{Props.nom}</label>
    </>
  )
}

function Image(Props) {

  return (
    <>
        <img src={Props.lien}></img>
    </>
  )
}

function ConnectionAPI() {

  const [data, setData] = useState(
    {name:"", sprites:{front_default:null}}
  );
  
  function cliquer() {
    const min = 1
    const max = 600
    const x = Math.floor(Math.random() * (max - min + 1) + min)
        fetch(`https://pokeapi.co/api/v2/pokemon/${x}`)
          .then(r => r.json())
          .then(datas => {setData(datas)})
  }
  useEffect(cliquer,[ ])
  

  return (
    <>
      <Bouton onClick={cliquer} />
      <div><Texte nom={data.name}/></div>
      <Image lien={data.sprites.front_default}/>
    </>
  )
}

export default ConnectionAPI
