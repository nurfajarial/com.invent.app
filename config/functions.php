<?php 

define('VERSION', '3.1.1');

function get_version() {
	if ( defined('VERSION') ) {
		return VERSION;
	}
}

?>