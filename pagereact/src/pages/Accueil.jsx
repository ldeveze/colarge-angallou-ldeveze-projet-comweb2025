import { useNavigate } from 'react-router-dom';
import '../App.css';

function Accueil() {
  const navigate = useNavigate();

  return (
    <div className="container">
      <h3>Bonjour. Vous êtes :</h3>
      <button className="button-eleve" onClick={() => navigate('/eleve')}>Élève</button>
      <button className="button-prof" onClick={() => navigate('/professeur')}>Professeur</button>
    </div>
  );
}

export default Accueil;
