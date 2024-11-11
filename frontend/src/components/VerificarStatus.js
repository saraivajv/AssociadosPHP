// src/components/VerificarStatus.js
import React, { useState } from "react";
import API_BASE_URL from "../api";

const VerificarStatus = () => {
  const [associadoId, setAssociadoId] = useState("");
  const [status, setStatus] = useState(""); // Alteração para armazenar uma mensagem de status

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await fetch(`${API_BASE_URL}/AssociadoController.php?associado_id=${associadoId}`, {
        method: "GET",
      });
      const data = await res.json();

      // Processa a resposta para mostrar uma mensagem amigável
      if (data.status) {
        setStatus(`Status do pagamento: ${data.status}`);
      } else if (data.error) {
        setStatus(`Erro: ${data.error}`);
      } else {
        setStatus("Resposta inesperada do servidor.");
      }
    } catch (error) {
      console.error("Erro ao verificar status:", error);
      setStatus("Erro ao se comunicar com o servidor.");
    }
  };

  return (
    <div>
      <h2>Verificar Status do Pagamento</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="ID do Associado"
          value={associadoId}
          onChange={(e) => setAssociadoId(e.target.value)}
        />
        <button type="submit">Verificar Status</button>
      </form>
      {status && <p>{status}</p>}
    </div>
  );
};

export default VerificarStatus;
