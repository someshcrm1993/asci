/**
 * Created by lewis on 18/02/14.
 */



function retrievePage(page_id){
	$("div[id^=pageNum_]").html("<img id='imageLoading' style='padding-left:50px;' align='center' src='themes/default/images/loading.gif'/>");
     retrieveData(page_id);

}

function retrieveData(page_id){
	//~ $('#loadingmessage').show();
    $.ajax({

        url : "index.php?entryPoint=retrieve_dash_page",
        dataType: 'html',
        type: 'POST',
       
        data : {
            'page_id' : page_id
        },
        success : function(data) {
            var pageContent = data;

            outputPage(page_id,pageContent)
            //~ $('#pageContainer').html("");
            //~ $('#loadingmessage').hide();
        },
        error : function(request,error)
        {

        }
})
}

function outputPage(page_id,pageContent){

	
//~ $("#pageNum_"+ page_id +"_div").append("<img align='middle' src='themes/default/images/img_loading.gif' />");
    $("div[id^=pageNum_]").each(function(){
        $( this ).css( "display", "none" );
        $( this ).empty();

    });

    $( ".active").removeClass( "active" );
    $( "#pageNum_"+ page_id).addClass( "active" );

    $( ".current").removeClass( "current" );
    $( "#pageNum_"+ page_id +"_anchor").addClass( "current" );

    $( "#pageNum_"+ page_id +"_div").css("display", "block");
	//~ $("#pageNum_"+ page_id +"_div").html("<img id='imageLoading' style='padding-left:50px;' align='center' src='themes/default/images/loading.gif'/>");
    $( "#pageNum_"+ page_id +"_div" ).append(pageContent);
    //~ $("#pageContainer").removeClass("loading-image");
	$('#imageLoading').hide();
	//~ $("#pageNum_"+ page_id +"_div").prepend("<img src=''>");
//    $("#removeTab_anchor").attr("onclick","removeForm("+ page_id +")");


}



