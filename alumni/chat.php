<?php
session_start();
include('../includes/header_alumni.php');
include('../includes/alumni_navbar.php');
include('../includes/conn.php');

// Retrieve alumni information and set session
if (isset($_POST['edit_user'])) {
    $alumni_id = $_POST['edit_user'];
    $query = "SELECT Id, FirstName, LastName FROM alumni WHERE Id = $alumni_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['alumni_name'] = $row['FirstName'] . " " . $row['LastName'];
        $_SESSION['to'] = $row['Id'];
    }
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

    mysqli_stmt_bind_param(
        $stmt,
        "iis",
        $sender_id,
        $receiver_id,
        $chat_message
    );
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Message inserted successfully
        // header("Location: chat.php");
        $_SESSION['guul'] = "success"; // Set session variable for success
        $_SESSION['message'] = "Data saved successfully"; // Set success message
    } else {
        // Error saving data
        $_SESSION['guul'] = "fail"; // Set session variable for error
        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
    }
}
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
                                $query = "SELECT m.Message, CONCAT(a.FirstName, ' ', a.LastName) AS SenderName, a.Id,
                                            (SELECT COUNT(*) FROM Chat WHERE ReceiverId = ? AND SenderId = a.Id AND is_read = 0) AS unread_count
                                            FROM Chat m
                                            INNER JOIN Alumni a ON (m.SenderId = a.Id OR m.ReceiverId = a.Id)
                                            WHERE m.ReceiverId = ? OR m.SenderId = ?
                                            GROUP BY a.Id
                                            ORDER BY unread_count DESC, m.Timestamp DESC";
                                $stmt = mysqli_prepare($conn, $query);
                                $current_user_id = $_SESSION['id'];
                                mysqli_stmt_bind_param($stmt, "iii", $current_user_id, $current_user_id, $current_user_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $last_chat_message = $row['Message'];
                                        $last_chat_sender = $row['SenderName'];
                                        $userId = $row['Id'];
                                        $unread_count = $row['unread_count'];

                                        // Get timestamp of last message
                                        $last_message_query = "SELECT Timestamp
                                                              FROM Chat
                                                              WHERE (SenderId = ? AND ReceiverId = ?) OR (SenderId = ? AND ReceiverId = ?)
                                                              ORDER BY Timestamp DESC
                                                              LIMIT 1";
                                        $last_message_stmt = mysqli_prepare($conn, $last_message_query);
                                        mysqli_stmt_bind_param($last_message_stmt, "iiii", $current_user_id, $userId, $userId, $current_user_id);
                                        mysqli_stmt_execute($last_message_stmt);
                                        $last_message_result = mysqli_stmt_get_result($last_message_stmt);
                                        $last_message_row = mysqli_fetch_assoc($last_message_result);
                                        $last_message_timestamp = strtotime($last_message_row['Timestamp']);
                                        $current_timestamp = time();
                                        $time_difference = $current_timestamp - $last_message_timestamp;
                                        $time_ago = gmdate("i", $time_difference); // Display time in minutes ago

                                ?>
                                        <a href="javascript:void(0);" class="media read-chat active d-flex" data-user-id="<?php echo $userId; ?>">
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
                                                    <div class="last-chat-time block"><?php echo $time_ago; ?> min</div>
                                                    <div class="badge badge-success badge-pill"><?php echo $unread_count; ?></div>
                                                </div>
                                            </div>
                                        </a>
                                <?php
                                    }
                                } else {
                                    echo "<div class='chat-scroll'>No previous chats found.</div>";
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
                                        <?php echo $_SESSION['alumni_name']; ?>
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
                                    <?php
                                    if (isset($_SESSION['to'])) {
                                        $query = "SELECT m.Message, m.SenderId, m.Timestamp, CONCAT(a.FirstName, ' ', a.LastName) AS SenderName
                                                    FROM Chat m
                                                    INNER JOIN Alumni a ON m.SenderId = a.Id
                                                    WHERE (m.ReceiverId = ? AND m.SenderId = ?) OR (m.ReceiverId = ? AND m.SenderId = ?)
                                                    ORDER BY m.Timestamp desc";
                                        $stmt = mysqli_prepare($conn, $query);
                                        $current_user_id = $_SESSION['id'];
                                        $receiver_id = $_SESSION['to'];
                                        mysqli_stmt_bind_param($stmt, "iiii", $current_user_id, $receiver_id, $receiver_id, $current_user_id);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $message = $row['Message'];
                                                $sender_name = $row['SenderName'];
                                                $sender_id = $row['SenderId'];
                                                $timestamp = strtotime($row['Timestamp']); // Convert timestamp to Unix timestamp
                                                $formatted_time = date('Y-m-d H:i', $timestamp); // Format the timestamp
                                                $message_class = ($sender_id == $current_user_id) ? 'sent' : 'received';
                                    ?>
                                                <li class="media <?php echo $message_class; ?>">
                                                    <?php if ($message_class == 'received') { ?>
                                                        <div class="avatar">
                                                            <img src="../assets/img/profiles/avatar-02.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                        </div>
                                                    <?php } ?>
                                                    <div class="media-body">
                                                        <div class="msg-box">
                                                            <div>
                                                                <p><?php echo $message; ?></p>
                                                                <ul class="chat-msg-info">
                                                                    <li>
                                                                        <div class="chat-time">
                                                                            <span><?php echo $formatted_time; ?></span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                    <?php
                                            }
                                        }
                                    } else {
                                        echo "<li>Please start or select a chat.</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="chat-footer">
                            <div class="input-group">
                                <form method="post" action="chat.php" class="input-group">
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

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/js/script.js"></script>
<script>
    $(document).ready(function() {
        // Function to update chat-body content
        function updateChatBody(userId) {
            $.ajax({
                url: 'fetch_messages.php',
                method: 'POST',
                data: {
                    userId: userId
                },
                success: function(messages) {
                    $('.chat-body').html(messages);
                }
            });
        }

        // Function to update user name and unread status
        function updateUserDetails(userId) {
            $.ajax({
                url: 'get_alumni_name.php',
                method: 'POST',
                data: {
                    userId: userId
                },
                success: function(name) {
                    $('.chat-cont-right .media-body .user-name').text(name);
                }
            });

            // Update unread status to read
            $.ajax({
                url: 'update_unread_status.php',
                method: 'POST',
                data: {
                    userId: userId
                },
                success: function(response) {
                    // Update the unread count to zero
                    $('.chat-users-list .media[data-user-id="' + userId + '"] .badge').text('0');
                }
            });
        }

        // Event listener for clicking on a user in the user list
        $(document).on('click', '.chat-users-list .media', function() {
            var userId = $(this).data('user-id');
            $.ajax({
                url: 'update_session.php',
                method: 'POST',
                data: {
                    userId: userId
                },
                success: function(response) {
                    updateChatBody(userId);
                    updateUserDetails(userId);
                }
            });
        });
    });
</script>
<script src="../assets/js/select2.min.js"></script>
</body>

</html>