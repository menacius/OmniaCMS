<?

function menuSet(){
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		switch($page) {
			case 'articles' :
				include "modules/posts/front/articles.php";
				if(isset($_GET['article_id'])) {
					showArticle($_GET['article_id']);
					break;
				}
				listArticles();
				break;
		
			case 'superuser' :
				if($_SESSION['4c3e2S']==crypt(3,"bO")) {
					if(isset($_GET['select'])) {
						adminSelect($_GET['select']);
						break;
					}
					showAdmin();
					break;
				}
				echo "access is denied";
				break;
		}
	}
}

function mainMenu(){
echo '<ul id="mainmenu" class="topmenulevel">
	<li><a href="' . $_SERVER['PHP_SELF'] . '">Home</a></li>
	<li><a href="' . $_SERVER['PHP_SELF'] . '?page=articles">Articles</a></li>
</ul>';
}

?>