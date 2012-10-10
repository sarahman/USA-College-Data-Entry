<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $validationResponse = Validation::validateWeatherRatingEntryForm($db, $_POST);
    if($validationResponse === true) {
        $query = "INSERT INTO weather_ratings (type)
            VALUES ('{$_POST['type']}')";
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
                            <td><label for="type">Weather Type</label></td>
                            <td>
                                <input type="text" name="type" id='type' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['type']) ? '' : $_POST['type'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($validationResponse['type']) ? '' : $validationResponse['type'] ?>
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
        $query = "SELECT * FROM weather_ratings";
        $results = $db->get_results($query);
        if($results){
            echo "<table>
            <tr>
                <th>Ratings</th>
                <th>Weather Type</th>
            </tr>";
            foreach ($results as $weather) {
                echo <<<EOT
                <tr>
                    <td>{$weather->weather_rating}</td>
                    <td>{$weather->type}</td>
                </tr>
EOT;
            }
            echo '</table>';
        }
        ?>
    </div>
</div>
<?php include_once 'footer.php' ?>