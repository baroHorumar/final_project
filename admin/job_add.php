<?php
include('../includes/header.php');
include('../includes/sidebar.php');
// include('job_code.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .job-container {
            max-width: 600px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">

                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Add Job</h3>
                            </div>
                        </div>
                    </div>

                    <form action="job_codec.php" method="post">
                        <input type="hidden" name="alumni_id" value="<?= $alumni_id ?>">
                        <div class="form-group">
                            <label for="logo">image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <label for="job_title">Job Title :</label>
                        <input type="text" id="job_title" name="job_title" required>

                        <label for="company">Company:</label>
                        <input type="text" id="company" name="company" required>


                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" required>
                        <!-- <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div> -->

                        <label for="description">Job Description :</label>
                        <textarea id="description" name="description" rows="4" required></textarea>

                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required>

                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required>

                        <label for="apply_link">Apply Link:</label>
                        <input type="url" id="apply_link" name="apply_link" placeholder="https://example.com/apply">


                        <input type="submit" value="Post Job">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>


<?php
include('../includes/footer.php');
?>