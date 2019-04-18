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

header("Content-type: application/javascript");
?>
$(document).ready(function(){
	alert(<?php echo $this->bean->no_of_days_c; ?>);
	alert('hi');
	$('#timetable_c').after('<div class="right"> <span data-target="#myModal" data-toggle="modal" class="glyphicon glyphicon-plus"></span> <table class="table table-bordered table-responsive"> <tr> <td class="blank"></td> <td class="title">09:00 - 10.30</td> <td class="title">11.00 - 12.30</td> <td class="title">14:00 - 15.30</td> <td class="title">16.00 - 17.30</td> </tr> <tr> <td class="time">Monday</td> <td class="drop" data-from="09:00" data-to="10:30" data-sessions="0" data-booked-upto="09:00"></td> <td class="drop" data-from="11:00" data-to="12:30" data-sessions="0" data-booked-upto="11:00"></td> <td class="drop" data-from="14:00" data-to="15:30" data-sessions="0" data-booked-upto="14:00"></td> <td class="drop" data-from="16:00" data-to="17:30" data-sessions="0" data-booked-upto="16:00"></td> </tr> <tr> <td class="time">Tuesday</td> <td class="drop" data-from="09:00" data-to="10:30" data-sessions="0" data-booked-upto="09:00"></td> <td class="drop" data-from="11:00" data-to="12:30" data-sessions="0" data-booked-upto="11:00" ></td> <td class="drop" data-from="14:00" data-to="15:30" data-sessions="0" data-booked-upto="14:00"></td> <td class="drop" data-from="16:00" data-to="17:30" data-sessions="0" data-booked-upto="16:00"></td> </tr> <tr> <td class="time">Wednesday</td> <td class="drop" data-from="09:00" data-to="10:30" data-sessions="0" data-booked-upto="09:00"></td> <td class="drop" data-from="11:00" data-to="12:30" data-sessions="0" data-booked-upto="11:00"></td> <td class="drop" data-from="14:00" data-to="15:30" data-sessions="0" data-booked-upto="14:00"></td> <td class="drop" data-from="16:00" data-to="17:30" data-sessions="0" data-booked-upto="16:00"></td> </tr> <tr> <td class="time">Thursday</td> <td class="drop" data-from="09:00" data-to="10:30" data-sessions="0" data-booked-upto="09:00"></td> <td class="drop" data-from="11:00" data-to="12:30" data-sessions="0" data-booked-upto="11:00"></td> <td class="drop" data-from="14:00" data-to="15:30" data-sessions="0" data-booked-upto="14:00"></td> <td class="drop" data-from="16:00" data-to="17:30" data-sessions="0" data-booked-upto="16:00"></td> </tr> <tr> <td class="time">Friday</td> <td class="drop" data-from="09:00" data-to="10:30" data-sessions="0" data-booked-upto="09:00"></td> <td class="drop" data-from="11:00" data-to="12:30" data-sessions="0" data-booked-upto="11:00"></td> <td class="drop" data-from="14:00" data-to="15:30" data-sessions="0" data-booked-upto="14:00"></td> <td class="drop" data-from="16:00" data-to="17:30" data-sessions="0" data-booked-upto="16:00"></td> </tr> </table> </div> <!-- create session modal starts here --> <div id="myModal" class="modal fade"> <form id="timetable" name="timetable"> <div class="modal-dialog"> <!-- Modal content--> <div class="modal-content"> <div class="modal-header"> <button class="close" type="button" data-dismiss="modal">&times;</button> <h4 class="modal-title">Add Session</h4> </div> <div class="modal-body"> <div class="form-group"><label for="faculty_name">Faculty Name:</label> <input name="faculty_name" id="faculty_name" class="form-control" type="text" /></div> <div class="form-group"><label for="session_name">Session Name:</label> <input name="session_name" id="session_name" class="form-control" type="text" /></div> <div class="form-group"><label for="session_time_from">Session Time From:</label> <input name="session_time_from" id="session_time_from" class="form-control" type="time" readonly /></div> <div class="form-group"><label for="session_time_to">Session Time To:</label> <input name="session_time_to" id="session_time_to" class="form-control" type="time"/></div><div class="form-group"><label for="session_time_to">Day:</label> <select name="day_c" id="day_c" title=""><option label="" value="" selected="selected"></option></select></div> </div> <div class="modal-footer"><a href="javascript:;" class="btn btn-default" id="timetableSubmit">Submit</a> <button class="btn btn-default" type="button" data-dismiss="modal">Close</button></div> </div> </div> </form> </div> <!-- create session modal ends here --> <!-- edit session modal starts here --> <div id="sessionModal" class="modal fade"> <form id="timetable" name="timetable"> <div class="modal-dialog"> <!-- Modal content--> <div class="modal-content"> <div class="modal-header"> <button class="close" type="button" data-dismiss="modal">&times;</button> <h4 class="modal-title">Edit Session</h4> </div> <div class="modal-body"> <div class="form-group"><label for="faculty_name_edit">Faculty Name:</label> <input name="faculty_name_edit" id="faculty_name_edit" class="form-control" type="text" /></div> <div class="form-group"><label for="session_name">Session Name:</label> <input name="session_name_edit" id="session_name_edit" class="form-control" type="text" /></div> <div class="form-group"><label for="session_time_from_edit">Session Time From:</label> <input name="session_time_from_edit" id="session_time_from_edit" class="form-control" type="time" readonly /></div> <div class="form-group"><label for="session_time_to_edit">Session Time To:</label> <input name="session_time_to_edit" id="session_time_to_edit" class="form-control" type="time"/></div> </div> <div class="modal-footer"> <a href="javascript:;" class="btn btn-default pull-left timetableDelete" id="timetableDelete">Delete</a> <a href="javascript:;" class="btn btn-default" id="edittimetableSubmit">Submit</a> <button class="btn btn-default" type="button" data-dismiss="modal">Close</button> </div> </div> </div> </form> </div> <input type="hidden" name="timetableData" id="timetableData">');

	
	var slot;
	
	$('.drop').click(function(e) {
	   e.preventDefault();
	   slot = $(e.target);
	   if (!slot.is('td')) {slot = slot.parent('td');}
	});

	var fromTime;
	var uptoTime;
	var deleteThat ='';
	var deleteSessionFromTime = '';
	var toTime;
	var editSessionDiv;
	var regExp = /(\d{1,2})\:(\d{1,2})/;
	var timetableData = [];
	$('#myModal').on('shown.bs.modal', function(e) {
		fromTime = slot.attr('data-booked-upto');
		
		$('#session_time_from').val(fromTime);

		toTime = slot.attr('data-to');
	    for(i=1;i<=days;i++)
	    {
	       
	       $('#day_c').append('<option value=\"Day '+i+'\">Day '+i+'</option>');
	    }

		$('#session_time_to').val(toTime);
    });

	//create new session functionality
	$('#timetableSubmit').click(function(){
			var fn = $('#faculty_name').val();
			var sn = $('#session_name').val();
			var to = $('#session_time_to').val();
				
			var total = parseInt(to .replace(regExp, "$1$2")) - parseInt(fromTime .replace(regExp, "$1$2"));
			var error = false;
			//total = total/100;

			if (fn == '') {
				$('#faculty_name').after('<span class="error">Please enter faculty name<span>');
				error = true;
			}

			if (sn == '') {
				$('#session_name').after('<span class="error">Please enter session name</span>');
				error = true;
			}

			if (!error) {	

				if(parseInt(to .replace(regExp, "$1$2")) < parseInt(toTime .replace(regExp, "$1$2"))){
						slot.append('<div class="session-data" >'+sn+'<br><b> - '+fn+'</b>'+'<span class="glyphicon glyphicon-remove timetableDelete pull-right" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+fromTime+'" data-to="'+to+'"></span><span data-target="#sessionModal" data-toggle="modal" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+fromTime+'" data-to="'+to+'" class="glyphicon glyphicon-edit pull-right"></span></div>');
				}else if(parseInt(to .replace(regExp, "$1$2")) > parseInt(toTime .replace(regExp, "$1$2"))){
						//if the session is taking to time more than existing td then 
						//merge the next td also.
						var nextSlotTo = slot.next().attr('data-to');
						slot.next().remove();
						slot.attr('colspan','2');
						slot.attr('data-to',nextSlotTo);
						slot.append('<div class="session-data" >'+sn+'<br><b> - '+fn+'</b>'+'<span class="glyphicon glyphicon-remove timetableDelete pull-right" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+fromTime+'" data-to="'+to+'"></span><span data-target="#sessionModal" data-toggle="modal" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+fromTime+'" data-to="'+to+'" class="glyphicon glyphicon-edit pull-right"></span></div>');
				}else{
						slot.append('<div class="session-data" >'+sn+'<br><b> - '+fn+'</b><span class="glyphicon glyphicon-remove timetableDelete pull-right" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+fromTime+'" data-to="'+to+'"></span><span data-target="#sessionModal" data-toggle="modal" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+fromTime+'" data-to="'+to+'" class="glyphicon glyphicon-edit pull-right"></span></div>');	
				}

				slot.children().last().prepend('<div class="session-mix-time">'+fromTime+' - '+to+'</div>');
				
				slot.attr('data-sessions',parseInt(slot.attr('data-sessions'))+1);
				
				slot.attr('data-booked-upto',to);
						
				addClassTodivSession(slot);

				$('#faculty_name').val('');
				$('#session_name').val('');
				$('#myModal').modal('hide');
				var l = timetableData.length;
				timetableData.push({'faculty_name':fn,'session_name':sn,'from':fromTime,'to':to});
			
				slot.children().last().children('span').attr('data-key',timetableData.length-1);
				
				appendJsonToInput(timetableData);
			}

	 });
	 
	//update session functionality
	$('#edittimetableSubmit').click(function(){

			var fn = $('#faculty_name_edit').val();
			var sn = $('#session_name_edit').val();
			var to = $('#session_time_to_edit').val();
			var from = $('#session_time_from_edit').val();
			var total = parseInt(to .replace(regExp, "$1$2")) - parseInt(fromTime .replace(regExp, "$1$2"));
			var error = false;

			if (fn == '') {
				$('#faculty_name_edit').after('<span class="error">Please enter faculty name<span>');
				error = true;
			}

			if (sn == '') {
				$('#session_name_edit').after('<span class="error">Please enter session name</span>');
				error = true;
			}

			if (!error) {	

				var timeDiv = '<div class="session-mix-time">'+from+' - '+to+'</div>';
				if(parseInt(to .replace(regExp, "$1$2")) < parseInt(toTime .replace(regExp, "$1$2"))){
						editSessionDiv.replaceWith('<div class="session-data" >'+timeDiv+sn+'<br><b> - '+fn+'</b>'+'<span class="glyphicon glyphicon-remove timetableDelete pull-right" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+from+'" data-to="'+to+'"></span><span data-target="#sessionModal" data-toggle="modal" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+from+'" data-to="'+to+'" class="glyphicon glyphicon-edit pull-right"></span></div>');
				}else if(parseInt(to .replace(regExp, "$1$2")) > parseInt(toTime .replace(regExp, "$1$2"))){
						//if the session is taking to time more than existing td then 
						//merge the next td also.
						var nextSlotTo = slot.next().attr('data-to');
						slot.next().remove();
						slot.attr('colspan','2');
						slot.attr('data-to',nextSlotTo);
						editSessionDiv.replaceWith('<div class="session-data" >'+timeDiv+sn+'<br><b> - '+fn+'</b>'+'<span class="glyphicon glyphicon-remove timetableDelete pull-right" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+from+'" data-to="'+to+'"></span><span data-target="#sessionModal" data-toggle="modal" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+from+'" data-to="'+to+'" class="glyphicon glyphicon-edit pull-right"></span></div>');
				}else{
						editSessionDiv.replaceWith('<div class="session-data" >'+timeDiv+sn+'<br><b> - '+fn+'</b><span class="glyphicon glyphicon-remove timetableDelete pull-right" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+from+'" data-to="'+to+'"></span><span data-target="#sessionModal" data-toggle="modal" data-session="'+sn+'" data-faculty="'+fn+'" data-from="'+from+'" data-to="'+to+'" class="glyphicon glyphicon-edit pull-right"></span></div>');
				}

				if (parseInt(slot.attr('data-booked-upto').replace(regExp, "$1$2")) < parseInt(to.replace(regExp, "$1$2"))) {
					slot.attr('data-booked-upto',to);
				}

				addClassTodivSession(slot);				

				$('#faculty_name_edit').val('');
				$('#session_name_edit').val('');
				$('#sessionModal').modal('hide');
				var l = timetableData.length;
				var key = editSessionDiv.find('.glyphicon-edit').attr('data-key');
				timetableData[timetableData.length-1].faculty_name=fn;
				timetableData[timetableData.length-1].session_name=sn;
				timetableData[timetableData.length-1].from=from;
				timetableData[timetableData.length-1].to=to;
				
				appendJsonToInput(timetableData);
			}
	 });
	 //code for editing a session
	 $('#sessionModal').on('shown.bs.modal', function(e) {
		 var div = $(e.relatedTarget) // Button that triggered the modal
		 deleteThat = div;
		 var faculty= div.attr('data-faculty'); // Extract info from data-* attributes
		 var session= div.attr('data-session'); // Extract info from data-* attributes
		 var from= div.attr('data-from'); // Extract info from data-* attributes
	     var to= div.attr('data-to'); // Extract info from data-* attributes
	     deleteSessionFromTime = from;
	     slot = div.parent().parent('td');
	     var modal = $(this);

	     modal.find('#faculty_name_edit').val(faculty);
	     modal.find('#session_name_edit').val(session);
	     modal.find('#session_time_from_edit').val(from);

	     if (parseInt(to.replace(regExp, "$1$2")) > parseInt(slot.attr('data-booked-upto').replace(regExp, "$1$2"))) {
	     	modal.find('#session_time_to_edit').val(to);
	     }else{
	     	modal.find('#session_time_to_edit').val(to);
	     	modal.find('#session_time_to_edit').attr('max',to);
	     	modal.find('#session_time_to_edit').attr('min',from);
	     }
	     
	     editSessionDiv = div.parent('div');
	 });

 	 //when user clicks on delete session button
 	 $(document).on('click', '.timetableDelete',function(e){
 	 	if (deleteThat == '') {deleteThat = $(e.target);}
 	 	
 	 	if (deleteSessionFromTime == '') {deleteSessionFromTime = deleteThat.attr('data-from');}
 	 	
	 	deleteSession(deleteThat,deleteSessionFromTime);
	 	deleteThat = '';
	 	deleteSessionFromTime = '';
	 });

	//delete session functionality
	function deleteSession(that,from) {
		
		if (confirm('Are you sure you want to delete this session from timetable?')) {

			var thisSlot = that.closest('td'); 
			if (thisSlot.is('td')) {thisSlot = that.parent().parent('td');}
    		
    		//remove the div
    		that.parent('div').remove();
    		//update count of number of sessions
    		thisSlot.attr('data-sessions',parseInt(thisSlot.attr('data-sessions'))-1);
    		//update the booked upto time
    		thisSlot.attr('data-booked-upto',from);
			thisSlot.children('.session-data').removeClass('w50');
			thisSlot.children('.session-data').removeClass('w33');
			
			if (parseInt(thisSlot.attr('data-sessions'))>1 && parseInt(thisSlot.attr('data-sessions'))<3) {
				thisSlot.children('.session-data').addClass('w50');
				$('.session-mix-time').show();	
			}else if(parseInt(thisSlot.attr('data-sessions'))>2 && parseInt(thisSlot.attr('data-sessions'))<4){
				thisSlot.children('.session-data').addClass('w33');
				
			}else if(parseInt(thisSlot.attr('data-sessions')) == 1){
				thisSlot.children('.session-data').addClass('w100');
			}

			$('#sessionModal').modal('hide');
		} else {
		    // Do nothing!
		}
	}

	//add json object to the html input
	function appendJsonToInput(timetableData) {
		$('#timetableData').val(JSON.stringify(timetableData));
	}

	//add class to adjust session slots in td
	function addClassTodivSession(tdSlot) {
		if (parseInt(tdSlot.attr('data-sessions'))>1 && parseInt(tdSlot.attr('data-sessions'))<3) {
			tdSlot.children('.session-data').addClass('w50');
		}else if(parseInt(tdSlot.attr('data-sessions'))>2 && parseInt(tdSlot.attr('data-sessions'))<4){
			tdSlot.children('.session-data').addClass('w33');
		}else if(parseInt(tdSlot.attr('data-sessions'))>3 && parseInt(tdSlot.attr('data-sessions'))<5){
			tdSlot.children('.session-data').addClass('w25');
		}
	}

});

