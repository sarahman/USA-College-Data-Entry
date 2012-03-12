<?php global $errorMessage, $db ?>

<form action="" method="POST" id='enrollment-add-form'>

    <fieldset>

        <legend class="bLight">Student Enrollment</legend>
        <?php echo getFormError($errorMessage, 'studentEnrollmentError') ?>

        <p>
            <label for="college_id2">College Name</label>
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
            <?php echo getErrorMessage($errorMessage, 'college_id2') ?>
        </p>
        <p>
            <label for="semester">Semester</label>
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
            <?php echo getErrorMessage($errorMessage, 'semester') ?>
        </p>
        <p>
            <label for="year">Year</label>
            <select name="year" id='year' tabindex="5">
                <option value="">- Select a year -</option>
                <?php for($year=date('Y'); $year>=1970; --$year) : ?>
                <option value='<?php echo $year ?>'
                    <?php echo (!empty($_POST['year']) && $_POST['year'] == $year) ? 'selected' : '' ?>>
                <?php echo $year ?></option>
                <?php endfor ?>
            </select>
            <span class="stars">*</span>
            <?php echo getErrorMessage($errorMessage, 'year') ?>
        </p>
        <p>
            <label for="no_of_students">No. of Students</label>
            <input type="text" name="no_of_students" id='no_of_students' size="50" tabindex="2"
                   value="<?php echo getVariableValue($_POST, 'no_of_students') ?>" />
            <span class="stars">*</span>
            <?php echo getErrorMessage($errorMessage, 'no_of_students') ?>
        </p>
        <div class="submit-clear">
            <input type="submit" value="Add" tabindex="37" name="addEnrollment" />
            <input type="reset" value="Clear" tabindex="38" />
        </div>

    </fieldset>

</form>