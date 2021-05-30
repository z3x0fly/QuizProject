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
    $educatorQuery = $con->prepare("SELECT * FROM educators");
    $educatorQuery->execute();
    $tablocek=$educatorQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
    $categoryQuery = $con->prepare("SELECT * FROM categories");
    $categoryQuery->execute();
    $tablocek2=$categoryQuery-> fetchAll(PDO::FETCH_OBJ);
    $studentQuery = $con->prepare("SELECT * FROM student");
    $studentQuery->execute();
    $sutcek=$studentQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
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
                            <h4 class="pull-left page-title">Öğrenci İşlemleri</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <?php
                    if (isset($_GET['duzenle'])) {

                                            $array  = $_GET['duzenle'];
                                            $query  = $con -> prepare("SELECT * FROM student WHERE id = :id");
                                            $query -> execute(['id' => $array]);
                                            $row    = $query -> fetchAll(PDO::FETCH_ASSOC);
                      ?>

                      <div class="row">
                          <div class="col-sm-12">
                              <div class="panel panel-primary">
                                  <div class="panel-heading">
                                      <h3 class="panel-title">Kullanıcı Bilgilerini Güncelle</h3>
                                  </div>
                        <div class="panel-body">
                                      <div class="row">
                                          <div class="col-sm-12 col-xs-12">
                                              <h3 class="header-title m-t-0"><small></small></h3>
                                              <?php
                                              if (isset($_POST['kaydet'])) {
                                                //ad
                                                //soyad
                                                //sinav
                                                //kurum
                                                //ekip

                                                $ad = trim(filter_input(INPUT_POST, "ad", FILTER_SANITIZE_STRING));
                                                $soyad = trim(filter_input(INPUT_POST, "soyad", FILTER_SANITIZE_STRING));
                                                $sinav = trim(filter_input(INPUT_POST, "sinav", FILTER_SANITIZE_STRING));
                                                $s1 = trim(filter_input(INPUT_POST, "q1", FILTER_SANITIZE_STRING));
                                                $s2 = trim(filter_input(INPUT_POST, "q2", FILTER_SANITIZE_STRING));
                                                $s3 = trim(filter_input(INPUT_POST, "q3", FILTER_SANITIZE_STRING));
                                                $s4 = trim(filter_input(INPUT_POST, "q4", FILTER_SANITIZE_STRING));
                                                $s5 = trim(filter_input(INPUT_POST, "q5", FILTER_SANITIZE_STRING));
                                                $s6 = trim(filter_input(INPUT_POST, "q6", FILTER_SANITIZE_STRING));
                                                $s7 = trim(filter_input(INPUT_POST, "q7", FILTER_SANITIZE_STRING));
                                                $s8 = trim(filter_input(INPUT_POST, "q8", FILTER_SANITIZE_STRING));
                                                $s9 = trim(filter_input(INPUT_POST, "q9", FILTER_SANITIZE_STRING));
                                                $s10 = trim(filter_input(INPUT_POST, "q10", FILTER_SANITIZE_STRING));
                                                $s11 = trim(filter_input(INPUT_POST, "q11", FILTER_SANITIZE_STRING));
                                                $s12 = trim(filter_input(INPUT_POST, "q12", FILTER_SANITIZE_STRING));
                                                $s13 = trim(filter_input(INPUT_POST, "q13", FILTER_SANITIZE_STRING));
                                                $s14 = trim(filter_input(INPUT_POST, "q14", FILTER_SANITIZE_STRING));
                                                $s15 = trim(filter_input(INPUT_POST, "q15", FILTER_SANITIZE_STRING));
                                                $s16 = trim(filter_input(INPUT_POST, "q16", FILTER_SANITIZE_STRING));
                                                $s17 = trim(filter_input(INPUT_POST, "q17", FILTER_SANITIZE_STRING));
                                                $s18 = trim(filter_input(INPUT_POST, "q18", FILTER_SANITIZE_STRING));
                                                $s19 = trim(filter_input(INPUT_POST, "q19", FILTER_SANITIZE_STRING));
                                                $s20 = trim(filter_input(INPUT_POST, "q20", FILTER_SANITIZE_STRING));
                                                $s21 = trim(filter_input(INPUT_POST, "q21", FILTER_SANITIZE_STRING));
                                                $s22 = trim(filter_input(INPUT_POST, "q22", FILTER_SANITIZE_STRING));
                                                $s23 = trim(filter_input(INPUT_POST, "q23", FILTER_SANITIZE_STRING));
                                                $s24 = trim(filter_input(INPUT_POST, "q24", FILTER_SANITIZE_STRING));
                                                $s25 = trim(filter_input(INPUT_POST, "q25", FILTER_SANITIZE_STRING));

                                                try {
                                                   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                   $sorgula = $con->prepare('UPDATE student SET name = ?, last = ?, qname=?, q1=?, q2=? q3=?, q4=?, q5=?, q6=?, q7=?, q8=?, q9=?, q10=?, q11=?, q12=? q13=?, q14=?, q15=?, q16=?, q17=?, q18=?, q19=?, q20=?, q21=?, q22=? q23=?, q24=?, q25=?  WHERE id = ?');
                                                   $sorgula->bindParam(1, $ad, PDO::PARAM_STR);
                                                   $sorgula->bindParam(2, $soyad, PDO::PARAM_STR);
                                                   $sorgula->bindParam(3, $sinav, PDO::PARAM_STR);
                                                   $sorgula->bindParam(4, $s1, PDO::PARAM_STR);
                                                   $sorgula->bindParam(5, $s2, PDO::PARAM_STR);
                                                   $sorgula->bindParam(6, $s3, PDO::PARAM_STR);
                                                   $sorgula->bindParam(7, $s4, PDO::PARAM_STR);
                                                   $sorgula->bindParam(8, $s5, PDO::PARAM_STR);
                                                   $sorgula->bindParam(9, $s6, PDO::PARAM_STR);
                                                   $sorgula->bindParam(10, $s7, PDO::PARAM_STR);
                                                   $sorgula->bindParam(11, $s8, PDO::PARAM_STR);
                                                   $sorgula->bindParam(12, $s9, PDO::PARAM_STR);
                                                   $sorgula->bindParam(13, $s10, PDO::PARAM_STR);
                                                   $sorgula->bindParam(14, $s11, PDO::PARAM_STR);
                                                   $sorgula->bindParam(15, $s12, PDO::PARAM_STR);
                                                   $sorgula->bindParam(16, $s13, PDO::PARAM_STR);
                                                   $sorgula->bindParam(17, $s14, PDO::PARAM_STR);
                                                   $sorgula->bindParam(18, $s15, PDO::PARAM_STR);
                                                   $sorgula->bindParam(19, $s16, PDO::PARAM_STR);
                                                   $sorgula->bindParam(20, $s17, PDO::PARAM_STR);
                                                   $sorgula->bindParam(21, $s18, PDO::PARAM_STR);
                                                   $sorgula->bindParam(22, $s19, PDO::PARAM_STR);
                                                   $sorgula->bindParam(23, $s20, PDO::PARAM_STR);
                                                   $sorgula->bindParam(24, $s21, PDO::PARAM_STR);
                                                   $sorgula->bindParam(25, $s22, PDO::PARAM_STR);
                                                   $sorgula->bindParam(26, $s23, PDO::PARAM_STR);
                                                   $sorgula->bindParam(27, $s24, PDO::PARAM_STR);
                                                   $sorgula->bindParam(28, $s25, PDO::PARAM_STR);
                                                   $sorgula->bindParam(29, $_GET['duzenle'], PDO::PARAM_STR);

                                                   $sorgula->execute();
                                                    ?>
                                                    <div class="alert alert-success alert-dismissible fade in">
                                                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                                Bilgiler Güncellendi. Panel Yenileniyor !
                                                                                            </div>
                                                                                    <?php
                                                                                    header('refresh:2;url=home.php');
                                                } catch (PDOException $e) {
                                                    die($e->getMessage());
                                                }

                                              }



                                              ?>
                                              <div class="m-t-25">
                                                <form action="" method="post">
                                                      <div class="form-group">
                                                          <label>Adı</label>
                                                          <input name="ad" value=<?php
                                                             foreach ($row as $item) {
                                                               echo '"'.$item['name'].'"';
                                                              } ?> type="text" class="form-control" required
                                                                 placeholder="Bir ad giriniz."/>
                                                      </div>

                                                      <div class="form-group">
                                                          <label>Soyadı</label>
                                                          <input name="soyad" value=<?php
                                                             foreach ($row as $item) {
                                                               echo '"'.$item['last'].'"';
                                                              } ?> type="text" class="form-control" required
                                                                 placeholder="Bir ad giriniz."/>
                                                      </div>

                                                      <div class="form-group">
                                                          <label>Sınavın Adı</label>
                                                          <div>
                                                              <input name="sinav" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['qname'].'"';
                                                                 } ?> type="text" class="form-control" required
                                                                     parsley-type="text"/>
                                                          </div>
                                                      </div>

                                                    </div><div class="form-group col-md-1">
                                                          <label>1. Soru</label>
                                                          <div>
                                                              <input name="q1" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q1'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>2. Soru</label>
                                                          <div>
                                                              <input name="q2" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q2'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>3. Soru</label>
                                                          <div>
                                                              <input name="q3" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q3'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>4. Soru</label>
                                                          <div>
                                                              <input name="q4" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q4'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>5. Soru</label>
                                                          <div>
                                                              <input name="q5" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q5'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>6. Soru</label>
                                                          <div>
                                                              <input name="q6" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q6'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>7. Soru</label>
                                                          <div>
                                                              <input name="q7" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q7'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>8. Soru</label>
                                                          <div>
                                                              <input name="q8" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q8'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>9. Soru</label>
                                                          <div>
                                                              <input name="q9" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q9'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>10. Soru</label>
                                                          <div>
                                                              <input name="q10" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q10'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>11. Soru</label>
                                                          <div>
                                                              <input name="q11" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q11'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>12. Soru</label>
                                                          <div>
                                                              <input name="q12" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q12'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>13. Soru</label>
                                                          <div>
                                                              <input name="q13" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q13'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>14. Soru</label>
                                                          <div>
                                                              <input name="q14" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q14'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>15. Soru</label>
                                                          <div>
                                                              <input name="q15" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q15'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>16. Soru</label>
                                                          <div>
                                                              <input name="q16" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q16'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>17. Soru</label>
                                                          <div>
                                                              <input name="q17" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q17'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>18. Soru</label>
                                                          <div>
                                                              <input name="q18" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q18'].'"';
                                                                 } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>19. Soru</label>
                                                          <div>
                                                              <input name="q19" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q19'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>20. Soru</label>
                                                          <div>
                                                              <input name="q20" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q20'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>21. Soru</label>
                                                          <div>
                                                              <input name="q21" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q21'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>22. Soru</label>
                                                          <div>
                                                              <input name="q22" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q22'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>23. Soru</label>
                                                          <div>
                                                              <input name="q23" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q23'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div><div class="form-group col-md-1">
                                                        <label>24. Soru</label>
                                                          <div>
                                                              <input name="q24" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q24'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                  parsley-type="number" />
                                                          </div>
                                                        </div>
                                                        <div class="form-group col-md-1">
                                                          <label>25. Soru</label>
                                                          <div>
                                                              <input name="q25" value=<?php
                                                                 foreach ($row as $item) {
                                                                   echo '"'.$item['q25'].'"';
                                                                  } ?> type="number" class="form-control" required
                                                                     parsley-type="number" />
                                                          </div>
                                                      </div>
                                            <div class="form-group">

                                              </div>
                                          </div>

                                                          <div>
                                                              <button name="kaydet" type="submit" class="btn btn-primary waves-effect waves-light">
                                                                  Öğrenciyi Güncelle
                                                              </button>
                                                              <script>

                                                              </script>

                                                          </div>
                                                      </div>
                                                  </form>
                                              </div>

                                          </div>


                                      </div>
                                      <!-- end row -->

                      <?php


                    }
                    else {
                      header('location:home.php');

                    }

                    ?>
                </div>



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
