<?php global $errorMessage, $db ?>

<form action="" method="POST" id='sport-name-add-form'>

    <fieldset>

        <legend class="bLight">Sport Name</legend>
        <?php echo getFormErrorMessage($errorMessage, 'sportNameEntryError') ?>

        <p>
            <label for="sport_name_entry">Sport Name</label>
            <input type="text" name="sport_name_entry" id='sport_name_entry' size="50" tabindex="2"
                   value="<?php echo getVariableValue($_POST, 'sport_name_entry') ?>" />
            <span class="stars">*</span>
            <?php echo getFieldErrorMessage($errorMessage, 'sport_name_entry') ?>
        </p>
        <div class="submit-clear">
            <input type="submit" value="Add" tabindex="37" name="addSportName" />
            <input type="reset" value="Clear" tabindex="38" />
        </div>

    </fieldset>

</form>