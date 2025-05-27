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
                                  <!--begin::Header-->
                                  <div class="card-header bg-info text-white">
                                      <h6 class="mb-0">Input Hewan Disembelih</h6>
                                  </div>
                                  <!--end::Header-->
                                  <!--begin::Form-->
                                  <form class="needs-validation" action="/kandang/tambah" method="post" novalidate>
                                      <!--begin::Body-->
                                      <div class="card-body">
                                          <!--begin::Row-->
                                          <div class="row g-3">
                                              <!--begin::Col-->
                                              <div class="col-md-6">
                                                  <label for="sapi" class="form-label">Sapi</label>
                                                  <input type="text" class="form-control" name="sapi">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-6">
                                                  <label for="kambing" class="form-label">Kambing</label>
                                                  <input type="text" class="form-control" name="kambing">
                                              </div>
                                              <!--end::Col-->
                                          </div>
                                          <!--end::Row-->
                                      </div>
                                      <!--end::Body-->
                                      <!--begin::Footer-->
                                      <div class="card-footer">
                                          <button class="btn btn-info" type="submit">Save Data</button>
                                          <a href="/kandang/export" type="button" class="btn btn-success">Exsport
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
                              <div class="card shadow-sm">
                                  <!--begin::Header-->
                                  <div class="card-header bg-warning text-white">
                                      <h6 class="mb-0">Data Hewan Kandang</h6>
                                      <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>Hewan</th>
                                                  <th>Hewan Masuk</th>
                                                  <th>Hewan Disembelih</th>
                                                  <th>Stock Hewan Kandang</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr class="align-middle">
                                                  <td>Sapi</td>
                                                  <td><?= $total_sapi ?></td>
                                                  <td><?= $disembelih_sapi ?></td>
                                                  <td><?= $total_sapi - $disembelih_sapi ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Kambing</td>
                                                  <td><?= $total_kambing ?></td>
                                                  <td><?= $disembelih_kambing ?></td>
                                                  <td><?= $total_kambing - $disembelih_kambing ?></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                              <!--end::Small Box Widget 1-->
                          </div>
                          <!--end::Col-->
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
                                                          <th>Sapi</th>
                                                          <th>Kambing</th>
                                                          <th>Tanggal Input</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php $no = 1; ?>
                                                      <?php if ($viewkandang): ?>
                                                          <?php foreach ($viewkandang as $kandang): ?>
                                                              <tr class="align-middle">
                                                                  <td><?= $no++; ?></td>
                                                                  <td><?php echo $kandang['sapi']; ?></td>
                                                                  <td><?php echo $kandang['kambing']; ?></td>
                                                                  <td><?php echo $kandang['date_input']; ?></td>
                                                                  <td>
                                                                      <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                          data-bs-target="#hapusdata<?php echo $kandang['id']; ?>">
                                                                          Hapus
                                                                      </a>
                                                                      <!-- Modal -->
                                                                      <div class="modal fade"
                                                                          id="hapusdata<?php echo $kandang['id']; ?>" tabindex="-1"
                                                                          aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                          <div class="modal-dialog">
                                                                              <div class="modal-content">
                                                                                  <div class="modal-body">
                                                                                      <h2 class="h2">Apakah anda yakin ?</h2>
                                                                                      <p>Menghapus data kandang
                                                                                          <?php echo $kandang['date_input']; ?>
                                                                                      </p>
                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                      <button type="button" class="btn btn-warning"
                                                                                          data-bs-dismiss="modal">Batal</button>
                                                                                      <a href="<?= base_url('/kandang/hapus/' . $kandang['id']) ?>"
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