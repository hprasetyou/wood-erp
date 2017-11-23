<?php

class Manage_packinglistlines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'PackingListLine';
		$this->tpl = 'packinglistlines';

    $this->authorization->check_authorization('manage_packinglists');
  }


  function create(){

		$packing_lists = PackingListQuery::create()->find();

		$proforma_invoice_lines = ProformaInvoiceLineQuery::create()->find();

		$this->template->render('admin/packinglistlines/form',array(
		'packing_lists'=> $packing_lists,

		'proforma_invoice_lines'=> $proforma_invoice_lines,
			));
  }

  function detail($id){

		$packing_lists = PackingListQuery::create()->find();

		$proforma_invoice_lines = ProformaInvoiceLineQuery::create()->find();

		$packinglistline = PackingListLineQuery::create()->findPK($id);
		$this->template->render('admin/packinglistlines/form',array('packinglistlines'=>$packinglistline,
		'packing_lists'=> $packing_lists,

		'proforma_invoice_lines'=> $proforma_invoice_lines,
			));
  }

	function write($id=null){
		$this->form = array(
     'PackingListId' => 'PackingListId',
     'ProformaInvoiceLineId' => 'ProformaInvoiceLineId',
     'Qty' => 'Qty',
    );
		$data = parent::write($id);
		redirect('manage_packinglistlines/detail/'.$data->getId());
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_packinglistlines');
  }

}
