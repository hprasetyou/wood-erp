<?php


class Manage_suppliers extends CI_Controller{


  function __construct(){
    parent::__construct();
   // $this->authorization->check_authorization('manage_suppliers');
  }
  function index(){
      $this->template->render('admin/suppliers/index');
  }

	function get_json(){
		$suppliers = SupplierQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$suppliers->condition('cond1' ,'Supplier.name LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond2' ,'Supplier.phone LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond3' ,'Supplier.email LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond4' ,'Supplier.tax_number LIKE ?', "%".$this->input->get('search[value]')."%");

			$suppliers->where(array('cond1','cond2','cond3','cond4',),'or');
      $suppliers->find();
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$suppliers = $suppliers->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$suppliers->getNbResults();
    $o['recordsFiltered']=$suppliers->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($suppliers as $supplier) {
				$o['data'][$i]['id'] = $supplier->getId();
				$o['data'][$i]['name'] = $supplier->getName();
				$o['data'][$i]['address'] = $supplier->getAddress();
				$o['data'][$i]['phone'] = $supplier->getPhone();
				$o['data'][$i]['email'] = $supplier->getEmail();
				$o['data'][$i]['bank_detail'] = $supplier->getBankDetail();
				$o['data'][$i]['tax_number'] = $supplier->getTaxNumber();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){
		
		$this->template->render('admin/suppliers/form',array());
  }

  function detail($id){
		
		$supplier = SupplierQuery::create()->findPK($id);
		$this->template->render('admin/suppliers/form',array('suppliers'=>$supplier,));
  }

  function write($id=null){
		if($id){
			$supplier = SupplierQuery::create()->findPK($id);
		}else{
			$supplier = new Supplier;
		}
		$supplier->setName($this->input->post('Name'));
		$supplier->setAddress($this->input->post('Address'));
		$supplier->setPhone($this->input->post('Phone'));
		$supplier->setEmail($this->input->post('Email'));
		$supplier->setBankDetail($this->input->post('BankDetail'));
		$supplier->setTaxNumber($this->input->post('TaxNumber'));

		$supplier->save();
		//$this->loging->add_entry('suppliers',$supplier->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_suppliers/detail/'.$supplier->getId());
  }

  function delete($id){
		if($this->input->post('confirm') == 'Ya'){
			$supplier = SupplierQuery::create()->findPK($id);
			$supplier->delete();
		}
		redirect('manage_suppliers');
  }

}
    