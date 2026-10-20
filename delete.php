<?php
include_once("conn.php");

if (isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']); // Sanitize delete ID

    if ($conn) {
        $sql_delete = "DELETE FROM user_info WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);

        if ($stmt_delete) {
            $stmt_delete->bind_param("i", $delete_id);
            if ($stmt_delete->execute()) {
                header("Location: user.php"); // Redirect back to user.php
                exit();
            }else {
                echo "Error deleting record: " . $stmt_delete->error;
            }
            $stmt_delete->close();
        } else {
            echo "Error preparing delete query: " . $conn->error;
        }
    } else {
        echo "Database connection error.";
    }
} else {
    echo "Invalid request.";
}
?>
