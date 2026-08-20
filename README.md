<div align="center">
  <h1>MARCELLA GONÇALVES - SALÃO DE BELEZA</h1>
</div>

<p align="justify">
  Este projeto consiste no desenvolvimento de um sistema web institucional para a empresa <strong>Marcella Gonçalves Nails</strong>, localizada em Suzano. A aplicação foi desenvolvida com o objetivo de fortalecer a presença digital da empresa, apresentar seus serviços e disponibilizar recursos para gerenciamento de clientes, agendamentos e informações administrativas.
</p>

<br>

## Descrição do Projeto

<p align="justify">
  O sistema foi desenvolvido como uma solução web para centralizar as informações e funcionalidades relacionadas ao atendimento da empresa. A aplicação possui áreas destinadas aos clientes e à administração, permitindo o gerenciamento de agendamentos, consultas de informações e organização dos dados do sistema.
</p>

<br>

## Estrutura do Sistema

<div align="center">

| ÁREA | DESCRIÇÃO |
| :---: | :--- |
| **Área Administrativa** | Gerenciamento das funcionalidades administrativas do sistema |
| **Agenda** | Organização e gerenciamento da agenda de atendimentos |
| **Agendamentos** | Controle dos agendamentos realizados pelos clientes |
| **Relatórios** | Consulta e organização de informações administrativas |
| **Área do Cliente** | Acesso às funcionalidades destinadas aos usuários |
| **Autenticação** | Controle de acesso e autenticação de usuários |
| **Galeria** | Organização e apresentação das imagens do estabelecimento |
| **Card Fotos** | Gerenciamento dos conteúdos visuais |
| **Banco de Dados** | Persistência e gerenciamento das informações da aplicação |

</div>

<br>

## Equipe de Desenvolvimento

<div align="center">

