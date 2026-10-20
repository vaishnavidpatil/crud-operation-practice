<?php
session_start(); // Make sure to start the session at the beginning of the file
include_once("conn.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $l_mode = $_POST['l_mode'];

    if ($conn) {
        $sql_insert = "INSERT INTO user_info (name, email, phone, address, gender, course, l_mode) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        if ($stmt_insert) {
            $stmt_insert->bind_param("sssssss", $name, $email, $phone, $address, $gender, $course, $l_mode);
            if ($stmt_insert->execute()) {
                $_SESSION['message'] = '<div class="alert alert-success mt-3" role="alert">Record added successfully!</div>';
            } else {
                $_SESSION['message'] = '<div class="alert alert-danger mt-3" role="alert">Error adding record: ' . $stmt_insert->error . '</div>';
            }
            $stmt_insert->close();
        } else {
            $_SESSION['message'] = '<div class="alert alert-danger mt-3" role="alert">Error preparing insert query: ' . $conn->error . '</div>';
        }
    } else {
        $_SESSION['message'] = '<div class="alert alert-danger mt-3" role="alert">Database connection error.</div>';
    }
    header("Location: user.php"); // Redirect back to user.php
    exit();
} else {
    echo "Invalid request.";
}
?>