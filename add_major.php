<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateMajorEntryForm($db, $_POST);
    if($errorMessage === true) {
        $query = "INSERT INTO majors (college_id, subject_name)
            VALUES ('{$_POST['college_id']}', '{$_POST['subject_name']}')";
        $db->query($query);
        unset($_POST);
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
                        <?php if (!empty ($errorMessage['error'])) {
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
                                <?php
                                if ($results) {
                                    foreach($results as $college):
                                        echo "<option value='{$college->college_id}'>{$college->name}</option>";
                                    endforeach;
                                }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="subject_name">Subject Name</label></td>
                            <td>
                                <input type="text" name="subject_name" id='subject_name' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['subject_name']) ? '' : $_POST['subject_name'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['subject_name']) ? '' : $errorMessage['subject_name'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <div align="center" style="padding: 25px">
                <input type="submit" value="Add" tabindex="37" />
                <input type="reset" value="Clear" tabindex="38" />
            </div>
        </form>
    </div>
</div>
<?php include_once 'footer.php' ?>