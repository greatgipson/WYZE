<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * FusionInvoice
 *
 * A free and open source web based invoicing system
 *
 * @package		FusionInvoice
 * @author		Jesse Terry
 * @copyright	Copyright (c) 2012 - 2013 FusionInvoice, LLC
 * @license		http://www.fusioninvoice.com/license.txt
 * @link		http://www.fusioninvoice.com
 *
 */

class Mdl_Tariff_Type extends Response_Model {

	public $table = 'fi_tariff';
	public $primary_key = 'fi_tariff.tariff_id';


	 public function tariff_kva_non_tou_types()
		{
			return array(
				1 => lang('tariff_kva_non_tou_value_1'),
				2 => lang('tariff_kva_non_tou_value_2'),
				3 => lang('tariff_kva_non_tou_value_3'),
				4 => lang('tariff_kva_non_tou_value_4'),
				5 => lang('tariff_kva_non_tou_value_5'),
				6 => lang('tariff_kva_non_tou_value_6'),
				7 => lang('tariff_kva_non_tou_value_7'),
				8 => lang('tariff_kva_tou_value_1'),
				9 => lang('tariff_kva_tou_value_2'),
				10 => lang('tariff_kva_tou_value_3'),
				11 => lang('tariff_kva_tou_value_4'),
				12 => lang('tariff_kva_tou_value_5')
			);
    }

	 public function tariff_kva_tou_types()
		{
			return array(
				'1' => lang('tariff_kva_tou_value_1'),
				'2' => lang('tariff_kva_tou_value_2'),
				'3' => lang('tariff_kva_tou_value_3'),
				'4' => lang('tariff_kva_tou_value_4'),
				'5' => lang('tariff_kva_tou_value_5')
			);
    }

	 public function tou_types()
		{
			return array(
				1 => lang('tou_type_value_1'),
				2 => lang('tou_type_value_2')
			);
    }

	 public function season_types()
		{
			return array(
				1 => lang('season_type_value_1'),
				2 => lang('season_type_value_2')
			);
    }


    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_tariff.*,fi_council.council_name', FALSE);
        //$this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_tariff.council_id');
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
			),
			'tariff_name' => array(
				'field' => 'tariff_name',
				'label' => lang('tariff_name'),
				'rules' => 'required'
			),
			'tariff_kva_type_id' => array(
				'field' => 'tariff_kva_type_id',
				'label' => lang('tariff_kva_type'),
				'rules' => 'required'
			),
			'tou_type_id' => array(
				'field' => 'tou_type_id',
				'label' => lang('tou_type_id'),
				'rules' => 'required'
			),
			'season_type_id' => array(
				'field' => 'season_type_id',
				'label' => lang('season_type_id'),
				'rules' => 'required'
			)
		);
	}
}

?>