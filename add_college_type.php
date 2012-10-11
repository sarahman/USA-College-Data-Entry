<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateCollegeTypeEntryForm($db, $_POST);
    if ($errorMessage === true) {
        CRUDOperation::insertCollegeType($db, $_POST);
        unset($_POST);
        $messageData = getSuccessMessageData("A new college type is successfully inserted.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting a college type.");
    }
}
include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST">
            <fieldset>
                <legend class="bLight">College Type Details</legend>
                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="college_type">College Type</label></td>
                            <td>
                                <input type="text" name="college_type" id='college_type' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'college_type') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'college_type') ?>
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
        $results = CRUDOperation::selectAllCollegeTypes($db);
        if ($results) : ?>
        <table class="cell-centered">
            <tr>
            <?php for ($count = 0, $columnGroup = 4; $count < $columnGroup; ++$count) : ?>
                <th style='width: 25%'>College Type</th>
            <?php endfor ?>
            </tr>

            <?php $count = 0;
            foreach ($results as $college_type) {
                echo ($count % $columnGroup) ? '' : '<tr>';
                echo "<td>{$college_type->college_type}</td>";
                echo (++$count % $columnGroup) ? '' : '</tr>';
            }
            echo (++$count % $columnGroup) ? '' : '</tr>'; ?>
        </table>
        <?php endif ?>
    </div>
</div>
<?php include_once 'footer.php' ?>