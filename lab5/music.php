<!DOCTYPE html>
<html lang="en">

	<head>
		<title>Music Library</title>
		<meta charset="utf-8" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/5/music.jpg" type="image/jpeg" rel="shortcut icon" />
		<link href="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/labResources/music.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<h1>My Music Page</h1>
		<?php 
		$news_pages = $_GET["news_pages"];
		if($news_pages == 0) $news_pages = 5;
		 ?>
		<!-- Ex 1: Number of Songs (Variables) -->
		<p>
			<?php
			$song_count = 1234;
			$song_count = 5678;
			$hours_music = 123;
			$hours_music = 567;
			print " I love music. I have $song_count total song, which is over $hours_music hours of music!";
			?>

		</p>

		<!-- Ex 2: Top Music News (Loops) -->
		<!-- Ex 3: Query Variable -->
		<div class="section">
			<h2>Billboard News</h2>
		
			<ol>
				<?php for($i=0; $i< $news_pages; $i++) { ?>
			    <li><a href=<?php 
			    	$format1 = "https://www.billboard.com/archive/article/2019%1$02d";
			    	printf($format1,11-$i);
			    	?>
			    >2019-<?php printf("%1$02d",11-$i) ?></a></li>
				<?php }
				?>
			</ol>
		</div>

		<!-- Ex 4: Favorite Artists (Arrays) -->
		<?php
			$favorite_artist = array("Guns N\'Roses","Green Day","Blink182","Queen");
		?>
		<!-- Ex 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2>
		
			<ol>
				<?php
					foreach ( file("favorite.txt") as $favorite_artist2){
						$token=explode(" ", $favorite_artist2);
						$url = "http://en.wikipedia.org/wiki/".implode("_",$token);
						?>
						<li><a href=<?=$url
						 ?>><?=$favorite_artist2  ?></a></li>
							
					<? }
				?>
			</ol>
		</div>
		
		<!-- Ex 6: Music (Multiple Files) -->
		<!-- Ex 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
			
			<ul id="musiclist">
				<?php
					function cmp( $a, $b){
						$size_of_a = filesize($a);
						$size_of_b = filesize($b);
						return ( $size_of_a <= $size_of_b);
					}
					$mp3items= glob("lab5/musicPHP/songs/*.mp3");
					uksort($mp3items, "cmp");
					foreach($mp3items as $mp3item){?>
	 					<li class="mp3item">
							<a href=<?= $mp3item ?>><?=basename($mp3item) ?></a> <span>(<?=(int)(filesize($mp3item)/1024) ?>KB)</span>
						</li> 
					<?	}
				?>

				<!-- Exercise 8: Playlists (Files) -->
				<?php
					$playlistitems = glob("lab5/musicPHP/songs/*.m3u");
					rsort($playlistitems);
					foreach($playlistitems as $playlistitem){ ?>
						<li class="playlistitem">
							<b> <?= basename($playlistitem) ?></b>
							<ul>
								<?php
									foreach(file($playlistitem) as $content){
										if( strpos($content,"#") <> "false"){ ?>
											<li><?=  $content ?></li>
										<?}
									}
								?>
							</ul>
						</li>
					<?}
				?>


			</ul>
		</div>

		<div>
			<a href="https://validator.w3.org/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="https://jigsaw.w3.org/css-validator/check/referer">
				<img src="https://selab.hanyang.ac.kr/courses/cse326/2019/labs/images/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>
