<?php


    $username    = urldecode($_REQUEST["username"]);
    $password    = urldecode($_REQUEST["password"]);
    $url         = urldecode($_REQUEST["url"]);
    $module_name = urldecode($_REQUEST["module_name"]);
    $api_url     = "$url/service/v4_1/rest.php";


            $json                = urldecode($_REQUEST["jsonParam"]);
            $jsonData            = json_decode($json);
            $jsonData_data       = $jsonData->data;
            $jsonData_data_count = count($jsonData_data);

            $resull        = array();
            $nameValueList = array();
	        $k=0;
            $jsonData_data_array = array();
            for($k;$k<$jsonData_data_count;$k++){
            $jsonData_data_array_each = $jsonData_data[$k];

            foreach ($jsonData_data_array_each as $key => $value) {
            $nameValueList[] = array("name" => $key, "value" => $value);
            }
		if(count($nameValueList)){
		   $resull[] = array_push($resull, $nameValueList);
		}
            $nameValueList = array();
            //unset($nameValueList);
            }

            $resull_count = count($resull);

            $p=0;
            $final_data_array = array();
            for($p;$p<$resull_count;$p++){
            $resull_each = $resull[$p];
            if (!is_numeric($resull_each)) {
                    $final_data_array [] = $resull_each;
	    }
            }

            $outputArr = array();
            $outputArr['Android'] = $final_data_array;
            //echo ( json_encode($outputArr));
            print_r( json_encode($outputArr));

	  


?>
