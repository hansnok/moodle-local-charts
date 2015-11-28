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
 * Utilities
 *
 * @author    Jonathan Blood
 * @package   local_charts
 * @copyright 2015 Jonathan Blood
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

/**
 * Returns an instance of the check.
 * Null if no check exists with that path.
 * 
 * @param string $name The name of the plugin
 * @param string $path The path to the plugin
 * @return \classname Instance of plugin
 */
function local_charts_create_chart_plugin_instance($name, $path) {

    if (file_exists("$path/chart.class.php")) {
        require_once("$path/chart.class.php");

        $classname = "chart_$name";
        $chart = new $classname();
        return $chart;
    }

    return null;
}