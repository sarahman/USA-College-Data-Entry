<?php global $errorMessage, $db ?>

<form action="" method="POST" id='college-add-form'>

    <fieldset>

        <legend class="bLight">College Details</legend>
        <?php echo getFormErrorMessage($errorMessage, 'collegeEntryError') ?>

        <p>
            <label for="name">College Name</label>
            <input type="text" name="name" size="50" tabindex="2" id='name'
                   value="<?php echo getVariableValue($_POST, 'name') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'name') ?>
        </p>
        <p>
            <label for="city">City</label>
            <input type="text" name="city" size="50" tabindex="2" id="city"
                   value="<?php echo getVariableValue($_POST, 'city') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'city') ?>
        </p>
        <p>
            <label for="state">State</label>
            <input type="text" name="state" size="50" tabindex="2" id='state'
                   value="<?php echo getVariableValue($_POST, 'state') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'state') ?>
        </p>
        <p>
            <label for="college_type">College Type</label>
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
        </p>
        <p>
            <label for="school_logo_link">School Logo Link</label>
            <input type="text" name="school_logo_link" id='school_logo_link' size="50" tabindex="2"
                   value="<?php echo getVariableValue($_POST, 'school_logo_link') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'school_logo_link') ?>
        </p>
        <p>
            <label for="athletic_logo_link">Athletic Logo Link</label>
            <input type="text" name="athletic_logo_link" id='athletic_logo_link' size="50" tabindex="2"
                   value="<?php echo empty($_POST['athletic_logo_link']) ? '' : $_POST['athletic_logo_link'] ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'athletic_logo_link') ?>
        </p>
        <p>
            <label for="division">Division</label>
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
        </p>
        <p>
            <label for="weather_rating">Weather Rating</label>
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
        </p>
        <p>
            <label for="in_state_tuition_fee">In-State tuition Fees</label>
            <input type="text" name="in_state_tuition_fee" size="50" id='in_state_tuition_fee' tabindex="2"
                   value="<?php echo getVariableValue($_POST, 'in_state_tuition_fee') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'in_state_tuition_fee') ?>
        </p>
        <p>
            <label for="out_state_tuition_fee">Out-State tuition Fees</label>
            <input type="text" name="out_state_tuition_fee" id='out_state_tuition_fee' size="50" tabindex="2"
                   value="<?php echo getVariableValue($_POST, 'out_state_tuition_fee') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'out_state_tuition_fee') ?>
        </p>
        <div class="submit-clear">
            <input type="submit" value="Add" tabindex="37" name="addCollege" />
            <input type="reset" value="Clear" tabindex="38" />
        </div>

    </fieldset>

</form>