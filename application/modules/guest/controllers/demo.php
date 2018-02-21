<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DEMO extends Guest_Controller {

    public function index()
    {
        $this->layout->buffer('content', 'guest/demo');
        $this->layout->render('layout_guest');
    }

}

?>