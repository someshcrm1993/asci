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

require_once('config.php');
require_once 'custom/include/encryption/EnvCrypt.php';
require_once 'custom/blowfish/Blowfish.php';

	global $sugar_config;
	$mysql_hostname = $sugar_config['dbconfig']['db_host_name'];
	$mysql_user     = $sugar_config['dbconfig']['db_user_name'];
	$mysql_password = $sugar_config['dbconfig']['db_password'];
	$mysql_database = $sugar_config['dbconfig']['db_name'];
	$key = Blowfish::getKey(); 
	$mysql_password = EnvCrypt::decrypt($mysql_password,$key);
	try {
	    $connection = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_database",$mysql_user,$mysql_password);
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    // echo 'Connected to Database<br/>';
    }
	catch(PDOException $e)
    {
   		echo $e->getMessage();
    }
?>
