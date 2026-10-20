<?php
include_once("conn.php");

if (isset($_POST['submit']) && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $l_mode = $_POST['l_mode'];

    if ($conn) {
        $sql_update = "UPDATE user_info SET name=?, email=?, phone=?, address=?, gender=?, course=?, l_mode=? WHERE id=?";
        $stmt_update = $conn->prepare($sql_update);
        if ($stmt_update) {
            $stmt_update->bind_param("sssssssi", $name, $email, $phone, $address, $gender, $course, $l_mode, $edit_id);
            if ($stmt_update->execute()) {
                header("Location: user.php"); // Redirect back to user.php
                exit();
            }else {
                echo "Error updating record: " . $stmt_update->error;
            }
            $stmt_update->close();
        } else {
            echo "Error preparing update query: " . $conn->error;
        }
    } else {
        echo "Database connection error.";
    }
} else {
    echo "Invalid request.";
}
?>

