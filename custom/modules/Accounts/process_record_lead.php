<?php

if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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


  class process_record
    {
        function process_record_method($bean, $event, $arguments)
        {

				global $db,$sugar_config, $current_user;
				$id = $bean->id;
				$cb="test";

				$userid= $current_user->id;
				// echo "<pre>";
				// 		print_r($bean);
				// echo "</pre>";

				$module=$_REQUEST['module'];

				//exit;

				$link="index.php?module=$module&offset=1&return_module=$module&action=EditView&record=$id";
				$Code=<<<EOD
			

				<div class='dropdown'> 
						<a data-toggle='dropdown' class='toggle' title='Action' ><i class='fa fa-gear' style='cursor:pointer;'></i></a>
						
					 		<ul class="dropdown-menu dropdown-menu-left">

								<li><a id="edit$id" href="$link"><i class='fa fa-edit'></i>&nbsp;Edit</a></li>

								<li><a id="del$id" style='cursor:pointer;' onclick="delete_record('$id', '$module' ,'delete');"><i class='fa fa-trash'></i>&nbsp;Delete</a></li>

								<li><a style='cursor:pointer;' data-toggle="modal" data-target="#myModal-$id"><i class='fa fa-phone'></i>&nbsp;Log Call</a></li>

								<li><a id="meeting$id" style='cursor:pointer;' data-toggle="modal" data-target="#myModalmeeting-$id"><i class='fa fa-users'></i>Schedule Meeting</a></li>

								<li><a id="todo$id" style='cursor:pointer;' data-toggle="modal" data-target="#myModaladdTodo-$id"><i class='fa fa-tasks'></i>Add To Do</a></li>
					 		</ul>
				</div>



				
				<div id="myModal-$id" class="modal fade" role="dialog">
  						<div class="modal-dialog modal-lg">
    						<!-- Modal content-->
    							<div class="modal-content">
      								<div class="modal-header">
        								<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>

        									<h4 class="modal-title">Log Call</h4>
      								</div>
      							
      							<div class="modal-body" name="calls$id"  id="calls$id">

      									<input type="hidden" name="reminder" value="30" id="reminder$id">
       									<input type="hidden" name="parent_id" value="$id" id="parent_id$id">
       									<input type="hidden" name="assigned_user_id" id="assigned_user_id" value="$userid">
       									<input type="hidden" name="parent_type" value="$module" id="parent_type$id">
       									<input type="hidden" name="action_popup" value="log_call" id="log_call$id">


       								<div class="form-group">
                					<div class="row">
                    					<div class="col-md-6">
                        					<label>Subject:<span class="required">*</span></label>
                        					<input type="text" class="form-control" name="subject" id="subject$id" placeholder="Subject" required="required">
                    					</div>


                    					 <div class="col-md-6">
					                       <label>Status:<span class="required">*</span></label>
					                        <div class="row">
					                        <div class="col-md-6">
					                            <select name="direction" id="direction$id" title="" class="form-control">
					                                <option label="Inbound" value="Inbound">Inbound</option>
					                                <option label="Outbound" value="Outbound">Outbound</option>
					                            </select>
					                            </div>
					                            <div class="col-md-6"> 
					                            <select name="status" id="status$id" title="" class="form-control" >
					                                <option label="Planned" value="Planned" selected="selected">Planned</option>
					                                <option label="Held" value="Held">Held</option>
					                                <option label="Not Held" value="Not Held">Not Held</option>
					                                <option label="Missed" value="Missed">Missed</option>
					                                <option label="In Limbo" value="In Limbo">In Limbo</option>
					                            </select>
					                            </div>
					                            </div>
		                    					</div>
		                					</div>
		            					</div><!-- End form group -->

		            					<div class="form-group">
						                 <div class="row">
						                    <div class="col-md-6">
						                        <label>Start Date & Time:<span class="required">*</span></label>
						                        <div class="row">
						                            <div class="col-md-6">
						                               <input type="text" name="date" id="date$id" class="form-control" placeholder="DD-MM-YYYY">
						                            </div>
						                            <div class="col-md-6">
						                                <select class="datetimecombo_time" size="1" id="date_start_hours$id" name="date_start_hours" class="form-control"><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12" selected="">12</option>
					                                </select>&nbsp;:
						                                &nbsp;<select class="datetimecombo_time" size="1" id="date_start_minutes$id" name="date_start_minutes" class="form-control">
					                                <option value="00" selected="">00</option>
					                                <option value="15">15</option>
					                                <option value="30">30</option>
					                                <option value="45">45</option>
					                                </select>
						                                &nbsp;
						                                <select class="datetimecombo_time" size="1" id="date_start_meridiem$id" name="date_start_meridiem" class="form-control">
					                                <option value="am">am</option>
					                                <option value="pm" selected="">pm</option>
					                                </select>
						                            </div>
						                        </div>
						                    </div>


						                     <div class="col-md-6 duration">
						                        <label>Duration:<span class="required">*</span></label>
						                        <div class="row">
						                            <div class="col-md-6">
						                                 <input type="number" name="hours" id="hours$id"  min="0" class="form-control" value="0">
						                            </div>
						                            <div class="col-md-6">
						                           <select name="minutes" id="minutes$id" class="form-control" >
					                                <option value="0">00</option>
					                                <option value="15">15</option>
					                                <option value="30">30</option>
					                                <option value="45">45</option></select>
						                            </div>
						                        </div>
						                    </div>
						                 </div>
						            </div><!-- End of form group -->

						            <div class="form-group">
					                 <div class="row">
					                     <div class="col-md-12">
					                        <label>Description:<span class="required">*</span></label>
					                        <textarea class="form-control" placeholder="Description" name="description" id="description$id" rows="6"></textarea>
					                    </div>
					                </div>
            						</div><!-- End description -->


            						<div class="modal-footer">
        								<button type="button" class="btn btn-default" onclick="log_call('$id','$module','log_call')">Save</button>&nbsp;&nbsp;
        								<button type="button" class="btn btn-default close1" data-dismiss="modal">Cancel</button>
      								</div><!-- End footer -->

      							</div>
      						</div>
      				</div>
      			</div>


				<div id="myModalmeeting-$id" class="modal fade" role="dialog">
			              <div class="modal-dialog modal-lg">
			                <!-- Modal content-->
			                  <div class="modal-content">
			                      <div class="modal-header">
			                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
			                              <h4 class="modal-title">Schedule Meeting</h4>
			                      </div>
			                      <div class="modal-body" name="meetingbody$id"  id="meetingbody$id">

			                        <input type="hidden" name="parent_id" value="$id" id="parent_id$id">
			                        <input type="hidden" name="assigned_user_id" id="assigned_user_id" value="$userid">
			                        <input type="hidden" name="parent_type" value="$module" id="parent_type$id">
			                        <input type="hidden" name="action_popup" value="meeting" id="meeting_action$id">


			                                <div class="form-group">
			                                    <div class="row">
			                                        <div class="col-md-6">
			                                            <label>Subject:<span class="required">*</span></label>
			                                            <input type="text" class="form-control" name="subject" id="subject$id" placeholder="Subject" required="required">
			                                        </div>

			                                            <div class="col-md-6">
			                                                <label>Start date and time:<span class="required">*</span></label>
			                                                  <div class="row">
			                                                      <div class="col-md-6">
			                                                           <input type="text" name="date1" id="date1$id" class="form-control" placeholder="DD-MM-YYYY">
			                                                      </div>
			                                                      <div class="col-md-6"> 
			                                                          <select class="datetimecombo_time" size="1" id="date_start_hours$id" name="date_start_hours" class="form-control"><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12" selected="">12</option>
			                                                      </select>&nbsp;:
			                                                      &nbsp;<select class="datetimecombo_time" size="1" id="date_start_minutes$id" name="date_start_minutes" class="form-control">
			                                                      <option value="00" selected="">00</option>
			                                                      <option value="15">15</option>
			                                                      <option value="30">30</option>
			                                                      <option value="45">45</option>
			                                                      </select>
			                                                      &nbsp;
			                                                      <select class="datetimecombo_time" size="1" id="date_start_meridiem$id" name="date_start_meridiem" class="form-control">
			                                                      <option value="am">am</option>
			                                                      <option value="pm" selected="">pm</option>
			                                                      </select>
			                                                      </div>
			                                                  </div>
			                                            </div>
			                                        </div>
			                                    </div>

			                                     <div class="form-group">
			                                       <div class="row">
			                                          <div class="col-md-6">
			                                              <label>Status<span class="required">*</span></label>
			                                              <select name="status" id="status$id" title="" class="form-control" >
			                                                  <option label="Planned" value="Planned" selected="selected">Planned</option>
			                                                  <option label="Held" value="Held">Held</option>
			                                                  <option label="Not Held" value="Not Held">Not Held</option>
			                                                  <option label="Missed" value="Missed">Missed</option>
			                                                  <option label="In Limbo" value="In Limbo">In Limbo</option>
			                                            </select>
			                                          </div>

			                                          <div class="col-md-6">
			                                              <label>Location<span class="required">*</span></label>
			                                               <input type="text" name="location" id="location$id" class="form-control" placeholder="Where is scheduled?">
			                                          </div>
			                                        </div>
			                                    </div>

			                                     <div class="form-group">
			                                       <div class="row">
			                                          <div class="col-md-12">
			                                            <label>Description:<span class="required">*</span></label>
			                                  				<textarea class="form-control" placeholder="Description" name="description" id="description$id" rows="6"></textarea>
			                                          </div>
			                                        </div>
			                                  </div>      
			                    </div>

			                    		<div class="modal-footer">
			        								<button type="button" class="btn btn-default" onclick="schedule_meeting('$id','$module','meeting')">Save</button>&nbsp;&nbsp;
			        								<button type="button" class="btn btn-default close1" data-dismiss="modal">Cancel</button>
			      								</div>
			              </div> 
			              </div>
			          </div>
			         
			           <div id="myModaladdTodo-$id" class="modal fade" role="dialog">
			              <div class="modal-dialog modal-lg">
			                <!-- Modal content-->
			                  <div class="modal-content">
			                      <div class="modal-header">
			                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
			                              <h4 class="modal-title">Add To Do</h4>
			                      </div>
			                      <div class="modal-body" name="meetingbody$id"  id="meetingbody$id">

			                        <input type="hidden" name="parent_id" value="$id" id="parent_id$id">
			                        <input type="hidden" name="assigned_user_id" id="assigned_user_id" value="$userid">
			                        <input type="hidden" name="parent_type" value="$module" id="parent_type$id">
			                        <input type="hidden" name="action_popup" value="add_to_do" id="addtoDo_action$id">

			                        <div class="form-group">
			                                    <div class="row">
			                                        <div class="col-md-6">
			                                            <label>Subject:<span class="required">*</span></label>
			                                            <input type="text" class="form-control" name="subject" id="subject$id" placeholder="Subject" required="required">
			                                        </div>

			                                            <div class="col-md-6">
			                                                <label>Start date and time:<span class="required">*</span></label>
			                                                  <div class="row">
			                                                      <div class="col-md-6">
			                                                           <input type="text" name="date2" id="date2$id" class="form-control" placeholder="DD-MM-YYYY">
			                                                      </div>
			                                                      <div class="col-md-6"> 
			                                                          <select class="datetimecombo_time" size="1" id="date_start_hours$id" name="date_start_hours" class="form-control"><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12" selected="">12</option>
			                                                      </select>&nbsp;:
			                                                      &nbsp;<select class="datetimecombo_time" size="1" id="date_start_minutes$id" name="date_start_minutes" class="form-control">
			                                                      <option value="00" selected="">00</option>
			                                                      <option value="15">15</option>
			                                                      <option value="30">30</option>
			                                                      <option value="45">45</option>
			                                                      </select>
			                                                      &nbsp;
			                                                      <select class="datetimecombo_time" size="1" id="date_start_meridiem$id" name="date_start_meridiem" class="form-control">
			                                                      <option value="am">am</option>
			                                                      <option value="pm" selected="">pm</option>
			                                                      </select>
			                                                      </div>
			                                                  </div>
			                                            </div>
			                                        </div>
			                                    </div><!-- form group end -->

			                                     <div class="form-group">
			                                       <div class="row">
			                                          <div class="col-md-6">
			                                              <label>Status<span class="required">*</span></label>
			                                              <select name="status2" id="status2$id" title="" class="form-control">
								                                <option label="Not Started" value="Not Started" selected="selected">Not Started</option>
								                                <option label="In Progress" value="In Progress">In Progress</option>
								                                <option label="Completed" value="Completed">Completed</option>
								                                <option label="Pending Input" value="Pending Input">Pending Input</option>
								                                <option label="Deferred" value="Deferred">Deferred</option>
                                							</select>
			                                          </div>

			                                          <div class="col-md-6">
			                                              <label>Priority<span class="required">*</span></label>
			                                                  <select name="priority" id="priority" title="" class="form-control">
									                            <option label="High" value="High">High</option>
									                            <option label="Medium" value="Medium">Medium</option>
									                            <option label="Low" value="Low">Low</option>
                            								</select>
			                                          </div>
			                                        </div>
			                                    </div> <!-- form group end -->
			                                    
			                                     <div class="form-group">
									                 <div class="row">
									                     <div class="col-md-12">
									                        <label>Description:<span class="required">*</span></label>
									                        <textarea class="form-control" placeholder="Description" name="description" id="description$id" rows="6"></textarea>
									                    </div>
									                </div>
            								</div><!-- form group end -->

			                     </div><!--  modal-body end-->

			                     <div class="modal-footer">
			        					<button type="button" class="btn btn-default" onclick="add_to_do('$id','$module','meeting')">Save</button>&nbsp;&nbsp;
			        					<button type="button" class="btn btn-default close1" data-dismiss="modal">Cancel</button>					
			      				</div>
			                </div> <!-- Modal content end-->
			             </div><!-- modal-dialog end -->
					</div><!-- myModaladdTodo-$id end -->



				<script  type="text/javascript">

				// $('.dropdown-menu').on("click.bs.dropdown", function (e) {
    // 						e.stopPropagation();
    // 						//e.preventDefault();                
				// });
					

				//Delete function start
				function delete_record(id, module, action){

						//alert(action);
						if(confirm("Are you sure, you want to delete this record?")){
								$.ajax({
									  url:'custom_actions.php',
										data:{id:id,module:module,action:action},  
									       	type:'post',
									        	
									        	success:function(data){ 

									        		//console.log(data);
									        		//alert(data);
									        		if(data=="_success"){

									        			alert("1 Record has been deleted successfully !");
									        			location.reload(true);
									        			 
									        		}else{

									        			alert("There is some problem, please contact administrator");
									        			location.reload(true);
									        		}
									        }
									    });  
							
						}
				}//Delete function End
				
				$('input[name=date]').datepicker({ dateFormat:'dd-mm-yy'});
				$('input[name=date1]').datepicker({ dateFormat:'dd-mm-yy'});
				$('input[name=date2]').datepicker({ dateFormat:'dd-mm-yy'});
				//Function schedule meeting start

				function schedule_meeting(id, module, action){


						var form1 = $("#myModalmeeting-"+id+" input,#myModalmeeting-"+id+" select,#myModalmeeting-"+id+" textarea");
						//var form1=$("#myModalmeeting"+id);
						//alert(id);

						$.ajax({
					 			url:'custom_actions.php',
										data:form1.serialize(),  
									       	type:'post',
									        	
									        	success:function(data){ 

									        		//console.log(data);
									        		//alert(data);
									        		$('#myModalmeeting-'+id).modal('toggle');

									        		if(data=="_success"){

									        			alert("Meeting has been added successfully !");
									        			location.reload(true);
									        			 
									        		}else{

									        			alert("There is some problem, please contact administrator");
									        			location.reload(true);
									        		}
									        }
									    });  				 



				}

				//Function schedule meeting end


				function log_call(id, module, action){

					if($('#subject'+id).val().length && $('#description'+id).val().length && $('#date'+id).val().length && $('#hours'+id).val().length && $('#minutes'+id).val().length){
						
						
						var remind=$('#reminder'+id).val();
						var parent_id=$('#parent_id'+id).val();
						var subject=$('#subject'+id).val();
						var date=$('#date'+id).val();

						var hours=$('#hours'+id).val();
						var minutes=$('#minutes'+id).val();
						var direction=$('#direction'+id).val();
						var status=$('#status'+id).val();

						var date_start_hours=$('#date_start_hours'+id).val();
						var date_start_minutes=$('#date_start_minutes'+id).val();

						var date_start_meridiem=$('#date_start_meridiem'+id).val();
						
						var form = $("#myModal-"+id+" input,#myModal-"+id+" select,#myModal-"+id+" textarea");
						
						//var form=$("#calls"+id);
						//alert(form);
							$.ajax({
									  url:'custom_actions.php',
										data:form.serialize(),  
									       	type:'post',
									        	
									        	success:function(data){ 

									        		//console.log(data);
									        		//alert(data);
									        		$('#myModal-'+id).modal('toggle');
									        		if(data=="_success"){

									        			alert("1 Call has been added successfully !");
									        			location.reload(true);
									        			 
									        		}else{

									        			alert("There is some problem, please contact administrator");
									        			location.reload(true);
									        		}
									        }
									    });  



					}else{


							alert("All fields are mandatory !")

					}
				}


				function add_to_do(id, module, action){


						//alert(id);

						var form2 = $("#myModaladdTodo-"+id+" input,#myModaladdTodo-"+id+" select,#myModaladdTodo-"+id+" textarea");
						//var form2=$("#myModaladdTodo"+id);
						//alert(id);

						$.ajax({
					 			url:'custom_actions.php',
										data:form2.serialize(),  
									       	type:'post',
									        	
									        	success:function(data){ 

									        		//console.log(data);
									        		//alert(data);
									        		$('#myModalmeeting-'+id).modal('toggle');

									        		if(data=="_success"){

									        			alert("Task has been added successfully !");
									        			location.reload(true);
									        			 
									        		}else{

									        			alert("There is some problem, please contact administrator");
									        			location.reload(true);
									        		}
									        }
									    }); 


				}
				</script>
EOD;



				 $bean->action_c=$Code;


		}
	}
?>
