<?php 
require_once dirname(__FILE__) . '/controllers/Installer.php';
$manager = ( new \nova_ext_display_name\Installer() )->install();

require_once dirname(__FILE__).'/events/location_main_join2.php';
require_once dirname(__FILE__).'/events/location_admin_characters_index.php';
require_once dirname(__FILE__).'/events/location_admin_characters_bio.php';
require_once dirname(__FILE__).'/events/location_admin_characters_create.php';
require_once dirname(__FILE__).'/events/db.php';
require_once dirname(__FILE__).'/events/location_admin_characters_npcs.php';
require_once dirname(__FILE__).'/events/location_main_personnel_character.php';
