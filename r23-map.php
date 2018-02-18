<?php
/**
 * Plugin Name: R23 Map Plugin
 * Plugin URI: 
 * Description: Add a map generated with LeafletJS: an open-source JavaScript library for mobile-friendly interactive maps. 
 * Author: r23
 * Author URI: https://blog.r23.de/
 * Text Domain: r23-map
 * Domain Path: /languages/
 * Version: 1.0.0-dev
 * License: GPL2
 */

/*
    R23 Map Plugin

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 2 of the License, or
	any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.

Based on:

    Plugin Name: Leaflet Map
    Plugin URI: https://wordpress.org/plugins/leaflet-map/
    Description: A plugin for creating a Leaflet JS map with a shortcode. Boasts two free map tile services and three free geocoders.
    Author: bozdoz
    Author URI: https://twitter.com/bozdoz/
    Text Domain: leaflet-map
    Domain Path: /languages/
    Version: 2.10.0
    License: GPL2

    Leaflet Map is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    any later version.
     
    Leaflet Map is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
     
    You should have received a copy of the GNU General Public License
    along with Leaflet Map. If not, see https://github.com/bozdoz/wp-plugin-leaflet-map/blob/master/LICENSE.
	
*******************************************************************************************/	


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit; 

define('LEAFLET_MAP__PLUGIN_FILE', __FILE__);
define('LEAFLET_MAP__PLUGIN_DIR', plugin_dir_path( __FILE__ ));

// import main class
include_once LEAFLET_MAP__PLUGIN_DIR . 'class-r23-map.php';

// uninstall hook
register_uninstall_hook( __FILE__, array('Leaflet_Map', 'uninstall') );

add_action('init', array('Leaflet_Map', 'init'));
