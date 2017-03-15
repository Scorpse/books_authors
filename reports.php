<?php


require_once ('config.php');

$reportObject = new Report();



?>
<html>
<head></head>
<body>
	
<a href='authors_page.php'>Authors</a><br>
<a href='books_page.php'>Books</a><br>
<a href='reports.php'>Reports</a><br><br><br>

	<table cellpadding="1" cellspacing="2" border="1">
	<tr>
		<td>Authors Num</td>
		<td>Books Num</td>
		<td>Best Author</td>
		<td>Best Book</td>
	</tr>
	<tr>
		<td>
		<?php
		$res = $reportObject->getAuthorsNum();
		$res = array_pop($res);
		echo $res['author_num'];
		?>
		</td>
		<td>
		<?php
		$res = $reportObject->getBooksNum();
		$res = array_pop($res);
		echo $res['book_num'];
		?>
		</td>
		<td>
		<?php
		$res = $reportObject->getBestAuthor();
		$res = array_pop($res);
		echo $res['first_name'].' '.$res['last_name'].' ('.$res['books_num'].')';
		?> 
		</td>
		<td>
		<?php
		$res = $reportObject->getBestbook();
		$res = array_pop($res);
		echo $res['title']. '('.$res['authors_num'].')';
		?> 
		</td>
	</tr>
	
	</table>
</body>