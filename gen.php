<?php
// Software Inc Furniture XML Generator
// Author: Demannu

// XML Skeleton(Only the bare minimum should be in here)
$xmlSkeleton = <<<XML
<Root AutoBounds="True">
	<Models>
		<Model>
			<File></File>
			<Position></Position>
			<Rotation></Rotation>
			<Scale></Scale>
		</Model>
	</Models>
	<Furniture>
	</Furniture>
</Root>
XML;

$baseFurnitureTypes = array(
	"None" => array(""),
	"Office" => array(
		"Table",
		"Glass Table",
		"2m End Table",
		"3m End Table",
		"Cheap Chair",
		"Office Chair",
		"Old Computer",
		"90s Computer",
		"Laptop",
		"Modern Computer",
		"HoloComputer",
		"Cubicle Wall",
		"TV",
		"Bookshelf",
		"Phone",
		"Drawing Tablet",
		"Calculator",
		"Inbox",
	),
	"Reception" => array(
		"Waiting Chairs",
		"Couch",
		"Reception Desk",
	),
	"Outdoor" => array(
		"Bench",
		"Outdoor Lamp",
		"Small tree",
		"Small pine tree",
	),
	"Temperature" => array(
		"Small Heater",
		"Ceiling Fan",
		"Radiator",
		"Ventilation",
		"Central Heating",
		"AC Unit",
		"Industrial ventilation",
	),
	"Lighting" => array(
		"Lamp",
		"Wall Lamp",
		"Desk Lamp",
		"Floor Lamp",
		"Fluroescent lamp",
	),
	"Needs" => array(
		"Vending Machine",
		"Fridge",
		"Stove",
		"Serving Tray",
		"Instant Coffee",
		"Coffee",
		"Espresso Machine",
		"Toilet",
		"Watercooler",
	),
	"Decoration" => array(
		"Painting",
		"Floor Plant",
		"Table Plant",
		"Table Cactus",
		"Big Plant",
		"Clock",
	),
	"Server" => array(
		"Small Server",
		"Medium Server",
		"Tower Server",
		"Server Rack",
	)
);

// In Place (outputs) <option value="$a">$a</option> in categories.
function _html_generate_options($groups) {
	foreach ($groups as $label => $options) {
		echo "<optgroup label=\"$label\">";
		foreach ($options as $option) {
			echo "<option value=\"$option\">$option</option>";
		}
		echo "</optgroup>";
	}
}
// TODO: Automate the HTML input based on arrays entered

// Read the POST data and act on the inputs
if (!$_POST){
	// Form not submitted
} else {
	// Build XML to Download
	$xml=new SimpleXMLElement($xmlSkeleton);
	foreach($_POST as $k => $v){
		// $k, input name; $v, input value
		switch ($k) {
			// Ignore unknown input for now
			case $v == "": 
				continue;
			// <Root>
			case "Base":
			case "UpgradeFrom":
			case "Thumbnail":
				$xml->addAttribute($k, $v);
				break;
			// <Models><Model>
			case "File":
			case "Position":
			case "Rotation":
			case "Scale":
				$xml->Models->Model->$k = $v;
				break;
			// <Furniture>
			case "Category":
			case "Cost":
			case "ButtonDescription":
			case "UnlockYear":
			case "PrimaryColorName":
			case "SecondaryColorName":
			case "TertiaryColorName":
			case "ColorPrimaryEnabled":
			case "ColorSecondaryEnabled":
			case "ColorTertiaryEnabled":
			case "ForceColorSecondary":
			case "ForceColorTertiary":
			case "Wattage":
			case "FunctionCategory":
			case "ComputerPower":
			case "Lighting":
			case "Coffee":
			case "Wait":
			case "Water":
			case "Noisiness":
			case "Comfort":
			case "Environment":
			case "BasementValid":
			case "OnlyExteriorWalls":
			case "WallFurn":
			case "IsSnapping":
			case "CanAssign":
			case "ValidIndoors":
			case "ValidOutdoors":
			case "ValidOnFence":
			case "ForceAccessible":
			case "ITFix":
			case "TemperatureController":
			case "EqualizeTemperature":
			case "AlwaysOn":
				$xml->Furniture->$k = $v;
				break;
			case "AuraValues":
			case "RoleBuffs":
				$v = str_replace(',', "\n", $v);
				$xml->Furniture->$k = $v;
				break;
			case "ColorPrimaryDefault":
			case "ColorSecondaryDefault":
			case "ColorTertiaryDefault":
				$v = explode(",", $v);
				$colors = '';
				foreach ($v as $color) {
					$colorx = ($color / 255);
					$colorx = round($colorx, 3);
					$colors .= $colorx . "\n";
				};
				$colors .= "1";
				$xml->Furniture->$k = $colors;
				break;
			case "submit":
				continue;
			default:
				break;
		}
	}
	// Take SimpleXML, make it human-readable
	$dom = new DOMDocument('1.0');
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;
	$dom->loadXML($xml->asXML());
	// Set download headers
	header('Content-Description: File Transfer');
	header('Content-Type: application/xml');
	header('Content-Disposition: attachment; filename="' . $_POST["File"] . '.xml"');
	header('Content-Length: ' . strlen($xml->asXML()));
	ob_clean();
	flush();
	// Send XML file to browser
	echo $dom->saveXML();
	exit;


}

