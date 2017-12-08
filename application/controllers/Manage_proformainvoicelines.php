<?php

class Manage_proformainvoicelines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('ProformaInvoiceLine');
		$this->tpl = 'proformainvoicelines';

  }

  function get_json(){
    $this->objobj = ProformaInvoiceLineQuery::create()
    ->filterByProformaInvoiceId($this->input->get('proforma_invoice'));
    $this->custom_column['qty_of_pack'] = "ceil(_{Qty}_/_{QtyPerPack}_)" ;
    if($this->input->get('check_qty_for_pl')){
      $this->custom_column['avail_qty'] =" function() use(_{PackingListLines}_,_{Qty}_){
          \$sumpll = 0;
          foreach(_{PackingListLines}_ as \$pll){
            \$sumpll += \$pll->getQty();
          }
          return _{Qty}_ - \$sumpll;
        }";
    }
    parent::get_json();

  }

  function get_pi_component($pi_id=null){
    $lines = ProformaInvoiceLineQuery::create()->findByProformaInvoiceId($pi_id);
    $o = [];
    $i = 0;
    foreach ($lines as $line) {
      # code...

      $prod = $line->getProductPartner()->getProduct();
      $o[$i]['id'] = $line->getId().'-'.$prod->getId();
      $o[$i]['article_number'] = $line->getProductPartner()->getName();
      $o[$i]['description'] = $line->getDescription();
      $o[$i]['has_component'] = $prod->getHasComponent();

      if($prod->getHasComponent()){
        foreach ($prod->getProductComponents() as $prodcomponent) {
          $o[$i]['id'] = $line->getId().'-'.$prod->getId().'-'.$prodcomponent->getComponent()->getId();
          $o[$i]['article_number'] = $line->getProductPartner()->getName();
          $o[$i]['description'] = $line->getDescription();
          $o[$i]['has_component'] = $prodcomponent->getComponent()->getName();
          $polines = PurchaseOrderLineQuery::create()
          ->filterByProformaInvoiceLineId($line->getId())
          ->filterByProductId($prod->getId())
          ->filterByComponentId($prodcomponent->getComponent()->getId())
          ->find();
          $done = 0;
          foreach ($polines as $poline) {
            # code...
            write_log($poline);
            $done += $poline->getQty();
          }
          $o[$i]['total_qty'] = ($line->getQty() * $prodcomponent->getQty())-$done;

          $i++;
        }
      }else{
        $polines = PurchaseOrderLineQuery::create()
        ->filterByProformaInvoiceLineId($line->getId())
        ->filterByProductId($prod->getId())
        ->find();
        $done = 0;
        foreach ($polines as $poline) {
          # code...
          $done += $poline->getQty();
        }
        $o[$i]['total_qty'] = $line->getQty() - $done;

        $i++;
      }
    }
    echo json_encode(array('data'=>$o));

  }


  function create(){

		$proforma_invoices = ProformaInvoiceQuery::create()->find();

		$product_partners = ProductPartnerQuery::create()->find();

		$this->template->render('admin/proformainvoicelines/form',array(
		'proforma_invoices'=> $proforma_invoices,
		'product_partners'=> $product_partners,
			));
  }

  function detail($id){
		$proformainvoiceline = ProformaInvoiceLineQuery::create()
    ->findPK($id);
		echo $proformainvoiceline->toJSON();
  }

	function write($id=null){
    $pi = ProformaInvoiceQuery::create()
    ->findPK($this->input->post('ProformaInvoiceId'));
    $productcust = ProductPartnerQuery::create()
    ->filterByProductId($this->input->post('ProductId'))
    ->filterByPartnerId($pi->getCustomerId())
    ->filterByType('sell')
    ->orderByCreatedAt('desc')
    ->findOne();

    if(!$productcust){
      $productcust = new ProductPartner();
      $productcust->setProductId($this->input->post('ProductId'));
      $productcust->setPartnerId($pi->getCustomerId());
      $productcust->setType('sell');
    }
    $productcust->setName($this->input->post('Name'));
    $productcust->setDescription($this->input->post('Description'));
    $productcust->setProductPrice($this->input->post('Price'));
    $productcust->save();
    //check if product already added
    $line = ProformaInvoiceLineQuery::create()
    ->filterByProductId($this->input->post('ProductId'))
    ->filterByProformaInvoiceId($this->input->post('ProformaInvoiceId'))
    ->findOne();
    $oldqty = 0;
    if($line){
      $id = $line->getId();
      $oldqty = $line->getQty();
    }
    $prod = $productcust->getProduct();
    $qty = $this->input->post('Qty')+$oldqty;
    $pack_qty = ceil($qty/$this->input->post('QtyPerPack'));
    $cbm = $this->input->post('CubicDimension')*($this->input->post('QtyPerPack')/$prod->getQtyPerPack());
    $this->form['CubicDimension'] = array('value'=>$cbm);
    $this->form['Qty'] = array('value' =>$qty);
    $this->form['ProductId'] = 'ProductId';
    $this->form['ProformaInvoiceId'] = 'ProformaInvoiceId';
    $this->form['TotalCubicDimension'] = array('value' =>
      $pack_qty*$cbm
    );
    $this->form['TotalPrice'] = array('value' =>
      $pack_qty*$this->input->post('Price')
    );
  	$data = parent::write($id);
    echo $data->toJSON();
}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_proformainvoicelines');
  }

}
