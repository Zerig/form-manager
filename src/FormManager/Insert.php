<?php
namespace FormManager;


class Insert extends Form{


	public function __construct($name, $id_key = "id"){
		parent::__construct($name, $id_key);
	}




	public function send($data = []){
		// ONLY IF NEW SEND DATA WAS SET
		if( self::setData() ){
			self::setFixedData($data);	// set fixed data - which are not able modified
			return self::insert();		// insert into DB
		}
		return false;
	}


	public function insert(){
		$return = true;	// check if all tables was send SUCCESSFULLY

		// INSERT INTO ALL TABLES
		foreach($this->data as $table_name => $table_id){
			foreach($table_id as $table_data){
				$result = $GLOBALS["mysql"]->insert($table_name, $table_data);

				//\Report\Form::insert($result);
				$return = $return && $result;
			}
		}
		return $return;
	}







}
