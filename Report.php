<?php

class Report
{
	protected $link;
	protected $db;


	public function __construct()
	{
		$db = $this->db = Database::getInstance();
		$this->link = $db->getConnection();
	}

	

	public function getAuthorsNum()
	{

		$sql = "Select Count(*) as author_num from authors";
		
		$result = $this->link->query($sql);

		return $result->fetch_all(true);
	

	}

	public function getBooksNum()
	{

		$sql = "Select Count(*) as book_num from books";
		
		$result = $this->link->query($sql);

		return $result->fetch_all(true);
	

	}

	public function getBestAuthor()
	{

		$sql = "SELECT a.*, count(b.id) books_num FROM `author_book` ab left join authors a on a.id = ab.id_author left join books b on b.id = ab.id_book WHERE 1 group by a.id order by books_num DESC LIMIT 1";
		
		$result = $this->link->query($sql);

		return $result->fetch_all(true);
	

	}

	public function getBestBook()
	{

		$sql = "SELECT b.*, count(a.id) authors_num FROM `author_book` ab left join books b on b.id = ab.id_book left join authors a on a.id = ab.id_author group by b.id order by authors_num DESC LIMIT 1";
		
		$result = $this->link->query($sql);

		return $result->fetch_all(true);
	

	}



}