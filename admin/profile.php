<?php
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');
// include('../includes/jobs.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_avatar'])) {
    $alumni_id = $_GET['alumni_id'];

    // Check if a file was selected
    if (isset($_FILES['avatar_upload']) && $_FILES['avatar_upload']['error'] === UPLOAD_ERR_OK) {
        $avatar_filename = $_FILES['avatar_upload']['name'];
        $avatar_temp_path = $_FILES['avatar_upload']['tmp_name'];
        $avatar_upload_dir = 'uploads/avatars/';

        // Create a unique name for the file
        $avatar_new_filename = uniqid('avatar_', true) . '_' . $avatar_filename;

        $avatar_destination = 'uploads/avatars/' . $avatar_new_filename;

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($avatar_temp_path, $avatar_destination,)) {
            // Update the database with the avatar image path
            $update_query = "UPDATE alumni SET AvatarImagePath = '$avatar_destination' WHERE Id = '$alumni_id'";
            $update_result = mysqli_query($conn, $update_query);
            if ($update_result) {
                // Data saved successfully
                $_SESSION['guul'] = "success"; // Set session variable for success
                $_SESSION['message'] = "Data saved successfully"; // Set success message
            } else {
                // Error saving data
                $_SESSION['guul'] = "fail"; // Set session variable for error
                $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
            }
        } else {
            // Error message if file move fails
            echo '<div class="alert alert-danger" role="alert">Error moving file to destination directory.</div>';
        }
    } else {
        // Error message if no file is selected
        echo '<div class="alert alert-danger" role="alert">Please select an avatar image to upload.</div>';
    }
}



?>

