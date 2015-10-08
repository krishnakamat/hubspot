<?php
include("config.php");
   
        // Is there a posted query string? 
        if(isset($_POST['queryString'])) { 
             $queryString = $_POST['queryString']; 
            // Is the string length greater than 0? 
            if(strlen($queryString) >0) { 
                $query = mysql_query("SELECT * FROM webadmin WHERE name LIKE '$queryString%' and employeeType = 1 and userRole='3' and status='1' LIMIT 10"); 
                if($query) { 
                    while ($result = mysql_fetch_array($query)) { 
                         echo '<li onClick="fill(\''.$result['name'].'\','.$result['adminID'].');">'.$result['name'].'</li>'; 
                     } 
                } else { 
                    echo 'ERROR: There was a problem with the query.'; 
                } 
            } else { 
            } // There is a queryString. 
        } else { 
            echo 'There should be no direct access to this script!'; 
        } 
    
?>