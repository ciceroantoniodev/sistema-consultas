<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);

$vLocalizacao = isset($_GET["local"]) ? $_GET["local"] : NULL;
?>
<html>
<head>
	<title>.....:: MEU BAIRRO TEM - Área Restrita ::.....</title>
    <style type="text/css">
    <!--
	a:link    {color: #ff0000; text-decoration: none}
    a:visited {color: #ff0000; text-decoration: none}
    a:hover   {color: #bbad00; text-decoration: underline}
    -->
    </style>
	
</head>
  
<body>
	<?php
	$vLocal = strtolower($vLocalizacao);
	
	// get latitude, longitude and formatted address
    $data_arr = geocode($vLocal);
 
    // if able to geocode the address
    if($data_arr){
        $latitude = $data_arr[0];
        $longitude = $data_arr[1];
        $formatted_address = $data_arr[2];
		
		echo '<script type="text/javascript">';
		echo 'parent.document.getElementById("frmLongitude").value = "' . $longitude . '";';
		echo 'parent.document.getElementById("frmLatitude").value = "' . $latitude . '";';
		
		if ($latitude != "") {
			echo 'parent.document.getElementById("longitude").innerHTML = "' . $longitude . '";';
			echo 'parent.document.getElementById("latitude").innerHTML = "' . $latitude . '";';
			
		} else {
			echo 'parent.document.getElementById("longitude").innerHTML = "0";';
			echo 'parent.document.getElementById("latitude").innerHTML = "0";';
			
		}
		
		echo '</script>';

    // if unable to geocode the address
    }else{
		echo '<script type="text/javascript">';
		echo 'parent.document.getElementById("longitude").innerHTML = "0";';
		echo 'parent.document.getElementById("latitude").innerHTML = "0";';
		echo '</script>';
    }

	// function to geocode address, it will return false if unable to geocode address
	function geocode($address){

		// url encode the address
		$address = urlencode($address);
		$address = str_replace(Array("%E1","%E3","%E0","%E4","%E2","%C1","%C2","%C0","%C4","%C2","%E9","%E8","%EB","%EA","%C9","%C8","%CB","%CA","%ED","%EC","%EF","%EE","%CD","%CC","%CF","%CE","%F3","%F2","%F6","%F4","%F5","%D3","%D2","%D6","%D4","%D5","%FA","%F9","%FC","%FB","%DA","%D9","%DC","%DB","%E7","%C7"), Array("á"  ,"ã"  ,"à"  ,"ä"  ,"â"  ,"Á"  ,"Â"  ,"À"  ,"Ä"  ,"Â"  ,"é"  ,"è"  ,"ë"  ,"ê"  ,"É"  ,"È"  ,"Ë"  ,"Ê"  ,"í"  ,"ì"  ,"ï"  ,"î"  ,"Í"  ,"Ì"  ,"Ï"  ,"Î"  ,"ó"  ,"ò"  ,"ö"  ,"ô"  ,"õ"  ,"Ó"  ,"Ò"  ,"Ö"  ,"Ô"  ,"Õ"  ,"ú"  ,"ù"  ,"ü"  ,"û"  ,"Ú"  ,"Ù"  ,"Ü"  ,"Û"  ,"ç"  ,"Ç"), $address);

		// google map geocode api url
		$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address={$address}";
		echo '['.$url.']';
	 
		// get the json response
		$resp_json = file_get_contents($url);
		 
		// decode the json
		$resp = json_decode($resp_json, true);
	 
		// response status will be 'OK', if able to geocode given address 
		if($resp['status']=='OK'){
	 
			// get the important data
			$lati = $resp['results'][0]['geometry']['location']['lat'];
			$longi = $resp['results'][0]['geometry']['location']['lng'];
			$formatted_address = $resp['results'][0]['formatted_address'];
			 
			// verify if data is complete
			if($lati && $longi && $formatted_address){
			 
				// put the data in the array
				$data_arr = array();            
				 
				array_push(
					$data_arr, 
						$lati, 
						$longi, 
						$formatted_address
					);
				 
				return $data_arr;
				 
			}else{
				return false;
			}
			 
		}else{
			return false;
		}
	}
	
	?>
	
</body>
</html>