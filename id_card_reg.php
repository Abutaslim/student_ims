<?php
//session_start();
include 'inc/db.php';
$page = "coordinator";
include 'inc/top-menu.php';

$page = 'course';
include 'inc/aside.php';

if (isset($_POST['submit'])) {

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
    
  }
  //include 'footer.php';
 

// if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == 'POST') {
//     $reg_Num = $_POST['reg_Num'];
//     $name = $_POST['name'];
//     $gender = $_POST['gender'];
//     $p_num = $_POST['p_num'];
//     $course_enrol_id = $_POST['course_enrol_id'];
//     $email = $_POST['email'];
//     $agency = $_POST['agency'];
//     $rank = $_POST['rank'];

   
//     // if (!empty($reg_num) and !empty($gender) and !empty($name)) {
//         $sql = "INSERT INTO `tblstudent`(`reg_number`, `name`, `phone`, `email`, `agency`, `rank`, `gender`, `course_enrol_id`) VALUES 
//         ('$reg_Num','$name','$p_num','$email','$agency','$rank','$gender','$course_enrol_id')";
//         $result = mysqli_query($dbc, $sql);
//         if (mysqli_affected_rows($dbc) == 1) {
//             $message = 'Record Added Successfully';
//             $alert = 'alert alert-info alert-dismissible';
//         } else {
//             $message = 'Something went wrong, try again';
//             $alert = 'alert alert-danger alert-dismissible';
//         }
//     }
//}



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Form for generating of Students ID cards</h1>

                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <div class="col-sm-12">
                    <!-- message -->
                    <?php
                    //  echo $status;
                    //  echo $course_name;
                    //  echo $duration;
                    //  echo $category;
                    //  echo $gender;
                    if (!empty($message)) {
                        echo '<div style="width:100%; margin-left:0%">
                            <div class="' .$alert .'"><button type="button" class="close" data-dismiss="alert"
                        aria-hidden="true">&times;</button><h5><i class="icon fas fa-info"></i> Alert!</h5>' .$message .
                            '</div></div>';
                    }

                    if(isset($_SESSION['no_image']))
                    if (!empty($_SESSION['no_image']=='Y')) {
                        $alert = 'alert alert-danger alert-dismissible';
                    echo '<div style="width:100%; margin-left:0%">
                          <div class="' .$alert .'">
                              <button type="button" class="close" data-dismiss="alert"
                                  aria-hidden="true">&times;</button>
                              <h5><i class="icon fas fa-info"></i> Alert!</h5>
                              No Image Found for '.$_SESSION['reg_Num'].'
                          </div>
                      </div>';
                      $_SESSION['no_image']='';
                     $reg_Num = $_SESSION['reg_Num'];
                     $_SESSION['reg_Num'] = '';
                    }
                    
                    if(isset($_SESSION['no_image']))
                    if (!empty($_SESSION['no_image']=='N')) {
                        $alert = 'alert alert-success alert-dismissible';
                    echo '<div style="width:100%; margin-left:0%">
                          <div class="' .$alert .'">
                              <button type="button" class="close" data-dismiss="alert"
                                  aria-hidden="true">&times;</button>
                              <h5><i class="icon fas fa-info"></i> Alert!</h5>
                              ID Card Generated for '.$_SESSION['reg_Num'].'
                          </div>
                      </div>';
                      $_SESSION['no_image']='';
                     $reg_Num = $_SESSION['reg_Num'];
                     $_SESSION['reg_Num'] = '';
                    }
                    ?>
                    <!-- end of message -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">ID Cards by Registration Number</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="" id="id_car_check" name="id_car_check">
                            <div class="card-body">
                               
                        <div class="form-group" >
                        <label for="passenger">Registration Number:</label>
                       
                        <input type="text" class="form-control" id="reg_Num" value ="<?php if(isset($reg_Num)) {echo $reg_Num;}?>" placeholder="Enter Registration Number" name='reg_Num'>
                                
                    
                        </div>
                        <div class="form-group" >
                            <label for="">Type</label>
                           <select name="type" id="" class="form-control" name = 'type'>
                            <option value="1">First</option>
                            <option value="2">Second</option>

                           </select>
                        </div>       
                      </div>
                                
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button> &nbsp<a class="btn btn-info" href="courses_his.php">Back</a>
                            </div>
                        </form>
                    </div>
                    <div id = 'note'></div>
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
                // alert("dd");
               
                $(document).ready(function() {
// alert("sd");
                                // login
                    var form = $('#id_car_check'); // batch result form
                    var submit = $('#submit'); // batch submit button
                    var note = $('#note'); // r show alert message for batch result
                    // form submit event for session
                    submit.on('click', function(e) {
                        e.preventDefault(); // prevent default form submit
                        $.ajax({
                            url: 'process\\process_single_id_card.php', // form action url
                            type: 'POST', // form submit method get/post
                            //dataType: 'html', // request type html/json/xml
                            data: form.serialize(), // serialize form data
                            beforeSend: function() {
                                //alert.fadeOut();
                                submit.html('Generating....'); // change submit button text
                            },
                            success: function(data) {
                                note.html(data).fadeIn(); //fade in response data
                                submit.html('Submit'); // change submit button text

                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    });


                });
            </script>
<?php include 'inc/footer.php'; ?>