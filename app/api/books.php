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