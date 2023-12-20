// Nilai Akhir
<?= $this->extend('template/content'); ?>

<?php $this->section('content'); ?>

<section>
  <div class="row mt-4">
    <div class="col-md-12">

      <?php if ($kriteria && $alternatif && $nilai_akhir) : ?>

        <div class="card shadow">
          <div class="card-header">
            <div class="row">
              <div class="col-md-9">
                <h3 class="jdl">Tabel Nilai Akhir</h3>
              </div>
              <div class="col-md-3">
                <form action="/report/excelReporting" method="POST" class="d-inline">
                  <button type="submit" class="btn btn-success float-right" name="excel"><i class="fa fa-file-excel"></i> Excel</button>
                </form>
                <form action="/report/pdfReporting" method="POST" class="d-inline">
                  <button type="submit" class="btn btn-danger float-right mx-2" name="pdf"><i class="fa fa-file-pdf"></i> PDF</button>
                </form>
              </div>
            </div>
            <button style="background-color: #F1491E; color: black; font-weight: bolder" type="button" class="btn mx-1 btn-nilai-akhir"><i class="fas fa fa-recycle"></i> Update Nilai Akhir</button>
          </div>
          <div class="card-body">
            
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-kriteria" id="example">
                <thead>
                  <th>Peringkat</th>
                  <th>Alternatif</th>
                  <th>Nilai Akhir</th>
                </thead>
                <tbody>
                  <?php foreach ($nilai_akhir as $key => $row) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $row['kode']; ?></td>
                      <td><?= $row['nilai_akhir']; ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      <?php else : ?>

        <div class="row">
          <div class="col-md-6">
            
              
                <div class="alert " role="alert">
                <strong class="text-center">Data Belum Ada, </strong> <button style="background-color: #F1491E; color: black; font-weight: bolder" type="button" class="btn mx-1 btn-nilai-akhir"><i class="fas fa fa-recycle"></i> Tentukan Nilai Akhir</button>
                </div>
              
            
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php $this->endSection(); ?>


<?php $this->section('custom-js') ?>
<script>
  $(document).ready(function() {

    $('#example').DataTable({
      paging: false,
      scrollCollapse: true,
      scrollY: false
    });

    $('.btn-nilai-akhir').on('click', function() {
      $.ajax({
        url: '/NilaiAkhir/generateNilaiAkhir',
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
          $('.btn-nilai-akhir').html('loading.. <span class="spinner-border spinner-border-sm"></span>')
        },
        complete: function() {
          $('.btn-nilai-akhir').html('<i class="fas fa fa-recycle"></i>  Tentukan Nilai Akhir')
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
<?php $this->endSection() ?>
