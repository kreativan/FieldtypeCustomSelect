<?php
/**
 *  FieldtypeCustomSelect
 *
 *  @author Ivan Milincic <kreativan@outlook.com>
 *  @copyright 2019 Kreativan
 *
 *
*/

class FieldtypeCustomSelect extends Fieldtype {

	public static $defaultOptionValues = array();

	public static function getModuleInfo() {
		return array(
		'title' => 'Custom Select',
		'version' => 100,
		'summary' => 'Custom Select Fieldtype'
		);
	}

	public function getInputfield(Page $page, Field $fields) {

		$inputfield = $this->modules->get('InputfieldSelect');

		$options = ["value" => "Label"];

		foreach($options as $value => $label) {

			$value = trim($value);
			$label = !empty($label) ? $label : $value;

			$inputfield->addOption($value, $label);

		}

		return $inputfield;

	}

	public function getDatabaseSchema(Field $field) {
		$schema = parent::getDatabaseSchema($field);
		$schema['data'] = 'text NOT NULL';
		$schema['keys']['data_exact'] = 'KEY `data_exact` (`data`(255))';
		$schema['keys']['data'] = 'FULLTEXT KEY `data` (`data`)';

		return $schema;
	}

	public function sanitizeValue(Page $page, Field $field, $value) {
		return $value;
	}


}
