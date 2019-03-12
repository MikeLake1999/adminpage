<?php 
session_start();

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: admin-login-page.php');
}

?>
<?php
include 'admin.php';
$admin_obj = new Admin();
$admin_list = $admin_obj->admin_list();

if (isset($_POST['create_admin'])) {
  $admin_obj->create_admin_info($_POST);
}

if (isset($_GET['id'])) {
    $admin_info = $admin_obj->view_admin_by_admin_id($_GET['id']);
    if (isset($_POST['update_admin']) && $_GET['id'] === $_POST['id']) {
      $admin_obj->update_admin_info($_POST);
    }
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>EDM NEWS</title>

    <!-- Favicons -->
    <link href="https://loopcentral.net/wp-content/uploads/2018/01/loopcentral-logo-150x110.png" rel="icon">
    <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Bootstrap core CSS -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--external css-->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <script src="lib/chart-master/Chart.js"></script>

    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>





    <style>
        .success {
            color: #3c763d;
            background: #dff0d8;
            border: 1px solid #3c763d;
            margin-bottom: 20px;
        }

        .button {

            border: none;
            color: white;
            padding: 6px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }

        .button:hover {
            text-decoration: none;
            color: white;
            opacity: 0.8;

        }

        .button-blue {
            background-color: #0000FF;
        }

        /* Blue */
        .button-red {
            background-color: #FF0000;
        }

        /* Red */
        .button-green {
            background-color: #008000;
        }

        /*Green */
        .button-purple {
            background-color: purple;
        }

        /*purple  */
        .custom-alert {
            font-size: 16px;
            font-weight: bold;
            color: white;
            padding: 6px;
            margin: 2px;
            background: green;
            border: 1px solid transparent;
            border-radius: unset;
        }

        .content {
            width: 30%;
            margin: 0px auto;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 0px 0px 10px 10px;
        }
    </style>

</head>

<body>
    <section id="container">
        <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
        <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title=""></div>
            </div>
            <!--logo start-->
            <a href="admin-homepage.php" class="logo"><b>Loop<span>Central</span></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">

            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="index.php?logout='1'">Logout</a></li>
                </ul>
            </div>
        </header>
        <!--header end-->
        <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
                    <h5 class="centered"><?php echo "<p class='error'>" . $_SESSION['username'] . "</p>"; ?></h5>
                    <li class="mt">
                        <a href="admin-homepage.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sub-menu">
                        <a class="active" href="javascript:;">
                            <i class="fa fa-th"></i>
                            <span>Data Tables</span>
                        </a>
                        <ul class="sub">
                            <li class="active"><a href="admin-manager.php">Admin Manager</a></li>
                            <li><a href="post-manager.php">Post Manager</a></li>
                        </ul>
                    </li>
            </div>
        </aside>


        <!--footer end-->
    </section>
    <section id="main-content" class="">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Admin Manager<button type="button" class="button button-purple mt-12 pull-right" data-toggle="modal" data-target="#myModal">Create Admin</button> </h3>
            <div class="row mt">
                <?php
                if (isset($_SESSION['message'])) {
                  echo "<p class='custom-alert'>" . $_SESSION['message'] . "</p>";
                  ?>
                <meta http-equiv="refresh" content="0.5; url=" <?php echo $_SERVER['PHP_SELF']; ?>">
                <?php
                unset($_SESSION['message']);
              }
              ?>
                <!-- page start-->
                <div class="content-panel col-lg-12">
                    <div class="table table-striped table-condensed container">

                        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="display table table-bordered" id="hidden-table-info">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th class="hidden-phone">Admin Account</th>
                                    <th class="hidden-phone">Phone</th>
                                    <th class="hidden-phone">Active</th>
                                    <th class="hidden-phone">Register Date</th>
                                    <th class="hidden-phone"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($admin_list->num_rows > 0) {
                                  while ($row = $admin_list->fetch_assoc()) {
                                    ?>
                                <tr>
                                    <td><?php echo $row["AdminID"] ?></td>
                                    <td><?php echo $row["NameAdmin"] ?></td>
                                    <td class="hidden-phone"><?php echo $row["AdminName"] ?></td>
                                    <td class="center hidden-phone"><?php echo $row["Phone"] ?></td>
                                    <td class="center hidden-phone"><?php if ($row["Active"] == 1) {
                                                                      echo 'Working';
                                                                    } else if ($row["Active"] == 0) {
                                                                      echo 'Stop Working';
                                                                    } ?></td>
                                    <td class="center hidden-phone"><?php echo $row["regdate"] ?></td>
                                    <td class="">
                                        <a href="<?php echo 'update-admin-manager.php?id=' . $row["AdminID"] ?>" class="button button-blue">Update</a>
                                    </td>
                                </tr>

                                <?php

                              }
                            }
                            ?>

                            </tbody>
                        </table>

                    </div>

                </div>

                <!-- page end-->
            </div>
            <!-- /row -->
        </section>
        <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->

    <!--footer end-->
    </section>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="lib/jquery.scrollTo.min.js"></script>
    <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>

    <!--common script for all pages-->
    <script src="lib/common-scripts.js"></script>
    <!--script for this page-->
    <script type="text/javascript">
        /* Formating function for row details */
        function fnFormatDetails(oTable, nTr) {
            var aData = oTable.fnGetData(nTr);
            var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
            sOut += '<tr><td>ID:</td><td>' + '&nbsp' + aData[1];
            sOut += '<tr><td>Admin Name:</td><td>' + '&nbsp' + aData[2];
            sOut += '<tr><td>Admin Account:</td><td>' + '&nbsp' + aData[3];
            sOut += '<tr><td>Phone:</td><td>' + '&nbsp' + aData[4];
            sOut += '<tr><td>Active:</td><td>' + '&nbsp' + aData[5];
            sOut += '<tr><td>Register Date:</td><td>' + '&nbsp' + aData[6];
            sOut += '</table>';

            return sOut;
        }

        $(document).ready(function() {
            /*
             * Insert a 'details' column to the table
             */
            var nCloneTh = document.createElement('th');
            var nCloneTd = document.createElement('td');
            nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
            nCloneTd.className = "center";

            $('#hidden-table-info thead tr').each(function() {
                this.insertBefore(nCloneTh, this.childNodes[0]);
            });

            $('#hidden-table-info tbody tr').each(function() {
                this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
            });

            /*
             * Initialse DataTables, with no sorting on the 'details' column
             */
            var oTable = $('#hidden-table-info').dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0]
                }],
                "aaSorting": [
                    [1, 'asc']
                ]
            });

            /* Add event listener for opening and closing details
             * Note that the indicator for showing which row is open is not controlled by DataTables,
             * rather it is done here
             */
            $('#hidden-table-info tbody td img').live('click', function() {
                var nTr = $(this).parents('tr')[0];
                if (oTable.fnIsOpen(nTr)) {
                    /* This row is already open - close it */
                    this.src = "lib/advanced-datatable/media/images/details_open.png";
                    oTable.fnClose(nTr);
                } else {
                    /* Open this row */
                    this.src = "lib/advanced-datatable/images/details_close.png";
                    oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
                }
            });
        });
    </script>
    <!-- Modal Fade -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content " style="margin-top: 80px;">
                <div class="modal-header black-bg">
                    <button type="button" class="close" style="color:white;" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title ">Create Admin</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="admin_ID">ID:</label>
                            <input type="text" name="admin_ID" id="admin_ID" class="form-control" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="admin_Name">Admin Name:</label>
                            <input class="form-control" name="admin_Name" id="admin_Name" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="name_Admin">Admin Account:</label>
                            <input class="form-control" name="name_Admin" id="name_Admin" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="admin_Password">Password:</label>
                            <input class="form-control" name="admin_Password" id="admin_Password" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" class="form-control" maxlength="50">

                        </div>
                        <div class="form-group">
                            <label for="active">Active:</label>
                            <select class="form-control" name="active" id="active">
                                <option value="0" selected>Select</option>
                                <option value="1">- Active</option>
                                <option value="0">- Inactive</option>
                            </select>
                        </div>

                        <input type="submit" class="button button-green" name="create_admin" value="Submit" />
                    </form>
                </div>
            </div>


</body>

</html> 