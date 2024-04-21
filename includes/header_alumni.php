<?php
define("appURL", "http://localhost/final/")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>EU - Alumni</title>
    <link rel="shortcut icon" href="<?php echo appURL; ?>/assets/img/eelo.png">
    <link rel="stylesheet" href="<?php echo appURL; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo appURL; ?>/assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?php echo appURL; ?>/assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo appURL; ?>/assets/css/style.css">

    <style>
        @media print {
            .print-button {
                display: none;
            }
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .report-subtitle {
            font-size: 20px;
            margin-top: 5px;
        }

        address {
            margin-top: 20px;
        }

        address p {
            margin: 5px 0;
        }

        @media print {
            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .header-hidden {
                display: none;
            }

            .report-title {
                font-size: 36px;
                /* Increased font size */
                font-weight: bold;
                margin-bottom: 10px;
                /* Adjusted margin */
            }

            .report-subtitle {
                font-size: 30px;
                /* Increased font size */
                margin-top: 10px;
                /* Adjusted margin */
            }

            address {
                margin-top: 20px;
            }

            address p {
                margin: 10px 0;
                /* Adjusted margin */
            }
        }

        @media print {
            .header.header-one {
                display: none;
            }
        }
    </style>

    <script>
        // Function to toggle header visibility
        function toggleHeaderVisibility() {
            var header = document.querySelector('.header');
            header.classList.toggle('header-hidden');
        }

        // Event listener to trigger header visibility toggle when printing
        window.onbeforeprint = function() {
            toggleHeaderVisibility();
        }

        // Event listener to restore header visibility after printing
        window.onafterprint = function() {
            toggleHeaderVisibility();
        }
    </script>
</head>

<body class="nk-body bg-lighter npc-default has-sidebar no-touch nk-nio-theme">
    <div class="main-wrapper">