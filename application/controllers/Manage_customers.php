<?php


class Manage_customers extends CI_Controller{


  function __construct(){
    parent::__construct();
   // $this->authorization->check_authorization('manage_customers');
  }
  function index(){
      $this->template->render('admin/customers/index');
  }

	function get_json(){
		$customers = CustomerQuery::create();
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$customers->condition('cond1' ,'Customer.name LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond2' ,'Customer.phone LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond3' ,'Customer.website LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond4' ,'Customer.fax LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond5' ,'Customer.tax_number LIKE ?', "%".$this->input->get('search[value]')."%");
			$customers->condition('cond6' ,'Customer.bank_detail LIKE ?', "%".$this->input->get('search[value]')."%");

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
				$o['data'][$i]['bank_detail'] = $customer->getBankDetail();
				$o['data'][$i]['company_id'] = $customer->getCustomer()->getName();

				$i++;
    }
		echo json_encode($o);
	}

  function create(){
		
		$customers = CustomerQuery::create()->find();
			
		$this->template->render('admin/customers/form',array(
		'customers'=> $customers,
			));
  }

  function detail($id){
		
		$customers = CustomerQuery::create()->find();
			
		$customer = CustomerQuery::create()->findPK($id);
		$this->template->render('admin/customers/form',array('customers'=>$customer,
		'customers'=> $customers,
			));
  }

  function write($id=null){
		if($id){
			$customer = CustomerQuery::create()->findPK($id);
		}else{
			$customer = new Customer;
		}
		$customer->setName($this->input->post('Name'));
		$customer->setAddress($this->input->post('Address'));
		$customer->setPhone($this->input->post('Phone'));
		$customer->setWebsite($this->input->post('Website'));
		$customer->setFax($this->input->post('Fax'));
		$customer->setImage($this->input->post('Image'));
		$customer->setTaxNumber($this->input->post('TaxNumber'));
		$customer->setBankDetail($this->input->post('BankDetail'));
		$customer->setCompanyId($this->input->post('CompanyId'));

		$customer->save();
		//$this->loging->add_entry('customers',$customer->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_customers/detail/'.$customer->getId());
  }

  function delete($id){
		if($this->input->post('confirm') == 'Ya'){
			$customer = CustomerQuery::create()->findPK($id);
			$customer->delete();
		}
		redirect('manage_customers');
  }

}
    