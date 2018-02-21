<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Quotes extends Guest_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('quotes/mdl_quotes');
    }

    public function index()
    {
        // Display open quotes by default
        redirect('guest/quotes/status/open');
    }

    public function status($status = 'open', $page = 0)
    {
        redirect_to_set();

        // Determine which group of quotes to load
        switch ($status)
        {
            case 'approved':
                $this->mdl_quotes->is_approved()->where_in('fi_quotes.client_id', $this->user_clients);
                break;
            case 'rejected':
                $this->mdl_quotes->is_rejected()->where_in('fi_quotes.client_id', $this->user_clients);
                $this->layout->set('show_invoice_column', TRUE);
                break;
            default:
                $this->mdl_quotes->is_open()->where_in('fi_quotes.client_id', $this->user_clients);
                break;
        }

        $this->mdl_quotes->paginate(site_url('guest/quotes/status/' . $status), $page);
        $quotes = $this->mdl_quotes->result();

        $this->layout->set('quotes', $quotes);
        $this->layout->set('status', $status);
        $this->layout->buffer('content', 'guest/quotes_index');
        $this->layout->render('layout_guest');
    }

    public function view($quote_id)
    {
        redirect_to_set();

        $this->load->model('quotes/mdl_quote_items');
        $this->load->model('quotes/mdl_quote_tax_rates');

        $quote = $this->mdl_quotes->guest_visible()->where('fi_quotes.quote_id', $quote_id)->where_in('fi_quotes.client_id', $this->user_clients)->get()->row();

        if (!$quote)
        {
            show_404();
        }

        $this->mdl_quotes->mark_viewed($quote->quote_id);

        $this->layout->set(
            array(
                'quote'           => $quote,
                'items'           => $this->mdl_quote_items->where('quote_id', $quote_id)->get()->result(),
                'quote_tax_rates' => $this->mdl_quote_tax_rates->where('quote_id', $quote_id)->get()->result(),
                'quote_id'        => $quote_id
            )
        );

        $this->layout->buffer('content', 'guest/quotes_view');
        $this->layout->render('layout_guest');
    }

    public function generate_pdf($quote_id, $stream = TRUE, $quote_template = NULL)
    {
        $this->load->helper('pdf');

        $this->mdl_quotes->mark_viewed($quote_id);

        $quote = $this->mdl_quotes->guest_visible()->where('fi_quotes.quote_id', $quote_id)->where_in('fi_quotes.client_id', $this->user_clients)->get()->row();

        if (!$quote)
        {
            show_404();
        }
        else
        {
            generate_quote_pdf($quote_id, $stream, $quote_template);
        }
    }

    public function approve($quote_id)
    {
        $this->load->model('quotes/mdl_quotes');
        $this->mdl_quotes->approve_quote_by_id($quote_id);
        redirect_to('guest/quotes');
    }

    public function reject($quote_id)
    {
        $this->load->model('quotes/mdl_quotes');
        $this->mdl_quotes->reject_quote_by_id($quote_id);
        redirect_to('guest/quotes');
    }

}

?>