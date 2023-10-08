<?php
$page = "Settings";
include("header.php");
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-md-8 mb-4 mb-md-0">
                    <h3 class="font-weight-bold">Settings</h3>
                    <h6 class="font-weight-normal mb-0">Manage your profile here</h6>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
                    <div class="justify-content-end d-flex">
                        <button
                            class="btn btn-sm btn-inverse-primary justify-content-center d-flex align-items-center go-back-btn">
                            <i class="mdi mdi-arrow-left me-2"></i>Go Back
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin flex-column stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="pt-3 update-admin">
                        <div class="form-group profile-wrapper">
                            <!-- <div class="profile-photo m-auto border rounded-circle">
                                <div class="image">
                                    <img class="site_image_preview" src="../assets/logo/favicon.png" alt="Select Image">
                                    <div class="update-image">
                                        <input class="site_image_main profile_photo" type="file" name="profile"
                                            accept="image/*">
                                        <label>
                                            <i class="mdi mdi-camera"></i>
                                            <h4>Upload New</h4>
                                        </label>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="name" name="name"
                                placeholder="Name" value="<?php echo $admin_name; ?>">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" id="email" name="email"
                                placeholder="Email ID" value="<?php echo $admin_email; ?>">
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control form-control-lg" id="phone" name="phone"
                                placeholder="Phone Number" value="<?php echo $admin_phone; ?>">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg" id="password" name="password"
                                placeholder="Password (Optional)">
                        </div>

                        <div class="mt-4 d-flex justify-content-center align-items-center">
                            <button
                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>