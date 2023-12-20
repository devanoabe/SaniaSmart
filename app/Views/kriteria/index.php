<?= $this->extend('template/content'); ?>

<?php $this->section('content'); ?>

<div class="section">
  <div class="row">
    <div class="col-md-12">

      <div class="row mb-4">
        <div class="col-md-12">
          <div class="card shadow">
            <?php if (session('role') === 'Admin') : ?>
              <div class="d-flex justify-content-between px-3 pt-4">
                <h1 class="jdl"><?= $judul; ?></h1>
                <button class="btn btn-tambah tbh" data-toggle="modal" data-target="#modalBoxTambah" data-backdrop="static" data-keyboard="false"><i class="fas fa fa-plus"></i> Tambah</button>
              </div>
              <div class="card-header d-flex justify-content-end">
                <button class="btn btn-hapus hps"><i class="fas fa fa-trash-alt"></i> Hapus</button>
                <button class="btn btn-ubah ubh"><i class="fas fa fa-edit"></i> Ubah</button>
              </div>
            <?php endif; ?>
            <div class="card-body">
              <table class="table table-borderless table-striped table-kriteria" id="example">
                <thead>
                  <th>
                    <input type="checkbox" id="checkboxes">
                  </th>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Jenis</th>
                  <th>Tipe Data</th>
                </thead>
                <tbody>
                  <?php foreach ($kriteria as $key => $row) : ?>
                    <tr>
                      <td>
                        <input type="checkbox" name="id[]" class="checkbox" value="<?= $row['id_kriteria']; ?>">
                      </td>
                      <td><?= $key + 1; ?></td>
                      <td><?= ucfirst(str_replace("_", " ", $row['nama'])); ?></td>
                      <td><?= $row['jenis'] == 'bc' ? 'Benefit Criteria' : 'Cost Criteria'; ?></td>
                      <td><?= $row['data_kuantitatif'] == 1 ? 'Kuantitatif' : 'Kualitatif'; ?></td>
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
                <h1>Tammbah Data</h1>
                <p>Form untuk tambah data yang tersimpan terkait halaman ini!</p>
              </div>
              <div class="img-judul">
                <center> <img src="<?= base_url() ?>/img/mail.png" class="card-img-top mt-2"></center>
              </div>
            </div>
            <form action="/kriteria/create" method="POST" class="formSubmit" id="formTambah">
              <div class="modal-body">
                <?= csrf_field(); ?>
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama kriteria..">
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="jenis">Jenis</label>
                  <select name="jenis" class="form-control" id="jenis">
                    <option value="">-- Pilih --</option>
                    <option value="cc">Cost Criteria</option>
                    <option value="bc">Benefit Criteria</option>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="data_kuantitatif">Tipe Data</label>
                  <select name="data_kuantitatif" class="form-control" id="data_kuantitatif">
                    <option value="">-- Pilih --</option>
                    <option value="1">Kuantitatif</option>
                    <option value="0">Kualitatif</option>
                  </select>
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

      <!-- Modal Ubah -->
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
            <form action="/kriteria/update" method="POST" class="formSubmit" id="formUbah">
              <div class="modal-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_kriteria" id="id_ubah">
                <div class="form-group">
                  <label for="nama_ubah">Nama</label>
                  <input type="text" name="nama" id="nama_ubah" class="form-control" placeholder="Nama kriteria..">
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="jenis_ubah">Jenis</label>
                  <select name="jenis" id="jenis_ubah" class="form-control">
                    <option value="">-- Pilih --</option>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                  <label for="data_kuantitatif_ubah">Data Kuantitatif</label>
                  <select name="data_kuantitatif" id="data_kuantitatif_ubah" class="form-control">
                    <option value="">-- Pilih --</option>
                  </select>
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


<?php $this->section('custom-js'); ?>
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
      requestDeleteData('/kriteria/delete')
    })

    $('.btn-ubah').on('click', function(e) {
      requestGetDataById('/kriteria/getDataById', 'kriteria')
    })

    const formUbah = $('#formUbah')
    formUbah.submit(function(e) {
      e.preventDefault()

      requestSaveData(formUbah, '#modalBoxUbah')

      removeClasses('#formUbah')
    })
  })
</script>
<?php $this->endSection(); ?>