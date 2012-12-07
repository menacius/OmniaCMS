<?
if (isset($_SESSION['4c3e2S'])) {
	if($_SESSION['4c3e2S']==crypt(3,"bO")) {
		function showAdmin() {
			echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users'>
				<div id='adminicon'>
					<div class='users icon'></div>
					<div class='iconname'>Users</div>
				</div>
			</a>
			<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=posts'>
				<div id='adminicon'>
					<div class='posts icon'></div>
					<div class='iconname'>Articles</div>
				</div>
			</a>
			<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=tbank'>
				<div id='adminicon'>
					<div class='tbank icon'></div>
					<div class='iconname'>Time Bank</div>
				</div>
			</a>";
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