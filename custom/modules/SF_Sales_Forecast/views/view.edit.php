<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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


class SF_Sales_ForecastViewEdit extends ViewEdit
{
 	public function __construct()
 	{
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 		$this->useModuleQuickCreateTemplate = true;
 		
 	}
 	function display()
 	{
		      $recordID = $this->bean->id;
		echo $javacript = <<<EOD
		<script>
		function checkStatus(){
				var assigned_user_id = $('#users_sf_sales_forecast_1users_ida').val();
				var year = $('#year').val();
				var quarter = $('#quarter').val();
				var id = '$recordID';
				if(id == '')
				{
				$.ajax({
							url:'CheckUser.php', // root file 
										type: 'GET',
										async: false,
										data:
										{
											assigned_user_id:assigned_user_id, 
											year:year,
											quarter:quarter,
										},
							success:function(result) {
							if(result > 0)
							{
								alert('You can\'t create more than one Sales Target record for the selected Sales User, Fiscal Year & Quarter');
								retTrue = 'False';
							}
							else
							{
								retTrue = 'True';
							}
					}
				});
				if(retTrue == 'True')
						{
							return true;
						}
						else if(retTrue == 'False')
						{
							return false;
						}
						else
						{
							return true;
						}
				}
			else
				{
					return true;
			}
		}
		$(document).ready(function(){
		$('#opportunities_won').attr('readonly',true);
		});
		</script>
EOD;
		parent::display();
	}
}
?>
