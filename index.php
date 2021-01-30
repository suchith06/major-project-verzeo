<?php
$name=$_POST['name'];
$email=$_POST['email'];
$contact_number=$_POST['mob'];
$pincode=$_POST['pincode'];
$city=$_POST['city'];
$comments=$_POST['comm'];

if(!empty($Full_name) || !empty($Email) ||!empty($Contact_number) ||!empty($Pincode)||!empty($City) ){
    $host="localhost";
    $dbUsername="root";
    $dbPassword="";
    $dbname="booking database";

    //create connection
    $conn=new mysqli($host,$dbUsername,$dbPassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_error().')'.mysqli_connect_error());
    }else{
        $SELECT="SELECT Email From register where Email=? Limit=1";
        $INSERT="INSERT Into register(Full name,Contact number,Pincode,City,Comments) values(?,?,?,?,?)";
        
        //Prepare statement
        $stmt=$conn->prepare($SELECT);
        echo$mysqli ->error;die;
        $stmt->bind_param(s,$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if(rnum==0){
            $stmt->close();

            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("ssiiss",$Full_name,$Email,$Contact_number,$Pincode,$City,$Comments);
            $stmt->execute();
            echo"You are registered successfully!";
        }else{
            echo"Someone already registered using this email!";
        }
        $stmt->close();
        $conn->close();
    }


}else{
    echo"All fields are required.";
    die();
}


?>