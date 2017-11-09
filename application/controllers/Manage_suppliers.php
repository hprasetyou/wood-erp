<?php


class Manage_suppliers extends CI_Controller{


  function __construct(){
    parent::__construct();
    $this->authorization->check_authorization('manage_suppliers');
  }
  function index(){
      $this->template->render('admin/suppliers/index');
  }

	function get_json(){
		$suppliers = PartnerQuery::create()->filterByIsSupplier(true);
    if($this->input->get('company_id')){
      $suppliers->filterByCompanyId($this->input->get('company_id'));
    }else{
      $suppliers->filterByCompanyId(null);
    }
		$maxPerPage = $this->input->get('length');

		if($this->input->get('search[value]')){
			$suppliers->condition('cond1' ,'Partner.name LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond2' ,'Partner.phone LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond3' ,'Partner.website LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond4' ,'Partner.fax LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond5' ,'Partner.tax_number LIKE ?', "%".$this->input->get('search[value]')."%");
			$suppliers->condition('cond6' ,'Partner.bank_detail LIKE ?', "%".$this->input->get('search[value]')."%");

			$suppliers->where(array('cond1','cond2','cond3','cond4','cond5','cond6',),'or');
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
				$o['data'][$i]['website'] = $supplier->getWebsite();
				$o['data'][$i]['fax'] = $supplier->getFax();
				$o['data'][$i]['image'] = $supplier->getImage();
				$o['data'][$i]['tax_number'] = $supplier->getTaxNumber();
				$o['data'][$i]['email'] = $supplier->getEmail();
				$o['data'][$i]['bank_detail'] = $supplier->getBankDetail();
        $o['data'][$i]['tax_number'] = $supplier->getTaxNumber();
        $o['data'][$i]['bank_detail'] = $supplier->getBankDetail();
        $o['data'][$i]['company_id'] = $supplier->getCompanyId();
        $o['data'][$i]['is_employee'] = $supplier->getIsEmployee();
        $o['data'][$i]['is_supplier'] = $supplier->getIsSupplier();
        $o['data'][$i]['is_supplier'] = $supplier->getIsSupplier();

				$o['data'][$i]['company_id'] = $supplier->getCompany()?$supplier->getCompany()->getName():'';

				$i++;
    }
		echo json_encode($o);
	}

  function create(){
		$this->template->render('admin/suppliers/form',array(
			));
  }

  function detail($id){


		$supplier = PartnerQuery::create()->findPK($id);
		$this->template->render('admin/suppliers/form',
    array('suppliers'=>$supplier
			));
  }

  function write($id=null){

		if($id){
			$supplier = PartnerQuery::create()->findPK($id);
		}else{
			$supplier = new Partner;
		}
		$supplier->setName($this->input->post('Name'));
		$supplier->setAddress($this->input->post('Address'));
		$supplier->setPhone($this->input->post('Phone'));
		$supplier->setWebsite($this->input->post('Website'));
		$supplier->setEmail($this->input->post('Email'));
		$supplier->setFax($this->input->post('Fax'));
    if($this->input->post('Image')){
      if(strpos($this->input->post('Image'),'base64')){
        $this->load->helper('base64toimage');
    		$supplier->setImage(base64_to_img($this->input->post('Image')));
      }
    }
		$supplier->setTaxNumber($this->input->post('TaxNumber'));
		$supplier->setBankDetail($this->input->post('BankDetail'));
    if($this->input->post('CompanyId')>0){
		    $supplier->setCompanyId($this->input->post('CompanyId'));
    }
    $supplier->setIsSupplier(true);
		$supplier->save();
		//$this->loging->add_entry('suppliers',$supplier->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_suppliers/detail/'.$supplier->getId());
  }
  function delete($id){

		$customer = PartnerQuery::create()->findPK($id);
    $company = $customer->getCompanyId();
		if($this->input->post('confirm')){
			$customer->delete();
		}
		redirect('manage_suppliers/'.($company?"detail/$company":""));
  }

}
