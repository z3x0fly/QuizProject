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
      $tutSinif = $cek->class;
    }
}
else
{
    echo "403!";
    header('location:login.php?forbidden');
}
$educatorQuery = $con->prepare("SELECT * FROM educators");
$educatorQuery->execute();
$tablocek=$educatorQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
$categoryQuery = $con->prepare("SELECT * FROM categories");
$categoryQuery->execute();
$tablocek2=$categoryQuery-> fetchAll(PDO::FETCH_OBJ);
$studentQuery = $con->prepare("SELECT * FROM student WHERE class=?");
$studentQuery->bindParam(1, $tutSinif, PDO::PARAM_STR);

$studentQuery->execute();
$sutcek=$studentQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
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
    <link href="backend/vendor/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="backend/vendor/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="backend/vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="backend/vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="backend/vendor/assets/css/style.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="backend/vendor/assets/js/jquery.table2excel.js"></script>
</head>

<script>
$(document).ready(function(){
	$("#aktar").click(function(){
  $("#datatable-responsive").table2excel({
    // exclude bu class verdiğiniz yerler aktarılmayacak.
    exclude: ".bunu_aktarma",
    filename: "data" //burada .(nokta) ve uzantı kullanmayın
  });
});
});
</script>
<style>
    table { border-top: 1px solid gray; border-left: 1px solid gray}
    table tr td { padding: 5px 10px; border-right: 1px solid gray; border-bottom: 1px solid gray}
    span #aktar { float: left; padding: 5px 8px; background: #FF0D6D; color:#fff; margin-top: 10px  }
</style>
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
                            <h4 class="pull-left page-title">Ana Sayfa</h4>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h3 class="panel-title">Öğrenci Tablosu</h3>
                            </div>
                            <div class="panel-body">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>İsim</th>
                                        <th>Soyisim</th>
                                        <th>Seviye/Sınıf</th>
                                        <th>Grup</th>
                                        <th>Kurum</th>
                                        <th>Soru 1</th>
                                        <th>Soru 2</th>
                                        <th>Soru 3</th>
                                        <th>Soru 4</th>
                                        <th>Soru 5</th>
                                        <th>Soru 6</th>
                                        <th>Soru 7</th>
                                        <th>Soru 8</th>
                                        <th>Soru 9</th>
                                        <th>Soru 10</th>
                                        <th>Soru 11</th>
                                        <th>Soru 12</th>
                                        <th>Soru 13</th>
                                        <th>Soru 14</th>
                                        <th>Soru 15</th>
                                        <th>Soru 16</th>
                                        <th>Soru 17</th>
                                        <th>Soru 18</th>
                                        <th>Soru 19</th>
                                        <th>Soru 20</th>
                                        <th>Soru 21</th>
                                        <th>Soru 22</th>
                                        <th>Soru 23</th>
                                        <th>Soru 24</th>
                                        <th>Soru 25</th>
                                        <th>İşlem</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      foreach($sutcek as $cek){?>
                                      <tr>

                                      <td><?= $cek->name ?></td>
                                      <td><?= $cek->last ?></td>
                                      <td><?= $cek->class ?></td>
                                      <td><?= $cek->grup ?> </td>
                                      <td><?= $cek->corp ?> </td>
                                      <td><?= $cek->q1 ?> </td>
                                      <td><?= $cek->q2 ?> </td>
                                      <td><?= $cek->q3 ?> </td>
                                      <td><?= $cek->q4 ?> </td>
                                      <td><?= $cek->q5 ?> </td>
                                      <td><?= $cek->q6 ?> </td>
                                      <td><?= $cek->q7 ?> </td>
                                      <td><?= $cek->q8 ?> </td>
                                      <td><?= $cek->q9 ?> </td>
                                      <td><?= $cek->q10 ?> </td>
                                      <td><?= $cek->q11 ?> </td>
                                      <td><?= $cek->q12 ?> </td>
                                      <td><?= $cek->q13 ?> </td>
                                      <td><?= $cek->q14 ?> </td>
                                      <td><?= $cek->q15 ?> </td>
                                      <td><?= $cek->q16 ?> </td>
                                      <td><?= $cek->q17 ?> </td>
                                      <td><?= $cek->q18 ?> </td>
                                      <td><?= $cek->q19 ?> </td>
                                      <td><?= $cek->q20 ?> </td>
                                      <td><?= $cek->q21 ?> </td>
                                      <td><?= $cek->q22 ?> </td>
                                      <td><?= $cek->q23 ?> </td>
                                      <td><?= $cek->q24 ?> </td>
                                      <td><?= $cek->q25 ?> </td>

                                      <td> <a type="button" href="students.php?sil=<?= $cek->id ?>"><button class="btn btn-danger waves-effect waves-light">Öğrenciyi Sil</button> </a> <a  href="islem.php?duzenle=<?= $cek->id ?>"> <button type="button" class="btn btn-primary waves-effect waves-light">Öğrenci Notlarını Düzenle</button> </a></td>

                                      </tr>

                                  <?php } ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-6 col-sm-3 m-b-30">
                                  <button  id="aktar" type="button" class="btn btn-success waves-effect waves-light">Excel Olarak Dışa Aktar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End Row -->


            </div> <!-- container -->

        </div> <!-- content -->

            <?php include "backend/vendor/parts/user/footer.php";?>

    </div>
    <!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
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
<script src="backend/vendor/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/jszip.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="backend/vendor/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/buttons.print.min.js"></script>
<!-- Datatables-->
<script src="backend/vendor/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="backend/vendor/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="backend/vendor/assets/plugins/datatables/responsive.bootstrap.min.js"></script>

<script src="backend/vendor/assets/pages/dashborad.js"></script>

<script src="backend/vendor/assets/js/app.js"></script>

</body>
</html>
