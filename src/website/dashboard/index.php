<?php 
  include $_SERVER['DOCUMENT_ROOT'].'/dashboard/modules.php';
  include_once "header.php"; 
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p class="mr-auto">Website masih dalam tahap pengembangan, semuanya bisa dilihat di <a href="https://github.com/sayadedi00/absen.me">Github</a> kami ya teman!</p>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Absensi terakhir</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Tipe </th>
                            <th> Nama </th>
                            <th> Status </th>
                            <th> Tanggal absensi </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $conn = db();
                            $sql = "SELECT * FROM absent ORDER by `tanggal` DESC LIMIT 5";
                            $absent = $conn->query($sql);

                            while($row = $absent->fetch_array()){

                              $id = $row['user_id'];

                              $sql = "SELECT * FROM users WHERE fingerprint_id='$id'";

                              $users = $conn->query($sql);
                              $users = $users->fetch_array();

                              if($row['type'] == 'Terlambat'){
                                $row['type'] = '<label class="badge badge-gradient-warning">TERLAMBAT</label>';
                              }
                              else if($row['type'] == 'Hadir'){
                                $row['type'] = '<label class="badge badge-gradient-success">HADIR</label>';
                              }
                              else if($row['type'] == 'Tidak Hadir'){
                                $row['type'] = '<label class="badge badge-gradient-danger">TIDAK HADIR</label>';
                              }

                              if($row['day'] == 0){
                                $row['day'] = '<label class="badge badge-gradient-success">Masuk</label>';
                              }
                              else{ 
                                $row['day'] = '<label class="badge badge-gradient-danger">Pulang</label>'; 
                              }
                          ?>
                          <tr>
                            <td> <?php echo $row['day']; ?> </td>
                            <td>
                              <?php echo $users['nama']; ?>
                            </td>
                            <td>
                              <?php echo $row['type']; ?>
                            </td>
                            <td> <?php echo $row['tanggal']; ?> </td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include_once "footer.php"; ?>