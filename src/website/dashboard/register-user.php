<?php 
  include $_SERVER['DOCUMENT_ROOT'].'/dashboard/modules.php';
  include_once "header.php"; 
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <?php
                      if(isset($_GET['success'])){
                        echo '<div class="alert alert-success">Berhasil memasukan user ke database!</div>';
                      }
                      else if(isset($_GET['failed-post'])){
                        echo '<div class="alert alert-danger">Only POST request Received</div>';
                      }
                      else if(isset($_GET['failed-empty'])){
                        echo '<div class="alert alert-danger">Tolong masukan semua data!</div>';
                      }
                      else if(isset($_GET['failed-email'])){
                        echo '<div class="alert alert-danger">Email tidak valid!</div>';
                      }
                      else if(isset($_GET['failed-password'])){
                        echo '<div class="alert alert-danger">Password harus setidaknya 8 karakter</div>';
                      }
                      else if(isset($_GET['failed-same'])){
                        echo '<div class="alert alert-danger">Email sudah digunakan</div>';
                      }
                    ?>
                    <h4 class="card-title">Mendaftarkan user</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Kode Random </th>
                            <th> Tanggal Daftar </th>
                            <th> Tombol </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $conn = db();
                            $sql = "SELECT * FROM users WHERE fingerprint_id!=0 AND nama=''";

                            $datas = $conn->query($sql);

                            if (!$datas) {
                                echo $conn->error;
                            }

                            if($datas->num_rows == 0){
                          ?>
                          <tr>
                            <td> (NONE) </td>
                            <td> (NONE) </td>
                            <td> (NONE) </td>
                            <td> (NONE) </td>
                          </tr>
                          <?php
                            }else{
                              while($check = $datas->fetch_array()){
                          ?>
                          <tr>
                            <td> <?php echo $check['fingerprint_id']; ?> </td>
                            <td> <?php echo generateRandomStrings(40); ?> </td>
                            <td> <?php echo $check['date']; ?> </td>
                            <td> <a class="btn btn-gradient-primary btn-rounded btn-fw" href="register?id=<?php echo $check['fingerprint_id']; ?>">Daftar</button></td>
                          </tr> 
                          <?php
                              }
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