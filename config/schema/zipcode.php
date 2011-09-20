<?php
/* Zipcode schema generated on: 2011-09-13 11:13:32 : 1315880012*/
class ZipcodeSchema extends CakeSchema {
	var $name = 'Zipcode';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $zipcodes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'jis' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'zip_old' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'pref_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'zip' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'addr1_kana' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'addr2_kana' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'addr3_kana' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'addr1' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'addr2' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'addr3' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'c1' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'c2' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'c3' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'c4' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'c5' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'c6' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
}