<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Lang" content="en" />
<meta name="author" content="" />
<meta http-equiv="Reply-to" content="@.com" />
<meta name="generator" content="PhpED 8.0" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="creation-date" content="06/09/2012" />
<meta name="revisit-after" content="15 days" />
<title>PC Shop</title>

<style type="text/css">
	body {
		margin: 0px;
		padding: 0px;
		background: url(img/img5.jpg);	
	}
	div#body {
		position: relative;
		border: 1px solid gray;
		border-top: none;
		border-bottom: none;
		width: 1200px;
		margin: 0px auto;
	}
	div#header {
		position: relative;
		width: 1200px;
		height: 100px;
		border-bottom: 1px solid gray;
		background: red;
	}
	div#menu {
		text-align: center;
		position: relative;
		width: 100%;
		height: 30px;	
		border-bottom: 1px solid gray;
		background: pink;
		font-size: 20px;
		text-align: center;	
		
	}
	div#menu a {
		color: purple;
		text-decoration: none;
		vertical-align: middle;	
		width: 300px;
		height: 30px;		
	}	
	ul {
    	list-style-type: none;
    	margin: 0;
    	padding: 0;
    	overflow: hidden;
	}
	li {
    	float:left;
	}
	a:link, a:visited {
    	display: block;
    	width: 143px;
    	color: white;
    	background-color: #98bf21;
    	text-align: center;
   	 	text-decoration: none;
	}
	a:hover, a:active {
		background-color: #7A991A;
	}	
	div#work {
		position: relative;
		width: 1200px;
		min-height: 400px;
	}
	div#work a{
		position: relative;
    	width: 192px;
    	color: white;
    	background-color: green;
    	text-align: center;
   	 	text-decoration: none;
		border: 1px solid black;
		margin-right: 2px;
	}
	div#work a:hover, div#work a:active{
		background-color: orange;	
	}
	
	table a img {
		width: 192px;
		height: 192px;
	}
	
	.error {color: #FF0000;}
</style>
</head>

<body>
	<div id="body">
    	<div id="header">
              
      </div>
        
        <div id="menu">
        	<ul>
           		<li><a href="index.html">Computer Parts</a> </li>
            	<li><a href="#">PC's</a> </li>
            	<li><a href="#">Laptops</a> </li>
            	<li><a href="Registration.php">Registration</a> </li>
            </ul>
        </div>
        
        <div id="work"> 
           
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            
            try {
                $conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully"; 
                }
            catch(PDOException $e)
                {
                echo "Connection failed: " . $e->getMessage();
                }
    
            
            // define variables and set to empty values
            $nameErr = $emailErr = $genderErr = $websiteErr = "";
            $name = $email = $gender = $comment = $website = "";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               if (empty($_POST["name"])) {
                 $nameErr = "Name is required";
               } else {
                 $name = test_input($_POST["name"]);
                 // check if name only contains letters and whitespace
                 if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                   $nameErr = "Only letters and white space allowed"; 
                 }
               }
               
               if (empty($_POST["email"])) {
                 $emailErr = "Email is required";
               } else {
                 $email = test_input($_POST["email"]);
                 // check if e-mail address is well-formed
                 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                   $emailErr = "Invalid email format"; 
                 }
               }
                 
               if (empty($_POST["website"])) {
                 $website = "";
               } else {
                 $website = test_input($_POST["website"]);
                 // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
                 if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                   $websiteErr = "Invalid URL"; 
                 }
               }
            
               if (empty($_POST["comment"])) {
                 $comment = "";
               } else {
                 $comment = test_input($_POST["comment"]);
               }
            
               if (empty($_POST["gender"])) {
                 $genderErr = "Gender is required";
               } else {
                 $gender = test_input($_POST["gender"]);
               }
            }
            
            function test_input($data) {
               $data = trim($data);
               $data = stripslashes($data);
               $data = htmlspecialchars($data);
               return $data;
            }
			?>
			
            <h2>PHP Form Validation Example</h2>
            <p><span class="error">* required field.</span></p>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
               Name: <input type="text" name="name" value="<?php echo $name;?>" />
               <span class="error">* <?php echo $nameErr;?></span>
               <br><br>
               E-mail: <input type="text" name="email" value="<?php echo $email;?>" />
               <span class="error">* <?php echo $emailErr;?></span>
               <br><br>
               Website: <input type="text" name="website" value="<?php echo $website;?>" />
               <span class="error"><?php echo $websiteErr;?></span>
               <br><br>
               Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
               <br><br>
               Gender:
               <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
               <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">Male
               <span class="error">* <?php echo $genderErr;?></span>
               <br><br>
               <input type="submit" name="submit" value="Submit"> 
            </form>
            
            
            <?php
            echo "<h2>Your Input:</h2>";
            echo $name;
            echo "<br>";
            echo $email;
            echo "<br>";
            echo $website;
            echo "<br>";
            echo $comment;
            echo "<br>";
            echo $gender;
            ?>

        </div>
    </div>
</body>
</html>
