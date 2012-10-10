<?php global $errorMessage, $db ?>

<form action="" method="POST" id='major-add-form'>

    <fieldset>

        <legend class="bLight">Majors of A College</legend>
        <?php echo getFormErrorMessage($errorMessage, 'collegeMajorError') ?>

        <p>
            <label for="college_id">College Name</label>
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
        </p>
        <p>
            <label for="subject_name">Subject Name</label>
            <input type="text" name="subject_name" id='subject_name' size="50" tabindex="2"
                   value="<?php echo getVariableValue($_POST, 'subject_name') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'subject_name') ?>
        </p>
        <div class="submit-clear">
            <input type="submit" value="Add" tabindex="37" name="addMajor"/>
            <input type="reset" value="Clear" tabindex="38" />
        </div>

    </fieldset>

</form>