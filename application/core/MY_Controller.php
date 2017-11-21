<?php
//TODO: finish this
use Doctrine\Common\Inflector\Inflector;

class MY_Controller extends CI_Controller{
  public $objname;
  public $objobj;
  public $tpl;
  public $o2m_def;


 function __construct()
 {
   parent::__construct();
   $this->o2m_def = [];
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
   $maxPerPage = $this->input->get('length');
   $colls = $this->schema->extract_fields($this->objname);
   $fields = json_decode($this->input->get('fields'));
   $except = array('image');
   $cond = [];
   if($this->input->get('search[value]')){
     foreach ($fields as $key => $value) {
       if(!in_array($value,$except)){
         $cond[] = $value;
         $obj = $this->objname;
         $objs->condition($value ,"$obj.$value LIKE ?", "%".$this->input->get('search[value]')."%");
       }
     }
     $objs->where($cond,'or');
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
         $f = "get".$coll['Name'];
         switch ($coll['type']) {
           case 'rel':
           $o['data'][$i][$key] = $obj->$f()?$obj->$f()->getName():'';
             break;

           case 'DATE':
           $o['data'][$i][$key] = $obj->$f()?date_format($obj->$f(),'d M Y'):'';
             break;
           default:
            $o['data'][$i][$key] = $obj->$f();
             break;
         }
       }
       foreach ($this->o2m_def as $key => $value) {
         $f = "get".$value['rel'];
         $field = "get".$value['field'];
         $val = false;
         if($value['single']){
           $val = count($obj->$f())>0?$obj->$f()[0]->$field():'';
         }else{
           $val = $obj->$f();
         }
         $o['data'][$i][$value['index']] = $val;
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
   $colls = $this->schema->extract_fields($this->objname);

   if($id){
     $qq = $this->objname."Query";
     $obj = $qq::create()->findPK($id);
   }else{
     $qq = $this->objname;
     $obj = new $qq;
   }

   foreach ($pair as $key => $value) {
     # code...
     $isValidCol = false;
     $type = false;
     foreach ($colls as $key => $value) {
       if($value['Name'] == $key){
         $isValidCol = true;
         $type = $value['type'];
       }
     }
     $func = "set$key";
     if($isValidCol){
       if($value=="Image"){
           if(strpos($this->input->post('Image'),'base64')){
           $this->load->helper('base64toimage');
           $obj->$func(base64_to_img($this->input->post($value)));
         }
       }else{
         $value = is_array($value)?$value['value']:$this->input->post($value);
         if($type == 'BOOLEAN'){
           $obj->$func($value?true:false);
         }else{
           $obj->$func($value);
         }
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
