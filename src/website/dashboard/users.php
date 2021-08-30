<?php 
  include $_SERVER['DOCUMENT_ROOT'].'/dashboard/modules.php';
  $title = "Daftar user";
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
                        echo '<div class="alert alert-success">Sukses menghapus data!</div>';
                      }
                      else if(isset($_GET['failed-empty'])){
                        echo '<div class="alert alert-danger">Parameter tidak terpenuhi!</div>';
                      }
                      else if(isset($_GET['failed-id'])){
                        echo '<div class="alert alert-danger">ID tidak valid!</div>';
                      }
                    ?>
                    <h4 class="card-title">Daftar user</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Fingerprint IDs </th>
                            <th> Nama </th>
                            <th> Email </th>
                            <th> Admin </th>
                            <th> Jabatan </th>
                            <th> Tanggal Daftar </th>
                            <th> Kelamin </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $conn = db();
                            $sql = "SELECT * FROM users WHERE fingerprint_id!=0 AND nama!=''";

                            $datas = $conn->query($sql);

                            if (!$datas) {
                                echo $conn->error;
                            }

                            if($datas->num_rows == 0){
                          ?>
                          <tr>
                            <td> NONE </td>
                            <td> NONE </td>
                            <td> NONE </td>
                            <td> NONE </td>
                          </tr>
                          <?php
                            }else{
                              while($check = $datas->fetch_array()){
                                if($check['admin'] == 0) $check['admin'] = 'Bukan';
                                else $check['admin'] = 'Iya';

                                if($check['gender'] == 0) $check['gender'] = 'Pria';
                                else $check['gender'] = 'Wanita';
                          ?>
                          <tr>
                            <td> <?php echo $check['fingerprint_id']; ?> </td>
                            <td> <?php echo $check['nama']; ?> </td>
                            <td> <?php echo $check['email']; ?> </td>
                            <td> <?php echo $check['admin']; ?> </td>
                            <td> <?php echo $check['jabatan']; ?> </td>
                            <td> <?php echo $check['date']; ?> </td>
                            <td> <?php echo $check['gender']; ?> </td>
                            <td> <a class="btn btn-gradient-danger btn-rounded btn-fw" href="delete-user?id=<?php echo $check['fingerprint_id']; ?>">Hapus</button></td>
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