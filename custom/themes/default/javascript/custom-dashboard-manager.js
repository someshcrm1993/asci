		$(document).ready(function() {
		$('.copy-table').DataTable({
		//"paging":   false,
		"pageLength": 20,
		//    "info":     false,
		"bLengthChange": false,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "server_processing.php",
		"sPaginationType": "full_numbers",

		"oLanguage": {
		"sSearch": "Search all columns:",
		"oPaginate": {
		"sFirst": "<i class='fa fa-angle-double-left fa-2x ' aria-hidden='true'></i>",
		"sLast": "<i class='fa fa-angle-double-right fa-2x ' aria-hidden='true'></i>",
		"sNext": "<i class='fa fa-angle-right fa-2x ' aria-hidden='true'></i>",
		"sPrevious": "<i class='fa fa-angle-left fa-2x ' aria-hidden='true'></i>"
		}
		}
		});
		

		$("#user_link").click(function(){	
		$(".copy-users-table").dataTable().fnDestroy();	
		$('.copy-users-table').DataTable({
		//"paging":   false,
		"pageLength": 10,
		//    "info":     false,
		"bLengthChange": false,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "server_users_processing.php",
		"fnServerParams": function ( aoData ) {
		aoData.push( { "name": "user_selected", "value": $("#all_user_selected_click").val() },
					    { "name": "copy_from", "value": $("#copy_from").val()}
		
		 );
		},
		"sPaginationType": "full_numbers",
		"columnDefs": [ {
		"targets": 0,
		"orderable": false
		} ],

		"oLanguage": {
		"sSearch": "Search all columns:",
		"oPaginate": {
		"sFirst": "<i class='fa fa-angle-double-left fa-2x ' aria-hidden='true'></i>",
		"sLast": "<i class='fa fa-angle-double-right fa-2x ' aria-hidden='true'></i>",
		"sNext": "<i class='fa fa-angle-right fa-2x ' aria-hidden='true'></i>",
		"sPrevious": "<i class='fa fa-angle-left fa-2x ' aria-hidden='true'></i>"
		}
		}
		});
		})
		
		$("#select_all_user_link").click(function(){

			$("#all_user_selected_click").val("all_selected");
			$("#user_select_all").prop("checked", true);
			$("#user_select_all").attr("disabled", true);
			$(".user_checkbox").prop("checked", true);
			$(".user_checkbox").attr("disabled", true);


			})
			$("#deselect_all_user_link").click(function(){
			$("#all_user_selected_click").val("");
			$("#user_select_all").prop("checked",false);
			$("#user_select_all").removeAttr("disabled");
			$(".user_checkbox").prop("checked",false);
			$(".user_checkbox").removeAttr("disabled");
			})
			
			$("#select_all_user_role_link").click(function(){

			$("#all_user_role_selected_click").val("all_selected");
			$("#aclrole_select_all").prop("checked", true);
			$("#aclrole_select_all").attr("disabled", true);
			$(".aclrole_checkbox").prop("checked", true);
			$(".aclrole_checkbox").attr("disabled", true);
			})
			$("#deselect_all_user_role_link").click(function(){
			$("#all_user_role_selected_click").val("");
			$("#aclrole_select_all").prop("checked",false);
			$("#aclrole_select_all").removeAttr("disabled");
			$(".aclrole_checkbox").prop("checked",false);
			$(".aclrole_checkbox").removeAttr("disabled");
			})
			
			$("#select_all_user_team_link").click(function(){
			$("#all_user_team_selected_click").val("all_selected");
			$("#securitygroup_select_all").prop("checked", true);
			$("#securitygroup_select_all").attr("disabled", true);
			$(".securitygroup_checkbox").prop("checked", true);
			$(".securitygroup_checkbox").attr("disabled", true);
			})

			$("#deselect_all_user_team_link").click(function(){
			$("#all_user_team_selected_click").val("");
			$("#securitygroup_select_all").prop("checked",false);
			$("#securitygroup_select_all").removeAttr("disabled");
			$(".securitygroup_checkbox").prop("checked",false);
			$(".securitygroup_checkbox").removeAttr("disabled");
			})
			
			
		
	
	$("#users_list, #roles_list, #teams_list").hide();
	$("#close-button-dashboard_modal").click(function(){
			$("#users_list, #roles_list, #teams_list").hide();
		})

	$("#user_link").click(function(){


	$("#view_aclroleuserlist").hide();
	$("#view_securitygrouplist").hide();
		$("#users_list").show();
		$("#roles_list").hide();
		$("#teams_list").hide();
        $('#copy_form')[0].reset();
	
		})
	$("#role_link").click(function(){
		$("#view_securitygrouplist").hide();	
		$("#users_list").hide();
		$("#roles_list").show();
		$("#teams_list").hide();
	     $('#copy_form')[0].reset();
		})
	$("#team_link").click(function(){

		$("#view_aclroleuserlist").hide();
		$("#users_list").hide();
		$("#roles_list").hide();
		$("#teams_list").show();
        $('#copy_form')[0].reset();
		})	
		
	$("#posts_content").on("click",".view-dashboard-button",function(){
		var id=(this.id);
		$.ajax({
			url: "dashboard-manager-responce.php",
			type: "post",
			data: {call_function:"getusername",id:id,no:"15"},
			success: function(result){
				 var obj = jQuery.parseJSON(result);
			

			$("#view_name").html(obj.name);	
			$("#copy_from").val(obj.id);

    }});
		})		
	

	$("#user_select_all").change(function(){  //"select all" change
    var status = this.checked; // "select all" checked status
    $('.user_checkbox').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});

$('.user_checkbox').change(function(){ //".checkbox" change
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){ //if this item is unchecked
        $("#user_select_all")[0].checked = false; //change "select all" checked status to false
    }
   
    //check "select all" if all checkbox items are checked
    if ($('.user_checkbox:checked').length == $('.user_checkbox').length ){
        $("#user_select_all")[0].checked = true; //change "select all" checked status to true
    }
});

	
	
	$("#view_aclroleuserlist").on("change","#aclrole_select_all",function(){  //"select all" change
    var status = this.checked; // "select all" checked status
    $('.aclrole_checkbox').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});
$("#view_aclroleuserlist").on("change",".aclrole_checkbox",function(){ //".checkbox" change
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){ //if this item is unchecked
        $("#aclrole_select_all")[0].checked = false; //change "select all" checked status to false
    }
   
    //check "select all" if all checkbox items are checked
    if ($('.aclrole_checkbox:checked').length == $('.aclrole_checkbox').length ){
        $("#aclrole_select_all")[0].checked = true; //change "select all" checked status to true
    }
});
	
	
	$("#view_securitygrouplist").on("change","#securitygroup_select_all",function(){  //"select all" change
    var status = this.checked; // "select all" checked status
    $('.securitygroup_checkbox').each(function(){ //iterate all listed checkbox items
        this.checked = status; //change ".checkbox" checked status
    });
});
$("#view_securitygrouplist").on("change",".securitygroup_checkbox",function(){ //".checkbox" change
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(this.checked == false){ //if this item is unchecked
        $("#securitygroup_select_all")[0].checked = false; //change "select all" checked status to false
    }
   
    //check "select all" if all checkbox items are checked
    if ($('.securitygroup_checkbox:checked').length == $('.securitygroup_checkbox').length ){
        $("#securitygroup_select_all")[0].checked = true; //change "select all" checked status to true
    }
});
	
	
		
	
	$("#view_aclroleuserlist").hide();
	
		$("#acl_roles_list").change(function(){ 
	if ($("#acl_roles_list").val() != "") {
    $("#view_aclroleuserlist").show();
}
	
		$(".copy-roles-users-table").dataTable().fnDestroy();
		$('.copy-roles-users-table').DataTable({
		//"paging":   false,
		"pageLength": 10,
		//    "info":     false,
		"bLengthChange": false,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "server_roles_users_processing.php",
		"fnServerParams": function ( aoData ) {
		aoData.push( { "name": "role_id", "value": $("#acl_roles_list").val()},
		
		 { "name": "copy_from", "value": $("#copy_from").val()},
		  { "name": "role_user_selected", "value": $("#all_user_role_selected_click").val()}
	
		 );
		},
		"sPaginationType": "full_numbers",
		"columnDefs": [ {
		"targets": 0,
		"orderable": false
		} ],

		"oLanguage": {
		"sSearch": "Search all columns:",
		"oPaginate": {
		"sFirst": "<i class='fa fa-angle-double-left fa-2x ' aria-hidden='true'></i>",
		"sLast": "<i class='fa fa-angle-double-right fa-2x ' aria-hidden='true'></i>",
		"sNext": "<i class='fa fa-angle-right fa-2x ' aria-hidden='true'></i>",
		"sPrevious": "<i class='fa fa-angle-left fa-2x ' aria-hidden='true'></i>"
		}
		}
		});
		
		
		
			

/*
			var id=(this.value);
			$.ajax({
			url: "dashboard-manager-responce.php",
			type: "post",
			data: {call_function:"aclrole_userlist",id:id},
			success: function(result){
			//	alert(result);
			$("#view_aclroleuserlist").html(result);	

			}});
*/
			})	

				$("#view_securitygrouplist").hide();
				$("#securitygroup_list").change(function(){ 
				if ($("#securitygroup_list").val() != "") {
				$("#view_securitygrouplist").show();
				}
				$(".copy-teams-users-table").dataTable().fnDestroy();
				$('.copy-teams-users-table').DataTable({
				//"paging":   false,
				"pageLength": 10,
				//    "info":     false,
				"bLengthChange": false,
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "server_teams_users_processing.php",
				"fnServerParams": function ( aoData ) {
				aoData.push( { "name": "team_id", "value": $("#securitygroup_list").val()},

				{ "name": "copy_from", "value": $("#copy_from").val()},
				{ "name": "team_user_selected", "value": $("#all_user_team_selected_click").val()}
				);
				},
				"sPaginationType": "full_numbers",
				"columnDefs": [ {
				"targets": 0,
				"orderable": false
				} ],
				"oLanguage": {
				"sSearch": "Search all columns:",
				"oPaginate": {
				"sFirst": "<i class='fa fa-angle-double-left fa-2x ' aria-hidden='true'></i>",
				"sLast": "<i class='fa fa-angle-double-right fa-2x ' aria-hidden='true'></i>",
				"sNext": "<i class='fa fa-angle-right fa-2x ' aria-hidden='true'></i>",
				"sPrevious": "<i class='fa fa-angle-left fa-2x ' aria-hidden='true'></i>"
				}
				}
				});
				});
	
	
/*
			$("#securitygroup_list").change(function(){ 

			var id=(this.value);
			$.ajax({
			url: "dashboard-manager-responce.php",
			type: "post",
			data: {call_function:"securitygroup_userlist",id:id},
			success: function(result){
			//	alert(result);
			$("#view_securitygrouplist").html(result);	

			}});
			})	
*/
			

			
			

	})
	
	$( document ).ajaxStart(function() {
    $('.loading-overlay').show();
});
// Hide loading overlay when ajax request completes
$( document ).ajaxStop(function() {
    $('.loading-overlay').hide();
});
