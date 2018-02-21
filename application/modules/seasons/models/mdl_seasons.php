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

class Mdl_Seasons extends Response_Model {

	public $table = 'fi_seasons';
	public $primary_key = 'fi_seasons.id';


	 public function months()
	{
		return array(
			'1' => lang('month_1'),
			'2' => lang('month_2'),
			'3' => lang('month_3'),
			'4' => lang('month_4'),
			'5' => lang('month_5'),
			'6' => lang('month_6'),
			'7' => lang('month_7'),
			'8' => lang('month_8'),
			'9' => lang('month_9'),
			'10' => lang('month_10'),
			'11' => lang('month_11'),
			'12' => lang('month_12')
		);
    }

	 public function season_types()
	{
		return array(
			'1' => lang('season_type_1'),
			'2' => lang('season_type_2')
		);
    }

	 public function season_years()
	{
		return array(
			0=>"N/A",
			date("Y")-1 => date("Y")-1,
			date("Y") => date("Y"),
			date("Y")+1 => date("Y")+1,
			date("Y")+2 => date("Y")+2

		);
    }

    public function default_select()
    {
        $this->db->select('SQL_CALC_FOUND_ROWS fi_seasons.*,fi_council.council_name', FALSE);
    }

	public function default_order_by()
	{
		$this->db->order_by('fi_seasons.council_id');
	}


	 public function default_join()
	{
        $this->db->join('fi_council', 'fi_council.id = fi_seasons.council_id');
    }

	public function validation_rules()
	{
		return array(
			'council_id' => array(
				'field' => 'council_id',
				'label' => lang('council_id'),
				'rules' => 'required'
			),
			'season_type' => array(
				'field' => 'season_type',
				'label' => lang('season_type'),
				'rules' => 'required'
			),
			'month' => array(
				'field' => 'month',
				'label' => lang('month'),
				'rules' => 'required'
			),
			'year' => array(
				'field' => 'year',
				'label' => lang('season_year'),
				'rules' => 'required'
			)
		);
	}
}

?>