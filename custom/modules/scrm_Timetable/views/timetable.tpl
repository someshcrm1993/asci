{literal}
<link rel="stylesheet" type="text/css" href="custom/include/clockpicker/clockpicker.css">
<style type="text/css">
	.glyphicon-minus{
		color: red!important;
	}
	.right span:hover{
		cursor: pointer;
		/*background-color: #eee; */
	}

	table .glyphicon-plus{
		cursor: pointer;
		display: block!important;
		padding-bottom: 4px;
	}
	table td div span:hover{
		cursor: pointer;
		/*background-color: #2382D5; */
	}

	table td div .glyphicon-remove{
		padding-left: 4px!important;
	}

	.drop{
		padding: 0!important;
	}
	.w50{
		width: 50%!important;display: inline-block;
	}
	.w33{
		width: 33.3333333333%!important;display: inline-block;
	}

	.w25{
		width: 25%!important;display: inline-block;
	}
	.w100{
		width: 100%!important;
	}
	.session-data{
		border:1px solid #ddd;padding: 9px;;
	}
	.session-mix-time{
		font-size: 10px;
	    width: auto;
	    border-bottom: 1px solid #ddd;
	    padding-left: 27px;
	    padding-bottom: 2px;
	}
	.popover.clockpicker-popover{
	    z-index: 9999;
	}
table#timetable_table, table#timetable_table .table{
	    border: 1px solid #ddd;
	    margin-bottom: 0px;
}
</style>
{/literal}

<div class="right">
	{if $isMultiweek==1}
		<br/>
		<a href="{$site_url}index.php?module=scrm_Timetable&action=multiweek&record={$id}#tab1" class="btn btn-sm" style="margin-right: 14px;" target="_blank">Click Here To Open Multiweek Timetable</a>
	{else}
	{foreach from=$tables item=item key=key}
		<table id="timetable_table" class="table table-bordered table-responsive">
			<tr>
				<td style="text-align: center;" width="200px">
					<span>Day</span>/<span>Date</span>
				</td>
				<td style="text-align: center;" width="200px">
					<strong>	09:00 - 10:30</strong>
				</td>
				<td style="text-align: center;" width="200px">
					<strong>	11:00 - 12:30</strong>
				</td>
				<td style="text-align: center;" width="200px">
					<strong>	14:00 - 15:30</strong>
				</td>
				<td style="text-align: center;" width="200px">
					<strong>	16:00 - 17:30</strong>
				</td>
				<td style="text-align: center;" width="200px">
					<strong>	18:00 - 19:30</strong>
				</td>
			</tr>
				{$item}
		</table>		
		<br />
		<br />
	{/foreach}
	{/if}
</div>


<div id="myModal" class="modal fade">
	<form id="timetable" name="timetable">
		<input type="hidden" name="timetable_id" value="{$id}"> 
		<div class="modal-dialog">
			<!-- Modal content--> 
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button> 
					<h4 class="modal-title">Add Session</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="faculty_name">Faculty Name:</label> 
						<select name="faculty_name_c" class="form-control" id="faculty_name" title="">
							<option label="" value="" selected="selected"></option>
						</select>
					</div>
					<div class="form-group"><label for="session_name">Session Name:</label> <input name="session_name" id="session_name" class="form-control" type="text" /></div>
					<div class="form-group"><label for="session_time_from">Session Time From:</label> <input name="session_time_from" id="session_time_from" class="form-control" type="text" /></div>
					<div class="form-group"><label for="session_time_to">Session Time To:</label> <input name="session_time_to_c" id="session_time_to" class="form-control" type="text"/></div>
					<div class="form-group">
						<label for="session_time_to">Day:</label> 
						<select name="day_c" id="day_c" title="" class="form-control">
							<option label="" value="" selected="selected"></option>
						</select>
					</div>
				</div>
				<div class="modal-footer"><a href="javascript:;" class="btn btn-default" id="timetableSubmit">Submit</a> <button class="btn btn-default" type="button" data-dismiss="modal">Close</button></div>
			</div>
		</div>
	</form>
</div>
<!-- create session modal ends here --> <!-- edit session modal starts here --> 
<div id="sessionModal" class="modal fade">
	<form id="timetable" name="timetable">
		<div class="modal-dialog">
			<!-- Modal content--> 
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button> 
					<h4 class="modal-title">Edit Session</h4>
				</div>
				<div class="modal-body">
					<div class="form-group"><label for="faculty_name_edit">Faculty Name:</label> <input name="faculty_name_edit" id="faculty_name_edit" class="form-control" type="text" /></div>
					<div class="form-group"><label for="session_name">Session Name:</label> <input name="session_name_edit" id="session_name_edit" class="form-control" type="text" /></div>
					<div class="form-group"><label for="session_time_from_edit">Session Time From:</label> <input name="session_time_from_edit" id="session_time_from_edit" class="form-control" type="text" /></div>
					<div class="form-group"><label for="session_time_to_edit">Session Time To:</label> <input name="session_time_to_edit" id="session_time_to_edit" class="form-control" type="text"/></div>
				</div>
				<div class="modal-footer"> <a href="javascript:;" class="btn btn-default pull-left timetableDelete" id="timetableDelete">Delete</a> <a href="javascript:;" class="btn btn-default" id="edittimetableSubmit">Submit</a> <button class="btn btn-default" type="button" data-dismiss="modal">Close</button> </div>
			</div>
		</div>
	</form>
