<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false,
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();
require_once "config/db_config.php";

$logado = isset($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcella Gonçalves | Home</title>

    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta name="referrer" content="strict-origin-when-cross-origin">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">

    <style>
        /* ============================================================
   1. CONFIGURAÇÕES GERAIS E VARIÁVEIS
   ============================================================ */
        :root {
            --color-1: #FFA461;
            --color-2: #FD987E;
            --color-3: #FD9585;
            --color-4: #FAA7D5;
            --text-dark: #333333;
            --color-accent: #FC8C9B;
            --bg-light: #fdfdfd;
            --agendador-gradient: linear-gradient(225deg, #ffa361e7 0%, #fd977eea 15%, #fd9585e8 50%, #FAA7D5 97%);
            --cor-branco: #ffffff;
            --cor-texto: #333333;
            --raio-borda: 25px;
            --primary-pink: #f8e7eb;
            --border-gradient: linear-gradient(135deg, #ff9a9e, #fad0c4);
            --text-muted: #666666;
            --cor-borda-suave: #eeeeee;
            --sombra-leve: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --cor-preto-footer: #000000;
            --bg-gradient: linear-gradient(135deg, #FF9E7A 0%, #FF7A7A 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.45);
            --item-bg: rgba(255, 255, 255, 0.15);
            --text-white: #ffffff;
            --accent: #FF7A7A;
            --input-fill: #ffffff;
            --input-text: #2d3436;
            --termos-bg: rgba(255, 255, 255, 0.85);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-dark);
            background-color: #ffffff;
            overflow-x: hidden;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }


        /* ============================================================
   NAV PRINCIPAL (BASE)
============================================================ */
        .header-wrapper {
            background: linear-gradient(to right, var(--color-1), var(--color-2), var(--color-3), var(--color-4));
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 100dvh;
            padding-top: 60px;
            padding-bottom: 80px;
        }

        .nav-principal {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
        }

        .links-institucionais {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-link {
            font-size: 11px;
            font-weight: 700;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: 0.3s;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .nav-link:hover {
            opacity: 0.7;
        }

        .botao-agendar {
            background: #ffffff;
            color: var(--color-2);
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .botao-agendar:hover {
            transform: scale(1.05);
            background: var(--text-dark);
            color: #fff;
        }

        .nav-principal.nav-scroll {
            background: #ffffff !important;
            backdrop-filter: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 15px 8%;
            border-bottom: 1px solid #eee;
        }

        .nav-principal.nav-scroll .logo-text {
            color: var(--text-dark);
        }

        .nav-principal.nav-scroll .nav-link {
            color: #333 !important;
            text-shadow: none;
        }

        .nav-principal.nav-scroll .user-greeting {
            color: #333;
        }

        .nav-principal.nav-scroll .user-sub {
            color: #777;
        }

        .nav-principal.nav-scroll .user-info {
            background: rgba(0, 0, 0, 0.05);
        }

        .nav-principal.nav-scroll .botao-agendar {
            background: linear-gradient(135deg, #FD9585, #FAA7D5);
            color: #fff;
        }

        .nav-principal.nav-scroll .btn-logout {
            border: 1px solid #ddd;
            color: #333;
        }

        .nav-principal.nav-scroll .btn-logout:hover {
            background: #FD9585;
            color: #fff;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 10px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #FD9585, #FAA7D5);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .user-texto {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-greeting {
            font-size: 13px;
            font-weight: 700;
            color: #fff;
        }

        .user-sub {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-logout {
            margin-left: 10px;
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.4);
            color: #fff;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-logout:hover {
            background: #fff;
            color: #FD9585;
        }

        .btn-conta {
            margin-left: 10px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background: #fff;
            color: #FD9585;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn-conta:hover {
            background: transparent;
            color: #fff;
        }

        .acoes-usuario {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .btn-adm a {
            background: #ffffff;
            color: var(--color-2);
            padding: 10px 25px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-adm a:hover {
            transform: scale(1.05);
            background: var(--text-dark);
            color: #fff;
        }

        .oculto,
        .escondido {
            display: none !important;
        }

        @media (max-width: 992px) {
            .header-wrapper {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                -webkit-mask-image: none;
                mask-image: none;
            }

            #inicio {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding: 110px 5% 0;
            }

            .conteudo-hero {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                gap: 0;
            }

            .container-foto {
                display: flex !important;
                order: 2;
                width: 100%;
                justify-content: center;
                margin-bottom: -50px;
                z-index: 5;
            }

            .foto-recortada {
                max-height: 55vh;
                width: auto;
                object-fit: contain;
                filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.25));
            }

            .nome-imagem-logo {
                order: 3;
                max-width: 85%;
                margin: 0 auto 15px;
                z-index: 10;
                filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
            }

            .descricao-hero {
                padding: 30px 15px 0;
                max-width: 500px;
                margin: 0 auto;
                text-align: justify;
                text-indent: 30px;
                hyphens: auto;
                font-size: 15px;
            }

            .descricao-hero::before {
                left: 50%;
                top: 0;
                bottom: auto;
                width: 60px;
                height: 2px;
                transform: translateX(-50%);
                background: rgba(255, 255, 255, 0.6);
            }

            .texto-principal {
                display: contents;
            }
        }

        @media (max-width: 600px) {
            .agendador {
                padding: 20px;
            }

            .filtros .item {
                padding: 7px 12px;
                font-size: 0.85rem;
            }
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 2000;
        }

        .menu-toggle .bar {
            width: 25px;
            height: 3px;
            background-color: #fff;
            border-radius: 2px;
            transition: 0.3s;
        }

        .nav-principal.nav-scroll .menu-toggle .bar {
            background-color: #333;
        }

        @media (max-width: 992px) {
            .menu-toggle {
                display: flex !important;
                position: relative;
                z-index: 2001;
            }

            .menu-toggle .bar {
                width: 25px;
                height: 3px;
                background-color: #ffffff;
                border-radius: 2px;
                transition: 0.3s;
            }

            .nav-principal.nav-scroll .menu-toggle .bar {
                background-color: #333333 !important;
            }

            .menu-toggle.active .bar {
                background-color: var(--color-2) !important;
            }

            .links-institucionais,
            .acoes-usuario,
            .btn-adm {
                position: fixed;
                right: -100%;
                background: #000000;
                transition: 0.4s ease-in-out;
                display: flex;
                flex-direction: column;
                align-items: center;
                z-index: 1500;
            }

            .links-institucionais {
                position: fixed;
                right: -100%;
                top: 0;
                background: #fff;
                width: 280px;
                height: 100vh;
                flex-direction: column;
                padding-top: 100px;
                transition: 0.4s;
                z-index: 1500;
            }

            .acoes-usuario {
                margin-top: 40px;
                top: 450px;
                right: -100%;
                width: 280px;
                gap: 20px;
            }

            .btn-adm {
                top: 380px;
                right: -100%;
                width: 280px;
            }

            .nav-principal.menu-aberto .links-institucionais,
            .nav-principal.menu-aberto .acoes-usuario,
            .nav-principal.menu-aberto .btn-adm {
                right: 0;
            }

            .nav-link {
                color: var(--text-dark) !important;
                font-size: 16px !important;
            }

            .user-info {
                background: rgba(0, 0, 0, 0.05);
                backdrop-filter: none;
            }

            .user-greeting {
                color: var(--text-dark);
            }

            .user-sub {
                color: rgba(0, 0, 0, 0.6);
            }

            .btn-logout {
                color: var(--text-dark);
                border: 1px solid rgba(0, 0, 0, 0.2);
            }

            .btn-logout:hover {
                background: var(--color-2);
                color: #fff;
            }

            .user-greeting {
                color: var(--text-dark);
                margin-bottom: 10px;
                display: block;
            }

            .menu-toggle.active .bar:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
                background-color: var(--color-2);
            }

            .menu-toggle.active .bar:nth-child(2) {
                opacity: 0;
            }

            .menu-toggle.active .bar:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
                background-color: var(--color-2);
            }
        }

        /* ============================================================
   3. HERO SECTION (#inicio)
   ============================================================ */

        #inicio {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5%;
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
        }

        .conteudo-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1800px;
            margin-top: var(--header-height);
            height: calc(100vh - var(--header-height) - 40px);
        }

        .texto-principal {
            flex: 0 0 55%;
            z-index: 10;
        }

        .nome-imagem-logo {
            max-width: 100%;
            width: clamp(300px, 45vw, 850px);
            height: auto;
            display: block;
            margin-left: -10px;
            margin-bottom: 30px;
            filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
        }

        .descricao-hero {
            font-weight: 300;
            line-height: 1.9;
            opacity: 0.95;
            max-width: 600px;
            font-size: clamp(1rem, 1.1vw, 1.25rem);
            letter-spacing: 0.2px;
            position: relative;
            padding-left: 25px;
            color: #FFF;
        }

        .descricao-hero::before {
            content: '';
            position: absolute;
            left: 0;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background: rgba(255, 255, 255, 0.5);
            transition: all 0.4s ease;
        }

        .container-foto {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            height: 100%;
        }

        .aura-luz {
            position: absolute;
            width: 140%;
            height: 140%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
        }

        .moldura-organica-quadrada {
            position: relative;
            width: clamp(240px, 22vw, 400px);
            aspect-ratio: 3 / 4;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(25px);
            border: 2px solid rgba(255, 255, 255, 0.7);
            box-shadow:
                0 0 0 10px rgba(255, 255, 255, 0.05),
                0 40px 100px -20px rgba(0, 0, 0, 0.35);
            border-radius: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 5;
            padding: 12px;
            animation: flutuarHero 6s ease-in-out infinite;
        }

        @keyframes flutuarHero {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .video-wrapper {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 30px;
            position: relative;
            background: #000;
            display: block;
            object-fit: cover;
        }

        .video-wrapper video {
            width: 100%;
            height: 100%;
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
            display: block;
        }

        .foto-recortada {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            width: 100%;
            height: 100%;
            min-width: 100%;
            min-height: 100%;

            object-fit: cover;
            filter: contrast(1.05) brightness(1.05);
        }

        .frase-bemvinda {
            position: absolute;
            top: -20px;
            left: -30px;

            background: rgba(255, 255, 255, 0.98);
            color: var(--color-3);

            padding: 10px 25px;
            border-radius: 30px 30px 30px 5px;

            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(0.85rem, 1.2vw, 1.1rem);

            white-space: nowrap;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);

            z-index: 25;
            border: 1px solid white;
        }

        .brilho {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0;
            z-index: 7;
            animation: brilhar 4s infinite;
        }

        @keyframes brilhar {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.2);
                box-shadow: 0 0 10px white;
            }
        }

        .borboleta {
            position: absolute;
            width: clamp(40px, 4vw, 55px);
            height: auto;
            z-index: 15;
        }

        .asa {
            fill: #ffffff;
            transform-origin: center;
            animation: flap 0.2s infinite alternate ease-in-out;
        }

        .corpo-borboleta {
            fill: var(--color-accent);
        }

        .borboleta-topo {
            top: 5%;
            right: -12%;
            transform: rotate(15deg);
        }

        .borboleta-base {
            bottom: 10%;
            left: -12%;
            transform: rotate(-10deg);
        }

        @keyframes flap {
            from {
                transform: scaleX(1);
            }

            to {
                transform: scaleX(0.3);
            }
        }

        @media (max-width: 768px) {
            #inicio {
                height: auto;
                min-height: 100vh;
                padding: 100px 5% 40px;
            }

            .conteudo-hero {
                flex-direction: column;
                justify-content: center;
                height: auto;
                gap: 40px;
            }

            .texto-principal {
                flex: none;
                text-align: center;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .nome-imagem-logo {
                margin-left: 0;
            }

            .moldura-organica-quadrada {
                width: 260px;
            }
        }

        /* ============================================================
   4. SEÇÃO BOAS-VINDAS
   ============================================================ */

        .secao-boas-vindas {
            background: #fff;
            padding: 80px 8% 100px;
            text-align: center;
            position: relative;
            z-index: 5;
            margin-top: -50px;
        }

        .titulo-boas-vindas {
            font-family: 'Playfair Display', serif;
            font-size: clamp(26px, 5vw, 40px);
            color: #222;
            margin-bottom: 90px;
            font-weight: 300 !important;
        }

        .titulo-boas-vindas b {
            font-weight: 700;
        }

        .highlight-text {
            color: var(--color-accent);
        }

        .texto-apoio {
            max-width: 900px;
            margin: 0 auto;
            color: #555;
            font-size: clamp(16px, 2.5vw, 25px);
            line-height: 1.8;
        }


        /* ============================================================
   5. SEÇÃO AGENDADOR
   ============================================================ */

        .agendador {
            background: linear-gradient(180deg, #ff9e67 0%, #fd8a8a 50%, #f9a1d0 100%);
            border-radius: 30px;
            padding: 30px;
            color: white;
            max-width: 550px;
            margin: 20px auto;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
            font-family: 'Segoe UI', sans-serif;

        }

        .agendador .topo {
            font-size: 1.5rem;
            font-weight: 800;
            text-transform: uppercase;
            text-align: center;
            letter-spacing: 2px;
            margin-bottom: 12px;
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .agendador .subtitulo {
            display: block;
            font-size: 0.85rem;
            text-transform: uppercase;
            opacity: 0.8;
            text-align: center;
            margin-bottom: 22px;
        }


        /* ============================================================
   FILTROS E CATEGORIAS
   ============================================================ */

        #categorias,
        #subcategorias {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        #categorias {
            gap: 12px 10px;
            margin-bottom: 20px;
        }

        #subcategorias {
            gap: 8px 10px;
            margin-bottom: 18px;
        }

        #subcategorias .item {
            padding: 6px 12px;
            border-radius: 30px;
            border: 1px solid #fff;
            background: transparent;
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        #subcategorias .item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.04);
        }

        #subcategorias .item.ativo {
            background: #fff;
            color: #fd8a8a;
            border: none;
            font-weight: 700;
        }

        .filtros .item {
            padding: 8px 14px;
            border-radius: 30px;
            border: 1.5px solid #fff;
            background: transparent;
            color: #fff;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.3s;
        }

        .filtros .item:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .filtros .item.ativo {
            background: #fff;
            border: none;
            color: #fd8a8a;
            font-weight: 700;
        }


        /* ============================================================
   LISTA DE SERVIÇOS
   ============================================================ */
        .lista .servico {
            display: flex;
            justify-content: space-between;
            align-items: center;
            ;
            padding: 12px 16px;
            margin: 8px 0;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.51);
            color: #333;
            cursor: pointer;
            transition: 0.25s ease;
        }

        .lista .info-servico {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 4px;
        }

        .lista .nome {
            font-weight: 700;
            font-size: 14px;
            line-height: 1;
            margin: 0;
            align-items: flex-start;
        }

        .lista .tempo {
            font-size: 12px;
            color: #666;
            line-height: 1;
            margin: 0;
            align-items: flex-start;
        }

        .lista .preco {
            font-weight: 700;
            font-size: 14px;
        }

        .servico .tempo {
            text-align: left;
        }


        /* ============================================================
   BOTÃO
   ============================================================ */

        .agendador .botao {
            width: 100%;
            padding: 16px;
            margin-top: 15px;
            border-radius: 15px;
            border: none;
            background: #fff;
            color: #fd8a8a;
            font-size: 1rem;
            font-weight: 800;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .agendador .botao:hover {
            background: #fafafa;
            transform: scale(1.02);
        }


        /* ============================================================
   RESUMO
   ============================================================ */

        .resumo-selecionados {
            max-width: 420px;
            margin: 20px auto;
            padding: 15px;
            border-radius: 16px;
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .resumo-selecionados h4 {
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: 700;
            color: #333;
        }

        #lista-selecionados li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 12px;
            margin-bottom: 8px;
            border-radius: 10px;
            background: #fafafa;
            transition: 0.2s;
        }

        #lista-selecionados li:hover {
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .resumo-item-info {
            display: flex;
            flex-direction: column;
        }

        .resumo-nome {
            font-size: 13px;
            font-weight: 600;
            color: #333;
        }

        .resumo-preco {
            font-size: 12px;
            color: #888;
        }

        .remover {
            background: none;
            border: none;
            font-size: 18px;
            color: #bbb;
            cursor: pointer;
            transition: 0.2s;
        }

        .remover:hover {
            color: #FD9585;
            transform: scale(1.2);
        }

        #total-geral {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
            font-weight: 700;
            color: #FD9585;
        }


        /* ============================================================
   AGENDA (CALENDÁRIO + HORÁRIOS)
   ============================================================ */

        .agenda {
            display: flex;
            gap: 25px;
            align-items: flex-start;
            margin-top: 20px;
        }

        .calendario-container {
            flex: 1;
            padding: 20px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
        }

        .mes {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: 800;
            text-transform: capitalize;
        }

        .mes span {
            padding: 8px 15px;
            border-radius: 12px;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--glass-border);
            transition: 0.2s;
        }

        .mes span:hover {
            background: white;
            color: var(--accent);
        }

        .dias-semana {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            margin-bottom: 15px;
            font-size: 13px;
            font-weight: 800;
            text-align: center;
            text-transform: uppercase;
            color: var(--text-white);
            opacity: 0.9;
        }

        .grade {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }

        .dia-item {
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            background: var(--item-bg);
            border: 1px solid var(--glass-border);
            transition: 0.25s;
        }

        .dia-item:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
        }

        .dia-item.selecionado {
            background: white;
            color: var(--accent);
            border-color: white;
            transform: scale(1.1);
        }

        .dia-item.hoje {
            border: 2px solid white;
        }

        .dia-item.desativado {
            opacity: 0.2;
            cursor: not-allowed;
            background: transparent;
        }


        /* ============================================================
   HORÁRIOS
   ============================================================ */

        .horarios {
            width: 220px;
            max-height: 450px;
            padding: 20px;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--glass-border);
        }

        .titulo-horarios {
            margin-bottom: 15px;
            font-size: 16px;
            font-weight: 800;
            text-align: center;
        }

        #horas {
            overflow-y: auto;
            padding-right: 5px;
        }

        #horas::-webkit-scrollbar {
            width: 4px;
        }

        #horas::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .hora-item {
            padding: 12px;
            margin-bottom: 8px;
            border-radius: 12px;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
            background: var(--item-bg);
            border: 1px solid var(--glass-border);
            transition: 0.2s;
        }

        .hora-item:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(5px);
        }

        .hora-item.ativo {
            background: white;
            color: var(--accent);
        }


        /* ============================================================
   CONFIRMAÇÃO
   ============================================================ */

        .confirmacao-container {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .subtitulo-confirmacao {
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: white;
        }

        .campo-confirmacao {
            width: 100%;
            padding: 15px 18px;
            border-radius: 14px;
            border: 2px solid transparent;
            background: var(--input-fill);
            color: var(--input-text);
            font-weight: 600;
            outline: none;
            transition: 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .campo-confirmacao:focus {
            border-color: white;
            transform: translateY(-2px);
        }

        .termos {
            margin: 8px 0;
            padding: 20px 20px 20px 40px;
            border-radius: 18px;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.6;
            color: #444;
            background: var(--termos-bg);
            border: 1px solid var(--glass-border);
        }

        .termos li {
            margin-bottom: 6px;
        }

        .checkbox-termo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            border-radius: 14px;
            cursor: pointer;
            font-weight: 700;
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid var(--glass-border);
            transition: 0.2s;
        }

        .checkbox-termo:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .checkbox-termo input {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #ff5e5e;
        }

        .notificacao {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #1e1e1e;
            color: #fff;
            padding: 14px 18px;
            border-radius: 10px;
            font-size: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 9999;

            transform: translateX(120%);
            opacity: 0;
            transition: all 0.4s ease;
        }

        .notificacao.show {
            transform: translateX(0);
            opacity: 1;
        }

        .notificacao.sucesso {
            background: linear-gradient(135deg, #22c55e, #16a34a);
        }

        .notificacao.erro {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .oculto {
            display: none;
        }


        /* ============================================================
   RESPONSIVO
   ============================================================ */

        @media (max-width: 768px) {
            .agenda {
                flex-direction: column;
            }

            .horarios {
                width: 100% !important;
            }
        }

        /* ============================================================
   6. SEÇÕES GENÉRICAS
   ============================================================ */

        section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            padding: 60px 8% 80px;
            min-height: auto;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(24px, 4vw, 36px);
            color: var(--text-dark);
            text-align: center;
            margin: 0 0 20px;
            font-weight: 300 !important;
            line-height: 1.2;
            text-transform: uppercase;
            border: none !important;
            background: none !important;
        }

        .section-title b {
            font-weight: 700 !important;
            color: var(--color-accent);
        }

        .section-title * {
            background: none !important;
        }

        .section-subtitle {
            display: block;
            margin-bottom: 45px;
            padding: 0 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            color: var(--text-muted);
        }


        /* ============================================================
   SEÇÃO SERVIÇOS
   ============================================================ */

        #servicos {
            display: block;
            position: relative;
            width: 100%;
            clear: both;
            padding: 60px 15px;
            text-align: center;
            font-family: 'Playfair Display', serif;
            background-color: #fffafa;
        }


        /* ============================================================
   CARROSSEL
   ============================================================ */

        .carrossel-wrapper {
            position: relative;
            width: 100%;
            max-width: 1100px;
            margin: 0 auto 50px;
            padding: 0;
        }

        .carrossel-viewport {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .services-grid {
            display: flex;
            gap: 30px;
            padding: 15px 0;
            cursor: pointer;
            transition: transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
            will-change: transform;
        }


        /* ============================================================
   CARD DE SERVIÇO
   ============================================================ */

        .service-card {
            flex: 0 0 calc((100% - 60px) / 3);
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 420px;
            padding: 35px 20px;
            border-radius: var(--raio-borda);
            background: white;
            border: 1px solid var(--cor-borda-suave);
            box-shadow: var(--sombra-leve);
            position: relative;
            box-sizing: border-box;
            user-select: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 2.5px;
            border-radius: var(--raio-borda);
            background: var(--border-gradient);
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            pointer-events: none;
            z-index: 2;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border-color: var(--color-accent);
        }


        /* ============================================================
   IMAGEM
   ============================================================ */

        .image-container {
            width: 170px;
            height: 170px;
            margin-bottom: 25px;
            border-radius: 50%;
            overflow: hidden;
            border: 4px solid #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }


        /* ============================================================
   TEXTO CARD
   ============================================================ */

        .service-card h3 {
            margin: 10px 0;
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 600;
            line-height: 1.2;
            text-align: center;
            color: var(--text-dark);
        }

        .service-card h3 b,
        .service-card h3 em {
            font-weight: 700;
            font-style: italic;
            color: var(--color-accent);
        }

        .service-card p {
            margin-top: auto;
            max-width: 90%;
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--text-muted);
        }


        /* ============================================================
   BOTÕES DE NAVEGAÇÃO
   ============================================================ */

        .nav-btn {
            position: absolute;
            top: 55%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background: white;
            color: var(--text-dark);
            font-size: 18px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .nav-btn:hover:not(:disabled) {
            background: var(--color-accent);
            color: white;
        }

        .nav-btn:disabled {
            opacity: 0.2;
            cursor: not-allowed;
        }

        .btn-prev {
            left: -60px;
        }

        .btn-next {
            right: -60px;
        }


        /* ============================================================
   SEÇÃO BELEZA
   ============================================================ */

        .secao-beleza {
            padding: 60px 8% 80px;
            min-height: auto;
            background-color: #ff99cc;
        }

        .titulo-serifado {
            font-family: 'Playfair Display', serif;
            letter-spacing: 0.05em;
            color: #1a1a1a;
        }

        .texto-destaque-rosa {
            color: #d65a8a;
            font-style: italic;
        }

        .rotulo-listagem {
            display: block;
            margin-bottom: 24px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #333333;
        }


        /* ============================================================
   CARD CURSO
   ============================================================ */

        .cartao-curso {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem;
            border-radius: 1.25rem;
            background-color: #d65a8a;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .cartao-curso:hover {
            transform: translateY(-2px);
        }

        .container-icone {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .estrela-icone {
            width: 24px;
            height: 24px;
            fill: #d65a8a;
        }

        .conteudo-curso {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .titulo-curso {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
        }

        .detalhes-curso {
            margin: 0;
            font-size: 0.875rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
        }

        .botao-informacoes {
            padding: 10px 24px;
            border-radius: 9999px;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            color: #d65a8a;
            background-color: white;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .botao-informacoes:hover {
            background-color: #fff0f6;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }


        /* ============================================================
   RESPONSIVO
   ============================================================ */

        @media (max-width: 1200px) {
            .carrossel-wrapper {
                max-width: 90%;
            }

            .btn-prev {
                left: -40px;
            }

            .btn-next {
                right: -40px;
            }
        }

        @media (max-width: 992px) {
            .service-card {
                flex: 0 0 calc((100% - 30px) / 2);
            }

            .btn-prev {
                left: -30px;
            }

            .btn-next {
                right: -30px;
            }
        }

        @media (max-width: 768px) {
            .nav-btn {
                display: none;
            }

            .service-card {
                flex: 0 0 85%;
                scroll-snap-align: center;
            }

            .carrossel-viewport {
                overflow-x: auto;
                scroll-snap-type: x mandatory;
            }

            .services-grid {
                gap: 20px;
            }

            .secao-beleza {
                padding: 40px 5%;
            }

            .cartao-curso {
                flex-direction: column;
                text-align: center;
            }

            .conteudo-curso {
                flex-direction: column;
            }

            .botao-informacoes {
                width: 100%;
                text-align: center;
            }
        }

        /* ============================================================
   7. RESULTADOS (GALERIA)
   ============================================================ */

        #resultados {
            background-color: #fffafa;
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 100px 8%;
            box-sizing: border-box;
            position: relative;
            z-index: 10;
        }

        .grade-galeria {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 15px;
            max-width: 1400px;
            width: 100%;
            height: 68vh;
        }

        .item-galeria {
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: var(--raio-borda);
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .item-galeria:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .item-galeria img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
        }

        .item-galeria:hover img {
            transform: scale(1.05);
        }

        .foto-1 {
            grid-column: span 3;
        }

        .foto-2 {
            grid-column: span 4;
        }

        .foto-3 {
            grid-column: span 3;
        }

        .foto-4 {
            grid-column: span 2;
        }

        .foto-5 {
            grid-column: span 4;
        }

        .foto-6 {
            grid-column: span 3;
        }

        .foto-7 {
            grid-column: span 5;
        }


        /* ============================================================
   8. VISUALIZADOR (MODAL IMAGEM)
   ============================================================ */

        .visualizador {
            position: fixed;
            inset: 0;
            background-color: var(--fundo-modal);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity var(--velocidade-transicao) ease;
        }

        .visualizador.ativo {
            display: flex;
            opacity: 1;
        }

        .imagem-expandida {
            max-width: 95vw;
            max-height: 95vh;
            object-fit: contain;
            border-radius: 5px;
            transform: scale(0.9);
            transition: transform var(--velocidade-transicao) ease-out;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
        }

        .visualizador.ativo .imagem-expandida {
            transform: scale(1);
        }

        .botao-fechar {
            position: fixed;
            top: 100px;
            right: 40px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 60px;
            font-weight: 200;
            color: #ffffff !important;
            cursor: pointer;
            z-index: 100001;
            transition: all 0.3s ease;
            background: transparent !important;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 1);
            line-height: 1;
            pointer-events: auto;
        }

        .botao-fechar:hover {
            transform: scale(1.15) rotate(90deg);
            background: #f8f8f8 !important;
        }


        /* ============================================================
   9. LOCALIZAÇÃO
   ============================================================ */

        #localizacao {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            background-color: #fffafa;
        }

        .cartao-visita {
            background-color: var(--cor-branco);
            max-width: 900px;
            width: 100%;
            max-height: 95vh;
            padding: clamp(20px, 4vh, 40px);
            border-radius: var(--raio-borda);
            border: 1px solid var(--cor-borda-suave);
            box-shadow: var(--sombra-leve);
            text-align: center;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .endereco-texto {
            color: var(--text-muted);
            font-size: clamp(14px, 1.8vh, 16px);
            margin: 10px 0 20px;
            line-height: 1.4;
        }

        .caixa-horario {
            background-color: var(--color-3);
            color: var(--cor-branco);
            padding: 12px 20px;
            border-radius: 12px;
            font-size: clamp(13px, 1.6vh, 15px);
            margin-bottom: 25px;
            display: inline-block;
            align-self: center;
        }

        .moldura-mapa {
            flex-grow: 1;
            min-height: 250px;
            background-color: #eee;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
        }

        .moldura-mapa iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: none;
        }


        /* ============================================================
   10. RODAPÉ
   ============================================================ */

        .rodape-principal {
            width: 100%;
            padding-top: 80px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: var(--cor-branco);
        }

        .frase-impacto span {
            color: var(--color-accent);
            font-style: italic;
        }

        .lista-contatos {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 40px;
        }

        .item-contato {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: var(--text-dark);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .item-contato:hover {
            color: var(--color-accent);
        }

        .item-contato i {
            margin-right: 12px;
            font-size: 20px;
        }

        .redes-sociais {
            display: flex;
            gap: 30px;
            margin-bottom: 60px;
        }

        .icone-social {
            color: var(--cor-preto-footer);
            font-size: 26px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .icone-social:hover {
            transform: translateY(-5px);
            color: var(--color-accent);
        }

        .barra-copyright {
            background-color: var(--cor-preto-footer);
            color: var(--cor-branco);
            padding: 20px;
            width: 100%;
            font-size: 13px;
            text-align: center;
            letter-spacing: 0.5px;
        }


        /* ============================================================
   RESPONSIVIDADE
   ============================================================ */

        @media (max-width: 768px) {

            body,
            html {
                overflow-y: auto;
                height: auto;
            }

            #resultados {
                padding: 60px 5%;
                height: auto;
            }

            .grade-galeria {
                grid-template-columns: repeat(2, 1fr);
                height: auto;
                gap: 10px;
            }

            .item-galeria {
                grid-column: span 1 !important;
                height: 250px;
            }

            .botao-fechar {
                top: 20px;
                right: 20px;
                font-size: 40px;
                width: 45px;
                height: 45px;
            }

            .rodape-principal {
                padding-top: 50px;
            }

            .lista-contatos {
                gap: 20px;
                margin-bottom: 30px;
            }

            .item-contato {
                font-size: 15px;
            }

            .redes-sociais {
                gap: 25px;
                margin-bottom: 40px;
            }

            .barra-copyright {
                font-size: 11px;
            }
        }

        @media (max-height: 500px) {

            .cartao-visita {
                padding: 15px;
            }

            .section-title {
                font-size: 18px;
                margin-bottom: 5px;
            }

            .endereco-texto,
            .caixa-horario {
                margin-bottom: 10px;
            }

            .moldura-mapa {
                min-height: 150px;
            }
        }

        @media (max-width: 480px) {

            #localizacao {
                padding: 5px;
            }

            .cartao-visita {
                padding: 25px 15px;
            }

            .caixa-horario {
                width: 100%;
            }
        }

        /* ============================================================
   11. MODAL LOGIN
   ============================================================ */

        .modal-login {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
        }

        .caixa-login {
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 30px;
            width: 90%;
            max-width: 420px;
            text-align: center;
            position: relative;
        }

        .input-login {
            width: 100%;
            padding: 16px 20px;
            margin-bottom: 15px;
            border-radius: 15px;
            border: 1px solid #f0f0f0;
            background: #fafafa;
        }

        .botao-acao-modal {
            width: 100%;
            padding: 16px;
            border-radius: 15px;
            background: linear-gradient(to right, var(--color-1), var(--color-3));
            color: white;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
        }

        .fechar-modal {
            position: absolute;
            top: 10px;
            right: 15px;
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }


        /* ============================================================
   12. UTILITÁRIOS
   ============================================================ */

        .oculto,
        .escondido {
            display: none !important;
        }


        /* ============================================================
   13. RESPONSIVIDADE GERAL
   ============================================================ */

        @media (max-width: 992px) {

            .header-wrapper {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                -webkit-mask-image: none;
                mask-image: none;
            }

            #inicio {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding: 110px 5% 0;
            }

            .conteudo-hero {
                display: flex;
                flex-direction: column;
                align-items: center;
                width: 100%;
                gap: 0;
            }

            .texto-principal {
                display: contents;
            }

            .container-foto {
                display: flex !important;
                order: 2;
                width: 100%;
                justify-content: center;
                margin-bottom: -50px;
                z-index: 5;
            }

            .foto-recortada {
                max-height: 55vh;
                width: auto;
                object-fit: contain;
                filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.25));
            }

            .nome-imagem-logo {
                order: 3;
                max-width: 85%;
                margin: 0 auto 15px;
                z-index: 10;
                filter: drop-shadow(0 5px 15px rgba(0, 0, 0, 0.1));
            }

            .descricao-hero {
                order: 4;
                font-size: 14px;
                line-height: 1.8;
                padding: 0 15px 60px;
                max-width: 500px;
                margin: 0 auto;
                text-align: justify;
                text-indent: 40px;
                hyphens: auto;
            }

            .menu-toggle {
                display: flex;
            }

            .links-institucionais,
            .acoes-usuario,
            .btn-adm {
                position: fixed;
                right: -100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                background: #fff;
                transition: 0.4s ease-in-out;
                z-index: 1500;
            }

            .links-institucionais {
                top: 0;
                width: 280px;
                height: 100vh;
                padding-top: 100px;
                gap: 30px;
                box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
            }

            .acoes-usuario {
                top: 450px;
                width: 280px;
                gap: 20px;
                margin-top: 40px;
            }

            .btn-adm {
                top: 380px;
                width: 280px;
            }

            .nav-principal.menu-aberto .links-institucionais,
            .nav-principal.menu-aberto .acoes-usuario,
            .nav-principal.menu-aberto .btn-adm {
                right: 0;
            }

            .nav-link {
                color: var(--text-dark) !important;
                font-size: 16px !important;
            }

            .user-info {
                background: rgba(0, 0, 0, 0.05);
                backdrop-filter: none;
            }

            .user-greeting {
                color: var(--text-dark);
                display: block;
                margin-bottom: 10px;
            }

            .user-sub {
                color: rgba(0, 0, 0, 0.6);
            }

            .btn-logout {
                color: var(--text-dark);
                border: 1px solid rgba(0, 0, 0, 0.2);
            }

            .btn-logout:hover {
                background: var(--color-2);
                color: #fff;
            }

            .btn-conta:hover {
                background: var(--color-2);
                color: #000;
            }

            .menu-toggle.active .bar:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
                background-color: var(--color-2);
            }

            .menu-toggle.active .bar:nth-child(2) {
                opacity: 0;
            }

            .menu-toggle.active .bar:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
                background-color: var(--color-2);
            }
        }


        @media (max-width: 600px) {

            .agendador {
                padding: 20px;
            }

            .filtros .item {
                padding: 7px 12px;
                font-size: 0.85rem;
            }
        }


        /* ============================================================
   14. MENU TOGGLE (BASE)
   ============================================================ */

        .menu-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            z-index: 2000;
        }

        .menu-toggle .bar {
            width: 25px;
            height: 3px;
            background-color: #fff;
            border-radius: 2px;
            transition: 0.3s;
        }

        .nav-principal.nav-scroll .menu-toggle .bar {
            background-color: #333;
        }
    </style>
