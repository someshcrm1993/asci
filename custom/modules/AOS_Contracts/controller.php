<?php
if(!defined('sugarEntry')) die('Not a Valid Entry Point');
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


//require_once('modules/bhea_Reports/report_utils.php');

class AOS_ContractsController extends SugarController {
	
	
    //Nomination Summary Report By Vivek
    function action_programme_report() {
        $this->view = 'programme_report';
    }

    function action_program_wise_organisations() {
		
        $this->view = 'programmewiseorganisations';
    }

	function action_accommodation_report() {
		
        $this->view = 'accomodationsreport';
    }        

    function action_sponsor_report() {
        
        $this->view = 'sponsor_report';
    }

    function action_participant_profile() {
        
        $this->view = 'participant_profile';
    }

    function action_nominations_report() {
        
        $this->view = 'nominations_report';
    }

    function action_proposal_report() {
        
        $this->view = 'proposal_report';
    }

    function action_projection_report() {
        
        $this->view = 'projection_report';
    }

    function action_awarded_ictp_report() {
        
        $this->view = 'awarded_ictp_report';
    }

    function action_trends_awarded_ictp_report() {
        
        $this->view = 'trends_awarded_ictp_report';
    }

    function action_faculty_workload_report() {
        
        $this->view = 'faculty_workload_report';
    }

    function action_faculty_feedback_report() {
        
        $this->view = 'faculty_feedback_report';
    }

    function action_admin_arrangements_report() {
        
        $this->view = 'admin_arrangements_report';
    }

    function action_programme_statement_report() {
        
        $this->view = 'programme_statement_report';
    }

    function action_on_demand_programme_report() {
        
        $this->view = 'on_demand_programme_report';
    } 

    function action_dues_from_clients_report() {
        
        $this->view = 'dues_from_clients_report';
    }   

    function action_centrewise_revenue_report() {
        
        $this->view = 'centrewise_revenue_report';
    }  
      
    function action_centrewise_ie_statement_report() {
        
        $this->view = 'centrewise_ie_statement_report';
    }    

    function action_room_occupancy_report() {
        
        $this->view = 'room_occupancy_report';
    }    

    function action_weekly_occupancy_report() {
        
        $this->view = 'weekly_occupancy_report';
    }        

    function action_daily_occupancy_report() {
        
        $this->view = 'daily_occupancy_report';
    }    

    function action_budget_actuals_report() {
        
        $this->view = 'budget_actuals_report';
    }

    function action_dotp_budget_actuals_report() {
        
        $this->view = 'dotp_budget_actuals_report';
    }        
}

?>
