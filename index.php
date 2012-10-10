<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = array();
if (!empty($_POST)) {
    include_once 'Validation.php';
    if ($_POST['addCollege']) {
        $errorMessage = Validation::validateCollegeEntryForm($db, $_POST);
        if ($errorMessage === true) {
            CRUDOperation::insertCollege($db, $_POST);
            unset($_POST);
            $messageData = getSuccessMessageData("A new college is successfully inserted.");
        } else {
            $messageData = getFailureMessageData("An error occurred while inserting a college.");
        }
    } elseif ($_POST['addMajor']) {
        $errorMessage = Validation::validateMajorEntryForm($db, $_POST);
        if ($errorMessage === true) {
            CRUDOperation::insertMajor($db, $_POST);
            unset($_POST);
            $messageData = getSuccessMessageData("A new major of a college is successfully inserted.");
        } else {
            $messageData = getFailureMessageData("An error occurred while inserting a major under a college.");
        }
    } elseif ($_POST['addEnrollment']) {
        $errorMessage = Validation::validateStudentEnrollmentForm($db, $_POST);
        if ($errorMessage === true) {
            CRUDOperation::insertStudentEnrollment($db, $_POST);
            unset ($_POST);
            $messageData = getSuccessMessageData("A new student enrollment of a college is successfully inserted.");
        } else {
            $messageData = getFailureMessageData("An error occurred while inserting student enrollment under a college.");
        }
    } elseif ($_POST['addSportName']) {
        $errorMessage = Validation::validateSportNameEntryForm($db, $_POST);
        if ($errorMessage === true) {
            CRUDOperation::insertSportName($db, $_POST);
            unset($_POST);
            $messageData = getSuccessMessageData("A new sport name is successfully inserted.");
        } else {
            $messageData = getFailureMessageData("An error occurred while inserting sport name.");
        }
    } elseif ($_POST['addSportOffer']) {
        $errorMessage = Validation::validateSportOfferEntryForm($db, $_POST);
        if ($errorMessage === true) {
            CRUDOperation::insertSportOffer($db, $_POST);
            unset($_POST);
            $messageData = getSuccessMessageData("A new sport is successfully in a college.");
        } else {
            $messageData = getFailureMessageData("An error occurred while inserting sport under a college.");
        }
    }
}
include_once 'header.php';
?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="left-content">

        <?php include_once 'forms/college-add.php' ?>

        <?php include_once 'forms/major-add.php' ?>

    </div>

    <div class="right-content">

        <?php include_once 'forms/enrollment-add.php' ?>

        <?php include_once 'forms/sport-name-add.php' ?>

        <?php include_once 'forms/sport-offer-add.php' ?>

    </div>
</div>
<?php include_once 'footer.php' ?>