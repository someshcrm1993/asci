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

	global $current_user;
    global $db;
    //~ $login_user_id = $current_user->id;
    
 ?>
<!-- <html>
    <head>

    </head>  
    <body>

        <input type="hidden" id="pathurl"  name="pathurl" value="<?php global $sugar_config;$url=$sugar_config['site_url'];{echo $url;}?>"/>
        <table width="100%" cellspacing="20" cellpadding="0" border="0" class="list view">    
        <th><h1><b>Reports</b></h1></th> 
			
       		<tr class="evenListRowS1" height="20" id='advisor'>
				<td class="nowrap" width="1%" style="padding-left:15px !important;">
				<a target="_blank" style="text-decoration: none" href="<?php echo $url ?>/index.php?module=AOS_Contracts&action=programme_report"><span style ="font-family: Arial;font-size:15.5px;" ><b>    <span style="font-size:21px;">»</span>&nbsp;ASCI Programme Summary Report</b></span></a> 
				</td>
			</tr>

		  </table>
</body>
</html> -->
 <?php  

 ?>
<html>
    <head>

    </head> 
    <body>
   <!--   <h2>List Of Reports</h2>-->
    <form name="frmsales" id="frmsales" action="" method="post">
        <input type="hidden" id="pathurl"  name="pathurl" value="<?php global $sugar_config;$url=$sugar_config['site_url'];{echo $url;}?>"/>

		<table width="100%" cellspacing="20" cellpadding="0" border="0" class="list view">    
        	<th><h1><b>FO Reports</b></h1></th>   
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=programme_statement_report"><span style ="font-family: Arial;font-size:14px;" ><b>1.&nbsp;Programme Statement Report:</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=dues_from_clients_report"><span style ="font-family: Arial;font-size:14px;" ><b>2.&nbsp;Dues From Clients:</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=centrewise_revenue_report"><span style ="font-family: Arial;font-size:14px;" ><b>3.&nbsp;Centre wise Revenue Report:</b></span></a> 
                </td>
            </tr> 
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=centrewise_ie_statement_report"><span style ="font-family: Arial;font-size:14px;" ><b>4.&nbsp;Centre wise I&E Statement Report:</b></span></a> 
                </td>
            </tr>      
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=budget_actuals_report"><span style ="font-family: Arial;font-size:14px;" ><b>5.&nbsp;Budget Vs Actuals Report:</b></span></a> 
                </td>
            </tr>                              
		 </table>


        <table width="100%" cellspacing="20" cellpadding="0" border="0" class="list view">    
        <th><h1><b>Reports</b></h1></th>   
             <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=programme_report"><span style ="font-family: Arial;font-size:14px;" ><b>1.&nbsp;ASCI Programme Summary Report</b></span></a> 
                </td>
            </tr>
<!--             <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=program_wise_organisations"><span style ="font-family: Arial;font-size:14px;" ><b>2.&nbsp;Programme wise Organisations Report</b></span></a> 
                </td>
            </tr> -->
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=accommodation_report"><span style ="font-family: Arial;font-size:14px;" ><b>2.&nbsp;Guest Speakers, Bella Vistan &amp; Guests Report</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=sponsor_report"><span style ="font-family: Arial;font-size:14px;" ><b>3.&nbsp;Sponsor Report</b></span></a> 
                </td>
            </tr>   
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=participant_profile"><span style ="font-family: Arial;font-size:14px;" ><b>4.&nbsp;Participant Profile Report</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=nominations_report"><span style ="font-family: Arial;font-size:14px;" ><b>5.&nbsp;Nominations Report</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=proposal_report"><span style ="font-family: Arial;font-size:14px;" ><b>6.&nbsp;Proposal Report</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=projection_report"><span style ="font-family: Arial;font-size:14px;" ><b>7.&nbsp;ICTP Projections Report</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=awarded_ictp_report"><span style ="font-family: Arial;font-size:14px;" ><b>8.&nbsp;Awarded ICTP Report</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=trends_awarded_ictp_report"><span style ="font-family: Arial;font-size:14px;" ><b>9.&nbsp;Trends in awarded ICTP Report</b></span></a> 
                </td>
            </tr>        
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=faculty_workload_report"><span style ="font-family: Arial;font-size:14px;" ><b>10.&nbsp;Faculty workload</b></span></a> 
                </td>
            </tr>    
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=faculty_feedback_report"><span style ="font-family: Arial;font-size:14px;" ><b>11.&nbsp;Faculty/Guest Faculty Feedback:</b></span></a> 
                </td>
            </tr>
            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=admin_arrangements_report"><span style ="font-family: Arial;font-size:14px;" ><b>12.&nbsp;Admin Arrangements Report:</b></span></a> 
                </td>
            </tr>

            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=on_demand_programme_report"><span style ="font-family: Arial;font-size:14px;" ><b>13.&nbsp;On demand list of programmes Report:</b></span></a> 
                </td>
            </tr>

            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=room_occupancy_report"><span style ="font-family: Arial;font-size:14px;" ><b>14.&nbsp;Room occupancy report:</b></span></a> 
                </td>
            </tr>

            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=weekly_occupancy_report"><span style ="font-family: Arial;font-size:14px;" ><b>15.&nbsp;Weekly occupancy report:</b></span></a> 
                </td>
            </tr>         

            <tr class="oddListRowS1" height="20">
                <td class="nowrap" width="1%">
                <a target="_blank" style="text-decoration: none" href="index.php?module=AOS_Contracts&action=daily_occupancy_report"><span style ="font-family: Arial;font-size:14px;" ><b>16.&nbsp;Daily occupancy report:</b></span></a> 
                </td>
            </tr>                           
       </table>

    </form>
</body>
</html>
