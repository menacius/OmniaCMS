<?
require_once "../../../config/config.php";
require_once $SITERT . "/essentials/connect.php";

$postsql = mysql_query("SELECT * FROM
(postcategories LEFT JOIN posts ON postcategories.postcategoryid = posts.postcategoryid)
LEFT JOIN users ON posts.userid = users.userid
WHERE posts.postid = $_GET[post] AND posts.publish = 1");

while($row = mysql_fetch_array($postsql)) {
	echo "<h3>" . $row['postheader'] . "</h3></br>
	<small>by:" . $row['username'] . "</small></br>
	<small>date:" . $row['postdate'] . "</small></br>"
	. $row['post'] . "";
}
?>