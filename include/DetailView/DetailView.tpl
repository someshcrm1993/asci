{*
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
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

{{if $module!="Users"}}

<style>
{literal}
#dialog
{
display:none;
}
i
{
display:none;
}
b
{
font-weight:normal;
}
.show_primary_email span table tbody tr:not(:first-child) {
display:none;
}

input[value="Copy..."] { display: none !important; }​




{/literal}
</style>

<script >
{literal}
$(document).ready(function () {
  $(".dataField").css("display","none");
	$('#Activities_createtask_button').attr('data-toggle', 'modal');
	$('#Activities_createtask_button').attr('data-target', '#myModalcustom_popup');
	$('#activities_createtask_button').attr('data-toggle', 'modal');
	$('#activities_createtask_button').attr('data-target', '#myModalcustom_popup');
	

	$('#Activities_schedulemeeting_button').attr('data-toggle', 'modal');
	$('#Activities_schedulemeeting_button').attr('data-target', '#myModalcustom_popup');
	$('#activities_schedulemeeting_button').attr('data-toggle', 'modal');
	$('#activities_schedulemeeting_button').attr('data-target', '#myModalcustom_popup');

	$('#Activities_logcall_button').attr('data-toggle', 'modal');
	$('#Activities_logcall_button').attr('data-target', '#myModalcustom_popup');
	$('#activities_logcall_button').attr('data-toggle', 'modal');
	$('#activities_logcall_button').attr('data-target', '#myModalcustom_popup');

	$('#History_createnoteorattachment_button').attr('data-toggle', 'modal');
	$('#History_createnoteorattachment_button').attr('data-target', '#myModalcustom_popup_history');
	$('#history_createnoteorattachment_button').attr('data-toggle', 'modal');
	$('#history_createnoteorattachment_button').attr('data-target', '#myModalcustom_popup_history');	

 
/*     
$( ".custom-noBullet" ).click(function() {
$("#"+this.id+" .change_color_dashlets span[id*='show_link_'] .utilsLink").trigger("click");
});
*/
 

var right=$(".custom-right-panel").height();
var left=$(".custom-left-panel").height();
if(left>=right)
{
$(".custom-left-panel").css("border-right","1px solid #d9dada");
}else
{
$(".custom-right-panel").css("border-left","1px solid #d9dada");
}

$(".custom-yui-nav li, .righttab").click(function(){
var right=$(".custom-right-panel").height();
var left=$(".custom-left-panel").height();
if(left>=right)
{
$(".custom-left-panel").css("border-right","1px solid #d9dada");
}else
{
$(".custom-right-panel").css("border-left","1px solid #d9dada");
}

})


if($('.custom-right-panel').length=="0")      
{
	$('.custom-left-panel').removeClass('col-sm-7');
	$('.custom-left-panel').addClass('col-sm-12');
}


});





{/literal}
</script>


{{include file=$headerTpl}}</div>
{sugar_include include=$includes}


{{if $module=="Accounts" || $module=="Contacts" || $module=="Opportunities" || $module=="Leads" || $module=="Cases" || $module=="Prospects" }}
	<div class="row">
	<div class="col-sm-12" style="padding:2px;margin-bottom: -4px;" >
	<div style="margin-left:12px;">
			
				{{if $module=="Accounts" }}
				
						{{php}}
						$array_cond = array("phone_office", "website", "email1");
						$this->assign("myfields_data", $array_cond);
						{{/php}}
				
				{{elseif $module=="Contacts" }} 				
						{{php}}
						$array_cond = array("phone_work", "email1", "title");
						$this->assign("myfields_data", $array_cond);
						{{/php}}


				{{elseif $module=="Opportunities"}}
						{{php}}
						$array_cond = array("account_name", "sales_stage", "next_step");
						$this->assign("myfields_data", $array_cond);
						{{/php}}

				{{elseif $module=="Leads"}}
						{{php}}
						$array_cond = array("phone_mobile", "email1", "next_step_c");
						$this->assign("myfields_data", $array_cond);
						{{/php}}

				{{elseif $module=="Cases"}}
						{{php}}
						$array_cond = array("priority", "type" , "state");
						$this->assign("myfields_data", $array_cond);
						{{/php}}

				{{elseif $module=="Prospects"}}
						{{php}}
						$array_cond = array("phone_work", "email1");
						$this->assign("myfields_data", $array_cond);
						{{/php}}
				{{/if}}
			


				
				<div id="{{$module}}_detailview1_tabs"
				{{if $useTabs}}
				class="yui-navset detailview_tabs" style="padding:0px;"
				{{/if}}
				>

				
				<div {{if $useTabs}}class="yui-content"{{/if}} >
				{{* Loop through all top level panels first *}}
				{{counter name="panelCount" print=false start=0 assign="panelCount"}}
				{{counter name="tabCount" start=-1 print=false assign="tabCount"}}
				{{foreach name=section from=$sectionPanels key=label item=panel}}

			

				{{assign var='panel_id' value=$panelCount}}
				{{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
				{{if (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true)}}
				{{counter name="tabCount" print=false}}
				{{if $tabCount != 0}}</div>{{/if}}
				<div id='tabcontent{{$tabCount}}'>
				{{/if}}





				{{if ( isset($tabDefs[$label_upper].panelDefault) && $tabDefs[$label_upper].panelDefault == "collapsed" && isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false) }}
				{{assign var='panelState' value=$tabDefs[$label_upper].panelDefault}}
				{{else}}
				{{assign var='panelState' value="expanded"}}
				{{/if}}
				<div id='detailpanel1_{{$smarty.foreach.section.iteration}}' class='detail view  detail508 {{$panelState}}'>
				{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
				{{* Print out the panel title if one exists*}}

				{{* Check to see if the panel variable is an array, if not, we'll attempt an include with type param php *}}
				{{* See function.sugar_include.php *}}

				{{if !is_array($panel)}}
				{sugar_include type='php' file='{{$panel}}'}
				{{else}}

				{{if !empty($label) && !is_int($label) && $label != 'DEFAULT' && (!isset($tabDefs[$label_upper].newTab) || (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false))}}

				{{/if}}
				{{* Print out the table data *}}
				<div id='{{$label}}' class="panelContainer"  style="background-color:white;" >




				{{foreach name=rowIteration from=$panel key=row item=rowData}}
				

				
				{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
				{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
				{capture name="tr" assign="tableRow"}
				<div>
				{{assign var='columnsInRow' value=$rowData|@count}}
				{{assign var='columnsUsed' value=0}}

	
				{{foreach name=colIteration from=$rowData key=col item=colData}}
				
				
				{*custom foreach for all selected module *}
				{{foreach name=modulerow from=$myfields_data key=col item=rowcolumns}}	
				{{if $colData.field.name==$rowcolumns}}
				
				
				
				{{if !empty($colData.field.hideIf)}}
				{if !({{$colData.field.hideIf}}) }
				{{/if}}
				{counter name="fieldsUsed"}
				{{if empty($colData.field.hideLabel)}}
				<div class="col-sm-2" scope="col" style="text-align:left;min-height:36px" >
				{{if !empty($colData.field.name)}}
				{if !$fields.{{$colData.field.name}}.hidden}
				{{/if}}
				{{if isset($colData.field.customLabel)}}
				{{$colData.field.customLabel}}
				{{elseif isset($colData.field.label) && strpos($colData.field.label, '$')}}
				{capture name="label" assign="label"}{{$colData.field.label}}{/capture}
				{$label|strip_semicolon}:
				{{elseif isset($colData.field.label)}}
				{capture name="label" assign="label"}{sugar_translate label='{{$colData.field.label}}' module='{{$module}}'}{/capture}
				{$label|strip_semicolon}:
				{{elseif isset($fields[$colData.field.name])}}
				{capture name="label" assign="label"}{sugar_translate label='{{$fields[$colData.field.name].vname}}' module='{{$module}}'}{/capture}
				{$label|strip_semicolon}:
				{{else}}
				&nbsp;
				{{/if}}
				{{if isset($colData.field.popupHelp) || isset($fields[$colData.field.name]) && isset($fields[$colData.field.name].popupHelp) }}
				{{if isset($colData.field.popupHelp) }}
				{capture name="popupText" assign="popupText"}{sugar_translate label="{{$colData.field.popupHelp}}" module='{{$module}}'}{/capture}
				{{elseif isset($fields[$colData.field.name].popupHelp)}}
				{capture name="popupText" assign="popupText"}{sugar_translate label="{{$fields[$colData.field.name].popupHelp}}" module='{{$module}}'}{/capture}
				{{/if}}
				{sugar_help text=$popupText WIDTH=400}
				{{/if}}
				{{if !empty($colData.field.name)}}
				{/if}
				{{/if}}
				{{/if}}
				
				<div class="{{if $inline_edit && ($fields[$colData.field.name].inline_edit == 1 || !isset($fields[$colData.field.name].inline_edit))}}inlineEdit{{/if}} {{if $fields[$colData.field.name].name=="email1"}} show_primary_email {{/if}}" type="{{$fields[$colData.field.name].type}}" field="{{$fields[$colData.field.name].name}}" {{if $colData.colspan}}colspan='{{$colData.colspan}}'{{/if}} {{if isset($fields[$colData.field.name].type) && $fields[$colData.field.name].type == 'phone'}}class="phone"{{/if}} style="font-size:14px;word-wrap: break-word;">
				{{if !empty($colData.field.name)}}
				{if !$fields.{{$colData.field.name}}.hidden}
				{{/if}}
				{{$colData.field.prefix}}
				{{if ($colData.field.customCode && !$colData.field.customCodeRenderField) || $colData.field.assign}}
				{counter name="panelFieldCount"}
				<span id="{{$colData.field.name}}" class="sugar_field">{{sugar_evalcolumn var=$colData.field colData=$colData}}</span>
				{{elseif $fields[$colData.field.name] && !empty($colData.field.fields) }}
				{{foreach from=$colData.field.fields item=subField}}
				{{if $fields[$subField]}}
				{counter name="panelFieldCount"}
				{{sugar_field parentFieldArray='fields' tabindex=$tabIndex vardef=$fields[$subField] displayType='DetailView'}}&nbsp;
				{{else}}
				{counter name="panelFieldCount"}
				{{$subField}}
				{{/if}}
				{{/foreach}}
				{{elseif $fields[$colData.field.name]}}
				{counter name="panelFieldCount"}
				{{sugar_field parentFieldArray='fields' vardef=$fields[$colData.field.name] displayType='DetailView' displayParams=$colData.field.displayParams typeOverride=$colData.field.type}}
				{{/if}}
				{{if !empty($colData.field.customCode) && $colData.field.customCodeRenderField}}
				{counter name="panelFieldCount"}
				<span id="{{$colData.field.name}}" class="sugar_field">{{sugar_evalcolumn var=$colData.field colData=$colData}}</span>
				{{/if}}
				{{$colData.field.suffix}}
				{{if !empty($colData.field.name)}}
				{/if}
				{{/if}}
	
				</div>
				</div>
				{{if !empty($colData.field.hideIf)}}
				{else}
				<div>&nbsp;</div><div>&nbsp;</div>
				{/if}
				{{/if}}
				
				
				
				
				{{/if}}
				{{/foreach}}



				{{/foreach}}
				</div>
				
				{/capture}
				{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
				{$tableRow}
				{/if}
				{{/foreach}}
				</div>
				{{if !empty($label) && !is_int($label) && $label != 'DEFAULT' && (!isset($tabDefs[$label_upper].newTab) || (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false))}}
				<script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel({{$smarty.foreach.section.iteration}}, '{{$panelState}}'); {rdelim}); </script>
				{{/if}}
				{{/if}}
				</div>
				{if $panelFieldCount == 0}

				<script>document.getElementById("{{$label}}").style.display='none';</script>
				{/if}
				{{/foreach}}
				{{if $useTabs}}
				</div>
				{{/if}}

				</div>
				</div>				
				
				
				
				



</div>
</div>
</div>

{{/if}}



<div {{if $module=="Employees"}}class="col-sm-12"{{else}}class="row" style="border:1px solid #d9dada; margin-top:5px"{{/if}} >

<div class="col-sm-7 custom-left-panel" {{if $module!="Employees"}}style="padding:0px 0px 10px 0px"{{else}}style="border:1px solid #d9dada;padding:0px 0px 10px 0px"{{/if}}>


<div id="{{$module}}_detailview_tabs"
{{if $useTabs}}
class="yui-navset detailview_tabs" style="padding:0px;"
{{/if}}
>
    {{if $useTabs}}
    {* Generate the Tab headers *}
    {{counter name="tabCount" start=-1 print=false assign="tabCount"}}
    <ul class="yui-nav custom-yui-nav">
    {{foreach name=section from=$sectionPanels key=label item=panel}}
        {{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
        {* override from tab definitions *}
        {{if (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true)}}
            {{counter name="tabCount" print=false}}
            <li><a id="tab{{$tabCount}}" href="javascript:void(0)"><em >{sugar_translate label='{{$label}}' module='{{$module}}'}</em></a></li>
        {{/if}}
    {{/foreach}}
    </ul>
    {{/if}}
    <div {{if $useTabs}}class="yui-content"{{/if}} {{if $module!="AOR_Reports"}}style="min-height:350px{{/if}}">
{{* Loop through all top level panels first *}}
{{counter name="panelCount" print=false start=0 assign="panelCount"}}
{{counter name="tabCount" start=-1 print=false assign="tabCount"}}
{{foreach name=section from=$sectionPanels key=label item=panel}}
{{assign var='panel_id' value=$panelCount}}
{{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
  {{if (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true)}}
    {{counter name="tabCount" print=false}}
    {{if $tabCount != 0}}</div>{{/if}}
    <div id='tabcontent{{$tabCount}}'>
  {{/if}}

    {{if ( isset($tabDefs[$label_upper].panelDefault) && $tabDefs[$label_upper].panelDefault == "collapsed" && isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false) }}
        {{assign var='panelState' value=$tabDefs[$label_upper].panelDefault}}
    {{else}}
        {{assign var='panelState' value="expanded"}}
    {{/if}}
    
<div id='detailpanel_{{$smarty.foreach.section.iteration}}' class='detail view  detail508 {{$panelState}}'>

{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
{{* Print out the panel title if one exists*}}

{{* Check to see if the panel variable is an array, if not, we'll attempt an include with type param php *}}
{{* See function.sugar_include.php *}}

{{if !is_array($panel)}}
    {sugar_include type='php' file='{{$panel}}'}

{{else}}

    {{if !empty($label) && !is_int($label) && $label != 'DEFAULT' && (!isset($tabDefs[$label_upper].newTab) || (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false))}}

    <h4>
    
      <a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel({{$smarty.foreach.section.iteration}});">
      {*<img border="0" id="detailpanel_{{$smarty.foreach.section.iteration}}_img_hide" src="{sugar_getimagepath file="basic_search.gif"}">*}
      <i class="fa fa-minus-square-o" aria-hidden="true" style="color:black"></i>

      </a>
      <a href="javascript:void(0)" class="expandLink" onclick="expandPanel({{$smarty.foreach.section.iteration}});">
      {*<img border="0" id="detailpanel_{{$smarty.foreach.section.iteration}}_img_show" src="{sugar_getimagepath file="advanced_search.gif"}">*}
      <i class="fa fa-plus-square-o" aria-hidden="true" style="color:black"></i>

      </a>
      {sugar_translate label='{{$label}}' module='{{$module}}'}
    {{if isset($panelState) && $panelState == 'collapsed'}}
    <script>
      document.getElementById('detailpanel_{{$smarty.foreach.section.iteration}}').className += ' collapsed';
    </script>
    {{else}}
    <script>
      document.getElementById('detailpanel_{{$smarty.foreach.section.iteration}}').className += ' expanded';
    </script>
    {{/if}}
    </h4>

    {{/if}}
	{{* Print out the table data *}}
  <div id='{{$label}}' class="panelContainer" cellspacing='{$gridline}' style="background-color:white;" >
	{{foreach name=rowIteration from=$panel key=row item=rowData}}
	{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
	{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
	{capture name="tr" assign="tableRow"}
	
	<div class="col-sm-12">
	
		{{assign var='columnsInRow' value=$rowData|@count}}
		{{assign var='columnsUsed' value=0}}
		{{foreach name=colIteration from=$rowData key=col item=colData}}
	    {{if !empty($colData.field.hideIf)}}
	    	{if !({{$colData.field.hideIf}}) }
	    {{/if}}
			{counter name="fieldsUsed"}
			{{if empty($colData.field.hideLabel)}}
			
			<div class="{{if $rowData|@count=="2"}}col-sm-6{{else}}col-sm-12{{/if}}" width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].label+$def.templateMeta.widths[$smarty.foreach.colIteration.index].field}}%' scope="col" style="text-align:left;word-wrap: break-word; padding-top:10px;padding-left:5px;padding-bottom:5px;" >
                
			<span style="font-weight:600">
				{{if !empty($colData.field.name)}}
				    {if !$fields.{{$colData.field.name}}.hidden}
                {{/if}}
				{{if isset($colData.field.customLabel)}}
			       {{$colData.field.customLabel}}
				{{elseif isset($colData.field.label) && strpos($colData.field.label, '$')}}
				   {capture name="label" assign="label"}{{$colData.field.label}}{/capture}
			       {$label|strip_semicolon}:
				{{elseif isset($colData.field.label)}}
				   {capture name="label" assign="label"}{sugar_translate label='{{$colData.field.label}}' module='{{$module}}'}{/capture}
			       {$label|strip_semicolon}:
				{{elseif isset($fields[$colData.field.name])}}
				   {capture name="label" assign="label"}{sugar_translate label='{{$fields[$colData.field.name].vname}}' module='{{$module}}'}{/capture}
			       {$label|strip_semicolon}:
				{{else}}
				   &nbsp;
				{{/if}}
                {{if isset($colData.field.popupHelp) || isset($fields[$colData.field.name]) && isset($fields[$colData.field.name].popupHelp) }}
                   {{if isset($colData.field.popupHelp) }}
                     {capture name="popupText" assign="popupText"}{sugar_translate label="{{$colData.field.popupHelp}}" module='{{$module}}'}{/capture}
                   {{elseif isset($fields[$colData.field.name].popupHelp)}}
                     {capture name="popupText" assign="popupText"}{sugar_translate label="{{$fields[$colData.field.name].popupHelp}}" module='{{$module}}'}{/capture}
                   {{/if}}
                   {sugar_help text=$popupText WIDTH=400}
                {{/if}}
                {{if !empty($colData.field.name)}}
                {/if}
                {{/if}}
                {{/if}}

			</span>
			<div class="{{if $inline_edit && ($fields[$colData.field.name].inline_edit == 1 || !isset($fields[$colData.field.name].inline_edit))}}inlineEdit{{/if}}" type="{{$fields[$colData.field.name].type}}" field="{{$fields[$colData.field.name].name}}" {*width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].field}}%'*} {{if $colData.colspan}}colspan='{{$colData.colspan}}'{{/if}} {{if isset($fields[$colData.field.name].type) && $fields[$colData.field.name].type == 'phone'}}class="phone"{{/if}} style="font-size:14px;word-wrap: break-word;">
			    {{if !empty($colData.field.name)}}
			    {if !$fields.{{$colData.field.name}}.hidden}
			    {{/if}}
				{{$colData.field.prefix}}
				{{if ($colData.field.customCode && !$colData.field.customCodeRenderField) || $colData.field.assign}}
					{counter name="panelFieldCount"}
					<span id="{{$colData.field.name}}" class="sugar_field">{{sugar_evalcolumn var=$colData.field colData=$colData}}</span>
				{{elseif $fields[$colData.field.name] && !empty($colData.field.fields) }}
				    {{foreach from=$colData.field.fields item=subField}}
				        {{if $fields[$subField]}}
				        	{counter name="panelFieldCount"}
				            {{sugar_field parentFieldArray='fields' tabindex=$tabIndex vardef=$fields[$subField] displayType='DetailView'}}&nbsp;

				        {{else}}
				        	{counter name="panelFieldCount"}
				            {{$subField}}
				        {{/if}}
				    {{/foreach}}
				{{elseif $fields[$colData.field.name]}}
					{counter name="panelFieldCount"}
					{{sugar_field parentFieldArray='fields' vardef=$fields[$colData.field.name] displayType='DetailView' displayParams=$colData.field.displayParams typeOverride=$colData.field.type}}

				{{/if}}
				{{if !empty($colData.field.customCode) && $colData.field.customCodeRenderField}}
				    {counter name="panelFieldCount"}
				    <span id="{{$colData.field.name}}" class="sugar_field">{{sugar_evalcolumn var=$colData.field colData=$colData}}</span>
                {{/if}}
				{{$colData.field.suffix}}
				{{if !empty($colData.field.name)}}
				{/if}
				{{/if}}

	            {{if $inline_edit && ($fields[$colData.field.name].inline_edit == 1 || !isset($fields[$colData.field.name].inline_edit))}}<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>{{/if}}
			</div>
			</div>
	    {{if !empty($colData.field.hideIf)}}
			{else}

			<div>&nbsp;</div><div>&nbsp;</div>
			{/if}
	    {{/if}}

		{{/foreach}}
		  
		
	</div>
	{/capture}
	{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
	{$tableRow}
	{/if}
	{{/foreach}}
	
	</div>
	
	<span >&nbsp;</span>
    {{if !empty($label) && !is_int($label) && $label != 'DEFAULT' && (!isset($tabDefs[$label_upper].newTab) || (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false))}}
    <script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel({{$smarty.foreach.section.iteration}}, '{{$panelState}}'); {rdelim}); </script>
    {{/if}}
{{/if}}
</div>
  

{if $panelFieldCount == 0}

<script>document.getElementById("{{$label}}").style.display='none';</script>
{/if}
{{/foreach}}
{{if $useTabs}}
  </div>
{{/if}}

</div>
</div>
</div>
{{include file=$footerTpl}}
{{if $useTabs}}
<script type='text/javascript' src='{sugar_getjspath file='include/javascript/popup_helper.js'}'></script>
<script type="text/javascript" src="{sugar_getjspath file='cache/include/javascript/sugar_grp_yui_widgets.js'}"></script>
<script type="text/javascript">
var {{$module}}_detailview_tabs = new YAHOO.widget.TabView("{{$module}}_detailview_tabs");
{{$module}}_detailview_tabs.selectTab(0);
</script>
{{/if}}
<script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>









<!--
 <button type="button" id="history_activities_modal_button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalcustom_popup">Open Large Modal</button>

-->

		

{{else}}



{{include file=$headerTpl}}
{sugar_include include=$includes}
<div id="{{$module}}_detailview_tabs"
{{if $useTabs}}
class="yui-navset detailview_tabs"
{{/if}}
>
    {{if $useTabs}}
    {* Generate the Tab headers *}
    {{counter name="tabCount" start=-1 print=false assign="tabCount"}}
    <ul class="yui-nav" >
    {{foreach name=section from=$sectionPanels key=label item=panel}}
        {{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
        {* override from tab definitions *}
        {{if (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true)}}
            {{counter name="tabCount" print=false}}
            <li><a id="tab{{$tabCount}}" href="javascript:void(0)"><em>{sugar_translate label='{{$label}}' module='{{$module}}'}</em></a></li>
        {{/if}}
    {{/foreach}}
    </ul>
    {{/if}}
    <div {{if $useTabs}}class="yui-content"{{/if}}>
{{* Loop through all top level panels first *}}
{{counter name="panelCount" print=false start=0 assign="panelCount"}}
{{counter name="tabCount" start=-1 print=false assign="tabCount"}}
{{foreach name=section from=$sectionPanels key=label item=panel}}
{{assign var='panel_id' value=$panelCount}}
{{capture name=label_upper assign=label_upper}}{{$label|upper}}{{/capture}}
  {{if (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == true)}}
    {{counter name="tabCount" print=false}}
    {{if $tabCount != 0}}</div>{{/if}}
    <div id='tabcontent{{$tabCount}}'>
  {{/if}}

    {{if ( isset($tabDefs[$label_upper].panelDefault) && $tabDefs[$label_upper].panelDefault == "collapsed" && isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false) }}
        {{assign var='panelState' value=$tabDefs[$label_upper].panelDefault}}
    {{else}}
        {{assign var='panelState' value="expanded"}}
    {{/if}}
<div id='detailpanel_{{$smarty.foreach.section.iteration}}' class='detail view  detail508 {{$panelState}}'>
{counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
{{* Print out the panel title if one exists*}}

{{* Check to see if the panel variable is an array, if not, we'll attempt an include with type param php *}}
{{* See function.sugar_include.php *}}
{{if !is_array($panel)}}
    {sugar_include type='php' file='{{$panel}}'}
{{else}}

    {{if !empty($label) && !is_int($label) && $label != 'DEFAULT' && (!isset($tabDefs[$label_upper].newTab) || (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false))}}
    <h4>
      <a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel({{$smarty.foreach.section.iteration}});">
      <img border="0" id="detailpanel_{{$smarty.foreach.section.iteration}}_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
      <a href="javascript:void(0)" class="expandLink" onclick="expandPanel({{$smarty.foreach.section.iteration}});">
      <img border="0" id="detailpanel_{{$smarty.foreach.section.iteration}}_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
      {sugar_translate label='{{$label}}' module='{{$module}}'}
    {{if isset($panelState) && $panelState == 'collapsed'}}
    <script>
      document.getElementById('detailpanel_{{$smarty.foreach.section.iteration}}').className += ' collapsed';
    </script>
    {{else}}
    <script>
      document.getElementById('detailpanel_{{$smarty.foreach.section.iteration}}').className += ' expanded';
    </script>
    {{/if}}
    </h4>

    {{/if}}
	{{* Print out the table data *}}
  <table id='{{$label}}' class="panelContainer" cellspacing='{$gridline}'>



	{{foreach name=rowIteration from=$panel key=row item=rowData}}
	{counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
	{counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
	{capture name="tr" assign="tableRow"}
	<tr>
		{{assign var='columnsInRow' value=$rowData|@count}}
		{{assign var='columnsUsed' value=0}}
		{{foreach name=colIteration from=$rowData key=col item=colData}}
	    {{if !empty($colData.field.hideIf)}}
	    	{if !({{$colData.field.hideIf}}) }
	    {{/if}}
			{counter name="fieldsUsed"}
			{{if empty($colData.field.hideLabel)}}
			<td width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].label}}%' scope="col">
				{{if !empty($colData.field.name)}}
				    {if !$fields.{{$colData.field.name}}.hidden}
                {{/if}}
				{{if isset($colData.field.customLabel)}}
			       {{$colData.field.customLabel}}
				{{elseif isset($colData.field.label) && strpos($colData.field.label, '$')}}
				   {capture name="label" assign="label"}{{$colData.field.label}}{/capture}
			       {$label|strip_semicolon}:
				{{elseif isset($colData.field.label)}}
				   {capture name="label" assign="label"}{sugar_translate label='{{$colData.field.label}}' module='{{$module}}'}{/capture}
			       {$label|strip_semicolon}:
				{{elseif isset($fields[$colData.field.name])}}
				   {capture name="label" assign="label"}{sugar_translate label='{{$fields[$colData.field.name].vname}}' module='{{$module}}'}{/capture}
			       {$label|strip_semicolon}:
				{{else}}
				   &nbsp;
				{{/if}}
                {{if isset($colData.field.popupHelp) || isset($fields[$colData.field.name]) && isset($fields[$colData.field.name].popupHelp) }}
                   {{if isset($colData.field.popupHelp) }}
                     {capture name="popupText" assign="popupText"}{sugar_translate label="{{$colData.field.popupHelp}}" module='{{$module}}'}{/capture}
                   {{elseif isset($fields[$colData.field.name].popupHelp)}}
                     {capture name="popupText" assign="popupText"}{sugar_translate label="{{$fields[$colData.field.name].popupHelp}}" module='{{$module}}'}{/capture}
                   {{/if}}
                   {sugar_help text=$popupText WIDTH=400}
                {{/if}}
                {{if !empty($colData.field.name)}}
                {/if}
                {{/if}}
                {{/if}}
			</td>
			<td class="{{if $inline_edit && ($fields[$colData.field.name].inline_edit == 1 || !isset($fields[$colData.field.name].inline_edit))}}inlineEdit{{/if}}" type="{{$fields[$colData.field.name].type}}" field="{{$fields[$colData.field.name].name}}" width='{{$def.templateMeta.widths[$smarty.foreach.colIteration.index].field}}%' {{if $colData.colspan}}colspan='{{$colData.colspan}}'{{/if}} {{if isset($fields[$colData.field.name].type) && $fields[$colData.field.name].type == 'phone'}}class="phone"{{/if}}>
			    {{if !empty($colData.field.name)}}
			    {if !$fields.{{$colData.field.name}}.hidden}
			    {{/if}}
				{{$colData.field.prefix}}
				{{if ($colData.field.customCode && !$colData.field.customCodeRenderField) || $colData.field.assign}}
					{counter name="panelFieldCount"}
					<span id="{{$colData.field.name}}" class="sugar_field">{{sugar_evalcolumn var=$colData.field colData=$colData}}</span>
				{{elseif $fields[$colData.field.name] && !empty($colData.field.fields) }}
				    {{foreach from=$colData.field.fields item=subField}}
				        {{if $fields[$subField]}}
				        	{counter name="panelFieldCount"}
				            {{sugar_field parentFieldArray='fields' tabindex=$tabIndex vardef=$fields[$subField] displayType='DetailView'}}&nbsp;

				        {{else}}
				        	{counter name="panelFieldCount"}
				            {{$subField}}
				        {{/if}}
				    {{/foreach}}
				{{elseif $fields[$colData.field.name]}}
					{counter name="panelFieldCount"}
					{{sugar_field parentFieldArray='fields' vardef=$fields[$colData.field.name] displayType='DetailView' displayParams=$colData.field.displayParams typeOverride=$colData.field.type}}

				{{/if}}
				{{if !empty($colData.field.customCode) && $colData.field.customCodeRenderField}}
				    {counter name="panelFieldCount"}
				    <span id="{{$colData.field.name}}" class="sugar_field">{{sugar_evalcolumn var=$colData.field colData=$colData}}</span>
                {{/if}}
				{{$colData.field.suffix}}
				{{if !empty($colData.field.name)}}
				{/if}
				{{/if}}

	            {{if $inline_edit && ($fields[$colData.field.name].inline_edit == 1 || !isset($fields[$colData.field.name].inline_edit))}}<div class="inlineEditIcon"> {sugar_getimage name="inline_edit_icon.svg" attr='border="0" ' alt="$alt_edit"}</div>{{/if}}

			</td>
	    {{if !empty($colData.field.hideIf)}}
			{else}

			<td>&nbsp;</td><td>&nbsp;</td>
			{/if}
	    {{/if}}

		{{/foreach}}
	</tr>
	{/capture}
	{if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
	{$tableRow}
	{/if}
	{{/foreach}}
	</table>
    {{if !empty($label) && !is_int($label) && $label != 'DEFAULT' && (!isset($tabDefs[$label_upper].newTab) || (isset($tabDefs[$label_upper].newTab) && $tabDefs[$label_upper].newTab == false))}}
    <script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel({{$smarty.foreach.section.iteration}}, '{{$panelState}}'); {rdelim}); </script>
    {{/if}}
{{/if}}
</div>
{if $panelFieldCount == 0}

<script>document.getElementById("{{$label}}").style.display='none';</script>
{/if}
{{/foreach}}
{{if $useTabs}}
  </div>
{{/if}}

</div>
</div>
{{include file=$footerTpl}}
{{if $useTabs}}
<script type='text/javascript' src='{sugar_getjspath file='include/javascript/popup_helper.js'}'></script>
<script type="text/javascript" src="{sugar_getjspath file='cache/include/javascript/sugar_grp_yui_widgets.js'}"></script>
<script type="text/javascript">
var {{$module}}_detailview_tabs = new YAHOO.widget.TabView("{{$module}}_detailview_tabs");
{{$module}}_detailview_tabs.selectTab(0);
</script>
{{/if}}
<script type="text/javascript" src="include/InlineEditing/inlineEditing.js"></script>
<script type="text/javascript" src="modules/Favorites/favorites.js"></script>


{{/if}}



	<div class="modal fade custom_dialog" id="myModalcustom_popup" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">

			<div class="modal-body table-responsive">
			<div id="subpanel_activities"></div>

			<!--                     <input title="Cancel" class="subpanel_cancel_button_custom" class="button" onclick="return SUGAR.subpanelUtils.cancelCreate($(this).attr(\'id\'));return false;" type="submit" name="' . $params['module'] . '_subpanel_cancel_button" id="' . $params['module'] . '_subpanel_cancel_button" value="Cancel" data-dismiss="modal">
			-->  

			</div>

			</div>
			</div>
			</div>


			<div class="modal fade custom_dialog" id="myModalcustom_popup_history" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">

			<div class="modal-body table-responsive">

			<div id="subpanel_history"></div>

			</div>

			</div>
			</div>
			</div>
