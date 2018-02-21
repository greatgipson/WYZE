<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mdl_Tariff extends Response_Model {

	public $table = 'fi_tariff';
	public $primary_key = 'fi_tariff.tariff_id';

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_tariff.*,fi_council.council_name', FALSE);
        //$this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
    }

	public function default_order_by()
	{
		//$this->db->order_by('fi_tariff.council_id');
	}

	 public function default_join()
	{
        $this->db->join('fi_council', 'fi_council.id = fi_tariff.council_id');
    }

	public function validation_rules()
	{
		return array(
			'council_id' => array(
				'field' => 'council_id',
				'label' => lang('council_id'),
				'rules' => 'required'
			)
		);
	}
}

?>