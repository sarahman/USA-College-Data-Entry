<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateWeatherRatingEntryForm($db, $_POST);
    if ($errorMessage === true) {
        $query = "INSERT INTO weather_ratings (type)
            VALUES ('{$_POST['type']}')";
        $db->query($query);
        unset ($_POST);
        $messageData = getSuccessMessageData("A new weather type is successfully inserted.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting a weather type.");
    }
}
include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST">

            <fieldset>
                <legend class="bLight">Weather Details</legend>
                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="type">Weather Type</label></td>
                            <td>
                                <input type="text" name="type" id='type' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'type') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'type') ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>

            <div class="submit-clear padded">
                <input type="submit" value="Add" tabindex="37" />
                <input type="reset" value="Clear" tabindex="38" />
            </div>
        </form>
        <?php
        $query = "SELECT * FROM weather_ratings";
        $results = $db->get_results($query);
        if ($results) : ?>
        <table class="cell-centered">
            <tr>
            <?php for ($groupColumn = 2, $count = 0; $count < $groupColumn; ++$count ) : ?>
                <th>Rating</th>
                <th>Weather Type</th>
            <?php endfor ?>
            </tr>

            <?php $count = 0;
            foreach ($results as $weather) {
                echo ($count % $groupColumn) ? '' : "<tr>";
                echo <<<EOT
                    <td>{$weather->weather_rating}</td>
                    <td>{$weather->type}</td>
EOT;
                echo (++$count % $groupColumn) ? '' : "</tr>";
            }
            echo (++$count % $groupColumn) ? '' : "</tr>" ?>

        </table>
        <?php endif ?>
    </div>
</div>
<?php include_once 'footer.php' ?>