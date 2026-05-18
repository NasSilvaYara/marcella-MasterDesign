<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo | Marcella Gonçalves</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&family=DM+Serif+Display:ital@0;1&display=swap');

        :root {
            --color-1: #E8896A;
            --color-2: #E07A6B;
            --color-3: #EAA0A0;
            --color-4: #E8B4C8;
            --fundo: #F9EDE8;
            --fundo-card: #FDF6F3;
            --branco: #FFFFFF;
            --preto: #121212;
            --preto-glass: rgba(18, 18, 18, 0.92);
            --preto-borda: #1E293B;
            --text-dark: #1C1C1C;
            --text-muted: #8B7D7A;
            --cor-borda: rgba(200, 160, 150, 0.2);
            --cor-borda-card: rgba(200, 150, 140, 0.25);
            --gradiente: linear-gradient(135deg, #E8896A, #E07A6B, #E8B4C8);
            --gradiente-fundo: linear-gradient(160deg, #F9EDE8 0%, #FBEAE3 50%, #F5E8EE 100%);
            --cor-alerta: #C9820A;
            --ds-color-accent: #E8B4C8;
            --ds-bg-light: #F9EDE8;
            --ds-bg-white: #FDF6F3;
            --ds-bg-dark: rgba(18, 18, 18, 0.92);
            --ds-txt-main: #1C1C1C;
            --ds-txt-muted: #8B7D7A;
            --ds-brd-color: rgba(200, 155, 145, 0.3);
            --ds-accent-primary: #E07A6B;
            --ds-accent-secondary: #E8B4C8;
            --font-body: 'DM Sans', sans-serif;
            --font-display: 'DM Serif Display', serif;
            --sombra-sm: 0 2px 12px rgba(180, 100, 90, 0.08);
            --sombra-md: 0 8px 32px rgba(180, 100, 90, 0.1);
            --sombra-lg: 0 20px 48px rgba(180, 100, 90, 0.12);
        }

        * {
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-body);
            background: var(--gradiente-fundo);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* ─── NAVEGAÇÃO ─────────────────────────────────────────── */
        .navegacao-principal {
            width: 100%;
            background: rgba(253, 246, 243, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--cor-borda-card);
            padding: 18px 0;
            margin-bottom: 36px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 24px rgba(180, 100, 90, 0.06);
        }

        .alinhamento-cabecalho {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .aba-item {
            background: transparent;
            border: none;
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            padding: 8px 0;
            position: relative;
            transition: color 0.3s ease;
            letter-spacing: 0.01em;
        }

        .aba-item:hover {
            color: var(--text-dark);
        }

        .aba-item.ativa {
            color: var(--text-dark);
        }

        .aba-item.ativa::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: var(--gradiente);
            border-radius: 10px;
        }

        /* ─── LAYOUT PAINEL ─────────────────────────────────────── */
        .container-painel {
            display: flex;
            flex-direction: row;
            gap: 20px;
            width: 100%;
            max-width: 70rem;
            margin: 0 auto;
            padding: 0 20px 40px;
        }

        .cartao {
            flex: 1;
            border-radius: 28px;
            padding: 28px;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            width: 100%;
        }

        .cartao-config {
            background: var(--fundo-card);
            border: 2px solid var(--preto-borda);
            box-shadow: var(--sombra-sm);
        }

        .cartao-resumo {
            background: var(--preto-glass);
            color: var(--branco);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: var(--sombra-lg);
        }

        /* ─── LABELS E TEXTOS ───────────────────────────────────── */
        .label-pequena {
            font-size: 9px;
            font-weight: 700;
            color: var(--color-2);
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
            letter-spacing: 1.2px;
        }

        .ajuda-texto {
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 12px;
            display: block;
            line-height: 1.4;
        }

        .cartao-resumo .ajuda-texto {
            color: rgba(255, 255, 255, 0.45);
        }

        /* ─── SEÇÕES E CONTROLES ────────────────────────────────── */
        .secao-controle {
            margin-bottom: 24px;
        }

        .grupo-botoes {
            display: flex;
            gap: 8px;
        }

        .botao-toggle {
            flex: 1;
            padding: 10px 5px;
            border: 1.5px solid var(--cor-borda-card);
            background: rgba(249, 237, 232, 0.5);
            border-radius: 14px;
            font-size: 11px;
            font-weight: 700;
            font-family: var(--font-body);
            cursor: pointer;
            color: var(--text-muted);
            transition: all 0.2s ease;
            text-align: center;
            min-height: 48px;
        }

        .botao-toggle.ativo {
            background: var(--branco);
            border-color: var(--color-2);
            color: var(--color-2);
            box-shadow: 0 4px 16px rgba(224, 122, 107, 0.15);
        }

        /* ─── SELETOR SEMANAL ───────────────────────────────────── */
        .seletor-semanal {
            display: flex;
            justify-content: space-between;
            gap: 4px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .dia-semana {
            flex: 1;
            min-width: 32px;
            height: 40px;
            border: 1.5px solid var(--cor-borda-card);
            background: rgba(249, 237, 232, 0.5);
            border-radius: 12px;
            font-size: 10px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: all 0.2s;
            font-family: var(--font-body);
        }

        .dia-semana.selecionado {
            background: var(--gradiente);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(224, 122, 107, 0.25);
        }

        /* ─── CAMPOS DE ENTRADA ─────────────────────────────────── */
        .campo-entrada {
            background-color: rgba(249, 237, 232, 0.5);
            border: 1.5px solid var(--cor-borda-card);
            border-radius: 14px;
            padding: 12px 16px;
            width: 100%;
            font-size: 13px;
            font-family: var(--font-body);
            outline: none;
            margin-bottom: 8px;
            box-sizing: border-box;
            transition: all 0.2s;
            color: var(--text-dark);
        }

        .campo-entrada:focus {
            border-color: var(--color-2);
            background-color: var(--branco);
            box-shadow: 0 0 0 3px rgba(224, 122, 107, 0.1);
        }

        /* ─── BOTÃO AÇÃO PRINCIPAL ──────────────────────────────── */
        .botao-acao {
            background: var(--gradiente);
            color: var(--branco);
            border: none;
            border-radius: 16px;
            padding: 16px;
            font-size: 11px;
            font-weight: 800;
            font-family: var(--font-body);
            text-transform: uppercase;
            letter-spacing: 1.2px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 16px;
            box-shadow: 0 8px 24px rgba(224, 122, 107, 0.3);
        }

        .botao-acao:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(224, 122, 107, 0.4);
        }

        .botao-acao:disabled {
            background: #2a2a2a;
            opacity: 0.4;
            cursor: not-allowed;
            box-shadow: none;
            transform: none;
        }

        /* ─── ALERTA ────────────────────────────────────────────── */
        .alerta-container {
            background: rgba(201, 130, 10, 0.07);
            border: 1px solid rgba(201, 130, 10, 0.25);
            border-radius: 12px;
            padding: 10px 14px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alerta-container span {
            color: var(--cor-alerta);
            font-size: 10px;
            font-weight: 700;
        }

        /* ─── RESUMO (CARD PRETO) ───────────────────────────────── */
        .item-resumo {
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .valor-resumo {
            font-size: 15px;
            font-weight: 600;
            color: #FFFFFF;
        }

        .badge-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-aberto {
            background: rgba(232, 137, 106, 0.15);
            color: var(--color-1);
            border: 1px solid rgba(232, 137, 106, 0.25);
        }

        .status-fechado {
            background: rgba(232, 180, 200, 0.15);
            color: var(--color-4);
            border: 1px solid rgba(232, 180, 200, 0.25);
        }

        .info-atualizacao {
            margin-top: auto;
            padding-top: 20px;
            font-size: 10px;
            color: rgba(255, 255, 255, 0.25);
            text-align: center;
        }

        .hidden {
            display: none;
        }

        /* ─── CALENDÁRIO ────────────────────────────────────────── */
        .area-principal {
            width: 100%;
            max-width: 70rem;
            margin: 0 auto;
            padding: 0 20px;
        }

        .container-calendario {
            background: var(--fundo-card);
            border-radius: 28px;
            padding: 2rem;
            box-shadow: var(--sombra-md);
            border: 2px solid var(--preto-borda);
            margin-bottom: 50px;
        }

        .cabecalho-agenda {
            margin-bottom: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .cabecalho-agenda {
                flex-direction: row;
                align-items: flex-end;
            }
        }

        .titulo-principal {
            font-family: var(--font-display);
            font-size: 26px;
            font-weight: 400;
            color: var(--text-dark);
            letter-spacing: -0.01em;
            margin: 0;
        }

        .subtitulo-agenda {
            color: var(--text-muted);
            font-size: 12px;
            margin-top: 0.25rem;
        }

        .linha-decorativa {
            height: 3px;
            width: 6rem;
            background: var(--gradiente);
            border-radius: 9999px;
        }

        .fc {
            --fc-button-bg-color: transparent;
            --fc-button-border-color: var(--cor-borda-card);
            --fc-button-text-color: var(--text-dark);
            --fc-button-hover-bg-color: rgba(249, 237, 232, 0.8);
            --fc-event-bg-color: var(--color-2);
            border: none !important;
            font-family: var(--font-body) !important;
        }

        .fc .fc-button {
            font-weight: 600;
            border-radius: 0.75rem !important;
            padding: 0.6rem 1rem;
            font-family: var(--font-body) !important;
        }

        .fc-toolbar-title {
            font-family: var(--font-display) !important;
            font-weight: 400 !important;
        }

        /* ─── MODAIS ────────────────────────────────────────────── */
        .sobreposicao-modal {
            position: fixed;
            inset: 0;
            z-index: 50;
            background: rgba(28, 20, 18, 0.35);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .sobreposicao-modal.ativo {
            display: flex;
        }

        .cartao-modal {
            background: var(--fundo-card);
            border: 1px solid var(--cor-borda-card);
            box-shadow: var(--sombra-lg);
            border-radius: 28px;
            width: 100%;
            overflow-y: auto;
            max-height: 90vh;
            margin-top: 100px;
        }

        .modal-pequeno {
            max-width: 28rem;
        }

        .modal-largo {
            max-width: 32rem;
        }

        .topo-modal {
            padding: 1.75rem 2rem;
            border-bottom: 1px solid var(--cor-borda-card);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .corpo-modal {
            padding: 1.5rem;
        }

        /* ─── ELEMENTOS DO FORMULÁRIO ───────────────────────────── */
        .ficha-cliente {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            background: rgba(249, 237, 232, 0.5);
            padding: 1.25rem;
            border-radius: 18px;
            border: 1px solid var(--cor-borda-card);
        }

        .grade-informacoes {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1.25rem;
        }

        .servico-item {
            background: rgba(249, 237, 232, 0.4);
            border: 1px solid var(--cor-borda-card);
            border-radius: 14px;
            padding: 14px;
            margin-top: 10px;
            transition: 0.2s ease;
        }

        .servico-item:hover {
            border-color: rgba(224, 122, 107, 0.4);
            transform: translateY(-1px);
        }

        .btn-excluir-servico {
            background: rgba(239, 68, 68, 0.08);
            color: #dc2626;
            border: none;
            border-radius: 10px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            font-family: var(--font-body);
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-excluir-servico:hover {
            background: rgba(239, 68, 68, 0.15);
        }

        .rotulo-campo {
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            display: block;
            margin-bottom: 0.5rem;
        }

        .caixa-texto {
            width: 100%;
            border-radius: 14px;
            padding: 0.75rem;
            border: 1.5px solid var(--cor-borda-card);
            background: rgba(249, 237, 232, 0.3);
            font-size: 0.875rem;
            font-weight: 600;
            font-family: var(--font-body);
            color: var(--text-dark);
        }

        .caixa-texto:focus {
            outline: none;
            border-color: var(--color-2);
            background: var(--branco);
        }

        .botao-salvar {
            background: var(--gradiente);
            color: white;
            flex: 2;
        }

        .botao-salvar:hover {
            transform: translateY(-2px);
            opacity: 0.92;
        }

        .botao-cancelar {
            background: transparent;
            color: #EF4444;
            flex: 1;
            font-family: var(--font-body);
        }

        /* ─── NOTICE BOX ────────────────────────────────────────── */
        .notice-box {
            margin-top: 28px;
            padding: 1.25rem;
            border: 1px solid var(--cor-borda-card);
            border-radius: 14px;
            background-color: rgba(249, 237, 232, 0.4);
            max-width: 650px;
        }

        .notice-text {
            font-size: 0.875rem;
            line-height: 1.6;
            color: var(--text-muted);
            margin: 0;
        }

        .notice-text strong {
            color: var(--text-dark);
            font-weight: 600;
        }

        /* ─── STATUS BADGES ─────────────────────────────────────── */
        .badge-status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            width: fit-content;
            transition: 0.3s ease;
            font-family: var(--font-body);
        }

        .status-pendente {
            background: rgba(255, 193, 7, 0.12);
            color: #b37900;
        }

        .status-concluido {
            background: rgba(34, 197, 94, 0.12);
            color: #15803d;
        }

        .status-cancelado {
            background: rgba(239, 68, 68, 0.12);
            color: #dc2626;
        }

        .select-status {
            width: 100%;
            padding: 12px 16px;
            border-radius: 14px;
            border: 1.5px solid var(--cor-borda-card);
            background: rgba(249, 237, 232, 0.3);
            font-size: 13px;
            font-family: var(--font-body);
            margin-top: 8px;
            margin-bottom: 14px;
            outline: none;
            color: var(--text-dark);
        }

        /* ─── CARDS DE SERVIÇO ──────────────────────────────────── */
        .lista-servicos-modal {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .card-servico {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px;
            border-radius: 18px;
            background: rgba(249, 237, 232, 0.4);
            border: 1px solid var(--cor-borda-card);
        }

        .info-servico {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nome-servico {
            font-weight: 600;
            color: var(--text-dark);
        }

        .meta-servico {
            font-size: 13px;
            color: var(--text-muted);
        }

        .botao-remover-servico {
            width: 34px;
            height: 34px;
            border: 1.5px solid var(--preto-borda);
            border-radius: 999px;
            color: var(--preto-borda);
            background: transparent;
            cursor: pointer;
            transition: 0.2s;
        }

        .botao-remover-servico:hover {
            background: var(--preto-borda);
            color: white;
        }

        .botao-add-servico {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border: none;
            border-radius: 999px;
            background: var(--preto-borda);
            color: white;
            font-size: 13px;
            font-weight: 600;
            font-family: var(--font-body);
            cursor: pointer;
            transition: 0.2s;
        }

        .botao-add-servico:hover {
            background: var(--preto);
        }

        /* ─── DASHBOARD / RELATÓRIOS ────────────────────────────── */
        .ds-wrapper {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: clamp(1rem, 5vw, 2.5rem);
        }

        .ds-header {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        .ds-header-info h1 {
            font-family: var(--font-display);
            font-size: 28px;
            font-weight: 400;
            color: var(--text-dark);
            letter-spacing: -0.01em;
            margin-bottom: 0.25rem;
        }

        .ds-header-info p {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 15px;
        }

        @media (min-width: 768px) {
            .ds-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .ds-filter-container {
            display: flex;
            align-items: center;
            background: var(--fundo-card);
            padding: 0.35rem;
            border-radius: 12px;
            box-shadow: var(--sombra-sm);
            border: 1px solid var(--cor-borda-card);
            width: 100%;
            max-width: 400px;
        }

        .ds-select-custom {
            background: transparent;
            padding: 0.5rem;
            border: none;
            font-size: 0.875rem;
            font-weight: 600;
            font-family: var(--font-body);
            outline: none;
            color: var(--text-dark);
            flex: 1;
            cursor: pointer;
            min-width: 80px;
        }

        .ds-divider-v {
            width: 1px;
            background-color: var(--cor-borda-card);
            height: 20px;
            margin: 0 0.25rem;
        }

        .ds-metrics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
            margin-bottom: 2.5rem;
        }

        @media (min-width: 1200px) {
            .ds-metrics-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1.5rem;
            }
        }

        .ds-card-info {
            background: var(--fundo-card);
            padding: clamp(1.25rem, 3vw, 1.75rem);
            border-radius: 24px;
            border: 2px solid var(--preto-borda);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .ds-card-info:hover {
            transform: translateY(-4px);
            box-shadow: var(--sombra-md);
        }

        .ds-metric-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
        }

        .ds-metric-value {
            font-family: var(--font-display);
            font-size: clamp(1.6rem, 4vw, 2.4rem);
            font-weight: 400;
            margin: 0.25rem 0 0.5rem 0;
            color: var(--text-dark);
            letter-spacing: -0.02em;
        }

        .ds-metric-indicator {
            height: 3px;
            width: 40px;
            border-radius: 99px;
            margin-bottom: 1rem;
        }

        .indicator-orange {
            background-color: #E8896A;
        }

        .indicator-pink {
            background-color: #E8B4C8;
        }

        .indicator-indigo {
            background-color: #A5B4FC;
        }

        .ds-metric-footer {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: auto;
            line-height: 1.4;
        }

        .ds-charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 1100px) {
            .ds-charts-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2rem;
            }
        }

        .ds-card-dark {
            background: var(--preto-glass);
            padding: clamp(1.25rem, 4vw, 2rem);
            border-radius: 24px;
            color: white;
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            min-height: 450px;
            overflow: hidden;
        }

        .ds-card-title {
            font-family: var(--font-display);
            font-size: clamp(1.1rem, 2vw, 1.3rem);
            font-weight: 400;
            margin-bottom: 0.25rem;
        }

        .ds-card-subtitle {
            font-size: 0.875rem;
            color: #94A3B8;
            margin-bottom: 1.5rem;
        }

        .ds-btn-scroll {
            display: flex;
            gap: 0.5rem;
            overflow-x: auto;
            padding-bottom: 0.75rem;
            margin-bottom: 1rem;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .ds-btn-scroll::-webkit-scrollbar {
            display: none;
        }

        .ds-btn-cat {
            padding: 0.6rem 1rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 0.75rem;
            font-size: 0.75rem;
            font-weight: 700;
            white-space: nowrap;
            color: #94A3B8;
            transition: all 0.2s;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.08);
            font-family: var(--font-body);
        }

        .ds-btn-cat.active {
            background: white;
            color: var(--preto);
            border-color: white;
        }

        .ds-chart-container {
            flex: 1;
            min-height: 280px;
            width: 100%;
            position: relative;
            margin: 1rem 0;
        }

        .ds-description {
            margin-top: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 1rem;
            font-size: 0.8rem;
            color: #94A3B8;
            line-height: 1.5;
            border-left: 3px solid var(--color-2);
        }

        .ds-description strong {
            color: white;
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.85rem;
        }

        /* ─── FOOTER ────────────────────────────────────────────── */
        footer {
            background-color: var(--preto);
            color: #ffffff;
            padding: 2.5rem 2rem;
            border-top: 1px solid #1a1a1a;
        }

        .brand-text {
            letter-spacing: -0.02em;
            font-family: var(--font-display);
            font-weight: 400;
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(200, 155, 145, 0.15);
        }

        .copyright {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        /* ─── MOBILE ────────────────────────────────────────────── */
        @media (max-width: 768px) {
            .alinhamento-cabecalho {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .container-painel {
                flex-direction: column;
                max-width: 500px;
            }

            .cartao-resumo {
                order: 2;
            }

            .cartao-config {
                order: 1;
            }

            .container-calendario {
                padding: 1rem;
            }

            .fc {
                min-height: 850px;
            }

            .fc-daygrid-day-frame {
                min-height: 90px;
            }

            .fc-toolbar {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }

            .fc-toolbar-title {
                font-size: 18px !important;
                text-align: center;
            }

            .fc .fc-button {
                padding: 0.8rem 1rem;
                font-size: 14px;
            }

            .fc-event {
                font-size: 13px;
                padding: 2px 4px;
            }
        }
    </style>
</head>

<body>

    <nav class="navegacao-principal">
        <div class="alinhamento-cabecalho">
            <div>
                <p class="label-pequena">Administrador</p>
                <h1 style="font-size: 20px; font-weight: 800; color: var(--text-dark);">Marcella Gonçalves</h1>
            </div>
            <div style="display: flex; gap: 32px;">
                <button id="aba-agenda" class="aba-item ativa" onclick="trocarAba('agenda')">Agenda</button>
                <button id="aba-relatorios" class="aba-item" onclick="trocarAba('relatorios')">Relatórios</button>
            </div>
        </div>
    </nav>

    <div id="conteudo-agenda">
        <div class="container-painel">
            <div class="cartao cartao-config">
                <h3 style="font-size: 25px; color: var(--text-dark); margin-bottom: 24px; font-weight: 800;">Painel de
                    Controle</h3>

                <div class="secao-controle">
                    <label class="label-pequena">Tipo de Agenda</label>
                    <span class="ajuda-texto">Define se a regra é para um dia específico ou recorrente.</span>
                    <div class="grupo-botoes">
                        <button type="button" id="btn-dia" class="botao-toggle ativo"
                            onclick="selecionarEscopo('dia')">Data Única</button>
                        <button type="button" id="btn-semana" class="botao-toggle"
                            onclick="selecionarEscopo('semana')">Recorrente</button>
                    </div>
                </div>

                <div class="secao-controle">
                    <label class="label-pequena">Estado da Unidade</label>
                    <span class="ajuda-texto">O local estará disponível ou em pausa?</span>
                    <div class="grupo-botoes">
                        <button type="button" id="btn-trabalho" class="botao-toggle ativo"
                            onclick="selecionarStatus('trabalho')">Aberto</button>
                        <button type="button" id="btn-folga" class="botao-toggle"
                            onclick="selecionarStatus('folga')">Fechado</button>
                    </div>
                </div>

                <div id="secao-data">
                    <label class="label-pequena">Data do Evento</label>
                    <span class="ajuda-texto">Escolha o dia no calendário.</span>
                    <input type="date" id="data_especifica" class="campo-entrada" onchange="atualizarResumo()">
                </div>

                <div id="secao-semanal" class="hidden">
                    <label class="label-pequena">Dias Ativos</label>
                    <span class="ajuda-texto">Toque nos dias para selecionar.</span>
                    <div class="seletor-semanal">
                        <div class="dia-semana" data-dia="Segunda" onclick="toggleDiaSemana(this, 'Segunda')">S</div>
                        <div class="dia-semana" data-dia="Terça" onclick="toggleDiaSemana(this, 'Terça')">T</div>
                        <div class="dia-semana" data-dia="Quarta" onclick="toggleDiaSemana(this, 'Quarta')">Q</div>
                        <div class="dia-semana" data-dia="Quinta" onclick="toggleDiaSemana(this, 'Quinta')">Q</div>
                        <div class="dia-semana" data-dia="Sexta" onclick="toggleDiaSemana(this, 'Sexta')">S</div>
                        <div class="dia-semana" data-dia="Sábado" onclick="toggleDiaSemana(this, 'Sábado')">S</div>
                        <div class="dia-semana" data-dia="Domingo" onclick="toggleDiaSemana(this, 'Domingo')">D</div>
                    </div>
                </div>

                <div id="periodo-recorrencia" class="hidden" style="margin-top: 20px;">
                    <label class="label-pequena">Mês e Ano</label>
                    <span class="ajuda-texto">
                        Escolha até quando a recorrência será válida.
                    </span>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px;">

                        <select id="mes_recorrencia" class="campo-entrada" onchange="atualizarResumo()">
                            <option value="">Mês</option>
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>

                        <select id="ano_recorrencia" class="campo-entrada" onchange="atualizarResumo()">
                            <option value="">Ano</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>

                    </div>
                </div>

                <div id="container-horarios">
                    <label class="label-pequena">Horário de Funcionamento</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <input type="time" id="hora_abertura" value="09:00" class="campo-entrada"
                            onchange="atualizarResumo()">
                        <input type="time" id="hora_fechamento" value="18:00" class="campo-entrada"
                            onchange="atualizarResumo()">
                    </div>
                </div>

                <div id="container-almoco">

                    <label class="label-pequena">Intervalo de Almoço</label>

                    <span class="ajuda-texto">
                        Defina o período de pausa da agenda.
                    </span>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px;">

                        <input
                            type="time"
                            id="inicio_intervalo"
                            value="12:00"
                            class="campo-entrada"
                            onchange="atualizarResumo()">

                        <input
                            type="time"
                            id="fim_intervalo"
                            value="13:00"
                            class="campo-entrada"
                            onchange="atualizarResumo()">

                    </div>

                </div>
            </div>

            <input type="hidden" id="status_dia" value="trabalho">
            <input type="hidden" id="escopo_config" value="dia">

            <!-- Cartão de Resumo -->
            <div class="cartao cartao-resumo">
                <h3 style="font-size: 25px; color: var(--branco); margin-bottom: 24px; font-weight: 800;">Conferência
                </h3>

                <div id="alerta-config" class="alerta-container hidden">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" style="color: var(--cor-alerta);">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span id="alerta-texto">Faltam informações</span>
                </div>

                <div class="item-resumo">
                    <label class="label-pequena" style="color: rgba(255,255,255,0.4)">Estado:</label>
                    <div id="resumo-status" class="valor-resumo">-</div>
                </div>

                <div class="item-resumo">
                    <label class="label-pequena" style="color: rgba(255,255,255,0.4)">Modo:</label>
                    <div id="resumo-escopo" class="valor-resumo" style="color: var(--color-1);">-</div>
                </div>

                <div class="item-resumo">
                    <label class="label-pequena" style="color: rgba(255,255,255,0.4)">Agendado para:</label>
                    <div id="resumo-detalhe" class="valor-resumo" style="font-size: 14px;">-</div>
                </div>

                <div class="item-resumo hidden" id="resumo-hora-container">
                    <label class="label-pequena" style="color: rgba(255,255,255,0.4)">Período:</label>
                    <div id="resumo-horario" class="valor-resumo">-</div>
                </div>

                <button class="botao-acao" id="btnSalvar" onclick="salvarConfiguracoes()">
                    <span>Gravar Alterações</span>
                </button>

                <div class="info-atualizacao">
                    <span id="data-atualizacao">Aguardando gravação...</span>
                </div>
            </div>
        </div>

        <div class="area-principal">
            <div class="container-calendario">
                <header class="cabecalho-agenda">
                    <div>
                        <h2 class="titulo-principal">Agenda de Atendimentos</h2>
                        <p class="subtitulo-agenda">Gerencie os horários e clientes da Marcella Beauty.</p>
                    </div>
                    <div class="linha-decorativa"></div>
                </header>

                <div id="calendar"></div>
            </div>
        </div>
    </div>
    </div>

    <div id="modalLista" class="sobreposicao-modal">
        <div class="cartao-modal modal-pequeno">
            <div class="topo-modal">
                <div>
                    <h3 id="tituloDataLista" class="text-xl font-bold">Agendamentos</h3>
                    <p class="text-xs text-slate-400">Selecione um para editar</p>
                </div>
                <button onclick="fecharModal('modalLista')" class="text-slate-400"><i data-lucide="x"></i></button>
            </div>
            <div id="agendamentosDiarios" class="corpo-modal space-y-3"></div>
        </div>
    </div>

    <div id="modalDetalhes" class="sobreposicao-modal">
        <div class="cartao-modal modal-largo">
            <div class="topo-modal">
                <div class="flex items-center gap-3">
                    <h3 class="font-bold text-lg">Detalhes da Reserva</h3>
                </div>
                <button onclick="fecharModal('modalDetalhes')" class="text-slate-300"><i
                        data-lucide="x"></i></button>
            </div>

            <form id="formularioEdicao" class="corpo-modal" onsubmit="return false;">
                <input type="hidden" id="edit_id">

                <div class="ficha-cliente">
                    <div>
                        <span class="rotulo-campo">Cliente</span>
                        <p id="view_nome" class="font-bold text-lg"></p>
                        <p id="view_email" class="text-xs text-slate-500"></p>
                    </div>
                    <div class="container-status">
                        <label class="rotulo-campo">Status</label>
                        <select id="status_select" name="status" class="select-status" onchange="alterarStatus()">
                            <option value="pendente">Pendente</option>
                            <option value="concluido">Concluído</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        <div id="status_badge" class="badge-status status-pendente">Pendente</div>
                    </div>
                </div>

                <div class="grade-informacoes">
                    <div>
                        <span class="rotulo-campo">WhatsApp</span>
                        <a id="link_whatsapp" target="_blank" class="caixa-texto block text-center bg-white hover:bg-green-50">
                            <span id="view_whatsapp"></span>
                        </a>
                    </div>
                    <div>
                        <span class="rotulo-campo">Valor Total</span>
                        <div class="caixa-texto bg-slate-50">R$ <span id="view_valor">0,00</span></div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="rotulo-campo">Serviços</span>
                        <button type="button" onclick="abrirAdicionarServico()" class="botao-add-servico">
                            <i data-lucide="plus"></i>
                            Adicionar
                        </button>
                    </div>
                    <div id="view_servicos" class="lista-servicos-modal"></div>
                </div>

                <div class="grade-informacoes mt-4 p-4 bg-orange-50/30 rounded-2xl border border-orange-100">
                    <div class="col-span-2 md:col-span-1">
                        <span class="rotulo-campo text-orange-400">Data</span>
                        <input type="date" id="edit_data" class="caixa-texto">
                    </div>
                    <div class="flex gap-2">
                        <div class="flex-1">
                            <span class="rotulo-campo text-orange-400">Início</span>
                            <input type="time" id="edit_inicio" class="caixa-texto">
                        </div>
                        <div class="flex-1">
                            <span class="rotulo-campo text-orange-400">Fim</span>
                            <input type="time" id="edit_fim" class="caixa-texto">
                        </div>
                    </div>
                </div>

                <div class="notice-box">
                    <p class="notice-text">
                        <strong>Aviso importante:</strong> Se for mudar o horário de início, deve orientar o cliente a
                        <strong>cancelar o agendamento atual</strong> e fazer um <strong>novo agendamento</strong>.
                    </p>
                </div>

                <div class="footer-bottom">
                    <div class="copyright">
                        &copy; <span id="year"></span> Marcella Gonçalves. Todos os direitos reservados.
                    </div>
                </div>

                <div class="flex gap-4 mt-6">
                    <button type="button" onclick="cancelarAgendamento()" class="botao-acao botao-cancelar">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                        Cancelar
                    </button>
                    <button type="button" onclick="salvarAgendamento()" class="botao-acao botao-salvar">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Atualizar Agenda
                    </button>
                </div>

            </form>

        </div>
    </div>

    <div id="modalAdicionarServico" class="sobreposicao-modal">

        <div class="cartao-modal max-w-md">

            <div class="topo-modal">

                <div class="flex items-center gap-2">
                    <i data-lucide="sparkles"></i>
                    <h3 class="font-bold">
                        Adicionar Serviço
                    </h3>
                </div>

                <button
                    type="button"
                    onclick="fecharModal('modalAdicionarServico')">

                    <i data-lucide="x"></i>

                </button>

            </div>

            <div class="corpo-modal">

                <div class="mb-4">

                    <label class="rotulo-campo">
                        Categoria
                    </label>

                    <select
                        id="categoria_servico"
                        class="caixa-texto"
                        onchange="carregarServicosCategoria()">

                        <option value="">
                            Selecione
                        </option>

                        <option value="manicure">
                            Manicure
                        </option>

                        <option value="massoterapia">
                            Massoterapia
                        </option>

                        <option value="lash">
                            Lash
                        </option>

                        <option value="estetica">
                            Estética
                        </option>

                        <option value="depilacao">
                            Depilação
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="rotulo-campo">
                        Serviço
                    </label>

                    <select
                        id="novo_servico"
                        class="caixa-texto">

                        <option value="">
                            Escolha um serviço
                        </option>

                    </select>

                </div>

                <button
                    type="button"
                    onclick="adicionarServicoSelecionado()"
                    class="botao-acao botao-salvar w-full">

                    <i data-lucide="plus"></i>
                    Adicionar Serviço

                </button>

            </div>

        </div>

    </div>

    <div id="conteudo-relatorios" class="hidden">

        <div class="ds-wrapper">
            <!-- Header -->
            <header class="ds-header">
                <div class="ds-header-info">
                    <h1>Performance Analítica</h1>
                    <p>Relatórios detalhados de faturamento e serviços.</p>
                </div>

                <div class="ds-filter-container">
                    <select id="filtroMes" class="ds-select-custom" onchange="atualizarDashboard()">
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>

                    <div class="ds-divider-v"></div>

                    <select id="filtroAno" class="ds-select-custom" onchange="atualizarDashboard()"></select>
                </div>
            </header>

            <div class="ds-metrics-grid">
                <div class="ds-card-info">
                    <span class="ds-metric-label">Faturamento Real</span>
                    <span class="ds-metric-value" id="valor-metricas">R$ 0,00</span>
                    <div class="ds-metric-indicator indicator-orange"></div>
                    <p class="ds-metric-footer">Receita total acumulada no período selecionado.</p>
                </div>

                <div class="ds-card-info">
                    <span class="ds-metric-label">Ticket Médio</span>
                    <span class="ds-metric-value" id="valorTicket">R$ 0,00</span>
                    <div class="ds-metric-indicator indicator-pink"></div>
                    <p class="ds-metric-footer">Investimento médio por cliente em cada atendimento.</p>
                </div>

                <div class="ds-card-info">
                    <span class="ds-metric-label">Aproveitamento</span>
                    <span class="ds-metric-value" id="valorOcupacao">0%</span>
                    <div class="ds-metric-indicator indicator-indigo"></div>
                    <p class="ds-metric-footer">Eficiência produtiva baseada na agenda disponível.</p>
                </div>
            </div>

            <div class="ds-charts-grid">
                <div class="ds-card-dark">
                    <h2 class="ds-card-title">Ranking de Serviços</h2>
                    <p class="ds-card-subtitle">Distribuição de valores por categoria de serviço.</p>

                    <div class="ds-btn-scroll" id="catGroup"></div>

                    <div class="ds-chart-container">
                        <canvas id="canvasRanking"></canvas>
                    </div>

                    <div class="ds-description" id="descRanking"></div>
                </div>

                <div class="ds-card-dark">
                    <h2 class="ds-card-title">Fluxo Temporal</h2>
                    <p class="ds-card-subtitle">Desempenho diário de agendamentos na semana.</p>

                    <div class="ds-chart-container">
                        <canvas id="canvasLinha"></canvas>
                    </div>

                    <div class="ds-description">
                        <strong>Análise Estratégica:</strong>
                        O monitoramento temporal permite identificar os "vales" e "picos" de demanda. Utilize estes
                        dados para criar promoções em dias de baixo movimento e otimizar a equipe nos dias de saturação.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">

                <div class="flex flex-col items-center md:items-start">
                    <h2 class="brand-text text-xl font-semibold tracking-tight">
                        Marcella Gonçalves
                    </h2>
                    <p class="text-zinc-500 text-[11px] uppercase tracking-[0.2em] mt-1 font-medium">
                        Web Admin Project
                    </p>
                </div>

                <div class="flex flex-col items-center md:items-end gap-2 text-zinc-400 text-xs">
                    <div class="font-normal">
                        &copy; <span id="year"></span> Todos os direitos reservados.
                    </div>
                    <div class="h-[1px] w-8 bg-zinc-800"></div>
                </div>

            </div>
        </div>
    </footer>


    <script>
        let statusSelecionado = 'trabalho';
        let escopoSelecionado = 'dia';
        const diasSelecionados = new Set();

        window.onload = function() {
            const hoje = new Date().toISOString().split('T')[0];
            document.getElementById('data_especifica').value = hoje;
            atualizarResumo();
        };

        function trocarAba(aba) {

            document
                .getElementById('conteudo-agenda')
                .classList.add('hidden');

            document
                .getElementById('conteudo-relatorios')
                .classList.add('hidden');

            document
                .getElementById('aba-agenda')
                .classList.remove('ativa');

            document
                .getElementById('aba-relatorios')
                .classList.remove('ativa');

            if (aba === 'agenda') {

                document
                    .getElementById('conteudo-agenda')
                    .classList.remove('hidden');

                document
                    .getElementById('aba-agenda')
                    .classList.add('ativa');
            }

            if (aba === 'relatorios') {

                document
                    .getElementById('conteudo-relatorios')
                    .classList.remove('hidden');

                document
                    .getElementById('aba-relatorios')
                    .classList.add('ativa');

                atualizarDashboard();
            }
        }

        function selecionarStatus(valor) {

            statusSelecionado = valor;

            document.getElementById('status_dia').value = valor;

            document.getElementById('btn-trabalho')
                .classList.toggle('ativo', valor === 'trabalho');

            document.getElementById('btn-folga')
                .classList.toggle('ativo', valor === 'folga');

            const containerHorarios =
                document.getElementById('container-horarios');

            const containerAlmoco =
                document.getElementById('container-almoco');

            if (valor === 'trabalho') {

                containerHorarios.classList.remove('hidden');
                containerAlmoco.classList.remove('hidden');

            } else {

                containerHorarios.classList.add('hidden');
                containerAlmoco.classList.add('hidden');
            }

            atualizarResumo();
        }

        function selecionarEscopo(valor) {

            escopoSelecionado = valor;

            document.getElementById('escopo_config').value = valor;

            document.getElementById('btn-dia')
                .classList.toggle('ativo', valor === 'dia');

            document.getElementById('btn-semana')
                .classList.toggle('ativo', valor === 'semana');

            const periodoRecorrencia =
                document.getElementById('periodo-recorrencia');

            if (valor === 'dia') {

                document.getElementById('secao-data')
                    .classList.remove('hidden');

                document.getElementById('secao-semanal')
                    .classList.add('hidden');

                periodoRecorrencia.classList.add('hidden');

            } else {

                document.getElementById('secao-data')
                    .classList.add('hidden');

                document.getElementById('secao-semanal')
                    .classList.remove('hidden');

                periodoRecorrencia.classList.remove('hidden');
            }

            atualizarResumo();
        }

        function toggleDiaSemana(elemento, dia) {
            if (diasSelecionados.has(dia)) {
                diasSelecionados.delete(dia);
                elemento.classList.remove('selecionado');
            } else {
                diasSelecionados.add(dia);
                elemento.classList.add('selecionado');
            }
            atualizarResumo();
        }

        function atualizarResumo() {
            const dataInput = document.getElementById('data_especifica').value;
            const hInicio = document.getElementById('hora_abertura').value;
            const hFim = document.getElementById('hora_fechamento').value;
            const alerta = document.getElementById('alerta-config');
            const btn = document.getElementById('btnSalvar');
            const resStatus = document.getElementById('resumo-status');
            resStatus.innerHTML = statusSelecionado === 'trabalho' ?
                '<span class="badge-status status-aberto">Unidade Aberta</span>' :
                '<span class="badge-status status-fechado">Unidade Fechada</span>';

            document.getElementById('resumo-escopo').innerText = escopoSelecionado === 'dia' ? 'Dia Pontual' : 'Regra Recorrente';

            const resDetalhe = document.getElementById('resumo-detalhe');
            let erro = false;
            let mensagemErro = "";

            if (escopoSelecionado === 'dia') {
                const dataFormatada = dataInput.split('-').reverse().join('/');
                resDetalhe.innerText = dataFormatada || 'Aguardando data...';
                if (!dataInput) {
                    erro = true;
                    mensagemErro = "Indique o dia no calendário.";
                }
            } else {
                const diasAmigaveis = Array.from(diasSelecionados).join(', ');
                resDetalhe.innerText = diasAmigaveis || 'Nenhum dia selecionado';
                if (diasSelecionados.size === 0) {
                    erro = true;
                    mensagemErro = "Selecione pelo menos um dia da semana.";
                }
            }

            const resHoraCont = document.getElementById('resumo-hora-container');
            if (statusSelecionado === 'trabalho') {
                resHoraCont.classList.remove('hidden');
                document.getElementById('resumo-horario').innerText = `${hInicio} — ${hFim}`;
            } else {
                resHoraCont.classList.add('hidden');
            }

            if (erro) {
                alerta.classList.remove('hidden');
                document.getElementById('alerta-texto').innerText = mensagemErro;
                btn.disabled = true;
            } else {
                alerta.classList.add('hidden');
                btn.disabled = false;
            }
        }

        async function salvarConfiguracoes() {
            const btn = document.getElementById('btnSalvar');
            const dataAtualizacao = document.getElementById('data-atualizacao');

            const dataInput = document.getElementById('data_especifica').value;
            let mes = null,
                ano = null;
            if (dataInput && escopoSelecionado === 'dia') {
                const partes = dataInput.split('-');
                ano = partes[0];
                mes = partes[1];
            } else {
                const agora = new Date();
                ano = agora.getFullYear();
                mes = agora.getMonth() + 1;
            }

            const payload = {
                status_dia: statusSelecionado,

                tipo_registro: escopoSelecionado === 'dia' ?
                    'excecao' : 'padrao',

                horario_abertura: statusSelecionado === 'trabalho' ?
                    document.getElementById('hora_abertura').value : '00:00:00',

                horario_fechamento: statusSelecionado === 'trabalho' ?
                    document.getElementById('hora_fechamento').value : '00:00:00',

                inicio_intervalo: statusSelecionado === 'trabalho' ?
                    document.getElementById('inicio_intervalo').value : '00:00:00',

                fim_intervalo: statusSelecionado === 'trabalho' ?
                    document.getElementById('fim_intervalo').value : '00:00:00',

                mes: String(mes).padStart(2, '0'),
                ano: String(ano),

                data_especifica: escopoSelecionado === 'dia' ?
                    dataInput : null,

                dia_semana: escopoSelecionado === 'semana' ?
                    Array.from(diasSelecionados).join(',') : null
            };

            btn.innerHTML = 'Gravando...';
            btn.disabled = true;

            try {
                const response = await fetch("api/agenda/salvar_agenda.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (result.success) {
                    const agora = new Date();
                    dataAtualizacao.innerText = 'Gravado às ' + agora.toLocaleTimeString('pt-BR', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    dataAtualizacao.style.color = '#10B981';
                } else {
                    alert('Erro ao gravar: ' + (result.message || result.error));
                    dataAtualizacao.innerText = 'Erro ao gravar';
                    dataAtualizacao.style.color = '#EF4444';
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro de ligação com o servidor.');
            } finally {
                btn.innerHTML = '<span>Gravar Alterações</span>';
                btn.disabled = false;
            }
        }

        //CALENDARIO

        let calendar;
        let servicosSelecionados = [];
        let agendamentoAtual = null;

        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'pt-br',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                buttonText: {
                    today: 'Hoje'
                },
                events: 'api/agendamentos/buscar_agendamentos.php',
                dayMaxEvents: 2,
                dateClick: (info) => mostrarAgendamentosDia(info.dateStr),
                eventClick: (info) => {
                    info.jsEvent.preventDefault();
                    verDetalhes(info.event.id);
                }
            });
            calendar.render();
            lucide.createIcons();
        });

        async function mostrarAgendamentosDia(dateStr) {
            const container = document.getElementById('agendamentosDiarios');
            const dateObj = new Date(dateStr + 'T00:00:00');
            document.getElementById('tituloDataLista').innerText = dateObj.toLocaleDateString('pt-BR', {
                day: 'numeric',
                month: 'long'
            });

            abrirModal('modalLista');
            container.innerHTML = '<p class="text-center py-4 text-slate-400">Buscando...</p>';

            const events = calendar.getEvents().filter(e => e.startStr.split('T')[0] === dateStr);
            if (events.length === 0) {
                container.innerHTML = '<div class="text-center py-6 opacity-40"><p>Sem agendamentos</p></div>';
                return;
            }

            container.innerHTML = '';
            events.forEach(event => {
                const time = new Date(event.start).toLocaleTimeString('pt-BR', {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                const item = document.createElement('div');
                item.className = 'p-4 bg-slate-50 rounded-xl border border-slate-100 cursor-pointer hover:bg-white hover:border-orange-200 transition-all flex justify-between items-center';
                item.onclick = () => verDetalhes(event.id);
                item.innerHTML = `
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-orange-400">${time}</span>
                        <span class="font-semibold text-slate-700">${event.title.split(' - ')[0]}</span>
                    </div>
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-300"></i>
                `;
                container.appendChild(item);
            });
            lucide.createIcons();
        }

        const dados = {
            manicure: {
                nome: "Manicure",
                servicos: [{
                        nome: "Manicure",
                        tempo: "45 MIN",
                        preco: 35
                    },
                    {
                        nome: "Pedicure",
                        tempo: "45 MIN",
                        preco: 50
                    },
                    {
                        nome: "Alongamento de unhas",
                        tempo: "120 MIN",
                        preco: 120
                    },
                    {
                        nome: "Banho de gel",
                        tempo: "60 MIN",
                        preco: 70
                    },
                    {
                        nome: "Esmaltação permanente",
                        tempo: "45 MIN",
                        preco: 50
                    },
                    {
                        nome: "Spa dos pés",
                        tempo: "40 MIN",
                        preco: 60
                    }
                ]
            },

            massoterapia: {
                nome: "Massoterapia",
                servicos: [{
                        nome: "Massagem relaxante",
                        tempo: "60 MIN",
                        preco: 130
                    },
                    {
                        nome: "Massagem terapêutica",
                        tempo: "60 MIN",
                        preco: 130
                    },
                    {
                        nome: "Drenagem e modeladora",
                        tempo: "60 MIN",
                        preco: 150
                    },
                    {
                        nome: "Bandagem terapêutica (Taping)",
                        tempo: "30 MIN",
                        preco: 80
                    },
                    {
                        nome: "Drenagem pós parto e operatório",
                        tempo: "60 MIN",
                        preco: 160
                    }
                ]
            },

            depilacao: {
                nome: "Depilação",
                filtro: true,
                subs: {
                    facial: {
                        nome: "Facial",
                        servicos: [{
                                nome: "Depilação de Buço",
                                tempo: "15 MIN",
                                preco: 25
                            },
                            {
                                nome: "Depilação de Sobrancelha (Cera)",
                                tempo: "20 MIN",
                                preco: 35
                            },
                            {
                                nome: "Depilação de Rosto Completo",
                                tempo: "40 MIN",
                                preco: 60
                            }
                        ]
                    },

                    corporal: {
                        nome: "Corporal",
                        servicos: [{
                                nome: "Depilação de Axilas",
                                tempo: "20 MIN",
                                preco: 30
                            },
                            {
                                nome: "Depilação de Meia Perna",
                                tempo: "30 MIN",
                                preco: 45
                            },
                            {
                                nome: "Depilação de Perna Inteira",
                                tempo: "50 MIN",
                                preco: 80
                            },
                            {
                                nome: "Depilação de Braços",
                                tempo: "30 MIN",
                                preco: 40
                            }
                        ]
                    },

                    intima: {
                        nome: "Íntima",
                        servicos: [{
                                nome: "Depilação de Virilha Simples",
                                tempo: "30 MIN",
                                preco: 50
                            },
                            {
                                nome: "Depilação de Virilha Completa",
                                tempo: "50 MIN",
                                preco: 90
                            },
                            {
                                nome: "Depilação de Ânus",
                                tempo: "20 MIN",
                                preco: 30
                            }
                        ]
                    }
                }
            },

            lash: {
                nome: "Lash",
                servicos: [{
                        nome: "Extensão de cílios",
                        tempo: "120 MIN",
                        preco: 200
                    },
                    {
                        nome: "Designer de sobrancelhas",
                        tempo: "30 MIN",
                        preco: 60
                    }
                ]
            },

            estetica: {
                nome: "Estética",
                servicos: [{
                        nome: "Preenchimento Labial",
                        tempo: "40 MIN",
                        preco: 1500
                    },
                    {
                        nome: "Botox",
                        tempo: "30 MIN",
                        preco: 1000
                    },
                    {
                        nome: "Aplicação em vasinhos",
                        tempo: "30 MIN",
                        preco: 250
                    },
                    {
                        nome: "Aplicação de enzimas",
                        tempo: "30 MIN",
                        preco: 300
                    }
                ]
            }
        };

        async function verDetalhes(id) {
            try {
                const res = await fetch(`/admin/api/agendamentos/buscar_agendamento.php?id=${id}`);
                const data = await res.json();

                if (data.erro) return;

                agendamentoAtual = data;
                servicosSelecionados = JSON.parse(data.servicos || "[]");

                document.getElementById('edit_id').value = data.id;
                document.getElementById('view_nome').innerText = data.cliente_nome;
                document.getElementById('view_email').innerText = data.cliente_email || 'Sem e-mail';
                document.getElementById('view_whatsapp').innerText = data.cliente_whatsapp;

                document.getElementById('link_whatsapp').href =
                    `https://wa.me/55${data.cliente_whatsapp.replace(/\D/g, '')}`;

                document.getElementById('edit_data').value = data.data;
                document.getElementById('edit_inicio').value = data.hora_inicio;
                document.getElementById('edit_fim').value = data.hora_fim;

                document.getElementById('view_valor').innerText =
                    parseFloat(data.valor_total).toLocaleString('pt-BR', {
                        minimumFractionDigits: 2
                    });

                // STATUS
                const badge = document.getElementById('status_badge');

                const status = data.status
                    .toLowerCase()
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "");

                const textos = {
                    pendente: "Pendente",
                    concluido: "Concluído",
                    cancelado: "Cancelado"
                };

                const cores = {
                    pendente: 'status-pendente',
                    concluido: 'status-concluido',
                    cancelado: 'status-cancelado'
                };

                badge.innerText = textos[status] || status;
                badge.className = `badge-status ${cores[status] || ''}`;

                document.getElementById("status_select").value = status;

                renderizarServicos();

                fecharModal('modalLista');
                abrirModal('modalDetalhes');

                lucide.createIcons();

            } catch (e) {
                console.error(e);
            }
        }

        function abrirAdicionarServico() {

            document
                .getElementById("modalAdicionarServico")
                .classList.add("ativo");
        }

        function carregarServicosCategoria() {
            const categoria = document.getElementById("categoria_servico").value;
            const selectServico = document.getElementById("novo_servico");

            console.log("categoria selecionada:", categoria);
            console.log("dados[categoria]:", dados[categoria]);

            selectServico.innerHTML = `<option value="">Escolha um serviço</option>`;

            if (!categoria) return;

            const categoriaDados = dados[categoria];

            if (!categoriaDados) {
                console.warn("Categoria não encontrada no objeto dados!");
                return;
            }

            if (!categoriaDados.subs) {
                categoriaDados.servicos.forEach(servico => {
                    selectServico.innerHTML += `
                <option value='${JSON.stringify(servico)}'>
                    ${servico.nome} - R$ ${servico.preco}
                </option>
            `;
                });
                return;
            }

            Object.values(categoriaDados.subs).forEach(sub => {
                sub.servicos.forEach(servico => {
                    selectServico.innerHTML += `
                <option value='${JSON.stringify(servico)}'>
                    ${sub.nome} • ${servico.nome} - R$ ${servico.preco}
                </option>
            `;
                });
            });
        }

        function adicionarServicoSelecionado() {

            const valor =
                document.getElementById("novo_servico").value;

            if (!valor) return;

            const servico = JSON.parse(valor);

            servicosSelecionados.push(servico);

            renderizarServicos();

            fecharModal("modalAdicionarServico");

            recalcularHorarioFinal();
        }

        function renderizarServicos() {
            const container = document.getElementById("view_servicos");

            container.innerHTML = "";

            if (!servicosSelecionados.length) {
                container.innerHTML = `
            <div class="caixa-texto bg-slate-50">
                Nenhum serviço adicionado
            </div>
        `;
                return;
            }

            servicosSelecionados.forEach((servico, index) => {
                container.innerHTML += `
            <div class="card-servico">
                <div class="info-servico">
                    <span class="nome-servico">${servico.nome}</span>
                    <span class="meta-servico">
                        ${servico.tempo} • R$ ${servico.preco}
                    </span>
                </div>

                <button type="button"
                    class="botao-remover-servico"
                    onclick="removerServico(${index})">
                    X
                </button>
            </div>
        `;
            });

            lucide.createIcons();
        }

        function recalcularHorarioFinal() {

            const inicio =
                document.getElementById("edit_inicio").value;

            if (!inicio) return;

            let totalMinutos = 0;

            servicosSelecionados.forEach(servico => {

                const minutos = parseInt(servico.tempo);

                totalMinutos += minutos;
            });

            const [hora, minuto] = inicio.split(":").map(Number);

            const data = new Date();

            data.setHours(hora);
            data.setMinutes(minuto);

            data.setMinutes(data.getMinutes() + totalMinutos);

            const horaFinal =
                data.toTimeString().slice(0, 5);

            document.getElementById("edit_fim").value =
                horaFinal;
        }

        function removerServico(index) {

            servicosSelecionados.splice(index, 1);

            renderizarServicos();

            recalcularHorarioFinal();
        }

        function abrirAdicionarServico() {

            document
                .getElementById("modalAdicionarServico")
                .classList.add("ativo");

            document.getElementById("categoria_servico").value = "";
            document.getElementById("novo_servico").innerHTML =
                `<option value="">Escolha um serviço</option>`;
        }

        function carregarServicosCategoria() {

            const selectCategoria = document.getElementById("categoria_servico");
            const selectServico = document.getElementById("novo_servico");

            const categoria = selectCategoria?.value;

            selectServico.innerHTML = `<option value="">Escolha um serviço</option>`;

            if (!categoria || !dados[categoria]) return;

            const categoriaDados = dados[categoria];

            if (categoriaDados.servicos) {

                categoriaDados.servicos.forEach(servico => {
                    selectServico.innerHTML += `
                <option value='${JSON.stringify(servico)}'>
                    ${servico.nome} - R$ ${servico.preco}
                </option>
            `;
                });

                return;
            }

            if (categoriaDados.subs) {

                Object.values(categoriaDados.subs).forEach(sub => {
                    sub.servicos.forEach(servico => {
                        selectServico.innerHTML += `
                    <option value='${JSON.stringify(servico)}'>
                        ${sub.nome} • ${servico.nome} - R$ ${servico.preco}
                    </option>
                `;
                    });
                });
            }
        }

        document.getElementById("formularioEdicao").addEventListener("submit", async function(e) {

            e.preventDefault();

            const dados = {
                id: document.getElementById("edit_id").value,
                status: document.getElementById("status_select").value,
                data: document.getElementById("edit_data").value,
                hora_inicio: document.getElementById("edit_inicio").value,
                hora_fim: document.getElementById("edit_fim").value,
                servicos: servicosSelecionados
            };

            try {

                const resposta = await fetch("api/agendamentos/atualizar_agendamento.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(dados)
                });

                const resultado = await resposta.json();

                if (resultado.sucesso) {
                    alert("Agendamento atualizado!");
                    calendar.refetchEvents();
                    fecharModal("modalDetalhes");
                } else {
                    alert(resultado.erro || "Erro ao atualizar.");
                }

            } catch (erro) {
                console.error("Erro:", erro);
                alert("Erro de conexão.");
            }

        });

        async function cancelarAgendamento() {
            const id = document.getElementById('edit_id').value;

            if (!id) {
                alert("Erro: ID não encontrado!");
                return;
            }

            if (!confirm("Deseja realmente cancelar este atendimento?")) return;

            const res = await fetch('/admin/api/agendamentos/cancelar_agendamento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + encodeURIComponent(id)
            });

            const json = await res.json();

            if (json.sucesso) {
                calendar.refetchEvents();
                fecharModal('modalDetalhes');
            } else {
                alert("Erro ao cancelar: " + json.erro);
            }
        }

        function alterarStatus() {

            const select = document.getElementById("status_select");
            const badge = document.getElementById("status_badge");

            const status = select.value;

            badge.className = "badge-status";

            if (status === "pendente") {
                badge.classList.add("status-pendente");
                badge.innerText = "Pendente";
            }

            if (status === "concluido") {
                badge.classList.add("status-concluido");
                badge.innerText = "Concluído";
            }

            if (status === "cancelado") {
                badge.classList.add("status-cancelado");
                badge.innerText = "Cancelado";
            }
        }

        function confirmarAtualizacao() {
            alert('Agendamento atualizado com sucesso!');
            return true;
        }

        function cancelarAgendamento() {
            if (confirm('Tem certeza que deseja cancelar este agendamento?')) {
                window.location.href = 'api/agendamentos/cancelar_agendamento.php';
            }
        }

        function abrirModal(id) {
            document.getElementById(id).classList.add('ativo');
        }

        function fecharModal(id) {
            document.getElementById(id).classList.remove('ativo');
        }

        window.onclick = (e) => {
            if (e.target.classList.contains('sobreposicao-modal')) {
                fecharModal('modalLista');
                fecharModal('modalDetalhes');
            }
        };

        function carregarAnos() {

            const selectAno = document.getElementById("filtroAno");

            const anoAtual = new Date().getFullYear();

            for (let ano = anoAtual + 1; ano >= 2020; ano--) {

                const option = document.createElement("option");

                option.value = ano;
                option.textContent = ano;

                if (ano === anoAtual) {
                    option.selected = true;
                }

                selectAno.appendChild(option);
            }

        }

        function carregarAnos() {

            const selectAno = document.getElementById("filtroAno");

            const anoAtual = new Date().getFullYear();

            for (let ano = anoAtual + 1; ano >= 2020; ano--) {

                const option = document.createElement("option");

                option.value = ano;
                option.textContent = ano;

                if (ano === anoAtual) {
                    option.selected = true;
                }

                selectAno.appendChild(option);
            }

        }

        document.addEventListener("DOMContentLoaded", () => {

            carregarAnos();

            atualizarDashboard();

        });

        const DADOS_AGENDA = {
            manicure: {
                nome: "Manicure",
                servicos: [{
                        nome: "Manicure",
                        preco: 35
                    },
                    {
                        nome: "Pedicure",
                        preco: 50
                    },
                    {
                        nome: "Alongamento",
                        preco: 120
                    },
                    {
                        nome: "Banho de gel",
                        preco: 70
                    },
                    {
                        nome: "Esmaltação",
                        preco: 50
                    },
                    {
                        nome: "Spa dos pés",
                        preco: 60
                    }
                ]
            },
            massoterapia: {
                nome: "Massoterapia",
                servicos: [{
                        nome: "Relaxante",
                        preco: 130
                    },
                    {
                        nome: "Terapêutica",
                        preco: 130
                    },
                    {
                        nome: "Modeladora",
                        preco: 150
                    },
                    {
                        nome: "Taping",
                        preco: 80
                    },
                    {
                        nome: "Pós Parto",
                        preco: 160
                    }
                ]
            },
            depilacao: {
                nome: "Depilação",
                isNested: true,
                subs: {
                    facial: {
                        nome: "Facial",
                        servicos: [{
                            nome: "Buço",
                            preco: 25
                        }, {
                            nome: "Sobrancelha",
                            preco: 35
                        }]
                    },
                    corporal: {
                        nome: "Corporal",
                        servicos: [{
                            nome: "Axila",
                            preco: 30
                        }, {
                            nome: "Meia Perna",
                            preco: 45
                        }]
                    },
                    intima: {
                        nome: "Íntima",
                        servicos: [{
                            nome: "Virilha",
                            preco: 90
                        }, {
                            nome: "Ânus",
                            preco: 30
                        }]
                    }
                }
            },
            lash: {
                nome: "Lash",
                servicos: [{
                    nome: "Cílios",
                    preco: 200
                }, {
                    nome: "Designer",
                    preco: 60
                }]
            },
            estetica: {
                nome: "Estética",
                servicos: [{
                    nome: "Preenchimento",
                    preco: 1500
                }, {
                    nome: "Botox",
                    preco: 1000
                }]
            }
        };

        let chartRanking = null;
        let chartLinha = null;
        let categoriaAtual = 'manicure';

        function init() {
            const hoje = new Date();
            document.getElementById('filtroMes').value = hoje.getMonth() + 1;

            const sAno = document.getElementById('filtroAno');
            const ano = hoje.getFullYear();
            for (let i = 0; i < 3; i++) {
                const opt = document.createElement('option');
                opt.value = ano - i;
                opt.innerText = ano - i;
                if (i === 0) opt.selected = true;
                sAno.appendChild(opt);
            }

            const group = document.getElementById('catGroup');
            Object.keys(DADOS_AGENDA).forEach(key => {
                const btn = document.createElement('button');
                btn.className = `ds-btn-cat ${key === categoriaAtual ? 'active' : ''}`;
                btn.innerText = DADOS_AGENDA[key].nome;
                btn.onclick = (e) => mudarCategoria(key, e.target);
                group.appendChild(btn);
            });

            atualizarDashboard();
        }

        function mudarCategoria(key, btn) {
            categoriaAtual = key;
            document.querySelectorAll('.ds-btn-cat').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            renderRanking();
        }
        async function atualizarDashboard() {

            try {

                const mes = document.getElementById("filtroMes").value;
                const ano = document.getElementById("filtroAno").value;

                const resposta = await fetch(
                    `api/relatorios/buscar_metricas.php?mes=${mes}&ano=${ano}`
                );

                const dados = await resposta.json();

                if (!dados.success) return;

                document.getElementById("valor-metricas").innerText =
                    Number(dados.faturamento_bruto).toLocaleString("pt-BR", {
                        style: "currency",
                        currency: "BRL"
                    });

                document.getElementById("valorTicket").innerText =
                    Number(dados.ticket_medio).toLocaleString("pt-BR", {
                        style: "currency",
                        currency: "BRL"
                    });

                document.getElementById("valorOcupacao").innerText =
                    `${Number(dados.taxa_ocupacao).toFixed(1)}%`;

                renderRanking();
                renderLinha();

            } catch (erro) {

                console.error("Erro dashboard:", erro);

            }

        }

        async function renderRanking() {

            try {

                const mes = document.getElementById('filtroMes').value;
                const ano = document.getElementById('filtroAno').value;

                const url = `api/relatorios/buscar_ranking.php?mes=${mes}&ano=${ano}&categoria=${categoriaAtual}`;

                const resposta = await fetch(url);
                const dados = await resposta.json();

                if (!dados.success) return;

                const canvas = document.getElementById('canvasRanking');
                if (!canvas) return;

                const ctx = canvas.getContext('2d');

                if (chartRanking) chartRanking.destroy();

                const labels = dados.ranking.map(item => item.nome);
                const valores = dados.ranking.map(item => item.valor);

                document.getElementById('descRanking').innerHTML = `
            <strong>Análise Estratégica:</strong>
            O gráfico apresenta os serviços com maior faturamento no período selecionado.
            Utilize essas informações para identificar os serviços mais rentáveis do salão.
        `;

                const grad = ctx.createLinearGradient(0, 0, 400, 0);
                grad.addColorStop(0, '#FD987E');
                grad.addColorStop(1, '#FAA7D5');

                chartRanking = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: valores,
                            backgroundColor: grad,
                            borderRadius: 6,
                            barThickness: 16
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(255,255,255,0.05)'
                                },
                                ticks: {
                                    color: '#64748B',
                                    font: {
                                        size: 10
                                    },
                                    callback: value => 'R$ ' + value.toLocaleString('pt-BR')
                                }
                            },
                            y: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#F1F5F9',
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        }
                    }
                });

            } catch (erro) {
                console.error("Erro ranking:", erro);
            }
        }

        async function renderLinha() {

            const canvas = document.getElementById('canvasLinha');
            if (!canvas) return;

            const mes = document.getElementById('filtroMes').value;
            const ano = document.getElementById('filtroAno').value;

            const resposta = await fetch(`api/relatorios/buscar_fluxo_semanal.php?mes=${mes}&ano=${ano}`);
            const dados = await resposta.json();

            if (!dados.success) return;

            const ctx = canvas.getContext('2d');

            if (chartLinha) chartLinha.destroy();

            const grad = ctx.createLinearGradient(0, 0, 0, 300);
            grad.addColorStop(0, 'rgba(253, 152, 126, 0.3)');
            grad.addColorStop(1, 'rgba(253, 152, 126, 0)');

            chartLinha = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dados.labels,
                    datasets: [{
                        data: dados.valores,
                        borderColor: '#FD987E',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        backgroundColor: grad,
                        pointRadius: 4,
                        pointBackgroundColor: '#FFF'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                color: 'rgba(255,255,255,0.05)'
                            },
                            ticks: {
                                color: '#64748B',
                                callback: value => 'R$ ' + value.toLocaleString('pt-BR')
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#64748B'
                            }
                        }
                    }
                }
            });
        }
        window.addEventListener('load', init);
    </script>

</body>

</html>