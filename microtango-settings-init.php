<?php

/**
 * Admin menu options
 */ 
add_action('admin_menu', 'microtango_settings_page');
add_action('admin_init', 'microtango_settings_init');

function microtango_settings_page()
{
    global $microtango_settings;
    
    add_options_page(
        $microtango_settings['settings_page_title'], 
        $microtango_settings['settings_page'], 
        'manage_options',
         $microtango_settings['plugin_name'], 
         'microtango_settings_page_render'
    );
}

function microtango_settings_init(  ) {
	global $microtango_settings;
	
	// Fetch existing options.
    $option_values = get_option( $microtango_settings['settings'] );
	
	$default_values = array (
        'restkey' => '',
        'defaultrowtemplate'  => '',
        'defaultvideorowtemplate'  => '',
        'attendtext' => '',
        'coursenotfoundtext' => '',
        'pleasewaittext' => '',
        'fullybookedtext' => '',
        'nearlybookedtext' => '',
        'reservationtext' => '',
        'logintext' => '',
        'showvideotext' => '',
        'videonotfoundtext' => '',
        'loadcss' => '',
        'loadtemplate' => '',
		'additionalrowtemplate1' => '',
		'additionalrowtemplate2' => '',
		'additionalrowtemplate3' => '',
		'additionalrowtemplate4' => '',
		'additionalrowtemplate5' => '',
		'additionalrowtemplate6' => '',
		'additionalrowtemplate7' => '',
		'additionalrowtemplate8' => '',
		'additionalrowtemplate9' => '',
		'disabled' => ''
    );
	
	// Parse option values into predefined keys, throw the rest away.
    $data = shortcode_atts( $default_values, $option_values );
	
    register_setting( $microtango_settings['plugin_name'], $microtango_settings['settings']);

    add_settings_section(
        'microtango_default_section',
        __( 'Mandatory settings:'),
        'microtango_default_section_render',
        $microtango_settings['plugin_name']
    );

    add_settings_section(
        'microtango_optional_section',
        __( 'Optional settings:'),
        'microtango_optional_section_render',
        $microtango_settings['plugin_name']
    );
	
    microtango_settings_add_text_field('restkey', 'REST-Key', 10, 8, 'Bei DMS anfordern', $data, 'default');
    microtango_settings_add_text_field('defaultrowtemplate', 'Standard Kurs-Zeilen-Template', 120, null, 'z.B. |{{ScheduleInfo}}#Kurs|{{Subject}}#Start|{{StartDateText}}#Von|{{Timespan}} Uhr#Stunden|{{RepeatCount}}#|{{AttendButton}}. Hier gibt es die möglichen Werte: <a href="https://api.microtango.de/swagger" target="_blank">RESTCourseModel</a>', $data, 'optional');	
    microtango_settings_add_text_field('defaultvideorowtemplate', 'Standard Video-Zeilen-Template', 120, null, 'z.B. |{{VideoThumbnail}}#Name|{{Name}}#Beschreibung|{{Description}}#Länge|{{Length}}#|{{ShowVideo}}. Hier gibt es die möglichen Werte: <a href="https://api.microtango.de/swagger" target="_blank">RESTCourseModel</a>', $data, 'optional');
	microtango_settings_add_checkbox_field('loadcss', 'CSS laden', 'Lädt kundenspezifische Styles', $data, 'optional');
    microtango_settings_add_checkbox_field('loadtemplate', 'Templates laden', 'Lädt kundenspezifische Templates', $data, 'optional');
    microtango_settings_add_text_field('pleasewaittext', 'Bitte warten', 40, null, 'Standard: Lade...', $data, 'optional');
    microtango_settings_add_text_field('coursenotfoundtext', 'Kein Kurs gefunden', 40, null, 'Standard: h3 Keine aktuellen Kurse vorhanden /h3', $data, 'optional');
    microtango_settings_add_text_field('attendtext', 'Anmelden', 20, null, 'Standard: Anmelden', $data, 'optional');
    microtango_settings_add_text_field('nearlybookedtext', 'Kurs ist fast ausgebucht', 40, null, 'Standard: Wenig Plätze', $data, 'optional');
    microtango_settings_add_text_field('fullybookedtext', 'Kurs ist ausgebucht', 40, null, 'Standard: Ausgebucht', $data, 'optional');
    microtango_settings_add_text_field('reservationtext', 'Reservierungen', 20, null, 'Standard: Meine Reservierungen', $data, 'optional');
    microtango_settings_add_text_field('logintext', 'Einloggen', 20, null, 'Standard: Einloggen', $data, 'optional');
    microtango_settings_add_text_field('videonotfoundtext', 'Kein Video gefunden', 40, null, 'Standard: h3 Keine Videos vorhanden /h3', $data, 'optional');
    microtango_settings_add_text_field('showvideotext', 'Video anzeigen', 20, null, 'Standard: Abspielen', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate1', 'Kurs-Zeilen-Template 1', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate2', 'Kurs-Zeilen-Template 2', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate3', 'Kurs-Zeilen-Template 3', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate4', 'Kurs-Zeilen-Template 4', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate5', 'Kurs-Zeilen-Template 5', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate6', 'Kurs-Zeilen-Template 6', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate7', 'Kurs-Zeilen-Template 7', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate8', 'Kurs-Zeilen-Template 8', 120, null, '', $data, 'optional');
	microtango_settings_add_text_field('additionalrowtemplate9', 'Kurs-Zeilen-Template 9', 120, null, '', $data, 'optional');
	microtango_settings_add_checkbox_field('disabled', 'Testmodus', 'Das Microtango-Plugin ist nur für angemeldete Administratoren und in der Vorschau sichtbar.', $data, 'optional');
}

