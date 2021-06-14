<?php

/**
 * Copyright (C) 2013 peredur.net
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once '../includes/functions.php';
include_once '../includes/db_connect.php';
// CSRF Protection
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}


sec_session_start();





?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>OwnHealthRecord</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="../assets/css/animate.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="../assets/css/paper-dashboard.css" rel="stylesheet" />

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->

    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../assets/css/themify-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.0/css/all.css">



</head>

<body>
    <?php if (login_check($mysqli) == true) : ?>

        <div class="wrapper">
            <div class="sidebar" data-background-color="white" data-active-color="danger">

                <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text" style="color: #EB5E28;">
                            <?php echo htmlentities($_SESSION['username']); ?> <br> Medical Record
                        </a>
                    </div>

                    <ul class="nav">
                        <li class="active">
                            <a href="patient.php">
                                <i class="ti-user"></i>
                                <p>Patient</p>
                            </a>
                        </li>
                        <li>
                            <a href="medical-record.php">
                                <i class="ti-view-list-alt"></i>
                                <p>Medical Record</p>
                            </a>
                        </li>
                        <li>
                            <a href="doctors-list.php">
                                <i class="fas fa-user-md"></i>
                                <p>Doctor List</p>
                            </a>
                        </li>
                        <li>
                            <a href="medicine.php">
                                <i class="fas fa-pills"></i>
                                <p>Medicine</p>
                            </a>
                        </li>
                        <li>
                            <a href="medical-documents.php">
                                <i class="fas fa-file-upload"></i>
                                <p>Medical Documents</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#">Patient</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-panel"></i>
                                        <p>Statistics</p>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-bell"></i>
                                        <p class="notification">5</p>
                                        <p>Notifications</p>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Notification 1</a></li>
                                        <li><a href="#">Notification 2</a></li>
                                        <li><a href="#">Notification 3</a></li>
                                        <li><a href="#">Notification 4</a></li>
                                        <li><a href="#">Another notification</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="../includes/logout.php?csrf=$_SESSION['csrf_token']">
                                        <i class="ti-settings"></i>
                                        <p>logout</p>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>


                <div class="content">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">New Entry</h4>
                                        <p class="category">Here a new entry for the medicine is written</p>
                                    </div>
                                    <table class="table table-hover">
                                        <thead>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>DOB</th>
                                            <th>Address</th>
                                            <th>Blood Group</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <form action="../includes/insert-patient.php?csrf=$_SESSION['csrf_token']" method="post">
                                                    <td><input type="text" class="form-control" name="first_name" placeholder="First Name"></td>
                                                    <td><input type="text" class="form-control" name="last_name" placeholder="Last Name"></textarea></td>
                                                    <td><input type="date" class="form-control" name="dob" placeholder="DOB"></td>
                                                    <td><input type="text" class="form-control" name="address" placeholder="Address"></textarea></td>
                                                    <td><select name="blood_group" placeholder="Blood Group">
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="O+" selected>O+</option>
                                                            <option value="O-">O-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                        </select></td>
                                                    <td><input type="text" class="form-control" name="phone" placeholder="Phone"></textarea></td>
                                                    <td><input type="text" class="form-control" name="email" placeholder="Email"></td>
                                                    <td><button type="submit" class="btn btn-primary">Save entry</button></td>
                                                    <!-- CSRF Protection -->
                                                    <input type="hidden" name="csrf" value="'.$_SESSION['csrf_token'].'">

                                                </form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>









                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="header">
                                        <h4 class="title">Patients</h4>
                                        <p class="category">Here is the list of all your patients</p>
                                    </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover">
                                            <thead>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>DOB</th>
                                                <th>Address</th>
                                                <th>Blood Group</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                            </thead>
                                            <?php

                                            require "../includes/db_connect.php";

                                            $query = "SELECT id, first_name, AES_DECRYPT(first_name, $SECRET),last_name, AES_DECRYPT(last_name, $SECRET),dob, AES_DECRYPT(dob, $SECRET),
                                             address, AES_DECRYPT(address, $SECRET), blood_group, AES_DECRYPT(blood_group, $SECRET), phone, AES_DECRYPT(phone, $SECRET),
                                             email, AES_DECRYPT(email, $SECRET) FROM patient"; //You don't need a ; like you do in SQL
                                            $result = mysqli_query($connection, $query);


                                            while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
                                                $p_id = $row['id'];
                                                $record_query = "SELECT date,location, AES_DECRYPT(location, $SECRET),doctor_name, AES_DECRYPT(doctor_name, $SECRET),issue_description, AES_DECRYPT(issue_description, $SECRET),
                                                diagnosis, AES_DECRYPT(diagnosis, $SECRET),prescribed_solution,AES_DECRYPT(prescribed_solution, $SECRET)
                                                FROM medicalrecords mdr 
                                                  LEFT JOIN doctors d ON mdr.responsive_doctor = d.id 
                                                  LEFT JOIN patient p ON p.id = mdr.patient
                                                  WHERE p.id = $p_id
                                                  ";
                                                $record_result = mysqli_query($connection, $record_query);
                                                echo "<tbody id='".$row["id"]."'>";
                                                echo "<tr>";
                                                echo "<td>" . XSSdisarm($row["AES_DECRYPT(first_name, $SECRET)"]) . "</td>";
                                                echo "<td>" . XSSdisarm($row["AES_DECRYPT(last_name, $SECRET)"]) . "</td>";
                                                echo "<td>" . XSSdisarm($row["AES_DECRYPT(dob, $SECRET)"]) . "</td>";
                                                echo "<td>" . XSSdisarm($row["AES_DECRYPT(address, $SECRET)"]) . "</td>";
                                                echo "<td>" . XSSdisarm($row["AES_DECRYPT(blood_group, $SECRET)"]) . "</td>";
                                                echo "<td>" . XSSdisarm($row["AES_DECRYPT(phone, $SECRET)"]) . "</td>";
                                                echo "<td><a href=\"mailto:" . XSSdisarm($row["AES_DECRYPT(email, $SECRET)"]) . "\" target=\"_blank\">" . XSSdisarm($row["AES_DECRYPT(email, $SECRET)"]) . "</a></td>";
                                                echo "</tr>";
                                                echo "</tbody>";
                                                echo '
                                                <div id="modal-'.$row["id"].'"'." class='modal'>
                                                <div class='modal-content'>
                                                    <div>
                                                    <h4>
                                                    ". XSSdisarm($row["AES_DECRYPT(first_name, $SECRET)"])." ". XSSdisarm($row["AES_DECRYPT(last_name, $SECRET)"]). " Medical Records
                                                    </h4>
                                                    <span class='close'>&times;</span>
                                                    </div>
                                                    <div class='content table-responsive table-full-width'>
                                                    <div class='table table-hover'>
                                                        <div class='table-row'>
                                                            <h5 class='table-col'>Date</h5>
                                                            <h5 class='table-col'>Location</h5>
                                                            <h5 class='table-col'>Doctor treating</h5>
                                                            <h5 class='table-col'>Patient complaints</h5>
                                                            <h5 class='table-col'>Diagnosis</h5>
                                                            <h5 class='table-col'>Treatment</h5>
                                                        </div>";
                                                        while ($rrow = mysqli_fetch_array($record_result)) {   //Creates a loop to loop through results
                                                            echo "<div class='table-row'>";
                                                            echo "<p class='table-col data-text'>" . XSSdisarm($rrow['date']) . "</p>";
                                                            echo "<p class='table-col data-text'>" . XSSdisarm($rrow["AES_DECRYPT(location, $SECRET)"]) . "</p>";
                                                            echo "<p class='table-col data-text'>" . XSSdisarm($rrow["AES_DECRYPT(doctor_name, $SECRET)"]) . "</p>";
                                                            echo "<p class='table-col data-text'>" . XSSdisarm($rrow["AES_DECRYPT(issue_description, $SECRET)"]) . "</p>";
                                                            echo "<p class='table-col data-text'>" . XSSdisarm($rrow["AES_DECRYPT(diagnosis, $SECRET)"]) . "</p>";
                                                            echo "<p class='table-col data-text'>" . XSSdisarm($rrow["AES_DECRYPT(prescribed_solution, $SECRET)"]) . "</p>";
                                                            echo "</div>";
                                                        }
                                                echo "
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>";
                                            }
                                            mysqli_close($connection); //Make sure to close out the database connection
                                            ?>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <footer class="footer">

                </footer>


            </div>
        </div>
    <?php else : ?>
        <p>
            <span class="error">You are not authorized to access this page.</span> Please <a href="../index.php">login</a>.
        </p>
    <?php endif; ?>
</body>

<script>
    var rows = document.querySelectorAll("tbody");

    rows.forEach(row => {
        row.onclick = function(){
            var modal = document.getElementById(`modal-${row.id}`)
            var span = modal.getElementsByClassName("close")[0]
            modal.style.display = "block";
            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
            modal.style.display = "none";
            };
        // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            };
        }
    })

</script>

<!--   Core JS Files   -->
<script src="../assets/js/jquery-1.10.2.js" type="text/javascript"></script>

<script src="../assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="../assets/js/bootstrap-checkbox-radio.js"></script>

<!--  Charts Plugin -->
<script src="../assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="../assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!-- Paper Dashboard Core javascript and methods for Demo purpose -->
<script src="../assets/js/paper-dashboard.js"></script>

<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>


</html>