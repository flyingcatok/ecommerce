<?php 
//Author: Libby Ferland
//Date: 11/22/2013
//Last Edit:
//Edit Date:
?>

<HTML>
	<div id="log_control" style="float:right; background-color: #FFFFFF">
        <a href="my_account.php">My Account</a>
        <a href="customer_basket.php">My Shopping Basket</a>
        <a href="customer_logout.php">Logout</a>
    </div>
    <div id="logo" style="background-color:#FFFFFF;clear:both;text-align:left;">
	<H2> <a href="main.php" style="text-decoration: none">F&L Gift Store</a> </H2>
	</div>
    <BODY>
        <div id ="new-add-header" style ="background-color:#FFFFFF; clear:both; text-align:center">
    <HEADER><TITLE>New Shipping Address</TITLE></HEADER>
    <H3>Enter a New Shipping Address</H3>
        </div>
    <div id ="new-add-form" style ="background-color:#FFFFFF; clear:both; text-align:center">
        <form action="add_address.php" method="POST">
            Line One: &nbsp;&nbsp; <input type="text" name="newl1" minlength="4" maxlength="50"> <br>
            Line Two: &nbsp; <input type ="text" name ="newl2" maxlength="50"><br>
            City: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name ="newcity" maxlength="50"><br>
            State: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            	<select name="newstate">
                <option value ="Default">Select your state</option>
                <option value="AL">Alabama</option>
                <option value = "AK">Alaska</option>
                <option value= "AZ">Arizona</option>
                <option value= "AR">Arkansas</option>
                <option value="CA">California</option>
                <option value ="CO">Colorado</option>
                <option value="CT">Connecticut</option>
                <option value= "DE">Delaware</option>
                <option value="FL">Florida</option>
                <option value ="GA">Georgia</option>
                <option value ="HI">Hawaii</option>
                <option value ="ID">Idaho</option>
                <option value = "IL">Illinois</option>
                <option value ="IN">Indiana</option>
                <option value = "IO">Iowa</option>
                <option value ="KS">Kansas</option>
                <option value ="KY">Kentucky</option>
                <option value="LA">Louisiana</option>
                <option value ="ME">Maine</option>
                <option value = "MD">Maryland</option>
                <option value = "MA">Massachusetts</option>
                <option value ="MI">Michigan</option>
                <option value ="MN">Minnesota</option>
                <option value ="MS">Mississippi</option>
                <option value ="MO">Missouri</option>
                <option value ="MT">Montana</option>
                <option value ="NE">Nebraska</option>
                <option value="NV">Nevada</option>
                <option value="NH">New Hampshire</option>
                <option value ="NJ">New Jersey</option>
                <option value="NM">New Mexico</option>
                <option value="NY">New York</option>
                <option value="NC">North Carolina</option>
                <option value="ND">North Dakota</option>
                <option value="OH">Ohio</option>
                <option value="OK">Oklahoma</option>
                <option value="OR">Oregon</option>
                <option value="PA">Pennsylvania</option>
                <option value="RI">Rhode Island</option>
                <option value="SC">South Carolina</option>
                <option value="SD">South Dakota</option>
                <option value="TN">Tennessee</option>
                <option value="TX">Texas</option>
                <option value="UT">Utah</option>
                <option value="VT">Vermont</option>
                <option value="VA">Virginia</option>
                <option value="WA">Washington</option>
                <option value="WV">West Virginia</option>
                <option value="WI">Wisconsin</option>
                <option value="WY">Wyoming</option>
            </select>
            <br>
            Zip: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="zipc"> <br>
            <input type="submit" name="addAddBtn" value ="Add Address">
        </form>
    </div> 
    
    </BODY>
</HTML>
