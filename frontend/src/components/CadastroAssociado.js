import React, { useState } from "react";
import API_BASE_URL from "../api";

const CadastroAssociado = () => {
  const [formData, setFormData] = useState({
    nome: "",
    email: "",
    cpf: "",
    data_filiacao: "",
  });
  const [message, setMessage] = useState(""); // Alteração para armazenar uma mensagem

  const handleChange = (e) => {
    const { name, value } = e.target;
    if (name === "data_filiacao") {
      const formattedDate = new Date(value).toISOString().split("T")[0];
      setFormData({ ...formData, [name]: formattedDate });
    } else {
      setFormData({ ...formData, [name]: value });
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const res = await fetch(`${API_BASE_URL}/AssociadoController.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      });
      const data = await res.json();

      // Processa a resposta para mostrar uma mensagem amigável
      if (data.success) {
        setMessage("Associado cadastrado com sucesso!");
      } else if (data.error) {
        setMessage(`Erro: ${data.error}`);
      } else {
        setMessage("Resposta inesperada do servidor.");
      }
    } catch (error) {
      console.error("Erro ao cadastrar associado:", error);
      setMessage("Erro ao se comunicar com o servidor.");
    }
  };

  return (
    <div>
      <h2>Cadastrar Associado</h2>
      <form onSubmit={handleSubmit}>
        <input
          type="text"
          name="nome"
          placeholder="Nome"
          value={formData.nome}
          onChange={handleChange}
        />
        <input
          type="email"
          name="email"
          placeholder="Email"
          value={formData.email}
          onChange={handleChange}
        />
        <input
          type="text"
          name="cpf"
          placeholder="CPF"
          value={formData.cpf}
          onChange={handleChange}
        />
        <input
          type="date"
          name="data_filiacao"
          placeholder="Data de Filiação"
          value={formData.data_filiacao}
          onChange={handleChange}
        />
        <button type="submit">Cadastrar</button>
      </form>
      {message && <p>{message}</p>}
    </div>
  );
};

export default CadastroAssociado;
