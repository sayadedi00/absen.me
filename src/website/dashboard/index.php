<?php
    //Includes
    include $_SERVER['DOCUMENT_ROOT'].'/dashboard/modules.php';
?>
<?php include_once "header.php"; ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center purchase-popup">
                  <p>Website masih dalam tahap pengembangan, semuanya bisa dilihat di github kami ya teman!</p>
                  <a href="https://github.com/sayadedi00/absen.me" target="_blank" class="btn download-button purchase-button ml-auto">Visit Github</a>
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
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Absensi</h4>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Total karyawan</h4>
                    <canvas id="traffic-chart"></canvas>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                  </div>
                </div>
              </div>
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
                            <th> Nama </th>
                            <th> Status </th>
                            <th> Tanggal absensi </th>
                            <th> Tipe </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              David Grey
                            </td>
                            <td>
                              <label class="badge badge-gradient-success">HADIR</label>
                            </td>
                            <td> Dec 5, 2017 </td>
                            <td> Kerja Normal </td>
                          </tr>
                          <tr>
                            <td>
                              Stella Johnson
                            </td>
                            <td>
                              <label class="badge badge-gradient-warning">TERLAMBAT</label>
                            </td>
                            <td> Dec 12, 2017 </td>
                            <td> Kerja Normal </td>
                          </tr>
                          <tr>
                            <td>
                              John Doe
                            </td>
                            <td>
                              <label class="badge badge-gradient-danger">TIDAK HADIR</label>
                            </td>
                            <td> Dec 3, 2017 </td>
                            <td> Kerja Normal </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include_once "footer.php"; ?>