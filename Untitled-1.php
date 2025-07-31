<option value="Other" <?php echo ($designation == 'Other') ? 'selected' : ''; ?>>Other</option>
            <option value="Developer" <?php echo ($designation == 'Developer') ? 'selected' : ''; ?>>Developer</option>
            <option value="Manager" <?php echo ($designation == 'Manager') ? 'selected' : ''; ?>>Manager</option>

            <?php
           $result=$conn->query("SELECT * FROM `designation`");
           while($row=$result->fetch_assoc()){?>
           <option value="<?php echo $row["dg_id"];?>"><?php echo $row["dg_name"];?></option>
          <?php }
           ?>
            
        </select><br>
        <?php if ($designationErr) echo '<div class="error">' . $designationErr . '</div>'; ?><br>


        <option value="Project Manager" <?php echo ($position == 'Project Manager') ? 'selected' : ''; ?>>Project Manager</option>
            <option value="PHP Developer" <?php echo ($position == 'PHP Developer') ? 'selected' : ''; ?>>PHP Developer</option>
            <option value=".Net Developer" <?php echo ($position == '.Net Developer') ? 'selected' : ''; ?>>.Net Developer</option>
            <option value="HR" <?php echo ($position == 'HR') ? 'selected' : ''; ?>>HR</option>

            <option value="Team Leader" <?php echo ($employee == 'Team Leader') ? 'selected' : ''; ?>>Team Leader</option>
            <option value="Jr Php Developer" <?php echo ($employee == 'Jr Php Developer') ? 'selected' : ''; ?>>Jr Php Developer</option>
            <option value="Sr Php Developer" <?php echo ($employee == 'Sr Php Developer') ? 'selected' : ''; ?>>Sr Php Developer</option>
            <option value="Jr .Net Developer" <?php echo ($employee == 'Jr .Net Developer') ? 'selected' : ''; ?>>Jr .Net Developer</option>
            <option value="Sr .Net Developer" <?php echo ($employee == 'Sr .Net Developer') ? 'selected' : ''; ?>>Sr .Net Developer</option>
            <option value="Jr HR" <?php echo ($employee == 'Jr HR') ? 'selected' : ''; ?>>Jr HR</option>
            <option value="Sr HR" <?php echo ($employee == 'Sr HR') ? 'selected' : ''; ?>>Sr HR</option>
