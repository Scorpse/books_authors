<?php

class Book extends BasicModel
{
	protected $link;
	protected $db;

	protected $id, $title, $summary, $page_no, $publication_date;

	protected $field_validation = [
		'title' => '/[a-z\s]/i',
		'page_no' => '/[0-9]/i',
	];

	public function __construct($id = null)
	{
		parent::__construct($id);

		if($id) {

			$sql = "SELECT b.* FROM books b  WHERE id = $id";
			$result = $this->link->query($sql);
			$book = $result->fetch_all(true);
			$book = array_pop($book);
			$this->id = $book['id'];
			$this->title = $book['title'];
			$this->summary = $book['summary'];
			$this->page_no = $book['page_no'];
			$this->publication_date = $book['publication_date'];
			

		}
	}

	public function addBook(array $arr)
	{
		//


		if (isset($arr['id']) && (int)$arr['id']>0) {

		echo $sql = "
			UPDATE books
			SET 
			title='{$arr['title']}',
			summary='{$arr['summary']}',
			page_no= '{$arr['page_no']}',
			publication_date='{$arr['publication_date']}'
			
			where id = {$arr['id']}
								";
		}else
		{

		echo $sql = "
			Insert INTO books
			(title,summary,page_no,publication_date)
			values
			('{$arr['title']}', '{$arr['summary']}', '{$arr['page_no']}', '{$arr['publication_date']}')

		";
		}

		$result = $this->link->query($sql);

		$id =  isset($this->id)?$this->id:$this->link->insert_id;
		//add books;

		$sql = "Delete from author_book where id_book = $id";
		
		$res= $this->link->query($sql);
		foreach($arr['authors'] as $k=>$v) {
		$sql = "insert into author_book (id_author, id_book) values ($v,$id)";
			$res= $this->link->query($sql);
		}
	
		return $result;
	}

	public function deleteBook($id) {
		$sql = "Delete from books where id = $id";
		$res= $this->link->query($sql);
	
		$sql = "Delete from author_book where id_book = $id";
		$res= $this->link->query($sql);

		return true;
	}


	public function listBooks($search = null)
	{

		$searchString = $this->link->real_escape_string($search);

		if($searchString) {
			$searchString = " where b.title like '%$search%' OR a.last_name like '%$search%' or a.first_name like '%$search%' ";
		}

		$sql = "SELECT b.*, GROUP_CONCAT(a.first_name, ' ', a.last_name) authors_ FROM  books b left join `author_book` ab  on b.id = ab.id_book left join authors a on a.id = ab.id_author $searchString group by b.id order by b.title ";
		
		$result = $this->link->query($sql);



		return $result->fetch_all(true);
	

	}

	public function getAllBooks($simple = false) {
		$sql = "SELECT b.* FROM  books b";
		
		$result = $this->link->query($sql);
		$books = $result->fetch_all(true);

		if ($simple && count($books)>0) {
				foreach($books as $k=>$v) {
					$simpleBooks[$v['id']] = $v['title'];
				}
				return $simpleBooks;
			}

		return $books;
	}

	public function validateInputs(array $arr)
	{
		parent::validateInputs($arr);
		
		if (!(isset($arr['publication_date']))) {
			throw new Exception('Invalid Field: birthday');
		}
		return true;
	}

	public function getBookAuthors($simple = false) {
		if (isset($this->id)) {
			$sql = "SELECT a.* FROM authors a left join `author_book` ab  on a.id = ab.id_author WHERE ab.id_book = ". $this->id;
			$result = $this->link->query($sql);
			$authors = $result->fetch_all(true);
			if ($simple && count($authors)>0) {
				foreach($authors as $k=>$v) {
					$simpleAuthors[$v['id']] =  $v['first_name'].' '.$v['first_name'];;
				}
				return $simpleAuthors;
			}
			return $authors;
		}

		return [];
	}

}