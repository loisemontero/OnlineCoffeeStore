<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Display Coffee Info</title>
	<style>
		.edges, .edges td
		{ border: 1px solid black;}
		
		p,#error {color: red;}
	</style>
</head>
<!--Assignment: Online Coffee Store
	File Name: coffee_display.php
	Description:
	The file will recieve the form info from
	user_input.html
	It will then process the information
	and display the user's information
	along with the total cost of the coffee
	Author: Loise Montero
	Date: 3/11/2019
-->
<body>

<?php
	
	//This will act as a flag
	//in case the values processed are empty or invalid
	$okay = true;
	
	//Declares the list that will hold the errors
	$list[] = "";
	
	//Splits up the first and last name
	//while capitalizing the first letter
	//and getting rid of whitespace
	if(isset($_POST['name']) AND empty($_POST['name'])){
		$okay = false;
		$list[] = "Please enter a name.<br>";
	}
	else
	{
		$name = strtolower(trim($_POST['name']));
		$name = explode(" ", $name);
		$fname = ucwords($name[0]);
		$lname = ucwords($name[1]);
	}
	
	//address
	if(isset($_POST['address']) AND empty($_POST['address']))
	{
		$okay = false;
		$list[] = "Please enter your address.<br>";
	}
	else
	{
		$address = $_POST['address'];
	}
	
	//state
	if(isset($_POST['state']) AND empty($_POST['state']))
	{
		$okay = false;
		$list[] = "Please enter your state.<br>";
	}
	else
	{
		$state = $_POST['state'];
	}
	
	//city
	if(isset($_POST['city']) AND empty($_POST['city']))
	{
		$okay = false;
		$list[] = "Please enter your city.<br>";
	}
	else
	{
		$city = $_POST['city'];
	}
	
	//zip
	if(isset($_POST['zip']) AND empty($_POST['zip']))
	{
		$okay = false;
		$list[] = "Please enter your zip code.<br>";
	}
	else
	{
		$zip = $_POST['zip'];
	}
	
	//telephone number
	if(isset($_POST['tele']) AND empty($_POST['tele'])){
		$okay = false;
		$list[] = "Please enter your phone number.<br>";
	}
	else
	{
		$tele = trim($_POST['tele']);
		$tele = str_ireplace(' ', '', $tele);
		$tele = str_ireplace('(', '', $tele);
		$tele = str_ireplace(')', '', $tele);
		$tele = str_ireplace('-', '', $tele);
	}
	
	//email address
	if(isset($_POST['email']) AND empty($_POST['email']))
	{
		$okay = false;
		$list[] = "Please enter your email.<br>";
	}
	else
	{
		$email = trim($_POST['email']);
		$email = strtolower(str_ireplace(' ', '', $email));
	}
	
	
	/*******Calculations Area ********/
	
	if(empty($_POST['types']) AND isset($_POST['qty']) AND empty($_POST['qty']) AND
		$_POST['coffee'] == "select")
	{
		$okay = false;
		$list[] = "Please select regular or decaffeinated.<br>";
		$list[] = "Please type in the quantity.<br>";
		$list[] = "Please select your coffee.<br>";
	}
	else if(isset($_POST['qty']) AND empty($_POST['qty']))
	{
		$okay = false;
		$list[]="Please type in the quantity.<br>";
	}
	else if(empty($_POST['types']))
	{
		$okay = false;
		$list[] = "Please select regular or decaffeinated.<br>";
	}
	else if($_POST['coffee'] == "select")
	{
		$okay = false;
		$list[] = "Please select your coffee.<br>";
	}
	else
	{
		$tcost = 0.00;
		$types = $_POST['types'];
		if($types == "Decaff")
		{
			$tcost = 1.00;
			$typename = "Decaffeinated";
		}
		else
		{
			$typename = "Regular";
		}
		
		$qty = $_POST['qty'];
		
		$cost = 0;
		
		$coffee = $_POST['coffee'];
		
		
		if($coffee == "Boca")
		{
			$cost = 7.99;
			$coffname = "Boca Villa";
		}
		else if($coffee == "South")
		{
			$cost = 8.99;
			$coffname = "South Beach Rhythm";
		}
		else if($coffee == "Pumpkin")
		{
			$cost = 8.99;
			$coffname = "Pumpkin Paradise";
		}
		else if($coffee == "Sumatran")
		{
			$cost = 9.99;
			$coffname = "Sumatran Sunset";
		}
		else if($coffee == "Bali")
		{
			$cost = 10.95;
			$coffname = "Bali Batur";
		}
		else
		{
			$cost = 9.95;
			$coffname = "Double Dark";
		}
		
		if($coffee != "select")
			$total = $qty * ($cost + $tcost);
	}
	
	
	
	/******End of Calculations Area****/
	
	//Displays the info in a table
	if($okay){
	
	echo "<table>
			<tr>
				<td>Name:</td>
				<td>$fname $lname</td>
			</tr>
			<tr>
				<td>Address</td>
				<td>$address</td>
			</tr>
			<tr>
				<td>City, State, Zip:</td>
				<td>$city, $state, $zip</td>
			</tr>
			<tr>
				<td>Phone #:</td>
				<td>$tele</td>
			</tr>
			<tr>
				<td>E-mail:</td>
				<td>$email</td>
			</tr>
	</table>
	<br>";
	
	echo "<table class=\"edges\">
			<tr>
				<th colspan=\"4\">Order Information</th>
			</tr>
			<tr>
				<td>Coffee</td>
				<td>Type</td>
				<td>Quantity</td>
				<td>Unit Cost</td>
				<td>Total</td>
			</tr>
			<tr>
				<td>$coffname</td>
				<td>$typename</td>
				<td>$qty</td>
				<td>$cost</td>
				<td>$total</td>
			</tr>
			</table>";
	echo '<br><a href="user_input.html">Return to input form.</a>';
	}

	else{
		$string_words = implode('<br>', $list);
		echo "<h2 id=\"error\">Errors!</h2>";
		echo "<p>$string_words</p>";
		echo '<br><a href="user_input.html">Return to input form.</a>';
	}

	
?>
</body>
</html>