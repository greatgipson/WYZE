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

class Mdl_Council extends Response_Model {

	public $table = 'fi_council';
	public $primary_key = 'fi_council.id';

	 public function surcharges()
	{
		return array(
			'0' => lang('surcharge_0'),
			'1' => lang('surcharge_1'),
			'2' => lang('surcharge_2'),
			'3' => lang('surcharge_3'),
			'4' => lang('surcharge_4'),
			'5' => lang('surcharge_5')
		);
    }

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS *', FALSE);
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_council.council_name');
	}

	public function validation_rules()
	{
		return array(
			'council_name' => array(
				'field' => 'council_name',
				'label' => lang('council_name'),
				'rules' => 'required'
			),
			'surcharge' => array(
				'field' => 'surcharge',
				'label' => lang('surcharge'),
				'rules' => 'required'
			)
		);
	}
}

?>