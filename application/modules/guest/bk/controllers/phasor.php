<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Phasor extends Guest_Controller {

    public function index()
    {
        $this->load->model('meter_data/mdl_meter_data');

        $this->layout->set(
            array(
				//'meter_datas' => $this->mdl_meter_data->get()->result()
            )
        );

        $this->layout->buffer('content', 'guest/phasor');
        $this->layout->render('layout_guest');
    }

}

?>