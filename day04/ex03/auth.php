<?php
	function auth($login, $passwd)
	{
		if (!$login || !$passwd)
			return false;
		$users = unserialize(file_get_contents('../private/passwd'));
		foreach ($users as $key => $value) {
			if ($value['login'] === $login && $value['passwd'] === hash('whirlpool', $passwd)) {
				return true;
			}
		}
		return false;
	}
?>