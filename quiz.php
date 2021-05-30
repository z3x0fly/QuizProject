<?php
ob_start();
session_start();
include 'backend/engine/database.php';
if (isset($_SESSION['giris']))
{
    $kimlik = $_SESSION['giris'];
    $sql = $con->prepare("SELECT * FROM educators");
    $sql->execute();
    $adminInfo=$sql->fetchAll(PDO::FETCH_OBJ);
    foreach($adminInfo as $cek)
    {
      $cate = $cek->cat;
      $cilas = $cek->class;
    }

    $educatorQuery = $con->prepare("SELECT * FROM educators");
    $educatorQuery->execute();
    $tablocek=$educatorQuery-> fetchAll(PDO::FETCH_OBJ);
    $categoryQuery = $con->prepare("SELECT * FROM questsions");
    $tablocek2=$categoryQuery-> fetchAll(PDO::FETCH_OBJ);
    $studentQuery = $con->prepare("SELECT * FROM student");
    $studentQuery->execute();
    $sutcek=$studentQuery-> fetchAll(PDO::FETCH_OBJ);
    $arrayAdmin  = $_SESSION['giris'];
    $adminesle  = $con -> prepare("SELECT * FROM educators WHERE id = :id");
    $adminesle -> execute(['id' => $arrayAdmin]);
    $row    = $adminesle -> fetchAll(PDO::FETCH_ASSOC);
    foreach ($row as $item)
    {
      $sinifinkati = $item['class'];
      $katinkati = $item['cat'];
    }
    $sorular= $con->prepare("SELECT ques FROM questions WHERE cat=? and class=? limit 20");
    $sorular->bindParam(1, $katinkati, PDO::PARAM_STR);
    $sorular->bindParam(2, $sinifinkati, PDO::PARAM_STR);
    $sonuclama = $sorular->fetchAll(PDO::FETCH_OBJ);

}

else
{
    echo "403!";
    header('location:login.php?forbidden');
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Eğitmen Paneli | Genel Bakış</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="backend/vendor/assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="backend/vendor/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="backend/vendor/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="backend/vendor/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>


    <link href="backend/vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="backend/vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="backend/vendor/assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

<div id="wrapper">

    <?php include "backend/vendor/parts/user/topbar.php";?>

    <!-- ========== Left Sidebar Start ========== -->


            <!--- Divider -->
            <?php include "backend/vendor/parts/user/sidebar.php";?>
            <div class="clearfix"></div>
        </div> <!-- end sidebarinner -->
    </div>
    <!-- Left Sidebar End -->

    <!-- Start right Content here -->

    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-header-title">
                            <h4 class="pull-left page-title">Sınav İşlemleri</h4>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                    <div class="col-md-12">
                      <div class="panel panel-primary">
                         <div class="panel-heading">
                            <h3 class="panel-title">Sorular</h3>
                          </div>
                        <div class="panel-body">
                          <blockquote>
                          <p>
                            <?php

                            $SoruSinif  = $sinifinkati;
                            $SoruCat = $katinkati;
                            $sorular  = $con -> prepare("SELECT * FROM questsions WHERE cat=? and class = ?  ORDER BY RAND() LIMIT 1000");
                            $sorular->execute(array($katinkati,$sinifinkati));
                            $apply = $sorular->fetch();
                            echo $apply["ques"];
                            $altkati = $apply["subcat"];
                            //foreach ($sonuclama as $mark)
                          //  {
                          //    echo $mark['ques'];
                          //  }
                           ?>
                          </p>
                          <footer><cite title="Source Title"><?php echo $katinkati; ?> dersinden <?php echo $sinifinkati; ?> sınıfına ait sorudur. <?php echo $altkati; ?> konusuna aittir.</cite>
                          </footer>
                          </blockquote>
                        </div>
                      </div>
                    </div>
                </div>
                <a href="quiz.php">
                  <button type="button" class="btn btn-success waves-effect waves-light">Sonraki Soru</button>
                </a>
            </div> <!-- container -->

        </div> <!-- content -->

            <?php include "backend/vendor/parts/user/footer.php";?>

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="backend/vendor/assets/js/jquery.min.js"></script>
<script src="backend/vendor/assets/js/bootstrap.min.js"></script>
<script src="backend/vendor/assets/js/modernizr.min.js"></script>
<script src="backend/vendor/assets/js/detect.js"></script>
<script src="backend/vendor/assets/js/fastclick.js"></script>
<script src="backend/vendor/assets/js/jquery.slimscroll.js"></script>
<script src="backend/vendor/assets/js/jquery.blockUI.js"></script>
<script src="backend/vendor/assets/js/waves.js"></script>
<script src="backend/vendor/assets/js/wow.min.js"></script>
<script src="backend/vendor/assets/js/jquery.nicescroll.js"></script>
<script src="backend/vendor/assets/js/jquery.scrollTo.min.js"></script>

<script src="backend/vendor/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- Datatables-->
<script src="backend/vendor/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="backend/vendor/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/responsive.bootstrap.min.js"></script>

<script src="backend/vendor/assets/pages/dashborad.js"></script>

<script src="backend/vendor/assets/js/app.js"></script>

</body>
</html>
