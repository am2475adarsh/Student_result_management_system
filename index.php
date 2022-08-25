<?php
session_start();
include('config/db_connect.php');


$sql = "SELECT * FROM student_details";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $data = array();
    array_push($data, '[{}');
    while ($user_data = mysqli_fetch_assoc($result)) {
        array_push($data, ',');
        array_push($data, json_encode(($user_data)));
    }
    array_push($data, ']');
    $data = implode($data);
}


if (isset($_POST['submit'])) {

    // "mysqli_real_escape_string" this helps unwanted or harmful data to get into our database
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $regno = mysqli_real_escape_string($conn, $_POST['regno']);
    $university = mysqli_real_escape_string($conn, $_POST['university']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $subcourse = mysqli_real_escape_string($conn, $_POST['subcourse']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $stu_result = mysqli_real_escape_string($conn, $_POST['result']);


    $sql = "SELECT * FROM student_details where regno= '$regno'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        if ($user_data['regno'] == $regno) {

            $regno_error = 1;
        }
    } else {
        //create sql


        //save to db and check
        if (mysqli_query($conn, $sql)) {

            $fullname = $_SESSION['stu_fullname'] = $_POST['fullname'];
            $regno = $_SESSION['stu_regno'] = $_POST['regno'];
            $university = $_SESSION['stu_univ'] = $_POST['university'];
            $course = $_SESSION['stu_course'] = $_POST['course'];
            $subcourse = $_SESSION['stu_sub_course'] = $_POST['subcourse'];
            $batch = $_SESSION['stu_batch'] = $_POST['batch'];
            $stu_result = $_SESSION['stu_results'] = $_POST['result'];

            //success
            $succes = 1;
            $sql = "INSERT INTO student_details(univ,course,subcourse,batch,student,result,res_status,regno ) VALUES('$university','$course','$subcourse','$batch','$fullname','$stu_result','unconfirmed' , '$regno')";
            mysqli_query($conn, $sql);
        } else {
            //error
            echo 'query error' . mysqli_error($conn);
        }

        //echo 'form is valid';
    }
}

// For updating records
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $_GET['result'];
    $status = $_GET['status'];
    $sql = "UPDATE student_details SET result=$result, res_status='$status' where id = $id ";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
</head>

