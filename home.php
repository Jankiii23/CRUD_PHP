<?php
    $server   = "localhost";
    $user     = "root";
    $password = "";
    $db_name  = "database";
    $conn     = new mysqli($server, $user, $password, $db_name);
    if ($conn->connect_error) {
        die("Connection failed" . $conn->connect_error);
    }
    $result = $conn->query(" SELECT data.*,designation.dg_name,  position.ps_name, employee.emp_name
FROM data
JOIN designation ON data.designation = designation.dg_id
JOIN position ON data.position = position.ps_id
JOIN employee ON data.employee = employee.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>User</h2>
    <a href=addUpdate.php>Add new user</a>
    <br><br>

   <?php if (isset($_GET['deleted'])) {
           echo "<p style='color:red;'>User deleted!</p>";
       }
   ?>
<?php if (isset($_GET['success'])) {
        echo "<p style='color:green'>User add successfully</p>";
    }
?>

    <table border="1" cell="8">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Age</th><th>Password</th><th>Mobile</th><th>Gender
            </th><th>Designation</th><th>Position</th><th>Employee</th><th>Hobbies</th><th>Date & Time</th>
        </tr>
<?php while ($row = $result->fetch_assoc()) {?>
<tr>
    <td><?php echo $row['id']?></td>
    <td><?php echo $row['name']?></td>
    <td><?php echo $row['email']?></td>
    <td><?php echo $row['age']?></td>
    <td><?php echo $row['password']?></td>
    <td><?php echo $row['mobile']?></td>
    <td><?php echo $row['gender']?></td>
    <td><?php echo $row['dg_name']?></td>
    <td><?php echo $row['ps_name']?></td>
    <td><?php echo $row['emp_name']?></td>
    <td><?php echo $row['hobbies']?></td>
    <td><?php echo $row['dt']?></td>
    <!-- </td><td> <button class='btn btn-warning btn-sm btn-edit'>Edit</button><button class='btn btn-danger btn-sm btn-edit'>Delete</button></td> -->
    <td>
        <a href="addUpdate.php?id=<?php echo $row['id']?>">Edit</a>
        <a href="delete.php?id=<?php echo $row['id']?>"onclick="return confirm('Are you sure?')">Delete</a>
</td>

</tr>
<?php }?>
</table>
</body>
</html>