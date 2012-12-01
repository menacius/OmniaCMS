<?php 
function listArticles() {
	$postsql = mysql_query("SELECT * FROM
	(postcategories LEFT JOIN posts ON postcategories.postcategoryid = posts.postcategoryid)
	LEFT JOIN users ON posts.userid = users.userid
	WHERE posts.postid IS NOT NULL AND posts.publish = 1");
	echo "	<table>
	<tr>
	<th>ID</th>
	<th>Article</th>
	<th>Category</th>
	<th>Date/Time</th>
	<th>User</th>
	</tr>";

	while($row = mysql_fetch_array($postsql)) {
		echo "	<tr>
		<td>" . $row['postid'] . "</td>
		<td><a href='" .$_SERVER['PHP_SELF'] . "?page=articles&article_id=" . $row['postid'] . "'>" . $row['postheader'] . "</a></td>
		<td>" . $row['postcategoryname'] . "</td>
		<td>" . $row['postdate'] . "</td>
		<td>" . $row['username'] . "</td>
		</tr>";
	}
	echo "</table>";
}

function showArticle($articleid) {
	$postsql = mysql_query("SELECT * FROM
	(postcategories LEFT JOIN posts ON postcategories.postcategoryid = posts.postcategoryid)
	LEFT JOIN users ON posts.userid = users.userid
	WHERE posts.postid = $articleid AND posts.publish = 1");

	while($row = mysql_fetch_array($postsql)) {
		echo "<h3>" . $row['postheader'] . "</h3></br>
		<small>by:" . $row['username'] . "</small></br>
		<small>date:" . $row['postdate'] . "</small></br>"
		. $row['post'] . "";
	}
}
?>