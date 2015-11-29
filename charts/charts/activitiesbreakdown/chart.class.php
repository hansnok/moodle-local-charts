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
 * Activities breakdown implementation
 *
 * @author    Jonathan Blood
 * @package   local_charts
 * @copyright 2015 Jonathan Blood
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/../chart.class.php');

class chart_activitiesbreakdown extends chart {

    protected function generate_data() {
         global $DB;
                 
        $tuples = array();
        $header = array('Activities', 'Count');
        $tuples[] = $header;

        if (!$modules = $DB->get_records('modules', array(), 'name ASC')) {
            print_error('moduledoesnotexist', 'error');
        }
        
        foreach ($modules as $module) {

            try {
                $count = $DB->count_records_select($module->name, "course<>0");
            } catch (dml_exception $e) {
                $count = -1;
            }
            
            $data = array(get_string('modulename', $module->name), (int) $count);
            $tuples[] = $data;
        }
        return $tuples;
    }

    public function display($data) {
        global $CFG, $PAGE;

        $name = $this->get_name();
        $PAGE->requires->js( new moodle_url($CFG->wwwroot . '/local/charts/charts/' . 
                $name . '/js/' . $name . '.js') );
        $PAGE->requires->js_init_call('drawChart', 
                array(
                    'activitiesdata' => $data, 
                    'title' => get_string('pluginname', 'chart_activitiesbreakdown')
                    )); 

        echo html_writer::tag('div', '', array('id' => 'activities_chart'));
        echo html_writer::tag('div', '', array('id' => 'save_as_png_activitiesbreakdown'));
    }

}
