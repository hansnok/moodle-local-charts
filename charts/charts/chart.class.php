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
 * Class for charts class
 *
 * @author    Jonathan Blood
 * @package   local_charts
 * @copyright 2015 Jonathan Blood
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

/**
 * Class for base check
 */
abstract class chart {
    
    protected $data = null;

    public function __construct() {
       $this->data = $this->generate_data();
       $this->display($this->data);
    }

    abstract protected function generate_data();

    abstract public function display($data);

    /**
     * get_name - get the name of the check (i.e. check_login => login)
     *
     * @access public
     * @return string   the checks name
     */
    public function get_name() {
        $class = get_class($this);
        $chartname = substr($class, strlen('chart_'));
        return $chartname;
    }

}
