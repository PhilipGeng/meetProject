<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script type="text/javascript">
        function getLocation(ele){
            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    var resp=xmlhttp.responseText.split("-");
                    ele.value=resp[0];
                    document.getElementById("restid").value=resp[1];
                }
            }
            xmlhttp.open("GET","getsession.php",true);
            xmlhttp.send();
        }
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
<a class="navbar-brand" href="homepage.html">Hello! <?php session_start(); echo $_SESSION['ACCOUNT']; ?></a>
            </div>
            
            <!-- /.navbar-top-links -->
            
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="homepage.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="charts.php"><i class="fa fa-bar-chart-o fa-fw"></i> Charts</a>
                        </li>
                        <li>
                            <a href="marks.php"><i class="fa fa-table fa-fw"></i> Marks</a>
                        </li>
                        <li>
                            <a class="active" href="forms.php"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Forms</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Restaurant Locations
                        </div>
                        <div>
                            <iframe src="geocoding.php" width="100%" height="500px"></iframe>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" id="formgrp" action="createdinner.php" method="POST">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input class="form-control" placeholder="Input Title" name="title">
                                                <p class="help-block">You can input less than 100 char</p>
                                                </div>
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input class="form-control"  placeholder="Select Time" name="date" type="datetime-local" value="2014-12-23T23:59:60Z">
                                                <p class="help-block">You choose your dine time</p>
                                                </div>
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input class="form-control" placeholder="Enter Location" onfocus="getLocation(this)">
                                            <p class="help-block">This is your dine location</p>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Hidden ID"  name="restid" id="restid" type="hidden">
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea class="form-control" rows="6" placeholder="Input Some Description" name="description"></textarea>
                                            <p class="help-block">You can input some description with in 300 char</p>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Button</button>
                                        <button type="reset" class="btn btn-default" onclick="document.getElementById('formgrp').reset();">Reset Button</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        
    </div>
    <!-- /#wrapper -->
    
</body>
</html>
