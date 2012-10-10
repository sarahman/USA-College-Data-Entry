<?php

class Validation
{
    public static function validateCollegeEntryForm(ezSQL_mysql $db, $data)
    {
        $msg = array();

        (!empty($data['name'])) || $msg['name'] = 'Enter a college name.';
        (!empty($data['city'])) || $msg['city'] = 'Enter city name.';
        (!empty($data['state'])) || $msg['state'] = 'Enter state.';
        (!empty($data['college_type'])) || $msg['college_type'] = 'Select college type.';
        (!empty($data['school_logo_link']) || !empty($data['athletic_logo_link']))
            || $msg['school_logo_link'] = 'Enter school (and/or) athletic link.';

        (!empty($data['division'])) || $msg['division'] = 'Select a division.';
        (!empty($data['weather_rating'])) || $msg['weather_rating'] = 'Select weather type.';
        (!empty($data['in_state_tuition_fee'])) ||$msg['in_state_tuition_fee'] = 'Enter in-state tuition fee.';
        (!empty($data['out_state_tuition_fee'])) || $msg['out_state_tuition_fee'] = 'Enter out-state tuition fee.';

        if (!empty($data['name']) && !empty($data['city'])
                && !empty($data['state']) && !empty($data['division'])) {

            $query = "SELECT college_id FROM colleges
                      WHERE `name`='{$data['name']}'
                        AND city='{$data['city']}'
                        AND state='{$data['state']}'
                        AND division='{$data['division']}'";
            $result = $db->get_row($query);
            
            if ($result) {
                $msg['collegeEntryError'] = "{$data['name']} is already inserted.";
            }
        }

        return empty($msg) ? true : $msg;
    }

    public static function validateSportNameEntryForm(ezSQL_mysql $db, $data)
    {
        if (empty($data['sport_name_entry'])) {
            return array('sport_name_entry' => 'Enter sport name.');
        } else {
            $query = "SELECT * FROM sports_names
                      WHERE sport_name='{$data['sport_name_entry']}'";
            $result = $db->get_row($query);
            return empty($result) ? true : array('sportNameEntryError' => 'This sport name is in the database.');
        }
    }

    public static function validateSportOfferEntryForm(ezSQL_mysql $db, $data)
    {
        $msg = array();

        (!empty($data['college_id3'])) || $msg['college_id3'] = 'Select a college.';
        (!empty($data['sport_name'])) || $msg['sport_name'] = 'Enter a sport name.';

        if (!empty($data['college_id3']) && !empty($data['sport_name'])) {

            $query = "SELECT * FROM sports_offers
                      WHERE college_id='{$data['college_id3']}'
                        AND sport_name='{$data['sport_name']}'";
            $result = $db->get_row($query);
            empty($result) || $msg['collegeSportError'] = "{$data['sport_name']} is already in that college.";
        }

        return empty($msg) ? true : $msg;
    }
    public static function validateMajorEntryForm(ezSQL_mysql $db, $data)
    {
        $msg = array();

        (!empty($data['college_id'])) || $msg['college_id'] = 'Select a college.';
        (!empty($data['subject_name'])) || $msg['subject_name'] = 'Enter a subject name.';

        if (!empty($data['college_id']) && !empty($data['subject_name'])) {

            $query = "SELECT * FROM majors
                      WHERE college_id='{$data['college_id']}'
                        AND subject_name='{$data['subject_name']}'";
            $result = $db->get_row($query);
            empty($result) || $msg['collegeMajorError'] = "{$data['subject_name']} is already in that college.";
        }

        return empty($msg) ? true : $msg;
    }

    public static function validateStudentEnrollmentForm(ezSQL_mysql $db, $data)
    {
        $msg = array();

        (!empty($data['college_id2'])) || $msg['college_id2'] = 'Select a college.';
        (!empty($data['semester'])) || $msg['semester'] = 'Select semester name.';
        (!empty($data['year'])) || $msg['year'] = 'Select a year.';
        (!empty($data['no_of_students'])) || $msg['no_of_students'] = 'Enter the number of students.';

        if (!empty($data['college_id2']) && !empty($data['semester']) && !empty($data['year'])) {

            $query = "SELECT * FROM student_enrollments
                      WHERE college_id='{$data['college_id2']}'
                        AND semester='{$data['semester']}'
                        AND `year`='{$data['year']}'";
            $result = $db->get_row($query);
            empty($result) || $msg['studentEnrollmentError'] = "The no of students in the
                    {$data['semester']}-{$data['year']} semester of that <strong>college</strong> is already inserted.";
        }

        return empty($msg) ? true : $msg;
    }

    public static function validateWeatherRatingEntryForm(ezSQL_mysql $db, $data)
    {
        $msg = array();
        if (empty ($data['type'])) {
            $msg['type'] = 'Enter weather type';
        } else {
            $query = "SELECT * FROM weather_ratings WHERE `type`='{$data['type']}'";
            $result = $db->get_row($query);
            if ($result) {
                $msg['type'] = 'This weather type is in the database.';
            } else {
                return true;
            }
        }
        return $msg;
    }

    public static function validateCollegeTypeEntryForm(ezSQL_mysql $db, $data)
    {
        if (empty ($data['college_type'])) {
            return array('college_type' => 'Enter a college type.');
        } else {
            $query = "SELECT * FROM college_types WHERE college_type='{$data['college_type']}'";
            $result = $db->get_row($query);
            return empty ($result) ? true : array('college_type' => 'This college type is in the database.');
        }
    }

    public static function validateDivisionEntryForm(ezSQL_mysql $db, $data)
    {
        if (empty ($data['division'])) {
            return array('division' => 'Enter a division.');
        } else {
            $query = "SELECT * FROM divisions WHERE division='{$data['division']}'";
            $result = $db->get_row($query);
            return empty ($result) ? true : array('division' => 'This division is in the database.');
        }
    }
}