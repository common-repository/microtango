<?php
/*
Plugin Name: Microtango
Plugin URI: https://microtango.de/
Description: Microtango WP integration. Requires subscription from DMS. Will include the Microtango REST API to show your cloud data.
Version: 0.9.26
Author: microtango
Author URI: https://profiles.wordpress.org/microtango/
License: MIT License
License URI: http://opensource.org/licenses/MIT
Text Domain: microtango

Copyright 2019-2023 DMS Computer Contor

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"),
to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
IN THE SOFTWARE.
 */

$microtango_settings = array(
    "plugin_name" => "microtango",
    "settings_page" => "Microtango",
    "settings_page_title" => "Microtango Einstellungen",
    "settings" => "microtango_settings",
    "version" => "0.9.26"
);

require_once "microtango-settings-init.php";
require_once "microtango-init.php";