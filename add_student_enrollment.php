<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateStudentEnrollmentForm($db, $_POST);
    if ($errorMessage === true) {
        CRUDOperation::insertStudentEnrollment($db, $_POST);
        unset ($_POST);
        $messageData = getSuccessMessageData("A new student enrollment of a college is successfully inserted.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting student enrollment under a college.");
    }
}
include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST">

            <fieldset>
                <legend class="bLight">Student Enrollment Details</legend>
                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="college_id2">College Name</label></td>
                            <td>
                                <?php $results = CRUDOperation::selectIdNameOfCollege($db) ?>
                                <select name="college_id2" id='college_id2' tabindex="5">
                                    <option value=''>- Select a college -</option>";
                                    <?php
                                    if ($results) : foreach($results as $college) : ?>
                                    <option value='<?php echo $college->college_id ?>'
                                        <?php echo (!empty($_POST['college_id2']) && $_POST['college_id2'] == $college->college_id) ? 'selected' : '' ?>>
                                            <?php echo $college->name ?></option>
                                    <?php endforeach; endif ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'college_id2') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="semester">Semester</label></td>
                            <td>
                                <select name="semester" id='semester' tabindex="5">
                                    <option value=''>- Select a semester -</option>
                                    <option value='Summer'
                                        <?php echo (!empty($_POST['semester']) && $_POST['semester'] == 'Summer') ? 'selected' : '' ?>>
                                        Summer</option>
                                    <option value='Fall'
                                        <?php echo (!empty($_POST['semester']) && $_POST['semester'] == 'Fall') ? 'selected' : '' ?>>
                                        Fall</option>
                                    <option value='Winter'
                                        <?php echo (!empty($_POST['semester']) && $_POST['semester'] == 'Winter') ? 'selected' : '' ?>>
                                        Winter</option>
                                    <option value='Spring'
                                        <?php echo (!empty($_POST['semester']) && $_POST['semester'] == 'Summer') ? 'selected' : '' ?>>
                                        Spring</option>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'semester') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="year">Year</label></td>
                            <td>
                                <select name="year" id='year' tabindex="5">
                                    <option value="">- Select a year -</option>
                                    <?php for($year=date('Y'); $year>=1970; --$year) : ?>
                                    <option value='<?php echo $year ?>'
                                        <?php echo (!empty($_POST['year']) && $_POST['year'] == $year) ? 'selected' : '' ?>>
                                    <?php echo $year ?></option>
                                    <?php endfor ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'year') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="no_of_students">No. of Students</label></td>
                            <td>
                                <input type="text" name="no_of_students" id='no_of_students' size="50" tabindex="2"
                                       value="<?php echo getVariableValue($_POST, 'no_of_students') ?>" />
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'no_of_students') ?>
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