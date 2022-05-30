<?php

	function cfs_event_date($event, $format = 'short', $time = false) {
		$start = '';
		$end = '';
		$start_time = false;
		$end_time = false;

		$start_date = tribe_get_start_date($event, false, 'j');
		$end_date = tribe_get_end_date($event, false, 'j');
		

		if($format == 'long') {
			$start_month = tribe_get_start_date($event, false, 'F');
			$end_month = tribe_get_end_date($event, false, 'F');
		}
		else {
			$start_month = tribe_get_start_date($event, false, 'M');
			$end_month = tribe_get_end_date($event, false, 'M');            
		}

		if($time == true) {
			$start_time = tribe_get_start_date($event, true, 'g:i a');
			$end_time = tribe_get_end_date($event, true, 'g:i a');
		}
		
		$start = $start_month . ' <span>' . $start_date . '</span>';
		$end = $end_month . ' <span>' . $end_date . '</span>'; 

		return array(
			'start' => $start,
			'end' => $end,
			'start_time' => $start_time,
			'end_time' => $end_time,
		);
	}

	function cfs_join_date($date_object) {		
		$start = $date_object['start'];
		$end = $date_object['end'];
		$start_time = $date_object['start_time'] ?? false;
		$end_time = $date_object['end_time'] ?? false;

		$date = $start . ' <span>-</span> ' . $end;

		if($start_time && $end_time) {
			$date = $start . ' ' . $start_time . ' - ' . $end . ' ' . $end_time;
		}

		if($start == $end) {
			$date = $start;

			if($start_time) {
				$date = $start . ', ' . $start_time . ' - ' . $end_time;
			}
		}

		return $date;
	}

	function set_query($query, $value) {
		$new_query = $query;

		if(!$new_query) {
			$new_query = array();
		}

		$new_query[] = $value;

		return $new_query;
	}

?>