<?php
    $conn = new mysqli("localhost", "root", "", "database");

    $nameErr = $emailErr = $ageErr = $passwordErr = $mobileErr = $genderErr = $designationErr = $positionErr = $employeeErr = $hobbiesErr = '';
    $isValid = true;

    $name   = $email   = $age   = $password   = $mobile   = $gender   = $designation   = $position   = $employee   = $hobbies   = "";
    $update = false;

    if (isset($_GET['id'])) {
        $id     = $_GET['id'];
        $update = true;

        $result = $conn->query("SELECT * FROM data WHERE id=$id");

        $data        = $result->fetch_assoc();
        $name        = $data['name'] ?? '';
        $email       = $data['email'] ?? '';
        $age         = $data['age'] ?? '';
        $password    = $data['password'] ?? '';
        $mobile      = $data['mobile'] ?? '';
        $gender      = $data['gender'] ?? '';
        $designation = $data['designation'] ?? '';
        $position    = $data['position'] ?? '';
        $employee    = $data['employee'] ?? '';
        $hobbies     = $data['hobbies'] ?? '';
    }

    // echo '<pre>';
    // print_r($_POST);
    // exit;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['id'])) {
            $id     = (int) $_POST['id'];
            $update = true;
        } else {
            $update = false;
        }

        if (empty($_POST['name']) || ! preg_match("/^[a-zA-Z\s]+$/", $_POST['name'])) {
            $nameErr = "Please enter a valid name (only alphabets and spaces allowed).";
            $isValid = false;
        } else {
            $name = $_POST['name'];
        }

        if (empty($_POST['email']) || ! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Please enter a valid email address.";
            $isValid  = false;
        } else {
            $email = $_POST['email'];
        }

        if (empty($_POST['age']) || ! is_numeric($_POST['age']) || $_POST['age'] <= 0) {
            $ageErr  = "Please enter a valid age.";
            $isValid = false;
        } else {
            $age = $_POST['age'];
        }

        if (empty($_POST['password']) || strlen($_POST['password']) < 6) {
            $passwordErr = "Password must be at least 6 characters long.";
            $isValid     = false;
        } else {
            $password = $_POST['password'];
        }

        if (empty($_POST['mobile']) || ! is_numeric($_POST['mobile']) || strlen($_POST['mobile']) != 10) {
            $mobileErr = "Please enter a valid mobile number (10 digits).";
            $isValid   = false;
        } else {
            $mobile = $_POST['mobile'];
        }

        if (empty($_POST['gender'])) {
            $genderErr = "Please select a gender.";
            $isValid   = false;
        } else {
            $gender = $_POST['gender'];
        }

        if (empty($_POST['designation'])) {
            $designationErr = "Please select a designation.";
            $isValid        = false;
        } else {
            $designation = $_POST['designation'];
        }

        if (empty($_POST['position'])) {
            $positionErr = "Please select a position.";
            $isValid     = false;
        } else {
            $position = $_POST['position'];
        }

        if (empty($_POST['employee'])) {
            $employeeErr = "Please select an employee role.";
            $isValid     = false;
        } else {
            $employee = $_POST['employee'];
        }

        if (empty($_POST['hobbies'])) {
            $hobbiesErr = "Please select at least one hobby.";
            $isValid    = false;
        } else {
            $hobbies = implode(",", $_POST['hobbies']);
        }

        if ($isValid) {

            $name        = $conn->real_escape_string($name);
            $email       = $conn->real_escape_string($email);
            $age         = (int) $age;
            $password    = $conn->real_escape_string($password);
            $mobile      = (int) $mobile;
            $gender      = $conn->real_escape_string($gender);
            $designation = $conn->real_escape_string($designation);
            $position    = $conn->real_escape_string($position);
            $employee    = $conn->real_escape_string($employee);
            $hobbies     = $conn->real_escape_string($hobbies);

            if ($update) {
                // Update the record in the database
                $conn->query("UPDATE data SET name='$name', email='$email', age='$age', password='$password', mobile='$mobile', gender='$gender', designation='$designation', position='$position', employee='$employee', hobbies='$hobbies' WHERE id='$id'");
                // echo "<p style='color: green;'>Data has been updated successfully!</p>";
                header("Location: home.php");
                exit();

            } else {
                // Insert a new record in the database
                $conn->query("INSERT INTO data (name, email, age, password, mobile, gender, designation, position, employee, hobbies, dt)
                          VALUES ('$name', '$email', '$age', '$password', '$mobile', '$gender', '$designation', '$position', '$employee', '$hobbies', CURRENT_TIMESTAMP())");
                // echo "<p style='color: green;'>Data has been added successfully!</p>";
                header("Location: home.php");
                exit();

            }
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($_GET['id']) ? "Edit" : "Add" ?> User</title>
    <style>
        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>


</head>
<body>
    <h2><?php echo isset($_GET['id']) ? "Edit" : "Add New" ?> User</h2>
    <form action="addUpdate.php" method="POST" id="EmpForm">
        <?php if (isset($_GET['id'])): ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php endif; ?>

        <!-- Name -->
        Name: <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name) ?>"><br>
        <?php if ($nameErr) {
                echo '<div class="error">' . $nameErr . '</div>';
        }
        ?><br>

        <!-- Email -->
        Email: <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email) ?>"><br>
        <?php if ($emailErr) {
                echo '<div class="error">' . $emailErr . '</div>';
        }
        ?><br>

        <!-- Age -->
        Age: <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($age) ?>"><br>
        <?php if ($ageErr) {
                echo '<div class="error">' . $ageErr . '</div>';
        }
        ?><br>

        <!-- Password -->
        Password: <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password) ?>"><br>
        <?php if ($passwordErr) {
                echo '<div class="error">' . $passwordErr . '</div>';
        }
        ?><br>

        <!-- Mobile -->
        Mobile No: <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($mobile) ?>"><br>
        <?php if ($mobileErr) {
                echo '<div class="error">' . $mobileErr . '</div>';
        }
        ?><br>

        <!-- Gender -->
        <div class="question">Gender:</div>
        <div class="gender-group">
        <label for="male" >Male</label>
        <input type="radio" name="gender" id="male"  value="male"<?php echo($gender == 'male') ? 'checked' : ''; ?>>
        <label for="female">Female</label>
        <input type="radio" name="gender" id="female" value="female" <?php echo($gender == 'female') ? 'checked' : ''; ?>><br>
         </div>
        <?php if ($genderErr) {
                echo '<div class="error">' . $genderErr . '</div>';
        }
        ?><br>

        <!-- Designation -->
        Designation:
        <select name="designation" id="designation">
            <option value="">Select Designation</option>
            <?php
                $conn   = new mysqli("localhost", "root", "", "database");
                $result = $conn->query("SELECT * FROM `designation`");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['dg_id']}'>{$row['dg_name']}</option>";
                }
            ?>
           </select><br>
          <?php if ($designationErr) {
                  echo '<div class="error">' . $designationErr . '</div>';
          }
          ?><br>

        <!-- Position -->
        Position:
        <select name="position" id="position">
            <option value="">Select Position</option>

        </select><br>
        <?php if ($positionErr) {
                echo '<div class="error">' . $positionErr . '</div>';
        }
        ?><br>


        Employee Role:
        <select name="employee" id="employee">
            <option value="">select employee</option>
            </select><br>
        <?php if ($employeeErr) {
                echo '<div class="error">' . $employeeErr . '</div>';
        }
        ?>

        <!-- Hobbies -->
        <div class="question">Hobbies:</div> <br>
        <div class="hobbies-group">
        <label for="reading">Reading</label>
        <input type="checkbox" name="hobbies[]" id="reading" value="Reading"                                                     <?php echo(strpos($hobbies, 'Reading') !== false) ? 'checked' : ''; ?>><br>
        <label for="travelling">Travelling</label>
        <input type="checkbox" name="hobbies[]" id="travelling" value="Travelling"                                               <?php echo(strpos($hobbies, 'Travelling') !== false) ? 'checked' : ''; ?>><br>
        <label for="sports">Sports</label>
        <input type="checkbox" name="hobbies[]" id="sports" value="Sports"                                                        <?php echo(strpos($hobbies, 'Sports') !== false) ? 'checked' : ''; ?>><br>
    </div>

        <?php if ($hobbiesErr) {
                echo '<div class="error">' . $hobbiesErr . '</div>';
        }
        ?><br>

        <input type="submit" value="<?php echo isset($_GET['id']) ? 'Update' : 'Add' ?>">
    </form>
    <!-- jQuery First -->
<!-- jQuery Core -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Validation Plugin -->
 <script src="validation.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script> -->

<!-- Custom Scripts AFTER jQuery & Validation -->
 <script src="script.js"></script>
<script src="ajax.js"></script>


<script>

</script>
</body>

</html>
