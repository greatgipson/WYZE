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

class Mdl_Meter_Data extends Response_Model {

	public $table = 'fi_meter_data';
	public $primary_key = 'fi_meter_data.id';

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_meter_data.meternum,fi_meter_data.dates, ((fi_meter_data.activewh/1000)*2) as column1 ,(fi_meter_data.activevarh/1000) as column2', FALSE);
 		$this->db->where('fi_meter_data.dates >=', date('2015-05-29 00:30:00'));
 		$this->db->where('fi_meter_data.dates <=', date('2015-05-30 00:29:00'));
 		$this->db->where('fi_meter_data.meternum ', '213324817');
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_meter_data.dates');
	}


	 public function default_join()
	{
        //$this->db->join('fi_council', 'fi_council.id = fi_tariff.council_id');
    }

	public function validation_rules()
	{
		return array(
			'dates' => array(
				'field' => 'dates',
				'label' => lang('dates'),
				'rules' => ''
			),
			'activewh' => array(
				'field' => 'activewh',
				'label' => lang('activewh'),
				'rules' => ''
			),
			'activevarh' => array(
				'field' => 'activevarh',
				'label' => lang('activevarh'),
				'rules' => ''
			),
			'activeva' => array(
				'field' => 'activeva',
				'label' => lang('activeva'),
				'rules' => ''
			),
			'stats' => array(
				'field' => 'stats',
				'label' => lang('stats'),
				'rules' => ''
			),
			'meternum' => array(
				'field' => 'meternum',
				'label' => lang('meternum'),
				'rules' => ''
			)
		);
	}
}

?>