<?php

class CRUDOperation
{
    public static function insertCollege(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO colleges (name, city, state, college_type, school_logo_link,
            athletic_logo_link, division, weather_rating, in_state_tuition_fee, out_state_tuition_fee)
            VALUES ('{$data['name']}', '{$data['city']}', '{$data['state']}', '{$data['college_type']}',
            '{$data['school_logo_link']}', '{$data['athletic_logo_link']}', '{$data['division']}',
            '{$data['weather_rating']}', '{$data['in_state_tuition_fee']}', '{$data['out_state_tuition_fee']}')";
        $db->query($query);
    }

    public static function insertCollegeType(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO college_types (college_type) VALUES ('{$data['college_type']}')";
        $db->query($query);
    }

    public static function insertMajor(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO majors (college_id, subject_name)
            VALUES ('{$data['college_id']}', '{$data['subject_name']}')";
        $db->query($query);
    }

    public static function insertSportName(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO sports_names (sport_name)
            VALUES ('{$data['sport_name_entry']}')";
        $db->query($query);
    }

    public static function insertSportOffer(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO sports_offers (college_id, sport_name)
            VALUES ('{$data['college_id3']}', '{$data['sport_name']}')";
        $db->query($query);
    }

    public static function insertStudentEnrollment(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO student_enrollments (college_id, semester, year, no_of_students)
            VALUES ('{$data['college_id2']}', '{$data['semester']}', '{$data['year']}', '{$data['no_of_students']}')";
        $db->query($query);
    }

    public static function insertCollegeDivision(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO divisions (division) VALUES ('{$data['division']}')";
        $db->query($query);
    }

    public static function insertWeatherType(ezSQL_mysql $db, $data)
    {
        $query = "INSERT INTO weather_ratings (`type`) VALUES ('{$data['type']}')";
        $db->query($query);
    }

    public static function selectAllCollegeTypes(ezSQL_mysql $db)
    {
        $query = "SELECT * FROM college_types";
        return $db->get_results($query);
    }

    public static function selectAllDivisions(ezSQL_mysql $db)
    {
        $query = "SELECT * FROM divisions";
        return $db->get_results($query);
    }

    public static function selectAllWeatherRatings(ezSQL_mysql $db)
    {
        $query = "SELECT * FROM weather_ratings";
        return $db->get_results($query);
    }

    public static function selectAllSportNames(ezSQL_mysql $db)
    {
        $query = "SELECT * FROM sports_names";
        return $db->get_results($query);
    }

    public static function selectAllSportNamesOfColleges(ezSQL_mysql $db)
    {
        $query = "SELECT C.name, S.sport_name FROM sports_offers S JOIN colleges C ON S.college_id = c.college_id";
        return $db->get_results($query);
    }

    public static function selectIdNameOfCollege(ezSQL_mysql $db)
    {
        $query = "SELECT college_id, name FROM colleges";
        return $db->get_results($query);
    }

    public static function checkCollegeExisted(ezSQL_mysql $db, $data)
    {
        $query = "SELECT college_id FROM colleges
                  WHERE `name`='{$data['name']}'
                    AND city='{$data['city']}'
                    AND state='{$data['state']}'
                    AND division='{$data['division']}'";

        return $db->get_row($query);
    }

    public static function checkSportNameExisted(ezSQL_mysql $db, $data)
    {
        $query = "SELECT * FROM sports_names
                  WHERE sport_name='{$data['sport_name_entry']}'";
        return $db->get_row($query);
    }

    public static function checkSportOfferExistedInCollege(ezSQL_mysql $db, $data)
    {
        $query = "SELECT * FROM sports_offers
                  WHERE college_id='{$data['college_id3']}'
                    AND sport_name='{$data['sport_name']}'";
        return $db->get_row($query);
    }

    public static function checkMajorExistedInCollege(ezSQL_mysql $db, $data)
    {
        $query = "SELECT * FROM majors
                  WHERE college_id='{$data['college_id']}'
                    AND subject_name='{$data['subject_name']}'";
        return $db->get_row($query);
    }

    public static function checkEnrollmentExistedInParticularSemesterInACollege(ezSQL_mysql $db, $data)
    {
        $query = "SELECT * FROM student_enrollments
                  WHERE college_id='{$data['college_id2']}'
                    AND semester='{$data['semester']}'
                    AND `year`='{$data['year']}'";
        return $db->get_row($query);
    }

    public static function checkWeatherTypeExisted(ezSQL_mysql $db, $data)
    {
        $query = "SELECT * FROM weather_ratings WHERE `type`='{$data['type']}'";
        return $db->get_row($query);
    }

    public static function checkCollegeTypeExisted(ezSQL_mysql $db, $data)
    {
        $query = "SELECT * FROM college_types WHERE college_type='{$data['college_type']}'";
        return $db->get_row($query);
    }

    public static function checkCollegeDivisionExisted(ezSQL_mysql $db, $data)
    {
        $query = "SELECT * FROM divisions WHERE division='{$data['division']}'";
        return $db->get_row($query);
    }
}