<style>
    /* Add your own styles as needed */
    body {
        font-family: Arial, sans-serif;

    }

    .custom-avatar-edit {
        width: 50px;
        /* Adjust the size as needed */
        height: 50px;
        /* Adjust the size as needed */
        /* cursor: pointer; */
        background-color: white;
        border-radius: 100%;
        margin-top: 90px;
        margin-bottom: 20;
        padding-bottom: 10;
        padding-right: 15;
        padding-left: 15;
        padding-top: 10;
        /* Add padding for visual spacing */

        /* Add margin for spacing from the bottom and sides */
    }

    .custom-avatar-edit img {
        align-self: center;
        /* margin-top: 5;
        padding-top: 5;
        padding-left: 10px;
        /* padding-right: 10px;  */
        /* margin-right: 10; */
        width: 20px;
        height: 30px;
        /* border-radius: 100%; */
        object-fit: fill;
        /* Maintain aspect ratio */
    }

    #profilePicture {
        max-width: 100%;
        max-height: 100%;
    }

    .btn-custom {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    /* Button color - White background with black text */
    .btn-custom.btn-white {
        color: #000;
        background-color: #fff;
        border-color: #DEDEDE;
    }

    /* Small button size */
    .btn-custom.btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    /* Hover state */
    .btn-custom:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .cover-input {
        width: 80px;
        max-width: 100%;
        color: #444;
        padding: 5px;
        background: #fff;
        border-radius: 10px;
        border: 1px solid #555;
    }

    .cover-btn {
        /* Your styling goes here */
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        color: #000;
        background-color: #fff;
        border-color: #fff;
    }

    /* Hover state */
    .cover-btn:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .cover-uploads {
        /* Your styling goes here */
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    /* Hover state */
    .cover-uploads:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>


<div class="page-wrapper">
    <div class="content container-fluid">
        <?php
        if (isset($_GET['alumni_id'])) {

            $alumni_id = $_GET['alumni_id'];
            $query = "SELECT * FROM alumni  WHERE Id = '$alumni_id'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Fetch user data
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {

                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_cover'])) {
                        $alumni_id = $_GET['alumni_id'];

                        // Check if a file was selected
                        if (isset($_FILES['cover_upload']) && $_FILES['cover_upload']['error'] === UPLOAD_ERR_OK) {
                            $cover_filename = $_FILES['cover_upload']['name'];
                            $cover_temp_path = $_FILES['cover_upload']['tmp_name'];
                            $cover_upload_dir = 'uploads/covers/';

                            // Create a unique name for the file
                            $cover_new_filename = uniqid('cover_', true) . '_' . $cover_filename;

                            $cover_destination = 'uploads/covers/' . $cover_new_filename;

                            // Move the uploaded file to the destination directory
                            if (move_uploaded_file($cover_temp_path, $cover_destination,)) {
                                // Update the database with the cover image path
                                $update_query = "UPDATE alumni SET CoverImagePath = '$cover_destination' WHERE Id = '$alumni_id'";
                                $update_result = mysqli_query($conn, $update_query);

                                if ($update_result) {
                                    // Success message
                                    echo '<div class="alert alert-success" role="alert">Cover image uploaded successfully!</div>';
                                } else {
                                    // Error message if database update fails
                                    echo '<div class="alert alert-danger" role="alert">Error updating database: ' . mysqli_error($conn) . '</div>';
                                }
                            } else {
                                // Error message if file move fails
                                echo '<div class="alert alert-danger" role="alert">Error moving file to destination directory.</div>';
                            }
                        } else {
                            // Error message if no file is selected
                            echo '<div class="alert alert-danger" role="alert">Please select a cover image to upload.</div>';
                        }
                    }



        ?>
                    <div class="row justify-content-lg-center">
                        <div class="col-lg-10">

                            <div class="page-header">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="page-title">Profile</h3>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Profile</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-cover">
                                <div class="profile-cover-wrap">
                                    <img class="profile-cover-img" src="<?php echo $user['CoverImagePath'] ?? ''; ?>" alt="Profile Cover">

                                    <div class="cover-content">
                                        <form class="custom-file-btn" method="post" enctype="multipart/form-data">
                                            <input type="file" class="custom-file-btn-input" id="cover_upload" name="cover_upload">
                                            <label class="cover-btn" for="cover_upload">
                                                <i class="fas fa-camera"></i>
                                                <span class="d-none d-sm-inline-block ms-1">Update Cover</span>
                                            </label>
                                            <button type="submit" class="cover-uploads" name="upload_cover">Upload</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myLargeModalLabel">Image Upload</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form starts here -->
                                            <form class="custom-file-btn" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <label for="avatar_upload" class="form-label">Choose Image</label>
                                                    <input type="file" class="form-control" id="avatar_upload" name="avatar_upload">
                                                </div>

                                                <button type="submit" class="btn btn-sm btn-primary" name="upload_avatar">Upload</button>
                                            </form>
                                            <!-- Form ends here -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="text-center mb-5">
                                <label class="avatar avatar-xxl profile-cover-avatar" for="avatar_upload">
                                    <img class="avatar-img" src="<?php echo $user['AvatarImagePath'] ?? ''; ?>" alt="Profile Image">
                                    <span class="avatar-edit" onclick="openModal()">
                                        <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                    </span>

                                </label>

                                <h2><?php echo $user['FirstName'] . ' ' . $user['LastName']; ?> <i class="fas fa-certificate text-primary small" data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified"></i></h2>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <i class="far fa-building"></i> <span><?php
                                                                                $query = "SELECT name FROM faculties WHERE faculty_id = '{$user['faculty_id']}'";
                                                                                $result_faculty = mysqli_query($conn, $query);

                                                                                // Check if query executed successfully
                                                                                if ($result_faculty) {
                                                                                    // Fetch the faculty name
                                                                                    $faculty_data = mysqli_fetch_assoc($result_faculty);

                                                                                    // Check if faculty name is fetched
                                                                                    if ($faculty_data) {
                                                                                        $faculty_name = $faculty_data['name'];
                                                                                        echo " $faculty_name";
                                                                                    } else {
                                                                                        echo "No faculty found for the given ID.";
                                                                                    }
                                                                                } else {
                                                                                    echo "Error: " . mysqli_error($conn);
                                                                                }

                                                                                ?></span>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-graduation-cap"></i> <?php echo $user['DegreeType']; ?>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="far fa-calendar-alt"></i> <span><?php echo $user['EnrollmentYear']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Profile</span>
                                                <form id="editProfileForm" action="alumni_edit_profile.php" method="post">
                                                    <?php
                                                    // Assuming $id is defined elsewhere in your code
                                                    $id = isset($_POST['profile']) ? $_POST['profile'] : null;
                                                    ?>
                                                    <input type="hidden" name="userID" value="<?php echo htmlspecialchars($id); ?>">
                                                    <button type="submit" class="btn-custom btn-sm btn-white">Edit</button>
                                                </form>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled mb-0">
                                                <li class="py-0">
                                                    <h6>Personal info</h6>
                                                </li>
                                                <li>
                                                    <?php echo 'Name: ' . $user['FirstName'] . ' ' . $user['LastName']; ?>
                                                </li>
                                                <li>
                                                    <?php echo 'Sex: ' . $user['Sex']; ?>
                                                </li>
                                                <li>
                                                    <?php echo 'Faculty: ' .  $faculty_name; ?>
                                                </li>
                                                <li>
                                                    <?php echo 'Program: ' . $user['DegreeType']; ?>
                                                </li>
                                                <li>
                                                    <?php echo 'Enrollment Year: ' . $user['EnrollmentYear']; ?>
                                                </li>
                                                <li>
                                                    <?php
                                                    $batch_id = $user['batch_id'];
                                                    $sql = "SELECT batch_year FROM batch WHERE batch_id = '$batch_id'";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "Class Of: " . $row["batch_year"];
                                                        }
                                                    }
                                                    ?>
                                                </li>
                                                <li>
                                                    <?php echo 'Study State: ' . $user['StuddingState']; ?>
                                                </li>
                                                <li>
                                                    <?php echo 'Employment: ' . $user['empl_state']; ?>
                                                </li>
                                                <li>
                                                    <?php echo 'Address: ' . $user['Address']; ?>
                                                </li>
                                                <?php if (!empty($user['Email']) || !empty($user['Linked']) || !empty($user['Tweet']) || !empty($user['Fid'])) : ?>
                                                    <li class="pt-2 pb-0">
                                                        <h6>Contacts</h6>
                                                    </li>
                                                    <?php if (!empty($user['Email'])) : ?>
                                                        <li>
                                                            <a href="mailto:<?php echo $user['Email']; ?>" target="_blank">
                                                                <i class="fas fa-envelope"></i> <?php echo $user['Email']; ?>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (!empty($user['Linked'])) : ?>
                                                        <?php
                                                        $linkedinLink = $user['Linked'];
                                                        if (!preg_match("~^(?:f|ht)tps?://~i", $linkedinLink)) {
                                                            $linkedinLink = "http://" . $linkedinLink;
                                                        }
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $linkedinLink; ?>" target="_blank">
                                                                <i class="fab fa-linkedin"></i> LinkedIn
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (!empty($user['Tweet'])) : ?>
                                                        <?php
                                                        $twitterLink = $user['Tweet'];
                                                        if (!preg_match("~^(?:f|ht)tps?://~i", $twitterLink)) {
                                                            $twitterLink = "http://" . $twitterLink;
                                                        }
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $twitterLink; ?>" target="_blank">
                                                                <i class="fab fa-twitter"></i> Twitter
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <?php if (!empty($user['Fid'])) : ?>
                                                        <?php
                                                        $facebookLink = $user['Fid'];
                                                        if (!preg_match("~^(?:f|ht)tps?://~i", $facebookLink)) {
                                                            $facebookLink = "http://" . $facebookLink;
                                                        }
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo $facebookLink; ?>" target="_blank">
                                                                <i class="fab fa-facebook"></i> Facebook
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card bg-white">
                                        <div class="card-header">
                                            <h5 class="card-title">Activity of Name</h5>
                                        </div>
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                                <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1" data-bs-toggle="tab">Posts</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2" data-bs-toggle="tab">Jobs</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3" data-bs-toggle="tab">Materials</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="solid-rounded-justified-tab1">
                                                    <?php
                                                    // Fetch all posts
                                                    $sql = "SELECT * FROM blog WHERE alumni_id = $alumni_id";
                                                    $result = $conn->query($sql);

                                                    if ($result && $result->num_rows > 0) {
                                                        while ($post = $result->fetch_assoc()) {
                                                    ?>
                                                            <div class="col-md-6 col-xl-4 col-sm-12 d-flex ">
                                                                <div class="blog grid-blog flex-fill" style="background-color:aliceblue;">
                                                                    <div class="blog-image">
                                                                        <a href="blog-details.html"><img class="img-fluid" src="<?php echo $post['image'] ?? ''; ?>" alt="Post Image" style="max-width: 300px; max-height: 150px; min-width: 300px; min-height: 150px;"></a>
                                                                        <div class="blog-views">
                                                                            <i class="feather-eye me-1"></i> 132
                                                                        </div>
                                                                    </div>
                                                                    <div class="blog-content">
                                                                        <ul class="entry-meta meta-item">
                                                                            <li>
                                                                                <div class="post-author">
                                                                                    <a href="profile.html">
                                                                                        <img src="<?php echo appURL; ?>/assets/img/sawir/two.jpg" alt="Post Author">
                                                                                        <span>
                                                                                            <span class="post-title"><?php echo $post['username'] ?? ''; ?></span>
                                                                                            <span class="post-date"><i class="far fa-clock"></i> <?php echo $post['created_at'] ?? ''; ?></span>
                                                                                        </span>
                                                                                    </a>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <h3 class="blog-title"><a href="blog-details.php?post_id=<?= $post['id'] ?>"><?php echo $post['title'] ?? ''; ?></a></h3>
                                                                        <p><?php echo $post['title'] ?? ''; ?></p>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="edit-options">
                                                                            <div class="edit-delete-btn">
                                                                                <a href="blog-editcode.php?post_id=<?= $post['id'] ?>" class="text-success"><i class="feather-edit-3 me-1"></i> Edit</a>
                                                                                <!-- <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="feather-trash-2 me-1"></i> Delete</a> -->

                                                                            </div>
                                                                            <form method="post" action="delete.php" style="margin-right: 20px; background-color:#ffe5e5;">
                                                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                                                <button type="submit" class="text-danger border-0 rounded" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                                                            </form>
                                                                            <form action="blog-status.php" method="post">
                                                                                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                                                <button type="submit" class="border-0" name="toggle_status">
                                                                                    <?php
                                                                                    $status = isset($post['status']) ? $post['status'] : 'pending';
                                                                                    if ($status == "approved") {
                                                                                        echo '<span class="text-success">Approved</span>';
                                                                                    } else {
                                                                                        echo '<span class="text-warning">Pending</span>';
                                                                                    }
                                                                                    ?>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "No posts found.";
                                                    }

                                                    // Close the database connection
                                                    // $conn->close();
                                                    ?>

                                                </div>

                                                <div class="tab-pane" id="solid-rounded-justified-tab2">
                                                    <?php
                                                    include('../includes/jobs.php');
                                                    // Fetch and display job information
                                                    $sql = "SELECT * FROM jobs WHERE alumni_id = $alumni_id";
                                                    $result = $conn->query($sql);

                                                    if ($result && $result->num_rows > 0) {
                                                        while ($job = $result->fetch_assoc()) {
                                                    ?>
                                                            <div class="single-job-items mb-30" style="background-color:aliceblue; border-radius: 25px; border: 2px solid #38B7FF;">
                                                                <div class="job-items">
                                                                    <div class="company-img " style="display: flex; gap: 10px; ">
                                                                        <a href="#"><img src="<?php echo $job['image'] ?? ''; ?>" alt="company-img" style="max-width: 80px; max-height: 60px; min-width: 80px; min-height: 60px;"></a>
                                                                        <a href="#">
                                                                            <h4><a href="job_view.php?post_id=<?= $job['id'] ?>"><?php echo $job['job_title'] ?? ''; ?></a></h4>
                                                                        </a>
                                                                    </div>
                                                                    <div class="job-tittle job-tittle2">

                                                                        <ul class="pt-3">
                                                                            <li><?php echo $job['company'] ?? ''; ?></li>
                                                                            <li><i class="fas fa-map-marker-alt"></i><?php echo $job['location'] ?? ''; ?></li>
                                                                            <li>$3500 - $4000</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="items-link items-link2 f-right" style="display: flex; gap: 10px; margin-top: 30px;">
                                                                    <div class="edit-delete-btn">
                                                                        <a href="job_editc.php?post_id=<?= $job['id'] ?>" class="text-success"><i class="feather-edit-3 me-1"></i> Edit</a>
                                                                    </div>
                                                                    <form method="post" action="job-delete.php" style="margin-right: 10px;">
                                                                        <input type="hidden" name="post_id" value="<?php echo $job['id']; ?>">
                                                                        <button type="submit" class="text-danger border-1 border-info rounded-pill " style="background-color:#ffe5e5;" onclick="return confirm('Are you sure you want to delete this post?')"><span class="px-4 text-danger">Delete</span></button>
                                                                    </form>
                                                                    <form action="job-status.php" method="post">
                                                                        <input type="hidden" name="post_id" value="<?php echo $job['id']; ?>">
                                                                        <button type="submit" class="border-1 border-info rounded-pill" name="toggle_status">
                                                                            <?php
                                                                            $status = isset($job['status']) ? $job['status'] : 'pending';
                                                                            if ($status == "approved") {
                                                                                echo '<span class="text-success px-3" >Approved</span>';
                                                                            } else {
                                                                                echo '<span class="text-warning pr-3 pl-3 ">Pending</span>';
                                                                            }
                                                                            ?>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                    <?php
                                                        }
                                                    } else {
                                                        echo "No jobs found.";
                                                    }
                                                    ?>
                                                </div>

                                                <div class="tab-pane" id="solid-rounded-justified-tab3">
                                                    <?php
                                                    // Fetch and display materials
                                                    $sql = "SELECT * FROM materials WHERE alumni_id = $alumni_id";
                                                    $result = $conn->query($sql);

                                                    if ($result && $result->num_rows > 0) {
                                                        while ($material = $result->fetch_assoc()) {
                                                    ?>
                                                            <div class="row">

                                                                <div class="card card-table  col-sm-12">
                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-center table-hover datatable">
                                                                                <thead class="thead-light">
                                                                                    <tr>
                                                                                        <th>Material ID</th>
                                                                                        <th>User Upload</th>
                                                                                        <th>Number Download</th>
                                                                                        <th>date</th>
                                                                                        <th> </th>
                                                                                        <th class="text-end">Action</th>
                                                                                    </tr>
                                                                                </thead>

                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><a href="javascript:void(0);">#<?php echo $material['id'] ?? ''; ?></a></td>
                                                                                        <td><?php echo $material['title'] ?? ''; ?></td>
                                                                                        <td><?php echo $material['number_of_downloads'] ?? ''; ?></td>
                                                                                        <td><?php echo $material['created_at'] ?? ''; ?></td>

                                                                                        <td>
                                                                                            <a class="border-1 border-info" style="font-size: smaller; fon background-color: #fff78; margin-right: 2px;" href="download.php?id=<?= $material['id'] ?>" onclick="console.log('Clicked download with post_id <?= $post['id'] ?>')">
                                                                                                <i style="color: black;" class="fas fa-download me-1"></i> <span style="color: black;">Download</span>
                                                                                            </a>

                                                                                            <!-- <a class="btn btn-sm btn-white" href="view-invoice.html">
                                                        <i class="far fa-eye me-1"></i> View
                                                    </a> -->
                                                                                        </td>
                                                                                        <td class="text-end">
                                                                                            <div class="dropdown dropdown-action">
                                                                                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                                                    <a class="dropdown-item" href="material-edit.php?post_id=<?= $post['id'] ?>"><i class="far fa-edit me-2"></i>Edit</a>
                                                                                                    <!-- <a class="dropdown-item" href="#"><i class="far fa-eye me-2"></i>Edit</a> -->
                                                                                                    <form method="post" action="material-delete.php" style="margin-left: 3px;">
                                                                                                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                                                                                        <button type="submit" class="text-danger border-0 bg-white " onclick="return confirm('Are you sure you want to delete this post?')"><Span class="px-1 text-danger"><i class="far fa-trash-alt me-2"></i>Delete</Span></button>
                                                                                                    </form>

                                                                                                </div>
                                                                                            </div>
                                                                                        </td>

                                                                                    </tr>

                                                                                </tbody>

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </div>
                                        <?php
                                                        }
                                                    } else {
                                                        echo "No materials found.";
                                                    }
                                        ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </div>
<?php
                }
            } else {
                // Handle error if query fails
                echo "Error: " . mysqli_error($conn);
            }
        }
?>

</div>
</div>

<script>
    feather.replace();

    function openModal() {
        $('#bs-example-modal-lg').modal('show');
    }

    function submitForm() {
        // Add any additional logic for form submission if needed
        document.getElementById("avatarForm").submit();
    }
</script>

<script data-cfasync="false" src="../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="<?php echo appURL; ?>/assets/js/jquery-3.6.0.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/feather.min.js"></script>

<script src="<?php echo appURL; ?>/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo appURL; ?>/assets/js/script.js"></script>
<?php
include('../includes/footer.php');
?>