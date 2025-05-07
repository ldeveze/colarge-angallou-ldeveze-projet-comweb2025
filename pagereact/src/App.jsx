import { Routes, Route } from 'react-router-dom';
import Accueil from './pages/Accueil';
import ConnexionEleve from './pages/ConnexionEleve';
import ConnexionProfesseur from './pages/ConnexionProfesseur';
import EspaceEleves from './pages/EspaceEleves';

function App() {
  return (
    <Routes>
      <Route path="/" element={<Accueil />} />
      <Route path="/eleve" element={<ConnexionEleve />} />
      <Route path="/professeur" element={<ConnexionProfesseur />} />
      <Route path="/espace-eleve" element={<EspaceEleves />} />
    </Routes>
  );
}

export default App;
