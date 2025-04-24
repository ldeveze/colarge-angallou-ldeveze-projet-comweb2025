import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import { useEffect } from 'react'
import ConnectionAPI from './ConnectionAPI.jsx'


function ChoixCompte() {

  return (
    <>
        <h3>Bonjour. Vous êtes : </h3>
        <p><button>Elève</button></p>
        <p><button>Professeur</button></p>
    </>
  )
}


function ConnectionCompte() {

  return (
    <>
        <p><label>Identifiant : </label>
        <input type="text"/></p>

        <p><label>Mot de passe : </label>
        <input type="text"/></p>

        <p><button>Se connecter</button></p>
    </>
  )
}

function Demande() {

  return (
    <>
        <label>Que voulez-vous récupérer ? </label>
        <input type="text"/>
    </>
  )
}

function App() {


  return (
    <>
      <ChoixCompte/>
    </>
  )
}

export default App
