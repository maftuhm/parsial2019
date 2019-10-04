<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kartu Peserta PARSIAL 2019</title>

<style type="text/css">
@page {
	margin: 15px;
}
body {
	background-color: #fff;
	font-family: Lucida Grande, Verdana, Sans-serif;
	font-size: 18px;
	color: #000000;
}
img {
	width: 100%;
	height: auto;
}
#main {
	position: absolute;
	top : 125px;
	left: 380px;
}
#main ul li{
	list-style: none;
	font-size: 62px;
	border: 1px;
}
</style>
</head>
<body>
	<?php foreach ($tryout as $user):?>
	<img src="upload/images/kartu-peserta-<?php echo $user->choice;?>.jpg">
	<div id="main">
		<ul>
			<li style="color: <?php echo $user->color;?>;"><?php echo '<b>'.sub_string_name($user->name).'</b>';?></li>
			<li style="color: <?php echo $user->color;?>;"><?php echo '<b>'.$user->number.'</b>';?></li>
		</ul>		
	</div>
	<?php endforeach;?>
</body>
</html>