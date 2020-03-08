<?php
$mysqli = mysqli_connect("localhost", "cs213user", "letmein", "namelist");

if (!(filter_input (INPUT_POST, 'submit'))) {
   echo "<html><head>";
   echo "</head><body>"; 
   
    $sql = "SELECT * from names";  
    $result = mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));
   
   echo "<form action=\"\" method=\"POST\">";
   echo "<input type=\"submit\" name=\"submit\" value=\"submit\">  ";
   echo "Display Records<br><br>";
   echo "First & Last Names :<br><br>";
   while ($rowResult = mysqli_fetch_array($result)){
	echo "<form action=\"\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"id\" value=".$rowResult['ID'].">";
	echo "<input type=\"text\" name=\"first\" value=\"".$rowResult['first_name']."\">";
        echo "<input type=\"text\" name=\"last\" value=\"".$rowResult['last_name']."\">";
        echo "   <input type=\"submit\" name=\"submit\" value=\"  \">";
        echo "	Update Record<br>";
	echo "</form>";      
        } //while  
  echo "</body></html>";     
}
else {
    $first= filter_input(INPUT_POST,'first');
    $last= filter_input(INPUT_POST,'last');
    $id = filter_input(INPUT_POST,'id');
    $id = (Integer) $id;
    
    $proceed = false;
    if($first != null && $last != null)
	if(strlen($first) > 0 && strlen($last) > 0)
            $proceed = true;
    
    if ($proceed === true) {
        $sql = "update names set first_name=\"$first\", last_name=\"$last\" where ID=$id";
        $res = mysqli_query($mysqli, $sql);       
    }
    
    echo "<html><head>";
    echo "</head><body>";
    echo "<code><pre>";
    echo "<font color=green>ID\tFirst ";
    echo "Name\tLast Name</font> <br>";

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
        
        }   
        
    echo "</pre></code>";
    echo "</body></html>";
    }
}

?>