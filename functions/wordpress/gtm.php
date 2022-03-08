<?php

	// Check that field has value
    function check_field_value($fields) {
        $exists = true;
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

?>