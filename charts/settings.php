<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Global settings page
 *
 * @author    Jonathan Blood
 * @package   local_charts
 * @copyright 2015 Jonathan Blood
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) { // Needs this condition or there is error on login page.
    $ADMIN->add('localplugins',
            new admin_category('setting_charts',
                get_string('pluginname', 'local_charts'),
                false));
    $settings = new admin_settingpage('local_charts',
            get_string('pluginname', 'local_charts'));

    $ADMIN->add('setting_charts', $settings);

    $settings->add(new admin_setting_configtext('setting_charts_chartsurl',
        get_string('settings_chartsurl', 'local_charts'),
        get_string('settings_chartsurldesc', 'local_charts'), 'https://www.google.com/jsapi', PARAM_URL));


    // Loads plugin settings page see /charts/classes/plugininfo/chart.php:load_settings.
    foreach (core_plugin_manager::instance()->get_plugins_of_type('chart') as $plugin) {
        $plugin->load_settings($ADMIN, 'setting_charts', $hassiteconfig);
    }
}