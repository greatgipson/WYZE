<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guest extends Guest_Controller {

    public function index()
    {
        $this->load->model('quotes/mdl_quotes');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('meter_data/mdl_meter_data');

        $this->layout->set(
            array(
				'meter_datas' => $this->mdl_meter_data->add_condition1()->get()->result(),
                'overdue_invoices' => $this->mdl_invoices->get()->result(),
				'open_quotes'      => $this->mdl_quotes->get()->result(),
                'open_invoices'    => $this->mdl_invoices->get()->result()
            )
        );

        $this->layout->buffer('content', 'guest/index');
        $this->layout->render('layout_guest');
    }

}

?>