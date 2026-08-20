<div align="center">
  <h1>MARCELLA GONÇALVES - SALÃO DE BELEZA</h1>
</div>

<p align="justify">
  Este projeto consiste na estruturação completa e criação do site institucional para a empresa <strong>Marcella Gonçalves Nails</strong>, localizada em Suzano. O sistema foi desenvolvido para consolidar a marca no mercado local, oferecendo uma plataforma profissional para divulgação de serviços e facilitação de agendamentos.
</p>

<br>

## Descrição do Projeto

<p align="justify">
  O desenvolvimento visa resolver a limitação de visibilidade digital da empresa, criando uma presença online profissional através de um site institucional. O sistema conta com áreas de apresentação, serviços e um sistema de autenticação de usuários para garantir a integridade dos dados.
</p>

<br>

## Equipe de Desenvolvimento

<div align="center">

| INTEGRANTES | FUNÇÃO | REDES SOCIAIS |
| :---: | :---: | :---: |
| **Yara da Silva** | Gerente de Projeto, responsável pelo protótipo e UI/UX, layout, modelagem e estruturação do Banco de Dados e elaboração de diagramas UML | [GitHub](https://github.com/NasSilvaYara) / [LinkedIn](https://www.linkedin.com/in/nassilvayara) |
| **Livia Schendroski** | Desenvolvedora Front-end e Back-end, com participação na elaboração da documentação | [GitHub](#) / [LinkedIn](https://www.linkedin.com/in/livia-de-queiroz-schendroski-606b3926b/) |

</div>

<br>

## Tecnologias Utilizadas

<div align="center">

<p align="justify">
  A infraestrutura tecnológica do sistema é composta pelas seguintes ferramentas:
</p>

![Figma](https://img.shields.io/badge/Figma-%238A2BE2.svg?style=for-the-badge&logo=figma&logoColor=white)&nbsp;
![XAMPP](https://img.shields.io/badge/XAMPP-%23FB7A24.svg?style=for-the-badge&logo=xampp&logoColor=white)&nbsp;
![MySQL](https://img.shields.io/badge/MySQL-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)&nbsp;
![PHP](https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)&nbsp;
![HTML5](https://img.shields.io/badge/HTML5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)&nbsp;
![CSS3](https://img.shields.io/badge/CSS3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)&nbsp;
![JavaScript](https://img.shields.io/badge/JavaScript-%23F7DF1E.svg?style=for-the-badge&logo=javascript&logoColor=black)

</div>

<br>

## Funcionalidades do Sistema

<div align="center">

| FUNCIONALIDADE | DESCRIÇÃO |
| :---: | :--- |
| **Página Institucional** | Apresentação da empresa e identidade visual |
| **Serviços** | Divulgação dos serviços oferecidos |
| **Agendamento** | Facilitação do processo de agendamento |
| **Autenticação** | Sistema de login e controle de usuários |
| **Banco de Dados** | Armazenamento e gerenciamento das informações |
| **Interface Responsiva** | Adaptação para diferentes dispositivos |

</div>

<br>

## Especificações Técnicas e Cronograma

<div align="center">

<p align="justify">
  Em conformidade com o planejamento estratégico detalhado no Termo de Abertura do Projeto (Revisão 01), as definições técnicas e prazos seguem os parâmetros abaixo:
</p>

| PARÂMETRO TÉCNICO | DETALHAMENTO DO PROJETO |
| :---: | :--- |
| **Tecnologia Back-end** | PHP 8.x para processamento de dados e gestão de sessões |
| **Banco de Dados** | MySQL para armazenamento seguro das informações |
| **Protocolo de Segurança** | Implementação de Hash BCRYPT para proteção de senhas |
| **Ambiente de Desenvolvimento** | XAMPP |
| **Prototipação** | Figma |
| **Início do Projeto** | 23 de fevereiro de 2026 |
| **Previsão de Término** | 25 de junho de 2026 |

</div>

<br>

## Guia de Instalação e Execução

<p align="justify">
  Para a correta replicação do ambiente de desenvolvimento e execução do sistema institucional, siga os procedimentos técnicos detalhados abaixo.
</p>

<br>

### 1. Clonagem do Repositório

Direcione o terminal para o diretório <code>htdocs</code> do seu servidor local XAMPP e execute:

<pre><code>git clone https://github.com/NasSilvaYara/marcella_MasterDesign.git</code></pre>

<br>

### 2. Configuração do Ambiente

Após realizar a clonagem, acesse a pasta do projeto:

<pre><code>cd marcella_MasterDesign</code></pre>

Certifique-se de que os módulos <strong>Apache</strong> e <strong>MySQL</strong> estejam ativos no XAMPP.

<br>

### 3. Configuração do Banco de Dados

Acesse o <strong>phpMyAdmin</strong> através do endereço:

<pre><code>http://localhost/phpmyadmin</code></pre>

Crie um banco de dados chamado:

<pre><code>marcella_beauty</code></pre>

<br>

### 4. Configuração da Conexão

Localize o arquivo responsável pela conexão com o banco de dados e configure as credenciais do ambiente local:

<pre><code>// db_config.php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "marcella_beauty";</code></pre>

<br>

### 5. Importação do Banco de Dados

No <strong>phpMyAdmin</strong>, selecione o banco de dados <code>marcella_beauty</code> e importe o arquivo:

<pre><code>/database/marcella_beauty.sql</code></pre>

<br>

### 6. Inicialização do Sistema

Com os módulos <strong>Apache</strong> e <strong>MySQL</strong> ativos, acesse:

<pre><code>http://localhost/marcella_beauty</code></pre>

<br>

## Estrutura do Projeto

<pre><code>marcella_MasterDesign/
│
├── database/
│   └── marcella_beauty.sql
│
├── css/
│   └── ...
│
├── js/
│   └── ...
│
├── img/
│   └── ...
│
├── pages/
│   └── ...
│
├── db_config.php
├── index.php
└── README.md</code></pre>

<br>

## Segurança

<p align="justify">
  O sistema utiliza o algoritmo de hash <strong>BCRYPT</strong> para proteção das senhas dos usuários, evitando o armazenamento de credenciais em texto puro no banco de dados.
</p>

<br>

## Objetivos do Projeto

- Desenvolver uma presença digital profissional para a empresa.
- Apresentar os serviços oferecidos pelo salão.
- Facilitar o acesso às informações da empresa.
- Implementar um sistema de autenticação de usuários.
- Aplicar conceitos de desenvolvimento Front-end e Back-end.
- Trabalhar com banco de dados relacional.
- Aplicar conceitos de UI/UX e prototipação.
- Organizar e documentar o desenvolvimento do sistema.

<br>

## Formação Acadêmica

<div align="center">

| INFORMAÇÃO | DETALHAMENTO |
| :---: | :--- |
| **Curso** | Desenvolvimento de Software Multiplataforma |
| **Instituição** | FATEC Itaquera |
| **Tipo de Projeto** | Projeto Interdisciplinar |
| **2° Semestre** | 2026 |

</div>

<br>

<p align="center">
  <i>Projeto desenvolvido com base nas diretrizes estabelecidas no Termo de Abertura do Projeto.</i>
</p>
