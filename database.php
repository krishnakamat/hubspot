<html>
<head>
<title>Sending attachment using PHP</title>
</head>
<body>
<?php
  $today=date('Y-m-d');
  //$to = "krishnakumarkamat@gmail.com,deepti@thewebplant.com,vikram@thewebplant.com";
    $to = "krishnakumarkamat@gmail.com";
  $subject = "Hubspot Tracking Sheet Database $today";
  $message = "Please Find the attached sql file for database.";
  # Open a file

  $file = fopen( "db-backup-Data-$today.sql", "r" );
  if( $file == false )
  {
     echo "Error in opening file";
     exit();
  }
  # Read the file into a variable
  $size = filesize("db-backup-Data-$today.sql");
  $content = fread( $file, $size);

  # encode the data for safe transit
  # and insert \r\n after every 76 chars.
  $encoded_content = chunk_split( base64_encode($content));
  
  # Get a random 32 bit number using time() as seed.
  $num = md5( time() );

  # Define the main headers.
  $header = "From:krishna@thewebplant.in\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-Type: multipart/mixed; ";
  $header .= "boundary=$num\r\n";
  $header .= "--$num\r\n";

  # Define the message section
  $header .= "Content-Type: text/plain\r\n";
  $header .= "Content-Transfer-Encoding:8bit\r\n\n";
  $header .= "$message\r\n";
  $header .= "--$num\r\n";

  # Define the attachment section
  $header .= "Content-Type:  multipart/mixed; ";
  $header .= "name=\"db-backup-Data-$today.sql\"\r\n";
  $header .= "Content-Transfer-Encoding:base64\r\n";
  $header .= "Content-Disposition:attachment; ";
  $header .= "filename=\"db-backup-Data-$today.sql\"\r\n\n";
  //$header .= "$encoded_content\r\n";
  $header .= "--$num--";

  # Send email now
  $retval = mail ( $to, $subject, "", $header );

  if( $retval == true )
   {

      echo "Message sent successfully...";
      
      echo $today=date('Y-m-d');
      echo "<br/>";
      echo $countFile = count(glob('*.sql'));
      echo "<br/>";
      echo $backFiveDate = date("Y-m-d",strtotime("-4 days",strtotime($today)));
      echo "<hr/>";
      for($i=0; $i<$countFile-5; $i++){
          echo "<br/>";
          echo $backFiveDate = date("Y-m-d",strtotime("-1 days",strtotime($backFiveDate)));
                  unlink("db-backup-Data-$backFiveDate.sql");
      }
     echo "<script> location.href='ssbData.php' </script>";

   }
   else
   {
      echo "Message could not be sent...";
   }
?>
</body>
</html>