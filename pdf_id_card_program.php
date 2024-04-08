<?php 

session_start();
require 'vendor/autoload.php';
require 'inc/db.php';


$mpdf =new  \Mpdf\Mpdf();


$program = $_SESSION['program'];
$session = $_SESSION['session'];
$mpdf =new  \Mpdf\Mpdf(['mode'=>'utf-8', 'format'=>[85.6, 54],'margin_left'=>0, 'margin_bottom'=>0, 'margin_top'=>0, 'margin_right'=>0]);
$mpdf->Cell(20,5,'',0,0, '');
    //$mpdf->Image('pictures/08011111117.jpg',10,6,190);
    // Arial bold 15
    $mpdf->SetFont('Arial','B',15);
    // $mpdf->Cell(190,10,'CLASSIC TAILORING SERVICES ',0,0,'C');

    $query = "SELECT * FROM `tblstudent` where course_of_study = '$program' and `session` = '$session' "; 
    $result = mysqli_query($dbc,$query);
    //$html = mysqli_num_rows($result);
    while ($row = mysqli_fetch_array($result)) {
		$image = $row['photo'];
		if ($row['photo'] != '') {
			
		
    	if (file_exists('student_imgs/'.$row['photo'].'')) {
			
			$reg = $row['reg_number'];
			$q = "UPDATE `tblstudent` SET `status`= 1 WHERE `reg_number` = '$reg'";
			mysqli_query($dbc,$q);
			
			$mpdf->SetDefaultBodyCSS('background','url("imgs/bg_image_demo2.jpg")');
	$mpdf->SetDefaultBodyCSS('background-image-resize', 6);
	$html = '<style type="text/css">
   	 
	pass {
	
		border-radius: 10px;
	
		}
	   </style>
	   <div style="width: 100%;   border-style: solid; height: 100%;">
	<img style="width: 100%" src = "imgs/header_demo2.jpg">
	<div style="width: 56%;font-size:13px;padding-left:5px;float: left; font-family: Britannic Bold; color:white; height: 100%">

		<img style="padding-left:60x;width:69.5px; height:69.5px; padding-top: 0px" src = "imgs/logo_demo.jpg">
		<br><br><b style="font-size:18;">'.$row['first_name'].'</b><br>	
		<b>'.$row['others'].'</b><br>
		'.strtoupper($row['reg_number']).'<br>
		<b>'.$row['course_of_study'].'</b>
	</div>
	<div style="width: 40%;padding-top:10px;padding-right:5px; float: right;border-style: solid;height: 100%;">
	<span style = "color: red; font-size: 12px; text-align: center"><span style="color:white;">-----</span>Student Id Card</span>
	<div style="width:150px; height:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border: radius 10px;">
		<img  style="width:100%; height:100%;  " src = "student_imgs/'.$image.'">
		</div>
	</div>
</div>';
	$mpdf->WriteHTML($html);
	
	$mpdf->AddPage();

	$text = $row['first_name'].''.$row['reg_number'];

	$barcodeText = trim($text);
	$barcodeType='code128';
	$barcodeDisplay='horizontal';
	$barcodeSize=30;
	$printText=true;
	
	$mpdf->WriteHTML('<div style="background-color: white;text-align:justify; text-justify: inter-word; margin_left:5px; width: 100%; height:100%; padding-right: 5%; font-size: 8px;">
	<ol style="margin-bottom:0px;" >	
 		<li >This id card is to be used by the holder for his/her stay at Bayero University and not transferable, it must be carried along at all times and presented on demand</li>
 		<li>It must be returned to the Student Affair`s Office on termination of studentship</li>
 </ol>
 
 <table style= "font-size: 7px;  margin-top:0px; width: 100%; margin-left:5px;">
		
		<tr >
			<td>Dean Student Affairs: <p> B/Group: '.$row['blood_group']. '</p><p>Guardian`s Phone: 08000000000</p> </td>
			<td style= "text-align: center"><b>IN CASE OF EMERGENCY<br>SECURITY OFFICE</b> <br>08000000000<br>08000000000<br><b> HEALTH SERVICES</b><br> 08000000000<br> 08000000000 </td>
		</tr>
		<tr >
			<td colspan= "2"><img class=əbarcodeə alt="'.$barcodeText.'" src="barcode.php?text='.$barcodeText.'&codetype='.$barcodeType.'&orientation='.$barcodeDisplay.'&size='.$barcodeSize.'&print='.$printText.'"/> </td>
		</tr>
	</table>
	<div style= " margin-top: 40; "> 
	
	
	<table style= "font-size: 8px; margin-top:0px; margin-left:5px;width: 100%">
		<tr>
		<td>Registrar`s Office No: 08000000000</td>
			<td style= "text-align: right;">Expiry Date: '.$row['exp_date'].'</td>
		</tr>
	</table>
</div>');
	
	$mpdf->WriteHTML('
 </div>
 
 ');

}

}

	}
$mpdf->Output();


 ?>
 

		
