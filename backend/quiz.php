<?php
ob_start();
session_start();
include 'engine/database.php';
if (isset($_SESSION['id']))
{
    $kimlik = $_SESSION['id'];
    $sql = $con->prepare("SELECT * FROM admin");
    $sql->execute();
    $adminInfo=$sql->fetchAll(PDO::FETCH_OBJ);
    $classQuery = $con->prepare("SELECT * FROM categories");
    $classQuery->execute();
    $ClassCek=$classQuery-> fetchAll(PDO::FETCH_OBJ);
    $quizQuery = $con->prepare("SELECT * FROM questsions");
    $quizQuery->execute();
    $tablocek=$quizQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
    $quizQuery = $con->prepare("SELECT * FROM sub_cats");
    $quizQuery->execute();
    $tablocek2=$quizQuery-> fetchAll(PDO::FETCH_OBJ);
    $sinifsorgu = $con->prepare("SELECT * FROM class");
    $sinifsorgu->execute();
    $siniflaricek = $sinifsorgu-> fetchAll(PDO::FETCH_OBJ);

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
    <title>Yönetim Paneli | Sorular</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="vendor/assets/images/favicon.ico">
    <link href="vendor/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="vendor/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <link href="vendor/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="vendor/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

    <link href="vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/style.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link href="vendor/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>


    <link href="vendor/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="vendor/assets/css/style.css" rel="stylesheet" type="text/css">

</head>


<body class="fixed-left">

<div id="wrapper">

    <?php include "vendor/parts/topbar.php";?>

    <!-- ========== Left Sidebar Start ========== -->


    <!--- Divider -->
    <?php include "vendor/parts/sidebar.php";?>
    <div class="clearfix"></div>
</div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->

<!-- Start right Content here -->

<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">

            <!-- Code Here -->
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Sorular</h4>
                        <div class="clearfix"></div>
                        <?php
                        if (isset($_GET['ekle'])) {
                          // code...
                          $soru = trim(filter_input(INPUT_POST, 'soru', FILTER_SANITIZE_STRING));
                          $cevap = trim(filter_input(INPUT_POST, 'cevap', FILTER_SANITIZE_STRING));
                          $kategori = trim(filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING));
                          $konu = trim(filter_input(INPUT_POST, 'konu', FILTER_SANITIZE_STRING));
                          $sinifcik = trim(filter_input(INPUT_POST, 'sinif', FILTER_SANITIZE_STRING));


                          try {
                             $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                             $sorgula = $con->prepare("INSERT INTO questsions(ques,answer,cat,subcat,class) VALUES(?,?,?,?,?)");
                             $sorgula->bindParam(1, $soru, PDO::PARAM_STR);
                             $sorgula->bindParam(2, $cevap, PDO::PARAM_STR);
                             $sorgula->bindParam(3, $kategori, PDO::PARAM_STR);
                             $sorgula->bindParam(4, $konu, PDO::PARAM_STR);
                             $sorgula->bindParam(5, $sinifcik, PDO::PARAM_STR);


                             $sorgula->execute();
                            //echo $ad,$soyad,$pass_enc, $mail, $tarih, $sinif;
                              ?>
                              <div class="alert alert-success alert-dismissible fade in">
                                                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                          Soru, Cevabı İle Başarılı Şekilde Eklendi. Sayfa Yenileniyor !
                                                                      </div>
                                                              <?php
                                                              header('refresh:2;url=quiz.php');
                          } catch (PDOException $e) {
                              die($e->getMessage());
                          }

                        }
                        if(isset($_GET['sil']))
                        {
                          $sorgu=$con->prepare('DELETE FROM questsions WHERE id=?');
                            $sonuc=$sorgu->execute([$_GET['sil']]);
                            if($sonuc){
                              echo '  <div class="alert alert-success alert-dismissible fade in">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              Soru, Cevabı İle Başarılı Şekilde Silindi. Sayfa Yenileniyor !
                              </div>';
                              header('refresh:2;url=quiz.php');
                            }
                            else
                              echo("Kayıt silinemedi.");
                        }
                        ?>
                    </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-primary panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Sisteme Soru Girme Paneli</h3>
                                    </div>
                                    <form action="quiz.php?ekle" method="post">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="demo-box">
                                                    <div class="m-t-20">
                                                        <label> Sorulacak Soru </label>
                                                        <p class="text-muted m-b-15 font-13">
                                                          Bu alan sorulacak olan soru için ayırılmıştır.
                                                        </p>
                                                        <textarea id="textarea" name="soru" class="form-control" maxlength="3000" rows="10" placeholder="Buraya yazın..."></textarea>
                                                    </div>
                                                    <div class="m-t-20">
                                                        <label> Sorunun Cevabı </label>
                                                        <p class="text-muted m-b-15 font-13">
                                                          Bu alan sorulacak olan soru cevabı için ayırılmıştır.
                                                        </p>
                                                        <textarea id="textarea" name="cevap" class="form-control" maxlength="3000" rows="10" placeholder="Buraya yazın..."></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                      <label>Kategori (Ders)</label>
                                                      <div>
                                                          <select name="kategori" class="form-control">
                                                            <?php
                                                            foreach($ClassCek as $cek){?>


                                                            <option><?= $cek->name ?></option>



                                                        <?php } ?>
                                                          </select>

                                                      </div>

                                                  </div>
                                                  <div class="form-group">
                                                    <label>Müfredat Konusu</label>
                                                    <div>
                                                        <select name="konu" class="form-control">
                                                          <?php
                                                          foreach($tablocek2 as $cek){?>


                                                          <option><?= $cek->name ?></option>



                                                      <?php } ?>
                                                        </select>

                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label>Sınıf</label>
                                                    <div>
                                                        <select name="sinif" class="form-control">
                                                          <?php
                                                          foreach($siniflaricek as $cek){?>


                                                          <option><?= $cek->name ?></option>



                                                      <?php } ?>
                                                        </select>

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
                                            </div>
                                        </div>

                                        <!-- end row -->
                                      </form>
                                    </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="panel panel-primary">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">Eklenmiş Sorular Tablosu</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Soru</th>
                                                                                    <th>Cevap</th>
                                                                                    <th>Kategori</th>
                                                                                    <th>Müfredat Konusu</th>
                                                                                    <th>Sınıf</th>
                                                                                    <th>Sil</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                  <?php
                                                                                  foreach($tablocek as $cek){?>
                                                                                  <tr>


                                                                                  <td><?= $cek->ques ?></td>
                                                                                  <td><?= $cek->answer ?></td>
                                                                                  <td><?= $cek->cat ?></td>
                                                                                  <td><?= $cek->subcat ?></td>
                                                                                  <td><?= $cek->class ?> </td>

                                                                                  <td> <a type="button" href="quiz.php?sil=<?= $cek->id ?>"><button class="btn btn-danger waves-effect waves-light">Soruyu Sil</button></a></td>

                                                                                  </tr>

                                                                              <?php } ?>
                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div> <!-- End Row -->


                                </div> <!-- end panel -->

                            </div> <!-- end col -->

                        </div>
                        <!-- end row -->
                </div>
            </div>



        </div>
    </div> <!-- container -->

