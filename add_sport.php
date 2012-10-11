<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateSportNameEntryForm($db, $_POST);
    if ($errorMessage === true) {
        CRUDOperation::insertSportName($db, $_POST);
        unset($_POST);
        $messageData = getSuccessMessageData("A new sport name is successfully inserted.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting sport name.");
    }
}

include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST">

            <fieldset>
                <legend class="bLight">Sport Name Details</legend>
                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="sport_name_entry">Sport Name</label></td>
                            <td>
                                <input type="text" name="sport_name_entry" id='sport_name_entry' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'sport_name_entry') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'sport_name_entry') ?>
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
        $results = CRUDOperation::selectAllSportNames($db);
        if ($results) : $groupColumn = 5 ?>
        <table>
            <tr>
                <th colspan='<?php echo $groupColumn ?>'>Sports Name</th>
            </tr>
            <?php $count = 0;
            foreach ($results as $sportName) {
                echo ($count % $groupColumn) ? '' : "<tr>";
                echo "<td>{$sportName->sport_name}</td>";
                echo (++$count % $groupColumn) ? '' : "</tr>";
            }
            echo (++$count % $groupColumn) ? '' : "</tr>" ?>

        </table>
        <?php endif ?>

    </div>
</div>
<?php include_once 'footer.php' ?>