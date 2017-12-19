<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
v1.0
This is library for accessing twig, make sure you have intall twig via composer
and enable composer autoloading
*/
use Dompdf\Dompdf;

class Template {
  public function __construct()
  {
      $loader = new Twig_Loader_Filesystem('./application/views');
      $this->twig = new Twig_Environment($loader);
      $this->twig = new Twig_Environment($loader, array(
      'cache' => false,// '/application/cache'
      ));
      $this->CI =& get_instance();
      $this->apply_filter();
      $this->apply_func();
  }

  function apply_filter(){
    $this->CI->load->helper('monetary');

    // an anonymous function
    $filter_cubic = new Twig_Filter('cubic', function ($string) {
        return number_format(($string/1000000), 3, '.', '').' m3';
    });
    $currency = new Twig_Filter('monetary', function ($val,$cur_code = 'USD'){
      return format_currency($val,$cur_code);
    });
    $this->twig->addFilter($currency);
    $this->twig->addFilter($filter_cubic);

  }

  function apply_func(){
    $function = new Twig_Function('selection_m2o', function ($name,$model,$domain=null,$val,$id = null,$text=null) {
      if(!$id){
        $id=$name;
      }
      if($text){
        $text = explode('-',$text);
      }else{
        $text = ['Name'];
      }
      $objs = "{$model}Query";
      $data = $objs::create()->find();
      $o = "<select name=\"$name\" id=\"$id\" class=\"form-control form-select\">";
      foreach ($data as $key => $value) {
        $id = $value->getId();
        $name = "";
        foreach ($text as $kt=>$t) {
          # code...
          $f = "get$t";
          if($kt > 0){
            $name .= " - ";
          }
          $name .= $value->$f();
        }
        $selected = "";
        if($val == $id){
          $selected = "selected=\"selected\"";
        }
        $o .="<option $selected value=\"$id\">$name</option>";
      }
      $o .= "</select>";
      return $o;
    });
      $exchange_rate = new Twig_Function('exchange_rate', function ($value=1,$target,$src="USD") {
        if(!$target){
          $target = "USD";
        }
        $ex = ExchangeRateQuery::create()
        ->filterByTarget($target)
        ->filterByBase($src)
        ->orderByCreatedAt('desc')
        ->findOne();
        return ($value * (($target != $src)?($ex->getRate()):1));
      });
        $button = new Twig_Function('button', function ($conf) {
          $url = isset($conf['url'])?$conf['url']:'#';
          $icon = isset($conf['icon'])?"fa fa-".$conf['icon']:'';
          $type = isset($conf['type'])?$conf['type']:"default";
          $id = isset($conf['id'])?'id="'.$conf['id'].'"':"";
          $right = isset($conf['right'])?'pull-right':"";
          $text = $conf['text'];

          return "<a $id href=\"$url\" class=\"btn $right btn-$type\"><i class=\"$icon\"></i>$text</a>";
        });
    $this->twig->addFunction($function);
    $this->twig->addFunction($button);
    $ci = $this->CI;
    $this->twig->addFunction(new Twig_Function('uri_segment',function($index) use ($ci){
      return $ci->uri->segment($index);
    }));
    $this->twig->addFunction($exchange_rate);
  }

  private $twig;
  function render($tpl,$data=array(),$render = true){

        $this->CI->load->helper('url');
        $session = [];
        if($this->CI->session->userdata('logged_in')){
          $uaccess = MenuQuery::create()
          ->findById(unserialize($this->CI->session->userdata('access')));
          $access = [];
          foreach ($uaccess as $key => $value) {
            # code...
            $exist = false;
            $parent = false;
            foreach ($access as $parentmenu) {
              if($parentmenu->getId()==$value->getParent()->getId()){
                //exist
                $exist = true;
                $parentmenu->Child[] = $value;
              }
            }
            if(!$exist){
              $access[$key] = $value->getParent();
              $access[$key]->Child[] = $value;
            }
          }
          $session['access'] = $access;
          $session['uid'] = UserQuery::create()->join('User.Partner')->findOneById($this->CI->session->userdata('uid'));
        }
        $pdata = array(
            'base_url'=>base_url(),
            'res'=>array(
                'string'=>include('application/language/en/default.php'),
            		'uri'=>uri_string(),
            		'query_params'=>$this->CI->input->get(),
                'session' => $session,
                'info' => $this->CI->session->flashdata('info')
            )
        );
        $out = array_merge($pdata,$data);
        if(!$render){
          return $this->twig->render($tpl.'.html',$out);
        }else{
          echo $this->twig->render($tpl.'.html',$out);
        }
    }


    public function render_pdf($tpl, $data = array() ,$config = array('docname'=>'document','header'=>'nota'))
    {
        $dompdf = new Dompdf();
        $out = $data;
        // $out['header'] = 'nota';

        $dompdf->loadHtml($this->render($tpl, $out,false));
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $docname = $config['docname'];
        $dompdf->stream("$docname.pdf" , array( 'Attachment'=>0 ) );
    }
}
