<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Área do Cliente | Marcella Beauty</title>
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/fontawesome/css/all.min.css">
    <style>
        :root {
            --agendador-gradient: linear-gradient(225deg, #ffa361e7 0%, #fd977eea 15%, #fd9585e8 50%, #FAA7D5 97%);
            --primaria-tom: #fd9585;
            --primaria-escura: #e05f68;
            --texto: #2A1E17;
            --texto-suave: #5C4A3E;
            --texto-mutado: #8C7566;
            --fundo-base: #FFF9F6;
            --gradiente-fundo: linear-gradient(135deg, #FFFDFB 0%, #FFF1EB 40%, #F6EAE2 100%);
            --branco: #FFFFFF;
            --borda: #EBE0D5;
            --pendente-cor: #E67E22;
            --concluido-cor: #27AE60;
            --cancelado-cor: #E74C3C;
            --header-height: 60px;
        }

        * {
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--gradiente-fundo);
            background-attachment: fixed;
            color: var(--texto);
            min-height: 100vh;
            line-height: 1.5;
        }

        .topo-fixo {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 1000;
            transition: all 0.3s ease;
            background: rgba(255, 253, 251, 0.85);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--borda);
        }

        .topo-fixo.rolado {
            background: rgba(255, 255, 255, 0.95);
            border-bottom: 1.5px solid var(--borda);
            box-shadow: 0 4px 20px rgba(42, 30, 23, 0.05);
        }

        .botao-voltar {
            background: #FFFFFF;
            border: 1.5px solid var(--borda);
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--texto);
            cursor: pointer;
            transition: all 0.2s;
        }

        .botao-voltar:hover {
            border-color: var(--primaria-tom);
            background: #FFFBF7;
        }

        .titulo-topo {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--texto);
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            letter-spacing: 0.8px;
            opacity: 0.95;
        }

        .container-app {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-bottom: 40px;
            position: relative;
        }

        .secao-hero {
            padding: 100px 25px 30px;
            text-align: center;
            background: transparent;
        }

        .avatar-usuario {
            width: 84px;
            height: 84px;
            background: var(--agendador-gradient);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 2.2rem;
            margin: 0 auto 15px;
            border: 3px solid #FFFFFF;
            box-shadow: 0 8px 25px rgba(253, 149, 133, 0.3);
        }

        .secao-hero h2 {
            font-size: 1.45rem;
            color: var(--texto);
            font-weight: 700;
        }

        .secao-hero p {
            font-size: 0.88rem;
            color: var(--texto-suave);
            margin-top: 3px;
        }

        .titulo-secao {
            padding: 25px 20px 12px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--texto-suave);
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .conteudo-titulo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .titulo-secao i {
            color: var(--primaria-escura);
            font-size: 1.05rem;
        }

        .cartao-conteudo {
            margin: 0 20px;
            background: var(--branco);
            border: 1.5px solid var(--borda);
            border-radius: 20px;
            padding: 5px 0;
            box-shadow: 0 8px 24px rgba(42, 30, 23, 0.04);
            overflow: hidden;
        }

        .botao-editar {
            background: rgba(253, 149, 133, 0.12);
            color: var(--primaria-escura);
            border: 1px solid rgba(253, 149, 133, 0.25);
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .botao-editar:hover {
            background: var(--primaria-escura);
            color: white;
            border-color: var(--primaria-escura);
        }

        .linha-info {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px 20px;
            border-bottom: 1px solid var(--borda);
        }

        .linha-info:last-child {
            border-bottom: none;
        }

        .icone-info {
            width: 42px;
            height: 42px;
            min-width: 42px;
            background: rgba(253, 149, 133, 0.08);
            border: 1px solid rgba(253, 149, 133, 0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primaria-escura);
        }

        .conteudo-info span {
            display: block;
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--texto);
        }

        .conteudo-info label {
            display: block;
            font-size: 0.72rem;
            color: var(--texto-suave);
            font-weight: 500;
            margin-bottom: 1px;
        }

        .input-senha {
            position: relative;
        }

        .input-senha input {
            padding-right: 45px;
        }

        .input-senha i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--texto-mutado);
            padding: 5px;
        }

        .seletor-mes {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--branco);
            padding: 14px 18px;
            border-radius: 16px;
            margin: 0 20px 15px;
            border: 1.5px solid var(--borda);
            box-shadow: 0 4px 12px rgba(42, 30, 23, 0.02);
        }

        .item-agendamento {
            display: flex;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid var(--borda);
            gap: 15px;
        }

        .item-agendamento:last-child {
            border-bottom: none;
        }

        .caixa-data {
            text-align: center;
            min-width: 50px;
        }

        .caixa-data .dia {
            display: block;
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primaria-escura);
            line-height: 1.1;
        }

        .caixa-data .mes {
            display: block;
            font-size: 0.68rem;
            color: var(--texto-suave);
            font-weight: 600;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .detalhes-item {
            flex: 1;
        }

        .etiqueta {
            font-size: 0.62rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 6px;
            text-transform: uppercase;
            border: 1px solid transparent;
        }

        .bg-pendente {
            background: #FFF4E5;
            color: #D35400;
            border-color: #FED7B0;
        }

        .bg-concluido {
            background: #E9F9F0;
            color: #219653;
            border-color: #C2F0D5;
        }

        .bg-cancelado {
            background: #FDECEC;
            color: #C0392B;
            border-color: #FADBD8;
        }

        .servico-item {
            padding: 6px 0;
            border-bottom: 1px dashed var(--borda);
        }

        .servico-item:last-child {
            border-bottom: none;
        }

        .servico-nome {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--texto);
        }

        .servico-info {
            font-size: 0.78rem;
            color: var(--texto-suave);
        }

        .meta-servico {
            font-size: 0.72rem;
            color: var(--texto-suave);
            background: rgba(253, 149, 133, 0.08);
            border: 1px solid rgba(253, 149, 133, 0.18);
            padding: 3px 12px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
            font-weight: 600;
        }

        .botao-excluir-agendamento {
            border: 1.5px solid rgba(231, 76, 60, 0.2);
            background: rgba(231, 76, 60, 0.05);
            color: #E74C3C;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .botao-excluir-agendamento:hover {
            background: #E74C3C;
            color: white;
            border-color: #E74C3C;
        }

        .acoes-rodape {
            padding: 35px 20px;
        }

        .botao-sair {
            width: 100%;
            padding: 16px;
            border-radius: 16px;
            border: 1.5px solid var(--borda);
            background: var(--branco);
            color: var(--texto-suave);
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 12px;
            text-decoration: none;
        }

        .botao-sair a {
            color: inherit;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
        }

        .botao-sair:hover {
            background: #FFF5ED;
            border-color: var(--primaria-tom);
            color: var(--primaria-escura);
        }

        .botao-excluir {
            margin-top: 12px;
            width: 100%;
            padding: 16px;
            border-radius: 16px;
            border: 1.5px solid rgba(231, 76, 60, 0.3);
            background: rgba(231, 76, 60, 0.05);
            color: #C0392B;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .botao-excluir a {
            color: inherit;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            width: 100%;
            justify-content: center;
        }

        .botao-excluir:hover {
            background: #C0392B;
            color: white;
            border-color: #C0392B;
        }

        .overlay-modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(42, 30, 23, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 2000;
            align-items: flex-end;
            justify-content: center;
        }

        .cartao-modal {
            background: var(--branco);
            border-radius: 28px 28px 0 0;
            padding: 35px 24px;
            width: 100%;
            max-width: 500px;
            border-top: 2px solid var(--borda);
            box-shadow: 0 -10px 30px rgba(42, 30, 23, 0.15);
        }

        #modalEdicao {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.5);
        }

        #modalEdicao .modal-conteudo {
            max-height: 90vh;
            overflow-y: auto;
            margin: auto;
        }

        @media (min-width: 640px) {
            .overlay-modal {
                align-items: center;
                padding: 20px;
            }

            .cartao-modal {
                border-radius: 24px;
                border: 1.5px solid var(--borda);
            }
        }

        .grupo-formulario {
            margin-bottom: 18px;
        }

        .grupo-formulario label {
            display: block;
            font-size: 0.78rem;
            color: var(--texto-suave);
            margin-bottom: 6px;
            font-weight: 600;
        }

        .grupo-formulario input {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: 1.5px solid var(--borda);
            font-family: inherit;
            font-size: 0.95rem;
            background: #FCFAF8;
            color: var(--texto);
            outline: none;
            transition: all 0.2s;
        }

        .grupo-formulario input:focus {
            border-color: var(--primaria-tom);
            background: var(--branco);
            box-shadow: 0 0 0 3px rgba(253, 149, 133, 0.2);
        }

        .botao-modal {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.2s;
        }

        .botao-modal:active {
            transform: scale(0.98);
        }

        .mensagem-vazia {
            text-align: center;
            padding: 50px 20px;
            color: var(--texto-mutado);
            font-size: 0.88rem;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <header class="topo-fixo" id="cabecalho">
        <button class="botao-voltar" onclick="window.history.back()">
            <i class="fas fa-chevron-left"></i>
        </button>
        <span class="titulo-topo">MINHA CONTA</span>
        <div style="width: 40px;"></div>
    </header>

    <div class="container-app">

        <section class="secao-hero">
            <div class="avatar-usuario" id="inicialUsuario">?</div>
            <h2 id="nomeBoasVindas">Olá!</h2>
            <p>Seja bem-vinda ao seu espaço exclusivo.</p>
        </section>

        <div class="titulo-secao">
            <div class="conteudo-titulo">
                <i class="fas fa-user-circle"></i>
                <span>Meus Dados</span>
            </div>
            <button class="botao-editar" onclick="abrirModalEdicao()">
                <i class="fas fa-pen"></i>
                Editar
            </button>
        </div>

        <div class="cartao-conteudo">
            <div class="linha-info">
                <div class="icone-info"><i class="far fa-user"></i></div>
                <div class="conteudo-info">
                    <label>Nome Completo</label>
                    <span id="txtNome"></span>
                </div>
            </div>
            <div class="linha-info">
                <div class="icone-info"><i class="far fa-envelope"></i></div>
                <div class="conteudo-info">
                    <label>E-mail de Acesso</label>
                    <span id="txtEmail"></span>
                </div>
            </div>
        </div>

        <h3 class="titulo-secao">
            <div class="conteudo-titulo">
                <i class="fas fa-calendar-alt"></i>
                <span>Próximos Agendamentos</span>
            </div>
        </h3>

        <div class="seletor-mes">
            <div style="cursor: pointer; padding: 5px; color: var(--texto-suave);" onclick="alterarMes(-1)">
                <i class="fas fa-chevron-left"></i>
            </div>
            <span id="labelMesCorrente" style="font-weight: 700; font-size: 0.9rem; color: var(--texto); letter-spacing: 0.5px;">ABRIL 2026</span>
            <div style="cursor: pointer; padding: 5px; color: var(--texto-suave);" onclick="alterarMes(1)">
                <i class="fas fa-chevron-right"></i>
            </div>
        </div>

        <div class="cartao-conteudo" id="listaAgendamentos">
        </div>

        <div class="acoes-rodape">
            <button class="botao-sair" onclick="confirmarSair()">
                <i class="fas fa-sign-out-alt"></i>
                <a href="usuario/auth/logout.php">Sair da Conta</a>
            </button>
            <button class="botao-excluir" onclick="excluirConta()">
                <i class="fas fa-user-times"></i>
                <a href="usuario/auth/delete_usuario.php">Excluir Conta</a>
            </button>
        </div>
    </div>

    <div class="overlay-modal" id="modalEdicao">
        <div class="cartao-modal">
            <h3 style="margin-bottom:25px; text-align:center; color: var(--texto); font-weight: 700;">
                Atualizar Perfil
            </h3>

            <div class="grupo-formulario">
                <label>Nome Completo</label>
                <input type="text" id="campoNome">
            </div>

            <div class="grupo-formulario">
                <label>E-mail</label>
                <input type="email" id="campoEmail">
            </div>

            <div class="grupo-formulario">
                <label>Senha Atual</label>
                <div class="input-senha">
                    <input type="password" id="campoSenhaAtual">
                    <i class="fas fa-eye" onclick="toggleSenha('campoSenhaAtual', this)"></i>
                </div>
            </div>

            <div class="grupo-formulario">
                <label>Nova Senha</label>
                <div class="input-senha">
                    <input type="password" id="campoNovaSenha">
                    <i class="fas fa-eye" onclick="toggleSenha('campoNovaSenha', this)"></i>
                </div>
            </div>

            <div class="grupo-formulario">
                <label>Confirmar Nova Senha</label>
                <div class="input-senha">
                    <input type="password" id="campoConfirmarSenha">
                    <i class="fas fa-eye" onclick="toggleSenha('campoConfirmarSenha', this)"></i>
                </div>
            </div>

            <button class="botao-modal" style="background:linear-gradient(225deg, #ffa361e7 0%, #fd977eea 15%, #fd9585e8 50%, #FAA7D5 97%); color:white" onclick="salvarAlteracoes()">
                SALVAR ALTERAÇÕES
            </button>

            <button class="botao-modal" style="background:#F2ECE6; color:var(--texto-suave); font-weight: 600;" onclick="fecharModais()">
                CANCELAR
            </button>
        </div>
    </div>

    <script>
        let dataReferencia = new Date();

        function toggleSenha(id, icon) {
            const input = document.getElementById(id);

            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
        const cabecalho = document.getElementById('cabecalho');
        window.onscroll = () => {
            if (window.scrollY > 15) {
                cabecalho.classList.add('rolado');
            } else {
                cabecalho.classList.remove('rolado');
            }
        };

        let dadosUsuario = {};

        let listaDeAgendamentos = [];

        async function carregarAgendamentos() {
            try {
                const response = await fetch('api/get_agendamentos.php');
                const data = await response.json();

                if (data.erro) {
                    console.error(data.erro);
                    return;
                }

                listaDeAgendamentos = data;
                renderizarAgenda();

            } catch (e) {
                console.error("Erro ao carregar agendamentos", e);
            }
        }
        const meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

        async function iniciar() {
            await carregarUsuario();
            await carregarAgendamentos();
        }

        async function carregarUsuario() {
            try {
                const response = await fetch('api/get_usuario.php');
                const data = await response.json();

                if (data.erro) {
                    alert("Erro: " + data.erro);
                    return;
                }

                dadosUsuario = data;

                atualizarUI();

            } catch (e) {
                console.error("Erro ao carregar usuário", e);
            }
        }

        function atualizarUI() {
            if (!dadosUsuario || !dadosUsuario.nome) return;

            const nome = dadosUsuario.nome || "";
            const email = dadosUsuario.email || "";

            document.getElementById('nomeBoasVindas').innerText =
                nome ? `Olá, ${nome.split(' ')[0]}!` : "Olá!";

            document.getElementById('inicialUsuario').innerText =
                nome ? nome.charAt(0).toUpperCase() : "?";

            document.getElementById('txtNome').innerText = nome;
            document.getElementById('txtEmail').innerText = email;
        }
        async function salvarAlteracoes() {
            const nome = document.getElementById('campoNome').value;
            const email = document.getElementById('campoEmail').value;
            const senhaAtual = document.getElementById('campoSenhaAtual').value;
            const novaSenha = document.getElementById('campoNovaSenha').value;
            const confirmarSenha = document.getElementById('campoConfirmarSenha').value;

            if (novaSenha && novaSenha !== confirmarSenha) {
                alert("As senhas não coincidem");
                return;
            }

            const response = await fetch('api/update_usuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    nome,
                    email,
                    senhaAtual,
                    novaSenha
                })
            });

            const result = await response.json();

            if (result.sucesso) {
                dadosUsuario.nome = nome;
                dadosUsuario.email = email;
                atualizarUI();
                fecharModais();
                alert("Atualizado com sucesso");
            } else {
                alert(result.erro || "Erro ao atualizar");
            }
        }

        const params = new URLSearchParams(window.location.search);
        const token = params.get("token");

        async function resetar() {
            const novaSenha = document.getElementById('novaSenha').value;

            const response = await fetch('api/resetar_senha.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    token,
                    novaSenha
                })
            });

            const result = await response.json();

            if (result.sucesso) {
                alert("Senha redefinida!");
            } else {
                alert(result.erro);
            }
        }

        function getStatusClass(status) {
            if (status === "pendente") return "bg-pendente";
            if (status === "concluido") return "bg-concluido";
            if (status === "cancelado") return "bg-cancelado";
            return "bg-pendente";
        }

        function renderizarAgenda() {
            const listaElemento = document.getElementById('listaAgendamentos');
            const labelMes = document.getElementById('labelMesCorrente');

            const m = dataReferencia.getMonth();
            const a = dataReferencia.getFullYear();

            labelMes.innerText = `${meses[m].toUpperCase()} ${a}`;
            listaElemento.innerHTML = "";

            const filtrados = listaDeAgendamentos.filter(ag => {
                const d = new Date(ag.data.replace(" ", "T"));
                return d.getMonth() === m && d.getFullYear() === a;
            });

            if (filtrados.length === 0) {
                listaElemento.innerHTML = `<div class="mensagem-vazia">Nenhum compromisso para este mês.</div>`;
                return;
            }

            filtrados.forEach(item => {
                const dia = item.data.split('-')[2];
                const mesCurto = meses[m].substring(0, 3);

                listaElemento.innerHTML += `
                    <div class="item-agendamento">
                        <div class="caixa-data" style="min-width: 45px; text-align: center;">
                            <span class="dia">${dia}</span>
                            <span class="mes">${mesCurto}</span>
                        </div>
                        <div class="detalhes-item">
                            <span class="etiqueta ${getStatusClass(item.status)}">${item.status}</span>
                            <div class="nome-servico">${formatarServicos(item.servicos)}</div>
                            <span class="meta-servico">${item.hora} • R$ ${item.valor}</span>
                        </div>
                        <button class="botao-excluir-agendamento" onclick="cancelarAgendamento(${item.id})">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                `;
            });
        }

        function formatarServicos(servicos) {
            if (!servicos) return "";

            const lista = typeof servicos === "string" ?
                JSON.parse(servicos) :
                servicos;

            return lista.map(s => `
        <div class="servico-item">
            <div class="servico-nome">${s.nome}</div>
            <div class="servico-info">${s.tempo} • R$ ${s.preco}</div>
        </div>
    `).join("");
        }

        function alterarMes(d) {
            dataReferencia.setMonth(dataReferencia.getMonth() + d);
            renderizarAgenda();
        }

        function abrirModalEdicao() {
            document.getElementById('campoNome').value = dadosUsuario.nome;
            document.getElementById('campoEmail').value = dadosUsuario.email;

            const modal = document.getElementById('modalEdicao');
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function fecharModais() {
            document.getElementById('modalEdicao').style.display = 'none';
            document.body.style.overflow = '';
        }

        function cancelarAgendamento(id) {
            if (confirm("Deseja realmente cancelar?")) {
                listaDeAgendamentos = listaDeAgendamentos.filter(i => i.id !== id);
                renderizarAgenda();
            }
        }

        function confirmarSair() {
            if (confirm("Deseja sair da sua conta?")) {
                console.log("Logout");
            }
        }

        async function excluirConta() {
            const confirm1 = confirm("Tem certeza que deseja EXCLUIR sua conta? Essa ação não pode ser desfeita.");

            if (!confirm1) return;

            const confirm2 = confirm("Última confirmação: todos seus dados serão apagados permanentemente.");

            if (!confirm2) return;

            try {
                const response = await fetch('auth/delete_usuario.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                });

                const result = await response.json();

                if (result.sucesso) {
                    alert("Conta excluída com sucesso!");
                    window.location.href = "login.php"; 
                } else {
                    alert(result.erro || "Erro ao excluir conta");
                }

            } catch (e) {
                console.error(e);
                alert("Erro ao excluir conta");
            }
        }

        window.onload = iniciar;
    </script>
</body>

</html>