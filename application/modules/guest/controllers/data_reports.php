<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_Reports extends Guest_Controller {

    public function index()
    {
        $this->layout->buffer('content', 'guest/data_reports');
        $this->layout->render('layout_guest');
    }

}

?>