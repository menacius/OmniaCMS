<?
if (isset($_SESSION['4c3e2S'])) {
	if($_SESSION['4c3e2S']==crypt(3,"bO")) {
		function showAdmin() {
			echo "<table>
				<tr>
					<td><a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users&option=view'>User Management</a></td>
					<td><a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=posts&option=view'>Article Management</a></td>
					<td><a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=tbank'>Time Bank</a></td>
				</tr>
			</table>";
		}
		
		function adminSelect($adminselect) {
			switch($adminselect) {
				case 'users' :
					include "modules/user/core/users.php";
					break;
				case 'posts' :
					include "modules/posts/core/posts.php";
					break;
				case 'tbank' :
					include "modules/timebank/core/timebank.php";
					break;
				
			}
		}
	}
}
?>