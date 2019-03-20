<?php
if ($_POST['submit'] && $_POST['submit'] == "OK" && $_POST['login'] && $_POST['passwd'])
{
	if (!file_exists('../private')){
		mkdir('../private');
	}
	if (!file_exists('../private/passwd')){
		file_put_contents('../private/passwd', "");
	}
	$users = unserialize(file_get_contents('../private/passwd'));
	$flag = false;
	foreach ($users as $key => $value) {
		if ($value['login'] === $_POST['login']){
			$flag = true;
		}
	}
	if ($flag){
		echo "ERROR\n";
	}
	else{
		$new['login'] = $_POST['login'];
		$new['passwd'] = hash('whirlpool', $_POST['passwd']);
		$users[] = $new;
		file_put_contents('../private/passwd', serialize($users));
		echo "OK\n";
	}

}
else {
	echo "ERROR\n";
}
?>