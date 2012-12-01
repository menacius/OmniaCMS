<?php

?>
<html>
	<head>
		<title><?echo $SITENM?></title>
	</head>
	<body>
		<table border="1" align="center">
			<tr   VALIGN="top">
				<td colspan = "3"><h3><a href="index.php"><?echo $SITENM?></a></h3></td>
			<tr   VALIGN="top">
				<td colspan = "2"><?mainMenu()?></td>
				<td>Search</td>
			</tr>
			<tr   VALIGN="top">
				<td width="200px"><?loginWidget();?></td>
				<td width="600px"><?menuSet();?></td>
				<td width="200px">Right</td>
			</tr>
		</table>
	<body>
</html>