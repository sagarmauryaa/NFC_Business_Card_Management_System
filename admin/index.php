<?php
$page = "Dashboard";
include("header.php");


$sql = "SELECT * FROM `user` ORDER BY `id` DESC";

if ($db->sql($sql)) {
    $result = $db->result();
    $numrows = $db->numrows();
} else {
    die("Internal Server Error");
}

?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-md-8 mb-4 mb-md-0">
                    <h3 class="font-weight-bold">Welcome <?php echo $_SESSION['admin_name']; ?></h3>
                    <h6 class="font-weight-normal mb-0">Manage all the website work at your ease</h6>
                </div>
                <div class="col-12 col-md-4">
                    <div class="justify-content-end d-flex">
                        <div class="btn btn-sm btn-light bg-white justify-content-start d-flex align-items-center">
                            <i class="mdi mdi-calendar me-2"></i>Today (<?php echo date("d M Y"); ?>)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row  justify-content-end">
                <div class="col-12 col-md-8 mb-4 mb-md-0">
                    <div class="col-md-4 stretch-card transparent">
                        <div class="card   btn-inverse-dark">
                            <?php
                            $total_inquiry = 0;

                            $regsql = "SELECT `id` FROM `user`";
                            if ($db->sql($regsql)) {
                                $db->result();

                                $total_inquiry = $db->numrows();
                            }
                            ?>
                            <div class="card-body ">
                                <p class="mb-4">Total user</p>
                                <p class="fs-30 mb-2"><?php echo $total_inquiry; ?></p>
                                <p>Till Date</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
                    <div class="justify-content-end d-flex">
                        <button class="btn btn-sm btn-dark justify-content-center d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#add_new_popup">
                            <i class="mdi mdi-plus me-2"></i>Add New
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table">
                        <table class="table table-striped table-borderless" id="hireTable">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>View Page</th>
                                    <th>Is Verfied</th>
                                    <th>Is Active</th>
                                    <th>Date</th>
                                    <th class="action-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($numrows > 0) {
                                    foreach ($result as $key => $row) {
                                ?>
                                <tr>
                                    <td><?php echo 'FS-'.$row['id']; ?></td>
                                    <td><?php echo $row['full_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['mobile']; ?></td>

                                    <td><a href="../profile?id=<?= $row['slug']; ?>" target="_blank">View Page</a></td>
                                    <td><?php if ($row['isVerified'] == 1) {
                                                ?>
                                        <button class="toggle_verify badge badge-success" data-id="<?= $row['id']; ?>"
                                            data-status="<?= $row['isVerified']; ?>">Verfied</button>
                                        <?php
                                                } else {
                                                ?>
                                        <button class="toggle_verify badge badge-danger" data-id="<?= $row['id']; ?>"
                                            data-status="<?= $row['isVerified']; ?>">Not Verfied</button>

                                        <?php
                                                }
                                                ?>
                                    </td>
                                    <td><?php if ($row['is_enabaled'] == 1) {
                                                ?>
                                        <button class="toggle_active badge badge-success" data-id="<?= $row['id']; ?>"
                                            data-status="<?= $row['is_enabaled']; ?>">Active</button>
                                        <?php
                                                } else {
                                                ?>
                                        <button class="toggle_active badge badge-danger" data-id="<?= $row['id']; ?>"
                                            data-status="<?= $row['is_enabaled']; ?>">Not Active</button>

                                        <?php
                                                }
                                                ?>
                                    </td>
                                    <td><?php echo $row['created_on']; ?></td>

                                    <td>
                                        <div class="dropdown">
                                            <button class="action-btn" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="icon-more-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a target="_blank" referrerpolicy="noreferer" class="dropdown-item"
                                                        href="edit-user?id=<?php echo base64_encode($row['id']); ?>">Edit
                                                        Profile</a>
                                                     <a class="dropdown-item delete_user" href="javascript:void(0);" data-id="<?php echo base64_encode($row['id']); ?>" data-status="Deleted">Delete</a> 
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_new_popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="add_new_popupLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form class="add-profile">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_new_popupLabel">Create Profile </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="awards_thumbnail">Select Color</label>
                        <div class="form-group overflow-hidden">
                            <input required="required" type='color' name="color_code" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug*</label>
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Please Enter Slug" required="required" >
                    </div>
                    <div class="form-group">
                        <label for="awards_thumbnail">Profile Banner Image (500px x 250px)</label>
                        <div class="form-group overflow-hidden">
                            <input  type='file' name="profile_banenr_img" accept=".jpg, .jpeg"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="company_img">Company Image (250px x 250px)</label>
                        <div class="form-group overflow-hidden">
                            <input type='file' name="company_img" accept=".jpg, .jpeg"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="awards_thumbnail">Profile Image (250px x 250px)</label>
                        <div class="form-group overflow-hidden">
                            <input  type='file' name="profile_img" accept=".jpg, .jpeg"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Please Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Please Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" class="form-control" id="mobile"
                            placeholder="Please Enter Mobile">
                    </div>
                    <div class="form-group">
                        <label for="work_number">Work Number</label>
                        <input type="text" name="work_number" class="form-control" id="work_number"
                            placeholder="Please Enter Work Number">
                    </div>
                    <div class="form-group">
                        <label for="whats_number">WhatsUp Number</label>
                        <input type="text" name="whats_number" class="form-control" id="whats_number"
                            placeholder="Please Enter WhatsUp Number">
                    </div>
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="company_name"
                            placeholder="Please Enter Company Name">
                    </div>
                    <div class="form-group">
                        <label for="gst">GST Number</label>
                        <input type="text" name="gst" class="form-control" id="gst"
                            placeholder="Please Enter GST Number">
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <input type="text" name="designation" class="form-control" id="designation"
                            placeholder="Please Enter Designation">
                    </div>
                    <div class="form-group">
                        <label for="self_bio">Bio</label>
                        <textarea type="text" name="bio" class="form-control" id="self_bio"
                            placeholder="Please Enter Bio"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="address_link">Address Link</label>
                        <input type="text" name="address_link" class="form-control" id="address_link"
                            placeholder="Please Enter Address Link">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address"
                            placeholder="Please Enter Address">
                    </div>
                    <div class="form-group">
                        <label for="bank">Bank Details</label>
                        <textarea type="text" name="bank_details" class="form-control" id="bank"
                            placeholder="Please Enter Bank Details"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="site_link">Website</label>
                        <input type="url" name="site_link" class="form-control" id="site_link"
                            placeholder="Please Enter Website Link">
                    </div>
                    <div class="form-group">
                        <label for="fb_link">Youtube Link</label>
                        <input type="url" name="yt_link" class="form-control" id="fb_link"
                            placeholder="Please Enter Youtube Link">
                    </div>
                    <div class="form-group">
                        <label for="fb_link">Facebook Profile Link</label>
                        <input type="url" name="fb_link" class="form-control" id="fb_link"
                            placeholder="Please Enter Facebook Profile Link">
                    </div>
                    <div class="form-group">
                        <label for="insta_link">Instagram Profile Link</label>
                        <input type="url" name="insta_link" class="form-control" id="insta_link"
                            placeholder="Please Enter Instagram Profile Link">
                    </div>
                    <div class="form-group">
                        <label for="tw_link">twitter Profile Link</label>
                        <input type="url" name="tw_link" class="form-control" id="tw_link"
                            placeholder="Please Enter twitter Profile Link">
                    </div>
                    <div class="form-group">
                        <label for="ln_link">Linkedin Profile Link</label>
                        <input type="url" name="ln_link" class="form-control" id="ln_link"
                            placeholder="Please Enter Linkedin Profile Link">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-dark rounded" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>