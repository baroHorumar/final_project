<?php
session_start();
// include('../includes/header_forum.php');
include('../includes/sidebar.php');
include('../includes/header.php');
include('../includes/conn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if forum_id is set in the POST data
    if (isset($_POST['forum_id'])) {
        // Retrieve the forum ID from the POST data
        $_SESSION['forumId'] = $_POST['forum_id'];
    }

    // Process chat message submission
    if (isset($_POST['chat_button'])) {
        // Check if chat message is not empty
        if (!empty($_POST['chat'])) {
            $chat_message = $_POST['chat'];
            $sender_id = $_SESSION["id"];

            // Retrieve the forum ID from the session
            if (isset($_SESSION['forumId'])) {
                $forumId = $_SESSION['forumId'];

                // Prepare SQL query to insert chat message
                $query = "INSERT INTO discussion_forum_messages (forum_id, user_id, message, timestamp) VALUES (?, ?, ?, current_timestamp())";
                $stmt = mysqli_prepare($conn, $query);

                if ($stmt) {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmt, "iis", $forumId, $sender_id, $chat_message);

                    // Execute the statement
                    $success = mysqli_stmt_execute($stmt);

                    if ($success) {
                        $_SESSION['guul'] = "success"; // Set session variable for success
                        $_SESSION['message'] = "Data saved successfully"; // Set success message
                    } else {
                        // Error saving data
                        $_SESSION['guul'] = "fail"; // Set session variable for error
                        $_SESSION['message'] = "Error: " . mysqli_error($conn); // Set error message
                    }
                    // Close the statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Error: Forum ID is not set in the session.";
            }
        } else {
            echo "Error: Chat message cannot be empty.";
        }
    }
}

// Fetch chat users list (You may want to move this logic above if needed)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if forum_id is set in the POST data
    if (isset($_POST['forum_id'])) {
        // Retrieve the forum ID from the POST data
        $current_forum_id = $_POST['forum_id'];
        $_SESSION['forumId'] = $current_forum_id;

        // Prepare and execute the SQL query
        $query = "SELECT m.message AS Message, CONCAT(a.FirstName, ' ', a.LastName) AS SenderName, a.Id,
          (SELECT COUNT(*) FROM discussion_forum_messages WHERE forum_id = ? AND user_id = a.Id) AS unread_count
          FROM discussion_forum_messages m
          INNER JOIN Alumni a ON m.user_id = a.Id
          WHERE m.forum_id = ?
          GROUP BY a.Id
          ORDER BY unread_count DESC, m.timestamp DESC";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ii", $current_forum_id, $current_forum_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        // Now you can use $result to fetch the data as needed
    }
}

// Fetch forum name
if (isset($_SESSION['forumId'])) {
    $forumId = $_SESSION['forumId'];
    $query_forum = "SELECT title FROM discussion_forum WHERE id = ?";
    $stmt_forum = mysqli_prepare($conn, $query_forum);
    mysqli_stmt_bind_param($stmt_forum, "i", $forumId);
    mysqli_stmt_execute($stmt_forum);
    $result_forum = mysqli_stmt_get_result($stmt_forum);
    $row_forum = mysqli_fetch_assoc($result_forum);
    $forum_name = $row_forum['title'];
}

// Fetch all messages for the forum
if (isset($_SESSION['forumId'])) {
    $forumId = $_SESSION['forumId'];
    $query_messages = "SELECT m.message AS Message, CONCAT(a.FirstName, ' ', a.LastName) AS SenderName, m.timestamp, m.user_id
                       FROM discussion_forum_messages m
                       INNER JOIN Alumni a ON m.user_id = a.Id
                       WHERE m.forum_id = ?
                       ORDER BY m.timestamp ASC";
    $stmt_messages = mysqli_prepare($conn, $query_messages);
    mysqli_stmt_bind_param($stmt_messages, "i", $forumId);
    mysqli_stmt_execute($stmt_messages);
    $result_messages = mysqli_stmt_get_result($stmt_messages);
}

?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Chat window and its contents -->
        <div class="row">
            <div class="col-sm-12">
                <div class="chat-window">
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
                                        <?php echo $forum_name; ?>
                                    </div>
                                    <!-- <div class="user-status">online</div> -->
                                </div>
                            </div>
                        </div>
                        <div class="chat-body">
                            <div class="chat-scroll">
                                <ul class="list-unstyled">
                                    <!-- Display chat messages -->
                                    <?php
                                    if (isset($result_messages)) {
                                        while ($row = mysqli_fetch_assoc($result_messages)) {
                                            $message = $row['Message'];
                                            $timestamp = $row['timestamp'];
                                            $sender_name = $row['SenderName'];
                                            // Format timestamp
                                            $formatted_time = date("h:i A", strtotime($timestamp));
                                            // Check if message is sent by the current user
                                            $sender_id = $row['user_id'];
                                            $is_current_user = ($sender_id == $_SESSION['id']);
                                            // Define CSS class based on sender
                                            $message_class = $is_current_user ? 'sent' : 'received';
                                    ?>
                                            <li class="media <?php echo $message_class; ?>">
                                                <?php if (!$is_current_user) { ?>
                                                    <div class="media-img-wrap d-flex align-items-center avatar">
                                                        <img src="../assets/img/profiles/avatar-02.jpg" alt="User Image" class="avatar-img rounded-circle">
                                                        <div class="avatar avatar-online d-flex align-items-center">
                                                            <p class="sender-name mb-0 ml-2"><?php echo strtok($sender_name, ' '); ?></p>
                                                        </div>
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
                                                <?php if ($is_current_user) { ?>

                                                <?php } ?>
                                            </li>
                                    <?php
                                        }
                                    } else {
                                        echo "<li>No messages found for this forum.</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="chat-footer">
                            <!-- Chat message input form -->
                            <form method="post" action="forum_chat.php" class="input-group">
                                <div class="input-group-prepend">
                                    <div class="btn-file btn">
                                        <i class="fas fa-paperclip"></i>
                                        <input type="file">
                                    </div>
                                </div>
                                <input type="text" class="input-msg-send form-control" name="chat" placeholder="Type something">
                                <!-- Add hidden input for forum_id -->
                                <input type="hidden" name="forum_id" value="<?php echo isset($_SESSION['forumId']) ? $_SESSION['forumId'] : ''; ?>">
                                <div class="input-group-append">
                                    <input type="hidden" name="create-chat" value="forum_id">
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

<!-- JavaScript includes and scripts -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/feather.min.js"></script>
<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/js/script.js"></script>
<script src="../assets/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // JavaScript code for chat functionality
    });
</script>
<?php
include('../includes/footer.php');
?>