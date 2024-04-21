<?php
session_start();
include('../includes/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded
    if (isset($_FILES["csvFile"]) && $_FILES["csvFile"]["error"] == UPLOAD_ERR_OK) {
        // Get the uploaded file
        $file = $_FILES["csvFile"]["tmp_name"];
        // Open the file for reading
        if (($handle = fopen($file, "r")) !== FALSE) {
            // Loop through each row in the CSV file
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Extract data from the row
                $student_id = $data[0];
                $firstName = $data[1];
                $lastName = $data[2];
                $sex = $data[3];
                $email = $data[4];
                $img = $data[5];
                $dob = $data[6];
                $contactNumber = $data[7];
                $address = $data[8];
                $empl_state = $data[9];
                $studdingState = $data[10];
                $faculty_id = $data[11];
                $degreeType = $data[12];
                $enrollmentYear = $data[13];
                $batch_id = $data[14];
                $fid = $data[15];
                $linked = $data[16];
                $tweet = $data[17];
                $username = $data[18];
                $password = $data[19];
                $created_at = $data[20];
                $updated_at = $data[21];
                $created_by = $data[22];
                $updated_by = $data[23];

                // Perform database insertion
                $query = "INSERT INTO alumni (student_id, FirstName, LastName, Sex, Email, Img, Dob, ContactNumber, Address, empl_state, StuddingState, faculty_id, DegreeType, EnrollmentYear, batch_id, Fid, Linked, Tweet, Username, Password, Created_at, Updated_at, Created_by, Updated_by) 
                          VALUES ('$student_id', '$firstName', '$lastName', '$sex', '$email', '$img', '$dob', '$contactNumber', '$address', '$empl_state', '$studdingState', '$faculty_id', '$degreeType', '$enrollmentYear', '$batch_id', '$fid', '$linked', '$tweet', '$username', '$password', '$created_at', '$updated_at', '$created_by', '$updated_by')";
                $result = mysqli_query($conn, $query);

                // Check if insertion was successful
                if (!$result) {
                    echo "Error inserting data: " . mysqli_error($conn);
                    exit();
                }
            }
            fclose($handle);
            echo "Data imported successfully";
        } else {
            echo "Error opening file";
        }
    } else {
        echo "No file uploaded or an error occurred";
    }
} else {
    echo "Invalid request method";
}

