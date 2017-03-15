<?php

class Author extends BasicModel
{
	protected $link;
	protected $db;

	protected $id,$first_name,$last_name,$email,$birthday,$phone;


	protected $field_validation = [
		'first_name' => '/[a-z\s]/i',
		'last_name' => '/[a-z\s]/i',
		'phone' => '/[0-9\s\+]/i',
	];


	public function getAuthorBooks($simple = false) {
		if (isset($this->id)) {
			$sql = "SELECT b.* FROM books b left join `author_book` ab  on b.id = ab.id_book WHERE ab.id_author = ". $this->id;
			$result = $this->link->query($sql);

			$books = $result->fetch_all(true);
			if ($simple && count($books)>0) {
				foreach($books as $k=>$v) {
					$simpleAuthors[$v['id']] = $v['title'];
				}
				return $simpleAuthors;
			}
			return $books;
		}

		return [];
	}

	public function __construct($id = null)
	{
		$db = $this->db = Database::getInstance();
		$this->link = $db->getConnection();

		if($id) {

			$sql = "SELECT a.* FROM authors a  WHERE id = $id";
			$result = $this->link->query($sql);
			$author = $result->fetch_all(true);
			$author = array_pop($author);
			$this->id = $author['id'];
			$this->first_name = $author['first_name'];
			$this->last_name = $author['last_name'];
			$this->email = $author['email'];
			$this->birthday = $author['birthday'];
			$this->phone = $author['phone'];

		}
	}

	public function deleteAuthor($id) {
		$sql = "Delete from authors where id = $id";
		$res= $this->link->query($sql);
	
		$sql = "Delete from author_book where id_author = $id";
		$res= $this->link->query($sql);

		return true;
	}

	public function addAuthor(array $arr)
	{
		//
		if (isset($arr['id']) && (int)$arr['id']>0) {

		$sql = "
			UPDATE Authors
			SET 
			first_name='{$arr['first_name']}',
			last_name='{$arr['last_name']}',
			phone= '{$arr['phone']}',
			email='{$arr['email']}',
			birthday='{$arr['birthday']}'

			where id = {$arr['id']}
								";
		}else
		{

		$sql = "
			Insert INTO Authors
			(first_name,last_name,phone,email,birthday)
			values
			('{$arr['first_name']}', '{$arr['last_name']}', '{$arr['phone']}', '{$arr['email']}', '{$arr['birthday']}')

		";
		}

		$result = $this->link->query($sql);

		$id =  isset($this->id)?$this->id:$this->link->insert_id;
		//add books;

		$sql = "Delete from author_book where id_author = $id";
		var_dump($sql);
		$res= $this->link->query($sql);
		foreach($arr['books'] as $k=>$v) {
			$sql = "insert into author_book (id_author, id_book) values ($id,$v)";
			$res= $this->link->query($sql);
		}

		return $result;
	}

	public function listAuthors()
	{

		$sql = "SELECT a.*, GROUP_CONCAT(b.title) books FROM authors a  left join `author_book` ab on a.id = ab.id_author left join books b on b.id = ab.id_book WHERE 1 group by a.id order by a.last_name, a.first_name ";
		
		$result = $this->link->query($sql);



		return $result->fetch_all(true);
	

	}

	public function validateInputs(array $arr)
	{
		parent::validateInputs($arr);
		
		if (!(isset($arr['email']) && filter_var($arr['email'], FILTER_VALIDATE_EMAIL))) {
			throw new Exception('Invalid Field: email');
		}
		if (!(isset($arr['birthday']))) {
			throw new Exception('Invalid Field: birthday');
		}
		return true;
	}

	public function getAllAuthors($simple = false) {
		$sql = "SELECT a.* FROM  authors a";
		
		$result = $this->link->query($sql);
		
		$authors = $result->fetch_all(true);

		if ($simple && count($authors)>0) {
				foreach($authors as $k=>$v) {
					$simpleAuthors[$v['id']] = $v['first_name'].' '.$v['first_name'];
				}
				return $simpleAuthors;
			}

		return $authors;
	}

}