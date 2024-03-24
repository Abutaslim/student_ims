<?php 
require '../vendor/autoload.php';
require '../inc/db.php';

    $reg_Num = @$_POST['reg_Num'];
    $type = $_POST['type'];
    


    // echo'mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm'.$program.$session;
    
    $sql = "SELECT * FROM tblstudent WHERE  reg_Number = '$reg_Num'  ";
    $rows = mysqli_num_rows(mysqli_query($dbc, $sql));
    if ($rows != 0) {
        $_SESSION['reg_Num'] = $reg_Num;
        
        if($type==1)
        {
            echo "<meta http-equiv='refresh' content = '0; url = pdf_id_card_reg.php'  target='_blank'/>";
            // echo "<meta http-equiv='refresh' content = '0; url=javascript:window.open('pdf_id_card_reg','_blank')/>";
                exit();
        }
        else
        {
            echo "<meta http-equiv='refresh' content = '0; url = pdf_id_card_reg2.php'  target='_blank'/>";
            // echo "<meta http-equiv='refresh' content = '0; url=javascript:window.open('pdf_id_card_reg','_blank')/>";
                exit();
        }
     
    } else 
    {
        $message = 'Student`s Record does not exist, change entries and try again';
        $alert = 'alert alert-danger alert-dismissible';
    }
    
  

?>