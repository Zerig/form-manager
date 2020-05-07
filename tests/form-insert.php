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

//$form = new \FormManager\Insert("man", ["id" => 1]);
$form = new \FormManager\Insert("form");
echo '<b>$form = new \FormManager\Insert("form")</b>'."\n";
echo '<b>$form->send()</b> => '.$form->send()."\n";
echo '$form->getData("man", 0, "name") => '.$form->getData("man", 0, "name")."\n";
echo '$form->getData("man", 0, "age")  => '.$form->getData("man", 0, "age")."\n";
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
<label>name: </label>	<input type="text" name="form[man][0][name]" value="<?= $form->getData("man", 0, "name") ?>">
<label>age: </label>	<input type="text" name="form[man][0][age]" value="<?= $form->getData("man", 0, "age") ?>">

<label>name: </label>	<input type="text" name="form[man][1][name]" value="<?= $form->getData("man", 1, "name") ?>">
<label>age: </label>	<input type="text" name="form[man][1][age]" value="<?= $form->getData("man", 1, "age") ?>">

<input type="submit" name="form[submit]" value="SEND">
</form>

<?php

echo "<br>---------------------------------------<br><br>";

$form_2 = new \FormManager\Insert("form_2");
echo '<b>$form_2 = new \FormManager\Insert("form_2")</b>'."\n";
echo '<b>$form_2->send(["man" => [ 0 => ["age" => 28]]])</b> => '.$form_2->send(["man" => [ 0 => ["age" => 28]]])."\n";
echo '$form_2->getData("man", 0, "id") => '.$form_2->getData("man", 0, "id")."\n";
echo '$form_2->getData("man", 0, "name") => '.$form_2->getData("man", 0, "name")."\n";
echo '$form_2->getData("man", 0, "age")  => '.$form_2->getData("man", 0, "age")."\n";

?>
<form method="POST">
<label>id: </label>	<input type="text" name="<?= $form_2->name("man", 0, "id") ?>" value="<?= $form_2->getData("man", 0, "id") ?>">
<label>name: </label>	<input type="text" name="<?= $form_2->name("man", 0, "name") ?>" value="<?= $form_2->getData("man", 0, "name") ?>">
<label>age: </label>	<input type="text" name="<?= $form_2->name("man", 0, "age") ?>" value="<?= $form_2->getData("man", 0, "age") ?>">

<input type="submit" name="form_2[submit]" value="SEND">
</form>

<?php

echo "<br>---------------------------------------<br><br>";



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



<?php
echo "<h2>REPORT</h2>";
echo "<hr>";
foreach(\Report\Form::get() as $data){
	//echo $log_data->file.' on line '.$log_data->line."\n";
	echo $data->msg."\n";
	echo "<br>---------------------------------------<br><br>";
}


?>
</div>










</div>
