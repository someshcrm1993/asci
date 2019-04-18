<?php

require_once('include/MVC/View/views/view.edit.php');
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


class scrm_stationeryViewEdit extends ViewEdit
{
 	
 	function scrm_stationeryViewEdit(){
 		parent::ViewEdit();
 		$this->useForSubpanel = true;
 	}

    function display()
    {
         $adminArranges = BeanFactory::getBean('scrm_Admin_Arranges',$_REQUEST['scrm_admin_arranges_id']);
        $stationeryItems = $adminArranges->get_linked_beans('scrm_admin_arranges_scrm_stationery_1', 'scrm_stationery', array(), 0, -1, 0, "");
        foreach($stationeryItems as $key=>$value){
            $item[] = $value->items_c;
        }
        $item = json_encode($item);
        echo <<<JS

        <script>
        	$(document).ready(function(){
                var item = JSON.parse('$item');
                console.log(item);
                $.each(item,function(key,value){
                    $( "#items_c option[value='"+value+"']" ).remove();
                });
                $('#participants_c,#faculty_c,#others_c').on('change',function(){
                    var participants_c = $('#participants_c').val();
                    var faculty_c = $('#faculty_c').val();
                    var others_c = $('#others_c').val();
                    var total = +participants_c + +faculty_c + +others_c
                    $('#total_c').val(total);
                });
        		hideGS();
                sk();
        		$('#items_c').change(function(){
        			if($('#items_c').val() == 'GS'){
	        			showGS();
        			}else{
        				hideGS();
        			}	
                    sk();
        		});

                function sk(){
                    if($('#items_c').val() == 'SK'){
                        $('#description').show();
                    }else{
                       $('#description').hide(); 
                    }
                }

        		function showGS(){
	        			$('#participants_c').attr('disabled',true);
	        			$('#general_stationery_c').parent('td').show();	
	        			$('#general_stationery_c_label').show();
        		}

        		function hideGS(){
        			$('#general_stationery_c_label').hide();
	        		$('#general_stationery_c').parent('td').hide();	
	        		$('#participants_c').removeAttr('disabled');
        		}
        	});
        </script>
JS;
        
        //call parent display method
        parent::display();
    }
}


?>
