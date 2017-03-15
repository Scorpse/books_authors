<?php

require_once ('config.php');

$id = isset($_GET['id'])?(int)$_GET['id']:null;
$bookObject = new Book($id);

$message = '';

if (isset($_POST) && count($_POST)>0) {

	
	$bookObject->title = $_POST['title'];
	$bookObject->summary = $_POST['summary'];
	$bookObject->page_no = $_POST['page_no'];
	$bookObject->publication_date = $_POST['publication_date'];


	try{
		$bookObject->validateInputs($_POST);
		$bookObject->addBook($_POST);
		header("Location: books_page.php?message=".base64_encode('Book added'));
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
<input type='hidden' name = 'id' value="<?=$bookObject->id?>">
<label for="title">Title</label><input type=text name="title" value="<?=$bookObject->title;?>"> <br>
<label for="summary">Summary</label><textarea name="summary"><?=$bookObject->summary;?></textarea><br>
<label for="page_no">Page no</label><input type=text name="page_no" value="<?=$bookObject->page_no;?>"><br>
<label for="publication_date">Publication Date</label><input type=date name="publication_date" value="<?=$bookObject->publication_date;?>"><br>


<?php
$authors = $bookObject->getBookAuthors(true);


$bookObject = new Author();
$allauthors = $bookObject->getAllAuthors(true);


?>
<select name='authors[]' multiple='multiple'>
<?php
foreach($allauthors as $k=>$v) {
?>
<option value="<?=$k?>" <?=(in_array($v, $authors)?'selected="selected"':'');?>><?=$v?></option>

<?php 
}
?>	
</select>

<button type="submit">Add</button>
</form>

</body>
</html>
