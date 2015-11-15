<?php
include("../php/link.php");
session_start();
if(!isset($_SESSION['ACCOUNT'])){
$_SESSION['NATIONALITY'] = "HONGKONG";
}
$query = "USE 12132031d";
$result = mysql_query($query);

$query = "SELECT * FROM attend a where participant = '".$_SESSION['ACCOUNT']."' ";
$result = mysql_query($query);

$mark_res = array(0,0,0,0,0);
for($counter = 0;$row = mysql_fetch_row($result);$counter++){
if($row[2]==0) continue;
$mark_res[$row[2]-1]++;
}
    $query = "select b.participant, count(b.participant) from attend a,attend b where a.dinner_id=b.dinner_id and a.participant!=b.participant and a.participant='".$_SESSION['ACCOUNT']."' group by participant
    ";
    $result = mysql_query($query);
    
    $mark_res2 = array();
    for($counter = 0;$row = mysql_fetch_row($result);$counter++){
        array_push($mark_res2,$row);
    }

?>
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

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- google chart -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
function drawChart() {
    var data = google.visualization.arrayToDataTable([
                                                     ['Year','number of dinner'],
                                                     ['1 mark',<? echo $mark_res[0]; ?>],
                                                     ['2 mark',<? echo $mark_res[1]; ?>],
                                                     ['3 mark',<? echo $mark_res[2]; ?>],
                                                     ['4 mark',<? echo $mark_res[3]; ?>],
                                                     ['5 mark',<? echo $mark_res[4]; ?>]
                                                     ]);
    
    var options = {
    title: 'Personal marks for <? echo $_SESSION['ACCOUNT']; ?>'
    };
    
    var chart = new google.visualization.BarChart(document.getElementById('barchart'));
    
    var data2 = google.visualization.arrayToDataTable([
                                                      ['user name', 'dinners together'],
                                                      <?
                                                      for($counter = 0;$counter<count($mark_res2);$counter++){
                                                      echo "['".$mark_res2[$counter][0]."',".$mark_res2[$counter][1]."],";
                                                      }
                                                      ?>
                                                      ]);
    var options2 = {
    title: 'My meetie mates',
    is3D: true,
    };
    
    var chart2 = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
    chart2.draw(data2, options2);
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
                <a class="navbar-brand" href="homepage.html">Hello! <?php echo $_SESSION['ACCOUNT'];?></a>
            </div>
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
                            <a class="active" href="charts.php"><i class="fa fa-bar-chart-o fa-fw"></i> Charts</a>
                        </li>
                        <li>
                            <a href="marks.php"><i class="fa fa-table fa-fw"></i> Marks</a>
                        </li>
                        <li>
                            <a href="forms.php"><i class="fa fa-edit fa-fw"></i> Forms</a>
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
                    <h1 class="page-header">Charts</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Area Chart Example
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="barchart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bar Chart Example
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="piechart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
