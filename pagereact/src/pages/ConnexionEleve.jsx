import { useNavigate } from 'react-router-dom';
import { useState } from 'react';
import '../App.css';

function ConnexionEleve() {
  const navigate = useNavigate();
  const [pseudo, setPseudo] = useState('');
  const [motdepasse, setMotdepasse] = useState('');
  const [erreur, setErreur] = useState('');

  const handleLogin = () => {
    fetch("https://ldeveze.zzz.bordeaux-inp.fr/api-projet/loginEleve.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ pseudo, motdepasse })
    })
      .then(res => res.json())
      .then(data => {
        console.log("Réponse API login :", data);
        if (data.success) {
          navigate('/espace-eleve', { state: { identifiant: pseudo } });
        } else {
          setErreur("Identifiant ou mot de passe incorrect");
        }
      })
      .catch(() => {
        setErreur("Erreur lors de la connexion à l'API");
      });
  };

  return (
    <div className="container">
      <h3>Connexion Élève</h3>

      <label>Identifiant :</label>
      <input
        type="text"
        value={pseudo}
        onChange={(e) => setPseudo(e.target.value)}
      />

      <label>Mot de passe :</label>
      <input
        type="password"
        value={motdepasse}
        onChange={(e) => setMotdepasse(e.target.value)}
      />

      {erreur && <p style={{ color: 'red' }}>{erreur}</p>}

      <button className="button-connexion" onClick={handleLogin}>
        Se connecter
      </button>

      <button className="button-retour" onClick={() => navigate(-1)}>
        Retour
      </button>
    </div>
  );
}

export default ConnexionEleve;
