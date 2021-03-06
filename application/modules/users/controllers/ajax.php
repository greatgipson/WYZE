<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends Admin_Controller {

    public $ajax_controller = TRUE;
	
	 public function name_query()
    {
        // Load the model
        $this->load->model('users/mdl_users');

        // Get the post input
        $query = $this->input->post('query');

        $users = $this->mdl_users->select('user_name')->like('user_name', $query)->order_by('user_name')->get(array(), FALSE)->result();

        $response = array();

        foreach ($users as $user)
        {
            $response[] = $user->user_name;
        }

        echo json_encode($response);
    }

    public function save_user_client()
    {
        $user_id     = $this->input->post('user_id');
        $client_name = $this->input->post('client_name');

        $this->load->model('clients/mdl_clients');
        $this->load->model('users/mdl_user_clients');

        $client = $this->mdl_clients->where('client_name', $client_name)->get();

        if ($client->num_rows() == 1)
        {
            $client_id = $client->row()->client_id;

            // Is this a new user or an existing user?
            if ($user_id)
            {
                // Existing user - go ahead and save the entries

                $user_client = $this->mdl_user_clients->where('fi_user_clients.user_id', $user_id)->where('fi_user_clients.client_id', $client_id)->get();

                if (!$user_client->num_rows())
                {
                    $this->mdl_user_clients->save(NULL, array('user_id'   => $user_id, 'client_id' => $client_id));
                }
            }
            else
            {
                // New user - assign the entries to a session variable until user record is saved
                $user_clients = ($this->session->userdata('user_clients')) ? $this->session->userdata('user_clients') : array();

                $user_clients[$client_id] = $client_id;

                $this->session->set_userdata('user_clients', $user_clients);
            }
        }
    }

    public function load_user_client_table()
    {
        if ($session_user_clients = $this->session->userdata('user_clients'))
        {
            $this->load->model('clients/mdl_clients');
            
            $data = array(
                'id'           => NULL,
                'user_clients' => $this->mdl_clients->where_in('fi_clients.client_id', $session_user_clients)->get()->result()
            );
        }
        else
        {
            $this->load->model('users/mdl_user_clients');
            
            $data = array(
                'id'           => $this->input->post('user_id'),
                'user_clients' => $this->mdl_user_clients->where('fi_user_clients.user_id', $this->input->post('user_id'))->get()->result()
            );
        }

        $this->layout->load_view('users/partial_user_client_table', $data);
    }
}

?>