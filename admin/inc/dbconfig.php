
<?php
$hname = 'localhost';
$uname = 'root';
$pass = '';
$db = 'eventwebsite';  //database name

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("cannnot connect to databse" . mysqli_connect_error());
}

function filteration($data)
{
    foreach ($data as $key => $value) {
        /* trim()
         stripslashes()
         htmlspecialchars()
         strip_tags()*/
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        $value = strip_tags($value);
      //$data[$key] = strip_tags($value); all function declared this type up side

        $data['key']= $value;  
    }
    return $data;

}

function selectAll($table)
{
  $con= $GLOBALS['con'];
  $res= mysqli_query($con,"SELECT * FROM $table");
  return $res;
}

function select($sql,$values,$datatypes)
{
  $con = $GLOBALS['con']; //use con so use globals variables
  if($stmt = mysqli_prepare($con,$sql))
  {
     mysqli_stmt_bind_param($stmt,$datatypes,...$values);
     if(mysqli_stmt_execute($stmt))
     {
       $res= mysqli_stmt_get_result($stmt);
       mysqli_stmt_close($stmt);
       return $res;

     }
     else{
        mysqli_stmt_close($stmt);
        die("Querry cannot be executed-select");
     }

  }
  else{
   die("Querry cannot be prepared -Select");
  }




}


function update($sql,$values,$datatypes)
{
  $con = $GLOBALS['con']; //use con so use globals variables
  if($stmt = mysqli_prepare($con,$sql))
  {
     mysqli_stmt_bind_param($stmt,$datatypes,...$values);
     if(mysqli_stmt_execute($stmt))
     {
       $res= mysqli_stmt_affected_rows($stmt);    //affected_rows change form select function
       mysqli_stmt_close($stmt);
       return $res;

     }
     else{
        mysqli_stmt_close($stmt);
        die("Querry cannot be executed- Update");
     }

  }
  else{
   die("Querry cannot be prepared -Update");
  }




}

function insert($sql,$values,$datatypes)
{
  $con = $GLOBALS['con']; //use con so use globals variables
  if($stmt = mysqli_prepare($con,$sql))
  {
     mysqli_stmt_bind_param($stmt,$datatypes,...$values);
     if(mysqli_stmt_execute($stmt))
     {
       $res= mysqli_stmt_affected_rows($stmt);    //affected_rows change form select function
       mysqli_stmt_close($stmt);
       return $res;

     }
     else{
        mysqli_stmt_close($stmt);
        die("Querry cannot be executed- Insert");
     }

  }
  else{
   die("Querry cannot be prepared -INsert");
  }




}


function deleteOperation($sql,$values,$datatypes)
{
  $con = $GLOBALS['con']; //use con so use globals variables
  if($stmt = mysqli_prepare($con,$sql))
  {
     mysqli_stmt_bind_param($stmt,$datatypes,...$values);
     if(mysqli_stmt_execute($stmt))
     {
       $res= mysqli_stmt_affected_rows($stmt);    //affected_rows change form select function
       mysqli_stmt_close($stmt);
       return $res;

     }
     else{
        mysqli_stmt_close($stmt);
        die("Querry cannot be executed- Delete");
     }

  }
  else{
   die("Querry cannot be prepared -Delete");
  }




}







?>