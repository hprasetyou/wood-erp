<?php


class Manage_proformainvoices extends MY_Controller{


  function __construct(){
    $this->objname = 'ProformaInvoice';
    $this->tpl = 'proformainvoices';

    parent::__construct();
    $this->form = array(
    'Name'=>'Name',
    'CustomerId'=>'CustomerId',
    'Date'=>'Date',
    'Description'=>'Description');
    $this->authorization->check_authorization('manage_proformainvoices');
  }

  function get_json(){
    $this->objobj = ProformaInvoiceQuery::create()
    ->filterByState('delete', '!=');
    if($this->input->get('customer_id')){
      $this->objobj = ProformaInvoiceQuery::create()
      ->filterByCustomerId($this->input->get('customer_id'));
    }
    parent::get_json();
  }


  function get_line_json($id = null){
    if($id){
      $line = ProformaInvoiceLineQuery::create()
      ->joinWith('ProductPartner')
      ->findByProformaInvoiceId($id);
      echo json_encode(array('data'=>json_decode($line->toJSON())->ProformaInvoiceLines));

    }else{
      echo json_encode(array('data'=>[]));
    }

  }


  function get_line_detail($id){
    $line = ProformaInvoiceLineQuery::create()
    ->joinWith('ProductPartner')
    ->joinWith('ProductPartner.Product')->findPk($id);
    echo $line->toJSON();
  }

  function create(){
    $this->load->helper('good_numbering');
		$partners = PartnerQuery::create()->find();

		$this->template->render('admin/proformainvoices/form',array(
		'partners'=> $partners,
    'code' => create_number(
        array('format'=>'PI-y-i',
        'tb_name'=>'proforma_invoice',
        'tb_field'=>'name'))
			));
  }

  function detail($id,$render = "html"){

		$partners = PartnerQuery::create()->find();

		$proformainvoice = ProformaInvoiceQuery::create()->findPK($id);
    $o = array('proformainvoices'=>$proformainvoice,
    'partners'=> $partners,
    );
    if($render=="pdf"){
      $this->template->render_pdf("admin/proformainvoices/pdf/report",$o);
    }else{
      $this->template->render('admin/proformainvoices/form',$o);
    }

  }

  function write($id=null){
    $this->form['CurrencyId'] = 'CurrencyId';
    $data = parent::write($id);

    $lines = json_decode($this->input->post('Lines'));

    foreach ($lines as $key => $line) {
      # code...is->
      if($line->Type == 'write'){
      $productcust = ProductPartnerQuery::create()
      ->filterByProductId($line->ProductId)
      ->filterByPartnerId($data->getCustomerId())
      ->filterByType('sell')
      ->orderByCreatedAt('desc')
      ->findOne();
      if(!$productcust){
        $productcust = new ProductPartner();
        $productcust->setProductId($line->ProductId);
        $productcust->setPartnerId($data->getCustomerId());
        $productcust->setType('sell');
      }
        $productcust->setName($line->Name);
        $productcust->setDescription($line->Description);
        $productcust->setProductPrice($line->Price);
        $productcust->save();

      $cbm = 0;
      if($productcust->getProduct()->getIsKdn()){
        $cbm = $productcust->getProduct()->getCubicKdn();
      }else{
        $cbm = $productcust->getProduct()->getCubicAsb();
      }
      if($line->Id>0){
        $proformainvoiceline = ProformaInvoiceLineQuery::create()
        ->findPk($line->Id);
      }else{
        $proformainvoiceline = new ProformaInvoiceLine;
        $proformainvoiceline->setProformaInvoiceId($data->getId());
      }
      $proformainvoiceline->setProductPartnerId($productcust->getId());
      $proformainvoiceline->setQty($line->Qty);
      $proformainvoiceline->setDescription($line->Description);
      $proformainvoiceline->setQtyPerPack($line->QtyPerPack);
      $proformainvoiceline->setCubicDimension($cbm);
      $proformainvoiceline->setTotalCubicDimension($cbm * $line->Qty);
      $proformainvoiceline->setPrice($line->Price);
      $proformainvoiceline->setProductFinishing($line->Finishing);
      $proformainvoiceline->setTotalPrice($line->Price *$line->Qty);
      $proformainvoiceline->setIsSample($line->IsSample);
      $proformainvoiceline->setIsNeedBox($line->IsNeedBox);
      $proformainvoiceline->save();


      }else if($line->Type == 'delete'){
        print_r($line);
        ProformaInvoiceLineQuery::create()->findPk($line->Id)->delete();
      }
    }

    if($this->input->is_ajax_request()){
      echo $data->toJSON();
    }else{
      redirect('manage_proformainvoices/detail/'.$data->getId());
    }
  }

  function delete($id){
		if($this->input->post('confirm')){
			ProformaInvoiceQuery::create()
      ->findPK($id)
      ->setState('delete')
      ->save();
		}
		redirect('manage_proformainvoices');
  }

}
