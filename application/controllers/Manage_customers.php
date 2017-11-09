<?php


class Manage_customers extends CI_Controller{


  function __construct(){
    parent::__construct();
   $this->authorization->check_authorization('manage_customers');
  }
  function index(){
      $this->template->render('admin/customers/index');
  }

	function get_json(){
		$customers = PartnerQuery::create()->filterByIsCustomer(true);
    if($this->input->get('company_id')){
      $customers->filterByCompanyId($this->input->get('company_id'));
    }else{
      $customers->filterByCompanyId(null);
    }
		$maxPerPage = $this->input->get('length');

		if($this->input->get('search[value]')){
			$customers->condition('cond1' ,'Partner.name LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond2' ,'Partner.phone LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond3' ,'Partner.website LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond4' ,'Partner.fax LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond5' ,'Partner.tax_number LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond6' ,'Partner.bank_detail LIKE ?', "%".$this->input->get('search[value]')."%");

			$customers->where(array('cond1','cond2','cond3','cond4','cond5','cond6',),'or');
      $customers->find();
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$customers = $customers->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$customers->getNbResults();
    $o['recordsFiltered']=$customers->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($customers as $customer) {
				$o['data'][$i]['id'] = $customer->getId();
				$o['data'][$i]['name'] = $customer->getName();
				$o['data'][$i]['address'] = $customer->getAddress();
				$o['data'][$i]['phone'] = $customer->getPhone();
				$o['data'][$i]['website'] = $customer->getWebsite();
				$o['data'][$i]['fax'] = $customer->getFax();
				$o['data'][$i]['image'] = $customer->getImage();
				$o['data'][$i]['tax_number'] = $customer->getTaxNumber();
				$o['data'][$i]['email'] = $customer->getEmail();
				$o['data'][$i]['bank_detail'] = $customer->getBankDetail();
        $o['data'][$i]['tax_number'] = $customer->getTaxNumber();
        $o['data'][$i]['bank_detail'] = $customer->getBankDetail();
        $o['data'][$i]['company_id'] = $customer->getCompanyId();
        $o['data'][$i]['is_employee'] = $customer->getIsEmployee();
        $o['data'][$i]['is_customer'] = $customer->getIsCustomer();
        $o['data'][$i]['is_supplier'] = $customer->getIsSupplier();

				$o['data'][$i]['company_id'] = $customer->getCompany()?$customer->getCompany()->getName():'';

				$i++;
    }
		echo json_encode($o);
	}

  function create(){
		$this->template->render('admin/customers/form',array(
			));
  }

  function detail($id){


		$customer = PartnerQuery::create()->findPK($id);
		$this->template->render('admin/customers/form',
    array('customers'=>$customer
			));
  }

  function write($id=null){

		if($id){
			$customer = PartnerQuery::create()->findPK($id);
		}else{
			$customer = new Partner;
		}
		$customer->setName($this->input->post('Name'));
		$customer->setAddress($this->input->post('Address'));
		$customer->setPhone($this->input->post('Phone'));
		$customer->setWebsite($this->input->post('Website'));
		$customer->setEmail($this->input->post('Email'));
		$customer->setFax($this->input->post('Fax'));
    if($this->input->post('Image')){
      if(strpos($this->input->post('Image'),'base64')){
        $this->load->helper('base64toimage');
    		$customer->setImage(base64_to_img($this->input->post('Image')));
      }
    }
		$customer->setTaxNumber($this->input->post('TaxNumber'));
		$customer->setBankDetail($this->input->post('BankDetail'));
    if($this->input->post('CompanyId')>0){
		    $customer->setCompanyId($this->input->post('CompanyId'));
    }
    $customer->setIsCustomer(true);
		$customer->save();
		//$this->loging->add_entry('customers',$customer->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_customers/detail/'.$customer->getId());
  }

  function delete($id){

		$customer = PartnerQuery::create()->findPK($id);
    $company = $customer->getCompanyId();
		if($this->input->post('confirm')){
			$customer->delete();
		}
		redirect('manage_customers/'.($company?"detail/$company":""));
  }

}
