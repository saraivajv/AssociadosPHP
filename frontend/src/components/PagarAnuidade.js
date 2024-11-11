// src/components/PagarAnuidade.js
import React, { useState } from "react";
import API_BASE_URL from "../api";

const PagarAnuidade = () => {
  const [associadoId, setAssociadoId] = useState("");
  const [anuidadeId, setAnuidadeId] = useState("");
  const [message, setMessage] = useState(""); // Alteração para armazenar uma mensagem

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await fetch(`${API_BASE_URL}/AssociadoController.php?action=pagarAnuidade`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ associado_id: associadoId, anuidade_id: anuidadeId }),
      });
      const data = await res.json();

      // Processa a resposta para mostrar uma mensagem amigável
      if (data.success) {
        setMessage("Anuidade paga com sucesso!");
      } else if (data.error) {
        setMessage(`Erro: ${data.error}`);
      } else {
        setMessage("Resposta inesperada do servidor.");
      }
    } catch (error) {
      console.error("Erro ao pagar anuidade:", error);
      setMessage("Erro ao se comunicar com o servidor.");
    }
  };

  return (
    <div>
      <h2>Pagar Anuidade</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          placeholder="ID do Associado"
          value={associadoId}
          onChange={(e) => setAssociadoId(e.target.value)}
        />
        <input
          type="text"
          placeholder="ID da Anuidade"
          value={anuidadeId}
          onChange={(e) => setAnuidadeId(e.target.value)}
        />
        <button type="submit">Pagar Anuidade</button>
      </form>
      {message && <p>{message}</p>}
    </div>
  );
};

export default PagarAnuidade;
