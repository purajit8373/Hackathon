<?php
session_start();
include "../includes/conn.php";

$error = "";

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connect, $query);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['admin_login'] = true;
        $_SESSION['admin_username'] = $username;

        header("Location: dashboard.php?login=success");
        exit();
    }else{
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Campus Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            min-height: 100vh;
            background:
                linear-gradient(120deg, rgba(3, 12, 34, 0.94), rgba(15, 118, 110, 0.82)),
                url("https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1600&q=80");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-wrapper{
            width: 100%;
            max-width: 980px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(18px);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 35px 90px rgba(0,0,0,0.38);
        }

        .left-panel{
            background:
                linear-gradient(135deg, rgba(3, 12, 34, 0.92), rgba(20, 184, 166, 0.72)),
                url("https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=900&q=80");
            background-size: cover;
            background-position: center;
            color: #fff;
            min-height: 520px;
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            position: relative;
        }

        .left-panel::before{
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(45, 212, 191, 0.25);
            top: 35px;
            right: 35px;
            filter: blur(4px);
        }

        .brand{
            position: absolute;
            top: 35px;
            left: 45px;
            font-size: 25px;
            font-weight: 800;
            z-index: 2;
        }

        .brand i{
            color: #2dd4bf;
            margin-right: 8px;
        }

        .brand span{
            color: #2dd4bf;
        }

        .left-content{
            position: relative;
            z-index: 2;
        }

        .left-content h1{
            font-size: 42px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .left-content p{
            color: #dbeafe;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 0;
        }

        .right-panel{
            background: #fff;
            min-height: 520px;
            padding: 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .admin-icon{
            width: 78px;
            height: 78px;
            border-radius: 24px;
            background: #ccfbf1;
            color: #0f766e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            margin-bottom: 22px;
        }

        .right-panel h2{
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .right-panel .subtitle{
            color: #64748b;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        label{
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .input-group-text{
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-right: none;
            border-radius: 14px 0 0 14px;
            color: #0f766e;
        }

        .form-control{
            height: 54px;
            border: 1px solid #e2e8f0;
            border-left: none;
            border-radius: 0 14px 14px 0;
            font-size: 15px;
        }

        .form-control:focus{
            box-shadow: none;
            border-color: #2dd4bf;
        }

        .input-group:focus-within .input-group-text{
            border-color: #2dd4bf;
        }

        .btn-admin-login{
            width: 100%;
            height: 54px;
            border: none;
            border-radius: 15px;
            background: #0f172a;
            color: #fff;
            font-weight: 800;
            margin-top: 10px;
            transition: .3s;
        }

        .btn-admin-login:hover{
            background: #14b8a6;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(20, 184, 166, 0.30);
        }

        .back-link{
            text-align: center;
            margin-top: 22px;
        }

        .back-link a{
            color: #0f766e;
            text-decoration: none;
            font-weight: 700;
        }

        .back-link a:hover{
            color: #0f172a;
        }

        .demo-info{
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            padding: 14px;
            color: #475569;
            font-size: 14px;
            margin-bottom: 22px;
        }

        .demo-info strong{
            color: #0f172a;
        }

        @media(max-width: 991px){
            .left-panel{
                min-height: 330px;
                padding: 35px;
            }

            .right-panel{
                min-height: auto;
                padding: 35px;
            }

            .left-content h1{
                font-size: 34px;
            }
        }

        @media(max-width: 576px){
            body{
                padding: 12px;
            }

            .login-wrapper{
                border-radius: 22px;
            }

            .left-panel{
                min-height: 280px;
                padding: 28px;
            }

            .brand{
                top: 25px;
                left: 28px;
                font-size: 21px;
            }

            .left-content h1{
                font-size: 28px;
            }

            .left-content p{
                font-size: 14px;
            }

            .right-panel{
                padding: 28px;
            }

            .admin-icon{
                width: 65px;
                height: 65px;
                font-size: 28px;
                border-radius: 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="row g-0">
        <div class="col-lg-6">
            <div class="left-panel">
                <div class="brand">
                    <i class="fa-solid fa-graduation-cap"></i>
                    Campus <span>Exchange</span>
                </div>

                <div class="left-content">
                    <h1>Admin Moderation Panel</h1>
                    <p>
                        Review students, approve listings, reject fake posts and maintain
                        a safe trusted marketplace inside the campus.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="right-panel">
                <div class="admin-icon">
                    <i class="fa-solid fa-user-shield"></i>
                </div>

                <h2>Admin Login</h2>
                <p class="subtitle">
                    Login to manage Campus Exchange verification and item moderation.
                </p>

                <div class="demo-info">
                    <strong>Demo Login:</strong><br>
                    Username: admin <br>
                    Password: admin123
                </div>

                <form method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label>Username</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <input type="text" name="username" class="form-control" placeholder="Enter admin username" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control" placeholder="Enter admin password" required>
                        </div>
                    </div>

                    <button type="submit" name="login" class="btn-admin-login">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>
                        Login
                    </button>
                </form>

                <div class="back-link">
                    <a href="../index.php">
                        <i class="fa-solid fa-arrow-left me-1"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function showToast(icon, title){
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: icon,
        title: title,
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });
}
</script>

<?php if($error != ""){ ?>
<script>
    showToast('error', '<?php echo $error; ?>');
</script>
<?php } ?>
<?php if(isset($_GET['logout']) && $_GET['logout'] == "success"){ ?>
<script>
    showToast('success', 'Admin logout successful!');
</script>
<?php } ?>
</body>
</html>