import { useLocation, useNavigate } from 'react-router-dom';
import '../App.css';

function EspaceEleve() {
  const location = useLocation();
  const navigate = useNavigate();
  const identifiant = location.state?.identifiant || 'inconnu';

  const notes = [
    { matiere: "Maths", prof: "Mme Dupont", evaluation: "Contrôle chapitre 1", note: "15/20" },
    { matiere: "Français", prof: "M. Martin", evaluation: "Rédaction", note: "13/20" },
    { matiere: "Histoire", prof: "Mme Lemoine", evaluation: "Exposé", note: "17/20" },
    { matiere: "SVT", prof: "M. Durand", evaluation: "QCM", note: "14/20" },
  ];

  return (
    <div className="container">
      <h3>Bonjour {identifiant} 👋</h3>
      <h4>Voici vos notes :</h4>

      <table className="notes-table">
        <thead>
          <tr>
            <th>Matière</th>
            <th>Professeur</th>
            <th>Évaluation</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
          {notes.map((n, index) => (
            <tr key={index}>
              <td>{n.matiere}</td>
              <td>{n.prof}</td>
              <td>{n.evaluation}</td>
              <td>{n.note}</td>
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
