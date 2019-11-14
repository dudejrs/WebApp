<!DOCTYPE html>
<html>
<head>
	<title>lab07:sql</title>
</head>
<body>
	<?php 
			$DBname = 'imdb_small';
			$SQL_query = "SELECT actor_id,first_name,last_name,count(actor_id) FROM actors a
				JOIN roles r ON a.id = r.actor_id
				JOIN movies m ON m.id = r.movie_id
				GROUP BY actor_id 
				ORDER BY count(actor_id) DESC
				LIMIT 7";


				?>
	<h1>top 7 actors who have appeared in the most films</h1>
	<ul>
	<?php
			try{
			$db = new PDO("mysql:host=127.0.0.1;dbname=$DBname","root","root");
			$rows= $db ->query($SQL_query);

			foreach ($rows as $row) {
				?>
				<li> 
					<?php
					echo "actor_id : ".$row["actor_id"]." / first_name : ".$row["first_name"]." / last_name : ".$row["last_name"]." / count(actor_id) : ".$row["count(actor_id)"]
				?>	
				</li>
				<?php
			}


		}catch (PDOException $ex){
			?>
			<li>
							<p> Sorry, a database error occured. Please try again later.</p>
							<p> (Error details :<?=$ex->getMessage() ?> )</p>
						</li>			
			<?php
		}
	?>

	</ul>
	<p>render success</p>
</body>
</html>