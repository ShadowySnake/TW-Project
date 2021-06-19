<?php
    session_start();
    if(!isset($_SESSION['lang']))
	{
		//If Language is not set in session then set default language as English
		$_SESSION['lang'] = 'en';
	}
	else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])){
		if($_GET['lang'] == 'en'){
			$_SESSION['lang'] = 'en';
		}
		else if ($_GET['lang'] == 'ro') {
			$_SESSION['lang'] = 'ro';		
		}
		else if ($_GET['lang'] == 'ru') {
			$_SESSION['lang'] = 'ru';
		}
	}

	require_once $_SESSION['lang']. '.php';

?>