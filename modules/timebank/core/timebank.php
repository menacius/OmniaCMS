<?php
if (isset($_GET['option'])) {
	$options=$_GET['option'];
	switch($options) {
		case 'add' :
			addTBService();
			break;
		
		case 'view' :
			viewTBServices();
			break;
		
		case 'edit' :
			editTBService();
			break;
		
		case 'del' :
			deleteTBService();
			break;
		
		default :
			timeBank();
			break;
	}
} else {
	timeBank();
}

function timeBank() {
	echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=tbank&option=view'>
		<div id='adminicon'>
			<div class='viewservices icon'></div>
			<div class='iconname'>View Services</div>
		</div>
	</a>
	<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=tbank&option=catview'>
		<div id='adminicon'>
			<div class='viewcategories icon'></div>
			<div class='iconname'>View Categories</div>
		</div>
	</a>
	<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=tbank&option=add'>
		<div id='adminicon'>
			<div class='addservice icon'></div>
			<div class='iconname'>Add Service</div>
		</div>
	</a>
	<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=tbank&option=catadd'>
		<div id='adminicon'>
			<div class='addcategory icon'></div>
			<div class='iconname'>Add Category</div>
		</div>
	</a>
	<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=tbank&option=trans'>
		<div id='adminicon'>
			<div class='transactions icon'></div>
			<div class='iconname'>Transactions</div>
		</div>
	</a>";
}
function viewTBServices() {
	$postsql = mysql_query("SELECT * FROM
	(tbservicecategories LEFT JOIN tbservice ON tbservicecategories.servicecategoryid = tbservice.servicecategoryid)
	LEFT JOIN users ON tbservice.userid = users.userid
	WHERE tbservice.serviceid IS NOT NULL");
	echo "<table>";
	while($row = mysql_fetch_array($postsql)) {
		echo "<tr>
		<td>" . $row['serviceid'] . "</td>
		<td>" . $row['servicename'] . "</td>
		<td>" . $row['username'] . "</td>
		<td>" . $row['servicecategoryname'] . "</td>
		</tr>";
	}
	echo "</table>";
}