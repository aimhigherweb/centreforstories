<?php

	// Change login url to account page unless accessing admin
	add_filter( 'login_url', 'my_login_page', 10, 3 );
	function my_login_page( $login_url, $redirect, $force_reauth ) {
		$account_page = 'my-account';

		if(str_contains($redirect, '/wp-admin')) {
			return $login_url;
		} else if($redirect && $redirect !== '') {
			$account_page = $account_page . '?redirect_to=' . $redirect;
		}

		return home_url($account_page);
	}

	// Redirect direct access to account page
	function redirect_to_actual_login(){
		if(
			str_contains( $_SERVER['REQUEST_URI'], 'wp-login.php' ) 
			&& !str_contains($_SERVER['REQUEST_URI'], 'wp-admin')
			&& array_key_exists('redirect_to', $_GET)
			&& ($_GET['redirect'] !== false)
		){     
			
			wp_safe_redirect('/my-account', 301);
			exit();
		}
	}
	add_action( 'init', 'redirect_to_actual_login');

?>