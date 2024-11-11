# Gerenciamento de Associados DevRN

Este projeto é um sistema de gerenciamento de associados e anuidades desenvolvido em PHP (backend) e React (frontend). O backend é responsável por lidar com a lógica de negócio e o banco de dados, enquanto o frontend fornece uma interface amigável para interação com os usuários.

## Estrutura do Projeto

```
project-root/
├── api/                      # Backend em PHP puro
│   ├── controller/           # Controladores das rotas
│   ├── models/               # Modelos de dados
│   ├── service/              # Serviços de negócio
│   ├── lib/                  # Configurações do banco de dados
├── frontend/                 # Frontend em React
│   ├── src/
│   │   ├── components/       # Componentes React
│   │   ├── styles/           # Estilos CSS
│   │   └── App.js            # Componente principal do frontend
│   └── public/               # Arquivos estáticos
└── README.md                 # Documentação do projeto
```

## Funcionalidades

### Backend (PHP)

1. **Cadastrar Associado** - Permite o cadastro de novos associados com informações como nome, email, CPF e data de filiação.
2. **Pagar Anuidade** - Permite que um associado pague uma anuidade específica.
3. **Verificar Status de Pagamento** - Verifica se o associado está em dia ou em atraso com as anuidades.

### Frontend (React)

1. **Navbar** - Contém links para navegar entre as funcionalidades do sistema.
2. **Formulário de Cadastro** - Formulário para cadastrar novos associados.
3. **Pagamento de Anuidade** - Interface para o pagamento de anuidades pendentes.
4. **Verificação de Status** - Exibe o status atual do pagamento das anuidades do associado.

## Pré-requisitos

- **PHP** (com extensão PDO para PostgreSQL)
- **PostgreSQL** (para o banco de dados)
- **Node.js** e **npm** (para o frontend em React)

## Configuração do Projeto

### Backend

1. Clone o repositório:
   ``` git clone https://github.com/seu-usuario/seu-repositorio.git ```

2. Configure o banco de dados PostgreSQL:
   - Crie um banco de dados PostgreSQL e ajuste as configurações de conexão no arquivo *api/lib/db.php*.

3. Importe o SQL de criação de tabelas:
   ```
   -- Exemplo do script SQL para criar tabelas:
   CREATE TABLE associados (
       id SERIAL PRIMARY KEY,
       nome VARCHAR(100) NOT NULL,
       email VARCHAR(100) NOT NULL,
       cpf CHAR(11) NOT NULL UNIQUE,
       data_filiacao DATE NOT NULL
   );

   CREATE TABLE anuidades (
       id SERIAL PRIMARY KEY,
       ano INT NOT NULL,
       valor DECIMAL(10, 2) NOT NULL
   );

   CREATE TABLE pagamentos (
       id SERIAL PRIMARY KEY,
       associado_id INT NOT NULL REFERENCES associados(id),
       anuidade_id INT NOT NULL REFERENCES anuidades(id),
       pago BOOLEAN DEFAULT FALSE
   );
   ```

4. Inicie o servidor PHP no diretório *api*:
   ``` php -S localhost:8000 ```

### Frontend

1. Navegue até o diretório *frontend* e instale as dependências:
   ``` cd frontend ```
   ``` npm install ```

2. Inicie o servidor de desenvolvimento do React:
   ``` npm start ```

3. Acesse a aplicação no navegador em *http://localhost:3000*.

## Uso

1. **Cadastrar Associado** - Use o formulário para cadastrar um novo associado no sistema.
2. **Pagar Anuidade** - Navegue até a página de pagamento para quitar anuidades pendentes.
3. **Verificar Status** - Na página de status, consulte se o associado está em dia com as anuidades.

## Tecnologias Utilizadas

- **PHP** - Backend e API
- **PostgreSQL** - Banco de dados relacional
- **React** - Frontend
- **React Router** - Navegação entre páginas no frontend

## Contribuição

Sinta-se à vontade para contribuir com o projeto. Para isso:

1. Faça um fork do repositório.
2. Crie uma nova branch para sua funcionalidade (``` git checkout -b feature/nova-funcionalidade ```).
3. Commit suas alterações (``` git commit -am 'Adiciona nova funcionalidade' ```).
4. Push para a branch (``` git push origin feature/nova-funcionalidade ```).
5. Abra um Pull Request.

---

Projeto desenvolvido para desafio de seleção da Tecnotech
