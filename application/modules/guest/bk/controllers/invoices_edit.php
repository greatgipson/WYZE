<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Invoices_Edit extends Guest_Controller {

  public function index()
    {
       //$this->load->model('quotes/mdl_quotes');
        $this->load->model('invoices/mdl_invoices');
        $this->load->model('meter_data/mdl_meter_data');

        $this->layout->buffer('content', 'guest/edit_view');
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
                array('content', 'guest/edit_view')
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