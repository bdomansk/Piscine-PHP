<?php
if ($_POST['submit'] && $_POST['submit'] == "OK" && $_POST['login'] && $_POST['newpw'] && $_POST['oldpw'])
{
	$users = unserialize(file_get_contents('../private/passwd'));
	$flag = false;
	foreach ($users as $key => $value) {
		if ($value['login'] === $_POST['login'] && $value['passwd'] === hash('whirlpool', $_POST['oldpw'])){
			$flag = true;
			$users[$key]['passwd'] =  hash('whirlpool', $_POST['newpw']);
		}
	}
	if ($flag){
		file_put_contents('../private/passwd', serialize($users));
		echo "OK\n";
	}
	else{
		echo "ERROR\n";
	}
}
else {
	echo "ERROR\n";
}
?>