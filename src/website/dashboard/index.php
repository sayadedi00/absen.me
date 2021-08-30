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
            </div>
            <div class="row">
              <div class="col-md-8 grid-margin stretch-card">
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
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-white">Todo</h4>
                    <div class="add-items d-flex">
                      <input type="text" class="form-control todo-list-input" placeholder="Mau mengerjakan apa hari ini?">
                      <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">+</button>
                    </div>
                    <div class="list-wrapper">
                      <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                        <li>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input class="checkbox" type="checkbox"> Mengerjakan tugas Microcontroller <i class="input-helper"></i></label>
                          </div>
                          <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Delete this !-->
            <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <div class="clearfix">
                      <h4 class="card-title float-left">Kunjungan</h4>
                      <div id="" class="rounded-legend legend-horizontal legend-top-right float-right"><ul><li><span class="legend-dots" style="background:linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))"></span>SBY</li><li><span class="legend-dots" style="background:linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))"></span>JKT</li><li><span class="legend-dots" style="background:linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))"></span>MNG</li></ul></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4 chartjs-render-monitor" style="display: block; height: 111px; width: 223px;" width="669" height="333"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Absensi hari ini</h4>
                    <canvas id="traffic-chart" width="669" height="333" style="display: block; height: 111px; width: 223px;" class="chartjs-render-monitor"></canvas>
                    <div id="" class="rounded-legend legend-vertical legend-bottom-left pt-4"><ul><li><span class="legend-dots" style="background:linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))"></span>Hadir<span class="float-right">30%</span></li><li><span class="legend-dots" style="background:linear-gradient(to right, rgba(6, 185, 157, 1), rgba(132, 217, 210, 1))"></span>Tidak Hadir<span class="float-right">30%</span></li><li><span class="legend-dots" style="background:linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))"></span>Terlambat<span class="float-right">40%</span></li></ul></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include_once "footer.php"; ?>