<?= $this->extend('template/content'); ?>

<?php $this->section('content'); ?>

<div class="section">
  <div class="row">
    <div class="col-md-12">
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card shadow">

            <?php if (session('role') === 'Admin') : ?>
              <div class="d-flex justify-content-between px-3 pt-4">
                <h1 class="jdl"><?= $judul; ?></h1>
                <button type="button" class="btn btn-tambah tbh" data-toggle="modal" data-target="#modalBoxTambah" data-backdrop="static" data-keyboard="false"><i class="fas fa fa-plus"></i> Tambah</button>
              </div>
              <div class="card-header d-flex justify-content-end">
                <button type="button" class="btn btn-hapus hps"><i class="fas fa fa-trash-alt"></i> Hapus</button>
                <button type="button" class="btn btn-ubah ubh"><i class="fas fa fa-edit"></i> Ubah</button>
              </div>
            <?php endif; ?>
            <button style="background-color: #F1491E; color: black; font-weight: bolder" type="button" class="btn btn-normalisasi py-2 mx-3 my-3"><i class="fas fa fa-recycle"></i> Update Normalisasi Bobot</button>

            <div class="card-body">
              <table class="table table-borderless table-striped table-kriteria" id="example">
                <thead>
                  <th>
                    <input type="checkbox" id="checkboxes">
                  </th>
                  <th>No.</th>
                  <th>Kriteria</th>
                  <th>Nilai Bobot</th>
                  <?php if ($normalisasi_bobot) : ?>
                    <th>Nilai Ternormalisasi</th>
                  <?php endif; ?>
                </thead>
                <tbody>
                  <?php foreach ($bobot as $key => $row) : ?>
                    <tr>
                      <td>
                        <input type="checkbox" name="id[]" class="checkbox" value="<?= $row['id_pembobotan']; ?>">
                      </td>
                      <td><?= $key + 1; ?></td>
                      <td><?= ucfirst(str_replace("_", " ", $row['nama_kriteria'])); ?></td>
                      <td><?= $row['nilai_bobot']; ?></td>
                      <?php if ($normalisasi_bobot) : ?>
                        <td><?= $normalisasi_bobot[$key]['nilai_normalisasi_bobot']; ?></td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalBoxTambah" tabindex="-1" role="dialog" aria-labelledby="modalBoxTambahTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="d-flex justify-content-between">
              <div class="judul-1">
                <h1>Tambah Data</h1>
                <p>Form untuk tambah data yang tersimpan terkait halaman ini!</p>
              </div>
              <div class="img-judul">
                <center> <img src="<?= base_url() ?>/img/mail.png" class="card-img-top mt-2"></center>
              </div>
            </div>

            <form action="/bobot/create" method="POST" class="formSubmit" id="formTambah">
              <div class="modal-body">
                <?= csrf_field(); ?>

                <div class="form-group">
                  <label for="kriteria">Kriteria</label>
                  <select name="id_kriteria" class="form-control" id="kriteria">
                    <option value="">-- Pilih --</option>
                    <?php foreach ($kriteria->getResultArray() as $row) : ?>
                      <option value="<?= $row['id_kriteria']; ?>"><?= ucfirst(str_replace("_", " ", $row['nama'])); ?></option>
                    <?php endforeach; ?>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="nilai_bobot">Nilai Bobot</label>
                  <input type="number" class="form-control" name="nilai_bobot" id="nilai_bobot" placeholder="Nilai bobot.." min="1" max="100">
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn cancel" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-simpan submit"><i class="fas fa fa-save"></i> Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modalBoxUbah" tabindex="-1" role="dialog" aria-labelledby="modalBoxUbahTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="d-flex justify-content-between">
              <div class="judul-1">
                <h1>Edit Data</h1>
                <p>Form untuk edit data yang tersimpan terkait halaman ini!</p>
              </div>
              <div class="img-judul">
                <center> <img src="<?= base_url() ?>/img/mail.png" class="card-img-top mt-2"></center>
              </div>
            </div>

            <form action="/bobot/update" method="POST" class="formSubmit" id="formUbah">
              <div class="modal-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_pembobotan" id="id_ubah">

                <div class="form-group">
                  <label for="kriteria_ubah">Kriteria</label>
                  <input type="text" name="nama_kriteria" id="kriteria_ubah" class="form-control" readonly>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="nilai_bobot_ubah">Nilai Bobot</label>
                  <input type="number" class="form-control" name="nilai_bobot" id="nilai_bobot_ubah" min="1" max="100">
                  <div class="invalid-feedback"></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn cancel" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-simpan submit"><i class="fas fa fa-save"></i> Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php $this->endSection(); ?>

<?= $this->section('custom-js'); ?>
<script>
  $(document).ready(function() {

    $('#example').DataTable({
      paging: false,
      scrollCollapse: true,
      scrollY: '800px'
    });

    const formTambah = $('#formTambah')
    formTambah.submit(function(e) {
      e.preventDefault()

      requestSaveData(formTambah, '#modalBoxTambah')

      removeClasses('#formTambah')
    })

    $('.btn-hapus').on('click', function() {
      requestDeleteData('/bobot/delete')
    })

    $('.btn-ubah').on('click', function(e) {
      requestGetDataById('/bobot/getDataById')
    })

    const formUbah = $('#formUbah')
    formUbah.submit(function(e) {
      e.preventDefault()

      requestSaveData(formUbah, '#modalBoxUbah')

      removeClasses('#formUbah')
    })

    $('.btn-normalisasi').on('click', function() {
      $.ajax({
        url: '/NormalisasiBobot/normalisasi',
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
          $('.btn-normalisasi').html('loading.. <span class="spinner-border spinner-border-sm"></span>')
        },
        complete: function() {
          $('.btn-normalisasi').html('<i class="fas fa fa-recycle"></i>  Update Normalisasi Bobot')
        },
        success: function(response) {
          if (!response.warning) {
            toastSuccess(response)
            reload()
          } else {
            toastAlert(response)
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
        }
      })
    })
  })
</script>
<?= $this->endSection(); ?>