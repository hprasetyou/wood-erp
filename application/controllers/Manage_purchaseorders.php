<?php

class Manage_purchaseorders extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('PurchaseOrder');
		$this->tpl = 'purchaseorders';
    $this->load->helper('good_numbering');

    $this->authorization->check_authorization('manage_purchaseorders');

  }

  function get_json(){
    if($this->input->get('packinglists')){
      $this->objobj = PurchaseOrderQuery::create();
      $this->objobj->filterByPackingListId($this->input->get('packinglists'));
    }
    parent::get_json();
  }


  function create(){
    $o = array();
    if($this->input->get('packinglist') && $this->input->get('proformainvoice')){
      $o['packinglist'] = PackingListQuery::create()->findPK($this->input->get('packinglist'));
      $this->template->render('admin/purchaseorders/form',$o);
    }else{
      $o['po_number'] = create_number(
          array('format'=>"PO-MISC-y-i",
          'tb_name'=>'purchase_order',
          'tb_field'=>'name'));
      $this->template->render('admin/purchaseorders/form_no_pl',$o);
    }
  }

  function get_number($pi){
    $pi = str_replace("PI-","",$pi);
    echo create_number(
        array('format'=>"PO-$pi-i",
        'tb_name'=>'purchase_order',
        'tb_field'=>'name'));
  }

  function detail($id,$render="html"){
    $this->outputstd = 1;
    $polinetotal = PurchaseOrderLineQuery::create()
    ->getTotalPricePerPO()
    ->findOneByPurchaseOrderId($id);
    $this->objobj = PurchaseOrderQuery::create()
    ->leftJoinWith('PurchaseOrder.ProformaInvoice')
    ->leftJoinWith('PurchaseOrder.PurchaseOrderLine')
    ->leftJoinWith('PurchaseOrder.Supplier')
    ->leftJoinWith('PurchaseOrder.DownPayment')
    ->leftJoinWith('PurchaseOrder.PackingList')
    ->leftJoinWith('PurchaseOrder.Currency')
    ->withColumn((is_null($polinetotal['Total'])?"1":"'".$polinetotal['Total']."'"),'SubTotal');
    $obj = json_decode($this->objobj->findPk($id)->toJSON());
    if(!$this->input->is_ajax_request()){
      $o = array('purchaseorders' => $obj );
      if($render=="html"){
        $this->template->render("admin/purchaseorders/form".($obj->ProformaInvoiceId?"":"_no_pl"),$o);
      }else{
        $this->template->render_pdf("admin/purchaseorders/pdf/report".($obj->ProformaInvoiceId?"":"_no_pl"),$o);
      }
    }else{
        echo json_encode($obj);
    }
  }

	function write($id=null){

    $this->form['PackingListId'] = 'PackingListId';
    $this->form['ProformaInvoiceId'] = 'ProformaInvoiceId';
    $this->form['DownPaymentId'] = 'DownPaymentId';
    $this->form['CurrencyId'] = 'CurrencyId';
    $this->form['SupplierId'] = 'SupplierId';
    if($this->input->post('DownPaymentAmount')==""){
      if($this->input->post('DownPaymentId')){
        $dpdata = DownPaymentQuery::create()->findPK($this->input->post('DownPaymentId'));
        $autodp = $dpdata->getValue() * $this->input->post('SubTotal');
        $this->form['DownPaymentAmount']= array('value'=>$autodp);
        // $this->form['TotalPrice']['value'] = $this->input->post('SubTotal') - $autodp;
      }
    }
		$data = parent::write($id);
    if($this->input->is_ajax_request()){
      echo $data->toJSON();
    }else{
      redirect('manage_purchaseorders/detail/'.$data->getId());
    }
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_purchaseorders');
  }

}
