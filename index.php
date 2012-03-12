<?php
include_once 'connection.php';
include_once 'CRUDOperation.php';

$db = getConnection();
$successMessage = '';
$failureMessage = '';
if (!empty ($_POST)) {
    include_once 'Validation.php';
    if ($_POST['addCollege']) {
        $errorMessage = Validation::validateCollegeEntryForm($db, $_POST);
        if($errorMessage === true) {
            CRUDOpearion::insertCollege($db, $_POST);
            unset($_POST);
            $successMessage = "A new college is successfully inserted.";
        } else {
            $failureMessage = "An error occurred while inserting a college.";
        }
    } elseif ($_POST['addMajor']) {
        $errorMessage = Validation::validateMajorEntryForm($db, $_POST);
        if($errorMessage === true) {
            CRUDOpearion::insertMajor($db, $_POST);
            unset($_POST);
            $successMessage = "A new major of a college is successfully inserted.";
        } else {
            $failureMessage = "An error occurred while inserting a major under a college.";
        }
    } elseif ($_POST['addEnrollment']) {
        $errorMessage = Validation::validateStudentEnrollmentForm($db, $_POST);
        if($errorMessage === true) {
            CRUDOpearion::insertStudentEnrollment($db, $_POST);
            unset ($_POST);
            $successMessage = "A new student enrollment of a college is successfully inserted.";
        } else {
            $failureMessage = "An error occurred while inserting student enrollment under a college.";
        }
    } elseif ($_POST['addSportName']) {
        $errorMessage = Validation::validateSportNameEntryForm($db, $_POST);
        if($errorMessage === true) {
            CRUDOpearion::insertSportName($db, $_POST);
            unset($_POST);
            $successMessage = "A new sport name is successfully inserted.";
        } else {
            $failureMessage = "An error occurred while inserting sport name.";
        }
    } elseif ($_POST['addSportOffer']) {
        $errorMessage = Validation::validateSportOfferEntryForm($db, $_POST);
        if($errorMessage === true) {
            CRUDOpearion::insertSportOffer($db, $_POST);
            unset($_POST);
            $successMessage = "A new sport is successfully in a college.";
        } else {
            $failureMessage = "An error occurred while inserting sport under a college.";
        }
    }
}
include_once 'header.php'
?>
<div id="content">
    <div class="feature">
        <?php if (!empty ($successMessage)) : ?>
        <div id="message-success">
            <?php echo $successMessage ?>
        </div>
        <?php elseif (!empty ($failureMessage)): ?>
        <div id="message-failure">
            <?php echo $failureMessage ?>
        </div>
        <?php endif ?>
        
        <div class="feature left">
        
            <form action="" method="POST" class="form left">
                <FIELDSET>

                    <LEGEND class="bLight">College Details</LEGEND>
                    <?php if(!empty ($errorMessage['collegeEntryError'])) {
                        echo "<p><big>{$errorMessage['collegeEntryError']}</p>";
                    } ?>
                    <p>
                        <LABEL for="name">College Name</LABEL>
                        <input type="text" name="name" size="50" tabindex="2" id='name'
                               value="<?php echo empty($_POST['name']) ? '' : $_POST['name'] ?>"/>
                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['name']) ? '' : getErrorMessage($errorMessage['name']) ?>

                    </p>
                    <p>
                        <LABEL for="city">City</LABEL>
                        <input type="text" name="city" size="50" tabindex="2" id="city"
                               value="<?php echo empty($_POST['city']) ? '' : $_POST['city'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['name']) ? '' : getErrorMessage($errorMessage['city']) ?>
                    </p>
                    <p>
                        <LABEL for="state">State</LABEL>
                        <input type="text" name="state" size="50" tabindex="2" id='state'
                               value="<?php echo empty($_POST['state']) ? '' : $_POST['state'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['name']) ? '' : getErrorMessage($errorMessage['state']) ?>
                    </p>
                    <p>
                        <LABEL for="college_type">College Type</LABEL>
                        <?php $results = CRUDOpearion::selectAllCollegeTypes($db) ?>

                        <select name="college_type" tabindex="5">
                            <option value="">- Select college type -</option>

                        <?php if ($results) : foreach($results as $type): ?>
                            <OPTION value='<?php echo $type->college_type ?>'
                                <?php echo (!empty ($_POST['college_type']) && $_POST['college_type'] == $type->college_type) ? 'selected' : '' ?>>
                                    <?php echo $type->college_type ?>
                            </OPTION>
                        <?php endforeach; endif ?>
                        </select>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['college_type']) ? '' : getErrorMessage($errorMessage['college_type']) ?>
                    </p>
                    <p>
                        <LABEL for="school_logo_link">School Logo Link</LABEL>
                        <input type="text" name="school_logo_link" size="50" tabindex="2"
                               value="<?php echo empty($_POST['school_logo_link']) ? '' : $_POST['school_logo_link'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['school_logo_link']) ? '' : getErrorMessage($errorMessage['school_logo_link']) ?>
                    </p>
                    <p>
                        <LABEL for="athletic_logo_link">Athletic Logo Link</LABEL>
                        <input type="text" name="athletic_logo_link" size="50" tabindex="2"
                               value="<?php echo empty($_POST['athletic_logo_link']) ? '' : $_POST['athletic_logo_link'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['name']) ? '' : getErrorMessage($errorMessage['athletic_logo_link']) ?>
                    </p>
                    <p>
                        <LABEL for="division">Division</LABEL>
                        <?php $results = CRUDOpearion::selectAllDivisions($db) ?>
                        <select name="division" tabindex="5">
                            <option value="">- Select a division -</option>
                        <?php if ($results) : foreach($results as $division) : ?>
                            <OPTION value='<?php echo $division->division ?>'
                                <?php echo (!empty ($_POST['division']) && $_POST['division'] == $division->division) ? 'selected' : '' ?>>
                                    <?php echo $division->division ?></OPTION>
                        <?php endforeach; endif ?>
                        </select>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['college_type']) ? '' : getErrorMessage($errorMessage['college_type']) ?>
                    </p>
                    <p>
                        <LABEL for="weather_rating">Weather Rating</LABEL>
                        <?php $results = CRUDOpearion::selectAllWeatherRatings($db) ?>

                        <select name="weather_rating" tabindex="5">
                            <option value="">- Select a weather -</option>
                        <?php
                        if ($results) : foreach($results as $weather): ?>
                            <OPTION value='<?php echo $weather->weather_rating ?>'
                                <?php echo (!empty ($_post['weather_rating']) && $_POST['weather_rating'] == $weather->weather_rating) ? 'selected' : ''?>>
                                    <?php echo $weather->type ?>
                            </OPTION>
                        <?php endforeach; endif ?>
                        </select>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['college_type']) ? '' : getErrorMessage($errorMessage['college_type']) ?>
                    </p>
                    <p>
                        <LABEL for="in_state_tution_fee">In-State Tution Fees</LABEL>
                        <input type="text" name="in_state_tution_fee" size="50" tabindex="2"
                               value="<?php echo empty($_POST['in_state_tution_fee']) ? '' : $_POST['in_state_tution_fee'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['in_state_tution_fee']) ? '' : getErrorMessage($errorMessage['in_state_tution_fee']) ?>
                    </p>
                    <p>
                        <LABEL for="out_state_tution_fee">Out-State Tution Fees</LABEL>
                        <input type="text" name="out_state_tution_fee" size="50" tabindex="2"
                               value="<?php echo empty($_POST['out_state_tution_fee']) ? '' : $_POST['out_state_tution_fee'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['out_state_tution_fee']) ? '' : getErrorMessage($errorMessage['out_state_tution_fee']) ?>
                    </p>
                    <div class="submit-clear">
                        <input type="submit" value="Add" tabindex="37" name="addCollege" /><input type="reset" value="Clear" tabindex="38" />
                    </div>
                </FIELDSET>
            </form>

            <form action="" method="POST" class="form left">

                <FIELDSET>
                    <LEGEND class="bLight">Majors of A College</LEGEND>
                    <?php if(!empty ($errorMessage['collegeMajorError'])) {
                        echo "<p><big>{$errorMessage['collegeMajorError']}</big></p>";
                    } ?>
                    <p>
                        <LABEL for="college_id">College Name</LABEL>
                        <?php $results = CRUDOpearion::selectIdNameOfCollege($db) ?>

                        <select name="college_id" tabindex="5">
                            <option value="">- Select a college -</option>
                        <?php
                        if ($results) : foreach($results as $college) : ?>
                            <OPTION value='<?php echo $college->college_id ?>'
                                <?php echo (!empty ($_POST['college_id']) && $_POST['college_id'] == $college->college_id) ? 'selected' : '' ?>>
                                    <?php echo $college->name ?>
                            </OPTION>
                        <?php endforeach; endif ?>
                        </select>
                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['college_id']) ? '' : getErrorMessage($errorMessage['college_id']) ?>

                    </p>
                    <p>
                        <LABEL for="subject_name">Subject Name</LABEL>
                        <input type="text" name="subject_name" size="50" tabindex="2"
                               value="<?php echo empty($_POST['subject_name']) ? '' : $_POST['subject_name'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['subject_name']) ? '' : getErrorMessage($errorMessage['subject_name']) ?>

                    </p>
                    <div class="submit-clear">
                        <input type="submit" value="Add" tabindex="37" name="addMajor"/><input type="reset" value="Clear" tabindex="38" />
                    </div>
                </FIELDSET>

            </form>
        </div>

        <div class="feature right">

            <form action="" method="POST" class="form right">

                <FIELDSET>
                    <LEGEND class="bLight">Student Enrollment</LEGEND>
                    <?php if(!empty ($errorMessage['studentEnrollmentError'])) {
                        echo "<p><big>{$errorMessage['studentEnrollmentError']}</big></p>";
                    } ?>
                    <p>
                        <LABEL for="college_id2">College Name</LABEL>
                        <?php $results = CRUDOpearion::selectIdNameOfCollege($db) ?>

                            <select name="college_id2" tabindex="5">
                                <OPTION value=''>- Select a college -</OPTION>";
                                <?php
                                if ($results) : foreach($results as $college) : ?>
                                <OPTION value='<?php echo $college->college_id ?>'
                                    <?php echo (!empty ($_POST['college_id2']) && $_POST['college_id2'] == $college->college_id) ? 'selected' : '' ?>>
                                        <?php echo $college->name ?>
                                    </OPTION>
                                <?php endforeach; endif ?>
                            </select>
                            &nbsp;<SPAN class="stars">*</SPAN>
                            <?php echo empty($errorMessage['college_id2']) ? '' : getErrorMessage($errorMessage['college_id2']) ?>

                    </p>
                    <p>
                        <LABEL for="semester">Semester</LABEL>

                            <select name="semester" tabindex="5">
                                <OPTION value=''>- Select a semester -</OPTION>
                                <OPTION value='Summer'
                                    <?php echo (!empty ($_POST['semester']) && $_POST['semester'] == 'Summer') ? 'selected' : '' ?>>
                                    Summer</OPTION>
                                <OPTION value='Fall'
                                    <?php echo (!empty ($_POST['semester']) && $_POST['semester'] == 'Fall') ? 'selected' : '' ?>>
                                    Fall</OPTION>
                                <OPTION value='Winter'
                                    <?php echo (!empty ($_POST['semester']) && $_POST['semester'] == 'Winter') ? 'selected' : '' ?>>
                                    Winter</OPTION>
                                <OPTION value='Spring'
                                    <?php echo (!empty ($_POST['semester']) && $_POST['semester'] == 'Summer') ? 'selected' : '' ?>>
                                    Spring</OPTION>
                            </select>
                            &nbsp;<SPAN class="stars">*</SPAN>
                            <?php echo empty($errorMessage['semester']) ? '' : getErrorMessage($errorMessage['semester']) ?>

                    </p>
                    <p>
                        <LABEL for="year">Year</LABEL>

                            <select name="year" tabindex="5">
                                <option value="">- Select a year -</option>
                            <?php for($year=date('Y');$year>=1970;$year--): ?>
                                <OPTION value='<?php echo $year ?>'
                                    <?php echo (!empty ($_POST['year']) && $_POST['year'] == $year) ? 'selected' : '' ?>>
                                <?php echo $year ?></OPTION>
                            <?php endfor ?>
                            </select>
                            &nbsp;<SPAN class="stars">*</SPAN>
                            <?php echo empty($errorMessage['year']) ? '' : getErrorMessage($errorMessage['year']) ?>

                    </p>
                    <p>
                        <LABEL for="no_of_students">No. of Students</LABEL>

                            <input type="text" name="no_of_students" size="50" tabindex="2"
                                   value="<?php echo empty($_POST['no_of_students']) ? '' : $_POST['no_of_students'] ?>"/>
                            &nbsp;<SPAN class="stars">*</SPAN>
                            <?php echo empty($errorMessage['no_of_students']) ? '' : getErrorMessage($errorMessage['no_of_students']) ?>

                    </p>
                    <div class="submit-clear">
                        <input type="submit" value="Add" tabindex="37" name="addEnrollment" /><input type="reset" value="Clear" tabindex="38" />
                    </div>
                </FIELDSET>
            </form>

            <form action="" method="POST" class="form right">

                <FIELDSET>
                    <LEGEND class="bLight">Sport Name</LEGEND>
                    <p>
                        <LABEL for="sport_name_entry">Sport Name</LABEL>

                        <input type="text" name="sport_name_entry" size="50" tabindex="2"
                               value="<?php echo empty($_POST['sport_name_entry']) ? '' : $_POST['sport_name_entry'] ?>"/>

                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['sport_name_entry']) ? '' : getErrorMessage($errorMessage['sport_name_entry']) ?>

                    </p>
                    <div class="submit-clear">
                        <input type="submit" value="Add" tabindex="37" name="addSportName" /><input type="reset" value="Clear" tabindex="38" />
                    </div>
                </FIELDSET>
            </form>

            <form action="" method="POST" class="form right">
                <FIELDSET>
                    <LEGEND class="bLight">College Sport Details</LEGEND>
                    <?php if(!empty ($errorMessage['collegeSportError'])) {
                        echo "<big>{$errorMessage['collegeSportError']}</big></p>";
                    } ?>

                    <p>
                        <LABEL for="college_id3">College Name</LABEL>
                        <?php $results = CRUDOpearion::selectIdNameOfCollege($db) ?>
                        <select name="college_id3" tabindex="5">
                            <OPTION value=''>- Select a college -</OPTION>
                            <?php
                            if ($results) : foreach($results as $college) : ?>
                                <OPTION value='<?php echo $college->college_id ?>'
                                    <?php echo (!empty ($_POST['college_id3']) && $_POST['college_id3'] == $college->college_id) ? 'selected' : '' ?>>
                                        <?php echo $college->name ?>
                                </OPTION>
                            <?php endforeach; endif ?>
                        </select>
                        
                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['college_id3']) ? '' : getErrorMessage($errorMessage['college_id3']) ?>
                    </p>

                    <p>
                        <LABEL for="sport_name">Sport Name</LABEL>
                        <?php $results = CRUDOpearion::selectAllSportNames($db) ?>
                        <select name="sport_name" id='sport_name' tabindex="5">
                            <OPTION value=''>- Select a sport -</OPTION>
                            <?php if ($results) : foreach($results as $sport_name) : ?>
                            <OPTION value='<?php echo $sport_name->sport_name ?>'
                                <?php echo (!empty ($_POST['sport_name']) && $_POST['sport_name'] == $sport_name->sport_name) ? 'selected' : '' ?>>
                                    <?php echo $sport_name->sport_name ?></OPTION>
                            <?php endforeach; endif ?>
                        </select>
                        
                        &nbsp;<SPAN class="stars">*</SPAN>
                        <?php echo empty($errorMessage['sport_name']) ? '' : getErrorMessage($errorMessage['sport_name']) ?>
                    </p>

                    <div class="submit-clear">
                        <input type="submit" value="Add" tabindex="37" name="addSportOffer" />
                        <input type="reset" value="Clear" tabindex="38" />
                    </div>
                </FIELDSET>
            </form>
        </div>
    </div>
</div>
<?php include_once 'footer.php' ?>