<?php 
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: admin-login-page.php');
}

?>
<?php
include 'post.php';
$post_obj = new Post();

if (isset($_GET['id'])) {
    $post_info = $post_obj->view_post_by_post_id($_GET['id']);
    if (isset($_POST['update_post']) && $_GET['id'] === $_POST['id']) {
        $post_obj->update_post_info($_POST);
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

    <script src="text-edit.js"></script>

    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>






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
                            <li><a href="admin-manager.php">Admin Manager</a></li>
                            <li class="active"><a href="post-manager.php">Post Manager</a></li>
                        </ul>

                    </li>
            </div>
        </aside>


        <!--footer end-->
    </section>
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Update Post</h3>
            <div class="mt ">
                <div class="col-lg-12">
                    <?php
                    if (isset($_SESSION['message'])) {
                        echo "<p class='custom-alert'>" . $_SESSION['message'] . "</p>";
                        $url1 = $_SERVER['REQUEST_URI'];
                        header("Refresh: 1; URL=$url1");
                        unset($_SESSION['message']);
                    }
                    ?>
                    <form method="post" action="">

                        <input value="<?php if (isset($post_info['PostID'])) {
                                            echo $post_info['PostID'];
                                        } ?>" type="hidden" name="id" id="id" required maxlength="50">

                        <div class="form-group">
                            <label for="NamePost">Name Post:</label>
                            <input value="<?php if (isset($post_info['NamePost'])) {
                                                echo $post_info['NamePost'];
                                            } ?>" type="text" class="form-control" name="NamePost" id="NamePost" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="AuthorPost">Author:</label>
                            <input value="<?php if (isset($post_info['AuthorPost'])) {
                                                echo $post_info['AuthorPost'];
                                            } ?>" type="text" class="form-control" name="AuthorPost" id="AuthorPost" maxlength="50">
                        </div>

                        <div class="form-group">
                            <label for="CatalogName">Catalog:</label>
                            <select class="form-control" name="CatalogName" id="CatalogName">
                                <option value="" selected>Select</option>
                                <option value="NEWS" <?php if (isset($post_info['CatalogName']) && $post_info['CatalogName'] == 'NEWS') {
                                                            echo 'selected';
                                                        } ?>>- NEWS</option>
                                <option value="BLOG" <?php if (isset($post_info['CatalogName']) && $post_info['CatalogName'] == 'BLOG') {
                                                            echo 'selected';
                                                        } ?>>- BLOG</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Brief">Brief:</label>
                            <input value="<?php if (isset($post_info['Brief'])) {
                                                echo $post_info['Brief'];
                                            } ?>" type="text" name="Brief" id="Brief" class="form-control" maxlength="1000" ">
                        </div>
                        <div class=" form-group">
                            <label for="Img">Image:</label>
                            <input value="<?php if (isset($post_info['Img'])) {
                                                echo $post_info['Img'];
                                            } ?>" type="text" name="Img" id="Img" class="form-control" maxlength="1000" ">
                        </div>
                        <div class=" form-group">
                            <label for="Content">Content:</label>
                            <textarea name="Content" id="editor1"><?php if (isset($post_info['Content'])) {
                                                                        echo $post_info['Content'];
                                                                    } ?></textarea>
                            <script>
                                CKEDITOR.replace('editor1');
                            </script>
                        </div>


                        <input value="<?php if (isset($post_info['AdminID'])) {
                                            echo $post_info['AdminID'];
                                        } ?>" type="hidden" name="AdminID" id="AdminID" class="form-control" maxlength="1000" ">
                        
                        <div class=" form-group">
                        <label for="ActivePost">Active:</label>
                        <select class="form-control" name="ActivePost" id="ActivePost">
                            <option value="" selected>Select</option>
                            <option value="1" <?php if (isset($post_info['ActivePost']) && $post_info['ActivePost'] == '1') {
                                                    echo 'selected';
                                                } ?>>- Active</option>
                            <option value="0" <?php if (isset($post_info['ActivePost']) && $post_info['ActivePost'] == '0') {
                                                    echo 'selected';
                                                } ?>>- Inactive</option>
                        </select>
                </div>
                <input type="submit" class="button button-green " name="update_post" value="Submit" />
                </form>
            </div>
            </div>


        </section>
        <!-- /wrapper -->
    </section>

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






</body>

</html> 