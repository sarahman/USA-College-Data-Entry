<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateDivisionEntryForm($db, $_POST);
    if($errorMessage === true) {
        $query = "INSERT INTO divisions (division)
            VALUES ('{$_POST['division']}')";
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
                            <td><label for="division">Division</label></td>
                            <td>
                                <input type="text" name="division" id='division' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['division']) ? '' : $_POST['division'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['division']) ? '' : $errorMessage['division'] ?>
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
        $query = "SELECT * FROM divisions";
        $results = $db->get_results($query);
        if($results){
            echo "<table>
            <tr>
                <th>Divisions</th>
            </tr>";
            foreach ($results as $division) {
                echo <<<EOT
                <tr>
                    <td>{$division->division}</td>
                </tr>
EOT;
            }
            echo '</table>';
        }
        ?>
    </div>
</div>
<?php include_once 'footer.php' ?>