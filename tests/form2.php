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
$form = new \FormManager\Form("form");
echo '<b>$form = new \FormManager\Form("man")</b>'."\n";
echo '<b>$form->send()</b> => '.$form->send()."\n";
echo '$form->getData("name") => '.$form->getData("man", "name")."\n";
echo '$form->getData("age")  => '.$form->getData("man", "age")."\n";

?>
<form method="POST">
<label>name: </label>	<input type="text" name="form[man][name]" value="<?= $form->getData("man", "name") ?>">
<label>age: </label>	<input type="text" name="form[man][age]" value="<?= $form->getData("man", "age") ?>">
<input type="submit" name="form[submit]" value="SEND">
</form>

<?php

echo "<br>---------------------------------------<br><br>";

$form = new \FormManager\Form("form_2");
echo '<b>$form = new \FormManager\Form("man")</b>'."\n";
echo '<b>$form->send(["man" => ["age" => 28]])</b> => '.$form->send(["man" => ["age" => 28]])."\n";
echo '$form->getData("name") => '.$form->getData("man", "name")."\n";
echo '$form->getData("age")  => '.$form->getData("man", "age")."\n";

?>
<form method="POST">
<label>name: </label>	<input type="text" name="form_2[man][name]" value="<?= $form->getData("man", "name") ?>">
<label>age: </label>	<input type="text" name="form_2[man][age]" value="<?= $form->getData("man", "age") ?>">
<input type="submit" name="form_2[submit]" value="SEND">
</form>

<?php

echo "<br>---------------------------------------<br><br>";


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


?>
</div>








</div>
