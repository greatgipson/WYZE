<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Invoices extends Guest_Controller {

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
                'open_invoices'    => $this->mdl_invoices->get()->result(),
                'invoice_statuses' => $this->mdl_invoices->statuses()
            )
        );

        $this->layout->buffer('content', 'guest/invoices_index');
        $this->layout->render('layout_guest');
    }

 public function view($invoice_id)
    {
        $this->load->model('invoices/mdl_items');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('invoices/mdl_invoice_tax_rates');
        $invoice = $this->mdl_invoices->where('fi_invoices.invoice_id',$invoice_id)->where_in('fi_invoices.client_id',$this->user_clients)->get()->row();

        if (!$invoice)
        {
            show_404();
        }

        $this->mdl_invoices->mark_viewed($invoice->invoice_id);

        $this->layout->set(
            array(
                'invoice'           => $invoice,
                'items'             => $this->mdl_items->where('invoice_id', $invoice_id)->get()->result(),
                'invoice_tax_rates' => $this->mdl_invoice_tax_rates->where('invoice_id', $invoice_id)->get()->result(),
                'invoice_id'        => $invoice_id
            )
        );

        $this->layout->buffer(
            array(
                array('content', 'guest/invoices_view')
            )
        );

        $this->layout->render('layout_guest');
    }


public function edit($invoice_id)
    {
        $this->load->model('invoices/mdl_items');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('invoices/mdl_invoice_tax_rates');
        $this->load->model('tax_rates/mdl_tax_rates');

        $invoice = $this->mdl_invoices->where('fi_invoices.invoice_id',$invoice_id)->where_in('fi_invoices.client_id',$this->user_clients)->get()->row();

        if (!$invoice)
        {
            show_404();
        }

        $this->mdl_invoices->mark_viewed($invoice->invoice_id);

        $this->layout->set(
            array(
                'invoice'           => $invoice,
                'items'             => $this->mdl_items->where('invoice_id', $invoice_id)->get()->result(),
                'invoice_tax_rates' => $this->mdl_invoice_tax_rates->where('invoice_id', $invoice_id)->get()->result(),
                'invoice_id'        => $invoice_id,
                'invoice_statuses' 	=> $this->mdl_invoices->statuses(),
                'tax_rates'      => $this->mdl_tax_rates->get()->result()
            )
        );

        $this->layout->buffer(
            array(
                array('content', 'guest/edit_view')
            )
        );

        $this->layout->render('layout_guest');
    }

    public function save()
    {
        $this->load->model('invoices/mdl_items');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('item_lookups/mdl_item_lookups');
        $this->load->model('invoices/mdl_invoice_tax_rates');

        $invoice_id = $this->input->post('invoice_id');

        $this->mdl_invoices->set_id($invoice_id);

        if ($this->mdl_invoices->run_validation('validation_rules_save_invoice'))
        {
            $items = json_decode($this->input->post('items'));

            foreach ($items as $item)
            {
                if ($item->item_name)
                {
                    $item->item_quantity = ($item->item_quantity);
                    $item->item_price    = ($item->item_price);

                    $item_id = ($item->item_id) ? : NULL;

                    $save_item_as_lookup = (isset($item->save_item_as_lookup)) ? $item->save_item_as_lookup : 0;

                    unset($item->item_id, $item->save_item_as_lookup);

                    $this->mdl_items->save($invoice_id, $item_id, $item);

                    if ($save_item_as_lookup)
                    {
                        $db_array = array(
                            'item_name'        => $item->item_name,
                            'item_description' => $item->item_description,
                            'item_price'       => $item->item_price
                        );

                        $this->mdl_item_lookups->save(NULL, $db_array);
                    }
                }
            }

            $db_array = array(
                'invoice_number'       => $this->input->post('invoice_number'),
                'invoice_terms'        => $this->input->post('invoice_terms'),
                'invoice_date_created' => date_to_mysql($this->input->post('invoice_date_created')),
                'invoice_date_due'     => date_to_mysql($this->input->post('invoice_date_due')),
                'invoice_status_id'    => $this->input->post('invoice_status_id')
            );

            $this->mdl_invoices->save($invoice_id, $db_array);

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

        if ($this->input->post('custom'))
        {
            $db_array = array();

            foreach ($this->input->post('custom') as $custom)
            {
                // I hate myself for this...
                $db_array[str_replace(']', '', str_replace('custom[', '', $custom['name']))] = $custom['value'];
            }

            $this->load->model('custom_fields/mdl_invoice_custom');
            $this->mdl_invoice_custom->save_custom($invoice_id, $db_array);
        }

        echo json_encode($response);
    }

    public function save_invoice_tax_rate()
    {
        $this->load->model('invoices/mdl_invoice_tax_rates');

        if ($this->mdl_invoice_tax_rates->run_validation())
        {
            $this->mdl_invoice_tax_rates->save($this->input->post('invoice_id'));

            $response = array(
                'success' => 1
            );
        }
        else
        {
            $response = array(
                'success'           => 0,
                'validation_errors' => $this->mdl_invoice_tax_rates->validation_errors
            );
        }

        echo json_encode($response);
    }
















    public function generate_pdf($invoice_id, $stream = TRUE, $invoice_template = NULL)
    {
    	$this->load->model('invoices/mdl_invoices');
        $this->load->helper('pdf');

        $this->mdl_invoices->mark_viewed($invoice_id);

        generate_invoice_pdf($invoice_id, $stream, $invoice_template);
    }

}

?>