?><!DOCTYPE html>
<title> Software Inc. XML Generator </title>
	<!-- Custom CSS -->
	<style>
	body {
		padding-top: 70px;
		background-color: #d6d8cd;
	}
	select optgroup {
		background-color: black;
		color: white;
		
		font-size: 125%;
		line-height: 15px;
		letter-spacing: 2px;
	}
	select option {
		background-color: white;
		color: black;
	}
	</style>
	<!-- noUIslider -->
	<link rel="stylesheet" href="js/nouislider.css">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <a class="navbar-brand" href="https://steamcommunity.com/id/spairolled/myworkshopfiles/">Demannu | Workshop</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  <ul class="nav navbar-nav">
		<li class="active"><a href="http://demannu.com/softwareinc/gen.php">XML Generator <span class="sr-only">(current)</span></a></li>
		<li><a href="https://github.com/Demannu/softwareinc-FurnitureXMLGenerator">View on GitHub</a></li>
	  </ul>
	</div>
  </div>
</nav>
	<div class="container-fluid">
		<form class="form-horizontal" method="post" action="gen.php" autocomplete="no">
			<div class="row">
				<div class="col-md-3">
					<!-- Basic Options Panel -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><b>Required </b>| Basic Options</h3>
						</div>
						<div class="panel-body">

						<!-- Select Basic -->
						<div class="form-group">
							<label class=" col-md-4 control-label" for="Base">Base</label>
							<div class="col-md-6">
								<select id="Base" name="Base" class="form-control" required="yes">
									<?=_html_generate_options($baseFurnitureTypes); ?>
								</select>
							</div>
						</div>

						<div class="form-group">
						  <label class=" col-md-4 control-label" for="UpgradeFrom">Upgrade</label>
						  <div class="col-md-6">
							<select id="UpgradeFrom" name="UpgradeFrom" class="form-control" required="yes">
									<?=_html_generate_options($baseFurnitureTypes); ?>
							</select>
						  </div>
						</div>

						<div class="form-group">
						  <label class=" col-md-4 control-label" for="Thumbnail">Thumbnail</label>
						  <div class="col-md-6">
						  <input id="Thumbnail" name="Thumbnail" type="text" placeholder="Thumbs.png" class="form-control input-md" required="yes">
						  </div>
						</div>

						<div class="form-group">
						  <label class=" col-md-4 control-label" for="File">3D Model</label>
						  <div class="col-md-6">
						  <input id="File" name="File" type="text" placeholder="modObject.obj" class="form-control input-md" required="yes"> 
						  </div>
						</div>
						<div class="form-group">
						  <label class=" col-md-4 control-label" for="Position">Position</label>
						  <div class="col-md-6">
						  <input id="Position" name="Position" type="text" class="form-control input-md" value="0,0,0">
						  </div>
						</div>

						<div class="form-group">
						  <label class=" col-md-4 control-label" for="Rotation">Rotation</label>
						  <div class="col-md-6">
						  <input id="Rotation" name="Rotation" type="text" class="form-control input-md" value="0,0,0">
						  </div>
						</div>

						<div class="form-group">
						  <label class=" col-md-4 control-label" for="Scale">Scale</label>  
						  <div class="col-md-6">
						  <input id="Scale" name="Scale" type="text" class="form-control input-md" value="0,0,0">
						  </div>
						</div>
					</div>
					</div>
					<input type="submit" class="btn btn-success btn-lg btn-block" name="submit" value="Download XML">
				</div>
				<div class="col-md-6">
					<!-- Furniture Attributes Panel -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Furniture Attributes</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<!-- Left Furniture -->
								<div class="col-md-6">

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Type">Type</label>  
									  <div class="col-md-7">
									  <input id="Type" name="Type" type="text" placeholder="Unique Type" class="form-control input-md">  
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Cateogry">Category</label>
									  <div class="col-md-7">
										<select id="Category" name="Category" class="form-control">
											<option value="Office">Office</option>
											<option value="Reception">Reception</option>
											<option value="Temperature">Temperature</option>
											<option value="Lighting">Lighting</option>
											<option value="Needs">Needs</option>
											<option value="Decoration">Decoration</option>
											<option value="Server">Server</option>
										</select>
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Cost">Cost</label>  
									  <div class="col-md-7">
									  <input id="Cost" name="Cost" type="text" placeholder="1337" class="form-control input-md" >
									  <span class="help-block">No punctuation</span>  
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="UnlockYear">Unlock Year</label>  
									  <div class="col-md-7">
									  <input id="UnlockYear" name="UnlockYear" type="text" placeholder="1970" class="form-control input-md" >
										
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="ButtonDescription">Description</label>
									  <div class="col-md-7">                     
										<textarea class="form-control" id="ButtonDescription" name="ButtonDescription" placeholder="Write something nice about your item!"></textarea>
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="RoleBuffs">RoleBuffs</label>  
									  <div class="col-md-7">
									  <input id="RoleBuffs" name="RoleBuffs" type="text" placeholder="0,0,0,0,0" class="form-control input-md">
									  <span class="help-block">Leader, Programmer, Designer, Artist, Marketer</span>  
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="AuraValues">AuraValues</label>  
									  <div class="col-md-7">
									  <input id="AuraValues" name="AuraValues" type="text" placeholder="0,0,0" class="form-control input-md">
									  <span class="help-block">Efficiency, Skill, Mood</span>  
									  </div>
									</div>
								</div>
								<!-- Right Furniture -->
								<div class="col-md-6">

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Environment">Environment</label>  
									  <div class="col-md-7">
									  <div id="env_slide">
									  </div>
									  <input id="Environment" name="Environment" type="text" placeholder="0-2 (Negative to Positive)" class="form-control input-md">
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Wattage">Wattage</label>  
									  <div class="col-md-7">
									  <div id="wattage_slide">
									  </div>
									  <input id="Wattage" name="Wattage" type="text" placeholder="0-100 (None to Full)" class="form-control input-md">
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Lighting">Lighting</label>  
									  <div class="col-md-7">
									  <div id="lighting_slide">
									  </div>
									  <input id="Lighting" name="Lighting" type="text" placeholder="0-2 (None to Full)" class="form-control input-md">								
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Noisiness">Noisiness</label>  
									  <div class="col-md-7">
									  <div id="noisiness_slide">
									  </div>
									  <input id="Noisiness" name="Noisiness" type="text" placeholder="0-55 (None to Full)" class="form-control input-md">
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Water">Water Usage</label>  
									  <div class="col-md-7">
									  <div id="water_slide">
									  </div><!-- Heh water slide -->
									  <input id="Water" name="Water" type="text" placeholder="0-100 (None to Full)" class="form-control input-md">
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Coffee">Coffee</label>  
									  <div class="col-md-7">
									  <div id="coffee_slide">
									  </div>
									  <input id="Coffee" name="Coffee" type="text" placeholder="0-3 (None to Full)" class="form-control input-md"> 
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="Comfort">Comfort</label>  
									  <div class="col-md-7">
									  <div id="comfort_slide">
									  </div>
									  <input id="Comfort" name="Comfort" type="text" placeholder="0-1 (None to Full)" class="form-control input-md" >
									  </div>
									</div>

									<div class="form-group">
									  <label class="col-md-4 control-label" for="ComputerPower">PC Power</label>  
									  <div class="col-md-7">
									  <div id="pc_slide">
									  </div>
									  <input id="ComputerPower" name="ComputerPower" type="text" placeholder="0-1.75 (None to Full)" class="form-control input-md" > 
									  </div>
									</div>
								</div>
							</div>
							<!-- Checkbox Toggle Furniture -->
							<div class="row">
								<div class="col-md-3">
									Can Rotate? <input type="checkbox" name="CanRotate" value="True"> <br>
									Always on? <input type="checkbox" name="AlwaysOn" value="True"> <br>
									Force Access? <input type="checkbox" name="ForceAccessible" value="True"> <br>
									Assignable? <input type="checkbox" name="CanAssign" value="True"> <br>
								</div>

								<div class="col-md-3">
									Valid in Basement? <input type="checkbox" name="BasementValid" value="True"> <br>
									Valid Inside? <input type="checkbox" name="ValidIndoors" value="True"> <br>
									Valid Outside? <input type="checkbox" name="ValidOutdoors" value="True">	<br>
									Valid on Fence? <input type="checkbox" name="ValidOnFence" value="True"> <br>
								</div>

								<div class="col-md-6">
									Is this a temperature controller <input type="checkbox" name="TemperatureController" value="True"> <br>
									Is this wall furniture? <input type="checkbox" name="WallFurn" value="True"> <br>
									Equalize Temperature <input type="checkbox" name="EqualizeTemperature" value="True"> <br>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Right Column -->
				<div class="col-md-3">
					<!-- Color Attributes Panel -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Color Attributes</h3>
						</div>
						<div class="panel-body">
							<div class="form-group">
							  <label class="col-md-4 control-label" for="PrimaryColorName">1st Color Name</label>  
							  <div class="col-md-6">
							  <input id="PrimaryColorName" name="PrimaryColorName" type="text" placeholder="colorName" class="form-control input-md">
							  </div>
							</div>

							<div class="form-group">
							  <label class="col-md-4 control-label" for="ColorPrimaryDefault">Color in RGBA</label> 
							  <div class="col-md-6">
							  <input id="ColorPrimaryDefault" name="ColorPrimaryDefault" type="text" placeholder="r,g,b" class="form-control input-md result" id="Primary">
							  </div>
							</div>

							<div class="form-group">
							  <label class="col-md-4 control-label" for="SecondaryColorName">2nd Color Name</label>  
							  <div class="col-md-6">
							  <input id="SecondaryColorName" name="SecondaryColorName" type="text" placeholder="colorName" class="form-control input-md">
							  </div>
							</div>

							<div class="form-group">
							  <label class="col-md-4 control-label" for="ColorSecondaryDefault">Color in RGBA</label>  
							  <div class="col-md-6">  
							  <input id="ColorSecondaryDefault" name="ColorSecondaryDefault" type="text" placeholder="r,g,b" class="form-control input-md" id="Secondary">
							  </div>
							</div>

							<div class="form-group">
							  <label class="col-md-4 control-label" for="TertiaryColorName">3rd Color Name</label>  
							  <div class="col-md-6">
							  <input id="TertiaryColorName" name="TertiaryColorName" type="text" placeholder="colorName" class="form-control input-md">
							  </div>
							</div>

							<div class="form-group">
							  <label class="col-md-4 control-label" for="ColorTertiaryDefault">Color in RGBA</label>  
							  <div class="col-md-6">
							  <input id="ColorTertiaryDefault" name="ColorTertiaryDefault" type="text" placeholder="r,g,b" class="form-control input-md">
							  </div>
							</div>
							<!-- Color Force Toggles -->
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
									  <div class="col-md-4">
										<div class="checkbox">
											<label for="ColorPrimaryEnabled-0">
											  <input type="checkbox" name="ColorPrimaryEnabled" id="ColorPrimaryEnabled-0" value="True">
											  Primary
											</label>
										</div>
									  </div>
									</div>
								</div>
								<div class="col-md-4">
								  <div class="form-group">
									<div class="col-md-4">
									  <div class="checkbox">
										<label for="ColorSecondaryEnabled-0">
										  <input type="checkbox" name="ColorSecondaryEnabled" id="ColorSecondaryEnabled-0" value="True">
										  Secondary
										</label>
									  </div>
									</div>
								  </div>
								</div>
								<div class="col-md-4">
								  <div class="form-group">
								    <div class="col-md-4">
								      <div class="checkbox">
										<label for="ColorTertiaryEnabled-0">
										  <input type="checkbox" name="ColorTertiaryEnabled" id="ColorTertiaryEnabled-0" value="True">
										  Tertiary
										</label>
										</div>
									  </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="js/nouislider.js"></script>
	<script src="js/sliderControl.js"></script>
</body>
