<?php

use Beapi\Theme\Dsfr\Autoload;

require_once __DIR__ . '/autoload.php';
$autoloader = new Autoload();
$autoloader->addNamespace( '\\Beapi\\Theme\\Dsfr\\', __DIR__ . '/inc' );
$autoloader->register();

/**
 * Load all services
 */
add_action(
	'after_setup_theme',
	function () {
		// Boot the service, at after_setup_theme.
		\Beapi\Theme\Dsfr\Framework::get_container()->boot_services();
	}
);
require_once __DIR__ . '/inc/Helpers/DSFR.php';
require_once __DIR__ . '/inc/Helpers/Misc.php';
require_once __DIR__ . '/inc/Helpers/Svg.php';
require_once __DIR__ . '/inc/Helpers/Formatting/Escape.php';
require_once __DIR__ . '/inc/Helpers/Formatting/Image.php';
require_once __DIR__ . '/inc/Helpers/Formatting/Link.php';
require_once __DIR__ . '/inc/Helpers/Formatting/Term.php';
require_once __DIR__ . '/inc/Helpers/Formatting/Text.php';
require_once __DIR__ . '/inc/Helpers/Pattern_Content.php';
require_once __DIR__ . '/inc/Helpers/Custom_Menu_Walker.php';
