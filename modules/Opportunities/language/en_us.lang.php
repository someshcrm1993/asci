<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2016 Salesagility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 ********************************************************************************/

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$mod_strings = array(
    'LBL_MODULE_NAME' => 'Porposal',
    'LBL_MODULE_TITLE' => 'Porposal: Home',
    'LBL_SEARCH_FORM_TITLE' => 'Porposal Search',
    'LBL_VIEW_FORM_TITLE' => 'Porposal View',
    'LBL_LIST_FORM_TITLE' => 'Porposal List',
    'LBL_OPPORTUNITY_NAME' => 'Porposal Name:',
    'LBL_OPPORTUNITY' => 'Porposal:',
    'LBL_NAME' => 'Porposal Name',
    'LBL_INVITEE' => 'Contacts',
    'LBL_CURRENCIES' => 'Currencies',
    'LBL_LIST_OPPORTUNITY_NAME' => 'Name',
    'LBL_LIST_ACCOUNT_NAME' => 'Account Name',
    'LBL_LIST_AMOUNT' => 'Porposal Amount',
    'LBL_LIST_AMOUNT_USDOLLAR' => 'Amount',
    'LBL_LIST_DATE_CLOSED' => 'Close',
    'LBL_LIST_SALES_STAGE' => 'Sales Stage',
    'LBL_ACCOUNT_ID' => 'Account ID',
    'LBL_CURRENCY_ID' => 'Currency ID',
    'LBL_CURRENCY_NAME' => 'Currency Name',
    'LBL_CURRENCY_SYMBOL' => 'Currency Symbol',
//DON'T CONVERT THESE THEY ARE MAPPINGS
    'db_sales_stage' => 'LBL_LIST_SALES_STAGE',
    'db_name' => 'LBL_NAME',
    'db_amount' => 'LBL_LIST_AMOUNT',
    'db_date_closed' => 'LBL_LIST_DATE_CLOSED',
//END DON'T CONVERT
    'UPDATE' => 'Porposal - Currency Update',
    'UPDATE_DOLLARAMOUNTS' => 'Update U.S. Dollar Amounts',
    'UPDATE_VERIFY' => 'Verify Amounts',
    'UPDATE_VERIFY_TXT' => 'Verifies that the amount values in Porposal are valid decimal numbers with only numeric characters(0-9) and decimals(.)',
    'UPDATE_FIX' => 'Fix Amounts',
    'UPDATE_FIX_TXT' => 'Attempts to fix any invalid amounts by creating a valid decimal from the current amount. Any modified amount is backed up in the amount_backup database field. If you run this and notice bugs, do not rerun it without restoring from the backup as it may overwrite the backup with new invalid data.',
    'UPDATE_DOLLARAMOUNTS_TXT' => 'Update the U.S. Dollar amounts for Porposal based on the current set currency rates. This value is used to calculate Graphs and List View Currency Amounts.',
    'UPDATE_CREATE_CURRENCY' => 'Creating New Currency:',
    'UPDATE_VERIFY_FAIL' => 'Record Failed Verification:',
    'UPDATE_VERIFY_CURAMOUNT' => 'Current Amount:',
    'UPDATE_VERIFY_FIX' => 'Running Fix would give',
    'UPDATE_INCLUDE_CLOSE' => 'Include Closed Records',
    'UPDATE_VERIFY_NEWAMOUNT' => 'New Amount:',
    'UPDATE_VERIFY_NEWCURRENCY' => 'New Currency:',
    'UPDATE_DONE' => 'Done',
    'UPDATE_BUG_COUNT' => 'Bugs Found and Attempted to Resolve:',
    'UPDATE_BUGFOUND_COUNT' => 'Bugs Found:',
    'UPDATE_COUNT' => 'Records Updated:',
    'UPDATE_RESTORE_COUNT' => 'Record Amounts Restored:',
    'UPDATE_RESTORE' => 'Restore Amounts',
    'UPDATE_RESTORE_TXT' => 'Restores amount values from the backups created during fix.',
    'UPDATE_FAIL' => 'Could not update - ',
    'UPDATE_NULL_VALUE' => 'Amount is NULL setting it to 0 -',
    'UPDATE_MERGE' => 'Merge Currencies',
    'UPDATE_MERGE_TXT' => 'Merge multiple currencies into a single currency. If there are multiple currency records for the same currency, you merge them together. This will also merge the currencies for all other modules.',
    'LBL_ACCOUNT_NAME' => 'Account Name:',
    'LBL_AMOUNT' => 'Porposal Amount:',
    'LBL_AMOUNT_USDOLLAR' => 'Amount:',
    'LBL_CURRENCY' => 'Currency:',
    'LBL_DATE_CLOSED' => 'Expected Close Date:',
    'LBL_TYPE' => 'Type:',
    'LBL_CAMPAIGN' => 'Campaign:',
    'LBL_NEXT_STEP' => 'Next Step:',
    'LBL_LEAD_SOURCE' => 'Lead Source:',
    'LBL_SALES_STAGE' => 'Sales Stage:',
    'LBL_PROBABILITY' => 'Probability (%):',
    'LBL_DESCRIPTION' => 'Description:',
    'LBL_DUPLICATE' => 'Possible Duplicate Porposal',
    'MSG_DUPLICATE' => 'The Porposal record you are about to create might be a duplicate of a Porposal record that already exists. Porposal records containing similar names are listed below.<br>Click Save to continue creating this new Porposal, or click Cancel to return to the module without creating the Porposal.',
    'LBL_NEW_FORM_TITLE' => 'Create Porposal',
    'LNK_NEW_OPPORTUNITY' => 'Create Porposal',
    'LNK_OPPORTUNITY_LIST' => 'View Porposal',
    'ERR_DELETE_RECORD' => 'A record number must be specified to delete the Porposal.',
    'LBL_TOP_OPPORTUNITIES' => 'My Top Open Porposal',
    'NTC_REMOVE_OPP_CONFIRMATION' => 'Are you sure you want to remove this contact from the Porposal?',
    'OPPORTUNITY_REMOVE_PROJECT_CONFIRM' => 'Are you sure you want to remove this Porposal from the project?',
    'LBL_DEFAULT_SUBPANEL_TITLE' => 'Porposal',
    'LBL_ACTIVITIES_SUBPANEL_TITLE' => 'Activities',
    'LBL_HISTORY_SUBPANEL_TITLE' => 'History',
    'LBL_RAW_AMOUNT' => 'Raw Amount',

    'LBL_LEADS_SUBPANEL_TITLE' => 'Leads',
    'LBL_CONTACTS_SUBPANEL_TITLE' => 'Contacts',
    'LBL_DOCUMENTS_SUBPANEL_TITLE' => 'Documents',
    'LBL_PROJECTS_SUBPANEL_TITLE' => 'Projects',
    'LBL_ASSIGNED_TO_NAME' => 'Assigned to:',
    'LBL_LIST_ASSIGNED_TO_NAME' => 'Assigned User',
    'LBL_MY_CLOSED_OPPORTUNITIES' => 'My Closed Porposal',
    'LBL_TOTAL_OPPORTUNITIES' => 'Total Porposal',
    'LBL_CLOSED_WON_OPPORTUNITIES' => 'Closed Won Porposal',
    'LBL_ASSIGNED_TO_ID' => 'Assigned User:',
    'LBL_CREATED_ID' => 'Created by ID',
    'LBL_MODIFIED_ID' => 'Modified by ID',
    'LBL_MODIFIED_NAME' => 'Modified by User Name',
    'LBL_CREATED_USER' => 'Created User',
    'LBL_MODIFIED_USER' => 'Modified User',
    'LBL_CAMPAIGN_OPPORTUNITY' => 'Campaigns',
    'LBL_PROJECT_SUBPANEL_TITLE' => 'Projects',
    'LABEL_PANEL_ASSIGNMENT' => 'Assignment',
    'LNK_IMPORT_OPPORTUNITIES' => 'Import Porposal',
    'LBL_EDITLAYOUT' => 'Edit Layout' /*for 508 compliance fix*/,
    //For export labels
    'LBL_EXPORT_CAMPAIGN_ID' => 'Campaign ID',
    'LBL_OPPORTUNITY_TYPE' => 'Porposal Type',
    'LBL_EXPORT_ASSIGNED_USER_NAME' => 'Assigned User Name',
    'LBL_EXPORT_ASSIGNED_USER_ID' => 'Assigned User ID',
    'LBL_EXPORT_MODIFIED_USER_ID' => 'Modified By ID',
    'LBL_EXPORT_CREATED_BY' => 'Created By ID',
    'LBL_EXPORT_NAME' => 'Name',

    // SNIP
    'LBL_CONTACT_HISTORY_SUBPANEL_TITLE' => 'Related Contacts\' Emails',
    'TWITTER_USER_C' => 'Twitter User',
);

?>
