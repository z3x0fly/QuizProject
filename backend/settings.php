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
    $quizQuery = $con->prepare("SELECT * FROM sub_cats");
    $quizQuery->execute();
    $tablocek=$quizQuery-> fetchAll(PDO::FETCH_OBJ);//object olarak verilerimizi çekiyoruz.
    $planQuery = $con->prepare("SELECT * FROM quizplans");
    $planQuery->execute();
    $plancek=$planQuery-> fetchAll(PDO::FETCH_OBJ);
    $sinidQuery = $con->prepare("SELECT * FROM class");
    $sinidQuery->execute();
    $sinifCek=$sinidQuery-> fetchAll(PDO::FETCH_OBJ);
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
    <title>Yönetim Paneli | Sınav Düzenleme</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="vendor/assets/images/favicon.ico">

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
                        <h4 class="pull-left page-title">Sınav Paneli</h4>
                        <div class="clearfix"></div>
                        <?php
                        if (isset($_GET['ekle'])) {
                          // code...
                          $kategori = trim(filter_input(INPUT_POST, 'kategori', FILTER_SANITIZE_STRING));
                          $konu = trim(filter_input(INPUT_POST, 'konu', FILTER_SANITIZE_STRING));                          $konu = trim(filter_input(INPUT_POST, 'konu', FILTER_SANITIZE_STRING));
                          $limit = trim(filter_input(INPUT_POST, 'limit', FILTER_SANITIZE_STRING));
                          $sira = trim(filter_input(INPUT_POST, 'sira', FILTER_SANITIZE_STRING));
                          $sinif = trim(filter_input(INPUT_POST, 'sinif', FILTER_SANITIZE_STRING));


                          try {
                             $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                             $sorgula = $con->prepare("INSERT INTO quizplans(name,sub,list,limiti,class) VALUES(?, ?, ?, ?, ?)");
                             $sorgula->bindParam(1, $kategori, PDO::PARAM_STR);
                             $sorgula->bindParam(2, $konu, PDO::PARAM_STR);
                             $sorgula->bindParam(3, $sira, PDO::PARAM_STR);
                             $sorgula->bindParam(4, $limit, PDO::PARAM_STR);
                             $sorgula->bindParam(5, $sinif, PDO::PARAM_STR);

                             $sorgula->execute();
                            //echo $ad,$soyad,$pass_enc, $mail, $tarih, $sinif;
                              ?>
                              <div class="alert alert-success alert-dismissible fade in">
                                                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                          Sınav Başarılı Şekilde Eklendi. Yenileniyor !
                                                                      </div>
                                                              <?php
                                                              header('refresh:2;url=settings.php');
                          } catch (PDOException $e) {
                              die($e->getMessage());
                          }

                        }
                        if(isset($_GET['sil']))
                        {
                          $sorgu=$con->prepare('DELETE FROM quizplans WHERE id=?');
                            $sonuc=$sorgu->execute([$_GET['sil']]);
                            if($sonuc){
                              echo '  <div class="alert alert-success alert-dismissible fade in">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                              Sınav Başarılı Şekilde Silindi. Yenileniyor !
                              </div>';
                              header('refresh:2;url=settings.php');
                            }
                            else
                              echo("Kayıt silinemedi.");
                        }
                        ?>
                        </div>
                        <div class="col-sm-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Sisteme Sınav Düzeneği Ekleyin</h3>
                                </div>
                        <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <h3 class="header-title m-t-0"><small></small></h3>

                                             <form action="settings.php?ekle" method="post">
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
                                                          foreach($tablocek as $cek){?>


                                                          <option><?= $cek->name ?></option>



                                                      <?php } ?>
                                                        </select>

                                                    </div>
                                                  </div>
                                                    <div class="form-group">
                                                      <label>Hangi Sınıflar İçin?</label>
                                                      <div>
                                                          <select name="sinif" class="form-control">
                                                            <?php
                                                            foreach($sinifCek as $cek){?>


                                                            <option><?= $cek->name ?></option>



                                                        <?php } ?>
                                                          </select>

                                                      </div>

                                                </div>
                                                  <div class="form-group">
                                                      <label>Çıkacak Soru Limiti</label>
                                                      <input name="limit" type="number" class="form-control" required
                                                             placeholder="Lütfen Rakam Giriniz"/>
                                                  </div>
                                                  <div class="form-group">
                                                      <label>Bölüm Sırası</label>
                                                      <input name="sira" type="number" class="form-control" required
                                                      placeholder="Lütfen Rakam Giriniz"/>
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


        </div>
    </div> <!-- container -->

</div> <!-- content -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Eklenmiş Sınavlar Tablosu</h3>
            </div>
            <div class="panel-body">
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ders</th>
                        <th>Müfredat Konusu</th>
                        <th>Sıralama</th>
                        <th>Miktar / Limit</th>
                        <th>Hangi Sınıf İçin?</th>
                        <th>Sil</th>

                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach($plancek as $cek){?>
                      <tr>


                      <td><?= $cek->id ?></td>
                      <td><?= $cek->name ?></td>
                      <td><?= $cek->sub ?></td>
                      <td><?= $cek->list ?></td>
                      <td><?= $cek->limiti ?></td>
                      <td><?= $cek->class ?></td>

                      <td> <a type="button" href="settings.php?sil=<?= $cek->id ?>"><button class="btn btn-danger waves-effect waves-light">Sınavı Sil</button></a></td>

                      </tr>

                  <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div> <!-- End Row -->

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

</body>
</html>
