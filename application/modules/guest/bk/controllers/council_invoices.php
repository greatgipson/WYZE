<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Council_Invoices extends Guest_Controller {

  public function index()
    {
        //$this->load->model('quotes/mdl_quotes');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('meter_data/mdl_meter_data');

        //$this->layout->set(
        //    array(
		//		'meter_datas' => $this->mdl_meter_data->add_condition1()->get()->result(),
        //        'overdue_invoices' => $this->mdl_invoices->get()->result(),
		//		'open_quotes'      => $this->mdl_quotes->get()->result(),
        //        'open_invoices'    => $this->mdl_invoices->get()->result()
        //    )
        //);

        $this->layout->buffer('content', 'guest/council_invoices_index');
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
                'linked_items'      => $this->mdl_items->where('fi_invoices.linked_invoice_id', $invoice_id)->get()->result(),
                'linked_invoice_tax_rates' => $this->mdl_invoice_tax_rates->where('fi_invoices.linked_invoice_id', $invoice_id)->get()->result(),
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


 public function compareview($invoice_id)
    {
        $this->load->model('invoices/mdl_items');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('invoices/mdl_invoice_tax_rates');
        $invoice = $this->mdl_invoices->where('fi_invoices.invoice_id',$invoice_id)->where_in('fi_invoices.client_id',$this->user_clients)->get()->row();
		//$linked_invoice = $this->mdl_invoices->where('fi_invoices.linked_invoice_id',$invoice_id)->get()->row();

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
                'linked_invoice'    => $this->mdl_invoices->where('fi_invoices.invoice_id',$invoice->linked_invoice_id)->get()->row(),
                'linked_items'      => $this->mdl_items->where('invoice_id', $invoice->linked_invoice_id)->get()->result(),
                'linked_invoice_tax_rates' => $this->mdl_invoice_tax_rates->where('invoice_id', $invoice->linked_invoice_id)->get()->result(),

                'invoice_id'        => $invoice_id,
            )
        );

        $this->layout->buffer(
            array(
                array('content', 'guest/compareview')
            )
        );

        $this->layout->render('layout_guest');
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