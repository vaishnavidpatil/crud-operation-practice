<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >

    <title>Registration form</title>
    <style>
        /* Your existing CSS styles here */
body {
    background-color: #f8f9fa; /* Light Gray Background */
    font-family: 'Arial', sans-serif;
}
label {
    font-weight: bold;
    display: block;
    width: 150px;
    text-align: left;
      /* Adjust width to align labels properly */
}

/* Form Card Styling */
.card {
    margin-top:80px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    background: #ffffff;
    max-width: 1000px; /* Adjust width */
    margin: 80px auto;
}

/* Form Headings */
h3 {
    font-weight: bold;
    color: #007bff; /* Bootstrap primary blue */
}

/* Input Fields & Select Dropdowns */
.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #ced4da;
    transition: all 0.3s ease-in-out;
}

/* Input Field Focus Effect */
.form-control:focus, .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Button Styling */
.btn {
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: bold;
    transition: all 0.3s ease;
}

/* Submit Button */
.btn-primary {
    background-color: #007bff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}

/* Clear Button */
.btn-secondary {
    background-color:rgb(64, 114, 195);
    border: none;
}

.btn-secondary:hover {
    background-color:rgb(107, 134, 236);
}

/* Terms & Conditions Checkbox */
.form-check-input {
    cursor: pointer;
    transform: scale(1.1);
}

.form-check-label {
    font-size: 14px;
    color: #555;
}

.btn-view-custom {
        background-color: #a7bdd7;
        color: black; /* Black text might look better on this lighter shade */
        border: 1px solid #a7bdd7;
}

.btn-view-custom:hover {
        background-color: #91a8c4; /* A slightly darker shade for hover */
        border-color: #889db8;
}
/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .card {
        padding: 20px;
    }

    .btn {
        width: 100%; /* Full-width buttons on small screens */
        margin-bottom: 10px;
    }
}

/* Edit Button Style */
.btn-edit {
    background-color: #ffc107; /* Bootstrap warning color */
    color: white;
    border: none;
}

.btn-edit:hover {
    background-color: #e0a800;
}

/* Initially hide the data table */
#studentRecordsSection {
    display: none;
    margin-top: 20px;
}
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="text-center text-primary">Student Registration Form</h3><br>
        <form method="post" action="insert.php" onsubmit="return submitForm()">
            <input type="hidden" name="edit_id" id="edit_id" value="">

            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Student Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required autocomplete="off">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autocomplete="off">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Phone number"pattern="[0-9]{10}" title="Enter a valid 10-digit mobile number" required autocomplete="off">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Address</label>
                    <textarea class="form-control" id="address" name="address" placeholder="Enter your address" rows="2" required autocomplete="off"></textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Course</label>
                    <select class="form-select" id="course" name="course" required>
                        <option value="">Select Course</option>
                        <option value="Web Development">Web Development</option>
                        <option value="App Development">App Development</option>
                        <option value="Python">Python</option>
                        <option value="C/C++">C/C++</option>
                        <option value="Java">Java</option>
                        <option value="AI/ML">AI/ML</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Learning Mode</label>
                    <select class="form-select" id="l_mode" name="l_mode" required>
                        <option value="">Select Mode</option>
                        <option value="Online">Online</option>
                        <option value="Offline">Offline</option>
                    </select>
                </div>
            </div>

            <div class="form-check mt-3">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">I agree to all Terms & Conditions</label>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary me-2" name="submit">Submit</button>
                <button type="reset" class="btn btn-secondary me-2" onclick="resetEdit()">Clear</button>
                <button type="button" class="btn me-2 btn-view-custom" onclick="toggleRecords()">View Records</button>
            </div>
        </form>
    </div>

    <div id="studentRecordsSection">
        <h2 class="text-center text-primary mt-5">Student Records</h2>
        <div id="recordDisplay">
            </div>
    </div>
</div>
<script>
    function submitForm() {
        alert("Submitted successfully!");
        return true; // Allow form submission to continue
    }

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
        document.querySelector('form').action = 'update.php'; // Change form action to update script
    }

    function resetEdit() {
        document.getElementById('edit_id').value = '';
        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('address').value = '';
        document.getElementById('gender').value = '';
        document.getElementById('course').value = '';
        document.getElementById('l_mode').value = '';

        // Reset the select dropdowns to their default "Select" option
        document.getElementById('gender').selectedIndex = 0;
        document.getElementById('course').selectedIndex = 0;
        document.getElementById('l_mode').selectedIndex = 0;

        // Change the submit button text back to "Submit"
        document.querySelector('button[type="submit"][name="submit"]').textContent = 'Submit';
        document.querySelector('form').action = 'insert.php'; // Change form action back to insert script
    }

    function toggleRecords() {
        var recordsSection = document.getElementById('studentRecordsSection');
        var recordDisplay = document.getElementById('recordDisplay');
        if (recordsSection.style.display === 'none') {
            recordsSection.style.display = 'block';
            // Load data using AJAX when the view button is clicked
            fetch('display.php')
                .then(response => response.text())
                .then(data => {
                    recordDisplay.innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    recordDisplay.innerHTML = '<div class="alert alert-danger">Error loading student records.</div>';
                });
        } else {
            recordsSection.style.display = 'none';
            recordDisplay.innerHTML = ''; // Clear the displayed data
        }
    }
</script>

</body>
</html> 