<?php

class Manage_packinglistlines extends MY_Controller{


  function __construct(){
    parent::__construct();
		$this->objname = 'PackingListLine';
		$this->tpl = 'packinglistlines';

    $this->authorization->check_authorization('manage_packinglists');
  }

  function get_json(){
    $this->custom_column = array(
      'product_name'=>"_{ProformaInvoiceLineName}_",
      'pi_name'=>"_{ProformaInvoiceName}_",
      'description' => "_{ProformaInvoiceLineDescription}_",
      'flegt'=>"_{ProductIsFlegt}_?'Flegt Item':'Non Flegt Item'"
    );
    $this->objobj = PackingListLineQuery::create()
    ->join('ProformaInvoiceLine')
    ->join('ProformaInvoiceLine.Product')
    ->join('ProformaInvoiceLine.ProformaInvoice')
    ->withColumn('ProformaInvoiceLine.Name')
    ->withColumn('Product.IsFlegt')
    ->withColumn('ProformaInvoice.Name')
    ->withColumn('ProformaInvoiceLine.Description')
    ->filterByPackingListId($this->input->get('packing_list'))
    ->orderByProductIsFlegt()
    ->orderByProformaInvoiceName();
    parent::get_json();

  }
  function create(){

		$this->template->render('admin/packinglistlines/form');
  }

  function detail($id,$render="html"){
		$packinglistline = PackingListLineQuery::create()->findPK($id);
    $av = 0-($packinglistline->getQty());
    foreach ($packinglistline->getProformaInvoiceLine()->getPackingListLines() as $key => $value) {
      # code...
      $av += $value->getQty();
    }
    $av = $packinglistline->getProformaInvoiceLine()->getQty() - $av;
    $packinglistline->withColumn($av,'avail_qty');
    echo $packinglistline->toJSON();
  }

	function write($id=null){

		// edit individual
    if($id){
      $plline = PackingListLineQuery::create()
      ->findPK($id);
      $poline = $plline->getProformaInvoiceLine();
      $av = $poline->getQty();
      foreach ($poline->getPackingListLines() as $sibling) {
        if($sibling->getId() != $id){
          $av = $av - $sibling->getQty();
        }
      }
      if($this->input->post('Qty') > $av){
        write_log("more than qty; $av");
        die(json_encode(array('status'=>'error','message'=>string('pl_qty_error','activity_message'))));
      }
      $qty = $this->input->post('Qty');
      $piline = $plline->getProformaInvoiceLine();
      $this->form = array(
       'Qty' => array(
         'value'=>$qty
       ),
       'QtyOfPack' => array(
         'value'=> ceil($qty/$piline->getQtyPerPack())
       ),
       'CubicDimension' => array(
         'value'=> $piline->getCubicDimension()
       ),
       'TotalCubicDimension' => array(
         'value'=> $piline->getCubicDimension()*$qty
       )
      );
      $data = parent::write($id);

      $pl = $plline->getPackingList();
    }
    else{
      //bulk insert
      $qty = $this->input->post('PiLineQty') ;
      foreach ($this->input->post('PiLineId') as $key => $value) {
        # code...
        $piline = ProformaInvoiceLineQuery::create()
        ->findPk($value);
        $this->form = array(
         'PackingListId' => array(
           'value' =>  $this->input->get('packing_list')
         ),
         'ProformaInvoiceLineId' => array(
           'value'=> $value
         ),
         'Qty' => array(
           'value'=> $qty[$key]
         ),
         'QtyOfPack' => array(
           'value'=> ceil($qty[$key]/$piline->getQtyPerPack())
         ),
         'CubicDimension' => array(
           'value'=> $piline->getCubicDimension()
         ),
         'TotalCubicDimension' => array(
           'value'=> $piline->getCubicDimension()*$qty[$key]
         ),
         'NetWeight' => array(
           'value'=> $piline->getProduct()->getNetWeight()
         ),
         'GrossWeight' => array(
           'value'=> $piline->getProduct()->getGrossWeight()
         ),
        );
        $plline = PackingListLineQuery::create()
        ->filterByPackingListId($this->input->get('packing_list'))
        ->filterByProformaInvoiceLineId($value)
        ->findOne();
        $id = null;
        if($plline){
          $this->form['Qty']['value'] = $qty[$key]+$plline->getQty();
          $id = $plline->getId();
        }
        $data = parent::write($id);
        $pl = $data->getPackingList();
      }
    }
    $this->update_price($pl->getId());
    echo json_encode(array('status'=>'ok'));
		// redirect('manage_packinglistlines/detail/'.$data->getId());
	}

  function delete($id){
    $pl_line = PackingListLineQuery::create()->findPk($id);
    $pl = $pl_line->getPackingList();
		parent::delete($id);
    $this->update_price($pl->getId());
		echo json_encode(array('status'=>'ok'));
  }

  function update_price($pl){
    $pl_total = PackingListLineQuery::create()
    ->select(['PackingListLine.PackingListId'])
    ->withColumn('SUM(PackingListLine.Qty)','TotalQty')
    ->withColumn('SUM(PackingListLine.QtyOfPack)','TotalQtyOfPack')
    ->withColumn('SUM(PackingListLine.TotalCubicDimension)','TotalCubicDimension')
    ->groupBy('PackingListId')
    ->findOneByPackingListId($pl);
    $pl = PackingListQuery::create()->findPk($pl);
    $pl->setTotalQty($pl_total['TotalQty']);
    $pl->setTotalQtyOfPack($pl_total['TotalQtyOfPack']);
    $pl->setTotalCubicDimension($pl_total['TotalCubicDimension']);
    $pl->save();
    // foreach ($pi->getProformaInvoiceLine() as $key => $value) {
    //   # code...
    // }

  }

}
