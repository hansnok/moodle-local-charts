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
 * User map implementation
 *
 * @author    Jonathan Blood
 * @package   local_charts
 * @copyright 2015 Jonathan Blood
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die();

require_once(dirname(__FILE__) . '/../chart.class.php');

class chart_usermap extends chart {

    
    protected function generate_data() {
        global $DB;

        $tuples = array();
        $header = array('Country', 'Popularity');
        $tuples[] = $header;
        
        $sql = "SELECT count(id) as popularity, country as Country FROM {user} WHERE country <> '' GROUP by country";
        $result = $DB->get_records_sql($sql);
        foreach ($result as $userdata) {
            $data = array(get_string($userdata->country, 'countries'), (int) $userdata->popularity);
            $tuples[] = $data;
        }
        return $tuples;
        
    }

    public function display($data) {
        global $CFG, $PAGE;

        $name = $this->get_name();
        $PAGE->requires->js( new moodle_url($CFG->wwwroot . '/local/charts/charts/' . 
                $name . '/js/' . $name . '.js') );
        $PAGE->requires->js_init_call('drawRegionsMap', array('geodata' => $data)); 

        echo html_writer::tag('div', '', array('id' => 'regions_chart', 'style' => 'width: 800px; height: 500px;'));
    }

}
