<?php

require_once ('config.php');


$id = isset($_GET['id'])?(int)$_GET['id']:null;
$authorObject = new Author($id);

$message = '';

if (isset($_POST) && count($_POST)>0) {

	
	$authorObject->first_name = $_POST['first_name'];
	$authorObject->last_name = $_POST['last_name'];
	$authorObject->email = $_POST['email'];
	$authorObject->birthday = $_POST['birthday'];
	$authorObject->phone = $_POST['phone'];


	try{
		$authorObject->validateInputs($_POST);
		$authorObject->addAuthor($_POST);
		header("Location: authors_page.php?message=".base64_encode('Author added'));
		exit;
	}catch(Exception $e) {

		$message = $e->getMessage();
	}
}

?>
<html>
<head></head>
<body>
<p>
<?=$message?>


</p>

<form method="POST">
<input type='hidden' name = 'id' value="<?=$authorObject->id?>">
<label for="first_name">First name</label><input type=text name="first_name" value="<?=$authorObject->first_name;?>"> <br>
<label for="last_name">Last name</label><input type=text name="last_name" value="<?=$authorObject->last_name;?>"><br>
<label for="phone">Phone</label><input type=text name="phone" value="<?=$authorObject->phone;?>"><br>
<label for="email">email</label><input type=email name="email" value="<?=$authorObject->email;?>"><br>
<label for="birthday">Birthday</label><input type=date name="birthday" value="<?=$authorObject->birthday;?>"><br>


<?php
$books = $authorObject->getAuthorBooks(true);


$bookObject = new Book();
$allbooks = $bookObject->getAllBooks(true);


?>
<select name='books[]' multiple='multiple'>
<?php
foreach($allbooks as $k=>$v) {
?>
<option value="<?=$k?>" <?=(in_array($v, $books)?'selected="selected"':'');?>><?=$v?></option>

<?php 
}
?>	
</select>

<button type="submit">Add</button>
</form>

</body>
</html>
