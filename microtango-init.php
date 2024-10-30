<?php

add_action('wp_enqueue_scripts', 'microtango_enqueue_files');
add_shortcode('mt_courses', 'microtango_shortcode_courses');
add_shortcode('mt_reservation', 'microtango_shortcode_reservation');
add_shortcode('mt_video', 'microtango_shortcode_video');
add_shortcode('mt_form', 'microtango_shortcode_form');

function microtango_enqueue_files()
{
	if ( is_preview() || current_user_can('manage_options') ) {
		wp_enqueue_script('microtango', 'https://api.microtango.de/scripts/mtrest-3.0.0.min.js', null);
	} else {
    	wp_enqueue_script('microtango', 'https://cdn.microtango.de/scripts/mtrest-3.0.0.min.js', null);
	}
}

// Use the shortcode: [mt_courses webcategory=""]
function microtango_shortcode_courses($atts, $content = "")
{
    global $microtango_settings;
	
	if (get_option($microtango_settings['settings'])['disabled'] && !is_preview() && !current_user_can('manage_options'))
		return;
	
    $rnd = rand(10000000, 99999999);

    // Attributes
    $atts = shortcode_atts(
        array(
            'restkey' => get_option($microtango_settings['settings'])['restkey'],
            'attendurl' => '',
            'mtattendform' => '',
            'category' => '',
            'webcategory' => '',
			'orderby' => '',
            'attendtext' => get_option($microtango_settings['settings'])['attendtext'],
            'coursenotfoundtext' => get_option($microtango_settings['settings'])['coursenotfoundtext'],
            'pleasewaittext' => get_option($microtango_settings['settings'])['pleasewaittext'],
            'fullybookedtext' => get_option($microtango_settings['settings'])['fullybookedtext'],
            'nearlybookedtext' => get_option($microtango_settings['settings'])['nearlybookedtext'],
            'loadcss' => isset(get_option($microtango_settings['settings'])['loadcss']) ? get_option($microtango_settings['settings'])['loadcss'] : '0' === '1',
            'loadtemplate' => isset(get_option($microtango_settings['settings'])['loadtemplate']) ? get_option($microtango_settings['settings'])['loadtemplate'] : '0' === '1',
            'templateid' => 'mtuserdefined' . (isset($atts['template']) ? $atts['template'] : '') . $rnd,
        ),
        $atts,
        'mt_courses'
    );

    if (empty($atts['mtattendform'])) {
        $atts['mtattendform'] = 'popup';
    }

    if (empty($content)) {
        $content = get_option($microtango_settings['settings'])['defaultrowtemplate'];
    }

    if (empty($content)) {
        $content = "|{{ScheduleInfo}}#Kurs|{{Subject}}#Start|{{StartDateText}}#Von|{{Timespan}} Uhr#Stunden|{{RepeatCount}}#|{{AttendButton}}";
    }

    $columns = "\"" . str_replace("#", "\", \"", $content) . "\"";
	$additionalrowtemplate1 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate1']) . "\"";
	$additionalrowtemplate2 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate2']) . "\"";
	$additionalrowtemplate3 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate3']) . "\"";
	$additionalrowtemplate4 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate4']) . "\"";
	$additionalrowtemplate5 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate5']) . "\"";
	$additionalrowtemplate6 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate6']) . "\"";
	$additionalrowtemplate7 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate7']) . "\"";
	$additionalrowtemplate8 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate8']) . "\"";
	$additionalrowtemplate9 = "\"" . str_replace("#", "\", \"", get_option($microtango_settings['settings'])['additionalrowtemplate9']) . "\"";

    // Code
    $return = <<<EOT
    <script>MicrotangoCMSHelper.add(
        {
			"restKey": "{$atts['restkey']}",
            "attendURL": "{$atts['attendurl']}",
            "useMTAttendForm": "{$atts['mtattendform']}",
			"attendText": "{$atts['attendtext']}",
			"courseNotFoundText": "{$atts['coursenotfoundtext']}",
            "pleaseWaitText": "{$atts['pleasewaittext']}",
            "fullyBookedText": "{$atts['fullybookedtext']}",
            "nearlyBookedText": "{$atts['nearlybookedtext']}",
            "loadCSS": "{$atts['loadcss']}",
            "loadTemplate": "{$atts['loadtemplate']}",
            "templates": [{ "id": "mtuserdefined$rnd", "columns": [{$columns}] },
                          { "id": "mtuserdefined1$rnd", "columns": [{$additionalrowtemplate1}] },
                          { "id": "mtuserdefined2$rnd", "columns": [{$additionalrowtemplate2}] },
                          { "id": "mtuserdefined3$rnd", "columns": [{$additionalrowtemplate3}] },
                          { "id": "mtuserdefined4$rnd", "columns": [{$additionalrowtemplate4}] },
                          { "id": "mtuserdefined5$rnd", "columns": [{$additionalrowtemplate5}] },
                          { "id": "mtuserdefined6$rnd", "columns": [{$additionalrowtemplate6}] },
                          { "id": "mtuserdefined7$rnd", "columns": [{$additionalrowtemplate7}] },
                          { "id": "mtuserdefined8$rnd", "columns": [{$additionalrowtemplate8}] },
                          { "id": "mtuserdefined9$rnd", "columns": [{$additionalrowtemplate9}] }],
            "update": [{ "action": "course", "category": "{$atts['category']}", "webCategory": "{$atts['webcategory']}", "orderBy": "{$atts['orderby']}", "templateId": "{$atts['templateid']}" }],
        });
    </script>
EOT;

    return htmlspecialchars_decode($return);
}

