<script src="modules/AOR_Conditions/conditionLines.js"></script>
<script>
    report_module = '{$report_module}';
</script>

<div>
    {$charts_content}
</div>

<div id='detailpanel_parameters' class='detail view  detail508 expanded hidden'>
    <form onsubmit="return false" id="EditView" name="EditView">
    <h4>
        <a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel('parameters');">
            <img border="0" id="detailpanel_parameters_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
        <a href="javascript:void(0)" class="expandLink" onclick="expandPanel('parameters');">
            <img border="0" id="detailpanel_parameters_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
        {sugar_translate label='PARAMETERS' module='AOR_Reports'}
        <script>
            document.getElementById('detailpanel_parameters').className += ' expanded';
        </script>
    </h4>
    <div id="conditionLines" class="panelContainer" style="min-height: 50px;">
    </div>
    <button id='updateParametersButton' class="panelContainer" type="button">{sugar_translate label='LBL_UPDATE_PARAMETERS' module='AOR_Reports'}</button>
    <script>
        {literal}
        //Made Chages by Saurabh S
        $.each(reportParameters,function(key,val){
            loadConditionLine(val, 'EditView');
          });
          $(document).ready(function() {
            $('#updateParametersButton').click(function () {
              //Update the Detail view form to have the parameter info and reload the page
              var _form = $('#formDetailView');
              _form.find('input[name=action]').val('DetailView');
              //Add each parameter to the form in turn
              $('.aor_conditions_id').each(function (index, elem) {
                $elem = $(elem);
                var ln = $elem.attr('id').substr(17);
                var id = $elem.val();
                _form.append('<input type="hidden" name="parameter_id[]" value="' + id + '">');
                var operator = $("#aor_conditions_operator\\[" + ln + "\\]").val();
                _form.append('<input type="hidden" name="parameter_operator[]" value="' + operator + '">');
                var fieldType = $('#aor_conditions_value_type\\[' + ln + '\\]').val();
                _form.append('<input type="hidden" name="parameter_type[]" value="' + fieldType + '">');
                var fieldInput = $('#aor_conditions_value\\[' + ln + '\\]').val();
                // Fix for issue #1272 - AOR_Report module cannot update Date type parameter.
                if ($('#aor_conditions_value\\[' + ln + '\\]\\[0\\]').length) {
                    var fieldValue = $('#aor_conditions_value\\[' + ln + '\\]\\[0\\]').val();
                    var fieldSign = $('#aor_conditions_value\\[' + ln + '\\]\\[1\\]').val();
                    var fieldNumber = $('#aor_conditions_value\\[' + ln + '\\]\\[2\\]').val();
                    var fieldTime = $('#aor_conditions_value\\[' + ln + '\\]\\[3\\]').val();
                    _form.append('<input type="hidden" name="parameter_value[]" value="' + fieldValue + '">');
                    _form.append('<input type="hidden" name="parameter_value[]" value="' + fieldSign + '">');
                    _form.append('<input type="hidden" name="parameter_value[]" value="' + fieldNumber + '">');
                    _form.append('<input type="hidden" name="parameter_value[]" value="' + fieldTime + '">');
                }
                // Fix for issue #1082 - change local date format to db date format
                if ($('#aor_conditions_value\\[' + index + '\\]').hasClass('date_input')) { // only change to DB format if its a date
                    if (isDate(fieldInput)) {
                        var dateObject = getDateObject(fieldInput);
                    }
                    fieldInput = $.datepicker.formatDate('yy-mm-dd', dateObject);
                }
                _form.append('<input type="hidden" name="parameter_value[]" value="' + fieldInput + '">');
              });
              _form.submit();
            });
            // Need to wait to make sure that all the condition line elements have been added to the page.
            $(document).one("ajaxStop", function() {
                // Make sure to change dates back to the user format
                $('.aor_conditions_id').each(function(index, elem){
                    if($('#aor_conditions_value\\['+index+'\\]').hasClass('date_input')) {
                        var value = $('#aor_conditions_value\\['+ index +'\\]').val();
                        var formatString = cal_date_format.replace(/%/g, '').toLowerCase().replace(/y/g, 'yy').replace(/m/g, 'mm').replace(/d/g, 'dd');
                        // From DB format
                        var date_reg_format = '([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})';
                        myregexp = new RegExp(date_reg_format);
                        if(myregexp.test(value)) {
                            // Split timestamp into [ Y, M, D ]
                            var t = value.split(/[- :]/);
                            // Apply each element to the Date function
                            var dateObject = new Date(Date.UTC(t[0], t[1]-1, t[2]));
                            value = $.datepicker.formatDate(formatString, dateObject);
                            // From user format
                        } else {
                            if (isDate(value)) {
                                var dateObject = getDateObject(value);
                            }
                            value = $.datepicker.formatDate(formatString, dateObject);
                        }
                        $('#aor_conditions_value\\['+index+'\\]').val(value);
                    }
                });
            });
        });
        {/literal}
    </script>
    <script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel('parameters', 'expanded'); {rdelim}); </script>
    </form>
</div>

<div id='detailpanel_report' class='detail view  detail508 expanded'>
    {counter name="panelFieldCount" start=0 print=false assign="panelFieldCount"}
    <h4>
        <a href="javascript:void(0)" class="collapseLink" onclick="collapsePanel('report');">
            <img border="0" id="detailpanel_report_img_hide" src="{sugar_getimagepath file="basic_search.gif"}"></a>
        <a href="javascript:void(0)" class="expandLink" onclick="expandPanel('report');">
            <img border="0" id="detailpanel_report_img_show" src="{sugar_getimagepath file="advanced_search.gif"}"></a>
        {sugar_translate label='REPORT' module='AOR_Reports'}
        <script>
            document.getElementById('detailpanel_report').className += ' expanded';
        </script>
    </h4>
    <table id='FIELDS' class="panelContainer" cellspacing='{$gridline}'>
        {counter name="fieldsUsed" start=0 print=false assign="fieldsUsed"}
        {counter name="fieldsHidden" start=0 print=false assign="fieldsHidden"}
        {capture name="tr" assign="tableRow"}
            <tr>
                {counter name="fieldsUsed"}
                <td width='37.5%' colspan='4' >
                    {if !$fields.field_lines.hidden}
                        {counter name="panelFieldCount"}
                        <span id='field_lines_span'>
{$fields.field_lines.value}
                            {$report_content}
</span>
                    {/if}
                </td>
            </tr>
        {/capture}
        {if $fieldsUsed > 0 && $fieldsUsed != $fieldsHidden}
            {$tableRow}
        {/if}
    </table>
    <script type="text/javascript">SUGAR.util.doWhen("typeof initPanel == 'function'", function() {ldelim} initPanel('report', 'expanded'); {rdelim}); </script>
</div>

<script src="modules/AOR_Reports/Dashlets/AORReportsDashlet/AORReportsDashlet.js"></script>
