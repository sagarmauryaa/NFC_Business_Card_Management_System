<?php
session_start();

if (!isset($_SESSION['token_id']) and !isset($_SESSION['token'])) {
    echo '<script>window.history.back(-1);</script>';
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create New Password</title>
    <link rel="stylesheet" href="./vendors/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="./assets/images/logo-dark.svg" alt="logo">
                            </div>
                            <h4>Create new password</h4>
                            <!-- <h6 class="font-weight-light">Enter details to continue.</h6> -->
                            <form class="pt-3 create-new-password">
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-lg" id="otp" name="otp" placeholder="OTP">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SUBMIT</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Remember password? <a href="login" class="text-primary">Go Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <footer class="footer">
        <div class="d-flex justify-content-center">
            <span class="text-muted text-center">Copyright &copy; <?php echo date("Y"); ?> Powered by <a href="https://sagarmaurya.com" target="_blank">Sagar Maurya</a></span>
        </div>
    </footer>
    <!-- partial -->
    </div>
    <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script src="./vendors/js/vendor.bundle.base.js"></script>
    <script src="./class/data.js"></script>
</body>

</html>