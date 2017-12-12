<?php

class Manage_proformainvoicelines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->set_objname('ProformaInvoiceLine');
		$this->tpl = 'proformainvoicelines';

  }

  function get_json(){
    $this->objobj = ProformaInvoiceLineQuery::create()
    // ->rightJoin('ProformaInvoiceLine.Product')
    // ->rightJoin('Product.ProductImage')
    // ->withColumn('ProductImage.Url')
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
    $this->custom_column['product_image'] ="function() use (_{Product}_){
      \$o = \"\";
      foreach(_{Product}_->getProductImages() as \$images){
        if(!\$o){
          \$o = \$images->getUrl();
        }
      }
      return \$o;
    }";
    $this->custom_column['calc_disc'] ="function() use (_{Price}_,_{Product}_){
      \$o = \"\";

      return round((_{Product}_->getListPrice() - _{Price}_)/_{Product}_->getListPrice()*100,2).' %';
    }";
    $this->custom_column['product_material'] ="function() use (_{Product}_){
      \$o = [];
      if(_{Product}_->getHasComponent()){
        foreach(_{Product}_->getProductComponents() as \$component){
          array_push(\$o,\$component->getComponent()->getMaterial()->getName());
        }
      }else{
        \$mat = _{Product}_->getMaterial()?_{Product}_->getMaterial()->getName():false;
        if(\$mat){
          array_push(\$o,\$mat);
        }
      }

      return \$o;
    }";
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
    $currency = $proformainvoiceline->getProformaInvoice()
    ->getCurrency()->getCode();
    $proformainvoiceline->setPrice(
      exchange_rate(
        $proformainvoiceline->getPrice(),$currency
        )
    );
    $proformainvoiceline->setTotalPrice(
      exchange_rate(
        $proformainvoiceline->getTotalPrice(),$currency
        )
    );
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
    //convert to USD
    $price = exchange_rate($this->input->post('Price'),"USD",$pi->getCurrency()->getCode());
    if(!$productcust){
      $productcust = new ProductPartner();
      $productcust->setProductId($this->input->post('ProductId'));
      $productcust->setPartnerId($pi->getCustomerId());
      $productcust->setType('sell');
    }
    $productcust->setName($this->input->post('Name'));
    $productcust->setDescription($this->input->post('Description'));
    $productcust->setProductPrice($price);
    $productcust->save();
    //check if product already added
    $line = ProformaInvoiceLineQuery::create()
    ->filterByProductId($this->input->post('ProductId'))
    ->filterByProformaInvoiceId($this->input->post('ProformaInvoiceId'))
    ->findOne();
    $oldqty = 0;
    if($line and $id == null){
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
    //Should be in USD
    $this->form['Price'] = array('value' =>
      $price
    );
    //Should be in USD
    $this->form['TotalPrice'] = array('value' =>
      $pack_qty*$price
    );
  	$data = parent::write($id);
    $total = ProformaInvoiceLineQuery::create()
    ->select('ProformaInvoiceId')
    ->withColumn('SUM(ProformaInvoiceLine.TotalCubicDimension)','TotalCubicDimension')
    ->withColumn('SUM(ProformaInvoiceLine.TotalPrice)','TotalPrice')
    ->filterByProformaInvoice($pi)
    ->findOne();
    //set total on pi
    $pi->setTotalCubicDimension($total['TotalCubicDimension'])
    ->setTotalPrice($total['TotalPrice'])
    ->save();
    echo $data->toJSON();
}

  function delete($id){
		$data = parent::delete($id);
		redirect('manage_proformainvoicelines');
  }

}
