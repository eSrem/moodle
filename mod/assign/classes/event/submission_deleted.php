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
 * The submission_deleted event.
 *
 * @package    mod_assign
 * @copyright  2014 Virgil Ashruf <v.ashruf@avetica.nl>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_assign\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The mod_assign submission_deleted event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - Logs that a submission has been deleted.
 *
 * @package   mod_assign
 * @since     Moodle 2.8
 * @copyright 2014 Virgil Ashruf <v.ashruf@avetica.nl>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 **/
class submission_deleted extends \core\event\base {

    /**
     * Init function
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'c'; // This should be: c(reate), r(ead), u(pdate), d(elete).
        $this->data['edulevel'] = self::LEVEL_PARTICIPATING;
        $this->data['objecttable'] = 'assign_submission';
    }

    /**
     * Name function
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventsubmissiondeleted', 'mod_assign');
    }

    /**
     * Description function
     *
     * @return string
     */
    public function get_description() {
        return "The user with id {$this->userid} deleted an assignment with submission id {$this->objectid}.";
    }

    /**
     * Legacy logdata function
     *
     * @return array
     */
    public function get_legacy_logdata() {
        // Override if you are migrating an add_to_log() call.
        return array($this->courseid, 'mod_assign', 'deleted submission',
            '...',
            $this->objectid, $this->contextinstanceid);
    }
}