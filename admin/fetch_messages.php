<?php
session_start();
include('../includes/conn.php');

if (isset($_SESSION['id']) && isset($_SESSION['to'])) {
    $current_user_id = $_SESSION['id'];
    $receiver_id = $_SESSION['to'];

    // Fetch messages between the current user and the selected user
    $query = "SELECT m.Message, m.SenderId,  m.Timestamp, CONCAT(a.FirstName, ' ', a.LastName) AS SenderName
              FROM Chat m
              INNER JOIN Alumni a ON m.SenderId = a.Id
              WHERE (m.ReceiverId = ? AND m.SenderId = ?) OR (m.ReceiverId = ? AND m.SenderId = ?)
              ORDER BY m.Timestamp Desc";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iiii", $current_user_id, $receiver_id, $receiver_id, $current_user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are any messages
    if (mysqli_num_rows($result) > 0) {
        // Loop through each message and construct HTML
        while ($row = mysqli_fetch_assoc($result)) {
            $message = htmlspecialchars($row['Message']);
            $sender_name = $row['SenderName'];
            $sender_id = $row['SenderId'];
            $Timestamp = $row['Timestamp'];

            // Determine the message alignment based on the sender
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
                                        <span><?php echo $Timestamp; ?></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
<?php
        }
    } else {
        // No messages found
        echo "<li>No messages found.</li>";
    }
} else {
    // Session variables not set
    echo "<li>No messages found.</li>";
}
?>