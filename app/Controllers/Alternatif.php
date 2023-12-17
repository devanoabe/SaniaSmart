<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Alternatif as ModelsAlternatif;
use App\Models\Subkriteria;

class Alternatif extends BaseController
{
  public function __construct()
  {
    $this->model = new ModelsAlternatif();
    $this->subkriteriaModel = new Subkriteria();
  }

  public function index()
  {
    $data = [
      'judul' => 'Alternatif',
      'alternatif' => $this->model->where('id_user', session('id_user'))->findAll(),
      'merk_options' => $this->subkriteriaModel->getSpesificSubkriteria('merk'),
      'prosesor_options' => $this->subkriteriaModel->getSpesificSubkriteria('prosesor'),
      'tipe_penyimpanan_options' => $this->subkriteriaModel->getSpesificSubkriteria('tipe_penyimpanan'),
      'ukuran_layar_options' => $this->subkriteriaModel->getSpesificSubkriteria('ukuran_layar'),
      'kartu_grafis_options' => $this->subkriteriaModel->getSpesificSubkriteria('kartu_grafis'),
      'sistem_operasi_options' => $this->subkriteriaModel->getSpesificSubkriteria('sistem_operasi'),
      'kondisi_produk_options' => $this->subkriteriaModel->getSpesificSubkriteria('kondisi_produk'),
    ];

    return view('alternatif/index', $data);
  }

  public function create()
  {
    if (!$this->request->isAJAX()) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $id_user = session('id_user');
    $jumlahAlternatif = $this->model->countAlternatifByUser($id_user);

    if ($jumlahAlternatif >= 20) {
      return $this->response->setJSON(['status' => TRUE, 'warning' => 'Data alternatif sudah mencapai nilai maksimum!']);
    }

    $data = $this->request->getPost();
    $data['id_user'] = $id_user;

    if ($this->model->save($data) === FALSE) {
      return $this->response->setJSON(['status' => FALSE, 'errors' => $this->model->errors()]);
    } else {
      return $this->response->setJSON(['status' => TRUE, 'message' => 'Data berhasil ditambahkan']);
    }
  }

  public function delete()
  {
    if (!$this->request->isAJAX()) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $ids = $this->request->getPost('id');
    $this->model->whereIn('id_alternatif', $ids)->delete();
    return $this->response->setJSON(['status' => TRUE, 'message' => 'Data berhasil dihapus']);
  }

  public function getDataById()
  {
    if (!$this->request->isAJAX()) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $id = $this->request->getPost('id');
    $data = $this->model->findAlternatifById($id);
    return $this->response->setJSON($data);
  }

  public function update()
  {
    if (!$this->request->isAJAX()) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $data = $this->request->getPost();

    $this->model->setValidationRules([
      'id_alternatif' => 'required',
      'id_user' => 'required',
      'nama' => 'required',
      'kode' => 'required',
      'harga' => 'required',
      'rating_produk' => 'required',
      'merk' => 'required',
      'prosesor' => 'required',
      'kapasitas_ram' => 'required',
      'tipe_penyimpanan' => 'required',
      'kapasitas_penyimpanan' => 'required',
      'ukuran_layar' => 'required',
      'kartu_grafis' => 'required',
      'sistem_operasi' => 'required',
      'masa_garansi' => 'required',
      'kondisi_produk' => 'required',
      'url_produk' => 'required',
    ]);


    if ($this->model->save($data) === FALSE) {
      return $this->response->setJSON(['status' => FALSE, 'errors' => $this->model->errors()]);
    } else {
      return $this->response->setJSON(['status' => TRUE, 'message' => 'Data berhasil diperbarui']);
    }
  }
}
