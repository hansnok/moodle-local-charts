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
 * Main page
 *
 * @author    Jonathan Blood
 * @package   local_charts
 * @copyright 2015 Jonathan Blood
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");
require_once($CFG->dirroot . '/local/charts/lib.php');

$context = context_system::instance();

require_login();

$PAGE->set_context($context);
$PAGE->set_url('/local/charts/index.php');
$PAGE->set_heading(get_string('pluginname', 'local_charts'));
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('pluginname', 'local_charts'));
$PAGE->navbar->add(get_string('pluginname', 'local_charts'));


echo $OUTPUT->header();

echo html_writer::tag('div', '<script type="text/javascript" src="' . $CFG->setting_charts_chartsurl . '"></script>');

    // Loads plugin settings page see /charts/classes/plugininfo/chart.php:load_settings.
    foreach (core_plugin_manager::instance()->get_plugins_of_type('chart') as $plugin) {
        echo html_writer::tag('h1', $plugin->displayname);
        $chart = local_charts_create_chart_plugin_instance($plugin->name,$plugin->rootdir);
    }
echo $OUTPUT->footer();