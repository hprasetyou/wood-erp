<?php


class Manage_proformainvoices extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_proformainvoices');
  }
  function index(){
      $this->template->render('admin/proformainvoices/index');
  }

	function get_json(){
		$proformainvoices = ProformaInvoiceQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$proformainvoices->condition('cond1' ,'ProformaInvoice.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$proformainvoices->where(array('cond1',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$proformainvoices = $proformainvoices->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$proformainvoices->getNbResults();
    $o['recordsFiltered']=$proformainvoices->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($proformainvoices as $proformainvoice) {
				$o['data'][$i]['id'] = $proformainvoice->getId();
				$o['data'][$i]['name'] = $proformainvoice->getName();
				$o['data'][$i]['customer_id'] = $proformainvoice->getPartner()->getName();
				$o['data'][$i]['date'] = $proformainvoice->getDate()?date_format($proformainvoice->getDate(),'d M Y'):"";
				$o['data'][$i]['description'] = $proformainvoice->getDescription();

				$i++;
    }
		echo json_encode($o);
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
		if($id){
			$proformainvoice = ProformaInvoiceQuery::create()->findPK($id);
		}else{
			$proformainvoice = new ProformaInvoice;
		}
		$proformainvoice->setName($this->input->post('Name'));
		$proformainvoice->setCustomerId($this->input->post('CustomerId'));
		$proformainvoice->setDate($this->input->post('Date'));
		$proformainvoice->setDescription($this->input->post('Description'));

		$proformainvoice->save();
    $lines = json_decode($this->input->post('Lines'));

    foreach ($lines as $key => $line) {
      # code...is->
      if($line->Type == 'write'){
      $productcust = ProductCustomerQuery::create()
      ->filterByProductId($line->ProductId)
      ->filterByPartnerId($proformainvoice->getCustomerId())
      ->findOne();
      if(!$productcust){
        $productcust = new ProductCustomer();
        $productcust->setProductId($line->ProductId);
        $productcust->setPartnerId($proformainvoice->getCustomerId());
        $productcust->setName($line->Name);
        $productcust->setDescription($line->Description);
        $productcust->setProductPrice($line->Price);
        $productcust->save();
      }
      $cbm = 0;
      if($productcust->getProduct()->getIsKdn()){
        $cbm = $productcust->getProduct()->getCubicKdn();
      }else{
        $cbm = $productcust->getProduct()->getCubicAsb();
      }
      $proformainvoiceline = new ProformaInvoiceLine;
      $proformainvoiceline->setProformaInvoiceId($proformainvoice->getId());
      $proformainvoiceline->setProductCustomerId($productcust->getId());
      $proformainvoiceline->setQty($line->Qty);
      $proformainvoiceline->setDescription($line->Description);
      $proformainvoiceline->setQtyOnContainer($line->QtyOnContainer);
      $proformainvoiceline->setCubicDimension($cbm);
      $proformainvoiceline->setTotalCubicDimension($cbm * $line->Qty);
      $proformainvoiceline->setPrice($line->Price);
      $proformainvoiceline->setTotalPrice($line->Price *$line->Qty);
      $proformainvoiceline->save();

      }else if($line->Type == 'delete'){
        print_r($line);
        ProformaInvoiceLineQuery::create()->findPk($line->Id)->delete();
      }
    }
		$this->loging->add_entry('proformainvoices',$proformainvoice->getId(),($id?'activity_modify':'activity_create'));

    redirect('manage_proformainvoices/detail/'.$proformainvoice->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$proformainvoice = ProformaInvoiceQuery::create()->findPK($id);
			$proformainvoice->delete();
		}
		redirect('manage_proformainvoices');
  }

}
