<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateSportNameEntryForm($db, $_POST);
    if($errorMessage === true) {
        $query = "INSERT INTO sports_names (sport_name)
            VALUES ('{$_POST['sport_name']}')";
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
                        <tr>
                            <td><label for="sport_name">Sport Name</label></td>
                            <td>
                                <input type="text" name="sport_name" id='sport_name' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['sport_name']) ? '' : $_POST['sport_name'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['sport_name']) ? '' : $errorMessage['sport_name'] ?>
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

        <?php
        $query = "SELECT * FROM sports_names";
        $results = $db->get_results($query);
        if($results){
            echo "<table>
            <tr>
                <th colspan='5'>Sports Name</th>
            </tr>";
            $count = 1;
            foreach ($results as $sportName) {
                if($count == 1) {
                    echo "\n<tr>";
                }
                echo "<td>{$sportName->sport_name}</td>";
                if ($count == 5) {
                    echo '</tr>';
                    $count = 0;
                }
                ++$count;
            }
            if($count != 1 && $count != 5) {
                echo '</tr>';
            }
            echo '</table>';
        }
        ?>
        
    </div>
</div>
<?php include_once 'footer.php' ?>