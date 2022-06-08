<?php

	function map_image($map, $size = '800x800') {
		return 'https://api.mapbox.com/styles/v1/aimhigher/cl2gxmea6000715nzoi13wg7v/static' . $map['pin'] . '/' . $map['lng'] . ',' . $map['lat'] . ',' . $map['zoom'] . ',0/' . $size . '?access_token=' . $map['api_key'];
	}

?>