<?php
$conn=new mysqli("localhost","root","","database");

if(isset($_POST["dg_id"])){
    $dg_id=$_POST["dg_id"];
    $query = "SELECT * FROM `position` WHERE dg_id =  $dg_id";
    $result=$conn->query($query);
    //echo '<option value="">Select Position</option>';
    while($row=$result->fetch_assoc()){
        echo "<option value='{$row['ps_id']}'>{$row['ps_name']}</option>";
    }
}
?>