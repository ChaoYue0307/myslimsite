<?php
//display all records
	$app->get('/api/books',function(){
		require_once('dbconnect.php');

		$query = "select * from books order by id";
		$result = $mysqli->query($query);

		while($row = $result-> fetch_assoc()){
			$data[]=$row;
		}

		if(isset($data)){
			header('Content-Type: application/json');
			echo json_encode($data);
		}
		

	});

	//dispaly a singel row
	$app->get('/api/books/{id}',function($request){
		require_once('dbconnect.php');

		$id = $request->getAttribute('id');
		echo "The id is ".$id."\n";
		$query = "select * from books where id = $id";
		$result = $mysqli->query($query);

		while($row = $result-> fetch_assoc()){
			$data[]=$row;
		}

		if(isset($data)){
			header('Content-Type: application/json');
			echo json_encode($data);
		}
		

	});

	//post data and create a new record

	$app->put('/api/books/{id}',function($request){
		
		/*$my_name = $request->getParsedBody()['my_name'];//PSR-7 way to get post data
		echo "hello ".$my_name;*/
		require_once("dbconnect.php");
		$id = $request->getAttribute('id');
		//$query = "INSERT INTO `books`(`book_title`, `author`, `amazon_url`) VALUES (?,?,?)";
$query = "UPDATE `books` SET `book_title` = ?, `author` = ?, `amazon_url` = ? WHERE `books`.`id` = $id;";
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("sss",$a,$b,$c);

		

			$a = $request->getParsedBody()['book_title'];
			$b = $request->getParsedBody()['author'];
			$c = $request->getParsedBody()['amazon_url'];

			$stmt->execute();				
	});

//delete a record from the database
	$app->delete('/api/books/{id}',function($request){
		
		/*$my_name = $request->getParsedBody()['my_name'];//PSR-7 way to get post data
		echo "hello ".$my_name;*/
		require_once("dbconnect.php");
		$id = $request->getAttribute('id');
		//$query = "INSERT INTO `books`(`book_title`, `author`, `amazon_url`) VALUES (?,?,?)";
		$query = "delete from books WHERE id = $id";
		$stmt = $mysqli->prepare($query);
		$stmt->execute();	

	});

		