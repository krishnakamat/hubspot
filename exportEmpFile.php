<?php
include("config.php");

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=personal_details.csv");
header("Pragma: no-cache");
header("Expires: 0");


/*header('Content-Disposition: attachment; filename=personal_details.csv'); 
header('Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header('Content-Type: application/x-msexcel; charset=windows-1251; format=attachment;');*/
   // $msg="";

	
$expiredate = time() + 30;
$expireheader = "Expires: ".gmdate("D, d M Y G:i:s",$expiredate)." GMT";
header ($expireheader);

//$empID=$_POST['empID'];
//$empIDduplicate = array_unique($empID);
//foreach($empIDduplicate as $empIDs){
$query = "SELECT * FROM webadmin";
$result	= mysql_query($query) or die("Could not execute query");
$num 	= mysql_num_rows($result);
//}
for ($i=0;$i<$num;$i++){
	
//while($row = mysql_fetch_assoc($result)){
$str='"';
//$sno = $i+1;

//$str .= $sno.",";
//$str .= mysql_result($result,$i,"adminID");
$str .= mysql_result($result,$i,'empID');
$str .= '","';
$fullName = mysql_result($result,$i,"name");
$nameArray = explode(" ",$fullName);
$count = count($nameArray);
if($count == 1){
$str .= $nameArray[0].'","';	
$str .= ''.'","';
$str .= ''.'","';
}
if($count == 2){
$str .= $nameArray[0].'","';	
$str .= ''.'","';
$str .= $nameArray[1].'","';
}
if($count == 3){
$str .= $nameArray[0].'","';	
$str .= $nameArray[1].'","';
$str .= $nameArray[2].'","';
}
//$str .= mysql_result($result,$i,"name").'","';
//$str .= f.'","';
//$str .= l.'","';
//$str .=  'Cr'.",";
//$str .= 'SALARYTRANSFER'.$monthName.$year.",";
$str .= mysql_result($result,$i,"photograph").'","'; // FOR EXCEL SHEET , ==> +
$str .= mysql_result($result,$i,"gender").'","';
$str .= mysql_result($result,$i,"maritalStatus").'","';
$str .= mysql_result($result,$i,"dob").'","';
$str .= mysql_result($result,$i,"status").'","';
$str .= mysql_result($result,$i,"experience").'","';
$str .= mysql_result($result,$i,"employeeType").'","';
$str .= mysql_result($result,$i,"designation").'","';
$str .= mysql_result($result,$i,"userRole").'","';
$str .= mysql_result($result,$i,"join_date").'","';
$str .= mysql_result($result,$i,"correspondenceAddress").'","';
$str .= mysql_result($result,$i,"permanentAddress").'","';
$str .= mysql_result($result,$i,"mobileNum").'","';
$str .= mysql_result($result,$i,"secNum").'","';
$str .= mysql_result($result,$i,"emergencyNum").'","';
$str .= mysql_result($result,$i,"email").'","';
$str .= mysql_result($result,$i,"password").'","';
$str .= mysql_result($result,$i,"other_email").'","';

$str .= mysql_result($result,$i,"father_name").'","';
$str .= mysql_result($result,$i,"mother_name").'","';
$str .= mysql_result($result,$i,"PAN_Card").'","';
$str .= mysql_result($result,$i,"to_account").'","';
$str .= ''.'","';
$str .= mysql_result($result,$i,"name_in_bank").'","';
//$str .= mysql_result($result,$i,"teamLead").",";
//$str .= mysql_result($result,$i,"comments").",";
//$str .= mysql_result($result,$i,"lastlogin").",";
$str .= mysql_result($result,$i,"DOL").'"';
$aData[] = explode('+', $str);
//$allSum += $salSum;
//}
}



//feed the final array to our formatting function...
/*$contents = ",".",".","."Format for Salary / Reimbursement Up-load \n";
$contents .=",".",". ","."Company Name : The Web Plant Pvt. Ltd".",".",". " $searchedDate \n" ;
$contents .= "\n";;
//$contents .= "Student ID , Name , Score ID, Profession , Course Name , Exam ID , Processed Date ,Entry Date , Credits Earned , State , License  \n";
$contents .= "S No. , Employee Name (40 Character),Employee Account No. (14 characters) ,Debit /Credit(Dr./CR 2 Character) , Narration (as required by company 40 character), Amount (in Rs.14 character last 2 character for  decimals)  \n";//, Score ID, Processed Date*/
$contents .= getExcelData($aData);

/*$contents .="\n";
$contents .="\n";

$contents .=",".",".",".","."Total Amount of Debit \n" ;

$contents .=",".",".",".","."Total Number of Credit Entries".","."$sno \n";

$contents .=",".",".",".","."Total Amount of Credit ".","."$allSum".".00"." \n";

$contents .="\n";

$contents .=",".",".",".","."Authorised Representative(s)"." ";*/


//output the contents
echo $contents;
exit;
 
 
 function getExcelData($data){
    $retval = "";
    if (is_array($data)  && !empty($data))
    {
     $row = 0;

     foreach(array_values($data) as $_data){
      if (is_array($_data) && !empty($_data))
      {
          if ($row == 0)
          {
              // write the column headers
             // $retval = implode("\t", array_keys($_data));
              //$retval .= "\n";
          }
           //create a line of values for this row...
              $retval .= implode("\t",array_values($_data));
              $retval .= "\n";
              //increment the row so we don't create headers all over again
              $row++;
       }
     }
    }
  return $retval;
 }

 //array_keys($_data)
?>

<?php 
/*$qry = mysql_query("SELECT * FROM webadmin");
$data = "";
while($row = mysql_fetch_array($qry)) {
  $data .= .".$row['empID']."",".$row['name'].",m,l,".$row['photograph'].",".$row['gender'].",".$row['maritalStatus'].",".$row['dob'].",".$row['status'].",".$row['experience'].",".$row['employeeType'].",".$row['designation'].",".$row['userRole'].",".$row['join_date'].",".str_replace(',',' ',$row['correspondenceAddress']).",".str_replace(',',' ',$row['permanentAddress']).",".$row['mobileNum'].",".$row['secNum'].",".$row['emergencyNum'].",".$row['email'].",".$row['password'].",".$row['other_email'].",".$row['father_name'].",".$row['mother_name'].",".$row['PAN_Card'].",".$row['to_account'].",8,".$row['name_in_bank'].",".$row['DOL']."\n";
}

header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="filename.csv"');
echo $data; exit();*/
?>