<?php
namespace FormManager;


class Form{
	public $name;
	public $id_key;

	public $data = [];
	public $forbiddenCols = [];

	public $state;

	public function __construct($name, $id_key = "id"){
		$this->name = $name;
		$this->id_key = $id_key;



		/*if(isset($_POST[$this->name])){
			return self::set();
		}*/
	}


	public function name($table, $row = null, $column = null){
		$return = $this->name;
		$return .= "[".$table."]";
		$return .= (is_null($row))? "" : "[".$row."]";
		$return .= (is_null($column))? "" : "[".$column."]";

		return $return;
	}


	public function setData(){
		if($_SERVER['REQUEST_METHOD'] === 'POST')	$_DATA = $_POST;
		if($_SERVER['REQUEST_METHOD'] === 'GET')	$_DATA = $_GET;

		// ONLY IF NEW SEND DATA EXIST
		if(isset($_DATA[$this->name])){
			unset($_DATA[$this->name]["submit"]);

			$this->data = $_DATA[$this->name];
			self::unsetForbiddenCols();

			return true;
		}

		return false;
	}


	// inset all cols, which should not be UPDATED
	public function unsetForbiddenCols(){
		foreach($this->data as $table_name => $table){

			// SKIP IF this->data->{table} not exist in this->forbiddenCols
			if(!isset($this->forbiddenCols[$table_name]))	continue;
			foreach($table as $row_name => $row){
				foreach($row as $col_name => $val){

					// IF forbidden cols exist in this->data UNSET it
					if(in_array($col_name, $this->forbiddenCols[$table_name]))
					unset($this->data[$table_name][$row_name][$col_name]);


				}
			}


		}
	}




	public function setFixedData($data){
		foreach($data as $table_name => $table){
			foreach($table as $row_name => $row){
				foreach($row as $column_name => $value){
					$this->data[$table_name][$row_name][$column_name] = $value;
				}
			}
		}
	}





	public function getData($table, $row, $column = null){
		if(is_null($column))  return $this->data[$table][$row];
		if(!isset($this->data[$table][$row][$column]))  return null;

		return $this->data[$table][$row][$column];
	}



	public function addForbiddenCols($array_col){
		$this->forbiddenCols = array_merge_recursive($this->forbiddenCols, $array_col);
	}



}
