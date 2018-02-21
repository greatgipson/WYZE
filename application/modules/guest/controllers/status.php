<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status extends Guest_Controller {

    public function index()
    {

        $this->layout->buffer('content', 'guest/status');
        $this->layout->render('layout_guest');
    }

}

?>