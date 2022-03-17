<?php 
include('header.php');
?>
<title>phpzag.com : Demo Currency conversion in PHP Using Google API</title>
<script type="text/javascript" src="script/validation.min.js"></script>
<script type="text/javascript" src="script/ajax.js"></script>
<?php include('container.php');?>
<div class="container">
	<h2>Example: Currency conversion in PHP Using Google API</h2>	
	<br />
	<br />
	<br />
	<?php
    	$client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        $geoDetails = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
        
        $userCountry = $geoDetails['geoplugin_countryName'];
        $userCountryCurCode = $geoDetails['geoplugin_currencyCode'];
        $countryCurSymbol = $geoDetails['geoplugin_currencySymbol'];
        $countryflag = $geoDetails['geoplugin_countryCode'];
        $countryFlg = strtolower($countryflag);
        echo $countryFlag = $countryFlg.'.png';
        
	?>
	
	<form method="post" id="currency-form"> 		
	<div class="form-group">
	<label>From</label>
		<select name="from_currency">
			<option value="INR">Indian Rupee</option>
			<option value="USD" selected="1">US Dollar</option>
			<option value="AUD">Australian Dollar</option>
			<option value="EUR">Euro</option>
			<option value="EGP">Egyptian Pound</option>
			<option value="CNY">Chinese Yuan</option>
		</select>	
		 <label>Amount</label>	
		<input type="text" placeholder="Currency" name="amount" id="amount" />			
		 <label>To</label>
		<select name="to_currency">
			<option value="INR" selected="1">Indian Rupee</option>
			<option value="USD">US Dollar</option>
			<option value="AUD">Australian Dollar</option>
			<option value="EUR">Euro</option>
			<option value="EGP">Egyptian Pound</option>
			<option value="CNY">Chinese Yuan</option>
		</select>			
		  
		  <div class="form-group" id="converted_rate">
	    <div id="converted_rate"></div>
	    <div id="converted_amount"></div>
	    <button type="submit" name="convert" id="convert" class="btn btn-default">Convert</button>
	</div>	
	<div id="converted_amount"></div>			
	</div>			
</form>	

	
				

</div>
<?php include('footer.php');?>


	<!--		&nbsp;&nbsp;<button type="submit" name="convert" id="convert" class="btn btn-default">Convert</button>	-->
				
	<!--	</div>			-->
	<!--</form>	-->
	
	<div class="form-group" id="converted_rate"></div>	
	<div id="converted_amount"></div>
				

</div>
<?php include('footer.php');?>


