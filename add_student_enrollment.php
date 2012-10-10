<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateStudentEnrollmentForm($db, $_POST);
    if($errorMessage === true) {
        $query = "INSERT INTO student_enrollments (college_id, semester, year, no_of_students)
            VALUES ('{$_POST['college_id']}', '{$_POST['semester']}', '{$_POST['year']}', '{$_POST['no_of_students']}')";
        $db->query($query);
        unset ($_POST);
    }
}
include_once 'header.php'
?>
<div id="content">
    <div class="feature">
        <form action="" method="POST">
                
            <fieldset>
                <legend class="bLight">Your Details</legend>
                <table width="100%" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <?php if(!empty ($errorMessage['error'])) {
                            echo "<tr><td colspan='2'><span style='font-size: 16px'>{$errorMessage['error']}</span></td></tr>";
                        } ?>
                        <tr>
                            <td><label for="college_id">College Name</label></td>
                            <?php
                            $query = "SELECT college_id, name FROM colleges";
                            $results = $db->get_results($query);
                            ?>
                            <td>
                                <select name="college_id" id='college_id' tabindex="5">
                                    <option value=''></option>";
                                    <?php if ($results) {
                                        foreach($results as $college):
                                            echo "<option value='{$college->college_id}'>{$college->name}</option>";
                                        endforeach;
                                    } ?>
                                </select>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['college_id']) ? '' : $errorMessage['college_id'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="semester">Semester</label></td>
                            <td>
                                <select name="semester" id='semester' tabindex="5">
                                    <option value=''></option>
                                    <option value='Summer'>Summer</option>
                                    <option value='Fall'>Fall</option>
                                    <option value='Winter'>Winter</option>
                                    <option value='Spring'>Spring</option>
                                </select>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['semester']) ? '' : $errorMessage['semester'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="year">Year</label></td>
                            <td>
                                <select name="year" id='year' tabindex="5">
                                <?php for($year=date('Y');$year>=1970;$year--):
                                    echo "<option value='{$year}'>{$year}</option>";
                                endfor ?>
                                </select>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['year']) ? '' : $errorMessage['year'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="no_of_students">No. of Students</label></td>
                            <td>
                                <input type="text" name="no_of_students" id='no_of_students' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['no_of_students']) ? '' : $_POST['no_of_students'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['no_of_students']) ? '' : $errorMessage['no_of_students'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <div align="center" style="padding: 25px 0">
                <input type="submit" value="Add" tabindex="37" />
                <input type="reset" value="Clear" tabindex="38" />
            </div>
        </form>
    </div>
</div>
<?php include_once 'footer.php' ?>