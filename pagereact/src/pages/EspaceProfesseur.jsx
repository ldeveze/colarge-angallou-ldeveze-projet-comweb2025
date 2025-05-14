import { useLocation, useNavigate } from 'react-router-dom';
import { useEffect, useState } from 'react';
import '../App.css';

function EspaceProfesseur() {
  const location = useLocation();
  const navigate = useNavigate();
  const identifiant = location.state?.identifiant || 'inconnu';
  const idProf = location.state?.idProf;

  const [notes, setNotes] = useState([]);

  useEffect(() => {
    fetch(`https://ldeveze.zzz.bordeaux-inp.fr/api-projet/notesProf.php?idProf=${idProf}`)
      .then(res => res.json())
      .then(data => setNotes(data))
      .catch(err => console.error(err));
  }, [idProf]);

  return (
    <div className="container">
      <h3>Bonjour {identifiant} 👋</h3>
      <h4>Voici les notes de vos élèves :</h4>

      <table className="notes-table">
        <thead>
          <tr>
            <th>Élève</th>
            <th>Classe</th>
            <th>Matière</th>
            <th>Évaluation</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
          {notes.map((n, index) => (
            <tr key={index}>
              <td>{n.prenom} {n.nom}</td>
              <td>{n.classe}</td>
              <td>{n.matiere}</td>
              <td>{n.libelle}</td>
              <td>{n.valeur}/20</td>
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

export default EspaceProfesseur;
