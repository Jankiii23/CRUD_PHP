<?php
$conn=new mysqli("localhost","root","","database");

if(isset($_POST['ps_id'])){
    $ps_id=$_POST['ps_id'];
    $query="SELECT * FROM `employee` WHERE ps_id=$ps_id";
    $result=$conn->query($query);
      //echo '<option value="">select employee</option>';
   
    while($row=$result->fetch_assoc()){
        echo "<option value='{$row['id']}'>{$row['emp_name']}</option>";
    }
}
?>