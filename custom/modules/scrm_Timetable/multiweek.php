<?php
/*Code by Ashvin
  Date:28-12-2018
  Reason: Change week number in Roman Fomat
*/
function integerToRoman($integer)
{
 // Convert the integer into an integer (just to make sure)
 $integer = intval($integer);
 $result = '';
 
 // Create a lookup array that contains all of the Roman numerals.
 $lookup = array('M' => 1000,
 'CM' => 900,
 'D' => 500,
 'CD' => 400,
 'C' => 100,
 'XC' => 90,
 'L' => 50,
 'XL' => 40,
 'X' => 10,
 'IX' => 9,
 'V' => 5,
 'IV' => 4,
 'I' => 1);
 
 foreach($lookup as $roman => $value){
  // Determine the number of matches
  $matches = intval($integer/$value);
 
  // Add the same number of characters to the string
  $result .= str_repeat($roman,$matches);
 
  // Set the integer to be the remainder of the integer and the value
  $integer = $integer % $value;
 }
 
 // The Roman numeral should be built, return it
 return $result;
}
/*End*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Multiple Week Timetable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        html {
            height: 100%;
            font-size: 100%;
        }

        body {
            background-color: #DBE4AF;
            font: 14px/20px Arial, Tahoma, Verdana, sans-serif;
            width: 100%;
            height: 100%;
            color: #000;
        }

        * {
            margin: 0;
            padding: 0;
            outline: none;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .masonry {
            width: 900px;
            margin: 0 auto;
        }

        .tabs {
            margin: 0;
            padding: 0;
            list-style: none;
            overflow: hidden;
            border-bottom: 1px solid #999;
        }

        .tabs li {
            float: left;
            border: 1px solid #999;
            border-bottom: none;
            background: #e0e0e0;
        }

        .tabs li a {
            display: block;
            padding: 10px 20px;
            font-size: 16px;
            color: #000;
            text-decoration: none;
        }

        .tabs li a:hover {
            background: #ccc;
        }

        .tabs li.active,
        .tabs li.active a:hover {
            font-weight: bold;
            background: #fff;
        }

        .tab_container {
            border: 1px solid #999;
            border-top: none;
            background: #fff;
        }

        .tab_content {
            padding: 20px;
            font-size: 16px;
        }

    </style>
    

    <script type="text/javascript">
        $(document).ready(function($) {
            $('.tab_content').hide();
            $('.tab_content:first').show();
            $('.tabs li:first').addClass('active');
            $('.tabs li').click(function(event) {
                $('.tabs li').removeClass('active');
                $(this).addClass('active');
                $('.tab_content').hide();

                var selectTab = $(this).find('a').attr("href");

                $(selectTab).fadeIn();
            });
        });
    </script>    
</head>
<body>
	<?php
		$id=$_REQUEST['record'];
		$projectBean=$_SESSION['project'];
	?>
	<div class="masonry">
	<div style="float:left;"><strong>Programmes: </strong><a href="<?php echo $sugar_config['site_url'] ?>index.php?module=Project&action=DetailView&record=<?php echo $projectBean->id;?>"><?php echo $projectBean->name; ?></a>
	</div>
	
	<div  style="float:right;"><a href="<?php echo $sugar_config['site_url'] ?>index.php?module=scrm_Timetable&amp;action=printDocument&id=<?php echo $id;?>" class="glyphicon glyphicon-print fa-2x" style="margin-right: 14px;"></a>
  <a href="<?php echo $sugar_config['site_url'] ?>index.php?module=scrm_Timetable&amp;action=printDocument2&id=<?php echo $id;?>" class="btn btn-sm" style="margin-right: 14px;">Long Format</a>
  </div>
	
	</div>
  
  <div class="masonry">
    <br />
    <br />
    <br />
    <ul class="tabs">
    <?php 
        $t = $_SESSION['tablehtml'];
        // ob_clean();
        // print_r($t);exit;
		$i=1;
        foreach ($t as $key => $value) {
            $value = str_replace('"', "'", $value);
			$weekno=integerToRoman($i);
        echo <<<EOD
        <li><a href="#tab{$key}">TIMETABLE: WEEK - {$weekno}</a></li>
EOD;
			$i++;
        }
    ?>	 
                




    </ul>
    <div class="tab_container">
    <?php 
        $t = $_SESSION['tablehtml'];
        // ob_clean();
        // print_r($t);exit;
        foreach ($t as $key => $value) {
            $value = str_replace('"', "'", $value);
            echo <<<EOD
            <div id="tab{$key}" class="tab_content">
                <table id='timetable_table' class='table table-bordered table-responsive'>
                <tr>
                    <td style='text-align: center;' width='200px'>
                        <span>Day</span>/<span>Date</span>
                    </td>
                    <td style='text-align: center;' width='200px'>
                        <strong>	09:00 - 10:30</strong>
                    </td>
                    <td style='text-align: center;' width='200px'>
                        <strong>	11:00 - 12:30</strong>
                    </td>
                    <td style='text-align: center;' width='200px'>
                        <strong>	14:00 - 15:30</strong>
                    </td>
                    <td style='text-align: center;' width='200px'>
                        <strong>	16:00 - 17:30</strong>
                    </td>
                    <td style='text-align: center;' width='200px'>
                        <strong>	18:00 - 19:30</strong>
                    </td>
                </tr>
                    $value
                </table>            
            </div>
EOD;

        }
    ?>	 
    </div>
  </div>

   
</body>
</html>