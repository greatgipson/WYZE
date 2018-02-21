<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Ajax extends Admin_Controller {

    public $ajax_controller = TRUE;

    public function name_query()
    {
        // Load the model
        $this->load->model('client_meters/mdl_client_meters');

        // Get the post input
        $query = $this->input->post('query');

        $client_meters = $this->mdl_client_meters->select('description')->like('description', $query)->order_by('description')->get(array(), FALSE)->result();

        $response = array();

        foreach ($client_meters as $meter)
        {
            $response[] = $meter->description;
        }

        echo json_encode($response);
    }

    public function save_client_note()
    {
        $this->load->model('clients/mdl_client_notes');

        if ($this->mdl_client_notes->run_validation())
        {
            $this->mdl_client_notes->save();

            $response = array(
                'success' => 1
            );
        }
        else
        {
            $this->load->helper('json_error');
            $response = array(
                'success'           => 0,
                'validation_errors' => json_errors()
            );
        }

        echo json_encode($response);
    }

    public function load_client_notes()
    {
        $this->load->model('clients/mdl_client_notes');

        $data = array(
            'client_notes' => $this->mdl_client_notes->where('client_id', $this->input->post('client_id'))->get()->result()
        );

        $this->layout->load_view('clients/partial_notes', $data);
    }

}

?>