<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateMajorEntryForm($db, $_POST);
    if ($errorMessage === true) {
        CRUDOperation::insertMajor($db, $_POST);
        unset($_POST);
        $messageData = getSuccessMessageData("A new major of a college is successfully inserted.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting a major under a college.");
    }
}
include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST">
            <fieldset>
                <legend class="bLight">Student Major Details</legend>
                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="college_id">College Name</label></td>
                            <td>
                                <?php $results = CRUDOperation::selectIdNameOfCollege($db) ?>

                                <select name="college_id" id='college_id' tabindex="5">
                                    <option value="">- Select a college -</option>
                                    <?php if ($results) : foreach($results as $college) : ?>
                                    <option value='<?php echo $college->college_id ?>'
                                        <?php echo (!empty($_POST['college_id']) && $_POST['college_id'] == $college->college_id) ? 'selected' : '' ?>>
                                            <?php echo $college->name ?>
                                    </option>
                                    <?php endforeach; endif ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'college_id') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="subject_name">Subject Name</label></td>
                            <td>
                                <input type="text" name="subject_name" id='subject_name' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'subject_name') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'subject_name') ?>
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
    </div>
</div>
<?php include_once 'footer.php' ?>