// src/components/AtualizarAnuidade.js
import React, { useState } from "react";
import API_BASE_URL from "../api";

const AtualizarAnuidade = () => {
  const [ano, setAno] = useState("");
  const [novoValor, setNovoValor] = useState("");
  const [message, setMessage] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch(`${API_BASE_URL}/AnuidadeController.php?action=atualizar`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ ano, valor: novoValor }),
      });
      const data = await response.json();
      if (data.success) {
        setMessage("Anuidade atualizada com sucesso!");
      } else {
        setMessage(`Erro: ${data.error}`);
      }
    } catch (error) {
      setMessage("Erro ao se comunicar com o servidor.");
    }
  };

  return (
    <div>
      <h2>Atualizar Anuidade</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="number"
          placeholder="Ano da Anuidade"
          value={ano}
          onChange={(e) => setAno(e.target.value)}
          required
        />
        <input
          type="number"
          placeholder="Novo Valor"
          value={novoValor}
          onChange={(e) => setNovoValor(e.target.value)}
          required
        />
        <button type="submit">Atualizar</button>
      </form>
      {message && <p>{message}</p>}
    </div>
  );
};

export default AtualizarAnuidade;
