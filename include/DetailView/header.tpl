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
{{* Add the preForm code if it is defined (used for vcards) *}}
{{if $preForm}}
	{{$preForm}}
{{/if}}
 <script language="javascript">
{literal}
SUGAR.util.doWhen(function(){
    return $("#contentTable").length == 0;
}, SUGAR.themes.actionMenu);
{/literal}
</script>
<td class="buttons" align="right" style="min-width:50%;padding-right: 60px !important;" NOWRAP >

{{if !isset($form.buttons)}}
    {{sugar_button module="$module" id="EDIT" view="$view" form_id="formDetailView" appendTo="detail_header_buttons"}}
    {{sugar_button module="$module" id="DUPLICATE" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
    {{sugar_button module="$module" id="DELETE" view="$view" form_id="formDetailView" appendTo="detail_header_buttons"}}
{{else}}
    {{counter assign="num_buttons" start=0 print=false}}
    {{foreach from=$form.buttons key=val item=button}}
        {{if !is_array($button) && in_array($button, $built_in_buttons)}}
        {{counter print=false}}
        {{sugar_button module="$module" id="$button" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
        {{/if}}
    {{/foreach}}
    {{if count($form.buttons) > $num_buttons}}
        {{foreach from=$form.buttons key=val item=button}}
            {{if is_array($button) && $button.customCode}}
                {{sugar_button module="$module" id="$button" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
            {{/if}}
        {{/foreach}}
    {{/if}}
    {{if empty($form.hideAudit) || !$form.hideAudit}}
        {{sugar_button module="$module" id="Audit" view="EditView" form_id="formDetailView" appendTo="detail_header_buttons"}}
    {{/if}}
{{/if}}
{{sugar_action_menu id="detail_header_action_menu" buttons=$detail_header_buttons class="fancymenu" }}

{$ADMIN_EDIT}
	{{if $panelCount == 0}}
	    {{* Render tag for VCR control if SHOW_VCR_CONTROL is true *}}
		{{if $SHOW_VCR_CONTROL}}
			{$PAGINATION}
		{{/if}}
		{{counter name="panelCount" print=false}}
	{{/if}}
</div>
{{* Add $form.links if they are defined *}}
{{if !empty($form) && isset($form.links)}}
        <div class="actionsContainer">
            {{foreach from=$form.links item=link}}
                {{$link}}&nbsp;
            {{/foreach}}
        </div>
{{/if}}
<form action="index.php" method="post" name="DetailView" id="formDetailView">
    <input type="hidden" name="module" value="{$module}">
    <input type="hidden" name="record" value="{$fields.id.value}">
    <input type="hidden" name="return_action">
    <input type="hidden" name="return_module">
    <input type="hidden" name="return_id">
    <input type="hidden" name="module_tab">
    <input type="hidden" name="isDuplicate" value="false">
    <input type="hidden" name="offset" value="{$offset}">
    <input type="hidden" name="action" value="EditView">
    <input type="hidden" name="sugar_body_only">
{{if isset($form.hidden)}}
{{foreach from=$form.hidden item=field}}
{{$field}}
{{/foreach}}
{{/if}}
</form>

</div>

</td>
</tr>
</table>

