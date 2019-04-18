<?php

require_once('include/MVC/View/views/view.detail.php');

class ContactsViewEdit extends ViewEdit
{
    function display()
    {
        echo <<<EOD
        	<script>
        		$(document).ready(function(){
	        		alert('hi');
        		});
        	</script>
EOD;
        parent::display();
    }
}