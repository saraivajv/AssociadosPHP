// src/components/CadastroAnuidade.js
import React, { useState } from "react";
import API_BASE_URL from "../api";

const CadastroAnuidade = () => {
  const [ano, setAno] = useState("");
  const [valor, setValor] = useState("");
  const [message, setMessage] = useState("");

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch(`${API_BASE_URL}/AnuidadeController.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ ano, valor }),
      });
      const data = await response.json();
      if (data.success) {
        setMessage("Anuidade cadastrada com sucesso!");
      } else {
        setMessage(`Erro: ${data.error}`);
      }
    } catch (error) {
      setMessage("Erro ao se comunicar com o servidor.");
    }
  };

  return (
    <div>
      <h2>Cadastrar Anuidade</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="number"
          placeholder="Ano"
          value={ano}
          onChange={(e) => setAno(e.target.value)}
          required
        />
        <input
          type="number"
          placeholder="Valor"
          value={valor}
          onChange={(e) => setValor(e.target.value)}
          required
        />
        <button type="submit">Cadastrar</button>
      </form>
      {message && <p>{message}</p>}
    </div>
  );
};

export default CadastroAnuidade;
