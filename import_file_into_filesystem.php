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
 * This script copies a course backup file into the file system ready for restoration via the GUI.
 *
 * @package    core
 * @subpackage cli
 * @copyright  2017 Catalyst
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// CLI script
define('CLI_SCRIPT', 1);

// Run from /admin/cli dir
require_once(dirname(dirname(dirname(__FILE__))).'/config.php');

// Where is file to import?
$filefolder = '/'; // Full path include trailing slash.

// What is the filename?
$filename = ''; // eg. 'backup-moodle2-course-70-wr261014-20170111-1203-nu.mbz'.

// Just leave everything below alone ok.
$fullimportpath = $filefolder . $filename;

// Get Catalyst Administrator User Context Id.
$contextid = $DB->get_field('context', 'id', array('contextlevel' => CONTEXT_USER, 'instanceid' => 76008));

$fs = get_file_storage();

$file_record = array(
    'component' => 'user',
    'filearea' => 'backup',
    'filepath' => '/',
    'contextid' => $contextid,
    'filename' => $filename,
    'itemid' => 0,
    'timecreated' => time(),
    'timemodified' => time()
);

if (file_exists($fullimportpath)) {
    $fs->create_file_from_pathname($file_record, $fullimportpath);
}
