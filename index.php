<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campus Exchange | Student Marketplace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root{
            --navy:#07111f;
            --navy-2:#0b1730;
            --ink:#0f172a;
            --text:#475569;
            --muted:#64748b;
            --white:#ffffff;
            --soft:#f8fbff;
            --border:#dbe7f5;
            --cyan:#22d3ee;
            --teal:#14b8a6;
            --green:#22c55e;
            --blue:#2563eb;
            --purple:#7c3aed;
            --pink:#ec4899;
            --orange:#f97316;
            --gradient:linear-gradient(135deg,#2563eb 0%,#7c3aed 48%,#22d3ee 100%);
            --gradient-2:linear-gradient(135deg,#14b8a6 0%,#22d3ee 45%,#2563eb 100%);
            --glass:rgba(255,255,255,.12);
            --shadow:0 24px 70px rgba(15,23,42,.16);
            --shadow-soft:0 14px 35px rgba(15,23,42,.10);
            --radius:26px;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        html{
            scroll-behavior:smooth;
        }

        body{
            background:
                radial-gradient(circle at 8% 10%,rgba(37,99,235,.11),transparent 27%),
                radial-gradient(circle at 92% 22%,rgba(34,211,238,.16),transparent 28%),
                linear-gradient(180deg,#f7fbff 0%,#ffffff 42%,#f8fbff 100%);
            color:var(--ink);
            overflow-x:hidden;
        }

        body::before{
            content:"";
            position:fixed;
            inset:0;
            pointer-events:none;
            background-image:
                linear-gradient(rgba(37,99,235,.04) 1px,transparent 1px),
                linear-gradient(90deg,rgba(37,99,235,.04) 1px,transparent 1px);
            background-size:46px 46px;
            mask-image:linear-gradient(180deg,rgba(0,0,0,.65),transparent 75%);
            z-index:-1;
        }

        a{text-decoration:none;}

        .navbar,
        .navbar .container,
        .navbar-collapse,
        .navbar-nav{
            overflow:visible!important;
        }

        ::selection{
            background:#7c3aed;
            color:#fff;
        }

        /* Navbar */
        .navbar{
            background:transparent;
            padding:16px 0;
            transition:.35s ease;
        }

        .navbar .container{
            background:rgba(7,17,31,.82);
            backdrop-filter:blur(22px);
            border:1px solid rgba(255,255,255,.16);
            border-radius:999px;
            padding:10px 18px;
            box-shadow:0 20px 55px rgba(2,6,23,.28);
            position:relative;
            overflow:visible;
        }

        .navbar .container::before{
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(90deg,rgba(34,211,238,.16),transparent 35%,rgba(124,58,237,.16));
            pointer-events:none;
        }

        .navbar.scrolled .container{
            background:rgba(255,255,255,.88);
            border-color:rgba(219,231,245,.85);
            box-shadow:0 18px 45px rgba(15,23,42,.13);
        }

        .navbar.scrolled .navbar-brand,
        .navbar.scrolled .nav-link,
        .navbar.scrolled .btn-login{
            color:var(--ink)!important;
        }

        .navbar-brand{
            position:relative;
            z-index:2;
            color:#fff!important;
            font-size:25px;
            font-weight:900;
            letter-spacing:.2px;
            display:flex;
            align-items:center;
        }

        .navbar-brand i{
            width:43px;
            height:43px;
            border-radius:15px;
            margin-right:11px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            background:var(--gradient);
            box-shadow:0 12px 25px rgba(37,99,235,.35);
        }

        .navbar-brand span{
            background:linear-gradient(135deg,#22d3ee,#a78bfa);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .navbar-toggler{
            position:relative;
            z-index:3;
            border:0;
            width:46px;
            height:46px;
            border-radius:15px;
            background:rgba(255,255,255,.95)!important;
            box-shadow:none!important;
        }

        .navbar-toggler-icon{
            filter:none;
        }

        .navbar-collapse{
            position:relative;
            z-index:2;
        }

        .nav-link{
            position:relative;
            color:#eaf3ff!important;
            font-size:14px;
            font-weight:700;
            margin-left:8px;
            padding:10px 15px!important;
            border-radius:999px;
            transition:.28s ease;
        }

        .nav-link::before{
            content:"";
            position:absolute;
            inset:0;
            border-radius:999px;
            background:linear-gradient(135deg,rgba(34,211,238,.17),rgba(124,58,237,.17));
            opacity:0;
            transform:scale(.92);
            transition:.28s ease;
        }

        .nav-link:hover::before,
        .nav-link.active::before{
            opacity:1;
            transform:scale(1);
        }

        .nav-link:hover,
        .nav-link.active{
            color:#fff!important;
            transform:translateY(-1px);
        }

        .navbar.scrolled .nav-link:hover,
        .navbar.scrolled .nav-link.active{
            color:#2563eb!important;
        }

        .btn-login{
            color:#fff;
            font-weight:800;
            margin-left:12px;
            padding:10px 15px;
            border-radius:999px;
            transition:.28s ease;
        }

        .btn-login:hover{
            color:#22d3ee;
            background:rgba(255,255,255,.10);
        }

        .btn-register{
            background:var(--gradient);
            color:#fff;
            padding:11px 23px;
            border-radius:999px;
            font-weight:900;
            margin-left:10px;
            transition:.3s ease;
            box-shadow:0 14px 30px rgba(37,99,235,.35);
            display:inline-flex;
            align-items:center;
            gap:8px;
        }

        .btn-register:hover{
            color:#fff;
            transform:translateY(-3px);
            box-shadow:0 20px 42px rgba(124,58,237,.38);
        }

        /* Premium Account Dropdown CSS */
        .nav-account-wrap{
            position:relative;
            z-index:9999;
        }

        .account-btn{
            display:inline-flex!important;
            align-items:center;
            gap:7px;
            color:#fff!important;
            font-weight:900!important;
            background:rgba(255,255,255,.10);
            border:1px solid rgba(255,255,255,.16);
        }

        .account-btn:hover{
            color:#22d3ee!important;
            background:rgba(255,255,255,.16);
        }

        .navbar.scrolled .account-btn{
            color:var(--ink)!important;
            background:rgba(37,99,235,.07);
            border-color:rgba(37,99,235,.12);
        }

        .dropdown-menu {
            z-index:10000;
            min-width:255px;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(22px);
            border: 1px solid rgba(219, 231, 245, 0.95);
            border-radius: 22px;
            box-shadow: 0 24px 55px rgba(15, 23, 42, 0.18);
            padding: 13px;
            margin-top: 16px !important;
            overflow:visible;
        }

        .dropdown-menu::before{
            content:"";
            position:absolute;
            top:-8px;
            right:25px;
            width:16px;
            height:16px;
            background:rgba(255,255,255,.97);
            border-left:1px solid rgba(219,231,245,.95);
            border-top:1px solid rgba(219,231,245,.95);
            transform:rotate(45deg);
        }

        .dropdown-item {
            position:relative;
            z-index:2;
            border-radius:14px;
            transition: 0.3s ease;
            font-weight: 800;
            color: var(--ink);
            padding: 12px 15px;
            margin-bottom: 6px;
            display:flex;
            align-items:center;
        }

        .dropdown-item:last-child { margin-bottom: 0; }

        .dropdown-item:hover {
            background: linear-gradient(135deg,rgba(37, 99, 235, 0.10),rgba(34,211,238,.10));
            color: var(--blue);
            transform: translateX(5px);
        }

        .dropdown-divider{
            margin:8px 4px;
            border-color:rgba(148,163,184,.25);
        }

        .navbar.scrolled .dropdown-menu { background: #fff; }

        @media(max-width:991px){
            .dropdown-menu{
                position:static!important;
                transform:none!important;
                width:100%;
                margin-top:10px!important;
                box-shadow:none;
            }

            .dropdown-menu::before{
                display:none;
            }
        }

        /* Hero */
        .hero{
            min-height:96vh;
            background:
                linear-gradient(115deg,rgba(3,7,18,.94) 0%,rgba(15,23,42,.83) 46%,rgba(37,99,235,.40) 100%),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1600&q=80");
            background-size:cover;
            background-position:center;
            color:#fff;
            display:flex;
            align-items:center;
            position:relative;
            overflow:hidden;
            padding:145px 0 95px;
        }

        .hero::before{
            content:"";
            position:absolute;
            width:540px;
            height:540px;
            border-radius:50%;
            top:75px;
            right:45px;
            background:radial-gradient(circle,rgba(34,211,238,.34),rgba(124,58,237,.12) 48%,transparent 72%);
            filter:blur(6px);
            animation:floatGlow 6s ease-in-out infinite alternate;
        }

        .hero::after{
            content:"";
            position:absolute;
            inset:0;
            background:
                linear-gradient(90deg,rgba(255,255,255,.05) 1px,transparent 1px),
                linear-gradient(rgba(255,255,255,.04) 1px,transparent 1px);
            background-size:64px 64px;
            mask-image:linear-gradient(180deg,rgba(0,0,0,.8),transparent 72%);
            pointer-events:none;
        }

        @keyframes floatGlow{
            from{transform:translateY(0) scale(1);}
            to{transform:translateY(22px) scale(1.08);}
        }

        .hero .container{
            position:relative;
            z-index:2;
        }

        .hero-badge{
            display:inline-flex;
            align-items:center;
            gap:9px;
            background:rgba(255,255,255,.10);
            border:1px solid rgba(255,255,255,.18);
            color:#bff7ff;
            padding:10px 18px;
            border-radius:999px;
            font-size:14px;
            font-weight:800;
            margin-bottom:22px;
            box-shadow:inset 0 1px 0 rgba(255,255,255,.18),0 14px 35px rgba(0,0,0,.15);
        }

        .hero-badge i{
            color:#86efac;
        }

        .hero h1{
            font-size:64px;
            line-height:1.08;
            font-weight:900;
            margin-bottom:23px;
            letter-spacing:-1.8px;
            text-shadow:0 15px 45px rgba(0,0,0,.28);
        }

        .hero h1 span{
            background:linear-gradient(135deg,#22d3ee 0%,#a78bfa 50%,#86efac 100%);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .hero p{
            font-size:18px;
            color:#dbeafe;
            max-width:635px;
            line-height:1.85;
            margin-bottom:34px;
        }

        .hero-buttons{
            display:flex;
            flex-wrap:wrap;
            gap:15px;
        }

        .btn-main{
            background:var(--gradient-2);
            color:#fff;
            padding:15px 29px;
            border-radius:17px;
            font-weight:900;
            transition:.3s ease;
            box-shadow:0 16px 35px rgba(34,211,238,.25);
            display:inline-flex;
            align-items:center;
            justify-content:center;
        }

        .btn-main:hover{
            color:#fff;
            transform:translateY(-4px);
            box-shadow:0 24px 48px rgba(37,99,235,.34);
        }

        .btn-outline-main{
            border:1px solid rgba(255,255,255,.28);
            color:#fff;
            padding:14px 28px;
            border-radius:17px;
            font-weight:900;
            transition:.3s ease;
            background:rgba(255,255,255,.08);
            backdrop-filter:blur(12px);
            display:inline-flex;
            align-items:center;
            justify-content:center;
        }

        .btn-outline-main:hover{
            background:#fff;
            color:#0f172a;
            transform:translateY(-4px);
            box-shadow:0 22px 45px rgba(255,255,255,.18);
        }

        .hero-card{
            background:linear-gradient(145deg,rgba(255,255,255,.20),rgba(255,255,255,.08));
            border:1px solid rgba(255,255,255,.22);
            backdrop-filter:blur(22px);
            border-radius:34px;
            padding:20px;
            position:relative;
            z-index:2;
            box-shadow:0 34px 90px rgba(0,0,0,.38);
            overflow:hidden;
        }

        .hero-card::before{
            content:"";
            position:absolute;
            inset:-2px;
            border-radius:36px;
            background:linear-gradient(135deg,rgba(34,211,238,.65),transparent 35%,rgba(124,58,237,.55));
            opacity:.45;
            z-index:-1;
        }

        .hero-card::after{
            content:"";
            position:absolute;
            width:180px;
            height:180px;
            border-radius:50%;
            right:-60px;
            top:-55px;
            background:rgba(34,211,238,.22);
            filter:blur(4px);
        }

        .hero-card img{
            width:100%;
            height:325px;
            object-fit:cover;
            border-radius:26px;
            margin-bottom:18px;
            border:1px solid rgba(255,255,255,.18);
            box-shadow:0 20px 45px rgba(0,0,0,.28);
            filter:saturate(1.08) contrast(1.04);
        }

        .floating-item{
            background:rgba(255,255,255,.94);
            color:#0f172a;
            border:1px solid rgba(226,232,240,.90);
            border-radius:22px;
            padding:14px;
            display:flex;
            align-items:center;
            gap:13px;
            box-shadow:0 20px 45px rgba(2,6,23,.22);
            margin-bottom:13px;
            transition:.3s ease;
            position:relative;
            z-index:3;
        }

        .floating-item:hover{
            transform:translateX(-5px) translateY(-2px);
        }

        .floating-item img{
            width:62px;
            height:62px;
            object-fit:cover;
            border-radius:16px;
            margin:0;
            box-shadow:0 10px 20px rgba(15,23,42,.14);
        }

        .floating-item h6{
            font-size:14px;
            margin:0;
            font-weight:900;
        }

        .floating-item p{
            font-size:13px;
            margin:4px 0 0;
            color:#475569;
            line-height:1.35;
        }

        .tag{
            display:inline-flex;
            align-items:center;
            background:linear-gradient(135deg,rgba(34,197,94,.14),rgba(20,184,166,.16));
            color:#15803d;
            font-size:11px;
            padding:5px 10px;
            border-radius:999px;
            margin-top:7px;
            font-weight:900;
        }

        /* Feature Strip */
        .feature-strip{
            margin-top:-58px;
            position:relative;
            z-index:5;
        }

        .feature-box{
            background:rgba(255,255,255,.90);
            backdrop-filter:blur(18px);
            border:1px solid rgba(219,231,245,.90);
            border-radius:30px;
            padding:30px;
            box-shadow:var(--shadow);
            position:relative;
            overflow:hidden;
        }

        .feature-box::before{
            content:"";
            position:absolute;
            inset:0;
            background:linear-gradient(90deg,rgba(37,99,235,.06),transparent,rgba(34,211,238,.08));
            pointer-events:none;
        }

        .feature-item{
            display:flex;
            gap:16px;
            align-items:flex-start;
            position:relative;
            z-index:2;
        }

        .feature-icon{
            min-width:60px;
            height:60px;
            border-radius:20px;
            background:linear-gradient(135deg,rgba(37,99,235,.12),rgba(34,211,238,.16));
            color:var(--blue);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:25px;
            box-shadow:inset 0 1px 0 rgba(255,255,255,.8);
        }

        .feature-item:nth-child(1) .feature-icon{color:#16a34a;background:linear-gradient(135deg,rgba(34,197,94,.14),rgba(20,184,166,.16));}
        .feature-item h5{
            font-size:17px;
            font-weight:900;
            margin-bottom:6px;
        }

        .feature-item p{
            color:#64748b;
            font-size:14px;
            margin:0;
            line-height:1.65;
        }

        /* Common Section */
        .section-padding{
            padding:88px 0;
        }

        .section-title{
            text-align:center;
            margin-bottom:46px;
        }

        .section-title span{
            display:inline-flex;
            align-items:center;
            gap:8px;
            color:#2563eb;
            font-weight:900;
            text-transform:uppercase;
            letter-spacing:1px;
            font-size:13px;
            padding:8px 15px;
            border-radius:999px;
            background:rgba(37,99,235,.08);
            border:1px solid rgba(37,99,235,.12);
        }

        .section-title h2{
            font-size:40px;
            line-height:1.2;
            font-weight:900;
            margin-top:14px;
            letter-spacing:-.8px;
        }

        .section-title p{
            color:#64748b;
            max-width:700px;
            margin:13px auto 0;
            line-height:1.75;
        }

        /* Categories */
        .category-card{
            background:rgba(255,255,255,.88);
            backdrop-filter:blur(12px);
            border-radius:26px;
            padding:30px 22px;
            text-align:center;
            border:1px solid rgba(219,231,245,.95);
            transition:.35s ease;
            height:100%;
            box-shadow:0 12px 28px rgba(15,23,42,.06);
            position:relative;
            overflow:hidden;
        }

        .category-card::before{
            content:"";
            position:absolute;
            inset:auto -40px -70px auto;
            width:120px;
            height:120px;
            background:rgba(34,211,238,.12);
            border-radius:50%;
            transition:.35s ease;
        }

        .category-card:hover{
            transform:translateY(-10px);
            box-shadow:0 22px 50px rgba(15,23,42,.12);
            border-color:rgba(37,99,235,.30);
        }

        .category-card:hover::before{
            transform:scale(1.8);
            background:rgba(124,58,237,.10);
        }

        .category-icon{
            width:76px;
            height:76px;
            border-radius:24px;
            background:var(--gradient);
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:31px;
            margin:0 auto 19px;
            box-shadow:0 18px 35px rgba(37,99,235,.24);
            position:relative;
            z-index:2;
        }

        .category-card:nth-child(2n) .category-icon{background:linear-gradient(135deg,#14b8a6,#22c55e);}
        .category-card:nth-child(3n) .category-icon{background:linear-gradient(135deg,#f97316,#f59e0b);}
        .category-card:nth-child(4n) .category-icon{background:linear-gradient(135deg,#7c3aed,#ec4899);}

        .category-card h5{
            font-weight:900;
            margin-bottom:8px;
            position:relative;
            z-index:2;
        }

        .category-card p{
            color:#64748b;
            font-size:14px;
            margin:0;
            position:relative;
            z-index:2;
        }

        /* Items */
        .item-card{
            background:#fff;
            border-radius:28px;
            overflow:hidden;
            border:1px solid rgba(219,231,245,.95);
            transition:.35s ease;
            height:100%;
            box-shadow:0 14px 32px rgba(15,23,42,.07);
            position:relative;
        }

        .item-card::before{
            content:"";
            position:absolute;
            inset:0;
            border-radius:28px;
            padding:1px;
            background:linear-gradient(135deg,rgba(37,99,235,.45),transparent 34%,rgba(34,211,238,.45));
            -webkit-mask:linear-gradient(#fff 0 0) content-box,linear-gradient(#fff 0 0);
            -webkit-mask-composite:xor;
            mask-composite:exclude;
            opacity:0;
            transition:.35s ease;
            pointer-events:none;
        }

        .item-card:hover{
            transform:translateY(-10px);
            box-shadow:0 26px 60px rgba(15,23,42,.14);
        }

        .item-card:hover::before{opacity:1;}

        .item-img{
            height:218px;
            width:100%;
            object-fit:cover;
            transition:.45s ease;
            filter:saturate(1.05) contrast(1.02);
        }

        .item-card:hover .item-img{
            transform:scale(1.05);
        }

        .item-body{
            padding:23px;
            position:relative;
            z-index:2;
        }

        .item-body h5{
            font-weight:900;
            margin-bottom:8px;
            line-height:1.35;
        }

        .item-price{
            background:linear-gradient(135deg,#16a34a,#14b8a6);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
            font-size:22px;
            font-weight:900;
            margin-bottom:11px;
        }

        .item-meta{
            display:flex;
            justify-content:space-between;
            gap:10px;
            color:#64748b;
            font-size:14px;
            margin-bottom:19px;
            flex-wrap:wrap;
        }

        .item-meta span{
            padding:7px 10px;
            border-radius:999px;
            background:#f8fafc;
            font-weight:700;
        }

        .btn-small{
            background:linear-gradient(135deg,#0f172a,#1e293b);
            color:#fff;
            display:block;
            text-align:center;
            padding:12px;
            border-radius:15px;
            font-weight:800;
            transition:.3s ease;
            box-shadow:0 12px 26px rgba(15,23,42,.16);
        }

        .btn-small:hover{
            background:var(--gradient);
            color:#fff;
            transform:translateY(-2px);
            box-shadow:0 18px 38px rgba(37,99,235,.23);
        }

        /* How Works */
        .how-section{
            background:
                radial-gradient(circle at 10% 10%,rgba(37,99,235,.07),transparent 30%),
                radial-gradient(circle at 90% 90%,rgba(34,211,238,.10),transparent 32%),
                #fff;
        }

        .step-card{
            text-align:center;
            padding:32px 22px;
            border-radius:28px;
            background:rgba(248,250,252,.84);
            border:1px solid rgba(219,231,245,.95);
            height:100%;
            position:relative;
            transition:.35s ease;
            overflow:hidden;
        }

        .step-card::after{
            content:"";
            position:absolute;
            width:120px;
            height:120px;
            border-radius:50%;
            background:rgba(37,99,235,.07);
            right:-55px;
            top:-55px;
            transition:.35s ease;
        }

        .step-card:hover{
            background:#fff;
            transform:translateY(-9px);
            box-shadow:var(--shadow-soft);
            border-color:rgba(37,99,235,.22);
        }

        .step-card:hover::after{transform:scale(1.55);}

        .step-number{
            width:62px;
            height:62px;
            background:var(--gradient);
            color:#fff;
            border-radius:20px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:900;
            font-size:21px;
            margin:0 auto 20px;
            box-shadow:0 16px 35px rgba(37,99,235,.26);
            position:relative;
            z-index:2;
        }

        .step-card:nth-child(2n) .step-number{background:linear-gradient(135deg,#14b8a6,#22c55e);}
        .step-card:nth-child(3n) .step-number{background:linear-gradient(135deg,#7c3aed,#ec4899);}
        .step-card:nth-child(4n) .step-number{background:linear-gradient(135deg,#f97316,#f59e0b);}

        .step-card h5{
            font-weight:900;
            margin-bottom:10px;
            position:relative;
            z-index:2;
        }

        .step-card p{
            color:#64748b;
            font-size:14px;
            line-height:1.75;
            margin:0;
            position:relative;
            z-index:2;
        }

        /* CTA */
        .cta{
            background:
                radial-gradient(circle at 15% 20%,rgba(255,255,255,.24),transparent 28%),
                linear-gradient(135deg,rgba(37,99,235,.96),rgba(124,58,237,.92) 52%,rgba(34,211,238,.90)),
                url("https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1500&q=80");
            background-size:cover;
            background-position:center;
            color:#fff;
            border-radius:38px;
            padding:68px 38px;
            text-align:center;
            box-shadow:0 28px 75px rgba(37,99,235,.28);
            position:relative;
            overflow:hidden;
        }

        .cta::before{
            content:"";
            position:absolute;
            width:260px;
            height:260px;
            border-radius:50%;
            background:rgba(255,255,255,.14);
            right:-90px;
            top:-90px;
        }

        .cta h2{
            font-weight:900;
            font-size:40px;
            margin-bottom:16px;
            position:relative;
            z-index:2;
        }

        .cta p{
            color:#eff6ff;
            max-width:760px;
            margin:0 auto 30px;
            line-height:1.85;
            position:relative;
            z-index:2;
        }

        .cta .btn-main{
            position:relative;
            z-index:2;
            background:#fff;
            color:#2563eb;
            box-shadow:0 18px 35px rgba(2,6,23,.18);
        }

        .cta .btn-main:hover{
            color:#fff;
            background:linear-gradient(135deg,#0f172a,#334155);
        }

        /* Footer */
        footer{
            background:
                radial-gradient(circle at 10% 0%,rgba(37,99,235,.18),transparent 28%),
                linear-gradient(180deg,#07111f 0%,#020617 100%);
            color:#cbd5e1;
            padding:55px 0 22px;
            position:relative;
            overflow:hidden;
        }

        footer::before{
            content:"";
            position:absolute;
            inset:0;
            background-image:
                linear-gradient(rgba(255,255,255,.04) 1px,transparent 1px),
                linear-gradient(90deg,rgba(255,255,255,.04) 1px,transparent 1px);
            background-size:48px 48px;
            mask-image:linear-gradient(180deg,rgba(0,0,0,.65),transparent 85%);
            pointer-events:none;
        }

        footer .container{position:relative;z-index:2;}

        footer h4{
            color:#fff;
            font-weight:900;
            margin-bottom:14px;
        }

        footer h4 span{
            background:linear-gradient(135deg,#22d3ee,#a78bfa);
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        footer p{
            color:#94a3b8;
            line-height:1.8;
        }

        .footer-link{
            color:#cbd5e1;
            display:block;
            margin-bottom:10px;
            transition:.3s ease;
            font-weight:600;
        }

        .footer-link:hover{
            color:#22d3ee;
            transform:translateX(5px);
        }

        .footer-bottom{
            border-top:1px solid rgba(255,255,255,.10);
            margin-top:34px;
            padding-top:20px;
            text-align:center;
            color:#94a3b8;
        }

        @media(max-width:991px){
            .navbar .container{
                border-radius:26px;
            }

            .navbar-collapse{
                background:rgba(7,17,31,.94);
                border:1px solid rgba(255,255,255,.12);
                border-radius:22px;
                padding:15px;
                margin-top:14px;
            }

            .navbar.scrolled .navbar-collapse{
                background:rgba(255,255,255,.96);
                border-color:rgba(219,231,245,.9);
            }

            .hero h1{font-size:45px;}
            .hero{padding-top:132px;}
            .hero-card{margin-top:42px;}
            .nav-link{margin-left:0;margin-top:7px;}
            .btn-login,.btn-register{display:inline-flex;margin-left:0;margin-top:12px;}
            .feature-strip{margin-top:-30px;}
        }

        @media(max-width:576px){
            .navbar{padding:10px 0;}
            .navbar-brand{font-size:20px;}
            .navbar-brand i{width:38px;height:38px;}
            .hero h1{font-size:36px;letter-spacing:-1px;}
            .hero p{font-size:16px;}
            .hero{padding:118px 0 70px;}
            .hero-card img{height:230px;}
            .section-padding{padding:66px 0;}
            .section-title h2{font-size:30px;}
            .hero-buttons{flex-direction:column;}
            .btn-main,.btn-outline-main{width:100%;text-align:center;}
            .feature-strip{margin-top:0;padding-top:25px;}
            .feature-box{padding:22px;}
            .cta{padding:46px 22px;border-radius:28px;}
            .cta h2{font-size:30px;}
        }

    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-graduation-cap"></i>
            Campus <span>Exchange</span>
        </a>

        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="categories.php">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="items.php">Items</a></li>
                <li class="nav-item"><a class="nav-link" href="how.php">How it Works</a></li>
                <li class="nav-item"><a class="nav-link" href="add_item.php">Sell Item</a></li>
                
                <li class="nav-item dropdown ms-lg-2 nav-account-wrap">
                    <a class="nav-link dropdown-toggle account-btn" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <i class="fa-solid fa-circle-user"></i> Account
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                        <li>
                            <a class="dropdown-item" href="login.php?role=buyer">
                                <i class="fa-solid fa-cart-shopping text-success me-2"></i> Buyer Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="login.php?role=seller">
                                <i class="fa-solid fa-store text-primary me-2"></i> Seller Login
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="register.php">
                                <i class="fa-solid fa-user-plus text-info me-2"></i> Student Register
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="admin/admin_login.php">
                                <i class="fa-solid fa-user-shield text-danger me-2"></i> Admin Login
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="fa-solid fa-shield-halved"></i>
                    Verified Campus Marketplace
                </div>

                <h1>
                    Buy, Sell, Exchange & Donate <span>inside your Campus</span>
                </h1>

                <p>
                    Campus Exchange is a secure student marketplace where verified college students
                    can exchange books, notes, electronics, lab items and more safely within the campus.
                </p>

                <div class="hero-buttons">
                    <a href="items.php" class="btn-main">
                        <i class="fa-solid fa-magnifying-glass me-2"></i> Browse Items
                    </a>
                    <a href="add_item.php" class="btn-outline-main">
                        <i class="fa-solid fa-upload me-2"></i> Post an Item
                    </a>
                </div>
            </div>

            <div class="col-lg-5 offset-lg-1">
                <div class="hero-card">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80" alt="Students">

                    <div class="floating-item">
                        <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=300&q=80" alt="Book">
                        <div>
                            <h6>DBMS Textbook</h6>
                            <p>₹450 • Excellent Condition</p>
                            <span class="tag">For Sale</span>
                        </div>
                    </div>

                    <div class="floating-item">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=300&q=80" alt="Headphone">
                        <div>
                            <h6>Wireless Headphone</h6>
                            <p>Exchange with Calculator</p>
                            <span class="tag">For Exchange</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="feature-strip">
    <div class="container">
        <div class="feature-box">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-user-check"></i></div>
                        <div>
                            <h5>Verified Students</h5>
                            <p>Only approved college students can join and trade.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <h5>Safe Meetup</h5>
                            <p>Exchange items inside safe campus locations.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-filter"></i></div>
                        <div>
                            <h5>Search & Filter</h5>
                            <p>Find books, notes and gadgets quickly.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon"><i class="fa-solid fa-shield"></i></div>
                        <div>
                            <h5>Admin Moderation</h5>
                            <p>All listings are reviewed for safety and trust.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="section-title">
            <span>Browse Categories</span>
            <h2>Find What You Need</h2>
            <p>Explore popular campus item categories and connect with students from your college.</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-card">
                    <div class="category-icon"><i class="fa-solid fa-book-open"></i></div>
                    <h5>Books</h5>
                    <p>Textbooks</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-card">
                    <div class="category-icon"><i class="fa-solid fa-file-lines"></i></div>
                    <h5>Notes</h5>
                    <p>Study notes</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-card">
                    <div class="category-icon"><i class="fa-solid fa-laptop"></i></div>
                    <h5>Electronics</h5>
                    <p>Devices</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-card">
                    <div class="category-icon"><i class="fa-solid fa-flask"></i></div>
                    <h5>Lab Items</h5>
                    <p>Lab tools</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="categories.php" class="btn btn-outline-main text-dark" style="border-color: #dbe7f5;">View All Categories <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<section class="section-padding pt-0">
    <div class="container">
        <div class="section-title">
            <span>Latest Items</span>
            <h2>Available Campus Listings</h2>
            <p>These are demo item cards. Later we will connect this section with MySQL database.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="item-card">
                    <img class="item-img" src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=900&q=80" alt="Book">
                    <div class="item-body">
                        <h5>Database Management System Book</h5>
                        <div class="item-price">₹450</div>
                        <div class="item-meta">
                            <span><i class="fa-solid fa-book me-1"></i> Books</span>
                            <span><i class="fa-solid fa-tag me-1"></i> For Sale</span>
                        </div>
                        <a href="item_details.php?id=1" class="btn-small">View Details</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="item-card">
                    <img class="item-img" src="https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?auto=format&fit=crop&w=900&q=80" alt="Notes">
                    <div class="item-body">
                        <h5>Operating System Handwritten Notes</h5>
                        <div class="item-price">Free</div>
                        <div class="item-meta">
                            <span><i class="fa-solid fa-file-lines me-1"></i> Notes</span>
                            <span><i class="fa-solid fa-gift me-1"></i> Donate</span>
                        </div>
                        <a href="item_details.php?id=2" class="btn-small">View Details</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="item-card">
                    <img class="item-img" src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80" alt="Electronics">
                    <div class="item-body">
                        <h5>Scientific Calculator</h5>
                        <div class="item-price">₹300</div>
                        <div class="item-meta">
                            <span><i class="fa-solid fa-calculator me-1"></i> Electronics</span>
                            <span><i class="fa-solid fa-tag me-1"></i> For Sale</span>
                        </div>
                        <a href="item_details.php?id=3" class="btn-small">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="items.php" class="btn btn-outline-main text-dark" style="border-color: #dbe7f5;">View All Items <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<section class="section-padding how-section">
    <div class="container">
        <div class="section-title">
            <span>Simple Process</span>
            <h2>How Campus Exchange Works</h2>
            <p>A safe and easy process for buying, selling, exchanging and donating inside your campus.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h5>Register</h5>
                    <p>Create your account with roll number, department and college verification details.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h5>Post Item</h5>
                    <p>Upload item details, price, category, condition and photos of your item.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h5>Admin Approval</h5>
                    <p>Admin checks the listing to prevent fake or unsafe item posts.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h5>Connect & Exchange</h5>
                    <p>Buyer contacts seller and meets at a safe campus location.</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <a href="how.php" class="btn btn-outline-main text-dark" style="border-color: #dbe7f5;">Learn More <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="cta">
            <h2>Ready to Exchange Smarter?</h2>
            <p>
                Join Campus Exchange and make student life more affordable, safe and sustainable.
                Reuse resources, save money and help your campus community.
            </p>
            <a href="register.php" class="btn-main">
                <i class="fa-solid fa-user-plus me-2"></i> Join Now
            </a>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <h4>Campus <span>Exchange</span></h4>
                <p>
                    A hyper-local marketplace for verified college students to buy, sell,
                    exchange and donate useful items safely inside the campus.
                </p>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6 class="text-white mb-3">Quick Links</h6>
                <a href="index.php" class="footer-link">Home</a>
                <a href="categories.php" class="footer-link">Categories</a>
                <a href="items.php" class="footer-link">Items</a>
                <a href="how.php" class="footer-link">How it Works</a>
            </div>

            <div class="col-lg-2 col-md-4">
                <h6 class="text-white mb-3">Student</h6>
                <a href="register.php" class="footer-link">Register</a>
                <a href="login.php" class="footer-link">Login</a>
                <a href="add_item.php" class="footer-link">Post Item</a>
            </div>

            <div class="col-lg-3 col-md-4">
                <h6 class="text-white mb-3">Safety</h6>
                <p>
                    Use safe campus meetup points like library, department area,
                    canteen or common room for item exchange.
                </p>
            </div>
        </div>

        <div class="footer-bottom">
            © <?php echo date("Y"); ?> Campus Exchange. Hackathon Prototype.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Premium navbar glass effect on scroll
    const mainNavbar = document.querySelector('.navbar');

    function updateNavbar(){
        if(window.scrollY > 40){
            mainNavbar.classList.add('scrolled');
        }else{
            mainNavbar.classList.remove('scrolled');
        }
    }

    updateNavbar();
    window.addEventListener('scroll', updateNavbar);

    // Auto close mobile navbar after clicking a nav item
    document.querySelectorAll('.navbar-nav a:not(.dropdown-toggle)').forEach(function(link){
        link.addEventListener('click', function(){
            const navMenu = document.querySelector('#navbarMenu');
            if(navMenu && navMenu.classList.contains('show')){
                new bootstrap.Collapse(navMenu).hide();
            }
        });
    });
</script>
</body> 
</html>