</div>
<input type="hidden" name="timetableData" id="timetableData">
<div id="myModalTime" class="modal fade">
	<form id="timetableTime" name="timetableTime">
		<input type="hidden" name="timetable_time_id" value="{$id}"> 
		<div class="modal-dialog">
			<!-- Modal content--> 
			<div class="modal-content">
				<div class="modal-header">
					<button class="close" type="button" data-dismiss="modal">&times;</button> 
					<h4 class="modal-title">Add Time Slots</h4>
				</div>
				<div class="modal-body">
					<div class="form-group"><label for="session_time_from_time">Session Time From:</label> <input name="session_time_from" id="session_time_from_time" class="form-control" type="text" /></div>
					<div class="form-group"><label for="session_time_to">Session Time To:</label> <input name="session_time_to_c" id="session_time_to_time" class="form-control" type="text"/></div>
				</div>
				<div class="modal-footer"><a href="javascript:;" class="btn btn-default" id="timetableSubmit_time">Submit</a> <button class="btn btn-default" type="button" data-dismiss="modal">Close</button></div>
			</div>
		</div>
	</form>
</div>

{literal} 

<script type="text/javascript" src="custom/include/clockpicker/clockpicker.js"></script>
<script type="text/javascript" src="custom/include/date.js"></script>
<script type="text/javascript">
	//timetable time modal
	$('#myModalTime').on('shown.bs.modal', function(e) {
		// fromTime = slot.attr('data-booked-upto');
		
		// $('#session_time_from').val(fromTime);

		// toTime = slot.attr('data-to');
	    
		var input = $('#session_time_from_time');
		input.clockpicker({
			autoclose: true
		});
		var input1 = $('#session_time_to_time');
		input1.clockpicker({
			autoclose: true
		});
	});

	//create new session functionality
	$('#timetableSubmit_time').click(function(){
			var from = $('#session_time_from_time').val();
			var to = $('#session_time_to_time').val();
			var error = false;
			
			if (from == '') {
				$('#session_time_from_time').next('.error').remove();
				$('#session_time_from_time').after('<span class="error">Please enter start time<span>');
				error = true;				
			}

			if (to == '') {
				$('#session_time_to_time').next('.error').remove();
				$('#session_time_to_time').after('<span class="error">Please enter end time<span>');
				error = true;				
			}

			if (!error) {
				$.ajax({url:'index.php?entryPoint=addTimetableTimeSlots',data:$('#timetableTime').serialize(),type:'POST',dataType:'json',success:function(result)
				{
					var a =	result.result1;
					var b= result.result2;			
					
					for (var key in a) 
					{

						if (a.hasOwnProperty(key)) 
						{	faculty[key] = [];
							faculty[key]['name'] = a[key];
							faculty[key]['id'] = b[key];
							
							// $('#faculty_name_c').append('<option value=\"'+id_list+'\">'+faculty_list+'</option>');
						}
					}
				}
				});				
			}
			
	});
	//timetable add session modal
	$('#myModal').on('shown.bs.modal', function(e) {
		// fromTime = slot.attr('data-booked-upto');
		
		// $('#session_time_from').val(fromTime);

		// toTime = slot.attr('data-to');
	    
		var input = $('#session_time_from');
		input.clockpicker({
			autoclose: true
		});
		var input1 = $('#session_time_to');
		input1.clockpicker({
			autoclose: true
		});
		
		$('#day_c')
		    .find('option')
		    .remove();					
		var between = getBetweenDates();

		
		for(i=0;i<faculty.length;i++)
	    {
	       // $('#day_c').append('<option value=\"'+faculty[i]['id']+'\">'+between[i]+'</option>');
	    	$('#faculty_name').append('<option value=\"'+faculty[i]['id']+'\">'+faculty[i]['name']+'</option>');
	    }

	    for(i=0;i<between.length;i++)
	    {
	       // $('#day_c').append('<option value=\"Day '+i+'\">'+between[i]+'</option>');
	    }

		$('#session_time_to').val(toTime);
    });

    function getBetweenDates(){
	    var start = new Date('{$start}'),
	        end = new Date('{$end}'),
	        currentDate = start,
	        between = []
	    ;
	    
	    while (currentDate <= end) {
	        $('#day_c').append('<option value=\"'+currentDate.toString("dd-MM-yyyy")+'\">'+currentDate.toString("dddd dd-MM-yyyy")+'</option>');
	        // between.push(currentDate.toString("dd-MM-yyyy"));
	        currentDate = currentDate.addDays(1);
	    }
	    return between;
    }

</script>
{/literal} 