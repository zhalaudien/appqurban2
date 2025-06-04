      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <div class="app-content">
                  <div class="container-fluid">
                      <div class="row g-4">
                          <!-- Form Input Hewan -->
                          <div class="col-12 col-lg-6">
                              <div class="card shadow-sm">
                                  <!--begin::Header-->
                                  <div class="card-header bg-info text-white">
                                      <h6 class="mb-0">Input Besek</h6>
                                  </div>
                                  <!--end::Header-->
                                  <!--begin::Form-->
                                  <form class="needs-validation" action="/besek/tambah" method="post" novalidate>
                                      <!--begin::Body-->
                                      <div class="card-body">
                                          <!--begin::Row-->
                                          <div class="row">
                                              <!--begin::Col-->
                                              <div class="col-md-4">
                                                  <label for="ts" class="form-label">TS</label>
                                                  <input type="text" class="form-control" name="ts">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="tk" class="form-label">TK</label>
                                                  <input type="text" class="form-control" name="tk">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="a" class="form-label">M</label>
                                                  <input type="text" class="form-control" name="a">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="os" class="form-label">OS</label>
                                                  <input type="text" class="form-control" name="os">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="ok" class="form-label">OK</label>
                                                  <input type="text" class="form-control" name="ok">
                                              </div>
                                          </div>
                                          <!--end::Row-->
                                      </div>
                                      <!--end::Body-->
                                      <!--begin::Footer-->
                                      <div class="card-footer">
                                          <button class="btn btn-info" type="submit">Save Data</button>
                                          <a href="/besek/export" type="button" class="btn btn-success">Exsport
                                              Exel</a>
                                      </div>
                                      <!--end::Footer-->
                                  </form>
                                  <!--end::Form-->
                              </div>
                              <!--end::Small Box Widget 1-->
                          </div>
                          <!--end::Col-->
                          <div class="col-12 col-lg-6">
                              <div class="card border-warning shadow-sm">
                                  <div class="card-header bg-warning text-dark">
                                      <h6 class="mb-0">Produksi Dan Stock Besek Hari Ini (<?= date('d-m-Y') ?>)</h6>
                                  </div>
                                  <div class="card-body p-2">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>Besek</th>
                                                  <th>TS</th>
                                                  <th>TK</th>
                                                  <th>M</th>
                                                  <th>OS</th>
                                                  <th>OK</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr class="align-middle">
                                                  <td>Produksi Besek</td>
                                                  <td><?= $today_ts ?></td>
                                                  <td><?= $today_tk ?></td>
                                                  <td><?= $today_a ?></td>
                                                  <td><?= $today_os ?></td>
                                                  <td><?= $today_ok ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Besek Dikirim</td>
                                                  <td><?= $kirim_ts ?></td>
                                                  <td><?= $kirim_tk ?></td>
                                                  <td><?= $kirim_a ?></td>
                                                  <td><?= $kirim_os ?></td>
                                                  <td><?= $kirim_ok ?></td>
                                              </tr>
                                          </tbody>
                                          <tfoot>
                                              <tr>
                                                  <th>Stock</th>
                                                  <th><?= $today_ts - $kirim_ts ?></th>
                                                  <th><?= $today_tk - $kirim_tk ?></th>
                                                  <th><?= $today_a - $kirim_a ?></th>
                                                  <th><?= $today_os - $kirim_os ?></th>
                                                  <th><?= $today_ok - $kirim_ok ?></th>
                                              </tr>
                                          </tfoot>
                                      </table>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                              <!--end::Small Box Widget 1-->
                          </div>
                          <!--end::Col-->
                          <div class="col-12 col-lg-6">
                              <div class="card border-primary shadow-sm">
                                  <div class="card-header bg-primary text-white">
                                      <h6 class="mb-0">Total Produksi Besek</h6>
                                  </div>
                                  <div class="card-body p-2">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>TS</th>
                                                  <th>TK</th>
                                                  <th>M</th>
                                                  <th>OS</th>
                                                  <th>OK</th>
                                                  <th>Total</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr class="align-middle">
                                                  <td><?= $total_ts ?></td>
                                                  <td><?= $total_tk ?></td>
                                                  <td><?= $total_a ?></td>
                                                  <td><?= $total_os ?></td>
                                                  <td><?= $total_ok ?></td>
                                                  <td><?= $total_besek ?></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
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
                                                          <th>Besek TS</th>
                                                          <th>Besek TK</th>
                                                          <th>Besek M</th>
                                                          <th>Besek OS</th>
                                                          <th>Besek OK</th>
                                                          <th>Tanggal Input</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php $no = 1; ?>
                                                      <?php if ($viewbesek): ?>
                                                          <?php foreach ($viewbesek as $besek): ?>
                                                              <tr class="align-middle">
                                                                  <td><?= $no++; ?></td>
                                                                  <td><?php echo $besek['ts']; ?></td>
                                                                  <td><?php echo $besek['tk']; ?></td>
                                                                  <td><?php echo $besek['a']; ?></td>
                                                                  <td><?php echo $besek['os']; ?></td>
                                                                  <td><?php echo $besek['ok']; ?></td>
                                                                  <td><?php echo $besek['date_input']; ?></td>
                                                                  <td>
                                                                      <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                          data-bs-target="#hapusdata<?php echo $besek['id']; ?>">
                                                                          Hapus
                                                                      </a>
                                                                      <!-- Modal -->
                                                                      <div class="modal fade" id="hapusdata<?php echo $besek['id']; ?>"
                                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                          aria-hidden="true">
                                                                          <div class="modal-dialog">
                                                                              <div class="modal-content">
                                                                                  <div class="modal-body">
                                                                                      <h2 class="h2">Apakah anda yakin ?</h2>
                                                                                      <p>Menghapus data kandang
                                                                                          <?php echo $besek['date_input']; ?>
                                                                                      </p>
                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                      <button type="button" class="btn btn-warning"
                                                                                          data-bs-dismiss="modal">Batal</button>
                                                                                      <a href="<?= base_url('/besek/hapus/' . $besek['id']) ?>"
                                                                                          type="button" class="btn btn-danger">Hapus</a>
                                                                                  </div>
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
                                          <!-- /.card-body -->
                                      </div>
                                  </div>
                                  <!--end::Container-->
                              </div>
                              <!--end::App Content-->
      </main>
      <!--end::App Main-->