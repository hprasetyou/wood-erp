<?php


class Manage_partners extends CI_Controller{


  function __construct(){
    parent::__construct();
    // $this->authorization->check_authorization('manage_partners');
  }
  function index(){
      $this->template->render('admin/partners/index');
  }

	function get_json(){
		$partners = PartnerQuery::create();
		$maxPerPage = $this->input->get('length');
    $colls = $this->schema->extract_fields('Partner');
		if($this->input->get('search[value]')){
			$partners->condition('cond1' ,'Partner.name LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond2' ,'Partner.email LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond3' ,'Partner.phone LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond4' ,'Partner.website LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond5' ,'Partner.fax LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond6' ,'Partner.tax_number LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond7' ,'Partner.bank_detail LIKE ?', "%".$this->input->get('search[value]')."%");

			$partners->where(array('cond1','cond2','cond3','cond4','cond5','cond6','cond7',),'or');
    }
		$fields = json_decode($this->input->get('fields'));

		$orderbycol = "orderBy".$fields[$this->input->get('order[0][column]')];
		$partners->$orderbycol($this->input->get('order[0][dir]'));

		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$partners = $partners->paginate(($offset/10)+1, $maxPerPage);


    $o = [];
    $o['recordsTotal']=$partners->getNbResults();
    $o['recordsFiltered']=$partners->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
			foreach ($partners as $partner) {
				foreach ($colls as $key => $coll) {
					$f = "get".$coll;
					$o['data'][$i][$key] = $partner->$f();
				}
			}
		echo json_encode($o);
	}

  function create(){

		$this->template->render('admin/partners/form',array());
  }

  function detail($id){

		$partner = PartnerQuery::create()->findPK($id);
		$this->template->render('admin/partners/form',array('partners'=>$partner,));
  }

  function write($id=null){
		if($id){
			$partner = PartnerQuery::create()->findPK($id);
		}else{
			$partner = new Partner;
		}
		$partner->setName($this->input->post('Name'));
		$partner->setEmail($this->input->post('Email'));
		$partner->setAddress($this->input->post('Address'));
		$partner->setPhone($this->input->post('Phone'));
		$partner->setWebsite($this->input->post('Website'));
		$partner->setFax($this->input->post('Fax'));
		$partner->setImage($this->input->post('Image'));
		$partner->setTaxNumber($this->input->post('TaxNumber'));
		$partner->setBankDetail($this->input->post('BankDetail'));
		$partner->setCompanyId($this->input->post('CompanyId'));
		$partner->setIsEmployee($this->input->post('IsEmployee'));
		$partner->setIsCustomer($this->input->post('IsCustomer'));
		$partner->setIsSupplier($this->input->post('IsSupplier'));

		$partner->save();
		$this->loging->add_entry('partners',$partner->getId(),($id?'activity_modify':'activity_create'));
		redirect('manage_partners/detail/'.$partner->getId());
  }

  function delete($id){
		if($this->input->post('confirm')){
			$partner = PartnerQuery::create()->findPK($id);
			$partner->delete();
		}
		redirect('manage_partners');
  }

}
