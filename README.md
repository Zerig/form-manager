# FORM MANAGER \ FORM
- needs [**SqlManager**](https://github.com/Zerig/sql-manager)
Works with formular data and items.


- **$form [string]** identification **name** of formular
You have to choose if you want data *INSERT* or *UPDATE*. This parent class just have only methods which are universal for both variant.

```php
$form = new \FormManager\Insert("form");
$form->send();	// only if form was send
```

```html
<form method="POST">
	<label>name: </label>
	<input type="text" name="form[man][0][name]" value="<?= $form->getData("man", 0, "name") ?>">

	<label>age: </label>
	<input type="text" name="form[man][0][age]" value="<?= $form->getData("man", 0, "name") ?>">

	<input type="submit" name="form[submit]" value="SEND">
</form>
```

```html
<form method="POST">
	<?php $table = "man"; ?>
	<?php for($i = 0; $i < 1; $i++){ ?>
		<label>name: </label>
		<input type="text" name="<?= $form->name($table, $i, "name") ?>" value="<?= $form->getData($table, $i, "name") ?>">

		<label>age: </label>
		<input type="text" name="<?= $form->name($table, $i, "age") ?>" value="<?= $form->getData($table, $i, "age") ?>">
	<?php } ?>

	<input type="submit" name="<?= $form->name("submit") ?>" value="SEND">
</form>
```

```js
// set HTML FORM values - you cannot use this code. You can just write it into INPUTS!
document.getElementsByName("form[man][0][name]").value = "Jeronym";
document.getElementsByName("form[man][0][age]").value  = "28";
```

```php
// BEFORE pushing button SUBMIT
$form->getData("man", 0, "name") => ""
$form->getData("man", 0, "age")  => ""

// AFTER pushing button SUBMIT
$form->getData("man", 0, "name") => "Jeronym"
$form->getData("man", 0, "age")  => "28"

```

<hr>

## send($data = [])
- **$data [array of array of array]**

There you can set data which are not in form, but they will be send with them. For example data, which are not in user permissions.\n
It is for *INSERT* and *UPDATE*.
```php
$form = new \FormManager\Insert("form");
$form->send([
	"man" => [
		[0] => [
			"age" => 99
		]
	]
]);
```
```html
<form method="POST">
	<?php $table = "man"; ?>
	<?php for($i = 0; $i < 1; $i++){ ?>
		<label>name: </label>
		<input type="text" name="<?= $form->name($table, $i, "name") ?>" value="<?= $form->getData($table, $i, "name") ?>">

		<label>age: </label>
		<input type="text" name="<?= $form->name($table, $i, "age") ?>" value="<?= $form->getData($table, $i, "age") ?>">
	<?php } ?>

	<input type="submit" name="<?= $form->name("submit") ?>" value="SEND">
</form>
```

```js
// set HTML FORM values - you cannot use this code. You can just write it into INPUTS!
document.getElementsByName("form[man][0][name]").value = "Jeronym";
document.getElementsByName("form[man][0][age]").value  = "28";
```
```php
// BEFORE pushing button SUBMIT
$form->getData("man", 0, "name") => ""
$form->getData("man", 0, "age")  => ""

// AFTER pushing button SUBMIT
$form->getData("man", 0, "name") => "Jeronym"	// WRITTEN VALUE
$form->getData("man", 0, "age")  => "99"		// FIXED VALUE not WRITTEN

```



<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>






```php
$form = new \FormManager\Update("form");
$form->send();	// only if form was send
```



```html
<form method="POST">
	<label>name: </label>
	<input type="text" name="form[man][1][name]" value="">

	<label>age: </label>
	<input type="text" name="form[man][1][age]" value="">

	<input type="submit" name="form[submit]" value="SEND">
</form>
```

```html
<form method="POST">
	<?php for($i = 1; $i < 1; $i++){ ?>
		<label>name: </label>
		<input type="text" name="<?= $form->name("man", $i, "name") ?>" value="<?= $form->getData("man", $i, "name") ?>">

		<label>age: </label>
		<input type="text" name="<?= $form->name("man", $i, "age") ?>" value="<?= $form->getData("man", $i, "age") ?>">
	<?php } ?>

	<input type="submit" name="<?= $form->name("submit") ?>" value="SEND">
</form>
```

```php
$form->getData("man", 0, "name") => ""
$form->getData("man", 0, "age")  => ""

```
