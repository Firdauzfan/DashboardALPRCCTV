<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM pengguna,plat_nomor where id_pengguna = ? AND pengguna.id_pengguna=plat_nomor.kepunyaan";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" href="img/fav-gspe.png" style="width: 50px;height: 25px;">
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="js/bootstrap.min.js"></script>

    <title>Data Pengguna Parkir</title>
</head>
 
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="//www.gspe.co.id">
                    <img alt="GSPE" src="img/gspel.png" style="width: 100%;height:100%">
                </a>
            </div>
            <!-- <p class="navbar-text pull-right"><a id="buttonLogout" href="#" class="navbar-link">Sign Out</a></p> -->
        </div>
    </nav>
    <div class="container" align="center">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Lihat Pengguna Parkir</h3>
                    </div>
                    <?php $url= $data['text_plat']."_screenshot_".date("d.m.Y").".png" ;?>
                     
                    <div class="form-vertical" >
                    <table class="table table-striped table-bordered">
                      <tr style="padding: 10px;">
                        <td>Nama</td>
                        <td>NIP</td>
                        <td>Unit</td>
                        <td>Action</td>
                      </tr>
                      <tr>
                        <td><?php echo $data['nama_pengguna'];?></td>
                        <td><?php echo $data['nip'];?></td>
                        <td><?php echo $data['unit'];?></td>
                        <td><a href="#myPopup" data-rel="popup" data-position-to="window" class="btn">Lihat</a></td>
                      </tr>
                    </table>
                    
                     <!--  <div class="control-group">
                        <label class="control-label">Nama : <?php echo $data['nama_pengguna'];?></label>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Nip : <?php echo $data['nip'];?></label>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Unit : <?php echo $data['unit'];?></label>
                      </div>
                      <div class="control-group">
                      <a href="#myPopup" data-rel="popup" data-position-to="window" class="btn">Lihat</a>
                      </div> -->
                        <div class="form-actions">
                          <a class="btn" href="index.php">Back</a>
                       </div>
                    </div>
                </div>

            <div data-role="popup" id="myPopup"> 
                      <p>Plat Nomor = <?= $data['text_plat'] ?></p>
                      <a href="#pageone" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-btn-a ui-icon-delete ui-btn-icon-notext ui-btn-right">Close</a><img src="img/Plat/<?php echo $url;?>" style="width:800px;height:400px;" alt="Plat Nomor">
            </div>
    </div> <!-- /container -->

  <footer>
      <div class="container">
          <ul>
              <li><a href="//www.gspe.co.id">GSPE Website</a></li>
          </ul>
      </div>
  </footer>

  </body>

  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

</html>