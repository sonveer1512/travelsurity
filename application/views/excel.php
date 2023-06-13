<?php 

// to get today's date
date_default_timezone_set('Asia/Kolkata');
$date = date("d-m-Y H:i:s");

// filename to save the filename according to the need
@header("Content-Disposition: attachment; filename=travelsurity(".$date.").csv");

// for column names (comma is used for different cells in a row)



$data = "S. No., Name, Email, Mobile"."\n";


// query to fetch data in the excel
/*$query = "SELECT u.name userName, u.email email, u.mobile mobile, ur.totalQuestions totalQuestions, ur.rightAnswers rightAnswers, ur.wrongAnswers wrongAnswers, ur.unattemptedAnswers unattemptedAnswers, ur.attemptedAnswers attemptedAnswers, ur.percentage percentage, ur.create_date createDate, c.category category FROM user_result ur JOIN users u ON u.id = ur.userId JOIN category c on ur.category = c.id ORDER BY ur.id DESC" ;
$result = mysqli_query($conn, $query);*/

// loop to get multiple rows and make sure to write this w.r.t. the column names, else data will be mismatched

$i = 0;
foreach($custDtaData as $value)
{
    $i++;
    
    $data.= $i.",";
    $data.= $value['cname'].",";
    $data.= $value['cmail'].",";
    $data.= $value['cmobile']."\n";
}


// to print the data in the excel
echo $data;

// because we just need to download the excel file, so need to open this file
exit();

?>

