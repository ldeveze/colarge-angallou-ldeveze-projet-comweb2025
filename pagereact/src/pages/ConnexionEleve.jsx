import { useNavigate } from 'react-router-dom';
import '../App.css';

function ConnexionEleve() {
  const navigate = useNavigate();

  return (
    <div className="container">
      <h3>Connexion Élève</h3>

      <label>Identifiant :</label>
      <input type="text" />

      <label>Mot de passe :</label>
      <input type="password" />
      
      <button
        className="button-connexion"
        onClick={() => navigate('/espace-eleve', { state: { identifiant: 'jules_dupont' } })}
      >
        Se connecter
      </button>
      <button className="button-retour" onClick={() => navigate(-1)}>Retour</button>
    </div>
  );
}

export default ConnexionEleve;