function microtango_shortcode_reservation($atts, $content = "")
{
    global $microtango_settings;
	
    if (get_option($microtango_settings['settings'])['disabled'] && !is_preview() && !current_user_can('manage_options'))
		return;

    // Attributes
    $atts = shortcode_atts(
        array(
            'restkey' => get_option($microtango_settings['settings'])['restkey'],
            'reservationtext' => get_option($microtango_settings['settings'])['reservationtext'],
            'loadcss' => isset(get_option($microtango_settings['settings'])['loadcss']) ? get_option($microtango_settings['settings'])['loadcss'] : '0' === '1',
        ),
        $atts,
        'mt_reservation'
    );

    // Code
    $return = <<<EOT
    <script>MicrotangoCMSHelper.addReservation(
        {
            "restKey": "{$atts['restkey']}",
            "reservationText": "{$atts['reservationtext']}",
            "loadCSS": "{$atts['loadcss']}",
            "update": [],
        });
    </script>
EOT;

    return htmlspecialchars_decode($return);
}

function microtango_shortcode_video($atts, $content = "")
{
    global $microtango_settings;
	
	if (get_option($microtango_settings['settings'])['disabled'] && !is_preview() && !current_user_can('manage_options'))
		return;
	
    $rnd = rand(10000000, 99999999);

    // Attributes
    $atts = shortcode_atts(
        array(
            'videogroup' => '',
            'restkey' => get_option($microtango_settings['settings'])['restkey'],
            'showvideotext' => get_option($microtango_settings['settings'])['showvideotext'],
            'videonotfoundtext' => get_option($microtango_settings['settings'])['videonotfoundtext'],
            'logintext' => get_option($microtango_settings['settings'])['logintext'],
            'loadcss' => isset(get_option($microtango_settings['settings'])['loadcss']) ? get_option($microtango_settings['settings'])['loadcss'] : '0' === '1',
            'loadtemplate' => isset(get_option($microtango_settings['settings'])['loadtemplate']) ? get_option($microtango_settings['settings'])['loadtemplate'] : '0' === '1',
            'templateid' => 'mtuserdefined' . $rnd,
        ),
        $atts,
        'mt_video'
    );

    if (empty($content)) {
        $content = get_option($microtango_settings['settings'])['defaultvideorowtemplate'];
    }

    if (empty($content)) {
        $content = "|{{VideoThumbnail}}#Name|{{Name}}#Beschreibung|{{Description}}#Länge|{{Length}}#|{{ShowVideo}}";
    }

    $columns = "\"" . str_replace("#", "\", \"", $content) . "\"";

    // Code
    $return = <<<EOT
    <script>MicrotangoCMSHelper.addVideo(
        {
            "restKey": "{$atts['restkey']}",
            "showVideoText": "{$atts['showvideotext']}",
			"videoNotFoundText": "{$atts['videonotfoundtext']}",
            "loginText": "{$atts['logintext']}",
            "loadCSS": "{$atts['loadcss']}",
            "templates": { "id": "mtuserdefined$rnd", "columns": [{$columns}] },
            "update": [{"videoGroup": "{$atts['videogroup']}", "templateId": "{$atts['templateid']}"}],
        });
    </script>
EOT;

    return htmlspecialchars_decode($return);
}

function microtango_shortcode_form($atts, $content = "")
{
    global $microtango_settings;
	
	if (get_option($microtango_settings['settings'])['disabled'] && !is_preview() && !current_user_can('manage_options'))
		return;

    // Attributes
    $atts = shortcode_atts(
        array(
            'restkey' => get_option($microtango_settings['settings'])['restkey'],
            'formid' => '',
            'redirecturl' => '',
            'renameinput' => '',
            'testmode' => '',
        ),
        $atts,
        'mt_form'
    );

    $inputs = "\"" . str_replace("#", "\", \"", $content) . "\"";

    // Code
    $return = <<<EOT
    <script>MicrotangoCMSHelper.addForm(
        {
			"restKey": "{$atts['restkey']}",
			"formUpdate": "true",
			"formId": "{$atts['formid']}",
			"formRedirectURL": "{$atts['redirecturl']}",
			"formRenameInput": [{$inputs}],
            "formTestMode": "{$atts['testmode']}",
            "update": [],
        });
    </script>
EOT;

    return htmlspecialchars_decode($return);
}
