import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import Navbar from "./components/Navbar";
import CadastroAssociado from "./components/CadastroAssociado";
import PagarAnuidade from "./components/PagarAnuidade";
import VerificarStatus from "./components/VerificarStatus";
import "./styles/App.css"; // Importa os estilos globais

function App() {
  return (
    <Router>
      <Navbar />
      <div className="container">
        <Routes>
          <Route path="/" element={<CadastroAssociado />} />
          <Route path="/pagar-anuidade" element={<PagarAnuidade />} />
          <Route path="/verificar-status" element={<VerificarStatus />} />
        </Routes>
      </div>
    </Router>
  );
}

export default App;
