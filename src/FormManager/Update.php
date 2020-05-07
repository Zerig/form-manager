<?php
namespace FormManager;


class Update extends Form{


	public function __construct($name, $id_key = "id"){
		parent::__construct($name, $id_key);
	}


	public function getData($table, $row, $column = null){
		if(!empty($data))	return parent::getData($table, $row, $column);

		$mr = $GLOBALS["mysql"]->query("SELECT ".$column." FROM ".$table." WHERE ".$this->id_key." = '".$row."'");
		return $mr->get_object()->{$column};
	}



	public function send($data = []){
		// ONLY IF NEW SEND DATA WAS SET
		if( self::setData() ){
			self::setFixedData($data);	// set fixed data - which are not able modified
			return self::update();		// insert into DB
		}
		return false;
	}


	public function update(){
		$return = true;	// check if all tables was send SUCCESSFULLY

		// INSERT INTO ALL TABLES
		foreach($this->data as $table_name => $table_id){
			foreach($table_id as $key => $table_data){
				$result = $GLOBALS["mysql"]->update($table_name, $table_data, $this->id_key."='".$key."'");
				$return = $return && $result;
			}
		}
		return $return;
	}







}
