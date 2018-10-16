<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Wikipedia Search Using Api</title>
	<link rel="stylesheet" href="https://unpkg.com/sakura.css/css/sakura.css" type="text/css">
	<style type="text/css">
		input[type="text"]{
			width:80%;
		}
	</style>
</head>
<body>
	<form id="searchForm" method="get">
		<input type="text" name="search" placeholder="Enter your search query here" required="">
		<input type="submit">
	</form>
	<?php 
		if(@$_GET['search']){
			$api_url = "https://en.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&titles=".ucwords($_GET['search'])."&redirects=true";
			$api_url = str_replace(' ','%20',$api_url);

			if($data = json_decode(@file_get_contents($api_url))){
				foreach ($data->query->pages as $key=>$val) {
					$pageId = $key;
					break;
				}
				$content = $data->query->pages->$pageId->extract;
				header('Content-Type:text/html; charset=utf-8');
				echo $content;
			}else{
				echo 'No Result Found..';
			}
		}
	?>	
</body>
</html>