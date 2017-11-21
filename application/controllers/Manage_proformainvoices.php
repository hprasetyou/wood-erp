<?php


class Manage_proformainvoices extends MY_Controller{


  function __construct(){
    $this->objname = 'ProformaInvoice';
    $this->tpl = 'proformainvoices';

    parent::__construct();
    $this->authorization->check_authorization('manage_proformainvoices');
  }

  function get_line_detail($id){
    $line = ProformaInvoiceLineQuery::create()->joinWith('ProductCustomer')->joinWith('ProductCustomer.Product')->findPk($id);
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
    if($render=="pdf"){
      $this->template->render_pdf("admin/proformainvoices/pdf/report");
    }else{
      $this->template->render('admin/proformainvoices/form',array('proformainvoices'=>$proformainvoice,
      'partners'=> $partners,
        ));
    }

  }

  function write($id=null){
    $this->form = array(
    'Name'=>'Name',
    'CustomerId'=>'CustomerId',
    'Date'=>'Date',
    'Description'=>'Description')
    $data = parent::write($id,$fields);

    $lines = json_decode($this->input->post('Lines'));

    foreach ($lines as $key => $line) {
      # code...is->
      if($line->Type == 'write'){
      $productcust = ProductCustomerQuery::create()
      ->filterByProductId($line->ProductId)
      ->filterByPartnerId($data->getCustomerId())
      ->findOne();
      if(!$productcust){
        $productcust = new ProductCustomer();
        $productcust->setProductId($line->ProductId);
        $productcust->setPartnerId($data->getCustomerId());
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
      $proformainvoiceline->setProductCustomerId($productcust->getId());
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

    redirect('manage_proformainvoices/detail/'.$data->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$proformainvoice = ProformaInvoiceQuery::create()->findPK($id);
			$proformainvoice->delete();
		}
		redirect('manage_proformainvoices');
  }

}
