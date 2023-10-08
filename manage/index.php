<?php
$page = "Update User";
include("header.php");


$sql = "SELECT * FROM `user` WHERE `id` = '$user_id'";

if ($db->sql($sql)) {
    $result = $db->result();
    $numrows = $db->numrows();
} else {
    die("Internal Server Error");
}

if ($numrows == 0) {
   echo '<script>window.location.href="login";</script>';
    exit();
}

?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-md-8 mb-4 mb-md-0">
                    <h3 class="font-weight-bold">Profile</h3>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="edit-profile" data-id="<?= base64_encode($user_id) ?>">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="awards_thumbnail">Select Color</label>
                                <div class="form-group overflow-hidden">
                                    <input type='color' name="color_code" value="<?= $result[0]['card_color'] ?>" />
                                </div>
                            </div>
                            <div class=" form-group">
                                <label for="awards_thumbnail">Profile Banner Image</label>
                                <div class="form-group overflow-hidden">
                                    <input type='file' name="profile_banenr_img" accept=".jpg, .jpeg"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="company_img">Company Image</label>
                                <div class="form-group overflow-hidden">
                                    <input type='file' name="company_img" accept=".jpg, .jpeg"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="awards_thumbnail">Profile Image</label>
                                <div class="form-group overflow-hidden">
                                    <input type='file' name="profile_img" accept=" .jpg, .jpeg"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Pass Code</label>
                                <input type="text" name="pass_code" class="form-control" id="name"
                                    placeholder="Please Enter Pass Code" value="">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Please Enter Name" value="<?= $result[0]['full_name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Please Enter Email" value="<?= $result[0]['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" class="form-control" id="mobile"
                                    placeholder="Please Enter Mobile" value="<?= $result[0]['mobile'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="work_number">Work Number</label>
                                <input type="text" name="work_number" class="form-control" id="work_number"
                                    placeholder="Please Enter Work Number" value="<?= $result[0]['mobile'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="whats_number">WhatsUp Number</label>
                                <input type="text" name="whats_number" class="form-control" id="whats_number"
                                    placeholder="Please Enter WhatsUp Number" value="<?= $result[0]['whats_number'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="company_name"
                                    placeholder="Please Enter Company Name" value="<?= $result[0]['company'] ?>">
                            </div>

                            <div class=" form-group">
                                <label for="designation">Designation</label>
                                <input type="text" name="designation" class="form-control" id="designation"
                                    placeholder="Please Enter Designation" value="<?= $result[0]['occupation'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="self_bio">Bio</label>
                                <textarea type="text" name="bio" class="form-control" id="self_bio"
                                    placeholder="Please Enter Bio"><?= $result[0]['self_bio'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="bank">Bank Details</label>
                                <textarea type="text" name="bank_details" class="form-control" id="bank"
                                    placeholder="Please Enter Bank Details"><?= $result[0]['bank_details'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="gst">GST Number</label>
                                <input type="text" name="gst" class="form-control" id="gst"
                                    placeholder="Please Enter GST Number" value="<?= $result[0]['gst'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="address_link">Address Link</label>
                                <input type="text" name="address_link" class="form-control" id="address_link"
                                    placeholder="Please Enter Address Link" value="<?= $result[0]['address_link'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea type="text" name="address" class="form-control" id="address"
                                    placeholder="Please Enter Bank Details"><?= $result[0]['address'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="site_link">Website</label>
                                <input type="url" name="site_link" class="form-control" id="site_link"
                                    placeholder="Please Enter Website Link" value="<?= $result[0]['site_link'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="yt_link">Youtube Link</label>
                                <input type="url" name="yt_link" class="form-control" id="yt_link"
                                    placeholder="Please Enter Youtube Link" value="<?= $result[0]['yt_link'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="fb_link">Facebook Profile Link</label>
                                <input type="url" name="fb_link" class="form-control" id="fb_link"
                                    placeholder="Please Enter Facebook Profile Link"
                                    value="<?= $result[0]['fb_link'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="insta_link">Instagram Profile Link</label>
                                <input type="url" name="insta_link" class="form-control" id="insta_link"
                                    placeholder="Please Enter Instagram Profile Link"
                                    value="<?= $result[0]['insta_link'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="tw_link">twitter Profile Link</label>
                                <input type="url" name="tw_link" class="form-control" id="tw_link"
                                    placeholder="Please Enter twitter Profile Link"
                                    value="<?= $result[0]['twitter_link'] ?>">
                            </div>
                            <div class=" form-group">
                                <label for="ln_link">Linkedin Profile Link</label>
                                <input type="url" name="ln_link" class="form-control" id="ln_link"
                                    placeholder="Please Enter Linkedin Profile Link"
                                    value="<?= $result[0]['ln_link'] ?>">
                            </div>
                            <div class=" modal-footer">
                                <button type="button" class="btn btn-inverse-danger rounded"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-dark rounded">Submit</button>
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