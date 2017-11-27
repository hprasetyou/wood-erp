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
      'product_name'=>"_{ProductCustomerName}_",
      'pi_name'=>"_{ProformaInvoiceName}_",
      'cubic_dimension' => "_{ProformaInvoiceLineCubicDimension}_",
      'total_cubic_dimension' => "_{ProformaInvoiceLineTotalCubicDimension}_",
      'pack' => "ceil(_{Qty}_/_{ProformaInvoiceLineQtyPerPack}_)",
      'description' => "_{ProformaInvoiceLineDescription}_"
    );
    $this->objobj = PackingListLineQuery::create()
    ->join('ProformaInvoiceLine')
    ->join('ProformaInvoiceLine.ProductCustomer')
    ->join('ProformaInvoiceLine.ProformaInvoice')
    ->withColumn('ProductCustomer.Name')
    ->withColumn('ProformaInvoice.Name')
    ->withColumn('ProformaInvoiceLine.CubicDimension')
    ->withColumn('ProformaInvoiceLine.TotalCubicDimension')
    ->withColumn('ProformaInvoiceLine.Qty')
    ->withColumn('ProformaInvoiceLine.QtyPerPack')
    ->withColumn('ProformaInvoiceLine.Description')
    ->filterByPackingListId($this->input->get('packing_list'));
    parent::get_json();

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
      write_log("============ Av =============");
      write_log($av);
      write_log("============ Input Qty =============");
      write_log($this->input->post('Qty'));
      if($this->input->post('Qty') > $av){
        write_log("more than qty; $av");
        die(json_encode(array('status'=>'error','message'=>string('pl_qty_error','activity_message'))));
      }

      $this->form = array(
       'Qty' => 'Qty'
      );
      parent::write($id);
    }
    else{
      //bulk insert
      $qty = $this->input->post('PiLineQty') ;
      foreach ($this->input->post('PiLineId') as $key => $value) {
        # code...
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
        parent::write($id);
      }
    }
    echo json_encode(array('status'=>'ok'));
		// redirect('manage_packinglistlines/detail/'.$data->getId());
	}

  function delete($id){
		$data = parent::delete($id);
		echo json_encode(array('status'=>'ok'));
  }

}
