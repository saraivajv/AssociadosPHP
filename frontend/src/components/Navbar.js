import React from "react";
import { Link } from "react-router-dom";
import "../styles/Navbar.css";

const Navbar = () => {
  return (
    <nav className="navbar">
      <h1 className="navbar-title">Associados DevRN</h1>
      <ul className="navbar-links">
        <li>
          <Link to="/">Cadastrar Associado</Link>
        </li>
        <li>
          <Link to="/pagar-anuidade">Pagar Anuidade</Link>
        </li>
        <li>
          <Link to="/verificar-status">Verificar Status</Link>
        </li>
      </ul>
    </nav>
  );
};

export default Navbar;
