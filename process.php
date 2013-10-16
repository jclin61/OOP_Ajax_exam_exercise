<?php

require("connection.php");

class Process{

	var $connection;
	// __construct function to be called when forms are submitted.
	public function __construct(){

		$this->connection = new Database();

		if(isset($_POST['category']) AND $_POST['category']!= "--select--")
		{
			$this->add_product();
		}	
		else if(isset($_POST['id_delete']))
		{
			$this->delete_product();
		}
		else
		{
			$this->show_product();
		}
	}

	public function add_product(){

		$query = "INSERT INTO products (name, category, description) VALUES ('{$_POST['name']}', '{$_POST['category']}', '{$_POST['description']}')";


		mysql_query($query);

		$this->show_product();

	}

	public function delete_product(){

		$query = "DELETE FROM products WHERE id = '{$_POST['id_delete']}'";
		mysql_query($query);

		$this->show_product();

	}

	public function show_product(){


			$query = "SELECT * FROM products";
			$products = $this->connection->fetch_all($query);

			$data="
					<table class='table table-bordered'>
					<thead>
						<tr>
							<th>Name</th>
							<th>Category</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
					</thead>
						<tbody>
					";

			foreach($products as $product)
			{
				$data .="
				<tr>
					<td>".$product['name']."</td>
					<td>".$product['category']."</td>
					<td>".$product['description']."</td>
					<td>
					<form class='delete' action='process.php' method='post'>
						<input type='hidden' name='id_delete' value=".$product['id'].">
						<input class='id_delete' type='submit' value='delete'>
					</form>
					</td>
				</tr>";
			}
			$data .="
						</tbody>
					</table>
					";

			echo json_encode($data);
	}
	
}

$process = new Process();

?>