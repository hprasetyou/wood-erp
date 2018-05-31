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
  protected $custom_code;
  protected $outputstd;


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

 protected function set_objname($objname){
   $this->objname = $objname;
   $colls = $this->schema->extract_fields($this->objname);
   $except = array('Id','CreatedAt','UpdatedAt');
   foreach ($colls as $coll) {
     # code...
     if(!in_array($coll['Name'],$except)){
       if(!is_object($coll['Name'])){
          $this->form[$coll['Name']] = $coll['Name'];
       }else{
        //  $this->form[$coll['LocalName']] = $coll['LocalName'];
       }
     }

   }

 }

 function get_json(){
   $qobj = $this->objname."Query";
   $objs = $qobj::create();
   if($this->objobj){
     $objs = $this->objobj;
   }
   $maxPerPage = $this->input->get('length')>0?$this->input->get('length'):100;
   $colls = $this->schema->extract_fields($this->objname);
   $fields = json_decode($this->input->get('fields'));
   $except = array('image');
   $cond = [];
   if($this->input->get('search[value]')){
     foreach ($fields as $key => $value) {
       if(!in_array($value,$except)){
         if(isset($colls[$value])){
           $cond[] = $value;
           $obj = $this->schema->find_table($this->objname);
           $obj = $obj->attributes()->phpName;
           $objs->condition($value ,"$obj.$value LIKE ?", "%".$this->input->get('search[value]')."%");
         }
       }
     }
     $objs->where($cond,'or');
   }
   try {
     $order_index = $this->input->get('order[0][column]');
     if(!$order_index){
       $order_index = 0;
     }
     $orderbycol = "orderBy".$fields[$order_index];
     $objs->$orderbycol($this->input->get('order[0][dir]'));
   } catch (Exception $e) {

   }
   if(method_exists($objs,'filterByActive')){
    $objs->filterByActive(true);
  }
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
               $o['data'][$i][$key] =  $obj->$f()->getId();
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
       eval($this->custom_code);
       foreach ($this->custom_column as $key => $value) {
         # code...
         if($value)
         //extract all {variable} from input to array
         $var_cols = extract_surround_text($value,'_{','}_');
         //create new variable and assign value by field
         foreach ($var_cols as $v) {
           $fsv = "get".$v;
           $$v = $obj->$fsv();
           # code...
         }
         $value = str_replace('}_','',$value);
         $value = str_replace('_{','$',$value);
          eval("\$value = $value;");
          $o['data'][$i][$key] =  is_callable($value)?$value():$value;
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

 function detail($id,$render = "html"){
   $vars = $this->tpl;
   if(!$this->objobj){
     $qobj = $this->objname."Query";
     $objs = $qobj::create();
   }else{
     $objs = $this->objobj;
   }
   $o = $this->outputstd?json_decode($objs->findPK($id)->toJSON()):$objs->findPk($id);
   if($this->input->is_ajax_request()){
     echo ($this->outputstd?json_encode($o):$o->toJSON());
   }else{
     $render_path = "form";
     $render_func = "render";
     if($render=="pdf"){
       $render_path = "pdf/report";
       $render_func = "render_pdf";
     }
     $this->template->$render_func("admin/$vars/$render_path",
     array($vars=> $o
       ));
   }
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
         if($value){
           $obj->$func($value);
         }
       }
     }

   }
   $obj->setActive(true);
   $obj->save();
   write_log("Writing data. . . . . . . ");
   write_log($obj);
   $this->loging->add_entry($this->tpl,$obj->getId(),($id?'activity_modify':'activity_create'));
   return $obj;
 }

 function delete($id){

   $qobj = $this->objname."Query";
   $objs = $qobj::create()->findPk($id);
   if($this->input->post('confirm')){
     if(method_exists($objs,'setActive')){
       $objs->setActive(false);
       $objs->save();
    }else{
      $objs->delete();
    }
   }
   return $objs;
 }


   function set_confirm($id){
     $qobj = $this->objname."Query";
     $data = $qobj::create()
     ->filterByState('draft')
     ->filterById($id)
     ->findOne();
     write_log($data);
     if($data){
       $data->setState('confirm')
       ->save();
       $this->loging->add_entry($this->tpl,$data->getId(),'activity_modify');
       echo $data->toJSON();
     }else{
       echo json_encode(array('error','data not found'));
     }
   }

}
