import { useLocation, useNavigate } from 'react-router-dom';
import '../App.css';

function EspaceProfesseur() {
  const location = useLocation();
  const navigate = useNavigate();
  const identifiant = location.state?.identifiant || 'professeur inconnu';

  const notesDesEleves = [
    { eleve: "Jules Dupont", matiere: "Maths", evaluation: "Contrôle 1", note: "15/20" },
    { eleve: "Sophie Martin", matiere: "Maths", evaluation: "Contrôle 1", note: "12/20" },
    { eleve: "Lucas Bernard", matiere: "Maths", evaluation: "Contrôle 1", note: "18/20" },
    { eleve: "Jules Dupont", matiere: "Maths", evaluation: "Contrôle 2", note: "14/20" },
    { eleve: "Sophie Martin", matiere: "Maths", evaluation: "Contrôle 2", note: "16/20" },
  ];

  return (
    <div className="container">
      <h3>Bonjour {identifiant} 👋</h3>
      <h4>Voici les notes de vos élèves :</h4>

      <table className="notes-table">
        <thead>
          <tr>
            <th>Élève</th>
            <th>Matière</th>
            <th>Évaluation</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
          {notesDesEleves.map((note, index) => (
            <tr key={index}>
              <td>{note.eleve}</td>
              <td>{note.matiere}</td>
              <td>{note.evaluation}</td>
              <td>{note.note}</td>
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
