<?php
$facilitiesTypes = array();

function processCollegeInformation(ezSQL_mysql $db)
{
    set_time_limit(600);
    $colleges = $db->get_results("SELECT * FROM data_storage");
    foreach($colleges as $college) {
        $collegeId = insertCollege($college, $db);
        insertMajorsAccordingToCollege($college, $collegeId, $db);
        insertSportsAccordingToCollege($college, $collegeId, $db);
    }
}

function insertCollege($college, ezSQL_mysql $db)
{
    $query = "INSERT INTO colleges(`name`, `state`, `city`, `college_type`,
        `school_logo_link`, `athletic_logo_link`, `division`, `weather_rating`,
        `in_state_tuition_fee`, `out_state_tuition_fee`, `student_enrollment`) VALUES('" .
            mysql_real_escape_string(trim($college->CollegeName)) . "', '" .
            mysql_real_escape_string(trim($college->State)) . "', '" .
            mysql_real_escape_string(trim($college->City)) . "', '" .
            mysql_real_escape_string(trim($college->CollegeType)) . "', '" .
            mysql_real_escape_string(trim($college->SchoolLogo)) . "', '" .
            mysql_real_escape_string(trim($college->AthleticLogo)) . "', '" .
            mysql_real_escape_string(trim($college->Division)) . "', '" .
            mysql_real_escape_string(trim($college->Weather)) . "', '" .
            mysql_real_escape_string(trim($college->Tuition)) . "', '" .
            mysql_real_escape_string(trim($college->Tuition)) . "', " .
            mysql_real_escape_string(intval($college->SchoolEnrollment)) . ")";
    $db->query($query);
    return $db->insert_id;
}

function insertMajorsAccordingToCollege($college, $collegeId, ezSQL_mysql $db)
{
    $query = "INSERT INTO majors(`college_id`, `subject_name`) VALUES('" .
            mysql_real_escape_string(trim($collegeId)) . "', '" .
            mysql_real_escape_string(strtolower(trim($college->Majors))) . "')";
    $db->query($query);
}

function insertSportsAccordingToCollege($college, $collegeId, ezSQL_mysql $db)
{
    $sportsOffered = explode(',', $college->SportsOffered);
    $sportsOffered = array_unique($sportsOffered);

    foreach ($sportsOffered as $sport) {
        if (!empty($sport)) {

            insertNewSport($sport, $db);

            $query = "INSERT INTO sports_offers(`college_id`, `sport_name`) VALUES('" .
                mysql_real_escape_string(trim($collegeId)) . "', '" .
                mysql_real_escape_string(strtolower(trim($sport))) . "')";
            $db->query($query);
        }
    }
}

function insertNewSport($aSport, ezSQL_mysql $db)
{
    $query = "SELECT * FROM sports_names WHERE sport_name ='" .
                mysql_real_escape_string(strtolower(trim($aSport))) . "'";
    $result = $db->get_results($query);

    if (empty($result)) {
        $query = "INSERT INTO sports_names(`sport_name`) VALUES('" .
                mysql_real_escape_string(strtolower(trim($aSport))) . "')";
        $db->query($query);
    }
}

/************ Main Part **************/
include_once 'connection.php';
$db = getConnection();
processCollegeInformation($db);