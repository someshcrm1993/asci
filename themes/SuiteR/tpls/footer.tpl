{*
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
 
 * SimpleCRM Basic instance is an extension to SuiteCRM 7.5.1 and SugarCRM Community Edition 6.5.20. 
 * It is developed by SimpleCRM (https://www.simplecrm.com.sg)
 * Copyright (C) 2016 - 2017 SimpleCRM
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

*}
</div>
</div>
<!-- END of container-fluid, pageContainer divs -->
<!-- Start Footer Section -->
{if $AUTHENTICATED}
<!-- Start generic footer -->
    <footer style="padding-top:12px;padding-bottom:10px;margin-bottom:1px">
             <div class="serverstats">
            <span class="glyphicon glyphicon-globe"></span> {$STATISTICS}
        </div>
       

        <div id="copyright_data"  align="right">
            <div id="copyrightbuttons" align="right" style="margin-left:64%;"> 

 <img height="35" src="custom/include/images/simplecrm.png" style="margin-bottom:-15px;"></img>	           
	<a id="powered_by" style="font-size:11px;padding-right:18px">&copy; {$MOD.LBL_SUITE_POWERED_BY}</a>
<br>
  	<a id="supercharged_by" style="font-size:11px;">&copy; Supercharged By SuiteCRM</a>

            </div>
        </div>

    </footer>
<!-- END Generic Footer -->
{/if}
<!-- END Footer Section -->
{literal}
<script>

//qe_init function sets listeners to click event on elements of 'quickEdit' class
 if(typeof(DCMenu) !='undefined'){
    DCMenu.qe_refresh = false;
    DCMenu.qe_handle;
 }
function qe_init(){

    //do not process if YUI is undefined
    if(typeof(YUI)=='undefined' || typeof(DCMenu) == 'undefined'){
        return;
    }


    //remove all existing listeners.  This will prevent adding multiple listeners per element and firing multiple events per click
    if(typeof(DCMenu.qe_handle) !='undefined'){
        DCMenu.qe_handle.detach();
    }

    //set listeners on click event, and define function to call
    YUI().use('node', function(Y) {
        var qe = Y.all('.quickEdit');
        var refreshDashletID;
        var refreshListID;

        //store event listener handle for future use, and define function to call on click event
        DCMenu.qe_handle = qe.on('click', function(e) {
            //function will flash message, and retrieve data from element to pass on to DC.miniEditView function
            ajaxStatus.flashStatus(SUGAR.language.get('app_strings', 'LBL_LOADING'),800);
            e.preventDefault();
            if(typeof(e.currentTarget.getAttribute('data-dashlet-id'))!='undefined'){
                refreshDashletID = e.currentTarget.getAttribute('data-dashlet-id');
            }
            if(typeof(e.currentTarget.getAttribute('data-list'))!='undefined'){
                refreshListID = e.currentTarget.getAttribute('data-list');
            }
            DCMenu.miniEditView(e.currentTarget.getAttribute('data-module'), e.currentTarget.getAttribute('data-record'),refreshListID,refreshDashletID);
        });

    });
}


    qe_init();

	SUGAR_callsInProgress++;
	SUGAR._ajax_hist_loaded = true;
    if(SUGAR.ajaxUI)
    	YAHOO.util.Event.onContentReady('ajaxUI-history-field', SUGAR.ajaxUI.firstLoad);
     $(document).ready(function(){  
                $(".phone,#primary_address_postalcode,#alt_address_postalcode,#billing_address_postalcode,#shipping_address_postalcode").on('keypress',function(e){  
                          if(e.keyCode == '9' || e.keyCode == '16'){  
                                return;  
                           }  
                           var code;  
                           if (e.keyCode) code = e.keyCode;  
                           else if (e.which) code = e.which;   
                           if(e.which == 46)  
                                return false;  
                           if (code == 8 || code == 46)  
                                return true;  
                           if (code < 48 || code > 57)  
                                return false;  
                     }  
                );  
                $(".phone").on("paste",function(e) {  
                     e.preventDefault();  
                });  
                $(".phone").on('mouseenter',function(e){  
                      var val = $(this).val();  
                      if (val!='0'){  
                           val=val.replace(/[^0-9]+/g, "")  
                           $(this).val(val);  
                      }  
                }); 
                $( "#primary_address_city,#alt_address_city,#primary_address_state,#alt_address_state,#primary_address_country,#alt_address_country,#billing_address_city,#billing_address_state,#billing_address_country,#shipping_address_city,#shipping_address_state,#shipping_address_country" ).keypress(function(e) {
                    var key = e.keyCode;
                    if (key >= 48 && key <= 57) {
                        e.preventDefault();
                    }
                }); 
           });
</script>
{/literal}
</div>
</body>
</html>
