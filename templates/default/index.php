<?php

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="templates/<?echo $TEMPLT?>/css.css" />
		<title><?echo $SITENM?></title>
	</head>
	<body>
		<div id="wrapper">
			<div id="topmenu"><?mainMenu()?></div>
			<div id="topsearch">Search</div>
			<div id="header"><h3><a href="index.php"><?echo $SITENM?></a></h3></div>
			<div id="left"><?loginWidget();?></div>
			<div id="content"><?menuSet();?></div>
			<div id="footer">Footer</div>
		</div>
	<body>
</html>