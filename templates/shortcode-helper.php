<style>
	.marching-ants {
	  animation: dash 35s infinite linear;
	}

	@keyframes dash {
	  to {
	    stroke-dashoffset: -1000;
	  }
	}
</style>

<div class="wrap">
	<h2>Shortcode Helper</h2>
	<div class="wrap">
		<?php
		$drag = __('Drag Me', 'r23-map');

		echo do_shortcode('[leaflet-map zoom=2 zoomcontrol=1 doubleClickZoom=1 height=300 scrollwheel=1]');
		echo do_shortcode(sprintf('[leaflet-marker draggable=1 visible="true"] %s [/leaflet-marker]',
			$drag
		));
		?>
		<div class="wrap">
			<hr>
			<h2><?php _e('Interactive Shortcodes:', 'r23-map'); ?></h2>
			<p class="description"><?php _e('Move the map and the marker to generate shortcodes below:', 'r23-map'); ?></p>
			<div class="flex"><label class="h3" for="map-shortcode"><?php _e('Map Shortcode', 'r23-map'); ?></label> <input type="text" id="map-shortcode" readonly="readonly" /></div>
			<div class="flex"><label class="h3" for="marker-shortcode"><?php _e('Marker Shortcode', 'r23-map'); ?></label> <input type="text" id="marker-shortcode" readonly="readonly" /></div>
			<hr>
			<h2><?php _e('Examples', 'r23-map'); ?>:</h2>
			<div class="examples">
			<?php
			$examples = array(
				__("Standard", 'r23-map') => array(
					'[leaflet-map zoom=12 lat=51.05 lng=-114.06]',
					),
				__("Many Markers!", 'r23-map') => array(
					'[leaflet-map zoom=10 lat=43.65 lng=-79.385]',
					'[leaflet-marker]',
					'[leaflet-marker lat=43.68 lng=-79.275]',
					'[leaflet-marker lat=43.67 lng=-79.4]',
					),
				__("Draggable Marker", 'r23-map') => array(
					'[leaflet-map zoom=8 lat=-33.85 lng=151.21 scrollwheel=1]',
					'[leaflet-marker draggable=1]',
					),
				__("Marker Icon", 'r23-map') => array(
					'[leaflet-map zoom=10 address="cochrane, Ontario" scrollwheel=1]',
					'[leaflet-marker iconUrl="https://i.imgur.com/Q54ueuO.png" iconSize="80,50" iconAnchor="40,60"]'
					),
				__("Zoom Buttons", 'r23-map') => array(
					'[leaflet-map zoom=9 lat=48.855 lng=2.35 zoomcontrol=1]',
					),
				__("Alternate Map Tiles w/scrollwheel", 'r23-map') => array(
					'[leaflet-map zoom=2 scrollwheel=1 lat=-2.507 lng=32.902 tileurl=https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.jpg subdomains=abcd attribution="Map tiles by Stamen Design, under CC BY 3.0."]',
					),
				__("Marker Popup Messages (on click)", 'r23-map') => array(
					'[leaflet-map lat=59.913 lng=10.739 zoom=12]',
					'[leaflet-marker]OSLO![/leaflet-marker]',
					),
				__("Links In Marker Messages (visible)", 'r23-map') => array(
					'[leaflet-map lat=28.41 lng=-81.58 zoom=15]',
					'[leaflet-marker visible="true"] Disney World! <a href="https://disneyworld.disney.go.com">Link</a> [/leaflet-marker]',
					),
				__("Basic Lines w/Scrollwheel", 'r23-map') => array(
					'[leaflet-map lat=41 lng=29 scrollwheel=1 zoom=6]',
					'[leaflet-line latlngs="41, 29; 44, 18;"]'
					),
				__("Fitted Colored Line on Addresses", 'r23-map') => array(
					'[leaflet-map]',
					'[leaflet-line color="purple" addresses="Sayulita; Puerto Vallarta;" fitline=1]'
					),
				__("More Crazy Line Attributes", 'r23-map') => array(
					'[leaflet-map]',
					'[leaflet-line color="red" weight=10 dasharray="2,15" addresses="Halifax, NS; Tanzania" classname=marching-ants fitbounds=1]'
					),
				__("Disable all Interaction", 'r23-map') => array(
					'[leaflet-map address="las vegas" boxZoom=false doubleClickZoom=false dragging=false keyboard=false scrollwheel=0 attribution=0]',
					),
				__("Add GeoJSON by URL (with popups)", 'r23-map') => array(
					'[leaflet-map doubleClickZoom=true scrollwheel=true]',
					'[leaflet-geojson src=https://cdn.rawgit.com/bozdoz/064a7101b95a324e8852fe9381ab9a18/raw/03f4f54b13a3a7e256732760a8b679818d9d36fc/map.geojson fitbounds=1 popup_property="popup-text"]'
					),
				__("Test Image Map", 'r23-map') => array(
					'[leaflet-image zoom=1 zoomcontrol=1 scrollwheelzoom=1 attribution=0]',
					'[leaflet-marker]'
					)
				);

			foreach ($examples as $title => $collection) {
				echo '<div class="list-item">';
				echo "<h3>$title</h3>";
				foreach ($collection as $shortcode) {
					echo do_shortcode($shortcode);
					echo "<p>$shortcode</p>";
				}
				echo '</div>';
			}
			?>	
			</div>
		</div>
	</div>
</div>