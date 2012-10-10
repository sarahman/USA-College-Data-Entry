<?php
include_once 'connection.php';

$db = getConnection();
if (!empty ($_POST)) {
    include_once 'Validation.php';
    $errorMessage = Validation::validateSportOfferEntryForm($db, $_POST);
    if($errorMessage === true) {
        $query = "INSERT INTO sports_offers (college_id, sport_name)
            VALUES ('{$_POST['college_id']}', '{$_POST['sport_name']}')";
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
                <legend class="bLight">Your Details</legend>
                <table width="100%" cellpadding="0" cellspacing="2" border="0">
                    <tbody>
                        <?php if(!empty ($errorMessage['error'])) {
                            echo "<tr><td colspan='2'><span style='font-size: 16px'>{$errorMessage['error']}</span></td></tr>";
                        } ?>
                        <tr>
                            <td><label for="college_id">College Name</label></td>
                            <?php
                            $query = "SELECT college_id, name FROM colleges";
                            $results = $db->get_results($query);
                            ?>
                            <td>
                                <select name="college_id" id='college_id' tabindex="5">
                                    <option value=''></option>
                                    <?php
                                    if ($results) {
                                        foreach($results as $college):
                                            echo "<option value='{$college->college_id}'>{$college->name}</option>";
                                        endforeach;
                                    }?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="sport_name">Sport Name</label></td>
                            <?php
                            $query = "SELECT * FROM sports_names";
                            $results = $db->get_results($query);
                            ?>
                            <td>
                                <select name="sport_name" id='sport_name' tabindex="5">
                                    <option value=''></option>
                                    <?php
                                    if ($results) {
                                        foreach($results as $sport_name):
                                            echo "<option value='{$sport_name->sport_name}'>{$sport_name->sport_name}</option>";
                                        endforeach;
                                    }?>
                                </select>
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

        <?php
        $query = "SELECT C.name, S.sport_name FROM sports_offers S JOIN colleges C ON S.college_id = c.college_id ";
        $results = $db->get_results($query);
        if ($results){
            $columnGroup = 2;
            echo "<table style='100%'>
            <tr>
                <th style='width: 30% !important;'>College</th>
                <th style='width: 20% !important;'>Sports</th>
                <th style='width: 30% !important;'>College</th>
                <th style='width: 20% !important;'>Sports</th>
            </tr>";
            $count = 0;
            foreach ($results as $sportOffer) {
                if ($count % $columnGroup == 0) {
                    echo "<tr>";
                }
                echo "<td>{$sportOffer->name}</td><td>{$sportOffer->sport_name}</td>";
                if (++$count % $columnGroup == 0) {
                    echo '</tr>';
                }
            }
            if (++$count % $columnGroup == 0) {
                echo '</tr>';
            }
            echo '</table>';
        }
        ?>

    </div>
</div>
<?php include_once 'footer.php' ?>