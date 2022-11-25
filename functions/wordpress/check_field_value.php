<?php

	// Check that field has value
    function check_field_value($fields) {
        $exists = true;

        if(!is_array($fields)) {
            $fields = [$fields];
        }

        foreach($fields as $field) {
            if(
                !$field // Field doesn't exists
                || $field == '' // Field is empty string
                || (is_array($field)  && count($field) == 0) // Field is empty array
            ) {
                $exists = false;
                break;
            }
        }

        return $exists;
    }

    function check_array_field($array, $key) {
        $exists = false;

        if(is_array($array) && (is_string($key) || is_numeric($key))) {
            if(array_key_exists($key, $array)) {
                $exists = check_field_value([$array[$key]]);
            }
            else {
                $exists = false;
            }
        }

        return $exists;
    }

?>