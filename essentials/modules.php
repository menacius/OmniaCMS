 <?
include "../config/config.php"; 

$typeofmodule = "module";
function scanModules(){
$SITERT = $GLOBALS['SITERT'];
$typeofmodule = $GLOBALS['typeofmodule'];
$modulefolders = scandir($SITERT . "/" . $typeofmodule . "s"); //The initial folder for module scan
foreach ($modulefolders as $modulefolder) { //Locate modules subfolders
	$moduleinfos = scandir($SITERT . "/" . $typeofmodule . "s/" . $modulefolder); //Re-initiate folder scan adding subfolders
	foreach ($moduleinfos as $moduleinfo) { //Locate module files
		if ($moduleinfo == $typeofmodule . ".xml") { //Locate module.xml info file
			$modulefile = $SITERT . "/" . $typeofmodule . "s/" . $modulefolder . "/" . $moduleinfo; //Add the full path of module.xml file to a variable
			$xml = simplexml_load_file($modulefile); //open xml file
			foreach($xml->children() as $category) { //Read xml file tags
				$arr[$category->getName()] = (string)$category; //add simple module xml tag to a temporary array
			}
		$modules[]=$arr; //Append modules xml tags to an second array
		}
	}
}
}

if (isset($_GET['option'])) { //if you want to see the module details
	$options=$_GET['option'];
	switch($options) {
		case 'view' :
			scanModules();
			viewModules($modules,$_GET['module']);
			break;
		case 'list' :
			scanModules();
			listModules($modules);
			break;
	}
}

function listModules($modules) { //LIST OF MODULES FUNCTION (array of the appended modules)
	$c=count($modules); //count the modules according to the array
	echo "<table>
	<tr>
	<th>ModuleName</th>
	<th>ModuleDescription</th>
	<th>ModuleCore</th>
	</tr>";
	for ($i=0; $i < $c; $i++) { //Start counting begining from 0, if countnumber is less than count module number then add 1 to the count number
		echo "<tr>
		<td><a href='". $_SERVER['PHP_SELF'] . "?option=view&module=" . $i . "'>" . $modules[$i]['name'] . "</a></td>
		<td>" . $modules[$i]['description'] . "</td>";
		if ($modules[$i]['essential']=='1') { //see if it is a core module
			echo "<td> yes </td>";
		} else {
			echo "<td> no </td>";
		}
		echo "</tr>";
	}
	echo"</table>";
	echo $modules[0]['positions'];
}

function listTemplates($modules) { //LIST OF MODULES FUNCTION (array of the appended modules)
	$c=count($modules); //count the modules according to the array
	echo "<table>
	<tr>
	<th>TemplateName</th>
	<th>TemplateDescription</th>
	<th>TemplateScreen</th>
	</tr>";
	for ($i=0; $i < $c; $i++) { //Start counting begining from 0, if countnumber is less than count module number then add 1 to the count number
		echo "<tr>
		<td><a href='". $_SERVER['PHP_SELF'] . "?option=view&module=" . $i . "'>" . $modules[$i]['name'] . "</a></td>
		<td>" . $modules[$i]['description'] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
}

function templatePositions($modules,$TEMPLT) {
}

function viewModules($modules,$i) {//VIEW MODULE DETAILS FUNCTION (array of the appended modules, number of the module)
echo $i;
}
?>