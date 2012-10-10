<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateCollegeTypeEntryForm($db, $_POST);
    if($errorMessage === true) {
        $query = "INSERT INTO college_types (college_type)
            VALUES ('{$_POST['college_type']}')";
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
                        <tr>
                            <td><label for="college_type">College Type</label></td>
                            <td>
                                <input type="text" name="college_type" id='college_type' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['college_type']) ? '' : $_POST['college_type'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['college_type']) ? '' : $errorMessage['college_type'] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <div align="center" style="padding: 25px 0 25px 0">
                <input type="submit" value="Add" tabindex="37" /><input type="reset" value="Clear" tabindex="38" />
            </div>
        </form>
        <?php
        $query = "SELECT * FROM college_types";
        $results = $db->get_results($query);
        if($results) {
            $columnGroup = 4;
            echo "<table width='100%'>
            <tr>
                <th style='width: 25%'>College Type</th>
                <th style='width: 25%'>College Type</th>
                <th style='width: 25%'>College Type</th>
                <th style='width: 25%'>College Type</th>
            </tr>";
            $count = 0;
            foreach ($results as $college_type) {
                echo ($count % $columnGroup) ? '': '<tr>';
                echo "<td>{$college_type->college_type}</td>";
                echo (++$count % $columnGroup) ? '': '<tr>';
            }
            echo '</table>';
        }
        ?>
    </div>
</div>
<?php include_once 'footer.php' ?>