function microtango_settings_add_text_field($fieldname, $labeltext, $size, $maxlength, $description, $data, $section) {
	global $microtango_settings;

		add_settings_field(
        $fieldname,
        $labeltext,
        'microtango_settings_field_render',
        $microtango_settings['plugin_name'],
        'microtango_' . $section . '_section',
		 array (
            'label_for'   => $fieldname, // makes the field name clickable and set value for 'name' attribute,
            'value'       => esc_attr( $data[$fieldname] ),
            'size'        => $size,
            'maxlength'   => $maxlength,
            'description' => $description
        )
    );
}

function microtango_settings_add_checkbox_field($fieldname, $labeltext, $description, $data, $section) {
	global $microtango_settings;
    
		add_settings_field(
        $fieldname,
        $labeltext,
        'microtango_settings_field_checkbox_render',
        $microtango_settings['plugin_name'],
        'microtango_' . $section . '_section',
		 array (
            'label_for'   => $fieldname, // makes the field name clickable and set value for 'name' attribute,
            'value'       => esc_attr( $data[$fieldname] ),
            'description' => $description
        )
    );
}

function microtango_settings_page_render( $title ) {
	global $microtango_settings;
	
    ?>
    <form action='options.php' method='post'>
        <small><br />Version <?php echo $microtango_settings['version']?></small>
        <h1><?php echo __( 'Microtango Settings')?></h1>

        <?php
        settings_fields( $microtango_settings['plugin_name'] );
        do_settings_sections( $microtango_settings['plugin_name'] );
        submit_button();
        ?>

    </form>
    <?php
}

function microtango_default_section_render( ) {
    // echo __( 'Mandatory settings for Microtango Web-API:');
}

function microtango_optional_section_render( ) {
    // echo __( 'Optional settings:');
}

function microtango_settings_field_render( $args ) {
     global $microtango_settings;
	
	 printf(
        '<input name="%1$s[%2$s]" id="%2$s" value="%3$s" size="%4$s" maxlength="%5$s" type="text"><br /><small>%6$s</small>',
        $microtango_settings['settings'],
        $args['label_for'],
        $args['value'],
        $args['size'],
        $args['maxlength'],
        $args['description']
    );
}

function microtango_settings_field_checkbox_render( $args ) {
    global $microtango_settings;
   
    printf(
       '<input name="%1$s[%2$s]" id="%2$s" value="1" type="checkbox" ' . checked( 1, $args['value'], false ) . '><br /><small>%3$s</small>',
       $microtango_settings['settings'],
       $args['label_for'],
       $args['description']
   );
}