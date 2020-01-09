<?php

/**
 * This is a string manipulation class based
 */
class StringManipulation {

    public function manipulatIt($custom_string = null) {

        $fw = fopen("php://stdout", "w");

        if (!empty($custom_string)) {
            $str_uppercase = $this->toUppercase($custom_string);
            fprintf($fw, $str_uppercase . "\n");

            $str_altcase = $this->toAltcase($custom_string);
            fprintf($fw, $str_altcase . "\n");

            $str_csv_file = $this->strToCSV($custom_string);
            if (!empty($str_csv_file)) {
                fprintf($fw, 'CSV created!');
            }
            else {
                fprintf($fw, 'Unexpected Error');
            }
        }
        else {
            fprintf($fw, 'Invalid Action');
        }

        fclose($fw);
    }

    /**
     * THis function will helps to return Upper Case string from user input string.
     * 
     * "strtoupper" is a pre defined function and we utilized here to create as a 
     * new member function as 'toUppercase' under this class.
     * 
     * @param String $custom_string Custom string
     * 
     * @return String Will return Uppercase
     */
    public function toUppercase($custom_string = null) {
        return strtoupper(trim($custom_string));
    }

    /**
     * This function will helps to return Alternative Case string from user input string.
     * 
     * "strtoupper" is a pre defined function and we utilized here to create as a 
     * new member function as 'toUppercase' under this class.
     * 
     * @param String $custom_string Custom string
     * @param Boolean $is_start_with_lowercase [optional] 
     * <p>Starts from lowercase or upper case</p>
     * <p>True => Lower Case</p> 
     * <p>False => Upper Case</p>
     * 
     * @return String Will return alternative case string
     */
    public function toAltcase($custom_string = null, $is_start_with_lowercase = true) {
        $str_lenght = strlen(trim($custom_string));

        /* Convert all string based on user request */
        if ($is_start_with_lowercase === true) {
            $tmp_string = strtolower($custom_string);
        }
        else {
            $tmp_string = strtoupper($custom_string);
        }

        for ($i = 1; $i < $str_lenght; $i += 2) {

            if ($is_start_with_lowercase === true) {
                /* Convert alternative charecters to uppercase when user request as start from lowercase */
                $tmp_string[$i] = strtoupper($tmp_string[$i]);
            }
            else {
                /* Convert alternative charecters to lowercase when user request as start from uppercase */
                $tmp_string[$i] = strtolower($tmp_string[$i]);
            }
        }
        return $tmp_string;
    }

    /**
     * This function will helps to convert string into CSV file.
     * 
     * This function will convert each and every strings into separate CSV column and save into local file in root path
     * 
     * @param String $custom_string Custom string
     * 
     * @return String Will return CSV file name
     */
    public function strToCSV($custom_string = null) {
        /* Split string into array */
        $arr_string = str_split(trim($custom_string));

        /* Convert array to CSV */
        $str_file_name = 'tmp/test_csv_' . time() . '.csv';
        $fp = fopen($str_file_name, 'w');
        fputcsv($fp, $arr_string);
        fclose($fp);

        if (file_exists($str_file_name)) {
            return $str_file_name;
        }
        return false;
    }

}
