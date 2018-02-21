<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends Guest_Controller {

    public function index()
    {
        $this->layout->buffer('content', 'guest/reports');
        $this->layout->render('layout_guest');
    }

}

?>