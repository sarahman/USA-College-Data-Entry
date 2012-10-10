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

    public static function selectIdNameOfCollege(ezSQL_mysql $db)
    {
        $query = "SELECT college_id, name FROM colleges";
        return $db->get_results($query);
    }
}