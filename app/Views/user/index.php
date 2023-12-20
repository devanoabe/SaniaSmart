<?= $this->extend('template/content') ?>

<?php $this->section('content') ?>

<style type="text/css">
  h1 {
    word-wrap: break-word;
    -webkit-hyphens: auto;
    -moz-hyphens: auto;
    -ms-hyphens: auto;
    -o-hyphens: auto;
    hyphens: auto;
    font-size: 38px;
    font-family: 'Noto Sans', sans-serif;
    color: white;
  }

  p {
    font-weight: 100;
  }

  .text {
    color: black;
    font-weight: 600;
  }

  .icon {
    color: black;
  }

  .card {
    background: #0D0A09;
    border: none;
    border-radius: 20px;
  }

  @media screen and (max-width: 768px) {
    h1 {
      font-size: 21px;
      text-align: center;
      font-family: 'Noto Sans', sans-serif;
      color: white;
    }

    p {
      text-align: center;
    }

    .btn {
      float: center;
    }

    .coba {
      padding-top: 100px
    }
  }
</style>

<div class="section">
  <div class="row justify-content-center px-5 py-3">
    <div class="col-md-8">
      <h1>Kapan sebuah website membantumu merasa terbantu dalam mengambil keputusan?</h1>
      <p class="pt-1">
        Kami akan memberikan contoh penggunaan SMART dalam berbagai konteks, seperti pemilihan Laptop dengan kriteria RAM dan banyak lagi. Anda akan melihat bagaimana AHP dapat membantu menghasilkan keputusan yang lebih baik.
      </p>
    </div>
    <div class="col-md-4 px-5">
      <div class="card">
        <div class="text-center">
          <img src="<?= base_url() ?>/img/undraw_profile.svg" class="card-img-top mt-4" style="width: 80px">
        </div>
        <div class="card-body">
          <ul class="list-group list-group-flush pl-1">
            <!-- <li style="background: #0D0A09;" class="list-group-item"><span style="background: #F55127" class="badge p-2"> <?= $data['role']; ?></span></li> -->
            <label style="color: #707070; font-size: 14px">Nama :</label>
            <li style="background: #0D0A09; color: white; margin-top: -12px" class="list-group-item"><?= $data['nama']; ?> </li>
            <label style="color: #707070; font-size: 14px">Username :</label>
            <li style="background: #0D0A09; color: white; margin-top: -12px" class="list-group-item"><?= $data['username']; ?> </li>
          </ul>
          <hr class="mb-2 mt-3">
          <div class="text-right pr-2 pb-2">
            <a style="background: #F55127; color: black; padding: 5px 14px; border-radius: 120px; font-size: 14px" href="#" data-toggle="modal" data-target="#modalBoxUbah" data-id="<?= $data['id_user']; ?>" class="card-link update-profile">Ubah Profil</a>
            <!-- <a href="#" data-toggle="modal" data-target="#mbUbahPassword" data-id="<?= $data['id_user']; ?>" class="card-link">Ubah Password</a> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center pt-5">
    <div class="col-md-12">
      <center> <img src="<?= base_url() ?>/img/bg.png" class="card-img-top mt-2"></center>
    </div>
  </div>


  <div class="modal fade" id="modalBoxUbah" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="/user/update" method="POST" id="formUbah">

          <div class="d-flex justify-content-between">
            <div class="judul-1">
              <h1>Edit Data</h1>
              <p>Form untuk mengedit data yang tersimpan terkait halaman ini!</p>
            </div>
            <div class="img-judul">
              <center> <img src="<?= base_url() ?>/img/mail.png" class="card-img-top mt-2"></center>
            </div>
          </div>

          <div class="modal-body">
            <?= csrf_field(); ?>
            <input type="hidden" name="id_user" id="id_user">
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username">
              <div class="invalid-feedback"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn cancel" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-simpan submit">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>

  <!-- <div class="modal fade" id="mbUbahPassword" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header badge-primary">
          <h5 class="modal-title text-white"><i class="fa fa-key"></i> Change Password</h5>
        </div>

        <form action="/auth/managePassword/update" method="POST" id="formUbahPassword">
          <div class="modal-body">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="current-password">Password Lama</label>
              <input type="password" name="current-password" id="current-password" class="form-control" placeholder="Masukkan password saat ini" autocomplete="false">
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="new-password">Password Baru</label>
              <input type="password" name="new-password" id="new-password" class="form-control" placeholder="Masukkan password baru" autocomplete="false">
              <div class="invalid-feedback"></div>
            </div>
            <div class="form-group">
              <label for="confirm-password">Konfirmasi Password</label>
              <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Konfirmasi password baru" autocomplete="false">
              <div class="invalid-feedback"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-simpan">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div> -->

</div>
<?= $this->endSection(); ?>

<?= $this->section('custom-js'); ?>
<script>
  $(document).ready(function() {
    $('.update-profile').on('click', function(e) {

      let id = $(this).data('id');
      $.ajax({
        url: '/user/getDataById',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          $.each(response, function(key, val) {
            $('[name="' + key + '"]').val(val)
          })
        }
      });
    })

    const formUbah = $('#formUbah')
    formUbah.submit(function(e) {
      e.preventDefault()
      requestSaveData(formUbah, '#modalBoxUbah')
      removeClasses('#formUbah')
    })

    const formUbahPassword = $('#formUbahPassword')
    formUbahPassword.submit(function(e) {
      e.preventDefault()
      requestSaveData(formUbahPassword, '#mbUbahPassword')
      removeClasses('#formUbahPassword')
    })
  })
</script>
<?= $this->endSection(); ?>