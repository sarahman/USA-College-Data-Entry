<?php

class CRUDOperation
{
    public static function insertCollege($db, $data)
    {
        $query = "INSERT INTO colleges (name, city, state, college_type, school_logo_link,
            athletic_logo_link, division, weather_rating, in_state_tuition_fee, out_state_tuition_fee)
            VALUES ('{$data['name']}', '{$data['city']}', '{$data['state']}', '{$data['college_type']}',
            '{$data['school_logo_link']}', '{$data['athletic_logo_link']}', '{$data['division']}',
            '{$data['weather_rating']}', '{$data['in_state_tuition_fee']}', '{$data['out_state_tuition_fee']}')";
        $db->query($query);
    }

    public static function insertMajor($db, $data)
    {
        $query = "INSERT INTO majors (college_id, subject_name)
            VALUES ('{$data['college_id']}', '{$data['subject_name']}')";
        $db->query($query);
    }

    public static function insertSportName($db, $data)
    {
        $query = "INSERT INTO sports_names (sport_name)
            VALUES ('{$data['sport_name_entry']}')";
        $db->query($query);
    }

    public static function insertSportOffer($db, $data)
    {
        $query = "INSERT INTO sports_offers (college_id, sport_name)
            VALUES ('{$data['college_id3']}', '{$data['sport_name']}')";
        $db->query($query);
    }

    public static function insertStudentEnrollment($db, $data)
    {
        $query = "INSERT INTO student_enrollments (college_id, semester, year, no_of_students)
            VALUES ('{$data['college_id2']}', '{$data['semester']}', '{$data['year']}', '{$data['no_of_students']}')";
        $db->query($query);
    }

    public static function selectAllCollegeTypes($db)
    {
        $query = "SELECT * FROM college_types";
        return $db->get_results($query);
    }

    public static function selectAllDivisions($db)
    {
        $query = "SELECT * FROM divisions";
        return $db->get_results($query);
    }

    public static function selectAllWeatherRatings($db)
    {
        $query = "SELECT * FROM weather_ratings";
        return $db->get_results($query);
    }

    public static function selectAllSportNames($db)
    {
        $query = "SELECT * FROM sports_names";
        return $db->get_results($query);
    }

    public static function selectIdNameOfCollege($db)
    {
        $query = "SELECT college_id, name FROM colleges";
        return $db->get_results($query);
    }
}