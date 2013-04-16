<?php

function ufcoe_dbsync_init() {

	$desired_dataroot = elgg_get_config('dbsync_dataroot');
	$desired_wwwroot = elgg_get_config('dbsync_wwwroot');

	$modified = false;

	if ($desired_dataroot) {
		// normalize
		$desired_dataroot = sanitise_filepath($desired_dataroot);

		if (elgg_get_data_path() !== $desired_dataroot) {

			// last chance check for validity
			if (is_dir($desired_dataroot) && is_writable($desired_dataroot)) {
				// change !
				datalist_set('dataroot', $desired_dataroot);

				elgg_set_config('dataroot', $desired_dataroot);

				$modified = true;
			} else {
				elgg_log(elgg_echo('ufcoe_dbsync:invalid_dataroot'), 'WARNING');
			}
		}
	}
	if ($desired_wwwroot) {
		// normalize
		$desired_wwwroot = rtrim($desired_wwwroot, '/') . '/';

		if (elgg_get_site_url() !== $desired_wwwroot) {

			// last chance check for validity
			if (filter_var($desired_wwwroot, FILTER_VALIDATE_URL)) {
				// change !
				$ia = elgg_set_ignore_access();
				$site = elgg_get_site_entity();
				$site->url = $desired_wwwroot;
				$site->save();
				elgg_set_ignore_access($ia);

				elgg_set_config('wwwroot', $desired_wwwroot);

				$modified = true;
			} else {
				elgg_log(elgg_echo('ufcoe_dbsync:invalid_wwwroot'), 'WARNING');
			}
		}
	}

	if ($modified) {
		forward();
	}
}

elgg_register_event_handler('init', 'system', 'ufcoe_dbsync_init');