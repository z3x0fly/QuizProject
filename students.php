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
    $corpQuery = $con->prepare("SELECT * FROM corps");
    $corpQuery->execute();
    $corplar=$corpQuery-> fetchAll(PDO::FETCH_OBJ);

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
$studentQuery = $con->prepare("SELECT * FROM student WHERE class=?");
$studentQuery->bindParam(1, $tutSinif, PDO::PARAM_STR);

$studentQuery->execute();
$sutcek=$studentQuery-> fetchAll(PDO::FETCH_OBJ);
//object olarak verilerimizi çekiyoruz.
///////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Yönetim Paneli | Eğitmenler</title>
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
                                    <h4 class="pull-left page-title">Eğitmenler</h4>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Sayfa Bilgisi</h3>
                                    </div>
                                    <div class="panel-body">
                                        <h1>Bilgilendirme !</h1>

                                        <p class="text-muted m-b-30">Sınıf kısmı sistemden otomatik olarak çekilmektedir. Sınıf kısmına lütfen müdahale etmeyelim. Aksi halde, öngörülemeyen hatalar ve sorunlar ortaya çıkabilir.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Öğrenci Ekle </h3>
                                    </div>
                          <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <h3 class="header-title m-t-0"><small></small></h3>
                                                <?php
                                                if (isset($_GET['ekle'])) {
                                                  // code...
                                                  $ad = trim(filter_input(INPUT_POST, 'ad', FILTER_SANITIZE_STRING));
                                                  $soyad = trim(filter_input(INPUT_POST, 'soyad', FILTER_SANITIZE_STRING));
                                                  $sinif = trim(filter_input(INPUT_POST, 'sinif', FILTER_SANITIZE_STRING));
                                                  $grup = trim(filter_input(INPUT_POST, 'grup', FILTER_SANITIZE_STRING));
                                                  $kurum = trim(filter_input(INPUT_POST, 'kurum', FILTER_SANITIZE_STRING));
                                                  try {
                                                     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                     $sorgula = $con->prepare("INSERT INTO student(name, last, class, corp, grup, q1,	q2,	q3,	q4,	q5,	q6,	q7,	q8,	q9,	q10,	q11,	q12,	q13,	q14,	q15,	q16,	q17,	q18,	q19, q20,	q21,	q22,	q23,	q24,	q25) VALUES(?, ?, ?, ?, ?, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)");
                                                     $sorgula->bindParam(1, $ad, PDO::PARAM_STR);
                                                     $sorgula->bindParam(2, $soyad, PDO::PARAM_STR);
                                                     $sorgula->bindParam(3, $sinif, PDO::PARAM_STR);
                                                     $sorgula->bindParam(4, $grup, PDO::PARAM_STR);
                                                     $sorgula->bindParam(5, $kurum, PDO::PARAM_STR);

                                                     $sorgula->execute();
                                                    //echo $ad,$soyad,$pass_enc, $mail, $tarih, $sinif;
                                                      ?>
                                                      <div class="alert alert-success alert-dismissible fade in">
                                                                                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                                  Öğrenci Ekleme İşlemi Başarılı ! Panel Yenileniyor !
                                                                                              </div>
                                                                                      <?php
                                                                                      header('refresh:2;url=students.php');
                                                  } catch (PDOException $e) {
                                                      die($e->getMessage());
                                                  }

                                                }

                                                if(isset($_GET['sil']))
                                                {
                                                  $sorgu=$con->prepare('DELETE FROM student WHERE id=?');
                                                  	$sonuc=$sorgu->execute([$_GET['sil']]);
                                                  	if($sonuc){
                                                      echo '  <div class="alert alert-success alert-dismissible fade in">
                                                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                                                    Öğrenci Başarılı Bir Şekilde Silindi. Yenileniyor !
                                                                                                </div>';
                                                                                                header('refresh:2;url=students.php');
                                                  	}
                                                  	else
                                                  		echo("Kayıt silinemedi.");
                                                }

                                                ?>
                                                <div class="m-t-25">
                                                  <form action="students.php?ekle" method="post">
                                                        <div class="form-group">
                                                            <label>Adı</label>
                                                            <input name="ad" type="text" class="form-control" required
                                                                   placeholder="Bir ad giriniz."/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Soyadı</label>
                                                            <input name="soyad" type="text" class="form-control" required
                                                                   placeholder="Bir soyad giriniz."/>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Sınıfı</label>
                                                            <div>
                                                                <input name="sinif" type="text" value="<?php
                                                                foreach($adminInfo as $cek){
                                                                  $classTut = $cek->class;
                                                                } echo $classTut; ?>"  class="form-control" required
                                                                      />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                          <label>Kurum</label>
                                                          <div>
                                                              <select name="grup" class="form-control">
                                                                <?php
                                                                foreach($corplar as $cek){?>


                                                                <option><?= $cek->name ?></option>



                                                            <?php } ?>
                                                              </select>

                                                          </div>

                                                      </div>
                                                        <div class="form-group">
                                                            <label>Grup</label>
                                                            <div>
                                                                <input name="kurum" type="text" class="form-control" required/>
                                                            </div>
                                                        </div>
                                                            <div>
                                                                <button  type="submit" class="btn btn-primary waves-effect waves-light">
                                                                    Sisteme Ekle
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
                                    </div>



                    </div> <!-- container -->

                </div> <!-- content -->


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

                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->





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
<!-- Plugins js -->
<script src="backend/vendor/assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="backend/vendor/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="backend/vendor/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="backend/vendor/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="backend/vendor/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<script src="backend/vendor/assets/pages/dashborad.js"></script>
<script src="backend/vendor/assets/pages/form-advanced.js"></script>
<script type="text/javascript" src="backend/vendor/assets/plugins/parsleyjs/parsley.min.js"></script>
<script src="backend/vendor/assets/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>
</body>
</html>
