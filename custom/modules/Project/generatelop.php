<?php

/**
 *  @copyright SimpleCRM http://www.simplecrm.com.sg
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU AFFERO GENERAL PUBLIC LICENSE
 * along with this program; if not, see http://www.gnu.org/licenses
 * or write to the Free Software Foundation,Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @author SimpleCRM <info@simplecrm.com.sg>
 */


require_once 'custom/include/PHPWord.php';

// New Word Document
$PHPWord = new PHPWord();

// New portrait section
$section = $PHPWord->createSection();

// Add table
$table = $section->addTable();

for($r = 1; $r <= 10; $r++) { // Loop through rows
	// Add row
	$table->addRow();
	
	for($c = 1; $c <= 5; $c++) { // Loop through cells
		// Add Cell
		$table->addCell(1750)->addText("Row $r, Cell $c");
	}
}

// Save File
$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
$objWriter->save($temp_file);

// Your browser will name the file "myFile.docx"
// regardless of what it's named on the server 
header("Content-Disposition: attachment; filename='lop.docx'");
readfile($temp_file); // or echo file_get_contents($temp_file);
unlink($temp_file);  // remove temp file
?>
