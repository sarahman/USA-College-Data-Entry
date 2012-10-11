<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateCollegeEntryForm($db, $_POST);
    if ($errorMessage === true) {
        CRUDOperation::insertCollege($db, $_POST);
        unset($_POST);
        $messageData = getSuccessMessageData("A new college is successfully inserted.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting a college.");
    }
}
include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST" id='college-add-form'>
            <fieldset>
                <legend class="bLight red"><span>College Details</span></legend>
                <?php echo getFormErrorMessage($errorMessage, 'collegeEntryError') ?>

                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="name">College Name</label></td>
                            <td>
                                <input type="text" name="name" id='name' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'name') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'name') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="city">City</label></td>
                            <td>
                                <input type="text" id='city' name="city" size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'city') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'city') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="state">State</label></td>
                            <td>
                                <input type="text" id='state' name="state" size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'state') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'state') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="college_type">College Type</label></td>
                            <td>
                                <?php $results = CRUDOperation::selectAllCollegeTypes($db) ?>
                                <select name="college_type" id='college_type' tabindex="5">
                                    <option value="">- Select college type -</option>
                                    <?php if ($results) : foreach($results as $type): ?>
                                    <option value='<?php echo $type->college_type ?>'
                                        <?php echo (!empty($_POST['college_type']) && $_POST['college_type'] == $type->college_type) ? 'selected' : '' ?>>
                                            <?php echo $type->college_type ?></option>
                                <?php endforeach; endif ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'college_type') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="school_logo_link">School Logo Link</label></td>
                            <td>
                                <input type="text" name="school_logo_link" id='school_logo_link' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'school_logo_link') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'school_logo_link') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="athletic_logo_link">Athletic Logo Link</label></td>
                            <td>
                                <input type="text" name="athletic_logo_link" id='athletic_logo_link' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['athletic_logo_link']) ? '' : $_POST['athletic_logo_link'] ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'athletic_logo_link') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="division">Division</label></td>
                            <td>
                                <?php $results = CRUDOperation::selectAllDivisions($db) ?>
                                <select name="division" id='division' tabindex="5">
                                    <option value="">- Select a division -</option>
                                <?php if ($results) : foreach($results as $division) : ?>
                                    <option value='<?php echo $division->division ?>'
                                        <?php echo (!empty($_POST['division']) && $_POST['division'] == $division->division) ? 'selected' : '' ?>>
                                            <?php echo $division->division ?></option>
                                <?php endforeach; endif ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'division') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="weather_rating">Weather Rating</label></td>
                            <td>
                                <?php $results = CRUDOperation::selectAllWeatherRatings($db) ?>
                                <select name="weather_rating" id='weather_rating' tabindex="5">
                                    <option value="">- Select a weather -</option>
                                    <?php if ($results) : foreach($results as $weather): ?>
                                    <option value='<?php echo $weather->weather_rating ?>'
                                        <?php echo (!empty($_post['weather_rating']) && $_POST['weather_rating'] == $weather->weather_rating) ? 'selected' : ''?>>
                                            <?php echo $weather->type ?></option>
                                <?php endforeach; endif ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'weather_rating') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="in_state_tuition_fee">In-State Tuition Fees</label></td>
                            <td>
                                <input type="text" name="in_state_tuition_fee" size="50" id='in_state_tuition_fee' tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'in_state_tuition_fee') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'in_state_tuition_fee') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="out_state_tuition_fee">Out-State Tuition Fees</label></td>
                            <td>
                                <input type="text" name="out_state_tuition_fee" id='out_state_tuition_fee' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'out_state_tuition_fee') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'out_state_tuition_fee') ?>
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