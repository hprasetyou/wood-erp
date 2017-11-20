<?php

/**
 *
 */
class Schema
{

  private $file_path;

  function __construct()
  {
    # code...
    $this->file_path = "./schema.xml";

  }

  private function find_table($tb_name){
		$f = fopen($this->file_path, "r");
		$contents = fread($f, filesize($this->file_path));
		$xml= new \SimpleXMLElement($contents);
		$o = False;
		foreach ($xml->table as $table) {
			if($table->attributes()->phpName == $tb_name){
				$o = $table;
			}
		}
		return $o;
	}

  function extract_fields($tb_name){
    $tb = $this->find_table($tb_name);
    $o = [];
    foreach ($tb->column as $key => $value) {
      # code...
      if($value->attributes()->name && $value->attributes()->phpName){
        $o[$value->attributes()->name.""] = array(
          'type'=>$value->attributes()->type."",
          'Name'=>$value->attributes()->phpName.""
        );
      }
    }
    foreach ($tb->{'foreign-key'} as $key => $value) {
      # code...
      $o[$value->reference[0]->attributes()->local.""] = array(
        'type'=>'rel',
        'Name'=>ucfirst($value->attributes()->foreignTable."")
      );
    }
    return $o;
  }
}
