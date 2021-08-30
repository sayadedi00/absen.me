<?php
  include $_SERVER['DOCUMENT_ROOT'].'/dashboard/modules.php';
  if(!isset($_GET['id'])){
    route("dashboard");
  }

  $id = escapeString($_GET['id']);

  $conn = db();
  $check = $conn->query("SELECT * FROM users WHERE nama='' AND fingerprint_id='$id'");

  if($check->num_rows == 0){
    route("dashboard");
  }

  $title = "Mendaftarkan user";

  $data = $check->fetch_array();
  include_once "header.php";
?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Daftar</h4>
                    <p class="card-description"> Input data untuk Fingerprint dengan id <?php echo $data['fingerprint_id']; ?></p>
                    <form class="forms-sample" action="register-do" method="POST" autocomplete="off">
                      <input type="hidden" name="id" value="<?php echo $data['fingerprint_id']; ?>">
                      <div class="form-group">
                        <label for="exampleInputName1">Nama</label>
                        <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Masukan nama pendaftar">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail3" placeholder="Masukan email pendaftar">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword4" placeholder="Masukan password pendaftar">
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectGender">Kelamin</label>
                        <select name="gender" class="form-control" id="exampleSelectGender">
                          <option value="0">Pria</option>
                          <option value="1">Wanita</option>
                        </select>
                      </div>
                      <button type="submit" class="btn btn-gradient-primary mr-2">Input</button>
                      <a href="register-user" class="btn btn-light">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include_once "footer.php"; ?>