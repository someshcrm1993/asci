<?php
if(!defined('sugarEntry')) define('sugarEntry', true);
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

  require_once('include/entryPoint.php');
  include_once('include/SugarPHPMailer.php');
  include_once('include/utils/db_utils.php');
  require_once('include/utils.php');
  include('custom/include/language/en_us.lang.php');
  global $db,$body,$body_main,$app_list_strings;
  global $sugar_config;

  header("Content-type: application/vnd.ms-word");
   
  header("Content-Disposition: attachment;Filename=MailingLabel.doc");    

  ob_clean();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Word Report</title>
<style>
<!--
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
    {
    font-size:12.0pt;
    font-family:"Times New Roman";}
@page Section1
    {size:595.3pt 841.9pt;
    margin: 28.8pt 42pt 19.6pt 20pt;}
div.Section1
    {page:Section1;}
  
  .temprow
  {
    border:0px;
    height:220px;
  }
-->
</style>
</head>
<body>
  <div class="Section1">
    <div class="MsoNormal">
   <table width="100%" cellpadding="0" cellspacing="0" >
       <tr>
      <td width="50%"></td>
      <td width="50%"></td>
    </tr>
      <?php
    
      $counter=0;
      $modules = array('prospects','contacts','leads','accounts');
      foreach($modules as $moduleKey=>$moduleValue){
      foreach ($data[$moduleValue] as $key => $value) {
        $counter=$counter+1;
        if($counter==1)
        {
          echo '<tr class="temprow">';
        }
        // print_r($value);exit();
    ?>
          <td align="left" style="font-family:Helvetica; border:0px solid #ff00000;" width="50%" valign="top">
            <table width="100%" cellpadding="0" cellspacing="0" style="">
              
               
               <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['name']; ?>
                 </td>
              </tr>
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['designation']; ?>
                 </td>
              </tr>
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['Orgname']; ?>
                 </td>
              </tr>
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['street']; ?>
                 </td>
              </tr>              
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['city']." - ".$value['postal_code'] ; ?>
                 </td>
              </tr>    
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['state']; ?>
                 </td>
              </tr>   
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['country']; ?>
                 </td>
              </tr>                            
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['mobile']; ?>
                 </td>
               </tr>
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['mobile1']; ?>
                 </td>
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['mobile2']; ?>
                 </td>
               </tr>
              <tr>
                 <td align="left" style="font-family:arial;">
                  <?php echo $value['mobile3']; ?>
                 </td>
               </tr>
            </table>
          </td>
    <?php
      if($counter==2)
      {
        $counter = 0;
        echo '</tr>';
      }
    ?>
    <?php } }?>
   </table>
   </div>
   </div>
</body>
</html>
<?php exit; ?>
