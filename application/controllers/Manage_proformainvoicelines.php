<?php


class Manage_proformainvoicelines extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_proformainvoices');
  }
  function index(){
      $this->template->render('admin/proformainvoicelines/index');
  }

	function get_json(){
		$proformainvoicelines = ProformaInvoiceLineQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$proformainvoicelines->condition('cond1' ,'ProformaInvoiceLine.name LIKE ?', "%".$this->input->get('search[value]')."%");

			$proformainvoicelines->where(array('cond1',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$proformainvoicelines = $proformainvoicelines->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$proformainvoicelines->getNbResults();
    $o['recordsFiltered']=$proformainvoicelines->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($proformainvoicelines as $proformainvoiceline) {
				$o['data'][$i]['id'] = $proformainvoiceline->getId();
				$o['data'][$i]['proforma_invoice_id'] = $proformainvoiceline->getProformaInvoiceId();
				$o['data'][$i]['name'] = $proformainvoiceline->getName();
				$o['data'][$i]['product_customer_id'] = $proformainvoiceline->getProductCustomerId();
				$o['data'][$i]['qty'] = $proformainvoiceline->getQty();
				$o['data'][$i]['qty_on_container'] = $proformainvoiceline->getQtyOnContainer();
				$o['data'][$i]['cubic_dimension'] = $proformainvoiceline->getCubicDimension();
				$o['data'][$i]['total_cubic_dimension'] = $proformainvoiceline->getTotalCubicDimension();
				$o['data'][$i]['price'] = $proformainvoiceline->getPrice();
				$o['data'][$i]['total_price'] = $proformainvoiceline->getTotalPrice();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){

		$this->template->render('admin/proformainvoicelines/form',array());
  }

  function detail($id){

		$proformainvoiceline = ProformaInvoiceLineQuery::create()->findPK($id);
		$this->template->render('admin/proformainvoicelines/form',array('proformainvoicelines'=>$proformainvoiceline,));
  }

  function write($id=null){
		if($id){
			$proformainvoiceline = ProformaInvoiceLineQuery::create()->findPK($id);
		}else{
			$proformainvoiceline = new ProformaInvoiceLine;
		}
		$proformainvoiceline->setProformaInvoiceId($this->input->post('ProformaInvoiceId'));
		$proformainvoiceline->setName($this->input->post('Name'));
		$proformainvoiceline->setProductCustomerId($this->input->post('ProductCustomerId'));
		$proformainvoiceline->setQty($this->input->post('Qty'));
		$proformainvoiceline->setQtyOnContainer($this->input->post('QtyOnContainer'));
		$proformainvoiceline->setCubicDimension($this->input->post('CubicDimension'));
		$proformainvoiceline->setTotalCubicDimension($this->input->post('TotalCubicDimension'));
		$proformainvoiceline->setCubicDimension($this->input->post('CubicDimension'));
		$proformainvoiceline->setTotalPrice($this->input->post('TotalPrice'));

		$proformainvoiceline->save();
		$this->loging->add_entry('proformainvoicelines',$proformainvoiceline->getId(),($id?'activity_modify':'activity_create'));
		redirect('manage_proformainvoicelines/detail/'.$proformainvoiceline->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$proformainvoiceline = ProformaInvoiceLineQuery::create()->findPK($id);
			$proformainvoiceline->delete();
		}
		redirect('manage_proformainvoicelines');
  }

}
