<?php 

session_start();
require 'vendor/autoload.php';
require 'inc/db.php';


$mpdf =new  \Mpdf\Mpdf();

//     Logo
    
//     Move to the right
//     $this->Cell(80);
//     $this->Ln(23);
//     Title
    
//     $this->Ln();

//      $this->Cell(-30,10,'Department of Computer Science ',0,0,'');
//     Line break
//     $this->Ln(23);

// $mpdf->SetFont('Arial','I',15);
// $html = 'This is an id card';
$reg_Num = $_SESSION['reg_Num'];


$mpdf =new  \Mpdf\Mpdf(['mode'=>'utf-8', 'format'=>[85.6, 54],'margin_left'=>0, 'margin_bottom'=>0, 'margin_top'=>0, 'margin_right'=>0]);
$mpdf->Cell(20,5,'',0,0, '');
    //$mpdf->Image('pictures/08011111117.jpg',10,6,190);
    // Arial bold 15
    $mpdf->SetFont('Arial','B',15);
    // $mpdf->Cell(190,10,'CLASSIC TAILORING SERVICES ',0,0,'C');

    $query = "SELECT * FROM `tblstudent` where reg_Number = '$reg_Num'  "; 
    $result = mysqli_query($dbc,$query);
    //$html = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)) {
    	if (file_exists('student_imgs/'.$row['image_path'].'')) {

   
			$reg = $row['reg_number'];
			$q = "UPDATE `tblstudent` SET `status`= 1 WHERE `reg_number` = '$reg'";
			mysqli_query($dbc,$q);
			
	
	$mpdf->SetDefaultBodyCSS('background','url("imgs/bg_image.jpg")');
	$mpdf->SetDefaultBodyCSS('background-image-resize', 6);
	$html = '<style type="text/css">
   	 
	pass {
	
		border-radius: 10px;
	
		}
	   </style>
	   <div style="width: 100%;   border-style: solid; height: 100%;">
	<img style="width: 100%" src = "imgs/buk_header.jpg">
	<div style="width: 56%;font-size:13px;padding-left:5px;float: left; font-family: Britannic Bold; height: 100%">

		<img style="padding-left:60x;width:69.5px; height:69.5px; padding-top: 0px" src = "imgs/buk_logo.jpg">
		<br><br><b style="font-size:18;">'.$row['first_name'].'</b><br>	
		<b>'.$row['others'].'</b><br>
		'.strtoupper($row['reg_number']).'<br>
		<b>'.$row['course_of_study'].'</b>
	</div>
	<div style="width: 40%;padding-top:10px;padding-right:5px; float: right;border-style: solid;height: 100%;">
	<span style = "color: red; font-size: 12px; text-align: center"><span style="color:white;">-----</span>Student Id Card</span>
	<div style="width:150px; height:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border: radius 10px;">
		<img class= "pass" style="width:100%; height:100%;  " src = "student_imgs/'.$row['image_path'].'">
		</div>
	</div>
</div>';
	$mpdf->WriteHTML($html);
	
	$mpdf->AddPage();
	$mpdf->WriteHTML('<div style="background-color: white;text-align:justify; text-justify: inter-word; margin_left:5px; width: 100%; height:100%; padding-right: 5%; font-size: 10px;">
	<ol style="margin-bottom:0px;" >	
 		<li >This id card is to be used by the holder for his/her stay at Bayero University and not transferable, it must be carried along at all times and presented on demand</li>
 		<li>It must be returned to the Student Affair`s Office on termination of studentship</li>
 </ol>
 
 <table style= "font-size: 9px; margin-top:0px; width: 100%; margin-left:5px;">
		
		<tr >
			<td>Dean Student Affairs: <p> B/Group: '.$row['blood_group']. '</p><p>Guardian`s Phone: '.$row['nok_phone']. '</p> </td>
			<td style= "text-align: center"><b>IN CASE OF EMERGENCY<br>SECURITY OFFICE</b> <br>07042829723<br> 07042829724<br><b> HEALTH SERVICES</b><br> 08107596175<br> 08065464814 </td>
		</tr>
	</table>
	<div style= " margin-top:42px; ">
	<table style= "font-size: 8px; margin-top:0px; margin-left:5px;width: 100%">
		<tr>
		<td>Registrar`s Office No: 08160107570</td>
			<td style= "text-align: right;">Expiry Date: '.$row['exp_date'].'</td>
		</tr>
	</table>
</div>
 </div>
 
 ');

	
}

}


$mpdf->Output();



 ?>
 
 <p></p>
