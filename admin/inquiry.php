<?php
$page = "Manage Inquiry";
include("header.php");

// $sql = "SELECT `career`.*, IF(COUNT(`applicants`.`career_id`) = 0, NULL, COUNT(`applicants`.`career_id`)) as `applicants` FROM `career` LEFT JOIN `applicants` ON `career`.`id` = `applicants`.`career_id` WHERE `career`.`status` != 'Deleted' HAVING COUNT(`applicants`.`career_id`) IS NOT NULL ORDER BY `career`.`id` DESC";

$sql = "SELECT * FROM `inquiry`";

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
                    <h3 class="font-weight-bold">Manage Careers</h3>
                    <h6 class="font-weight-normal mb-0">Manage all the job postings here</h6>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-center justify-content-end">
                    <div class="justify-content-end d-flex">
                        <button class="btn btn-sm btn-primary justify-content-center d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#add_new_popup">
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
                    <p class="card-title mb-4">Inquiry</p>
                    <div class="table">
                        <table class="table table-striped table-borderless" id="hireTable">
                            <thead>
                                <tr>
                                    <th>Inquiry ID</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Phone</th>
                                    <th>msg</th>
                                    <th class="action-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM `inquiry`";

                                if ($db->sql($sql)) {
                                    $result = $db->result();

                                    if ($db->numrows() > 0) {
                                        foreach ($result as $key => $row) {
                                ?>
                                            <tr>
                                                <td>INQ00<?php echo $row['id']; ?></td>
                                                <td><?php echo date('d-m-Y', strtotime($row['created_on'])); ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['email']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td><?php echo $row['msg']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="action-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="icon-more-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item update_inquiry" href="javascript:void(0);" data-id="<?php echo $row['id']; ?>">Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                <?php
                                        }
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

<div class="modal fade" id="add_new_popup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add_new_popupLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form class="add-new-careers-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_new_popupLabel">Add New Job Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Job Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Please Enter Job Title">
                    </div>

                    <!-- <div class="form-group">
                        <label for="experience">Experience</label>
                        <input type="text" name="experience" class="form-control" id="experience" placeholder="Please Enter Experience">
                    </div> -->
                    <div class="form-group">
                        <label for="experience">Experience</label>
                        <select class="form-control" name="experience" id="experience">
                            <option selected>All Job Experience</option>
                            <option value="Fresher">Fresher</option>
                            <option value="1-2 years">1-2 years</option>
                            <option value="2-5">2-5 years</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category">Categories</label>
                        <select class="form-control" name="category" id="category">
                            <option selected>All Job Category</option>
                            <option value="AM/Manager">AM/Manager</option>
                            <option value="Customer Care Executive">Customer Care Executive</option>
                            <option value="Customer Delight Executive">Customer Delight Executive</option>
                            <option value="Executive – Partner Delight">Executive – Partner Delight</option>
                            <option value="HR Assistant Manager/ Manager">HR Assistant Manager/ Manager</option>
                            <option value="Manager">Manager</option>
                            <option value="Manager Operations">Manager Operations</option>
                            <option value="Partner Delight Executive">Partner Delight Executive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" name="qualification" class="form-control" id="qualification" placeholder="Please Enter Qualification">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <select class="form-control" name="location" id="location">
                            <option value="Mumbai" selected>Mumbai</option>
                            <option value="Gurugram">Gurugram</option>
                            <option value="Bengaluru">Bengaluru</option>
                            <option value="Chennai">Chennai</option>
                            <option value="Noida">Noida</option>
                            <option value="Hyderabad">Hyderabad</option>
                            <option value="New York">New York</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" class="form-control career_description" id="description" placeholder="Please Enter Description" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-inverse-danger rounded" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-inverse-primary rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>