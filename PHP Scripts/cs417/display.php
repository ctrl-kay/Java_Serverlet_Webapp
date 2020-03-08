<?php
if (!(filter_input (INPUT_POST, 'submit'))) {
   echo "<html><head>";
   echo "</head><body>"; 
   echo "<form action=\"\" method=\"POST\">";
   echo "<input type=\"submit\" name=\"submit\" value=\"submit\">  ";
   echo "Display Records</form>";
   echo  "</body></html>";
}
else {
    $mysqli = mysqli_connect("localhost", "cs213user", "letmein", "namelist");
    
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
        
        } //while   
        
    echo "</pre></code>";
    echo "</body></html>";
    }
}

?>