<?
require_once "../../../config/config.php";
require_once $SITERT . "/essentials/connect.php";

postListView();

function postListView() {
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
		<td><a href='post_view.php?post=" . $row['postid'] . "'>" . $row['postheader'] . "</a></td>
		<td>" . $row['postcategoryname'] . "</td>
		<td>" . $row['postdate'] . "</td>
		<td>" . $row['username'] . "</td>
		</tr>";
	}
	echo "</table>";
}