<?php


class Manage_proformainvoices extends MY_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->tpl = 'proformainvoices';
        $this->set_objname('ProformaInvoice');
        $this->authorization->check_authorization('manage_proformainvoices');
    }

    public function get_json()
    {
        $this->objobj = ProformaInvoiceQuery::create()
    ->filterByState('delete', '!=');
        if ($this->input->get('customer_id')) {
            $this->objobj = ProformaInvoiceQuery::create()
      ->filterByCustomerId($this->input->get('customer_id'));
        }
        parent::get_json();
    }


    public function get_line_json($id = null)
    {
        if ($id) {
            $line = ProformaInvoiceLineQuery::create()
      ->joinWith('ProductPartner')
      ->findByProformaInvoiceId($id);
            echo json_encode(array('data'=>json_decode($line->toJSON())->ProformaInvoiceLines));
        } else {
            echo json_encode(array('data'=>[]));
        }
    }


    public function get_line_detail($id)
    {
        $line = ProformaInvoiceLineQuery::create()
    ->joinWith('ProductPartner')
    ->joinWith('ProductPartner.Product')->findPk($id);
        echo $line->toJSON();
    }

    public function send_mail($id)
    {
        $data = ProformaInvoiceQuery::create()->findPk($id);
        $pdf = $this->template->render_pdf(
        'admin/proformainvoices/pdf/report',
            array(
              'proformainvoices'=>$data),
            array(
            'docname'=>'PI '.$data->getName(),
            'render'=>false
          )
        );
        $this->load->helper('send_mail');
        queue_message(array(
        'recipient'=>explode(', ',$data->getPartner()->getEmail()),
        'subject'=>'Invoice',
        'recipient_name'=>$data->getPartner()->getName(),
        'mail_tmpl' => 'mail/layout',
        'mail_tmpl_data'=>array(
          'recipient_name' => $data->getPartner()->getName(),
          'message_body'=>'Cobaaaaaa hahahahahahha'
        ),
        'attachments'=>array(
          array(
            'name' => $pdf['name'],
            'path' => $pdf['path']
          )
        )
    ));
    redirect("manage_proformainvoices/detail/$id");
    }

    public function create()
    {
        $this->load->helper('good_numbering');
        $partners = PartnerQuery::create()->find();

        $this->template->render('admin/proformainvoices/form', array(
        'partners'=> $partners,
    'code' => create_number(
        array('format'=>'PI-y-i',
        'tb_name'=>'proforma_invoice',
        'tb_field'=>'name')
    )
            ));
    }


    public function write($id=null)
    {
        $this->form['CustomerId'] = 'CustomerId';
        $this->form['CurrencyId'] = 'CurrencyId';
        $this->form['DownPaymentId'] = 'DownPaymentId';
        $data = parent::write($id);

        if ($this->input->is_ajax_request()) {
            echo $data->toJSON();
        } else {
            redirect('manage_proformainvoices/detail/'.$data->getId());
        }
    }

    public function delete($id)
    {
        if ($this->input->post('confirm')) {
            ProformaInvoiceQuery::create()
      ->findPK($id)
      ->setState('delete')
      ->save();
        }
        redirect('manage_proformainvoices');
    }
}
