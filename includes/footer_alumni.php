<?php
// Check if session variable is set and display SweetAlert accordingly
if (isset($_SESSION['guul'])) {
    $icon = "";
    $message = "";
    switch ($_SESSION['guul']) {
        case "success":
            $icon = "success";
            $message =   $_SESSION['info'];
            break;
        case "fail":
            $icon = "error";
            $message = $_SESSION['info'];
            break;
        default:
            break;
    }
    // Output SweetAlert script
    echo '<script src="../assets/js/sweetalert2@11.js"></script>';
    echo '<script>
        // Trigger SweetAlert
        Swal.fire({
          
            text: "' . $message . '",
            icon: "' . $icon . '",
            confirmButtonText: "OK"
        });
    </script>';

    // Unset session variable to prevent showing the SweetAlert again on page refresh
    unset($_SESSION['guul']);
}
?>

</body>

</html>