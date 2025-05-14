import { useLocation, useNavigate } from 'react-router-dom';
import { useEffect, useState } from 'react';
import '../App.css';

function EspaceEleve() {
  const location = useLocation();
  const navigate = useNavigate();
  const identifiant = location.state?.identifiant || 'inconnu';

  const [notes, setNotes] = useState([]);

  useEffect(() => {
    fetch(`https://ldeveze.zzz.bordeaux-inp.fr/api-projet/notesEleve.php?pseudo=${identifiant}`)
      .then((res) => res.json())
      .then((data) => setNotes(data))
      .catch((err) => console.error(err));
  }, [identifiant]);

  return (
    <div className="container">
      <h3>Bonjour {identifiant} 👋</h3>
      <h4>Voici vos notes :</h4>

      <table className="notes-table">
        <thead>
          <tr>
            <th>Matière</th>
            <th>Évaluation</th>
            <th>Note</th>
            <th>Professeur</th>
          </tr>
        </thead>
        <tbody>
          {notes.map((n, index) => (
            <tr key={index}>
              <td>{n.matiere}</td>
              <td>{n.libelle}</td>
              <td>{n.valeur}/20</td>
              <td>{n.professeur}</td>
            </tr>
          ))}
        </tbody>
      </table>

      <div style={{ marginTop: '30px', textAlign: 'center' }}>
        <button className="button-deconnexion" onClick={() => navigate('/')}>
          Déconnexion
        </button>
      </div>
    </div>
  );
}

export default EspaceEleve;
