<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateCollegeEntryForm($db, $_POST);
    if($errorMessage === true) {
        $query = "INSERT INTO colleges (name, city, state, college_type, school_logo_link,
            athletic_logo_link, division, weather_rating, in_state_tution_fee, out_state_tution_fee)
            VALUES ('{$_POST['name']}', '{$_POST['city']}', '{$_POST['state']}', '{$_POST['college_type']}',
            '{$_POST['school_logo_link']}', '{$_POST['athletic_logo_link']}', '{$_POST['division']}',
            '{$_POST['weather_rating']}', '{$_POST['in_state_tution_fee']}', '{$_POST['out_state_tution_fee']}')";
        $db->query($query);
        unset($_POST);
    }
}
include_once 'header.php'
?>
<div id="content">
    <div class="feature">
        <form action="" method="POST">
            <fieldset>
                <legend class="bLight red"><span>Your Details</span></legend>
                <table width="100%" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <?php if (!empty($errorMessage['error'])) {
                            echo "<tr><td colspan='2'><span style='font-size: 16px'>{$errorMessage['error']}</span></td></tr>";
                        } ?>
                        <tr>
                            <td><label for="name">College Name</label></td>
                            <td>
                                <input type="text" name="name" id='name' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['name']) ? '' : $_POST['name'] ?>" />
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['name']) ? '' : $errorMessage['name'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="city">City</label></td>
                            <td>
                                <input type="text" id='city' name="city" size="50" tabindex="2"
                                       value="<?php echo empty($_POST['city']) ? '' : $_POST['city'] ?>" />
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['city']) ? '' : $errorMessage['city'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="state">State</label></td>
                            <td>
                                <input type="text" id='state' name="state" size="50" tabindex="2"
                                       value="<?php echo empty($_POST['state']) ? '' : $_POST['state'] ?>" />
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['state']) ? '' : $errorMessage['state'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="college_type">College Type</label></td>
                            <?php
                            $query = "SELECT * FROM college_types";
                            $results = $db->get_results($query);
                            ?>
                            <td>
                                <select name="college_type" id='college_type' tabindex="5">
                                <?php
                                if ($results) {
                                    foreach($results as $type):
                                        echo "<option value='{$type->college_type}'>{$type->college_type}</option>";
                                    endforeach;
                                }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="school_logo_link">School Logo Link</label></td>
                            <td>
                                <input type="text" name="school_logo_link" id='school_logo_link' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['school_logo_link']) ? '' : $_POST['school_logo_link'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['school_logo_link']) ? '' : $errorMessage['school_logo_link'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="athletic_logo_link">Athletic Logo Link</label></td>
                            <td>
                                <input type="text" name="athletic_logo_link" id='athletic_logo_link' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['athletic_logo_link']) ? '' : $_POST['athletic_logo_link'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['athletic_logo_link']) ? '' : $errorMessage['athletic_logo_link'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="division">Division</label></td>
                            <?php
                            $query = "SELECT * FROM divisions";
                            $results = $db->get_results($query);
                            ?>
                            <td>
                                <select name="division" id='division' tabindex="5">
                                <?php
                                if ($results) {
                                    foreach($results as $division):
                                        echo "<option value='{$division->division}'>{$division->division}</option>";
                                    endforeach;
                                }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="weather_rating">Weather Rating</label></td>
                            <?php
                            $query = "SELECT * FROM weather_ratings";
                            $results = $db->get_results($query);
                            ?>
                            <td>
                                <select name="weather_rating" id='weather_rating' tabindex="5">
                                <?php
                                if ($results) {
                                    foreach($results as $weather_rating):
                                        echo "<option value='{$weather_rating->weather_rating}'>{$weather_rating->type}</option>";
                                    endforeach;
                                }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="in_state_tution_fee">In-State Tution Fees</label></td>
                            <td>
                                <input type="text" name="in_state_tution_fee" id='in_state_tution_fee' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['in_state_tution_fee']) ? '' : $_POST['in_state_tution_fee'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['in_state_tution_fee']) ? '' : $errorMessage['in_state_tution_fee'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="out_state_tution_fee">Out-State Tution Fees</label></td>
                            <td>
                                <input type="text" name="out_state_tution_fee" id='out_state_tution_fee' size="50" tabindex="2"
                                       value="<?php echo empty($_POST['out_state_tution_fee']) ? '' : $_POST['out_state_tution_fee'] ?>"/>
                                &nbsp;<span class="stars">*</span>
                                <?php echo empty ($errorMessage['out_state_tution_fee']) ? '' : $errorMessage['out_state_tution_fee'] ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </fieldset>

            <div align="center" style="padding: 25px 0">
                <input type="submit" value="Add" tabindex="37" />
                <input type="reset" value="Clear" tabindex="38" />
            </div>
        </form>
    </div>
</div>
<?php include_once 'footer.php' ?>