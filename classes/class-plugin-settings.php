<?php
/**
* 
* Used to get and set values
* 
* Features:
* * Add prefixes to db options
* * built-in admin settings page method
* 
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

include_once LEAFLET_MAP__PLUGIN_DIR . 'classes/class-plugin-option.php';

class Leaflet_Map_Plugin_Settings {
	/**
    * Prefix for options, for unique db entries
    * @var string $prefix
    */
    public $prefix = 'leaflet_';
	
    /**
     * @var Leaflet_Map_Plugin_Settings
     **/
    private static $instance = null;

	/**
    * Default values and admin form information
	* Needs to be created within __construct
    * in order to use a function such as __()
	* @var array $options
	*/
	public $options = array();

	/**
	 * Singleton
	 * @static
	 */
	public static function init() {
	    if ( !self::$instance ) {
	        self::$instance = new self;
	    }

	    return self::$instance;
	}

	private function __construct () {


        $foreachmap = __('You can also change this for each map', 'r23-map');

        /* 
        * initiate options using internationalization! 
        */
        $this->options = array(
            'default_lat' => array(
                'display_name'=>__('Default Latitude', 'r23-map'),
                'default'=>'44.67',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map lat="44.67"]</code>', 
                    __('Default latitude for maps.', 'r23-map'),
                    $foreachmap
                )
            ),
            'default_lng' => array(
                'display_name'=>__('Default Longitude', 'r23-map'),
                'default'=>'-63.61',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map lng="-63.61"]</code>', 
                    __('Default longitude for maps.', 'r23-map'),
                    $foreachmap
                )
            ),
            'default_zoom' => array(
                'display_name'=>__('Default Zoom', 'r23-map'),
                'default'=>'12',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map zoom="5"]</code>', 
                    __('Default zoom for maps.', 'r23-map'),
                    $foreachmap
                )
            ),
            'default_height' => array(
                'display_name'=>__('Default Height', 'r23-map'),
                'default'=>'250',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map height="250"]</code>', 
                    __('Default height for maps. Values can include "px" but it is not necessary. Can also be "%". ', 'r23-map'),
                    $foreachmap
                )
            ),
            'default_width' => array(
                'display_name'=>__('Default Width', 'r23-map'),
                'default'=>'100%',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map width="100%"]</code>', 
                    __('Default width for maps. Values can include "px" but it is not necessary.  Can also be "%".', 'r23-map'),
                    $foreachmap
                )
            ),
            'fit_markers' => array(
                'display_name'=>__('Fit Markers', 'r23-map'),
                'default' => '0',
                'type' => 'checkbox',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map fit_markers="1"]</code>', 
                    __('If enabled, all markers on each map will alter the view of the map; i.e. the map will fit to the bounds of all of the markers on the map.', 'r23-map'),
                    $foreachmap
                )
            ),
            'show_zoom_controls' => array(
                'display_name'=>__('Show Zoom Controls', 'r23-map'),
                'default' => '0',
                'type' => 'checkbox',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map zoomcontrol="0"]</code>', 
                    __('The zoom buttons can be large and annoying.', 'r23-map'),
                    $foreachmap
                )
            ),
            'scroll_wheel_zoom' => array(
                'display_name'=>__('Scroll Wheel Zoom', 'r23-map'),
                'default' => '0',
                'type' => 'checkbox',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map scrollwheel="0"]</code>', 
                    __('Disable zoom with mouse scroll wheel.  Sometimes someone wants to scroll down the page, and not zoom the map.', 'r23-map'),
                    $foreachmap
                )
            ),
            'double_click_zoom' => array(
                'display_name'=>__('Double Click Zoom', 'r23-map'),
                'default' => '0',
                'type' => 'checkbox',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map doubleClickZoom=false]</code>', 
                    __('If enabled, your maps will zoom with a double click.  By default it is disabled: If we\'re going to remove zoom controls and have scroll wheel zoom off by default, we might as well stick to our guns and not zoom the map.', 'r23-map'),
                    $foreachmap
                )
            ),
            'default_min_zoom' => array(
                'display_name'=>__('Default Min Zoom', 'r23-map'),
                'default' => '0',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2$s <br /> <code>[leaflet-map min_zoom="1"]</code>', 
                    __('Restrict the viewer from zooming in past the minimum zoom.  Can set per map in shortcode or adjust for all maps here.', 'r23-map'),
                    $foreachmap
                )
            ),
            'default_max_zoom' => array(
                'display_name'=>__('Default Max Zoom', 'r23-map'),
                'default' => '20',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2%s <br /> <code>%3$s</code>', 
                    __('Restrict the viewer from zooming out past the maximum zoom.  Can set per map in shortcode or adjust for all maps here', 'r23-map'),
                    $foreachmap,
                    '[leaflet-map max_zoom="10"]'
                )
            ),
            'map_tile_url' => array(
                'display_name'=>__('Map Tile URL', 'r23-map'),
                'default'=>'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                'type' => 'text',
                'helptext' => sprintf('%1$s: <a href="http://wiki.openstreetmap.org/wiki/Tile_servers" target="_blank"> %2$s </a>. %4$s <br/> <code>[leaflet-map tileurl=http://{s}.tile.stamen.com/watercolor/{z}/{x}/{y}.jpg subdomains=abcd]</code>',
                    __('See more tile servers', 'r23-map'),
                    __('here', 'r23-map'),
                    __('blog post', 'r23-map'),
                    $foreachmap
                )
            ),
            'map_tile_url_subdomains' => array(
                'display_name'=>__('Map Tile URL Subdomains', 'r23-map'),
                'default'=>'abc',
                'type' => 'text',
                'helptext' => sprintf('%1$s %2$s <br/> <code>[leaflet-map subdomains="1234"]</code>',
                    __('Some maps get tiles from multiple servers with subdomains such as a,b,c,d or 1,2,3,4', 'r23-map'),
                    $foreachmap
                )
            ),
            'default_attribution' => array(
                'display_name'=>__('Default Attribution', 'r23-map'),
                'default' => sprintf('<a href="http://leafletjs.com" title="%1$s">Leaflet</a>; \r\n© <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> %2$s',
                        __("A JS library for interactive maps", 'r23-map'),
                        __("contributors", 'r23-map')
                    ),
                'type' => 'textarea',
                'helptext' => __('Attribution to a custom tile url.  Use semi-colons (;) to separate multiple.', 'r23-map')
            ),
            'geocoder' => array(
                'display_name'=>__('Geocoder', 'r23-map'),
                'default' => 'google',
                'type' => 'select',
                'options' => array(
                    'google' => __('Google Maps', 'r23-map'),
                    'osm' => __('OpenStreetMap Nominatim', 'r23-map'),
                    'dawa' => __('Denmark Addresses', 'r23-map')
                ),
                'helptext' => __('Select the Geocoding provider to use to retrieve addresses defined in shortcode.', 'r23-map')
            )
        );

        foreach ($this->options as $name => $details) {
			$this->options[ $name ] = new Leaflet_Map_Plugin_Option( $details );
		}
	}

	/*
	* wrapper for WordPress get_options (adds prefix to default options)
	*
	* @param string $key                
	* @param varies $default   default value if not found in db
	* @return varies
	*/

	public function get ($key) {
		$default = $this->options[ $key ]->default;
		$key = $this->prefix . $key;
		return get_option($key, $default);
	}

	/*
	* wrapper for WordPress update_option (adds prefix to default options)
	*
	* @param string $key
	* @param varies $value
	* @param varies $default   default value if not found in db
	* @return varies
	*/

	public function set ($key, $value) {
		$key = $this->prefix . $key;
		update_option($key, $value);
		return $this;
	}

	/*
	* wrapper for WordPress delete_option (adds prefix to default options)
	*
	* @param string $key
	* @param varies $default   default value if not found in db
	* @return varies
	*/

	public function delete ($key) {
		$key = $this->prefix . $key;
		return delete_option($key);
	}

	/*
	* wrapper for WordPress delete_option (adds prefix to default options)
	*
	* @param string $key
	* @param varies $default   default value if not found in db
	* @return varies
	*/

	public function reset () {
		foreach ($this->options as $name => $option) {
			$this->delete( $name );
		}
		return $this;
	}
}