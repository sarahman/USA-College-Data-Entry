<?php

class Validation
{
    public static function validateCollegeEntryForm($db, $data)
    {
        $msg = array();

        if(empty ($data['name'])) {
            $msg['name'] = 'Enter a college name.';
        }

        if (empty ($data['city'])) {
            $msg['city'] = 'Enter city name.';
        }

        if (empty ($data['state'])) {
            $msg['state'] = 'Enter state.';
        }

        if (empty ($data['college_type'])) {
            $msg['college_type'] = 'Select college type.';
        }
        
        if (empty ($data['school_logo_link'])) {
            if (empty ($data['athletic_logo_link'])) {
                $msg['school_logo_link'] = 'Enter school (and/or) athlecic link.';
            }
        }

        if (empty ($data['division'])) {
            $msg['division'] = 'Select a division.';
        }

        if (empty ($data['weather_rating'])) {
            $msg['weather_rating'] = 'Select weather type.';
        }

        if (empty ($data['in_state_tution_fee'])) {
            $msg['in_state_tution_fee'] = 'Enter in-state tution fee.';
        }

        if (empty ($data['out_state_tution_fee'])) {
            $msg['out_state_tution_fee'] = 'Select out-state tution fee.';
        }

        if (!empty ($data['name']) && !empty ($data['city'])
                && !empty ($data['state']) && !empty ($data['division'])) {

            $query = "SELECT college_id FROM colleges
                WHERE name='{$data['name']}'
                AND city='{$data['city']}'
                AND state='{$data['state']}'
                AND division='{$data['division']}'";
            $result = $db->get_results($query);
            
            if ($result[0]) {
                $msg['collegeEntryError'] = "<b>{$data['name']}</b> is already inserted.";
            }
        }

        return empty ($msg)? true : $msg;
    }

    public static function validateSportNameEntryForm($db, $data)
    {
        if(empty ($data['sport_name_entry'])) {
            return array('sport_name_entry' => 'Please enter sport name.');
        } else {
            $query = "SELECT * FROM sports_names where sport_name='{$data['sport_name_entry']}'";
            $result = $db->get_results($query);
            return empty ($result[0]) ? true : array('sport_name_entry' => 'This sport name is in the database.');
        }
    }

    public static function validateSportOfferEntryForm($db, $data)
    {
        $msg = array();

        if(empty ($data['college_id3'])) {
            $msg['college_id3'] = 'Select a college.';
        }

        if (empty ($data['sport_name'])) {
            $msg['sport_name'] = 'Select a sport name.';
        }

        if (!empty ($data['college_id3']) && !empty ($data['sport_name'])) {

            $query = "SELECT * FROM sports_offers WHERE college_id='{$data['college_id3']}' AND sport_name='{$data['sport_name']}'";
            $result = $db->get_results($query);
            if ($result[0]) {
                $msg['collegeSportError'] = "<b>{$data['sport_name']}</b> is already in that college.";
            }
        }

        return empty ($msg)? true : $msg;
    }
    public static function validateMajorEntryForm($db, $data)
    {
        $msg = array();

        if(empty ($data['college_id'])) {
            $msg['college_id'] = 'Select a college.';
        }

        if (empty ($data['subject_name'])) {
            $msg['subject_name'] = 'Select a subject name.';
        }

        if (!empty ($data['college_id']) && !empty ($data['subject_name'])) {

            $query = "SELECT * FROM majors WHERE college_id='{$data['college_id']}' AND subject_name='{$data['subject_name']}'";
            $result = $db->get_results($query);
            if ($result[0]) {
                $msg['collegeMajorError'] = "<b>{$data['subject_name']}</b> is already in that college.";
            }
        }

        return empty ($msg)? true : $msg;
    }

    public static function validateStudentEnrollmentForm($db, $data)
    {
        $msg = array();

        if(empty ($data['college_id2'])) {
            $msg['college_id2'] = 'Select a college.';
        }

        if (empty ($data['semester'])) {
            $msg['semester'] = 'Select semester name.';
        }

        if (empty ($data['year'])) {
            $msg['year'] = 'Select a year.';
        }

        if (empty ($data['no_of_students'])) {
            $msg['no_of_students'] = 'Enter the number of students.';
        }

        if (!empty ($data['college_id2']) && !empty ($data['semester']) && !empty ($data['year'])) {

            $query = "SELECT * FROM student_enrollments
                WHERE college_id='{$data['college_id2']}'
                AND semester='{$data['semester']}'
                AND year='{$data['year']}'";
            $result = $db->get_results($query);
            if ($result[0]) {
                $msg['studentEnrollmentError'] = "The no of students in the
                    <b>{$data['semester']}-{$data['year']}</b> semester of that <strong>college</strong> is already inserted.";
            }
        }

        return empty ($msg)? true : $msg;
    }
}