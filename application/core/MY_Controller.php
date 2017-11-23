<?php
//TODO: finish this
use Doctrine\Common\Inflector\Inflector;

class MY_Controller extends CI_Controller{
  protected $objname;
  protected $objobj;
  protected $tpl;
  protected $o2m_def;
  protected $form;
  protected $custom_column;


 function __construct()
 {
   parent::__construct();
   $this->custom_column = [];
   $this->o2m_def = [];
   $this->form = [];
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
           if($obj->$f()){
             try {
               $o['data'][$i][$key] = $obj->$f()->getName();
             } catch (Exception $e) {
               $o['data'][$i][$key] =  $obj->$f()->getDescription();
             }
           }else{
             $o['data'][$i][$key] = "";
           }
             break;
           case 'DATE':
           $o['data'][$i][$key] = $obj->$f()?date_format($obj->$f(),'d M Y'):'';
             break;
           default:
            $o['data'][$i][$key] = $obj->$f();
             break;
         }
       }
       foreach ($this->custom_column as $key => $value) {
         # code...
         //extract all {variable} from input to array
         $var_cols = extract_surround_text($value,'{','}');
         //create new variable and assign value by field
         foreach ($var_cols as $v) {
           $fsv = "get".$v;
           $$v = $obj->$fsv();
           # code...
         }
         $value = str_replace('}','',$value);
         $value = str_replace('{','$',$value);
          eval("\$value = $value;");
          $o['data'][$i][$key] =  $value;
         //apply by replacing {variable} to $variable


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

 function write($id=null){
   $pair = $this->form;
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
     $type = false;
     foreach ($colls as $ckey => $cvalue) {
       if($cvalue['Name'] == $key){
         $type = $cvalue['type'];
       }
     }
     $func = "set$key";
     if($value=="Image"){
         if(file_exists('.'.$obj->getImage())){
           write_log('Delete file');
           unlink('.'.$obj->getImage());
         }else{
            write_log('File not found');
         }
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
