<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campus Exchange | Student Marketplace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: #f5f8ff;
            color: #0f172a;
        }

        a{
            text-decoration: none;
        }

        /* Navbar */
        .navbar{
            background: rgba(3, 12, 34, 0.96);
            backdrop-filter: blur(12px);
            padding: 14px 0;
            box-shadow: 0 8px 25px rgba(0,0,0,0.18);
        }

        .navbar-brand{
            color: #fff !important;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: .5px;
        }

        .navbar-brand i{
            color: #2dd4bf;
            margin-right: 8px;
        }

        .navbar-brand span{
            color: #2dd4bf;
        }

        .nav-link{
            color: #e2e8f0 !important;
            font-size: 15px;
            font-weight: 500;
            margin-left: 16px;
            transition: .3s;
        }

        .nav-link:hover{
            color: #2dd4bf !important;
        }

        .btn-login{
            color: #fff;
            font-weight: 600;
            margin-left: 18px;
        }

        .btn-register{
            background: #2dd4bf;
            color: #031225;
            padding: 10px 22px;
            border-radius: 12px;
            font-weight: 700;
            margin-left: 12px;
            transition: .3s;
        }

        .btn-register:hover{
            background: #fff;
            color: #031225;
        }

        /* Hero */
        .hero{
            min-height: 92vh;
            background:
                linear-gradient(110deg, rgba(3, 12, 34, 0.93), rgba(7, 22, 55, 0.82)),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1600&q=80");
            background-size: cover;
            background-position: center;
            color: #fff;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 120px 0 80px;
        }

        .hero::before{
            content: "";
            position: absolute;
            width: 450px;
            height: 450px;
            background: rgba(45, 212, 191, 0.16);
            border-radius: 50%;
            top: 80px;
            right: 90px;
            filter: blur(5px);
        }

        .hero-badge{
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(45, 212, 191, 0.14);
            border: 1px solid rgba(45, 212, 191, 0.4);
            color: #5eead4;
            padding: 9px 18px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .hero h1{
            font-size: 62px;
            line-height: 1.12;
            font-weight: 800;
            margin-bottom: 22px;
        }

        .hero h1 span{
            color: #2dd4bf;
        }

        .hero p{
            font-size: 18px;
            color: #dbeafe;
            max-width: 610px;
            line-height: 1.8;
            margin-bottom: 32px;
        }

        .hero-buttons{
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn-main{
            background: #2dd4bf;
            color: #031225;
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 700;
            transition: .3s;
            box-shadow: 0 12px 30px rgba(45, 212, 191, 0.28);
        }

        .btn-main:hover{
            background: #fff;
            color: #031225;
            transform: translateY(-3px);
        }

        .btn-outline-main{
            border: 2px solid rgba(255,255,255,0.6);
            color: #fff;
            padding: 13px 28px;
            border-radius: 14px;
            font-weight: 700;
            transition: .3s;
        }

        .btn-outline-main:hover{
            background: #fff;
            color: #031225;
            transform: translateY(-3px);
        }

        .hero-card{
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.18);
            backdrop-filter: blur(15px);
            border-radius: 28px;
            padding: 25px;
            position: relative;
            z-index: 2;
            box-shadow: 0 30px 80px rgba(0,0,0,0.35);
        }

        .hero-card img{
            width: 100%;
            height: 310px;
            object-fit: cover;
            border-radius: 22px;
            margin-bottom: 18px;
        }

        .floating-item{
            background: #fff;
            color: #0f172a;
            border-radius: 18px;
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.20);
            margin-bottom: 12px;
        }

        .floating-item img{
            width: 58px;
            height: 58px;
            object-fit: cover;
            border-radius: 12px;
            margin: 0;
        }

        .floating-item h6{
            font-size: 14px;
            margin: 0;
            font-weight: 700;
        }

        .floating-item p{
            font-size: 13px;
            margin: 3px 0 0;
            color: #334155;
            line-height: 1.3;
        }

        .tag{
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            font-size: 11px;
            padding: 4px 9px;
            border-radius: 20px;
            margin-top: 5px;
            font-weight: 700;
        }

        /* Feature Strip */
        .feature-strip{
            margin-top: -55px;
            position: relative;
            z-index: 5;
        }

        .feature-box{
            background: #fff;
            border-radius: 24px;
            padding: 28px;
            box-shadow: 0 20px 50px rgba(15, 23, 42, 0.10);
        }

        .feature-item{
            display: flex;
            gap: 16px;
            align-items: flex-start;
        }

        .feature-icon{
            min-width: 58px;
            height: 58px;
            border-radius: 18px;
            background: #ccfbf1;
            color: #0f766e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        .feature-item h5{
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .feature-item p{
            color: #64748b;
            font-size: 14px;
            margin: 0;
            line-height: 1.6;
        }

        /* Common Section */
        .section-padding{
            padding: 85px 0;
        }

        .section-title{
            text-align: center;
            margin-bottom: 45px;
        }

        .section-title span{
            color: #14b8a6;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 14px;
        }

        .section-title h2{
            font-size: 38px;
            font-weight: 800;
            margin-top: 8px;
        }

        .section-title p{
            color: #64748b;
            max-width: 650px;
            margin: 12px auto 0;
        }

        /* Categories */
        .category-card{
            background: #fff;
            border-radius: 24px;
            padding: 28px 22px;
            text-align: center;
            border: 1px solid #e2e8f0;
            transition: .3s;
            height: 100%;
        }

        .category-card:hover{
            transform: translateY(-8px);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            border-color: #2dd4bf;
        }

        .category-icon{
            width: 72px;
            height: 72px;
            border-radius: 22px;
            background: #ecfeff;
            color: #0891b2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 18px;
        }

        .category-card h5{
            font-weight: 700;
            margin-bottom: 8px;
        }

        .category-card p{
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        /* Items */
        .item-card{
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: .3s;
            height: 100%;
        }

        .item-card:hover{
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.13);
        }

        .item-img{
            height: 210px;
            width: 100%;
            object-fit: cover;
        }

        .item-body{
            padding: 22px;
        }

        .item-body h5{
            font-weight: 700;
            margin-bottom: 7px;
        }

        .item-price{
            color: #0f766e;
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .item-meta{
            display: flex;
            justify-content: space-between;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .btn-small{
            background: #0f172a;
            color: #fff;
            display: block;
            text-align: center;
            padding: 11px;
            border-radius: 13px;
            font-weight: 600;
            transition: .3s;
        }

        .btn-small:hover{
            background: #14b8a6;
            color: #fff;
        }

        /* How Works */
        .how-section{
            background: #fff;
        }

        .step-card{
            text-align: center;
            padding: 30px 20px;
            border-radius: 24px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            height: 100%;
            position: relative;
            transition: .3s;
        }

        .step-card:hover{
            background: #ecfeff;
            transform: translateY(-7px);
        }

        .step-number{
            width: 58px;
            height: 58px;
            background: #2dd4bf;
            color: #032127;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
            margin: 0 auto 18px;
        }

        .step-card h5{
            font-weight: 700;
            margin-bottom: 10px;
        }

        .step-card p{
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }

        /* CTA */
        .cta{
            background:
                linear-gradient(120deg, rgba(3, 12, 34, 0.96), rgba(15, 118, 110, 0.88)),
                url("https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1500&q=80");
            background-size: cover;
            background-position: center;
            color: #fff;
            border-radius: 32px;
            padding: 60px 35px;
            text-align: center;
        }

        .cta h2{
            font-weight: 800;
            font-size: 38px;
            margin-bottom: 15px;
        }

        .cta p{
            color: #dbeafe;
            max-width: 700px;
            margin: 0 auto 28px;
            line-height: 1.8;
        }

        /* Footer */
        footer{
            background: #020617;
            color: #cbd5e1;
            padding: 45px 0 20px;
        }

        footer h4{
            color: #fff;
            font-weight: 800;
        }

        footer h4 span{
            color: #2dd4bf;
        }

        footer p{
            color: #94a3b8;
            line-height: 1.7;
        }

        .footer-link{
            color: #cbd5e1;
            display: block;
            margin-bottom: 8px;
            transition: .3s;
        }

        .footer-link:hover{
            color: #2dd4bf;
        }

        .footer-bottom{
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 30px;
            padding-top: 18px;
            text-align: center;
            color: #94a3b8;
        }

        @media(max-width: 991px){
            .hero h1{
                font-size: 44px;
            }

            .hero{
                padding-top: 110px;
            }

            .hero-card{
                margin-top: 40px;
            }

            .nav-link{
                margin-left: 0;
                margin-top: 10px;
            }

            .btn-login,
            .btn-register{
                display: inline-block;
                margin-left: 0;
                margin-top: 12px;
            }
        }

        @media(max-width: 576px){
            .hero h1{
                font-size: 36px;
            }

            .hero p{
                font-size: 16px;
            }

            .section-title h2{
                font-size: 30px;
            }

            .hero-buttons{
                flex-direction: column;
            }

            .btn-main,
            .btn-outline-main{
                text-align: center;
                width: 100%;
            }

            .feature-strip{
                margin-top: 0;
            }
        }
    </style>
</head>

<body>

<!-- Navbar -->
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
                <li class="nav-item"><a class="nav-link" href="#categories">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="#items">Items</a></li>
                <li class="nav-item"><a class="nav-link" href="#how">How it Works</a></li>
                <li class="nav-item"><a class="nav-link" href="add_item.php">Sell Item</a></li>
                <li class="nav-item"><a class="btn-login" href="login.php">Login</a></li>
                <li class="nav-item"><a class="btn-register" href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
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
                    <a href="#items" class="btn-main">
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

<!-- Feature Strip -->
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

<!-- Categories -->
<section class="section-padding" id="categories">
    <div class="container">
        <div class="section-title">
            <span>Browse Categories</span>
            <h2>Find What You Need</h2>
            <p>Explore popular campus item categories and connect with students from your college.</p>
        </div>

        <div class="row g-4">
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

            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-card">
                    <div class="category-icon"><i class="fa-solid fa-pen-ruler"></i></div>
                    <h5>Stationery</h5>
                    <p>Essentials</p>
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <div class="category-card">
                    <div class="category-icon"><i class="fa-solid fa-box"></i></div>
                    <h5>Others</h5>
                    <p>More items</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Demo Items -->
<section class="section-padding pt-0" id="items">
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
                        <a href="#" class="btn-small">View Details</a>
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
                        <a href="#" class="btn-small">View Details</a>
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
                        <a href="#" class="btn-small">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="section-padding how-section" id="how">
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
    </div>
</section>

<!-- CTA -->
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

<!-- Footer -->
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
                <a href="#categories" class="footer-link">Categories</a>
                <a href="#items" class="footer-link">Items</a>
                <a href="#how" class="footer-link">How it Works</a>
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>