| INTEGRANTES | FUNÇÃO | REDES SOCIAIS |
| :---: | :---: | :---: |
| **Yara da Silva** | Gerente de Projeto, responsável pelo protótipo, UI/UX, layout, modelagem e estruturação do Banco de Dados e elaboração de diagramas UML | [GitHub](https://github.com/NasSilvaYara) / [LinkedIn](https://www.linkedin.com/in/nassilvayara) |
| **Livia Schendroski** | Desenvolvedora Front-end e Back-end, com participação na elaboração da documentação | [GitHub](https://www.linkedin.com/in/schendroski) / [LinkedIn](https://www.linkedin.com/in/livia-de-queiroz-schendroski-606b3926b/) |

</div>

<br>

## Tecnologias Utilizadas

<div align="center">

<p align="justify">
  A aplicação utiliza tecnologias voltadas ao desenvolvimento web, gerenciamento de dados, autenticação e execução do ambiente da aplicação.
</p>

![Figma](https://img.shields.io/badge/Figma-%238A2BE2.svg?style=for-the-badge&logo=figma&logoColor=white)&nbsp;
![PHP](https://img.shields.io/badge/PHP-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)&nbsp;
![MySQL](https://img.shields.io/badge/MySQL-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)&nbsp;
![HTML5](https://img.shields.io/badge/HTML5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)&nbsp;
![CSS3](https://img.shields.io/badge/CSS3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)&nbsp;
![JavaScript](https://img.shields.io/badge/JavaScript-%23F7DF1E.svg?style=for-the-badge&logo=javascript&logoColor=black)&nbsp;
![Docker](https://img.shields.io/badge/Docker-%232496ED.svg?style=for-the-badge&logo=docker&logoColor=white)&nbsp;
![Git](https://img.shields.io/badge/Git-%23F05032.svg?style=for-the-badge&logo=git&logoColor=white)

</div>

<br>

## Funcionalidades

<div align="center">

| FUNCIONALIDADE | DESCRIÇÃO |
| :---: | :--- |
| **Página Institucional** | Apresentação da empresa e de seus serviços |
| **Autenticação de Usuários** | Controle de acesso às áreas do sistema |
| **Área do Cliente** | Acesso às funcionalidades destinadas aos clientes |
| **Área Administrativa** | Gerenciamento das informações e funcionalidades administrativas |
| **Agenda** | Organização dos horários e atendimentos |
| **Agendamentos** | Gerenciamento dos agendamentos realizados |
| **Relatórios** | Consulta e acompanhamento das informações do sistema |
| **Galeria** | Apresentação de imagens e conteúdos visuais |
| **Banco de Dados** | Armazenamento das informações da aplicação |

</div>

<br>

## Estrutura de Diretórios

<pre><code>marcella-MasterDesign-main/
│
├── admin/
│   ├── api/
│   │   ├── agenda/
│   │   ├── agendamentos/
│   │   └── relatorios/
│   └── painelAdmin.php
│
├── cardFotos/
│
├── config/
│   └── db_config.php
│
├── galeria/
│
├── usuario/
│   ├── api/
│   ├── auth/
│   └── painelClient.php
│
├── Dockerfile
├── index.php
├── LICENSE
├── logo.png
├── marcella.mp4
└── README.md</code></pre>

<br>

## Banco de Dados

<p align="justify">
  O sistema utiliza um banco de dados MySQL remoto para armazenamento das informações da aplicação. A conexão é realizada através do arquivo de configuração localizado em <code>config/db_config.php</code>.
</p>

<p align="justify">
  Por questões de segurança, as credenciais de acesso ao banco de dados não são disponibilizadas neste documento.
</p>

<br>

## Configuração do Ambiente

<p align="justify">
  Para executar o projeto, é necessário configurar as credenciais do banco de dados no ambiente de execução da aplicação. O arquivo responsável pela conexão encontra-se em:
</p>

<pre><code>config/db_config.php</code></pre>

<p align="justify">
  As informações de conexão devem ser configuradas de acordo com o ambiente utilizado para hospedagem da aplicação.
</p>

<br>

## Configuração do Banco de Dados

<p align="justify">
  A aplicação utiliza conexão PDO para comunicação com o banco de dados MySQL. O arquivo de configuração estabelece a conexão utilizando as credenciais definidas no ambiente.
</p>

<pre><code>&lt;?php

$host    = "SEU_HOST";
$db      = "SEU_BANCO";
$user    = "SEU_USUARIO";
$pass    = "SUA_SENHA";
$charset = "utf8mb4";

$pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=$charset",
    $user,
    $pass
);</code></pre>

<p align="justify">
  <strong>Importante:</strong> não publique credenciais reais de banco de dados no GitHub. Utilize variáveis de ambiente ou outro mecanismo seguro de configuração.
</p>

<br>

## Área Administrativa

<p align="justify">
  A área administrativa está localizada no diretório <code>admin/</code> e concentra os recursos destinados ao gerenciamento do sistema.
</p>

<pre><code>admin/
├── api/
│   ├── agenda/
│   ├── agendamentos/
│   └── relatorios/
│
└── painelAdmin.php</code></pre>

<p align="justify">
  As APIs são organizadas por funcionalidade, permitindo a separação dos recursos relacionados à agenda, aos agendamentos e aos relatórios.
</p>

<br>

## Área do Cliente

<p align="justify">
  As funcionalidades destinadas aos clientes estão organizadas no diretório <code>usuario/</code>.
</p>

<pre><code>usuario/
├── api/
├── auth/
└── painelClient.php</code></pre>

<p align="justify">
  Essa estrutura concentra os recursos relacionados à autenticação, às APIs utilizadas pela área do usuário e ao painel do cliente.
</p>

<br>

## Segurança

<p align="justify">
  O sistema utiliza conexão PDO com o banco de dados e possui mecanismos de autenticação para controle de acesso às áreas administrativas e de clientes.
</p>

<p align="justify">
  As credenciais do banco de dados e informações sensíveis de acesso não devem ser armazenadas diretamente no código versionado. Para ambientes de produção, recomenda-se utilizar variáveis de ambiente e arquivos de configuração protegidos.
</p>

<br>

## E-mail Administrativo

<p align="justify">
  O sistema possui um endereço de e-mail administrativo utilizado para operações relacionadas à administração da aplicação.
</p>

<p align="center">
  <strong>golcalvesmarcella@gmail.com</strong>
</p>

<br>

## Docker

<p align="justify">
  O projeto possui um <code>Dockerfile</code>, permitindo a configuração de um ambiente de execução baseado em containers.
</p>

<p align="justify">
  A utilização do Docker facilita a padronização do ambiente e a replicação da aplicação em diferentes sistemas.
</p>

<br>

## Licença

<p align="justify">
  Este projeto possui um arquivo <code>LICENSE</code> na raiz do repositório, contendo as condições de utilização e distribuição do projeto.
</p>

<br>

## Formação Acadêmica

<div align="center">

| INFORMAÇÃO | DETALHAMENTO |
| :---: | :--- |
| **Curso** | Desenvolvimento de Software Multiplataforma |
| **Instituição** | FATEC Itaquera |
| **Tipo de Projeto** | Projeto Interdisciplinar |
| **Semestre** | 2° Semestre |

</div>

<br>

<p align="center">
  <i>Projeto desenvolvido com base nas diretrizes estabelecidas no Termo de Abertura do Projeto.</i>
</p>
