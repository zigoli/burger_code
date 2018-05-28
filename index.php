<!DOCTYPE html>
<html>
	<head>
		<title>Burger Code</title>
  		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="js/script.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
	</head>
	<body>

		<div class="container site">
		<h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> ZIGOLI'S Burger  <span class="glyphicon glyphicon-cutlery"></span></h1>

			<?php

			require 'admin/database.php';

			echo  '<nav>
				<ul class="nav nav-pills">';

			$db = Database::connect();
			$statement = $db->query('SELECT * FROM categories');
			$categories = $statement->fetchAll();
			foreach($categories as $category){
				if($category['id'] == '1')
					echo '<li role="presentation" class="active"><a href="#' .$category['id']  . '"  data-toggle="tab">' .$category['name'] . ' </a></li>';
				     else
						 echo '<li role="presentation"><a href="#' .$category['id']  . '"  data-toggle="tab">' .$category['name'] . ' </a></li>';
				}
			      echo '</ul>
				  	</nav>';

				  echo '<div class="tab-content">';

				foreach($categories as $category){
				if($category['id'] == '1')
					echo '<div class="tab-pane active" id="' . $category['id'] . '">';
				     else
						 echo '<div class="tab-pane" id="' . $category['id'] . '">';
					echo '<div class="row">';

					  $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
					  $statement->execute(array($category['id']));
			        while($item = $statement->fetch()){
						echo '<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
						<img src="images/' . $item['image'] . '" alt="...">
						<div class="price">'. number_format($item['price'], 2, '.', '').'€</div>
							<div class="caption">
								<h4>' . $item['name'] . '</h4>
								<p>' . $item['description'] . '</p>
								<a href="#" class="btn btn-order" role="button"><span class="glyphicon glyphicon-shopping-cart"></span> Commander</a>
							</div>
						</div>
					</div>';
			}
			    echo '</div>
					</div>';
			}
			Database::disconnect();

			echo '</div>';
			?>

		</div>

		<footer class="footer"> Copyright 2018 zigoli's web Development society</footer>

	</body>


</html>
