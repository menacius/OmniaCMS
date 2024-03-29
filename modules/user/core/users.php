<?php
$con = $GLOBALS['con'];
if (isset($_GET['option'])) {
	$option=$_GET['option'];
	switch($option) {
		case 'add' :
			addUser();
			break;
		
		case 'view' :
			viewUsers();
			break;
		
		case 'edit' :
			editUser();
			break;
		
		case 'del' :
			deleteUser();
			break;
		
		default :
			users();
			break;
	}
} else {
	users();
}

function addUser() {
	$con = $GLOBALS['con'];
	if (!isset($_POST['check'])) {
		echo '	<form action="' . $_SERVER['PHP_SELF'] . '?page=superuser&select=users&option=add" method="post">
		User Rights:	<select name="access">User Rights</option>';
		$csql= mysql_query("SELECT * FROM rights");
		while($row=mysql_fetch_array($csql)) {
			echo "<option value=$row[rightsaccess]>$row[rightsname]</option>";
		}
		echo '</select></br>
		Username:	<input type="text" required x-moz-errormessage="Enter Username" name="username"></br>
		Name:		<input type="text" name="firstname"></br>
		Surname:		<input type="text" name="surname"></br>
		email:		<input type="text" name="email"></br>
		Password:	<input type="password" name="password" id="p1"></br>
		Confirm Password:	<input type="password" name="password" onfocus="validatePass(document.getElementById(\'p1\'), this);" oninput="validatePass(document.getElementById(\'p1\'), this);"></br>
		<input type="hidden" name="check" value="1">
		<input type="submit" value="Submit"><input type="reset" value="Reset Form">
		</form>';
	} else {
		$passkey = crypt($_POST['password'],'be');
		$sql="INSERT INTO users (username, name, surname, email, password, rights) VALUES ('$_POST[username]','$_POST[firstname]','$_POST[surname]','$_POST[email]','$passkey','$_POST[access]')";
		if (!mysql_query($sql,$con)) {
			die('Error: ' . mysql_error());
		}
		echo "Data added!";
		echo "<a href='?option=view'>Return</a>";
	}
}

function viewUsers() {
	echo '<a href="' . $_SERVER['PHP_SELF'] . '?page=superuser&select=users&option=add">Add User</a></br>';
	$sql = mysql_query("SELECT * FROM users LEFT JOIN rights ON users.rights = rights.rightsaccess");
	echo $sql . "
	<table>
	<tr>
	<th>ID</th>
	<th>Username</th>
	<th>Name</th>
	<th>Surname</th>
	<th>email</th>
	<th>User Rights</th>
	</tr>";

	while($row = mysql_fetch_array($sql)) {
		echo "	<tr>
		<td>" . $row['userid'] . "</td>
		<td>" . $row['username'] . "</td>
		<td>" . $row['name'] . "</td>
		<td>" . $row['surname'] . "</td>
		<td>" . $row['email'] . "</td>
		<td>" . $row['rightsname'] . "</td>
		<td><a href=" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users&option=edit&user=" . $row['userid'] . ">Edit</a></td>
		<td><a href=" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users&option=del&user=" . $row['userid'] . ">X</a></td>
		</tr>";
	}
	echo "</table>";
	echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser'>Return</a>";
}

function deleteUser() {
	$userid = $_GET['user'];
	$sql = mysql_query("SELECT * FROM users WHERE userid LIKE '$userid'");
	$row = mysql_fetch_array($sql);
	if (!isset($_GET['delete'])) {
		echo "Are you sure that you want to delete ". $row['name'] . " " . $row['surname'] . "?</br>
		<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users&option=del&user=" . $row['userid'] . "&delete=1'>YES</a>
		<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users&option=view'>NO</a>";
	} else {
		echo "The user ". $row['name'] . " " . $row['surname'] . " deleted!</br>";
		mysql_query("DELETE FROM users WHERE userid='$userid'");
		echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users&option=view>Return</a>";
	}
}

function editUser() {
	$con = $GLOBALS['con'];
	$userid = $_GET['user'];
	$sql = mysql_query("SELECT * FROM users WHERE userid LIKE '$userid'");
	if (!isset($_POST['check'])) {
		$data = mysql_fetch_array($sql);
		echo '	<form action="' . $_SERVER['PHP_SELF'] . '?page=superuser&select=users&option=edit&user=' . $userid . '" method="post">
		User Rights:	<select name="access">User Rights</option>';
		$csql= mysql_query("SELECT * FROM rights");
		while($row=mysql_fetch_array($csql)) {
			if ($row[rightsaccess]==$data[rights]) {
				echo "<option value=$row[rightsaccess] selected>$row[rightsname]</option>";
			} else {
				echo "<option value=$row[rightsaccess]>$row[rightsname]</option>";
			}
		}
		echo '</select></br>
		Username:	<input type="text" name="username" value="' . $data[username] . '"></br>
		Name:		<input type="text" name="firstname" value="' . $data[name] . '"></br>
		Surname:		<input type="text" name="surname" value="' . $data[surname] . '"></br>
		email:		<input type="text" name="email" value="' . $data[email] . '"></br>
		Password:	<input type="password" name="password"></br>
		<input type="hidden" name="check" value="1">
		<input type="submit" value="Modify">
		</form>
		<a href="' . $_SERVER['PHP_SELF'] . '?page=superuser&select=users&option=view">Cancel</a>';
	} else {
		if ($_POST['password']!="") {
			$passkey = crypt($_POST['password'],'be');
			$sql="UPDATE users SET username='$_POST[username]', name='$_POST[firstname]', surname='$_POST[surname]', email='$_POST[email]', password='$passkey', rights='$_POST[access]' WHERE userid='$userid'";
		} else {
			$sql="UPDATE users SET username='$_POST[username]', name='$_POST[firstname]', surname='$_POST[surname]', email='$_POST[email]', rights='$_POST[access]' WHERE userid='$userid'";
		}
		if (!mysql_query($sql,$con)) {
			die('Error: ' . mysql_error());
		}
		echo "Data modified!";
		echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=superuser&select=users&option=view'>Return</a>";
	}
}
?>