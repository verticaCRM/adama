<?php

return array(

	////////////////////////////////////////
	// Localized JS Message Configuration //
	////////////////////////////////////////

	/**
	 * Validation Messages
	 */
	'validation' => array(
		'alphabet'     => __('Value needs to be Alphabet', SH_NAME),
		'alphanumeric' => __('Value needs to be Alphanumeric', SH_NAME),
		'numeric'      => __('Value needs to be Numeric', SH_NAME),
		'email'        => __('Value needs to be Valid Email', SH_NAME),
		'url'          => __('Value needs to be Valid URL', SH_NAME),
		'maxlength'    => __('Length needs to be less than {0} characters', SH_NAME),
		'minlength'    => __('Length needs to be more than {0} characters', SH_NAME),
		'maxselected'  => __('Select no more than {0} items', SH_NAME),
		'minselected'  => __('Select at least {0} items', SH_NAME),
		'required'     => __('This is required', SH_NAME),
	),

	/**
	 * Import / Export Messages
	 */
	'util' => array(
		'import_success'    => __('Import succeed, option page will be refreshed..', SH_NAME),
		'import_failed'     => __('Import failed', SH_NAME),
		'export_success'    => __('Export succeed, copy the JSON formatted options', SH_NAME),
		'export_failed'     => __('Export failed', SH_NAME),
		'restore_success'   => __('Restoration succeed, option page will be refreshed..', SH_NAME),
		'restore_nochanges' => __('Options identical to default', SH_NAME),
		'restore_failed'    => __('Restoration failed', SH_NAME),
	),

	/**
	 * Control Fields String
	 */
	'control' => array(
		// select2 select box
		'select2_placeholder' => __('Select option(s)', SH_NAME),
		// fontawesome chooser
		'fac_placeholder'     => __('Select an Icon', SH_NAME),
	),

);

/**
 * EOF
 */