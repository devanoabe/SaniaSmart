<?= $this->extend('template/content'); ?>

<?php $this->section('content'); ?>

<section>
  <div class="row mt-4">
    <div class="col-md-12">

      <?php if ($kriteria && $alternatif && $nilai_utility) : ?>

        <div class="card shadow">
          <div class="card-header">
            <div class="row">
             
                <h1 class="jdl px-3 pt-4">Tabel Nilai Utility</h1>
            
              
                
              
            </div>
            <button style="background-color: #F1491E; color: black; font-weight: bolder" type="button" class="btn btn-nilai-utility"><i class="fas fa fa-recycle"></i> Update Nilai Utility</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm table-bordered table-striped table-kriteria">
                <thead>
                  <th>Alternatif / Kriteria</th>
                  <?php foreach ($kriteria->getResultArray() as $row) : ?>
                    <th><?= ucfirst(str_replace("_", " ", $row['nama'])) ?></th>
                  <?php endforeach; ?>
                </thead>
                <tbody>
                  <?php foreach ($alternatif as $key => $alt) : ?>
                    <tr>
                      <td>
                        <?= $alt['kode']; ?>
                      </td>
                      <?php for ($i = 0; $i < sizeof($nilai_utility); $i++) : ?>
                        <?php if ($nilai_utility[$i]['id_alternatif'] === $alt['id_alternatif']) : ?>
                          <td>
                            <?= $nilai_utility[$i]['nilai_utility']; ?>
                          </td>
                        <?php endif; ?>
                      <?php endfor; ?>
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
                  <strong class="text-center">Data Belum Ada, </strong> <button style="background-color: #F1491E; color: black; font-weight: bolder" type="button" class="btn mx-1 btn-nilai-utility"><i class="fas fa fa-recycle"></i> Tentukan Nilai Utility</button>
                </div>
              
            
          </div>
        </div>

      <?php endif; ?>
    </div>
  </div>
</section>
<?php $this->endSection(); ?>

<?= $this->section('custom-js'); ?>
<script>
  $(document).ready(function() {
    $('.btn-nilai-utility').on('click', function() {
      $.ajax({
        url: '/NilaiUtility/generateNilaiUtility',
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function() {
          $('.btn-nilai-utility').html('loading.. <span class="spinner-border spinner-border-sm"></span>')
        },
        complete: function() {
          $('.btn-nilai-utility').html('<i class="fas fa fa-recycle"></i>  Tentukan Nilai Utility')
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
