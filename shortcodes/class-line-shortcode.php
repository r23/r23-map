<?php
/**
* Line Shortcode
*
* Use with [leaflet-line ...]
*
* @param array $atts        user-input array
* @param string $content    user-input content (allows HTML)
* @return string content for post/page
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

include_once(LEAFLET_MAP__PLUGIN_DIR . 'shortcodes/class-shortcode.php');

class Leaflet_Line_Shortcode extends Leaflet_Shortcode {
	protected function getHTML ($atts='', $content=null) {
        if (!empty($atts)) extract($atts);
        
        $style_json = $this->LM->get_style_json( $atts );

        $fitbounds = empty($fitbounds) ? 0 : $fitbounds;

        // backwards compatible `fitline`
        if (!empty($fitline)) {
            $fitbounds = $fitline;
        }

        $locations = array();

        if (!empty($addresses)) {
            include_once LEAFLET_MAP__PLUGIN_DIR . 'class-geocoder.php';
            $addresses = preg_split('/\s?[;|\/]\s?/', $addresses);
            foreach ($addresses as $address) {
                if (trim($address)) {
                    $location = new Leaflet_Geocoder( $address );
                    $locations[] = array($location->lat, $location->lng);
                }
            }
        } else if (!empty($latlngs)) {
            $latlngs = preg_split('/\s?[;|\/]\s?/', $latlngs);
            foreach ($latlngs as $latlng) {
                if (trim($latlng)) {
                    $locations[] = array_map('floatval', preg_split('/\s?,\s?/', $latlng));
                }
            }
        } else if (!empty($coordinates)) {
            $coordinates = preg_split('/\s?[;|\/]\s?/', $coordinates);
            foreach ($coordinates as $xy) {
                if (trim($xy)) {
                    $locations[] = array_map('floatval', preg_split('/\s?,\s?/', $xy));
                }
            }
        }

        $location_json = json_encode($locations);
        ob_start();
        ?>
        <script>
        WPLeafletMapPlugin.add(function () {
            var previous_map = WPLeafletMapPlugin.getCurrentMap(),
                line = L.polyline(<?php echo $location_json; ?>, <?php echo $style_json; ?>),
                fitbounds = <?php echo $fitbounds; ?>;
            line.addTo( previous_map );
            if (fitbounds) {
                // zoom the map to the polyline
                previous_map.fitBounds( line.getBounds() );
            }
        <?php
            $this->LM->add_popup_to_shape($atts, $content, 'line');
        ?>
            WPLeafletMapPlugin.lines.push( line );
        });
        </script>
        <?php

        return ob_get_clean();
	}
}