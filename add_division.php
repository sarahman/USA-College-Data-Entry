<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateDivisionEntryForm($db, $_POST);
    if ($errorMessage === true) {
        CRUDOperation::insertCollegeDivision($db, $_POST);
        unset ($_POST);
        $messageData = getSuccessMessageData("A new division is successfully inserted.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting a division.");
    }
}
include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST">

            <fieldset>
                <legend class="bLight">College Division Detail</legend>
                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="division">Division</label></td>
                            <td>
                                <input type="text" name="division" id='division' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'division') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'division') ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="submit-clear padded">
                    <input type="submit" value="Add" tabindex="37" />
                    <input type="reset" value="Clear" tabindex="38" />
                    <button tabindex="39" onclick="window.location='index.php'; return false">Back</button>
                </div>
            </fieldset>
        </form>
        <?php
        $results = CRUDOperation::selectAllDivisions($db);
        if ($results) : $groupColumn = 5 ?>
        <table class="cell-centered">
            <tr>
                <th colspan='<?php echo $groupColumn ?>'>Divisions</th>
            </tr>
            <?php $count = 0;
            foreach ($results as $division) {
                echo ($count % $groupColumn) ? '' : "<tr>";
                echo "<td style='width: 20%'>{$division->division}</td>";
                echo (++$count % $groupColumn) ? '' : "</tr>";
            }
            echo (++$count % $groupColumn) ? '' : "</tr>" ?>

        </table>
        <?php endif ?>
    </div>
</div>
<?php include_once 'footer.php' ?>