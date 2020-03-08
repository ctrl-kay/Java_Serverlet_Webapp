<?php
if (!(filter_input (INPUT_POST, 'submit'))) {
   echo "<html><head>";
   echo "</head><body>"; 
   echo "<form action=\"\" method=\"POST\">";
   echo "First Name :<br>";
   echo "<input type=\"text\" name=\"first\"><br>";
   echo "Last Name :<br>";
   echo "<input type=\"text\" name=\"last\"> <br><br>";
   echo "<input type=\"submit\" name=\"submit\" value=\"submit\">  ";
   echo "Insert Records</form>";
   echo  "</body></html>";
}
else {
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "namelist");
    
    echo "<html><head>";
    echo "</head><body>";
    echo "<code><pre>";
    echo "<font color=green>ID\tFirst ";
    echo "Name\tLast Name</font> <br>";

    $first = filter_input(INPUT_POST, 'first');
    $last = filter_input(INPUT_POST, 'last');
    
    $proceed = false;
    if($first != null && $last != null)
	if(strlen($first) > 0 && strlen($last) > 0)
            $proceed = true;
    
    if ($proceed === true) {
        $sql = "insert into names values (null, '".$first."', '".$last."');";
        $res = mysqli_query($mysqli, $sql);
        
    }
    
    $sql = "SELECT * from names";  
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($result) >= 1) {
        while ($rowResult = mysqli_fetch_array($result)){
            echo $rowResult['ID'];
            echo "\t";
            echo $rowResult['first_name'];
            echo "\t\t";  
            echo $rowResult['last_name'];
            echo "<br>";
        
        } //while   
        
    echo "</pre></code>";
    echo "</body></html>";
    }
}

?>