<body>

    <section class="panel">
        <div class="panel_title">Institute Management</div>
        <div class="list">

            <div class="details active" id="results" onclick="myfunc(this.id)"> <i class="fa fa-graduation-cap" aria-hidden="true" style="position: absolute;left:20px;"></i>Student Result

            </div>
            <div class="details" id="student_det" onclick="myfunc(this.id)"> <i class="fa fa-database" aria-hidden="true" style="position: absolute;left:20px;"></i>Add Details

            </div>

            <!-- <div class="details" id="dashboard" onclick="myfunc(this.id)"> <i class="fa fa-desktop" aria-hidden="true" style="position: absolute;left:20px;"></i>
                Dashboard

            </div> -->



        </div>

    </section>
    <section class="main">
        <nav>2022-2023</nav>
        <div class="container active2" id="resultscont" style="margin-top: 50px;">
            <form method="post" autocomplete="on">
                <!--First name-->
                <div class="box">
                    <label for="fullname" class="fl fontLabel"> Full Name: </label>
                    <div class="new iconBox">
                        <i class="fa fa-font" aria-hidden="true" style="font-size: 14px;"></i>
                    </div>
                    <div class="fr">
                        <input type="text" name="fullname" placeholder="Full Name" class="textBox" autofocus="on" required>
                    </div>
                    <div class="clr"></div>
                </div>
                <!--First name-->


                <div class="box">
                    <label for="regno" class="fl fontLabel"> Reg no: </label>
                    <div class="new iconBox">
                        <i class="fa fa-id-badge" aria-hidden="true" style="font-size: 14px;"></i>
                        </i>
                    </div>
                    <div class="fr">
                        <input type="text" name="regno" placeholder="Register No" class="textBox" autofocus="on" required>
                    </div>
                    <div class="clr"></div>
                </div>

                <!--Second name-->
                <div class="box">
                    <label for="university" class="fl fontLabel"> University: </label>
                    <div class="fl iconBox"><i class="fa fa-university" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <input type="text" required name="university" placeholder="University" class="textBox">
                    </div>
                    <div class="clr"></div>
                </div>
                <!--Second name-->


                <!---Phone No.------>
                <div class="box">
                    <label for="course" class="fl fontLabel"> Course: </label>
                    <div class="fl iconBox"><i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <input type="text" required name="course" placeholder="Course" class="textBox">
                    </div>
                    <div class="clr"></div>
                </div>
                <!---Phone No.---->


                <!---Email ID---->
                <div class="box">
                    <label for="subcourse" class="fl fontLabel"> Sub Course: </label>
                    <div class="fl iconBox"><i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <input type="text" required name="subcourse" placeholder="Sub Course" class="textBox">
                    </div>
                    <div class="clr"></div>
                </div>
                <!--Email ID----->


                <!---Password------>
                <div class="box">
                    <label for="batch" class="fl fontLabel"> Batch </label>
                    <div class="fl iconBox"><i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <input type="text" required name="batch" placeholder="Batch" class="textBox">
                    </div>
                    <div class="clr"></div>
                </div>
                <!---Password---->

                <!---Gender----->
                <div class="box">
                    <label for="result" class="fl fontLabel"> Result </label>
                    <div class="fl iconBox"><i class="fa fa-certificate" aria-hidden="true"></i>
                    </div>
                    <div class="fr">
                        <input type="number" required name="result" placeholder="Result" class="textBox">
                    </div>
                    <div class="clr"></div>
                </div>
                <!---Gender--->


                <!---Submit Button------>
                <div class="box" style="background: #2d3e3f">
                    <input type="Submit" name="submit" class="submit" value="SUBMIT">
                </div>
                <!---Submit Button----->
            </form>
        </div>

        <div class="container" id="student_detcont">

            <div class="title_nav">Student Result Status</div>




            <div class="mainstatus">

                <p style="background: #384162;padding:1rem; color:white;font-size:18px;font-weight:bold;font-family:sans-serif">Student Result Status</p>


                <!-- <form action="" method="POST"> -->



                <form method="post" onsubmit="return false" autocomplete="on">

                    <div style="margin:30px; margin-left:100px;">
                        <label for="university">Enter University Name :</label>

                        <input type="text" name="univ" id="univ" onkeypress="tableShow(1)" onkeyup="tableShow(1)" onkeydown="tableShow(1)" onchange="tableShow(1)" style="width:20%; margin-left:10px">

                        <button class="excel" onclick="exportData()" style="margin-left: 85px;"><i class="fa fa-file-excel-o" aria-hidden="true" style="background-color:green ; color:black;font-size:15px;border:0px;font-weight:900px"></i>&nbsp;&nbsp;
                            Export / Download to Excel
                        </button>&nbsp;<i class="fa fa-download" aria-hidden="true" style="font-size:13px;"></i>


                        <button class="butt_on" onclick="window.location.reload();" style="float:right">Refresh</button>

                        <br>*(Case Sensitive)

                        <button class="butt_on" id="search" onclick="tableShow(1)" style="margin-left:100px; margin-top:10px; ">Search</button>


                    </div>


                    <table id='table' cellpadding='0' , cellspacing='0' and border='0' ;>

                        <tr style='font-weight:bold;font-size:17px;color:#349fb0;height:10%;'>
                            <th>SNo.</th>
                            <th>Full Name</th>

                            <th>Registration No.</th>

                            <th>University</th>
                            <th>Course</th>
                            <th>Sub Course</th>
                            <th>Result</th>
                            <th>Result Status</th>


                        </tr>

                        <!-- <php
                        include('config/db_connect.php');
                        $i = 0;
                        $sql = "SELECT * FROM student_details";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {

                            while ($user_data = mysqli_fetch_assoc($result)) {
                                $i++;
                                echo "<tr style='color:rgb(0,0,0,0.9)'>";

                                echo "<td style='text-align:center'>" . $i . "</td>";


                                echo " <td style='text-align:center'>"  . $user_data['student'] . "</td>";
                                // echo "<td style='text-align:center'>"  . $user_data['regno'] . "</td>";
                                echo "<td style='text-align:center'><input type='hidden' id='" . $user_data['id'] . "' value='" . $user_data['id'] . "' name='id'/>" . $user_data['regno'] . "</td>";
                                echo "<td style='text-align:center'>" . $user_data['univ'] . "</td>";
                                echo "<td style='text-align:center'>" . $user_data['course'] . "</td>";
                                echo "<td style='text-align:center'>" . $user_data['subcourse'] . "</td>";
                                echo "<td style='text-align:center'><input id='" . $user_data['id'] . 'abc' . "' value='" . $user_data['result'] . "' name='marks'/></td>";
                                echo strcmp($user_data['res_status'], 'confirmed') ?
                                    "<td style='text-align:center'><select name='status' id='" . $user_data['id'] . 'def' . "'>
                            <option value='unconfirmed'>unconfirmed</option>
                            <option value='confirmed'>confirmed</option>
                          </select></td>"
                                    :
                                    "<td style='text-align:center'><select name='status' id='" . $user_data['id'] . 'def' . "'>
                            <option value='confirmed'>confirmed</option>
                            <option value='unconfirmed'>unconfirmed</option>
                          </select></td>";
                                echo "<td><div class='edit_button' onclick='jujj(" . $user_data['id'] . ")'>Edit</div></td></tr>";


                                // echo "</tr>";
                            }
                        } else {
                            echo "RESULT : 0";
                        }
                        ?> -->
                    </table>
                </form>
            </div>
        </div>
        <!-- 
        <div class="container" id="dashboardcont" style=" background-color:aliceblue">
            <h1>Hello</h1>
        </div> -->



    </section>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="script.js"></script>

<script>
    let data;
    document.addEventListener('DOMContentLoaded', () => {
        data = JSON.parse('<?php echo $data ?>');
        tableShow(0);
    })
</script>

</html>