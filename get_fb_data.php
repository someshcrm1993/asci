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

$access_token = 'EAAW7RFqX6T0BAMtuVAJJEwNdH4h51qYmrtoLoKgZAjiZAVn2ZB7ZBJY8u0bzY0P1OaQpMBCfIGxB1LkkI4XAMDTULSjQUqNldC5kjZCG6NZCIG5GcfHp3ERyZAfYmEOCdJpGYSJB3qHWtVP4UYp4vKWztTD39rOkNgZD';

$user_details = "https://graph.facebook.com/710249769114185/feed?&method=GET&access_token=" .$access_token;
$response     = file_get_contents($user_details);
$response     = json_decode($response);
$data         = $response->data;

echo "<pre>";
print_r($data);
echo "</prev>";


echo "connected successfully";
?>
