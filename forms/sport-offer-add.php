<?php global $errorMessage, $db ?>

<form action="" method="POST" id='sport-offer-add-form'>

    <fieldset>

        <legend class="bLight">College Sport Details</legend>
        <?php echo getFormError($errorMessage, 'collegeSportError') ?>

        <p>
            <label for="college_id3">College Name</label>
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
            <?php echo getErrorMessage($errorMessage, 'college_id3') ?>
        </p>
        <p>
            <label for="sport_name">Sport Name</label>
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
            <?php echo getErrorMessage($errorMessage, 'sport_name') ?>
        </p>
        <div class="submit-clear">
            <input type="submit" value="Add" tabindex="37" name="addSportOffer" />
            <input type="reset" value="Clear" tabindex="38" />
        </div>

    </fieldset>

</form>