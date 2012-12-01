<?php
$con = mysql_connect($DBSERV, $DBUSER, $DBPASS);
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db($DBNAME, $con);
?>
