<?php
$name=$_POST['First name'];
$name=$_POST['Last name'];
$email=$_POST['email'];
$msg=$_POST['msg'];

if(!empty($First_name) ||!empty($Last_name) ||!empty($Email) ||!empty($Message) ){ 
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="contactdata";

    //create connection
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error(' .mysqli_connect_error(). ')'.mysqli_connect_error() );
    }else{
        $SELECT="SELECT Email From register where Email=? Limit=1";
        $INSERT="INSERT Into register(First_name, Last_name, msg) values(?,?,?,?)";

//Prepare statement
$stmt=$conn->prepare($SELECT);
echo$mysqli ->error;die;
$stmt -> bind_param(s,$email);
$stmt -> execute();
$stmt -> store_result();
$rnum = $stmt->num_rows;

if(rnum==0){
    $stmt->close();

    $stmt=$conn->prepare($INSERT);
    $stmt->bind_param("ssiiss",$First_name,$Last_name, $Email, $msg);
    $stmt->execute();
    echo" Your message is sent successfully!";
}else{
    echo"Someone already registered using this email";
    }
$stmt->close();
$conn->close();
    }

}else{
    echo"ALL fields are required.";
    die();
}





