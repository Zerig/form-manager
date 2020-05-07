<code style="white-space: pre;">
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload
require_once '__reset.php';	// reset DIR structure for testing
?>

<div style="display:flex;justify-content:space-around">
<div>
<?php
echo "<h2>FORM</h2>";
echo "<hr>";

//$form = new \FormManager\Form("man", ["id" => 1]);
$form = new \FormManager\Update("form");
echo '<b>$form = new \FormManager\Update("form")</b>'."\n";
echo "\n";
echo '<b>$form->send()</b> => '.$form->send()."\n";
echo '$form->getData("man", 2, "name") => '.$form->getData("man", 2, "name")."\n";
echo '$form->getData("man", 2, "age")  => '.$form->getData("man", 2, "age")."\n";
echo '$form->getData("man", 1, "name") => '.$form->getData("man", 1, "name")."\n";
echo '$form->getData("man", 1, "age")  => '.$form->getData("man", 1, "age")."\n";

/*foreach($form->data as $t_k => $t){
	foreach($t as $r_k => $r){
		foreach($r as $c_k => $val){
			echo '$form->getData('.$t_k.', '.$r_k.', '.$c_k.') => '.$form->getData($t_k, $r_k, $c_k)."\n";
		}
	}
}*/

?>
<form method="POST">
<label>name: </label>	<input type="text" name="<?= $form->name("man", 2, "name") ?>" value="<?= $form->getData("man", 2, "name") ?>">
<label>age: </label>	<input type="text" name="<?= $form->name("man", 2, "age") ?>" value="<?= $form->getData("man", 2, "age") ?>">

<label>name: </label>	<input type="text" name="<?= $form->name("man", 1, "name") ?>" value="<?= $form->getData("man", 1, "name") ?>">
<label>age: </label>	<input type="text" name="<?= $form->name("man", 1, "age") ?>" value="<?= $form->getData("man", 1, "age") ?>">

<input type="submit" name="<?= $form->name("submit") ?>" value="SEND">
</form>

<?php

echo "<br>---------------------------------------<br><br>";



$form_2 = new \FormManager\Update("form_2");
echo '<b>$form_2 = new \FormManager\Update("form")</b>'."\n";
echo '<b>$form_2->addForbiddenCols(["man" => ["id", "name"]])</b>'."\n";
$form_2->addForbiddenCols(["man" => ["id", "name"]]);
echo "\n";
echo '<b>$form_2->send()</b> => '.$form_2->send()."\n";
echo '$form_2->getData("man", 2, "name") => '.$form_2->getData("man", 2, "name")."\n";
echo '$form_2->getData("man", 2, "age")  => '.$form_2->getData("man", 2, "age")."\n";
echo '$form_2->getData("man", 1, "name") => '.$form_2->getData("man", 1, "name")."\n";
echo '$form_2->getData("man", 1, "age")  => '.$form_2->getData("man", 1, "age")."\n";

/*foreach($form_2->data as $t_k => $t){
	foreach($t as $r_k => $r){
		foreach($r as $c_k => $val){
			echo '$form_2->getData('.$t_k.', '.$r_k.', '.$c_k.') => '.$form_2->getData($t_k, $r_k, $c_k)."\n";
		}
	}
}*/

?>
<form method="POST">
<label>name: </label>	<input type="text" name="<?= $form_2->name("man", 2, "name") ?>" value="<?= $form_2->getData("man", 2, "name") ?>">
<label>age: </label>	<input type="text" name="<?= $form_2->name("man", 2, "age") ?>" value="<?= $form_2->getData("man", 2, "age") ?>">

<label>name: </label>	<input type="text" name="<?= $form_2->name("man", 1, "name") ?>" value="<?= $form_2->getData("man", 1, "name") ?>">
<label>age: </label>	<input type="text" name="<?= $form_2->name("man", 1, "age") ?>" value="<?= $form_2->getData("man", 1, "age") ?>">

<input type="submit" name="<?= $form_2->name("submit") ?>" value="SEND">
</form>

<?php

echo "<br>---------------------------------------<br><br>";



$form_3 = new \FormManager\Update("form_3", "name");
echo '<b>$form_3 = new \FormManager\Update("form")</b>'."\n";
echo "\n";
echo '<b>$form_3->send()</b> => '.$form_3->send()."\n";
echo '$form_3->getData("man", "Benjamin", "id") => '.$form_3->getData("man", "Benjamin", "id")."\n";
echo '$form_3->getData("man", "Benjamin", "age")  => '.$form_3->getData("man", "Benjamin", "age")."\n";


?>
<form method="POST">
<label>id: </label>	<input type="text" name="form_3[man][Benjamin][id]" value="<?= $form_3->getData("man", "Benjamin", "id") ?>">
<label>age: </label>	<input type="text" name="form_3[man][Benjamin][age]" value="<?= $form_3->getData("man", "Benjamin", "age") ?>">

<input type="submit" name="form_3[submit]" value="SEND">
</form>

<?php

echo "<br>---------------------------------------";
echo "<br>---------------------------------------<br><br>";




?>
</div>






<div>
<?php
echo '<h2>DATA</h2>';
echo "<hr>";
echo '$_POST => ';
echo print_r($_POST);
echo "<br>---------------------------------------<br><br>";
echo '$_GET => ';
echo print_r($_GET);
echo "<br>---------------------------------------<br><br>";
if(!empty($form->data)){
	echo '$form->data => ';
	echo print_r($form->data);
}
if(!empty($form_2->data)){
	echo '$form_2->data => ';
	echo print_r($form_2->data);
}
if(!empty($form_3->data)){
	echo '$form_3->data => ';
	echo print_r($form_3->data);
}

?>
</div>







<div>
<?php
echo "<h2>MYSQL LOG</h2>";
echo "<hr>";
foreach(\Console\Log::getMysql() as $log_data){
	//echo $log_data->file.' on line '.$log_data->line."\n";
	echo $log_data->sql."\n";
	echo "<br>---------------------------------------<br><br>";
}


?>
</div>







<div>
<?php
echo "<h2>SELECT * FROM MAN</h2>";
echo "<hr>";
$mr_man = $GLOBALS["mysql"]->query("
	SELECT *
	FROM man
");


echo '<table style="width:100%; text-align:left;">';
echo '<tr>';
	foreach($mr_man->key as $key){
		echo '<th>'.$key.'</th>';
	}
echo '</tr>';
foreach($mr_man->get_objects() as $man){
	echo '<tr>';
		foreach($mr_man->key as $key){
			echo '<td>'.$man->{$key}.'</td>';
		}
	echo '</tr>';
}
echo '</table>';
?>

</div>










</div>
