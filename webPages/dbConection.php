<?php
    
    $servername =  "localhost:3306"; //"sql213.epizy.com";// "localhost:3306"; // "sql109.epizy.com";
    $username   = "root";//"epiz_25912943";//"root";//"epiz_25692832";
    $password   = "";//"iaLuY4goZUi"; //"12345";//"pIT3KO8VsnSmouZ";
    $db         = "dfm";//"epiz_25912943_dfm";//"dfm";//"epiz_25692832_dfm";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Check connection
    if (mysqli_connect_error($conn)) 
    {
        echo mysqli_error($conn)." Not Connected successfully<br><br>";
        die();
    } 

?>
