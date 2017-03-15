<?php


require_once ('config.php');

$bookObject = new Book();
if (isset($_GET['delete'])) {
	$bookObject->deleteBook((int)$_GET['delete']);
}

$res = $bookObject->listBooks(isset($_POST['searchString'])?$_POST['searchString']:null);

?>
<html>
<head></head>
<body>
<p>
<?php
if(isset($_GET['message'])) {
	echo base64_decode($_GET['message']);
}

?>
</p>

<a href='authors_page.php'>Authors</a><br>
<a href='books_page.php'>Books</a><br>
<a href='reports.php'>Reports</a><br><br><br>


<a href = 'books_add.php'>Add new Book</a>
<form method="POST">
	<input type="text" name='searchString' value= "<?php echo isset($_POST['searchString'])?$_POST['searchString']:'' ?>">
	<button type="submit">Search</button>
</form>

	<table cellpadding="1" cellspacing="2" border="1">
	<tr>
		<td>Id</td>
		<td>Title</td>
		<td>Author(s)</td>
		<td>Pages</td>
		<td>Publication Date</td>
		<td>Admin Actions</td>
	</tr>
	<?php

	foreach ($res as $key => $value) {
		?>

		<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['title']?></td>
		<td><?=$value['authors_']?></td>
		<td><?=$value['page_no']?></td>
		<td><?=$value['publication_date']?></td>
		<td>
			<a href='books_add.php?id=<?=$value['id']?>'>Edit</a> | <a href='books_page.php?delete=<?=$value['id']?>'>Delete</a>
		</td>
		

		</tr>
		<?php
	}
	?>
	</table>
</body>