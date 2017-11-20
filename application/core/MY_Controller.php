<?php
//TODO: finish this
use Doctrine\Common\Inflector\Inflector;

class MY_Controller extends CI_Controller{
  public $objname;
  public $objobj;
  public $tpl;


 function __construct()
 {
   parent::__construct();
 }
 function index(){
    $vars = $this->tpl;
     $this->template->render("admin/$vars/index");
 }

 function get_json(){
   $qobj = $this->objname."Query";
   $objs = $qobj::create();
   if($this->objobj){
     $objs = $this->objobj;
   }
   if($this->input->get('company_id')){
     $objs->filterByCompanyId($this->input->get('company_id'));
   }else{
     $objs->filterByCompanyId(null);
   }
   $maxPerPage = $this->input->get('length');
   $colls = $this->schema->extract_fields($this->objname);
   $fields = json_decode($this->input->get('fields'));

   if($this->input->get('search[value]')){
     foreach ($fields as $key => $value) {
       $objs->condition($value ,"Partner.$value LIKE ?", "%".$this->input->get('search[value]')."%");
     }
     $objs->where($fields,'or');
   }

   $orderbycol = "orderBy".$fields[$this->input->get('order[0][column]')];
   $objs->$orderbycol($this->input->get('order[0][dir]'));


   $offset = ($this->input->get('start')?$this->input->get('start'):0);
   $objs = $objs->paginate(($offset/10)+1, $maxPerPage);
   $o = [];
   $o['recordsTotal']=$objs->getNbResults();
   $o['recordsFiltered']=$objs->getNbResults();
   $o['draw']=$this->input->get('draw');
   $o['data']=[];
   $i=0;
   foreach ($objs as $obj) {
       foreach ($colls as $key => $coll) {
         # code...
         $f = "get".$coll;
         $o['data'][$i][$key] = $obj->$f();
       }
       $i++;
   }
   echo json_encode($o);
 }

 function create(){
    $vars = $this->tpl;
   $this->template->render("admin/$vars/form",array(
     ));
 }

 function detail($id){
   $vars = $this->tpl;
   $qobj = $this->objname."Query";
   $objs = $qobj::create()->findPk($id);
   $this->template->render("admin/$vars/form",
   array($vars=>$objs
     ));
 }

 function write($id=null,$pair){

   if($id){
     $qq = $this->objname."Query";
     $obj = $qq::create()->findPK($id);
   }else{
     $qq = $this->objname;
     $obj = new $qq;
   }

   foreach ($pair as $key => $value) {
     # code...
     $func = "set$key";
     if($this->input->post($value)){
       if($value=="Image"){
         if(strpos($this->input->post('Image'),'base64')){
         $this->load->helper('base64toimage');
         $obj->$func(base64_to_img($this->input->post($value)));
       }
       }else{
         $obj->$func($this->input->post($value));
       }
     }
   }

   $obj->save();
   $this->loging->add_entry($this->tpl,$obj->getId(),($id?'activity_modify':'activity_create'));
   return $obj;
 }

 function delete($id){

   $qobj = $this->objname."Query";
   $objs = $qobj::create()->findPk($id);
   if($this->input->post('confirm')){
     $objs->delete();
   }
   return $objs;
 }

}
