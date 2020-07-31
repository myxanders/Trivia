<?php 
if(isset($_POST["import"]))
{
 if($_FILES["database"]["name"] != '')
 {
  $array = explode(".", $_FILES["database"]["name"]);
  $extension = end($array);
  if($extension == 'sql')
  {
    //Establish connection by calling an existing database
   $connect = mysqli_connect(T_DB_SERVER,T_DB_USERNAME,T_DB_PASSWORD, "phpmyadmin");
   $output = '';
   $count = 0;
   $file_data = file($_FILES["database"]["tmp_name"]);
   foreach($file_data as $row)
   {
    $start_character = substr(trim($row), 0, 2);
    //Ignore commented lines
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
     if($end_character == ';')
     {
      if(!mysqli_query($connect, $output))
      {
       $count++;
      }
      $output = '';
     }
    }
   }
   if($count > 0)
   {
    $message = '<label class="text-danger">There is an error in Database Import</label>';
   }
   else
   {
     //Successful import sends to index page
	header("location:index.php");
    $message = '<label class="text-success">Database Successfully Imported</label>';
   }
  }
  else
  {
   $message = '<label class="text-danger">Invalid File</label>';
  }
 }
 else
 {
  $message = '<label class="text-danger">Please Select Sql File</label>';
 }
}
?>

<!DOCTYPE html>  
<html>  
 <head>  
  <title>Set Up Trivia</title>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="triviaStyle.css">
	<link href="https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap" rel="stylesheet"> 
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
 </head>  
 <body>  
  <br /><br />  
   <div><h3 align="center" style="margin-top: 30px; width: 750px; font-family: 'Trebuchet MS', Helvetica, sans-serif;">To set up Trivia, find the 'trivia.sql' file in your 'C:\xampp\htdocs\Trivia' folder.</h3></div> 
   <br />
     <div>  
   <div><?php echo $message; ?></div>
   <form method="post" enctype="multipart/form-data">
    <p><label>Select Sql File</label>
    <input type="file" name="database" /></p>
    <br />
	<div>
    <input type="submit" name="import" class="btn btn-info" value="import" style = "padding: 4px;"/>
	<div>
   </form>
  </div>  
 </body>  
</html>
<style>
	input[type="file"], input[type="submit"]{
		color:black;
		background-color:white;
		border: 2px solid black;
		border-radius: 5px;
	}
	label {
		color: white;
	}
	
	input[type="file"]:hover {
		cursor:pointer;
	}
	
	input[type="submit"]:hover{
		color: white;
		border-color: white;
		background-color: black;
		transition-duration: 0.5s;
		cursor: pointer;
	}

</style>