</div> <!-- content -->

<?php include "vendor/parts/footer.php";?>

</div>
<!-- End Right content here -->

</div>
<!-- END wrapper -->


<!-- jQuery  -->
<script src="vendor/assets/js/jquery.min.js"></script>
<script src="vendor/assets/js/bootstrap.min.js"></script>
<script src="vendor/assets/js/modernizr.min.js"></script>
<script src="vendor/assets/js/detect.js"></script>
<script src="vendor/assets/js/fastclick.js"></script>
<script src="vendor/assets/js/jquery.slimscroll.js"></script>
<script src="vendor/assets/js/jquery.blockUI.js"></script>
<script src="vendor/assets/js/waves.js"></script>
<script src="vendor/assets/js/wow.min.js"></script>
<script src="vendor/assets/js/jquery.nicescroll.js"></script>
<script src="vendor/assets/js/jquery.scrollTo.min.js"></script>

<script src="vendor/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!-- Datatables-->
<script src="vendor/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="vendor/assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="vendor/assets/plugins/datatables/responsive.bootstrap.min.js"></script>

<script src="vendor/assets/pages/dashborad.js"></script>

<script src="vendor/assets/js/app.js"></script>
<!-- jQuery  -->
<script src="vendor/js/jquery.min.js"></script>
<script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/modernizr.min.js"></script>
<script src="vendor/js/detect.js"></script>
<script src="vendor/js/fastclick.js"></script>
<script src="vendor/js/jquery.slimscroll.js"></script>
<script src="vendor/js/jquery.blockUI.js"></script>
<script src="vendor/js/waves.js"></script>
<script src="vendor/js/wow.min.js"></script>
<script src="vendor/js/jquery.nicescroll.js"></script>
<script src="vendor/js/jquery.scrollTo.min.js"></script>

<!-- Plugins js -->
<script src="vendor/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="vendor/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="vendor/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="vendor/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

</body>
</html>
