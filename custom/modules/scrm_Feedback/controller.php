<?php
/**
 *  @copyright SimpleCRM http://www.simplecrm.com.sg
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,programme
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

class scrm_FeedbackController extends SugarController{

    public function action_downloadFeedback()
    {
        global $db;
        $id = $_REQUEST['id'];
        // $query = "
        //         SELECT
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 1 THEN 1 else 0 END) as unsatisfactory,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 2 THEN 1 else 0 END) as satisfactory,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 3 THEN 1 else 0 END) as good,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 4 THEN 1 else 0 END) as very_good,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.delivery_rating_c = 5 THEN 1 else 0 END) as excellent,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'High' THEN 1 else 0 END) as High,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'Med' THEN 1 else 0 END) as Med,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'Low' THEN 1 else 0 END) as Low,
        //             SUM(CASE WHEN scrm_feedback_sessions_cstm.relevance_c = 'VeryLow' THEN 1 else 0 END) as vlow,          
        //             scrm_session_information.name as session_name
        //         FROM project 
        //         INNER JOIN project_scrm_timetable_1_c ON project_scrm_timetable_1_c.project_scrm_timetable_1project_ida = project.id
        //         INNER JOIN project_cstm ON project_cstm.id_c = project.id
        //         INNER JOIN scrm_timetable_scrm_session_information_1_c ON scrm_timetable_scrm_session_information_1_c.scrm_timetable_scrm_session_information_1scrm_timetable_ida = project_scrm_timetable_1_c.project_scrm_timetable_1scrm_timetable_idb
        //         INNER JOIN scrm_feedback_sessions_cstm ON scrm_feedback_sessions_cstm.session_c = scrm_timetable_scrm_session_information_1_c.scrm_timetc7f4rmation_idb
        //         INNER JOIN scrm_session_information ON scrm_session_information.id = scrm_feedback_sessions_cstm.session_c
        //         WHERE project.deleted = '0'
        //         AND scrm_timetable_scrm_session_information_1_c.deleted = '0'
        //         AND project_scrm_timetable_1_c.deleted = '0'
        //         AND project.id = '$id'
        //         GROUP BY project.id, scrm_session_information.id
        // ";
        $feedbackBean = BeanFactory::getBean('scrm_Feedback',$_REQUEST['id']); 
        $programmeId = $feedbackBean->project_scrm_feedback_1project_ida;

        $query = "
                SELECT 
                    scrm_feedback_sessions_cstm.delivery_rating_c,
                    scrm_feedback_sessions_cstm.relevance_c,
                    scrm_session_information.name as session_name                
                FROM scrm_feedback
                INNER JOIN scrm_feedback_cstm ON scrm_feedback_cstm.id_c = scrm_feedback.id
                INNER JOIN scrm_feedback_scrm_feedback_sessions_1_c ON scrm_feedback_scrm_feedback_sessions_1_c.scrm_feedback_scrm_feedback_sessions_1scrm_feedback_ida = scrm_feedback.id
                INNER JOIN scrm_feedback_sessions_cstm ON scrm_feedback_sessions_cstm.id_c = scrm_feedback_scrm_feedback_sessions_1_c.scrm_feedback_scrm_feedback_sessions_1scrm_feedback_sessions_idb 
                INNER JOIN scrm_session_information ON scrm_feedback_sessions_cstm.session_c = scrm_session_information.id
                WHERE scrm_feedback.id = '{$id}'
        ";

      

        $queryObjective = "
                SELECT 
                    scrm_feedback_objective_cstm.rating_c,
                    scrm_feedback_objective_cstm.objective_c,
                    scrm_programme_objective.name
                FROM scrm_feedback_objective
                INNER JOIN scrm_feedback_objective_cstm ON scrm_feedback_objective.id = scrm_feedback_objective_cstm.id_c
                INNER JOIN scrm_feedback_scrm_feedback_objective_1_c ON scrm_feedback_scrm_feedback_objective_1_c.scrm_feedb10e5jective_idb = scrm_feedback_objective.id
                INNER JOIN scrm_feedback ON scrm_feedback.id = scrm_feedback_scrm_feedback_objective_1_c.scrm_feedback_scrm_feedback_objective_1scrm_feedback_ida
                INNER JOIN scrm_programme_objective ON scrm_programme_objective.id = scrm_feedback_objective_cstm.objective_c
                WHERE scrm_feedback.id = '{$id}'
        ";

        $queryProgramme = "
                SELECT
                    scrm_feedback_cstm.overall_rating_c as o1,
                    project_cstm.start_date_c,
                    project_cstm.end_date_c,
                    project.name,
                    scrm_feedback_cstm.topics_include_c as topics_include_c,
                    scrm_feedback_cstm.topics_not_relevant_c as topics_not_relevant_c,
                    scrm_feedback_cstm.learning_outcomes_c as learning_outcomes_c,
                    scrm_feedback_cstm.attend_asci_programmes_c as attend_asci_programmes_c,
                    scrm_feedback_cstm.offer_other_programms_c as offer_other_programms_c
                FROM scrm_feedback
                INNER JOIN scrm_feedback_cstm ON scrm_feedback_cstm.id_c = scrm_feedback.id
                INNER JOIN project_scrm_feedback_1_c ON project_scrm_feedback_1_c.project_scrm_feedback_1scrm_feedback_idb = scrm_feedback.id
                INNER JOIN project ON project_scrm_feedback_1_c.project_scrm_feedback_1project_ida = project.id
                INNER JOIN project_cstm ON project_cstm.id_c = project.id
                WHERE scrm_feedback.id = '{$id}'
        ";  

        /*Somesh Bawane
        Dt. 24/01/2019
        Mid-point feedback start*/

        $sql = "SELECT start_date_c,end_date_c FROM project INNER JOIN project_cstm ON project_cstm.id_c = project.id WHERE id = '".$id."'";
        $date = $db->fetchByAssoc($db->query($sql));

        $now = new DateTime(); // get today's date
        $start = new DateTime($date['start_date_c']); // get start date of program
        $end = new DateTime($date['end_date_c']); // get end date of program
        
        // total days
        $days = $start->diff($end, true)->days;
        $curdays = $start->diff($now, true)->days;

        $sundays = intval($days / 7) + ($start->format('N') + $days % 7 >= 7);
        $sundaystoday = intval($curdays / 7) + ($start->format('N') + $curdays % 7 >= 7);
        $newprog = [];

        $interval = $days - $sundays;
        $curInterval = $curdays - $sundaystoday;

        //for showing Section 3 - 7 on last day +-1 day
        $show = 'hide';
        if($curInterval == ($interval-1) || $curInterval >= $interval){
            $show = 'show';
        }
        
        /*Midpoint feedback end*/      

        $feedbackSessions = $db->query($query);
        $feebackObjectives = $db->query($queryObjective);
        $feedback = $db->fetchByAssoc($db->query($queryProgramme));

        include 'feedbackDoc.php';            
    }
   
}