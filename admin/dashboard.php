<?php
session_start();
include "../includes/conn.php";

if(!isset($_SESSION['admin_login'])){
    header("Location: admin_login.php");
    exit();
}

$pending_students = mysqli_query($connect, "SELECT * FROM students WHERE status='Pending' ORDER BY id DESC");
$approved_students = mysqli_query($connect, "SELECT * FROM students WHERE status='Approved' ORDER BY id DESC LIMIT 5");

$pending_items = mysqli_query($connect, "
    SELECT items.*, students.name AS student_name, students.department
    FROM items
    LEFT JOIN students ON items.student_id = students.id
    WHERE items.status='Pending'
    ORDER BY items.id DESC
");

$approved_items = mysqli_query($connect, "
    SELECT items.*, students.name AS student_name
    FROM items
    LEFT JOIN students ON items.student_id = students.id
    WHERE items.status='Approved'
    ORDER BY items.id DESC
    LIMIT 5
");

$total_students = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM students"))['total'];
$total_items = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM items"))['total'];
$total_pending_students = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM students WHERE status='Pending'"))['total'];
$total_pending_items = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) AS total FROM items WHERE status='Pending'"))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Campus Exchange</title>
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
            font-family: 'Poppins', sans-serif;
        }

        body{
            background: #f4f7fb;
            color: #0f172a;
        }

        .sidebar{
            min-height: 100vh;
            background: #020617;
            color: #fff;
            position: fixed;
            width: 270px;
            left: 0;
            top: 0;
            padding: 25px 18px;
            z-index: 1000;
        }

        .brand{
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 35px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand i{
            color: #2dd4bf;
        }

        .brand span{
            color: #2dd4bf;
        }

        .sidebar a{
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 14px;
            margin-bottom: 8px;
            font-weight: 500;
            transition: .3s;
        }

        .sidebar a:hover,
        .sidebar a.active{
            background: #0f766e;
            color: #fff;
        }

        .logout-link{
            position: absolute;
            bottom: 25px;
            left: 18px;
            right: 18px;
            background: rgba(220, 38, 38, 0.16);
            color: #fecaca !important;
        }

        .main-content{
            margin-left: 270px;
            padding: 28px;
        }

        .topbar{
            background: #fff;
            border-radius: 22px;
            padding: 22px 25px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            margin-bottom: 28px;
        }

        .topbar h3{
            font-weight: 800;
            margin: 0;
        }

        .topbar p{
            color: #64748b;
            margin: 5px 0 0;
        }

        .stat-card{
            background: #fff;
            border-radius: 22px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
            height: 100%;
            transition: .3s;
        }

        .stat-card:hover{
            transform: translateY(-5px);
        }

        .stat-icon{
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: #ccfbf1;
            color: #0f766e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 18px;
        }

        .stat-card h4{
            font-weight: 800;
            font-size: 30px;
            margin-bottom: 5px;
        }

        .stat-card p{
            margin: 0;
            color: #64748b;
            font-weight: 500;
        }

        .section-card{
            background: #fff;
            border-radius: 24px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid #e2e8f0;
            margin-top: 28px;
        }

        .section-title{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .section-title h4{
            font-weight: 800;
            margin: 0;
        }

        .badge-custom{
            background: #ecfeff;
            color: #0f766e;
            padding: 8px 13px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 13px;
        }

        .table{
            vertical-align: middle;
        }

        .table thead th{
            background: #f8fafc;
            color: #334155;
            font-size: 14px;
            border-bottom: none;
            padding: 15px;
        }

        .table tbody td{
            padding: 15px;
            color: #334155;
            font-size: 14px;
        }

        .id-img,
        .item-img{
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
        }

        .btn-approve{
            background: #16a34a;
            color: #fff;
            border: none;
            padding: 8px 13px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
        }

        .btn-reject{
            background: #dc2626;
            color: #fff;
            border: none;
            padding: 8px 13px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
        }

        .btn-approve:hover,
        .btn-reject:hover{
            opacity: .9;
            color: #fff;
        }

        .empty-box{
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .empty-box i{
            font-size: 42px;
            color: #cbd5e1;
            margin-bottom: 12px;
        }

        .mobile-navbar{
            display: none;
            background: #020617;
            color: #fff;
            padding: 15px 20px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .mobile-navbar .brand-mobile{
            font-weight: 800;
            font-size: 20px;
        }

        .mobile-navbar button{
            border: none;
            background: #0f766e;
            color: #fff;
            padding: 8px 13px;
            border-radius: 10px;
        }

        @media(max-width: 991px){
            .sidebar{
                left: -280px;
                transition: .3s;
            }

            .sidebar.show{
                left: 0;
            }

            .main-content{
                margin-left: 0;
                padding: 18px;
            }

            .mobile-navbar{
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }

        @media(max-width: 576px){
            .topbar{
                padding: 18px;
            }

            .topbar h3{
                font-size: 22px;
            }

            .section-card{
                padding: 18px;
            }

            .section-title{
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

<!-- Mobile Navbar -->
<div class="mobile-navbar">
    <div class="brand-mobile">
        <i class="fa-solid fa-graduation-cap text-info me-2"></i>
        Campus Exchange
    </div>
    <button onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="brand">
        <i class="fa-solid fa-graduation-cap"></i>
        Campus <span>Exchange</span>
    </div>

    <a href="dashboard.php" class="active">
        <i class="fa-solid fa-chart-line"></i>
        Dashboard
    </a>

    <a href="#students">
        <i class="fa-solid fa-user-check"></i>
        Pending Students
    </a>

    <a href="#items">
        <i class="fa-solid fa-box-open"></i>
        Pending Items
    </a>

    <a href="../index.php">
        <i class="fa-solid fa-house"></i>
        Visit Website
    </a>

    <a href="logout.php" class="logout-link">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>
</div>

<!-- Main Content -->
<div class="main-content">

    <div class="topbar">
        <h3>Admin Dashboard</h3>
        <p>Welcome, <?php echo $_SESSION['admin_username']; ?>. Manage student verification and item moderation.</p>
    </div>

    <!-- Stats -->
    <div class="row g-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h4><?php echo $total_students; ?></h4>
                <p>Total Students</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <h4><?php echo $total_pending_students; ?></h4>
                <p>Pending Students</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-box"></i>
                </div>
                <h4><?php echo $total_items; ?></h4>
                <p>Total Items</p>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-boxes-packing"></i>
                </div>
                <h4><?php echo $total_pending_items; ?></h4>
                <p>Pending Items</p>
            </div>
        </div>
    </div>

    <!-- Pending Students -->
    <div class="section-card" id="students">
        <div class="section-title">
            <h4><i class="fa-solid fa-user-clock me-2 text-success"></i>Pending Student Verification</h4>
            <span class="badge-custom"><?php echo $total_pending_students; ?> Pending</span>
        </div>

        <div class="table-responsive">
            <?php if(mysqli_num_rows($pending_students) > 0){ ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Card</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Semester</th>
                            <th>Roll No</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while($student = mysqli_fetch_assoc($pending_students)){ ?>
                        <tr>
                            <td>
                                <?php if(!empty($student['id_card_image'])){ ?>
                                    <img src="../uploads/id_cards/<?php echo $student['id_card_image']; ?>" class="id-img">
                                <?php }else{ ?>
                                    <span class="text-muted">No Image</span>
                                <?php } ?>
                            </td>
                            <td><?php echo $student['name']; ?></td>
                            <td><?php echo $student['email']; ?></td>
                            <td><?php echo $student['department']; ?></td>
                            <td><?php echo $student['semester']; ?></td>
                            <td><?php echo $student['roll_no']; ?></td>
                            <td><?php echo $student['phone']; ?></td>
                            <td>
                                <button class="btn-approve mb-1" onclick="confirmAction('approve_student.php?id=<?php echo $student['id']; ?>', 'Approve this student?', 'Student will be verified.')">
                                    <i class="fa-solid fa-check"></i>
                                </button>

                                <button class="btn-reject mb-1" onclick="confirmAction('reject_student.php?id=<?php echo $student['id']; ?>', 'Reject this student?', 'Student account will be rejected.')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php }else{ ?>
                <div class="empty-box">
                    <i class="fa-solid fa-circle-check"></i>
                    <h5>No pending students</h5>
                    <p>All student verification requests are completed.</p>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Pending Items -->
    <div class="section-card" id="items">
        <div class="section-title">
            <h4><i class="fa-solid fa-box-open me-2 text-success"></i>Pending Item Approval</h4>
            <span class="badge-custom"><?php echo $total_pending_items; ?> Pending</span>
        </div>

        <div class="table-responsive">
            <?php if(mysqli_num_rows($pending_items) > 0){ ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Item</th>
                            <th>Seller</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Condition</th>
                            <th>Meetup</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while($item = mysqli_fetch_assoc($pending_items)){ ?>
                        <tr>
                            <td>
                                <?php if(!empty($item['image'])){ ?>
                                    <img src="../uploads/items/<?php echo $item['image']; ?>" class="item-img">
                                <?php }else{ ?>
                                    <span class="text-muted">No Image</span>
                                <?php } ?>
                            </td>
                            <td>
                                <strong><?php echo $item['item_name']; ?></strong><br>
                                <small class="text-muted"><?php echo substr($item['description'], 0, 45); ?>...</small>
                            </td>
                            <td><?php echo $item['student_name']; ?></td>
                            <td><?php echo $item['category']; ?></td>
                            <td>₹<?php echo $item['price']; ?></td>
                            <td><?php echo $item['exchange_type']; ?></td>
                            <td><?php echo $item['item_condition']; ?></td>
                            <td><?php echo $item['meetup_location']; ?></td>
                            <td>
                                <button class="btn-approve mb-1" onclick="confirmAction('approve_item.php?id=<?php echo $item['id']; ?>', 'Approve this item?', 'Item will be visible on website.')">
                                    <i class="fa-solid fa-check"></i>
                                </button>

                                <button class="btn-reject mb-1" onclick="confirmAction('reject_item.php?id=<?php echo $item['id']; ?>', 'Reject this item?', 'Item will not be visible.')">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php }else{ ?>
                <div class="empty-box">
                    <i class="fa-solid fa-circle-check"></i>
                    <h5>No pending items</h5>
                    <p>All item approval requests are completed.</p>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
function toggleSidebar(){
    document.getElementById("sidebar").classList.toggle("show");
}

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

function confirmAction(url, title, text){
    Swal.fire({
        title: title,
        text: text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0f766e',
        cancelButtonColor: '#dc2626',
        confirmButtonText: 'Yes, continue',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.isConfirmed){
            window.location.href = url;
        }
    });
}
</script>

<?php if(isset($_GET['login']) && $_GET['login'] == "success"){ ?>
<script>
    showToast('success', 'Admin login successful!');
</script>
<?php } ?>

<?php if(isset($_GET['student']) && $_GET['student'] == "approved"){ ?>
<script>
    showToast('success', 'Student approved successfully!');
</script>
<?php } ?>

<?php if(isset($_GET['student']) && $_GET['student'] == "rejected"){ ?>
<script>
    showToast('success', 'Student rejected successfully!');
</script>
<?php } ?>

<?php if(isset($_GET['item']) && $_GET['item'] == "approved"){ ?>
<script>
    showToast('success', 'Item approved successfully!');
</script>
<?php } ?>

<?php if(isset($_GET['item']) && $_GET['item'] == "rejected"){ ?>
<script>
    showToast('success', 'Item rejected successfully!');
</script>
<?php } ?>

</body>
</html>