<?php
session_start();

include("./config/conn.php");

if (!isset($_SESSION['user_id']) and !isset($_SESSION['user_name']) and !isset($_SESSION['user_email'])) {
    echo '<script>window.location.href="login";</script>';
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email']; 

$db = new database();
$db->connect();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $page; ?></title>

    <link rel="stylesheet" href="./vendors/feather/feather.css">
    <link rel="stylesheet" href="./vendors/mdi/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.5/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="./vendors/DataTables/datatables.min.css">
    <link rel="stylesheet" href="./vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./vendors/font-awesome/css/all.min.css">

    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://cdn.ckeditor.com/4.21.0/standard-all/ckeditor.js"></script>

    <link rel="shortcut icon" href="../assets/febble.png" />
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <a class="navbar-brand brand-logo me-5" href="./">
                    <img src="../assets/febble-logo.png" class="main-site-logo img-fluid me-2"
                        alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="./">
                    <img src="../assets/febble.png" class="main-site-logo img-fluid" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                            <img src="../assets/febble.png"
                                alt="profile" class="border" />
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <!-- <a href="settings" class="dropdown-item">
                                <i class="ti-settings theme-color"></i>
                                Settings
                            </a> -->
                            <a href="javascript:void(0);" class="dropdown-item logout-btn logout-admin"
                                data-user="<?php echo $user_id; ?>">
                                <i class="ti-power-off theme-color"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="icon-menu"></span>
                </button>
            </div>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">


            <!-- sidebar -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">Profile</span>
                        </a>
                    </li>
                </ul>
            </nav> 

            <!-- partial -->
            <div class="main-panel">