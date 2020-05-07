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


$form = new \FormManager\Update("form");
echo '<b>$form = new \FormManager\Update("form")</b>'."\n";
echo "\n";
echo '<b>$form->send()</b> => '.$form->send()."\n";
echo '$form->getData("man", 1, "name") => '.$form->getData("man", 1, "name")."\n";
echo '$form->getData("man", 1, "age")  => '.$form->getData("man", 1, "age")."\n";
echo '$form->getData("house", 1, "street") => '.$form->getData("house", 1, "street")."\n";
echo '$form->getData("house", 1, "stl")  => '.$form->getData("house", 1, "stl")."\n";


?>
<form method="POST">
<label>name: </label>	<input type="text" name="form[man][1][name]" value="<?= $form->getData("man", 1, "name") ?>">
<label>age: </label>	<input type="text" name="form[man][1][age]" value="<?= $form->getData("man", 1, "age") ?>">

<label>street:</label>	<input type="text" name="form[house][1][street]" value="<?= $form->getData("house", 1, "street") ?>">
<label>stl: </label>	<input type="text" name="form[house][1][stl]" value="<?= $form->getData("house", 1, "stl") ?>">

<input type="submit" name="form[submit]" value="SEND">
</form>

<?php

echo "<br>---------------------------------------<br><br>";


$form_2 = new \FormManager\Update("form_2");
echo '<b>$form_2 = new \FormManager\Update("form")</b>'."\n";
echo '<b>$form_2->addForbiddenCols(["man" => ["id", "name"], "house" => ["street"]])</b>'."\n";
$form_2->addForbiddenCols(["man" => ["id", "name"], "house" => ["street"]]);
echo "\n";
echo '<b>$form_2->send()</b> => '.$form_2->send()."\n";
echo '$form_2->getData("man", 1, "name") => '.$form_2->getData("man", 1, "name")."\n";
echo '$form_2->getData("man", 1, "age")  => '.$form_2->getData("man", 1, "age")."\n";
echo '$form_2->getData("house", 1, "street") => '.$form_2->getData("house", 1, "street")."\n";
echo '$form_2->getData("house", 1, "stl")  => '.$form_2->getData("house", 1, "stl")."\n";


?>
<form method="POST">
<label>name: </label>	<input type="text" name="form_2[man][1][name]" value="<?= $form_2->getData("man", 1, "name") ?>">
<label>age: </label>	<input type="text" name="form_2[man][1][age]" value="<?= $form_2->getData("man", 1, "age") ?>">

<label>street:</label>	<input type="text" name="form_2[house][1][street]" value="<?= $form_2->getData("house", 1, "street") ?>">
<label>stl: </label>	<input type="text" name="form_2[house][1][stl]" value="<?= $form_2->getData("house", 1, "stl") ?>">

<input type="submit" name="form_2[submit]" value="SEND">
</form>

<?php

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

<?php
echo "<h2>SELECT * FROM HOUSE</h2>";
echo "<hr>";
$mr_house = $GLOBALS["mysql"]->query("
	SELECT *
	FROM house
");


echo '<table style="width:100%; text-align:left;">';
echo '<tr>';
	foreach($mr_house->key as $key){
		echo '<th>'.$key.'</th>';
	}
echo '</tr>';
foreach($mr_house->get_objects() as $house){
	echo '<tr>';
		foreach($mr_house->key as $key){
			echo '<td>'.$house->{$key}.'</td>';
		}
	echo '</tr>';
}
echo '</table>';
?>
</div>










</div>
