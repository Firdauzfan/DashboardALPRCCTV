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
    <div class="container" style="margin-bottom:100px">
            <div class="row">
                <h3>Dashboard Data Pengguna Parkir</h3>
            </div>
            <div class="row">

                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pengguna</th>
                      <th>NIP</th>
                      <th>Unit</th>
                      <th>Plat Nomor</th>
                      <th>Waktu</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <div id="pageone" data-role="main" class="ui-content">
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql2='DELETE t1 FROM track_plat t1 INNER JOIN track_plat t2 WHERE t1.id_track>t2.id_track AND t1.plat_no=t2.plat_no';
                   $q = $pdo->prepare($sql2);
                   $q->execute();
                   $sql = 'SELECT pengguna.id_pengguna, pengguna.nama_pengguna, pengguna.nip, pengguna.unit,plat_nomor.text_plat,track_plat.waktu FROM pengguna,plat_nomor,track_plat WHERE pengguna.id_pengguna=plat_nomor.kepunyaan AND track_plat.plat_no=plat_nomor.text_plat ORDER BY pengguna.id_pengguna DESC';                   
                   
                   // $time=date("Y-m-d");

                   // echo $time;
                   $no=1;
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $no++ . '</td>';
                            echo '<td>'. $row['nama_pengguna'] . '</td>';
                            echo '<td>'. $row['nip'] . '</td>';
                            echo '<td>'. $row['unit'] . '</td>';
                            echo '<td>'. $row['text_plat'] . '</td>';
                            echo '<td>'. $row['waktu'] . '</td>';
                            echo '<td width=250>';                          
                            echo '<a class="btn" href="read.php?id='.$row['id_pengguna'].'">Lihat</a>';
                            echo ' ';
                            // echo '<a class="btn" href="delete.php?id='.$row['id_pengguna'].'">Delete</a>';
                            echo '</td>';
                            /*
                            echo '<a class="btn btn-success" href="update.php?id='.$row['id_pengguna'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id_pengguna'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                            */
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>

            </div>
    </div> <!-- /container -->


  </body>

  <footer>
    <div class="container">
        <ul>
            <li><a href="//www.gspe.co.id">GSPE Website</a></li>
        </ul>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

  <script type="text/javascript">
  setTimeout(function(){
  window.location.reload(1);
  }, 10000);
  </script>
</html>