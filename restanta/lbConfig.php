<?php
    if(!isset($_SESSION['difficulty']))
	{
		$_SESSION['difficulty'] = 'easy';
	}
	else if (isset($_GET['difficulty']) && $_SESSION['difficulty'] != $_GET['difficulty'] && !empty($_GET['difficulty'])){
		if($_GET['difficulty'] == 'easy'){
			$_SESSION['difficulty'] = 'easy';
		}
		else if ($_GET['difficulty'] == 'hard') {
			$_SESSION['difficulty'] = 'hard';		
		}
	}

    if(!isset($_SESSION['level']))
	{
		$_SESSION['level'] = '1';
	}
	else if (isset($_GET['level']) && $_SESSION['level'] != $_GET['level'] && !empty($_GET['level'])){
		if($_GET['level'] == '1'){
			$_SESSION['level'] = '1';
		}
		else if ($_GET['level'] == '2') {
			$_SESSION['level'] = '2';		
		}
		else if ($_GET['level'] == '3') {
			$_SESSION['level'] = '3';
		}
        else if ($_GET['level'] == '4') {
			$_SESSION['level'] = '4';
		}
        else if ($_GET['level'] == '5') {
			$_SESSION['level'] = '5';
		}
        else if ($_GET['level'] == '6') {
			$_SESSION['level'] = '6';
		}
        else if ($_GET['level'] == '7') {
			$_SESSION['level'] = '7';
		}
        else if ($_GET['level'] == '8') {
			$_SESSION['level'] = '8';
		}
	}


?>