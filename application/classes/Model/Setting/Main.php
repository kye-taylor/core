<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Setting_Main extends ORM {

    protected $_db_group = 'sys';
    protected $_table_name = 'setting';
    protected $_primary_key = 'id';
    protected $_table_columns = array(
        'id' => array('data_type' => 'bigint'),
        'area' => array('data_type' => 'string'),
        'section' => array('data_type' => 'string'),
        'key' => array('data_type' => 'string'),
        'type' => array('data_type' => 'string'),
        'value' => array('data_type' => 'string'),
    );
    // fields mentioned here can be accessed like properties, but will not be referenced in write operations
    protected $_ignored_columns = array(
    );
    // Belongs to relationships
    protected $_belongs_to = array();
    // Has man relationships
    protected $_has_many = array(
    );
    // Has one relationship
    protected $_has_one = array();

    // Validation rules
    public function rules() {
        return array(
            'area' => array(
                array('not_empty'),
            ),
            'section' => array(
                array('not_empty'),
            ),
            'key' => array(
                array('not_empty'),
            ),
            'type' => array(
                array('not_empty'),
            ),
            'value' => array(
                array('not_empty'),
            ),
        );
    }

    // Data filters
    public function filters() {
        return array(
        );
    }

    /**
     * To quickly load a setting, this function can be called.
     * 
     * @param string $area The area value.
     * @param string $section The section (controller)
     * @param string $key The individual key
     * @return void
     */
    public function quickLoad($area, $section, $key) {
        $find = ORM::factory("Setting")->where("area", "=", $area)->where("section", "=", $section)->where("key", "=", $key)->find();

        if ($find->loaded()) {
            $this->__construct($find->id);
        }
    }

    /**
     * Get a value of a propery.
     * 
     * @param string $area The area value.
     * @param string $section The section (controller)
     * @param string $key The individual key
     * @return string The value.
     */
    public function getValue($area, $section = null, $key = null) {
        if ($section == null || $key == null) {
            $area = explode(".", $area);
            $key = Arr::get($area, 2, "");
            $section = Arr::get($area, 1, "");
            $area = Arr::get($area, 0, "");
        }
        $this->quickLoad($area, $section, $key);
        return ($this->loaded()) ? $this->value : "";
    }

}

?>