<?php
if (isset($_GET['option'])) {
	$options=$_GET['option'];
	switch($options) {
		case 'add' :
			addTBCategory($dbArray);
			break;
		
		case 'view' :
			viewTBCategories();
			break;
		
		case 'edit' :
			editTBCategory($dbArray);
			break;
		
		case 'del' :
			deleteTBCategory();
			break;
		
		default :
			viewTBCategories();
			break;
	}
}