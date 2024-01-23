<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="css/mycss.css">

  <title>Beasiswa</title>
</head>

<body>
  <?php
  include_once("connection.php");

  $result = mysqli_query($conn, "SELECT * FROM pendaftar");

  // Mendeteksi apakah ada parameter link page yang dikirimkan, jika ada maka variabel link page akan diisi dari parameter tersebut
  // Jika tidak maka variabel link page akan diisi dengan niali 1
  if (isset($_GET['link_page'])) {
    $link_page = $_GET['link_page'];
  } else {
    $link_page = 1;
  }

  //Mendeteksi jenis beasiswa yang dipilih dari halaman sebelumnya
  if (isset($_GET['jenis_beasiswa'])) {
    $jenis_beasiswa = $_GET['jenis_beasiswa'];
  } else {
    $jenis_beasiswa = "akademik";
  }


  //Function yang digunakan untuk menentukan link yang aktif
  function SetLinkPage($actual_link, $reference_link)
  {
    $result = "";
    if ($actual_link == $reference_link) {
      $result = "active";
    }

    return $result;
  }


  //Function yang digunakan untuk menentukan content yang aktif
  function SetContentPage($actual_content, $reference_content)
  {
    $result = "";
    if ($actual_content == $reference_content) {
      $result = "show active";
    }

    return $result;
  }

  //Function yang digunakan untuk menentukan jenis beasiswa
  function SetBeasiswa($actual_beasiswa, $reference_beasiswa)
  {
    $result = "";
    if ($actual_beasiswa == $reference_beasiswa) {
      $result = "selected";
    }

    return $result;
  }

  // function untuk men generate bilangan random untuk ipk
  function generateRandomFloat(float $minValue, float $maxValue): float
  {
    return $minValue + mt_rand() / mt_getrandmax() * ($maxValue - $minValue);
  }

  // Pengaturan Disable component jika IPK kuran dari 3

  function SetDisable($ipk)
  {
    $result = "";
    if ($ipk < 3) {
      $result = "disabled";
    }
    return $result;
  }
  ?>

  <div class="container">
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-warning">
      <a class="navbar-brand" href="#">Pendaftaran Beasiswa</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
      </div>
    </nav>
  </div> <!-- end of container -->
  <div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link <?php echo SetLinkPage("1", $link_page) ?>" id="home-tab" data-toggle="tab" href="#beasiswa" role="tab" aria-controls="home" aria-selected="true">Pilihan Beasiswa</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo SetLinkPage("2", $link_page) ?>" id="profile-tab" data-toggle="tab" href="#daftar" role="tab" aria-controls="profile" aria-selected="false">Daftar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo SetLinkPage("3", $link_page) ?>" id="contact-tab" data-toggle="tab" href="#hasil" role="tab" aria-controls="contact" aria-selected="false">Hasil</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade <?php echo SetContentPage("1", $link_page) ?>" id="beasiswa" role="tabpanel" aria-labelledby="home-tab">
        <div class="section-menu">
          <h4>Jenis Beasiswa</h4>
          <p>Di tengah dinamika dunia pendidikan yang terus berkembang, beasiswa telah menjadi sinar harapan bagi banyak individu yang merindukan peluang untuk meraih pendidikan lebih tinggi atau mengembangkan bakat mereka. Beasiswa tidak hanya mewakili dukungan finansial, tetapi juga merupakan jembatan menuju aspirasi dan tujuan akademik. Dengan beragam jenis dan kriteria, beasiswa menciptakan peluang bagi para pelajar untuk menjelajahi potensi penuh mereka tanpa terbebani oleh keterbatasan keuangan. Tren ini mencerminkan komitmen global untuk memajukan pendidikan dan menciptakan lingkungan inklusif di mana setiap individu memiliki kesempatan yang adil untuk tumbuh dan berkontribusi.</p>
          <ol>
            <li>
              <h5>Beasiswa Akademik</h5>
              <p>Beasiswa akademik merupakan bentuk penghargaan yang diberikan kepada siswa yang telah mencapai prestasi akademik yang luar biasa. Beasiswa ini memberikan peluang finansial yang berharga serta pengakuan atas kerja keras dalam meraih keunggulan dalam studi. Syarat penerimaan beasiswa akademik sering kali melibatkan pencapaian Indeks Prestasi Kumulatif (IPK) yang tinggi.</p>
              <p>Beberapa persyaratan penting yang harus dipenuhi antara lain::</p>
              <ul>
                <li>
                  <p>Prestasi Akademik: Salah satu persyaratan utama untuk mendapatkan beasiswa akademik adalah memiliki rekam jejak prestasi akademik yang baik. Ini sering diukur dengan nilai atau IPK tinggi. Beberapa beasiswa mungkin menetapkan batas nilai minimum yang harus dipenuhi.</p>
                </li>
                <li>
                  <p>Pendaftaran di Program atau Institusi Tertentu: Beberapa beasiswa mungkin hanya tersedia untuk mereka yang terdaftar atau akan mendaftar di program atau institusi tertentu. Ini bisa berarti program studi tertentu, universitas, atau sekolah khusus.</p>
                </li>
                <li>
                  <p>Surat Rekomendasi: Beberapa beasiswa memerlukan surat rekomendasi dari dosen atau profesional yang mengenal Anda dan dapat memberikan referensi tentang kemampuan akademik dan kepribadian Anda.</p>
                </li>
                <li>
                  <p>Persyaratan Khusus: Beberapa beasiswa memiliki persyaratan khusus yang berkaitan dengan bidang studi tertentu, seperti ilmu pengetahuan, teknologi, teknik, atau matematika (STEM), atau mungkin terkait dengan tujuan tertentu seperti penelitian atau pengabdian masyarakat.
                  </p>
                </li>
              </ul>
              <p>Persyaratan untuk mendapatkan beasiswa akademik dapat bervariasi tergantung pada lembaga atau organisasi yang menawarkannya, jenis beasiswa, dan negara tempat Anda tinggal atau studi. Namun, ada beberapa persyaratan umum yang seringkali diterapkan dalam proses seleksi beasiswa akademik. </p>

              <a class="btn btn-warning btn-lg my-large-btn" href="index.php?link_page=2&jenis_beasiswa=akademik">Daftar Sekarang</a>

            </li>
            <li>
              <h5>Beasiswa Non Akademik</h5>
              <p>Beasiswa non-akademik adalah jenis beasiswa yang diberikan kepada individu berdasarkan kriteria atau faktor selain prestasi akademik mereka. Ini berarti penerima beasiswa tidak dipilih berdasarkan nilai, IPK, atau pencapaian akademik tradisional, tetapi berdasarkan faktor-faktor lain seperti bakat, minat, kegiatan ekstrakurikuler, atau latar belakang pribadi. Beasiswa non-akademik dirancang untuk mendukung perkembangan individu dalam bidang-bidang tertentu atau untuk mengakses pendidikan dan pelatihan yang mereka butuhkan untuk mencapai tujuan mereka.</p>
              <p>Adapun Persyaratan yang dibutuhkan adalah :</p>
              <ul>
                <li>
                  <p>Bakat atau Keterampilan Khusus: Beasiswa non-akademik seringkali diberikan kepada individu yang memiliki bakat atau keterampilan khusus dalam bidang seperti seni, musik, olahraga, atau bahkan teknologi. Misalnya, seorang pemain piano yang sangat berbakat mungkin dapat mendapatkan beasiswa musik.</p>
                </li>
                <li>
                  <p>Prestasi Olahraga: Beasiswa atletik adalah jenis beasiswa non-akademik yang diberikan kepada atlet yang mencapai tingkat prestasi tertentu dalam olahraga mereka.</p>
                </li>
                <li>
                  <p>Partisipasi dalam Kegiatan Ekstrakurikuler: Beberapa beasiswa non-akademik mempertimbangkan partisipasi Anda dalam kegiatan ekstrakurikuler di sekolah atau dalam masyarakat, seperti klub, organisasi, atau proyek khusus.</p>
                </li>
              </ul>
              <p>Setiap beasiswa non-akademik akan memiliki kriteria dan persyaratan yang unik, tergantung pada tujuan dan nilai yang ingin dicapai oleh pemberi beasiswa. </p>
              <a class="btn btn-warning btn-lg my-large-btn" href="index.php?link_page=2&jenis_beasiswa=non_akademik">Daftar Sekarang</a>

            </li>
            </li>
          </ol>
        </div>

      </div>

      <div class="tab-pane fade <?php echo SetContentPage("2", $link_page) ?>" id="daftar" role="tabpanel" aria-labelledby="profile-tab">
        <div class="section-menu">
          <h4>Form Pendaftaran</h4>

          <form action="add_pendaftar.php" method="post" enctype="multipart/form-data">
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="Email" placeholder="Email" name="email" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="hp" class="col-sm-2 col-form-label">No. Handphone</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="hp" placeholder="Handphone" name="hp" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="semester" class="col-sm-2 col-form-label">Semester</label>
              <div class="col-sm-10">
                <select class="form-control" name="semester" id="semester" required>
                  <?php
                  for ($i = 1; $i <= 8; $i++) {
                  ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <?php
            $minValue = 2.9;
            $maxValue = 3.4;
            $ipk = round(generateRandomFloat($minValue, $maxValue), 1);

            ?>

            <div class="form-group row">
              <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ipk" name="ipk" value="<?php echo $ipk ?>" required readonly>
              </div>
            </div>

            <div class="form-group row">
              <label for="beasiswa" class="col-sm-2 col-form-label">Beasiswa</label>
              <div class="col-sm-10">
                <select class="form-control" name="beasiswa" id="beasiswa" required <?php echo SetDisable($ipk) ?>>
                  <option value="akademik" <?php echo SetBeasiswa("akademik", $jenis_beasiswa) ?>>Akademik</option>
                  <option value="non_akademik" <?php echo SetBeasiswa("non_akademik", $jenis_beasiswa) ?>>Non Akademik</option>
                </select>


              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label" for="upload_file">Choose file</label>
              <div class="col-sm-10">
                <input type="file" class="form_control" id="customFile" name="berkas" required <?php echo SetDisable($ipk) ?>>
              </div>
            </div>

            <input class="btn btn-warning btn-lg" type="submit" value="Daftar" <?php echo SetDisable($ipk) ?>>

            <a class="btn btn-secondary btn-lg" href="index.php?link_page=2">Batal</a>
          </form>

        </div>

      </div>

      <div class="tab-pane fade <?php echo SetContentPage("3", $link_page) ?>" id="hasil" role="tabpanel" aria-labelledby="contact-tab">
        <div class="section-menu">
          <h4>List Pendaftar</h4>

          <?php
          while ($user_data = mysqli_fetch_array($result)) {
          ?>

            <div class="row grid-item">
              <div class="col-md-3 col-lg-4">
                <img class="img-fluid" src="uploads/<?php echo $user_data['berkas']; ?>" alt="">
              </div>
              <div class="col-md-9 col-lg-8">

                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <h4>Nama:</h4>
                    <h5><?php echo $user_data['nama']; ?></h5>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <h4>Email:</h4>
                    <h5><?php echo $user_data['email']; ?></h5>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <h4>Handpone:</h4>
                    <h5><?php echo $user_data['hp']; ?></h5>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <h4>Semester:</h4>
                    <h5><?php echo $user_data['semester']; ?></h5>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <h4>IPK:</h4>
                    <h5><?php echo $user_data['ipk']; ?></h5>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <h4>Beasiswa:</h4>
                    <h5><?php echo $user_data['beasiswa']; ?></h5>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-4">
                    <h4>Status:</h4>
                    <h5><?php echo $user_data['status']; ?></h5>
                  </div>

                </div>

              </div>
            </div>

          <?php
          }
          ?>

        </div>

      </div>
    </div>
  </div> <!-- end of container -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>