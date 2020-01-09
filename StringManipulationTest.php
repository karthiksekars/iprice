<?php

use PHPUnit\Framework\TestCase;

require_once 'StringManipulation.php';

class StringManipulationTest extends TestCase {

    private $obj_strmanipulation;

    protected function setUp(): void {
        $this->obj_strmanipulation = new StringManipulation();
    }

    protected function tearDown(): void {
        $this->obj_strmanipulation = NULL;
    }

    /*
     * Test case for Upper case
     */

    public function uppercaseDataProvider() {
        return array(
            array('hello world', 'HELLO WORLD'),
            array('welcome to all', 'WELCOME TO ALL'),
        );
    }

    /**
     * @dataProvider uppercaseDataProvider
     */
    public function testtoUppercase($custom_string, $expected) {
        $result = $this->obj_strmanipulation->toUppercase($custom_string);
        $this->assertEquals($expected, $result);
    }

    /*
     * Test case for Alternative case
     */
    public function altcaseDataProvider() {
        return array(
            array('hello world', true, 'hElLo wOrLd'),
            array('hello world', false, 'HeLlO WoRlD'),
            array('welcome to all', true, 'wElCoMe tO AlL'),
            array('welcome to all', false, 'WeLcOmE To aLl'),
        );
    }

    /**
     * @dataProvider altcaseDataProvider
     */
    public function testtoAltcase($custom_string, $is_start_with_lowercase, $expected) {
        $result = $this->obj_strmanipulation->toAltcase($custom_string, $is_start_with_lowercase);
        $this->assertEquals($expected, $result);
    }

    public function strtocsvDataProvider() {
        return array(
            array('hello world', str_split('hello world')),
            array('welcome to all', str_split('welcome to all')),
        );
    }

    /**
     * @dataProvider strtocsvDataProvider
     */
    public function teststrToCSV($custom_string, $expected) {
        $str_file_name = $this->obj_strmanipulation->strToCSV($custom_string);
        $result = null;
        if (file_exists($str_file_name)) {
            /* Read CSV file based on file name and return as array */
            $arr_csv_content = array_map('str_getcsv', file($str_file_name));
            $result = $arr_csv_content[0] ?? null;
        }
        $this->assertSame($expected, $result);
    }

}
