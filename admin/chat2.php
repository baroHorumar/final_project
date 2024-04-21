<?php
session_start();
include('../includes/header.php');
include('../includes/sidebar.php');
include('../includes/conn.php');


// Assuming your database connection is established here
if (isset($_POST['edit_user'])) {
    $alumni_id = $_POST['edit_user'];

    // Fetch the alumni's name from the database based on the ID
    $query = "SELECT Id, FirstName, LastName FROM alumni WHERE Id = $alumni_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $alumni_name = $row['FirstName'] . " " . $row['LastName']; // Concatenating first name and last name with a space
        $_SESSION['to'] = $row['Id'];
    } else {
        // Handle error if the query fails
        $alumni_name = "Unknown";
    }
} else {
    $alumni_name = "Unknown";
}

if (isset($_POST['chat_button'])) {
    // Get data from the form
    $chat_message = $_POST['chat'];
    // Insert the chat message into the database
    $query = "INSERT INTO chat (SenderId, ReceiverId, Message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Sanitize sender and receiver IDs
    $sender_id = $_SESSION["id"];
    $receiver_id = $_SESSION['to'];

    mysqli_stmt_bind_param($stmt, "iis", $sender_id, $receiver_id, $chat_message);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Message inserted successfully
        echo "Chat message sent successfully.";
    } else {
        // Error handling
        echo "Error: " . mysqli_error($conn);
    }
}
// Assuming your database connection is established here

// Fetch the last chat message for the current user



?>


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="chat-window">
                    <div class="chat-cont-left">
                        <div class="chat-header">
                            <span>Chats</span>
                            <a href="javascript:void(0)" class="chat-compose">
                                <i class="material-icons">control_point</i>
                            </a>
                        </div>
                        <form class="chat-search">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i class="fas fa-search"></i>
                                </div>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                        </form>

                        <div class="chat-users-list">
                            <div class="chat-scroll">
                                <?php
                                $query = "SELECT m.Message, CONCAT(a.FirstName, ' ', a.LastName) AS SenderName
                  FROM Chat m
                  INNER JOIN Alumni a ON m.SenderId = a.Id
                  WHERE m.ReceiverId = ? OR m.SenderId = ?
                  ORDER BY m.Timestamp DESC
                  LIMIT 1";
                                $stmt = mysqli_prepare($conn, $query);
                                $current_user_id = $_SESSION['id'];
                                mysqli_stmt_bind_param($stmt, "ii", $current_user_id, $current_user_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    $last_chat_message = $row['Message'];
                                    $last_chat_sender = $row['SenderName'];
                                    // Output the last chat message and sender
                                ?>
                                    <a href="javascript:void(0);" class="media read-chat active d-flex">
                                        <div class="media-img-wrap">
                                            <div class="avatar avatar-away">
                                                <img src="../assets/img/profiles/avatar-03.jpg" alt="User Image" class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div>
                                                <div class="user-name"><?php echo $last_chat_sender; ?></div>
                                                <div class="user-last-chat"><?php echo $last_chat_message; ?></div>
                                            </div>
                                            <div>
                                                <div class="last-chat-time block">2 min</div>
                                                <div class="badge badge-success badge-pill">15</div>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                } else {
                                    // No previous chat found
                                    echo "No previous chat found.";
                                }
                                ?>
                            </div>
                        </div>


                    </div>
                    <div class="chat-cont-right">
                        <div class="chat-header">
                            <a id="back_user_list" href="javascript:void(0)" class="back-user-list">
                                <i class="material-icons">chevron_left</i>
                            </a>
                            <div class="media d-flex">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-online">
                                        <img src="../assets/img/profiles/avatar-02.jpg" alt="User Image" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="user-name">
                                        <?php
                                        echo $alumni_name;
                                        ?>
                                    </div>
                                    <div class="user-status">online</div>
                                </div>
                            </div>
                            <div class="chat-options">
                                <a href="javascript:void(0)">
                                    <i class="material-icons">local_phone</i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="material-icons">videocam</i>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="material-icons">more_vert</i>
                                </a>
                            </div>
                        </div>
                        <div class="chat-body">
                            <div class="chat-scroll">
                                <ul class="list-unstyled">
                                    <li class="media sent">
                                        <div class="media-body">
                                            <div class="msg-box">
                                                <div>
                                                    <p>Hello. What can I do for you?</p>
                                                    <ul class="chat-msg-info">
                                                        <li>
                                                            <div class="chat-time">
                                                                <span>8:30 AM</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media d-flex received">
                                        <div class="avatar">
                                            <img src="../assets/img/profiles/avatar-02.jpg" alt="User Image" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="media-body">
                                            <div class="msg-box">
                                                <div>
                                                    <p>You wait for notice.</p>
                                                    <p>Consectetuorem ipsum dolor sit?</p>
                                                    <p>Ok?</p>
                                                    <ul class="chat-msg-info">
                                                        <li>
                                                            <div class="chat-time">
                                                                <span>8:55 PM</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="chat-date">Today</li>
                                </ul>
                            </div>
                        </div>
                        <div class="chat-footer">
                            <div class="input-group">
                                <form method="post" action="chat2.php" class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="btn-file btn">
                                            <i class="fas fa-paperclip"></i>
                                            <input type="file">
                                        </div>
                                    </div>
                                    <input type="text" class="input-msg-send form-control" name="chat" placeholder="Type something">
                                    <div class="input-group-append">
                                        <button type="submit" name="chat_button" class="btn msg-send-btn"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</div>


<script src="../assets/js/jquery-3.6.0.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/js/feather.min.js"></script>

<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="../assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

</body>

</html>