</head>

<body>

    <div class="site-container">

        <div class="header-wrapper">

            <nav class="nav-principal" id="mainNav">

                <div class="menu-toggle" id="mobile-menu">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <div class="links-institucionais">
                    <a href="#inicio" class="nav-link">Início</a>
                    <a href="#servicos" class="nav-link">Serviços</a>
                    <a href="#cursos" class="nav-link">Cursos</a>
                    <a href="#resultados" class="nav-link">Resultados</a>
                    <a href="#localizacao" class="nav-link">Localização</a>
                    <a href="#contatos" class="nav-link">Contatos</a>
                </div>

                <?php if (isset($_SESSION['usuario_email']) && $_SESSION['usuario_email'] == $admin_email): ?>

                    <div class="btn-adm"><a href="admin/painelAdmin.php">Painel Admin</a></div>

                <?php endif; ?>

                <div class="acoes-usuario">
                    <?php if ($logado): ?>

                        <?php if ($_SESSION['usuario_email'] === "golcalvesmarcella@gmail.com"): ?>

                            <div class="user-info">

                                <div class="user-avatar">
                                    <?php echo strtoupper(substr($_SESSION['usuario_nome'], 0, 1)); ?>
                                </div>

                                <div class="user-texto">
                                    <span class="user-greeting">
                                        Olá,
                                        <?php echo htmlspecialchars(explode(' ', $_SESSION['usuario_nome'])[0]); ?>
                                    </span>
                                    <span class="user-sub">Bem-vinda de volta</span>
                                </div>

                                <a href="usuario/auth/logout.php" class="btn-logout">Sair</a>

                            </div>

                        <?php else: ?>

                            <div class="user-info">

                                <div class="user-avatar">
                                    <?php echo strtoupper(substr($_SESSION['usuario_nome'], 0, 1)); ?>
                                </div>

                                <div class="user-texto">
                                    <span class="user-greeting">
                                        Olá,
                                        <?php echo htmlspecialchars(explode(' ', $_SESSION['usuario_nome'])[0]); ?>
                                    </span>
                                    <span class="user-sub">Minha conta</span>
                                </div>

                                <a href="usuario/painelClien.php" class="btn-conta">
                                    Minha Conta
                                </a>

                                <a href="usuario/auth/logout.php" class="btn-logout">Sair</a>

                            </div>

                        <?php endif; ?>

                    <?php else: ?>

                        <a href="javascript:void(0)" class="nav-link" onclick="abrirLogin()" style="font-weight: 800;">
                            Login
                        </a>

                    <?php endif; ?>
                    <a href="#container-principal" class="botao-agendar">Agendar</a>
                </div>

            </nav>
            <div id="modalLogin" class="modal-login">
                <div class="caixa-login">

                    <?php if (isset($_GET['erro'])): ?>
                        <div class="alerta-erro">E-mail ou palavra-passe incorretos.</div>
                    <?php endif; ?>

                    <div id="containerLogin" class="vista-login <?php echo $logado ? 'escondido' : ''; ?>">
                        <h3
                            style="margin-bottom: 25px; font-family: 'Playfair Display', serif; font-size: 26px; color: #000;">
                            Bem-vinda de volta</h3>
                        <button class="fechar-modal" onclick="fecharLogin()">✕</button>
                        <form id="formLogin" method="POST" action="usuario/auth/login.php">
                            <input type="email" name="email" class="input-login" placeholder="E-mail" required>
                            <input type="password" name="senha" class="input-login" placeholder="Palavra-passe"
                                required>
                            <button type="submit" class="botao-agendar"
                                style="width:100%; padding: 16px; margin-top: 10px;">Entrar</button>
                        </form>

                        <div class="divisor-modal"><span>ou</span></div>
                        <div id="g_id_onload"
                            data-client_id="821436734385-7cdnrc9a23v52qkfekevi35sumdr4so8.apps.googleusercontent.com"
                            data-context="signin" data-ux_mode="popup" data-callback="handleCredentialResponse"
                            data-auto_prompt="false">
                        </div>

                        <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="outline"
                            data-text="signin_with" data-size="large" data-logo_alignment="left" data-width="320">
                        </div>
                        <p class="texto-alternar">Não tem conta? <span class="link-toggle"
                                onclick="toggleVistas()">Criar conta
                                agora</span></p>
                    </div>

                    <div id="containerRegistro" class="vista-registro escondido">
                        <h3
                            style="margin-bottom: 25px; font-family: 'Playfair Display', serif; font-size: 26px; color: #000;">
                            Criar a sua conta</h3>
                        <button class="fechar-modal" onclick="fecharLogin()">✕</button>
                        <form action="registro.php" method="POST">
                            <input type="text" name="nome_completo" class="input-login" placeholder="Nome Completo"
                                required>
                            <input type="email" name="email" class="input-login" placeholder="E-mail" required>
                            <input type="password" name="senha" class="input-login" placeholder="Senha" required>
                            <button type="submit" class="botao-agendar"
                                style="width:100%; padding: 16px; margin-top: 10px;">
                                Cadastrar
                            </button>
                        </form>
                        <p class="texto-alternar" style="margin-top: 20px;">Já é cliente? <span class="link-toggle"
                                onclick="toggleVistas()">Entrar na conta</span></p>
                    </div>
                </div>
            </div>

            <section id="inicio">
                <div class="conteudo-hero">
                    <div class="texto-principal">

                        <img src="logo.png" alt="Logo Marcella Gonçalves" class="nome-imagem-logo">

                        <p class="descricao-hero">
                            Transformando olhares através da naturalidade. Mais de 20 mil atendimentos realizados com
                            técnica exclusiva e personalizada.
                        </p>
                    </div>

                    <div class="container-foto">
                        <div class="aura-luz"></div>

                        <div class="brilho" style="top: -5%; left: 0%; width: 7px; height: 7px; animation-delay: 0s;">
                        </div>
                        <div class="brilho"
                            style="bottom: 10%; right: -5%; width: 5px; height: 5px; animation-delay: 2.5s;"></div>

                        <div class="moldura-organica-quadrada">

                            <div class="frase-bemvinda">
                                Bem-vinda ao seu momento
                            </div>

                            <div class="borboleta borboleta-topo">
                                <svg viewBox="0 0 100 100">
                                    <path d="M48 40 Q45 25 35 20 M52 40 Q55 25 65 20" stroke="white" fill="none"
                                        stroke-width="1.5" />
                                    <g class="asa">
                                        <path d="M50 50 C20 10 5 40 15 60" fill="white" opacity="0.95" />
                                        <path d="M50 50 C25 60 10 85 30 85" fill="white" opacity="0.75" />
                                    </g>
                                    <g class="asa" style="transform: scaleX(-1); transform-origin: 50px;">
                                        <path d="M50 50 C20 10 5 40 15 60" fill="white" opacity="0.95" />
                                        <path d="M50 50 C25 60 10 85 30 85" fill="white" opacity="0.75" />
                                    </g>
                                    <ellipse cx="50" cy="55" rx="3" ry="12" class="corpo-borboleta" />
                                </svg>
                            </div>

                            <div class="video-wrapper">
                                <video autoplay muted loop playsinline class="foto-recortada">
                                    <source src="marcella.mp4" type="video/mp4">
                                    O seu navegador não suporta a reprodução de vídeo.
                                </video>
                            </div>

                            <div class="borboleta borboleta-base">
                                <svg viewBox="0 0 100 100">
                                    <path d="M48 40 Q45 25 35 20 M52 40 Q55 25 65 20" stroke="white" fill="none"
                                        stroke-width="1.5" />
                                    <g class="asa">
                                        <path d="M50 50 C20 10 5 40 15 60" fill="rgba(255,255,255,0.95)" />
                                        <path d="M50 50 C25 60 10 85 30 85" fill="rgba(255,255,255,0.75)" />
                                    </g>
                                    <g class="asa" style="transform: scaleX(-1); transform-origin: 50px;">
                                        <path d="M50 50 C20 10 5 40 15 60" fill="rgba(255,255,255,0.95)" />
                                        <path d="M50 50 C25 60 10 85 30 85" fill="rgba(255,255,255,0.75)" />
                                    </g>
                                    <ellipse cx="50" cy="55" rx="3" ry="12" class="corpo-borboleta" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="secao-boas-vindas">
            <h2 class="titulo-boas-vindas">
                Bem-vinda ao Equilíbrio entre <b>Técnica</b> e <b>Bem-estar</b>.
            </h2>
            <p class="texto-apoio">
                Acreditamos que a verdadeira estética não nasce apenas do talento, mas do respeito. Aqui, o atendimento
                premium se traduz em zelo: protocolos de biossegurança rigorosos, produtos de alta performance e um
                ambiente estruturado para o seu bem-estar. Para nós, cuidar da sua imagem é um compromisso técnico;
                cuidar de você é a nossa missão.
            </p>
        </section>

        <section class="content-section" id="servicos">
            <h2 class="section-title">SERVIÇOS <b><em>EXCLUSIVOS</em></b></h2>

            <p class="section-subtitle">Tudo o que você precisa para se sentir ainda mais incrível.</p>

            <div class="carrossel-wrapper">
                <button class="nav-btn btn-prev" id="prevBtn"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="nav-btn btn-next" id="nextBtn"><i class="fa-solid fa-chevron-right"></i></button>

                <div class="carrossel-viewport" id="viewport">
                    <div class="services-grid" id="track">

                        <div class="service-card" onclick="abrirAgendador('lash')">
                            <div class="image-container">
                                <img src="cardFotos/LashDesign.PNG" alt="Lash Designer">
                            </div>
                            <h3>Lash Designer</h3>
                            <p>Extensões de pestanas que elevam o seu olhar com naturalidade e leveza.</p>
                        </div>

                        <div class="service-card" onclick="abrirAgendador('massoterapia')">
                            <div class="image-container">
                                <img src="cardFotos/Massoterapia.PNG" alt="Massoterapia">
                            </div>
                            <h3>Massoterapia</h3>
                            <p>Drenagem e relaxamento manual para um corpo revitalizado e leve.</p>
                        </div>

                        <div class="service-card" onclick="abrirAgendador('manicure')">
                            <div class="image-container">
                                <img src="galeria/unha1.jpg" alt="Nails Designer">
                            </div>
                            <h3>Nails Designer</h3>
                            <p>Manicure russa e blindagem para unhas impecáveis por semanas.</p>
                        </div>

                        <div class="service-card" onclick="abrirAgendador('depilacao')">
                            <div class="image-container">
                                <img src="cardFotos/Depilacao.PNG" alt="Depilação">
                            </div>
                            <h3>Depilação</h3>
                            <p>Higiene e praticidade em cada detalhe para uma pele renovada e livre de pelos.</p>
                        </div>

                        <div class="service-card" onclick="abrirAgendador('estetica')">
                            <div class="image-container">
                                <img src="cardFotos/EA.PNG" alt="Estética Avançada">
                            </div>
                            <h3>Estética <b><em>Avançada</em></b></h3>
                            <p>Drenagem e relaxamento manual para um corpo revitalizado e leve.</p>
                        </div>

                    </div>
                </div>
            </div>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <p>Olá
                    <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>, explore os nossos serviços exclusivos
                    abaixo.
                </p>
            <?php else: ?>
                <p>Inicie sessão para aceder a opções exclusivas de agendamento.</p>
            <?php endif; ?>

            <div class="agendador tema-colorido" id="container-principal">

                <div class="topo">AGENDE SEU HORARIO</div>

                <div id="etapa1">
                    <div class="corpo">
                        <div class="filtros" id="categorias">
                        </div>

                        <div id="subcategorias" class="sub oculto"></div>

                        <div class="lista" id="lista-servicos">
                            <div
                                style="background:rgba(255,255,255,0.1); padding:15px; border-radius:12px; display:flex; justify-content:space-between;">
                            </div>
                        </div>
                    </div>

                    <div id="resumo-selecionados" class="resumo-selecionados oculto">
                        <h4>Serviços Selecionados:</h4>
                        <ul id="lista-selecionados"></ul>
                        <div id="total-geral">Total: R$ 0</div>
                    </div>

                    <div class="base">
                        <button class="botao" id="proximo" onclick="irParaEtapa(2)">Próximo</button>
                    </div>
                </div>


                <div id="etapa2" class="oculto">
                    <div class="corpo">
                        <div class="mes">
                            <span onclick="mudarMes(-1)" style="cursor:pointer;">❮</span>
                            <span id="nomeMes"></span>
                            <span onclick="mudarMes(1)" style="cursor:pointer;">❯</span>
                        </div>

                        <div class="agenda">
                            <div class="calendario-container">
                                <div class="dias-semana">
                                    <div>S</div>
                                    <div>T</div>
                                    <div>Q</div>
                                    <div>Q</div>
                                    <div>S</div>
                                    <div>S</div>
                                    <div>D</div>
                                </div>
                                <div class="grade" id="calendario">
                                </div>
                            </div>

                            <div class="horarios">
                                <div class="titulo-horarios">Horários</div>
                                <div id="horas">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="base" style="display:flex; gap:10px; align-items:center;">
                        <button onclick="voltar()"
                            style="background:none; border:none; color:#fff; cursor:pointer; font-weight:700; font-size:10px; text-transform:uppercase; opacity:0.7;">
                            Voltar
                        </button>
                        <button class="botao pronto" onclick="irParaEtapa(3)">Continuar</button>
                    </div>
                </div>

                <div id="etapa3" class="oculto">
                    <div class="corpo">
                        <div class="resumo-container">
                            <div class="resumo-titulo" style="font-weight:bold; margin-bottom:15px;">
                                Confirmar Dados do Agendamento
                            </div>
                            <div id="resumo-servicos" style="margin-bottom:10px; font-size:14px;">Corte Clássico - R$
                                50,00</div>
                            <div class="resumo-info"
                                style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:5px;">
                                <span>Data</span>
                                <span id="resumo-data"></span>
                            </div>
                            <div class="resumo-info"
                                style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:15px;">
                                <span>Horário</span>
                                <span id="resumo-hora"></span>
                            </div>
                            <div class="resumo-total"
                                style="border-top:1px dashed #ddd; padding-top:10px; display:flex; justify-content:space-between; font-weight:bold; color:#FFFFF; font-size:18px;">
                                <span>Total</span>
                                <span id="total-agendamento">R$ 0</span>
                            </div>
                        </div>
                    </div>

                    <div class="base">
                        <button onclick="irParaEtapa(2)"
                            style="background:none; border:none; color:#FFF; cursor:pointer; font-weight:700; font-size:10px; text-transform:uppercase; margin-right:15px;">
                            Voltar
                        </button>
                        <button class="botao pronto" onclick="irParaEtapa(4)">Continuar</button>
                    </div>
                </div>

                <div id="etapa4" class="oculto">
                    <div class="corpo">
                        <div class="confirmacao-container">
                            <h4 class="subtitulo-confirmacao" style="font-size:11px; color:#FFF; margin-bottom:10px;">
                                SEUS DADOS</h4>

                            <form id="form-agendamento" method="POST"
                                action="/MARCELLA_SITE/admin/api/agendamentos/salvar_agendamento.php">

                                <input type="text" name="nome" placeholder="Nome Completo" class="campo-confirmacao">
                                <input type="text" name="whatsapp" placeholder="Whatsapp" class="campo-confirmacao">

                                <h4 class="subtitulo-confirmacao"
                                    style="font-size:11px; color:#FFF; margin-top:15px; margin-bottom:5px;">
                                    Termos de Compromisso Mútuo
                                </h4>
                                <ol class="termos">
                                    <li>Tolerância de atraso é de 10 minutos.</li>
                                    <li>Avise com antecendência o desmarque ou remarque de horário.</li>
                                    <li>Informe exatamente quais procedimentos você deseja realizar, pois o atendimento
                                        é cronometrado.</li>
                                    <li>Evite trazer acompanhantes, evita distrações.</li>
                                    <li>Evite o uso constante do celular, durante o atendimento.</li>
                                </ol>

                                <label class="checkbox-termo"
                                    style="font-size:11px; display:flex; align-items:center; gap:8px;">
                                    <input type="checkbox" id="aceite-termos" name="termos" required>
                                    Eu concordo com as regras
                                </label>

                            </form>
                        </div>
                    </div>

                    <div class="base">
                        <button onclick="irParaEtapa(3)"
                            style="background:none; border:none; color:#FFF; cursor:pointer; font-weight:700; font-size:10px; text-transform:uppercase; margin-right:15px;">
                            Voltar
                        </button>
                        <button class="botao" onclick="confirmarAgendamento()">Confirmar Agendamento</button>
                    </div>
                </div>

                <div id="notificacao" class="notificacao oculto">
                    <span id="notificacaoTexto">Agendamento confirmado com sucesso!</span>
                </div>
            </div>
        </section>

        <section class="secao-beleza" id="cursos">
            <div class="max-w-6xl mx-auto">

                <h2 class="titulo-serifado text-3xl md:text-4xl font-bold uppercase mb-2">
                    DOMINE A ARTE DA <span class="texto-destaque-rosa">BELEZA</span>
                </h2>

                <p class="descricao-secao">
                    Aprenda as minhas técnicas Master através de cursos presenciais intensivos e mentorias exclusivas.
                </p>

                <span class="rotulo-listagem">Cursos Disponíveis</span>

                <div class="cartao-curso">

                    <div class="conteudo-curso">

                        <div class="container-icone">
                            <svg class="estrela-icone" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.787 1.401 8.165L12 18.897l-7.335 3.855 1.401-8.165-5.934-5.787 8.2-1.192z" />
                            </svg>
                        </div>

                        <div class="textos">
                            <h4 class="titulo-curso">Curso Alongamento de unhas</h4>
                            <p class="detalhes-curso">
                                Técnicas profissionais: Tips | Fibra de vidro | Banho em gel
                            </p>
                        </div>
                    </div>

                    <a href="https://w.app/marcellagoncalvesnails" class="botao-informacoes">
                        + Informações
                    </a>

                </div>

            </div>

        </section>


        <section id="resultados">
            <h2 class="section-title">NOSSOS <b><em>RESULTADOS</em></b></h2>
            <div class="grade-galeria">
                <div class="item-galeria foto-1" onclick="abrirImagem(this)">
                    <img src="galeria/unha5.jpg" alt="Unhas 1">
                </div>
                <div class="item-galeria foto-2" onclick="abrirImagem(this)">
                    <img src="galeria/unha3.jpg" alt="Unhas 2">
                </div>
                <div class="item-galeria foto-3" onclick="abrirImagem(this)">
                    <img src="galeria/unha8.jpg" alt="Unhas 3">
                </div>
                <div class="item-galeria foto-4" onclick="abrirImagem(this)">
                    <img src="galeria/unha4.jpg" alt="Unhas 4">
                </div>

                <div class="item-galeria foto-5" onclick="abrirImagem(this)">
                    <img src="galeria/unha2.jpg" alt="Unhas 5">
                </div>
                <div class="item-galeria foto-6" onclick="abrirImagem(this)">
                    <img src="galeria/unha7.jpg" alt="Unhas 6">
                </div>
                <div class="item-galeria foto-7" onclick="abrirImagem(this)">
                    <img src="galeria/unha11.jpg" alt="Unhas 7">
                </div>
            </div>

            <div class="visualizador" id="meuVisualizador" onclick="fecharImagem()">
                <div class="botao-fechar" onclick="fecharImagem(); event.stopPropagation();">&times;</div>
                <img class="imagem-expandida" id="imgExpandida" alt="Expandida" onclick="event.stopPropagation()">
            </div>

        </section>

        <section id="localizacao">

            <div class="cartao-visita">

                <h2 class="section-title"><b><em>VISITE-NOS</em></b></h2>

                <address class="endereco-texto">
                    Rua Paulo Ernani Braga do Nascimento, 266 - Jardim São Jose, Suzano
                </address>

                <div class="caixa-horario">
                    <strong>Horário de funcionamento:</strong> 10h às 20h de Terça a Sábado
                </div>

                <div class="moldura-mapa">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.4024479371714!2d-46.3312521!3d-23.5899249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce7092925b6a37%3A0x6b3b5b5b5b5b5b5b!2sR.%20Paulo%20Ernani%20Braga%20do%20Nascimento%2C%20266%20-%20Jardim%20S%C3%A3o%20Jos%C3%A9%2C%20Suzano%20-%20SP!5e0!3m2!1spt-BR!2sbr!4v1715000000000!5m2!1spt-BR!2sbr"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>

            </div>
        </section>

        <footer class="rodape-principal" id="contatos">

            <h2 class="section-title">Onde a beleza encontra o <b><em class="highlight-text">CUIDADO</em></b></h2>


            <div class="lista-contatos">
                <a href="https://wa.me/5511949863602" class="item-contato" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                    (11) 94986 - 3602
                </a>
                <a href="mailto:marcella_gon43@hotmail.com" class="item-contato">
                    <i class="far fa-envelope"></i>
                    marcella_gon43@hotmail.com
                </a>
            </div>

            <div class="redes-sociais">
                <a href="https://www.instagram.com/marcellagoncalvesnails/" class="icone-social" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/donnellyunhas" class="icone-social" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
            </div>

            <div class="barra-copyright">
                Copyright © Marcella Golçalves. Todos os direitos reservados.
            </div>

        </footer>


    </div>
    <script>
        /* ============================================================
       INICIALIZAÇÃO DA APLICAÇÃO
    ============================================================ */

        document.addEventListener("DOMContentLoaded", function() {
            desenharCategorias();
            selecionarPrimeiraCategoria();

            const elementoCalendario = document.getElementById("calendarioMini");
            if (elementoCalendario) {
                window.calendarioMini = new FullCalendar.Calendar(elementoCalendario, {
                    initialView: "dayGridMonth",
                    locale: "pt-br",
                    height: 380
                });
                window.calendarioMini.render();
            }
        });


        /* ============================================================
           CHECKBOX TERMOS
        ============================================================ */

        const checkbox = document.getElementById("aceite-termos");

        if (checkbox) {
            checkbox.addEventListener("change", () => {
                const btn = document.querySelector(".botao");
                if (!btn) return;

                if (checkbox.checked) btn.classList.add("pronto");
                else btn.classList.remove("pronto");
            });
        }


        // ==================================================
        // LÓGICA DE SCROLL DA NAV
        // ==================================================
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('mainNav');
            const heroSection = document.getElementById('inicio');

            if (heroSection && nav) {
                if (window.scrollY > 50) {
                    nav.classList.add('nav-scroll');
                } else {
                    nav.classList.remove('nav-scroll');
                }
            }
        });

        // ==================================================
        //  MENU MOBILE
        // ==================================================
        const menuToggle = document.getElementById('mobile-menu');
        const mainNav = document.getElementById('mainNav');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                mainNav.classList.toggle('menu-aberto');
                menuToggle.classList.toggle('active');
            });
        }

        document.querySelectorAll(".nav-link, .botao-agendar").forEach(link => {
            link.addEventListener("click", () => {
                mainNav.classList.remove("menu-aberto");
                menuToggle.classList.remove("active");
            });
        });
        /* ============================================================
           LOGIN / USUÁRIO
        ============================================================ */

        const USUARIO_NAME = "<?php echo $_SESSION['usuario_nome'] ?? 'Visitante'; ?>";

        const IS_ADMIN = "<?php echo (isset($_SESSION['usuario_tipo']) && $_SESSION['usuario_tipo'] === 'admin') ? 'true' : 'false'; ?>";

        function abrirLogin() {
            document.getElementById("modalLogin").style.display = "flex";
        }

        function fecharLogin() {
            document.getElementById("modalLogin").style.display = "none";
        }

        function toggleVistas() {
            document.getElementById("containerLogin").classList.toggle("escondido");
            document.getElementById("containerRegistro").classList.toggle("escondido");
        }

        function handleCredentialResponse(response) {
            fetch("usuario/auth/login_google.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        credential: response.credential
                    })
                })
                .then(res => res.text())
                .then(text => {
                    console.log("RAW RESPONSE:", text);

                    if (!text) {
                        throw new Error("Resposta vazia do servidor");
                    }

                    const data = JSON.parse(text);

                    if (data.success) {
                        window.location.href = "index.php";
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => console.error("Erro:", err));
        }


        /* ============================================================
           CARROSSEL DE SERVIÇOS
        ============================================================ */

        const track = document.getElementById("track");
        const viewport = document.getElementById("viewport");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn");

        let isDragging = false;
        let startX;
        let currentTranslate = 0;
        let prevTranslate = 0;

        const updatePosition = () => {
            if (!track || !viewport) return;

            track.style.transform = `translateX(${currentTranslate}px)`;

            const maxScroll = -(track.scrollWidth - viewport.offsetWidth);

            if (prevBtn) prevBtn.disabled = currentTranslate >= 0;
            if (nextBtn) nextBtn.disabled = currentTranslate <= maxScroll;
        };

        const moveSlide = (direction) => {
            const card = document.querySelector(".service-card");
            if (!card || !track) return;

            const style = window.getComputedStyle(track);
            const gap = parseInt(style.columnGap || 0);

            const step = (card.offsetWidth + gap) * 3;
            const maxScroll = -(track.scrollWidth - viewport.offsetWidth);

            currentTranslate += direction * step;

            if (currentTranslate > 0) currentTranslate = 0;
            if (currentTranslate < maxScroll) currentTranslate = maxScroll;

            prevTranslate = currentTranslate;

            track.style.transition = "transform 0.6s cubic-bezier(0.23, 1, 0.32, 1)";
            updatePosition();
        };

        nextBtn?.addEventListener("click", () => moveSlide(-1));
        prevBtn?.addEventListener("click", () => moveSlide(1));


        const startAction = (e) => {
            isDragging = true;
            startX = e.type.includes("mouse") ?
                e.pageX :
                e.touches[0].clientX;

            if (track) track.style.transition = "none";
        };

        const moveAction = (e) => {
            if (!isDragging || !track) return;

            const x = e.type.includes("mouse") ?
                e.pageX :
                e.touches[0].clientX;

            const walk = (x - startX) * 1.2;
            currentTranslate = prevTranslate + walk;

            const maxScroll = -(track.scrollWidth - viewport.offsetWidth);

            if (currentTranslate > 50) currentTranslate = 50;
            if (currentTranslate < maxScroll - 50) currentTranslate = maxScroll - 50;

            track.style.transform = `translateX(${currentTranslate}px)`;
        };

        const endAction = () => {
            if (!isDragging || !track) return;

            isDragging = false;
            track.style.transition = "transform 0.5s cubic-bezier(0.23, 1, 0.32, 1)";

            const card = document.querySelector(".service-card");
            const style = window.getComputedStyle(track);
            const gap = parseInt(style.columnGap || 0);

            const step = card.offsetWidth + gap;

            currentTranslate =
                Math.round(currentTranslate / step) * step;

            const maxScroll = -(track.scrollWidth - viewport.offsetWidth);

            if (currentTranslate > 0) currentTranslate = 0;
            if (currentTranslate < maxScroll) currentTranslate = maxScroll;

            prevTranslate = currentTranslate;
            updatePosition();
        };

        viewport?.addEventListener("mousedown", startAction);
        window.addEventListener("mousemove", moveAction);
        window.addEventListener("mouseup", endAction);

        viewport?.addEventListener("touchstart", startAction);
        window.addEventListener("touchmove", moveAction);
        window.addEventListener("touchend", endAction);

        window.addEventListener("resize", () => {
            const maxScroll = -(track.scrollWidth - viewport.offsetWidth);
            if (currentTranslate < maxScroll) currentTranslate = maxScroll;
            updatePosition();
        });

        updatePosition();

        function abrirAgendador(categoria) {

            document.getElementById("container-principal")?.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });

            irParaEtapa(1);

            setTimeout(() => {
                const botoes = document.querySelectorAll("#categorias .item");
                botoes.forEach(btn => {
                    if (btn.innerText.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "") ===
                        dados[categoria].nome.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "")) {
                        btn.click();
                    }
                });
            }, 400);
        }

        /* ============================================================
           DADOS DA AGENDA
        ============================================================ */

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
                        servicos:

                            [{
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


        /* ============================================================
           ESTADO GLOBAL
        ============================================================ */

        let categoriaAtual = null;
        let subAtual = null;
        let servicosSelecionados = [];


        /* ============================================================
           ETAPAS
        ============================================================ */

        function irParaEtapa(numero) {
            ["1", "2", "3", "4"].forEach(n =>
                document.getElementById("etapa" + n)?.classList.add("oculto")
            );

            document.getElementById("etapa" + numero)?.classList.remove("oculto");

            if (numero === 3) mostrarResumo();

            document.getElementById("container-principal")?.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        }

        function voltar() {
            document.getElementById("etapa2")?.classList.add("oculto");
            document.getElementById("etapa1")?.classList.remove("oculto");
        }


        /* ============================================================
           CATEGORIAS
        ============================================================ */

        function desenharCategorias() {
            const div = document.getElementById("categorias");
            if (!div) return;

            div.innerHTML = "";

            Object.entries(dados).forEach(([chave, valor]) => {
                const btn = document.createElement("div");
                btn.className = "item";
                btn.innerText = valor.nome;
                btn.onclick = () => selecionarCategoria(chave, btn);
                div.appendChild(btn);
            });
        }

        function selecionarPrimeiraCategoria() {
            document.querySelector("#categorias .item")?.click();
        }

        function selecionarCategoria(chave, botao) {
            categoriaAtual = chave;

            document
                .querySelectorAll("#categorias .item")
                .forEach(el => el.classList.remove("ativo"));

            botao.classList.add("ativo");

            if (dados[chave].filtro) {
                subAtual = Object.keys(dados[chave].subs)[0];
            } else {
                subAtual = null;
            }

            mostrarSubcategorias();
            mostrarServicos();
        }


        /* ============================================================
           SUBCATEGORIAS
        ============================================================ */

        function mostrarSubcategorias() {
            const div = document.getElementById("subcategorias");
            if (!div) return;

            div.innerHTML = "";

            const cat = dados[categoriaAtual];
            if (!cat?.filtro) {
                div.classList.add("oculto");
                return;
            }

            div.classList.remove("oculto");

            Object.keys(cat.subs).forEach(subKey => {
                const btn = document.createElement("div");
                btn.className = "item";
                btn.innerText = cat.subs[subKey].nome;

                if (subKey === subAtual) btn.classList.add("ativo");

                btn.onclick = () => {
                    subAtual = subKey;
                    mostrarSubcategorias();
                    mostrarServicos();
                };

                div.appendChild(btn);
            });
        }


        /* ============================================================
           SERVIÇOS
        ============================================================ */

        function mostrarServicos() {
            const div = document.getElementById("lista-servicos");
            if (!div || !categoriaAtual) return;

            div.innerHTML = "";

            let lista = dados[categoriaAtual].filtro ?
                dados[categoriaAtual].subs[subAtual].servicos :
                dados[categoriaAtual].servicos;

            lista.forEach(serv => {
                const item = document.createElement("div");
                item.className = "servico";

                if (servicosSelecionados.some(s => s.nome === serv.nome)) {
                    item.classList.add("eleito");
                }

                item.innerHTML = `
    <div>
        <div class="nome">${serv.nome}</div>
        <div class="tempo">${serv.tempo}</div>
    </div>
    <div class="preco">R$ ${serv.preco}</div>
`;

                item.onclick = () => selecionarServico(item, serv);
                div.appendChild(item);
            });
        }


        /* ============================================================
           SELEÇÃO DE SERVIÇOS
        ============================================================ */

        function selecionarServico(div, serv) {
            const index = servicosSelecionados.findIndex(s => s.nome === serv.nome);

            if (index > -1) {
                servicosSelecionados.splice(index, 1);
                div.classList.remove("eleito");
            } else {
                servicosSelecionados.push(serv);
                div.classList.add("eleito");
            }

            atualizarResumoSelecionados();
            atualizarBotao();
        }


        /* ============================================================
           RESUMO
        ============================================================ */

        function atualizarResumoSelecionados() {
            const lista = document.getElementById("lista-selecionados");
            const box = document.getElementById("resumo-selecionados");
            const totalEl = document.getElementById("total-geral");

            if (!box) return;

            if (servicosSelecionados.length === 0) {
                box.classList.add("oculto");
                return;
            }

            box.classList.remove("oculto");
            lista.innerHTML = "";

            let total = 0;

            servicosSelecionados.forEach((serv, index) => {
                const li = document.createElement("li");

                li.innerHTML = `
            <div class="resumo-item-info">
                <span class="resumo-nome">${serv.nome}</span>
                <span class="resumo-preco">R$ ${serv.preco}</span>
            </div>
            <button class="remover" onclick="removerServico(${index})">×</button>
        `;

                lista.appendChild(li);
                total += serv.preco;
            });

            if (totalEl) {
                totalEl.innerText = `Total: R$ ${total}`;
            }
        }

        function removerServico(index) {
            servicosSelecionados.splice(index, 1);
            atualizarResumoSelecionados();
            atualizarBotao();
        }

        function calcularTotal() {
            return servicosSelecionados.reduce((acc, s) => acc + s.preco, 0);
        }

        function atualizarBotao() {
            const btn = document.getElementById("proximo");
            if (!btn) return;

            if (servicosSelecionados.length > 0) {
                btn.classList.add("pronto");
                btn.disabled = false;
            } else {
                btn.classList.remove("pronto");
                btn.disabled = true;
            }
        }


        /* ============================================================
           RESUMO FINAL
        ============================================================ */

        function mostrarResumo() {
            const container = document.getElementById("resumo-servicos");
            const totalEl = document.getElementById("total-agendamento");
            const dataEl = document.getElementById("resumo-data");
            const horaEl = document.getElementById("resumo-hora");

            if (!container) return;

            container.innerHTML = "";

            let total = calcularTotal();

            servicosSelecionados.forEach(serv => {
                const div = document.createElement("div");
                div.style.cssText = "display:flex; justify-content:space-between; margin-bottom:8px;";
                div.innerHTML = `<span>${serv.nome}</span><span>R$ ${serv.preco}</span>`;
                container.appendChild(div);
            });

            if (dataEl) {
                dataEl.innerText = selectedFullDate ?
                    selectedFullDate :
                    "Nenhuma data selecionada";
            }

            if (horaEl) {
                horaEl.innerText = selectedTimeValue ?
                    selectedTimeValue :
                    "Nenhum horário selecionado";
            }

            if (totalEl) {
                totalEl.innerText = "R$ " + total;
            }
        }
        // ==================================================
        // ETAPA 2 - DATA E HORÁRIO
        // ==================================================

        let selectedFullDate = null;
        let selectedTimeValue = null;
        let selectedDayElement = null;
        let selectedHourElement = null;

        let dataAtual = new Date();
        let configAgenda = {
            padrao: [],
            excecoes: []
        };


        // ==================================================
        // INICIALIZAÇÃO
        // ==================================================

        async function carregarConfiguracoes() {
            try {
                const response = await fetch('admin/api/agenda/get_configuracoes_agenda.php?mes=' +
                    (dataAtual.getMonth() + 1) +
                    '&ano=' +
                    dataAtual.getFullYear()
                );
                const text = await response.text();

                console.log(text);

                const data = JSON.parse(text);

                configAgenda = {
                    padrao: data.padrao || [],
                    excecoes: data.excecoes || []
                };

                console.log("CONFIG AGENDA:", configAgenda);

                renderizarCalendario();

            } catch (err) {
                console.error("Erro ao carregar agenda:", err);
            }
        }
        // ==================================================
        // CALENDÁRIO
        // ==================================================

        function renderizarCalendario() {
            const grade = document.getElementById('calendario');
            const nomeMes = document.getElementById('nomeMes');

            if (!grade || !nomeMes) return;

            grade.innerHTML = '';

            const ano = dataAtual.getFullYear();
            const mes = dataAtual.getMonth();

            nomeMes.innerText = new Intl.DateTimeFormat('pt-BR', {
                month: 'long',
                year: 'numeric'
            }).format(dataAtual);

            const primeiroDia = new Date(ano, mes, 1).getDay();
            const diasMes = new Date(ano, mes + 1, 0).getDate();

            const ajuste = primeiroDia === 0 ? 6 : primeiroDia - 1;

            for (let i = 0; i < ajuste; i++) {
                grade.appendChild(document.createElement("div"));
            }

            for (let dia = 1; dia <= diasMes; dia++) {

                const dataStr = `${ano}-${String(mes + 1).padStart(2, '0')}-${String(dia).padStart(2, '0')}`;

                const div = document.createElement('div');
                div.className = 'dia-item';
                div.innerText = dia;

                if (verificarDisponibilidade(dataStr)) {
                    div.onclick = () => selecionarDia(dataStr, div);
                } else {
                    div.style.opacity = '0.3';
                    div.style.pointerEvents = 'none';
                }

                grade.appendChild(div);
            }
        }


        // ==================================================
        // DISPONIBILIDADE
        // ==================================================

        function normalizarDia(dia) {
            return dia
                .toLowerCase()
                .normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .substring(0, 3);
        }

        function verificarDisponibilidade(dataStr) {

            const data = new Date(dataStr + "T00:00:00");

            const ano = data.getFullYear();
            const mes = data.getMonth() + 1;

            const dias = [
                'Domingo',
                'Segunda',
                'Terça',
                'Quarta',
                'Quinta',
                'Sexta',
                'Sábado'
            ];

            const nomeDia = dias[data.getDay()];

            const configsDoMes = configAgenda.padrao.filter(p =>
                Number(p.mes) === mes &&
                Number(p.ano) === ano
            );

            const configDia = configsDoMes.find(p =>
                p.dia_semana.normalize("NFD").replace(/[\u0300-\u036f]/g, "") ===
                nomeDia.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
            );

            return configDia?.status_dia === 'trabalho';
        }
        // ==================================================
        // SELEÇÃO DE DIA
        // ==================================================

        function selecionarDia(dataStr, elemento) {

            if (selectedDayElement) {
                selectedDayElement.classList.remove('selecionado');
            }

            elemento.classList.add('selecionado');

            selectedDayElement = elemento;
            selectedFullDate = dataStr;

            selectedTimeValue = null;
            selectedHourElement = null;

            gerarHorarios(dataStr);

            console.log("Dia selecionado:", selectedFullDate);
        }


        // ==================================================
        // HORÁRIOS
        // ==================================================

        async function gerarHorarios(dataStr) {

            const container = document.getElementById('horas');
            if (!container) return;

            container.innerHTML = '<div>Carregando...</div>';

            try {

                const response = await fetch(
                    `admin/api/agenda/get_disponibilidade.php?data=${dataStr}`
                );

                const data = await response.json();

                container.innerHTML = '';

                const horarios = data.horarios_disponiveis || [];

                if (horarios.length === 0) {
                    container.innerHTML = `
                <div class="sem-horarios">
                    Nenhum horário disponível
                </div>
            `;
                    return;
                }

                horarios.forEach(hora => {

                    const btn = document.createElement('div');
                    btn.className = 'hora-item';
                    btn.innerText = hora.substring(0, 5);

                    btn.onclick = () => {

                        if (selectedHourElement) {
                            selectedHourElement.classList.remove('ativo');
                        }

                        btn.classList.add('ativo');

                        selectedHourElement = btn;
                        selectedTimeValue = hora.substring(0, 5);

                    };

                    container.appendChild(btn);
                });

            } catch (err) {
                console.error("Erro ao carregar horários:", err);
            }
        }

        // ==================================================
        // MUDAR MÊS
        // ==================================================

        function mudarMes(dir) {
            dataAtual.setMonth(dataAtual.getMonth() + dir);
            renderizarCalendario();
        }

        carregarConfiguracoes();


        // ==================================================
        // RESUMO (ETAPA 3)
        // ==================================================

        function calcularDuracaoTotal() {
            return servicosSelecionados.reduce((acc, s) => {
                return acc + parseInt(s.tempo.replace(" MIN", ""));
            }, 0);
        }


        // ==================================================
        // CONFIRMAÇÃO (ETAPA 4)
        // ==================================================

        async function confirmarAgendamento() {

            const nome = document.querySelector('input[name="nome"]')?.value;
            const whatsapp = document.querySelector('input[name="whatsapp"]')?.value;

            const usuario = await fetch("usuario/auth/verificar_login.php").then(r => r.json());
            console.log(usuario);

            if (!usuario.logado || !usuario.id) {
                alert("Você precisa estar logada!");
                return;
            }

            const dados = {
                usuario_id: usuario.id,
                email: usuario.email,
                cliente_nome: nome,
                whatsapp: whatsapp,
                data: selectedFullDate,
                hora_inicio: selectedTimeValue,
                duracao: calcularDuracaoTotal(),
                valor_total: calcularTotal(),
                servicos: servicosSelecionados
            };

            console.log("ENVIANDO:", dados);

            const res = await fetch("admin/api/agendamentos/salvar_agendamento.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(dados)
            });

            const json = await res.json();

            if (json.status === "ok") {
                mostrarNotificacao();
                setTimeout(() => resetarAgendamento(), 3000);
            } else {
                alert(json.msg || "Erro ao salvar");
            }
        }

        function resetarAgendamento() {
            servicosSelecionados = [];
            selectedFullDate = null;
            selectedTimeValue = null;
            selectedDayElement = null;
            selectedHourElement = null;

            atualizarResumoSelecionados();
            atualizarBotao();
            mostrarServicos();
            irParaEtapa(1);
        }


        // ==================================================
        // NOTIFICAÇÃO
        // ==================================================

        function mostrarNotificacao(mensagem = "Agendamento feito com sucesso!", tipo = "sucesso") {
            const n = document.getElementById("notificacao");
            const texto = document.getElementById("notificacaoTexto");

            if (!n || !texto) return;

            texto.innerText = mensagem;

            n.classList.remove("oculto", "show", "sucesso", "erro");

            n.classList.add(tipo);

            setTimeout(() => {
                n.classList.add("show");
            }, 10);

            setTimeout(() => {
                n.classList.remove("show");

                setTimeout(() => {
                    n.classList.add("oculto");
                }, 300);
            }, 3000);
        }

        // ==================================================
        // FUNÇÕES DA GALERIA
        // ==================================================

        const visualizador = document.getElementById('meuVisualizador');
        const imgExpandida = document.getElementById('imgExpandida');

        function abrirImagem(elemento) {
            const visualizador = document.getElementById('meuVisualizador');
            const imgExpandida = document.getElementById('imgExpandida');

            if (!visualizador || !imgExpandida) {
                console.error("Elementos do visualizador não encontrados.");
                return;
            }

            const imgInterna = elemento.querySelector('img');
            if (!imgInterna) return;

            imgExpandida.src = imgInterna.src;
            visualizador.style.display = 'flex';

            setTimeout(() => {
                visualizador.classList.add('ativo');
                document.body.classList.add('modal-aberto');
            }, 10);
        }

        function fecharImagem() {
            const visualizador = document.getElementById('meuVisualizador');
            const imgExpandida = document.getElementById('imgExpandida');

            if (!visualizador) return;

            visualizador.classList.remove('ativo');
            document.body.classList.remove('modal-aberto');

            setTimeout(() => {
                visualizador.style.display = 'none';
                if (imgExpandida) imgExpandida.src = '';
            }, 400);
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') fecharImagem();
            });

            const nav = document.getElementById('mainNav');
            window.addEventListener('scroll', () => {
                if (nav) window.scrollY > 50 ? nav.classList.add('nav-scroll') : nav.classList.remove('nav-scroll');
            });
        });
    </script>

</body>

</html>