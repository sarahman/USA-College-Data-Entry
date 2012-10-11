<?php
include_once 'connection.php';
include_once 'functions.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$messageData = $errorMessage = array();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateSportOfferEntryForm($db, $_POST);
    if ($errorMessage === true) {
        CRUDOperation::insertSportOffer($db, $_POST);
        unset($_POST);
        $messageData = getSuccessMessageData("A new sport is successfully in a college.");
    } else {
        $messageData = getFailureMessageData("An error occurred while inserting sport under a college.");
    }
}

include_once 'header.php' ?>
<div id="content">

    <?php echo getNotificationMessage($messageData) ?>

    <div class="feature">
        <form action="" method="POST">

            <fieldset>
                <legend class="bLight">College Sport Details</legend>
                <table class="centered" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <tr>
                            <td><label for="college_id3">College Name</label></td>
                            <td>
                                <?php $results = CRUDOperation::selectIdNameOfCollege($db) ?>
                                <select name="college_id3" id='college_id3' tabindex="5">
                                    <option value=''>- Select a college -</option>
                                    <?php if ($results) : foreach($results as $college) : ?>
                                    <option value='<?php echo $college->college_id ?>'
                                        <?php echo (!empty($_POST['college_id3']) && $_POST['college_id3'] == $college->college_id) ? 'selected' : '' ?>>
                                            <?php echo $college->name ?>
                                    </option>
                                    <?php endforeach; endif ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'college_id3') ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="sport_name">Sport Name</label></td>
                            <td>
                                <?php $results = CRUDOperation::selectAllSportNames($db) ?>
                                <select name="sport_name" id='sport_name' tabindex="5">
                                    <option value=''>- Select a sport -</option>
                                    <?php if ($results) : foreach($results as $sport_name) : ?>
                                    <option value='<?php echo $sport_name->sport_name ?>'
                                        <?php echo (!empty($_POST['sport_name']) && $_POST['sport_name'] == $sport_name->sport_name) ? 'selected' : '' ?>>
                                            <?php echo $sport_name->sport_name ?></option>
                                    <?php endforeach; endif ?>
                                </select>
                                <span class="stars">*</span>
                                <?php echo getFieldErrorMessage($errorMessage, 'sport_name') ?>
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
        $results = CRUDOperation::selectAllSportNamesOfColleges($db);
        if ($results) : ?>
        <table style='100%'>
            <tr>
            <?php for ($columnGroup = 2, $count = 0; $count < $columnGroup; ++$count) : ?>
                <th style='width: 30% !important;'>College</th>
                <th style='width: 20% !important;'>Sports</th>
            <?php endfor ?>
            </tr>
            <?php $count = 0;
            foreach ($results as $sportOffer) {
                echo ($count % $columnGroup) ? '' : "<tr>";
                echo '<td>' . ucfirst($sportOffer->name) . '</td>';
                echo '<td>' . ucfirst($sportOffer->sport_name) . '</td>';
                echo (++$count % $columnGroup) ? '' : "</tr>";
            }
            echo (++$count % $columnGroup) ? '' : "</tr>" ?>
        </table>
        <?php endif ?>

    </div>
</div>
<?php include_once 'footer.php' ?>