<?php
include_once("conn.php");

if ($conn) {
    $sql_select = "SELECT * FROM user_info";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-hover" style="background-color: #ffffff;">';
        echo '<thead class="table-primary">';
        echo '<tr>';
        echo '<th>Sr.No</th>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Phone</th>';
        echo '<th>Address</th>';
        echo '<th>Gender</th>';
        echo '<th>Course</th>';
        echo '<th>Learning Mode</th>';
        echo '<th>Actions</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $serialNumber = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $serialNumber++ . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['course'] . "</td>";
            echo "<td>" . $row['l_mode'] . "</td>";
            echo "<td>
                    <button class='btn btn-warning btn-sm btn-edit' onclick='editRecord(" . $row['id'] . ", \"" . htmlspecialchars($row['name']) . "\", \"" . $row['email'] . "\", \"" . $row['phone'] . "\", \"" . htmlspecialchars($row['address']) . "\", \"" . $row['gender'] . "\", \"" . $row['course'] . "\", \"" . $row['l_mode'] . "\")'>Edit</button>
                    <form method='post' action='delete.php' class='d-inline'>
                        <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<div class="alert alert-info">No records found.</div>';
    }
    $conn->close();
} else {
    echo '<div class="alert alert-danger">Failed to connect to the database.</div>';
}
?>
<script>
    // This function needs to be in the main page (user.php)
    function editRecord(id, name, email, phone, address, gender, course, l_mode) {
        document.getElementById('edit_id').value = id;
        document.getElementById('name').value = name;
        document.getElementById('email').value = email;
        document.getElementById('phone').value = phone;
        document.getElementById('address').value = address;
        document.getElementById('gender').value = gender;
        document.getElementById('course').value = course;
        document.getElementById('l_mode').value = l_mode;

        // Set the selected options in the dropdowns
        document.getElementById('gender').value = gender;
        document.getElementById('course').value = course;
        document.getElementById('l_mode').value = l_mode;

        // Change the submit button text to "Update"
        document.querySelector('button[type="submit"][name="submit"]').textContent = 'Update';
    }
</script>


