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
 * User map create chart
 *
 * @author    Jonathan Blood
 * @package   local_charts
 * @copyright 2015 Jonathan Blood
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


google.load("visualization", "1", {packages: ["geochart"]});

function drawRegionsMap(Y, geodata) {
    var data = google.visualization.arrayToDataTable(geodata);
    var options = {
        width: 800,
        height: 500
    };
    var chart = new google.visualization.GeoChart(document.getElementById('regions_chart'));
    google.visualization.events.addListener(chart, 'ready', function () {
        document.getElementById('save_as_png_usermap').outerHTML = '<a href="' + chart.getImageURI() + '">Printable version</a>';
    });
    chart.draw(data, options);
}
