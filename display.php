<?php
include_once("conn.php");

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$stmt = null;

if ($search !== '') {
    $sql_select = "SELECT * FROM user_info
                   WHERE name LIKE ? OR email LIKE ?";

    $stmt = $conn->prepare($sql_select);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql_select = "SELECT * FROM user_info";
    $result = $conn->query($sql_select);
}
?>
<link rel="stylesheet" href="display.css">
<div class="records-container">

    <div class="records-heading">
        <div>
            <h3>Student Records</h3>
            <p>Manage and view registered students</p>
        </div>
    </div>

    <form method="GET" class="records-search">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search by name or email..."
            value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
        >

        <button type="submit" class="btn btn-primary">
            Search
        </button>

        <a href="user.php" class="btn btn-secondary">
            Reset
        </a>
    </form>

    <?php if ($result->num_rows > 0): ?>

        <div class="table-responsive">
            <table class="table table-bordered table-hover records-table">
                <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Course</th>
                        <th>Learning Mode</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $serialNumber = 1;

                while ($row = $result->fetch_assoc()):
                    $id = (int) $row['id'];
                ?>
                    <tr>
                        <td><?php echo $serialNumber++; ?></td>
                        <td><?php echo htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['address'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['gender'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['course'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($row['l_mode'], ENT_QUOTES, 'UTF-8'); ?></td>

                        <td class="action-buttons">
                            <button
                                type="button"
                                class="btn btn-warning btn-sm btn-edit"
                                onclick='editRecord(
                                    <?php echo $id; ?>,
                                    <?php echo json_encode($row["name"]); ?>,
                                    <?php echo json_encode($row["email"]); ?>,
                                    <?php echo json_encode($row["phone"]); ?>,
                                    <?php echo json_encode($row["address"]); ?>,
                                    <?php echo json_encode($row["gender"]); ?>,
                                    <?php echo json_encode($row["course"]); ?>,
                                    <?php echo json_encode($row["l_mode"]); ?>
                                )'
                            >Edit</button>

                            <form method="POST" action="delete.php" class="delete-form">
                                <input type="hidden" name="delete_id"
                                       value="<?php echo $id; ?>">

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this record?');"
                                >Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>

        <div class="no-records">
            <?php if ($search !== ''): ?>
                No records found for "<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>".
            <?php else: ?>
                No records found.
            <?php endif; ?>
        </div>

    <?php endif; ?>

</div>

<?php
if ($stmt !== null) {
    $stmt->close();
}
$conn->close();
?>

<script>
function editRecord(id, name, email, phone, address, gender, course, l_mode) {
    document.getElementById('edit_id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('address').value = address;
    document.getElementById('gender').value = gender;
    document.getElementById('course').value = course;
    document.getElementById('l_mode').value = l_mode;

    document.querySelector('button[type="submit"][name="submit"]').textContent = 'Update';
}
</script>