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
        <div class="header header-one">
            <div class="header-left header-left-one">
                <a href="index.html" class="logo">
                    <img src="<?php echo appURL; ?>/assets/img/eelo.png" alt="Logo">
                </a>
                <a href="index.html" class="white-logo">
                    <img src="assets/img/logo-white.png" alt="Logo">
                </a>
                <a href="index.html" class="logo logo-small">
                    <img src="<?php echo appURL; ?>/assets/img/eelo.png" alt="Logo" width="30" height="30">
                </a>
            </div>
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>
            <ul class="nav nav-tabs user-menu">
                <li class="nav-item dropdown has-arrow flag-nav">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                        <img src="<?php echo appURL; ?>/assets/img/flags/us.png" alt="" height="20"> <span>English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="<?php echo appURL; ?>/assets/img/flags/us.png" alt="" height="16"> English
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="<?php echo appURL; ?>/assets/img/flags/fr.png" alt="" height="16"> French
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="<?php echo appURL; ?>/assets/img/flags/es.png" alt="" height="16"> Spanish
                        </a>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="<?php echo appURL; ?>/assets/img/flags/de.png" alt="" height="16"> German
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i data-feather="bell"></i> <span class="badge rounded-pill">5</span>
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"> Clear All</a>
                        </div>
                        <div class="noti-content">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="" src="<?php echo appURL; ?>/assets/img/eelo.png">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Brian Johnson</span>
                                                    paid the invoice <span class="noti-title">#DF65485</span></p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="" src="<?php echo appURL; ?>/assets/img/profiles/avatar-03.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Marie Canales</span>
                                                    has accepted your estimate <span class="noti-title">#GTR458789</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <div class="avatar avatar-sm">
                                                <span class="avatar-title rounded-circle bg-primary-light"><i class="far fa-user"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">New user
                                                        registered</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <span class="avatar avatar-sm">
                                                <img class="avatar-img rounded-circle" alt="" src="<?php echo appURL; ?>/assets/img/profiles/avatar-04.jpg">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Barbara Moore</span>
                                                    declined the invoice <span class="noti-title">#RDW026896</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media d-flex">
                                            <div class="avatar avatar-sm">
                                                <span class="avatar-title rounded-circle bg-info-light"><i class="far fa-comment"></i></span>
                                            </div>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">You have received a new
                                                        message</span></p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img src="<?php echo appURL; ?>/assets/img/sawir/one.jpg" alt="">
                            <span class="status online"></span>
                        </span>
                        <span>Admin</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="profile.php"><i data-feather="user" class="me-1"></i>
                            Profile</a>
                        <a class="dropdown-item" href="settings.html"><i data-feather="settings" class="me-1"></i>
                            Settings</a>
                        <a class="dropdown-item" href="login.html"><i data-feather="log-out" class="me-1"></i>
                            Logout</a>
                    </div>
                </li>
            </ul>
        </div>