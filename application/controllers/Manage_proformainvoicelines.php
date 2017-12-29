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
    $this->custom_column['extra'] ="function() use(_{IsSample}_,_{IsNeedBox}_){
        \$o = [];
        if(_{IsSample}_){
          array_push(\$o,string('is_sample'));
        }
        if(_{IsNeedBox}_){
          array_push(\$o,string('with_box'));
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

        foreach(ComponentProductQuery::create()->findByProductId(_{Product}_->getId()) as \$component){
          if(!in_array(\$component->getComponent()->getMaterial()->getName(),\$o)){
            array_push(\$o,\$component->getComponent()->getMaterial()->getName());
          }
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
    $lines = ProformaInvoiceLineQuery::create()
    ->usePackingListLineQuery()
      ->filterByPackingListId($this->input->get('packinglist'))
    ->endUse()
    ->filterByProformaInvoiceId($pi_id);
    write_log($lines->toString());
    $lines = $lines->find();
    $o = [];
    $i = 0;
    foreach ($lines as $line) {
      # code...

      $prod = $line->getProduct();
      $o[$i]['id'] = $line->getId().'-'.$prod->getId();
      $o[$i]['article_number'] = $line->getProduct()->getName();
      $o[$i]['description'] = $line->getDescription();
      $o[$i]['has_component'] = $prod->getHasComponent()?$prod->getHasComponent():"Whole Product";
      $o[$i]['price'] = ProductPartnerQuery::create()
      ->filterByProductId($prod->getId())
      ->filterByPartnerId($this->input->get('supplier'))
      ->get_latest_supplier_price();

      if($prod->getHasComponent()){
        foreach (ComponentProductQuery::create()->findByProductId($prod->getId()) as $prodcomponent) {
          $o[$i]['id'] = $line->getId().'-'.$prodcomponent->getComponent()->getId();
          $o[$i]['article_number'] = $line->getProduct()->getName();
          $o[$i]['description'] = $line->getDescription();
          $o[$i]['has_component'] = $prodcomponent->getComponent()->getDescription();
          $o[$i]['price'] = ProductPartnerQuery::create()
          ->filterByProductId($prodcomponent->getComponent()->getId())
          ->filterByPartnerId($this->input->get('supplier'))
          ->get_latest_supplier_price();
          $polines = PurchaseOrderLineQuery::create()
          ->filterByProformaInvoiceLineId($line->getId())
          ->filterByProductId($prodcomponent->getComponentId())
          ->find();
          $ordered = 0;

          $prodstock = ProductStockQuery::create()
          ->filterByProduct($prodcomponent->getComponent())
          ->countProductAllWh()
          ->findOne();

          foreach ($polines as $poline) {
            # code...
            $ordered += $poline->getQty();
          }
          $o[$i]['qty_on_stock'] = $prodstock?$prodstock['StockQty']*1:0;
          $o[$i]['qty_ordered'] = $ordered;
          $o[$i]['qty_needed'] = ($line->getQty() * $prodcomponent->getQty())-$ordered;

          $i++;
        }
      }else{
        $polines = PurchaseOrderLineQuery::create()
        ->filterByProformaInvoiceLineId($line->getId())
        ->filterByProductId($prod->getId())
        ->find();
        $ordered = 0;
        foreach ($polines as $poline) {
          # code...
          $ordered += $poline->getQty();
        }
        $prodstock = ProductStockQuery::create()
        ->filterByProduct($prod)
        ->countProductAllWh()
        ->findOne();

        $o[$i]['qty_on_stock'] = $prodstock?$prodstock['StockQty']*1:0;

        $o[$i]['qty_ordered'] = $ordered;
        $o[$i]['qty_needed'] = $line->getQty() - $ordered;

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

  function detail($id,$render ="html"){
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
