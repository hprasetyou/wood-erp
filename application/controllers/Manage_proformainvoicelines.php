<?php

class Manage_proformainvoicelines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'ProformaInvoiceLine';
		$this->tpl = 'proformainvoicelines';
    $this->form = array(
     'ProformaInvoiceId' => 'ProformaInvoiceId',
     'ProductCustomerId' => 'ProductCustomerId',
     'ProductFinishing' => 'ProductFinishing',
     'Description' => 'Description',
     'Qty' => 'Qty',
     'QtyPerPack' => 'QtyPerPack',
     'CubicDimension' => 'CubicDimension',
     'TotalCubicDimension' => 'TotalCubicDimension',
     'Price' => 'Price',
     'TotalPrice' => 'TotalPrice',
     'IsSample' => 'IsSample',
     'IsNeedBox' => 'IsNeedBox',
    );
  }

  function get_json(){
    $this->objobj = ProformaInvoiceLineQuery::create()
    ->joinWith('ProductCustomer')
    ->filterByProformaInvoiceId($this->input->get('proforma_invoice'));
    if($this->input->get('check_qty_for_pl')){
      $this->custom_column = array('avail_qty'=>" function() use(_{PackingListLines}_,_{Qty}_){
          \$sumpll = 0;
          foreach(_{PackingListLines}_ as \$pll){
            \$sumpll += \$pll->getQty();
          }
          return _{Qty}_ - \$sumpll;
        }");
    }
    parent::get_json();

  }


  function create(){

		$proforma_invoices = ProformaInvoiceQuery::create()->find();

		$product_customers = ProductCustomerQuery::create()->find();

		$this->template->render('admin/proformainvoicelines/form',array(
		'proforma_invoices'=> $proforma_invoices,
		'product_customers'=> $product_customers,
			));
  }

  function detail($id){

		$proforma_invoices = ProformaInvoiceQuery::create()->find();

		$product_customers = ProductCustomerQuery::create()->find();

		$proformainvoiceline = ProformaInvoiceLineQuery::create()->findPK($id);
		$this->template->render('admin/proformainvoicelines/form',array('proformainvoicelines'=>$proformainvoiceline,
		'proforma_invoices'=> $proforma_invoices,

		'product_customers'=> $product_customers,
			));
  }

	function write($id=null){

		$data = parent::write($id);
		redirect('manage_proformainvoicelines/detail/'.$data->getId());
	}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_proformainvoicelines');
  }

}
