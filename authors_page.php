<?php


require_once ('config.php');

$authorObject = new Author();
if (isset($_GET['delete'])) {
	$authorObject->deleteAuthor((int)$_GET['delete']);
}
$res = $authorObject->listAuthors();

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

<a href = 'authors_add.php'>Add new Author</a>
	<table cellpadding="1" cellspacing="2" border="1">
	<tr>
		<td>Id</td>
		<td>Name</td>
		<td>Books</td>
		<td>Birthday</td>
		<td>Email</td>
		<td>Admin Actions</td>
	</tr>
	<?php

	foreach ($res as $key => $value) {
		?>

		<tr>
		<td><?=$value['id']?></td>
		<td><?=$value['first_name']?> <?=$value['last_name']?></td>
		<td><?=$value['books']?></td>
		<td><?=$value['birthday']?></td>
		<td><?=$value['email']?></td>
		<td>
			<a href='authors_add.php?id=<?=$value['id']?>'>Edit</a> | <a href='authors_page.php?delete=<?=$value['id']?>'>Delete</a>
		</td>
		

		</tr>
		<?php
	}
	?>
	</table>
</body>