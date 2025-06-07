      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <div class="app-content">
                  <!--begin::Container-->
                  <div class="container-fluid">
                      <div class="row g-4">
                          <!-- Form Input Hewan -->
                          <div class="col-12 col-lg-6">
                              <div class="card shadow-sm">
                                  <div class="card-header bg-info text-white">
                                      <h6 class="mb-0">Input Hewan Masuk</h6>
                                  </div>
                                  <form action="/penerimaan/tambah" method="post" class="needs-validation" novalidate>
                                      <?= csrf_field(); ?>
                                      <div class="card-body row g-3">
                                          <div class="col-md-6">
                                              <label for="cabang" class="form-label">Cabang</label>
                                              <select class="form-select" name="cabang" required>
                                                  <option value="" disabled selected>Pilih Cabang</option>
                                                  <option value="BUMM Sragen">BUMM</option>
                                                  <?php foreach ($viewcabang as $cabang): ?>
                                                      <option value="<?= $cabang['cabang'] ?>"><?= $cabang['cabang'] ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="col-md-6">
                                              <label for="pengirim" class="form-label">Pengirim</label>
                                              <input type="text" name="pengirim" class="form-control" required>
                                          </div>
                                          <div class="col-md-6">
                                              <label for="sapi" class="form-label">Jumlah Sapi</label>
                                              <input type="number" name="sapi" class="form-control" min="0" required>
                                          </div>
                                          <div class="col-md-6">
                                              <label for="kambing" class="form-label">Jumlah Kambing</label>
                                              <input type="number" name="kambing" class="form-control" min="0" required>
                                          </div>
                                          <div class="col-md-6">
                                              <label for="pembayaran" class="form-label">Pembayaran</label>
                                              <input type="text" name="pembayaran_display" class="form-control" id="pembayaran" required oninput="formatRupiah(this)">
                                              <input type="hidden" name="pembayaran" id="pembayaran_clean">
                                          </div>
                                          <div class="col-md-6">
                                              <label for="shadaqoh" class="form-label">Shadaqoh</label>
                                              <input type="text" name="shadaqoh_display" class="form-control" id="shadaqoh" required oninput="formatRupiah(this)">
                                              <input type="hidden" name="shadaqoh" id="shadaqoh_clean">
                                          </div>
                                          <div class="col-md-12">
                                              <label for="ket" class="form-label">Keterangan</label>
                                              <input type="text" name="ket" class="form-control" id="ket">
                                          </div>
                                      </div>
                                      <div class="card-footer text-end">
                                          <button type="submit" class="btn btn-info">Simpan Data</button>
                                          <a href="/penerimaan/export" class="btn btn-success">Export Data ke Excel</a>
                                      </div>
                                  </form>
                              </div>
                          </div>
                          <!-- Ringkasan Data Hewan & Uang -->
                          <div class="col-12 col-lg-6">
                              <div class="row g-4">
                                  <!-- Data Hewan -->
                                  <div class="col-12">
                                      <div class="card border-primary shadow-sm">
                                          <div class="card-header bg-primary text-white">
                                              <h6 class="mb-0">Data Hewan</h6>
                                          </div>
                                          <div class="card-body p-2">
                                              <table class="table table-bordered table-sm mb-0">
                                                  <thead class="table-light">
                                                      <tr>
                                                          <th>Hewan</th>
                                                          <th>Total</th>
                                                          <th>Masuk</th>
                                                          <th>Kurang</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                          <td>Sapi BUMM</td>
                                                          <td><?= number_format($sapi_bumm + ($sapib_bumm / 7), 1) ?></td>
                                                          <td><?= $total_sapi_bumm ?></td>
                                                          <td><?= number_format(($sapi_bumm + ($sapib_bumm / 7)) - $total_sapi_bumm, 1) ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td>Sapi Cabang</td>
                                                          <td><?= $sapi_mandiri ?></td>
                                                          <td><?= $total_sapi_cabang ?></td>
                                                          <td><?= $sapi_mandiri - $total_sapi_cabang ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td>Kambing BUMM</td>
                                                          <td><?= $kambing_bumm ?></td>
                                                          <td><?= $total_kambing_bumm ?></td>
                                                          <td><?= $kambing_bumm - $total_kambing_bumm ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td>Kambing Cabang</td>
                                                          <td><?= $kambing_mandiri ?></td>
                                                          <td><?= $total_kambing_cabang ?></td>
                                                          <td><?= $kambing_mandiri - $total_kambing_cabang ?></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Uang Masuk -->
                                  <div class="col-12">
                                      <div class="card border-warning shadow-sm">
                                          <div class="card-header bg-warning text-dark">
                                              <h6 class="mb-0">Uang Masuk | Biaya Penyembelihan Rp. <?= number_format($biaya, 0, ',', '.') ?></h6>
                                          </div>
                                          <div class="card-body p-2">
                                              <table class="table table-bordered table-sm mb-0">
                                                  <thead class="table-light">
                                                      <tr>
                                                          <th>Asal</th>
                                                          <th>Total</th>
                                                          <th>Masuk</th>
                                                          <th>Kurang</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                          <td>BUMM</td>
                                                          <td>Rp. <?= number_format(((($sapi_bumm * 7) + $sapib_bumm + $kambing_bumm) * $biaya), 0, ',', '.') ?></td>
                                                          <td>Rp. <?= number_format($uang_bumm, 0, ',', '.') ?></td>
                                                          <td>Rp. <?= number_format(((($sapi_bumm * 7) + $sapib_bumm + $kambing_bumm) * $biaya) - $uang_bumm, 0, ',', '.') ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td>Cabang</td>
                                                          <td>Rp. <?= number_format((($sapi_mandiri * 7) + $kambing_mandiri) * $biaya, 0, ',', '.') ?></td>
                                                          <td>Rp. <?= number_format($uang_cabang, 0, ',', '.') ?></td>
                                                          <td>Rp. <?= number_format(((($sapi_mandiri * 7) + $kambing_mandiri) * $biaya) - $uang_cabang, 0, ',', '.') ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td>Shadaqoh</td>
                                                          <td>Rp. <?= number_format($shadaqoh, 0, ',', '.') ?></td>
                                                          <td>Rp. <?= number_format($shadaqoh, 0, ',', '.') ?></td>
                                                          <td>Rp. <?= number_format($shadaqoh, 0, ',', '.') ?></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Export Button -->
                              </div>
                          </div>
                          <!-- Ringkasan Data Hewan & Uang -->
                          <div class="col-12 col-lg-12">
                              <div class="row g-4">
                                  <!-- Uang Masuk -->
                                  <div class="col-12">
                                      <div class="card border-danger shadow-sm">
                                          <div class="card-header bg-danger text-dark">
                                              <h6 class="mb-0">Total Uang Masuk Hari Ini</h6>
                                          </div>
                                          <div class="card-body p-2">
                                              <table class="table table-bordered table-sm mb-0">
                                                  <thead class="table-light">
                                                      <tr>
                                                          <th>Asal</th>
                                                          <th>Total</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                          <td>BUMM</td>
                                                          <td>Rp. <?= number_format($bumm_hari_ini, 0, ',', '.') ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td>Cabang</td>
                                                          <td>Rp. <?= number_format($cabang_hari_ini, 0, ',', '.') ?></td>
                                                      </tr>
                                                      <tr>
                                                          <td>Shadaqoh</td>
                                                          <td>Rp. <?= number_format($shadaqoh_hari_ini, 0, ',', '.') ?></td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Export Button -->
                              </div>
                          </div>
                          <div class="col-12 col-lg-12">
                              <div class="row g-4">
                                  <!-- Data Hewan -->
                                  <div class="col-12">
                                      <div class="card border-success shadow-sm">
                                          <div class="card-header bg-success text-dark">
                                              <h6 class="mb-0"></h6>
                                          </div>
                                          <div class="card-body p-2">
                                              <table id="datatablesSimple"
                                                  class="table table-striped table-responsive table-hover text-left"
                                                  style="width:100%">
                                                  <thead>
                                                      <tr>
                                                          <th style="width: 10px">No</th>
                                                          <th>Cabang</th>
                                                          <th>Pengirim</th>
                                                          <th>Jumlah Sapi</th>
                                                          <th>Jumlah Kambing</th>
                                                          <th>Pembayaran</th>
                                                          <th>Shadaqoh</th>
                                                          <th>Keterangan</th>
                                                          <th>Tanggal Input</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php $no = 1; ?>
                                                      <?php if ($viewpenerimaan): ?>
                                                          <?php foreach ($viewpenerimaan as $terima): ?>
                                                              <tr class="align-middle">
                                                                  <td><?= $no++; ?></td>
                                                                  <td><?php echo $terima['cabang']; ?></td>
                                                                  <td><?php echo $terima['pengirim']; ?></td>
                                                                  <td><?php echo $terima['sapi']; ?></td>
                                                                  <td><?php echo $terima['kambing']; ?></td>
                                                                  <td>Rp. <?= number_format($terima['pembayaran'], 0, ',', '.'); ?></td>
                                                                  <td>Rp. <?= number_format($terima['shadaqoh'], 0, ',', '.'); ?></td>
                                                                  <td><?php echo $terima['ket']; ?></td>
                                                                  <td><?php echo $terima['date_input']; ?></td>
                                                                  <td>
                                                                      <div class="btn-group mb-2" role="group"
                                                                          aria-label="Basic mixed styles example">
                                                                          <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                                              data-bs-target="#edit<?php echo $terima['id']; ?>">
                                                                              Edit
                                                                          </a>
                                                                          <a type="button" class="btn btn-success"
                                                                              href="<?= base_url('/penerimaan/print/' . $terima['id']) ?>"
                                                                              target="_blank">
                                                                              Print
                                                                          </a>
                                                                          <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                              data-bs-target="#hapusdata<?php echo $terima['id']; ?>">
                                                                              Hapus
                                                                          </a>
                                                                      </div>
                                                                      <!-- Modal -->
                                                                      <div class="modal fade" id="hapusdata<?php echo $terima['id']; ?>"
                                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                          aria-hidden="true">
                                                                          <div class="modal-dialog">
                                                                              <div class="modal-content">
                                                                                  <div class="modal-body">
                                                                                      <h2 class="h2">Apakah anda yakin ?</h2>
                                                                                      <p>Menghapus data
                                                                                          <?php echo $terima['cabang']; ?>, pengirim
                                                                                          <?php echo $terima['pengirim']; ?>
                                                                                      </p>
                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                      <button type="button" class="btn btn-warning"
                                                                                          data-bs-dismiss="modal">Batal</button>
                                                                                      <a href="<?= base_url('/penerimaan/hapus/' . $terima['id']) ?>"
                                                                                          type="button" class="btn btn-danger">Hapus</a>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      <div class="modal fade" id="edit<?php echo $terima['id']; ?>"
                                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                          aria-hidden="true">
                                                                          <div class="modal-dialog">
                                                                              <div class="modal-content">
                                                                                  <div class="modal-body">
                                                                                      <form action="/penerimaan/edit" method="post" class="needs-validation" novalidate>
                                                                                          <?= csrf_field(); ?>
                                                                                          <div class="card-body row g-3">
                                                                                              <div class="col-md-6">
                                                                                                  <input type="hidden" name="id" value="<?= $terima['id'] ?>">
                                                                                                  <label for="pengirim" class="form-label">Cabang</label>
                                                                                                  <input type="text" name="Cabang" class="form-control" required value="<?= $terima['cabang'] ?>" readonly>
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                  <label for="pengirim" class="form-label">Pengirim</label>
                                                                                                  <input type="text" name="pengirim" class="form-control" required value="<?= $terima['pengirim'] ?>">
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                  <label for="sapi" class="form-label">Jumlah Sapi</label>
                                                                                                  <input type="number" name="sapi" class="form-control" min="0" required value="<?= $terima['sapi'] ?>">
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                  <label for="kambing" class="form-label">Jumlah Kambing</label>
                                                                                                  <input type="number" name="kambing" class="form-control" min="0" required value="<?= $terima['kambing'] ?>">
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                  <label for="pembayaran" class="form-label">Pembayaran</label>
                                                                                                  <input type="text" name="pembayaran_display" class="form-control" id="pembayaran" required oninput="formatRupiah(this)" value="<?= number_format($terima['pembayaran'], 0, ',', '.') ?>">
                                                                                                  <input type="hidden" name="pembayaran" id="pembayaran_clean">
                                                                                              </div>
                                                                                              <div class="col-md-6">
                                                                                                  <label for="shadaqoh" class="form-label">Shadaqoh</label>
                                                                                                  <input type="text" name="shadaqoh_display" class="form-control" id="shadaqoh" required oninput="formatRupiah(this)" value="<?= number_format($terima['shadaqoh'], 0, ',', '.') ?>">
                                                                                                  <input type="hidden" name="shadaqoh" id="shadaqoh_clean">
                                                                                              </div>
                                                                                              <div class="col-md-12">
                                                                                                  <label for="ket" class="form-label">Keterangan</label>
                                                                                                  <input type="text" name="ket" class="form-control" id="ket" value="<?= $terima['ket'] ?>">
                                                                                              </div>
                                                                                          </div>
                                                                                          <div class="modal-footer">
                                                                                              <button type="button" class="btn btn-warning"
                                                                                                  data-bs-dismiss="modal">Batal</button>
                                                                                              <button
                                                                                                  class="btn btn-primary">Update</button>
                                                                                          </div>
                                                                                      </form>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                  </td>
                                                              </tr>
                                                          <?php endforeach; ?>
                                                      <?php endif; ?>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                                  <!-- Export Button -->
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
      </main>
      <!--end::App Main-->