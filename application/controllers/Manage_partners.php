<?php


class Manage_partners extends CI_Controller{


  function __construct(){
    parent::__construct();
   // $this->authorization->check_authorization('manage_partners');
  }
  function index($type='employee'){
      $this->template->render('admin/partners/index');
  }

	function get_json(){
    $type = $this->input->get('type');
    if(!$type){
      $type='employee';
    }
		$partners = PartnerQuery::create()->filterByCompanyId();
    switch ($type) {
      case 'employee':
        # code...
        $partners->filterByIsEmployee(true);
        break;
      case 'customer':
        # code...
        $partners->filterByIsCustomer(true);
        break;
      case 'supplier':
        # code...
        $partners->filterByIsSupplier(true);
        break;
      default:
        # code...
        break;
    }
		$maxPerPage = $this->input->get('length');
		if($this->input->get('search[value]')){
			$partners->condition('cond1' ,'Partner.name LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond2' ,'Partner.phone LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond3' ,'Partner.website LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond4' ,'Partner.fax LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond5' ,'Partner.tax_number LIKE ?', "%".$this->input->get('search[value]')."%");
			$partners->condition('cond6' ,'Partner.bank_detail LIKE ?', "%".$this->input->get('search[value]')."%");

			$partners->where(array('cond1','cond2','cond3','cond4','cond5','cond6',),'or');
    }
		$offset = ($this->input->get('start')?$this->input->get('start'):0);
		$partners = $partners->paginate(($offset/10)+1, $maxPerPage);
    $o = [];
    $o['recordsTotal']=$partners->getNbResults();
    $o['recordsFiltered']=$partners->getNbResults();
    $o['draw']=$this->input->get('draw');
    $o['data']=[];
    $i=0;
    foreach ($partners as $partner) {
				$o['data'][$i]['id'] = $partner->getId();
				$o['data'][$i]['name'] = $partner->getName();
				$o['data'][$i]['address'] = $partner->getAddress();
				$o['data'][$i]['phone'] = $partner->getPhone();
				$o['data'][$i]['website'] = $partner->getWebsite();
				$o['data'][$i]['fax'] = $partner->getFax();
				$o['data'][$i]['image'] = $partner->getImage();
				$o['data'][$i]['tax_number'] = $partner->getTaxNumber();
				$o['data'][$i]['bank_detail'] = $partner->getBankDetail();
				$o['data'][$i]['company_id'] = $partner->getCompanyId();
				$o['data'][$i]['is_customer'] = $partner->getIsCustomer();
				$o['data'][$i]['is_supplier'] = $partner->getIsSupplier();

				$i++;
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
		$partner->setAddress($this->input->post('Address'));
		$partner->setPhone($this->input->post('Phone'));
		$partner->setWebsite($this->input->post('Website'));
		$partner->setFax($this->input->post('Fax'));
		$partner->setImage($this->input->post('Image'));
		$partner->setTaxNumber($this->input->post('TaxNumber'));
		$partner->setBankDetail($this->input->post('BankDetail'));
		$partner->setCompanyId($this->input->post('CompanyId'));
		$partner->setIsCustomer($this->input->post('IsCustomer'));
		$partner->setIsSupplier($this->input->post('IsSupplier'));

		$partner->save();
		//$this->loging->add_entry('partners',$partner->getId(),($id?'melakukan perubahan pada data':'membuat data baru'));
		redirect('manage_partners/detail/'.$partner->getId());
  }

  function delete($id){
		if($this->input->post('confirm') == 'Ya'){
			$partner = PartnerQuery::create()->findPK($id);
			$partner->delete();
		}
		redirect('manage_partners');
  }

}
