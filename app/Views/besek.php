      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <div class="app-content">
                  <div class="container-fluid">
                      <div class="row">
                          <!--begin::Col-->
                          <div class="w-auto col-lg-6 col-6">
                              <!--begin::Small Box Widget 1-->
                              <div class="card card-info card-outline mb-4">
                                  <!--begin::Header-->
                                  <div class="card-header">
                                      <div class="card-title">Input Besek</div>
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
                          <div class="w-auto col-lg-6 col-6">
                              <div class="card card-outline card-primary mb-4">
                                  <div class="card-header">
                                      <h3 class="card-title">Data Besek</h3>
                                      <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                          </button>
                                      </div>
                                      <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="w-auto card-body">
                                      <table class="w-auto table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>Besek</th>
                                                  <th>TS</th>
                                                  <th>OS</th>
                                                  <th>M</th>
                                                  <th>OS</th>
                                                  <th>OK</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr class="align-middle">
                                                  <td>Total Besek</td>
                                                  <td><?= $ts ?></td>
                                                  <td><?= $os ?></td>
                                                  <td><?= $a ?></td>
                                                  <td><?= $os ?></td>
                                                  <td><?= $ok ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Besek Dikirim</td>
                                                  <td><?= $t_ts ?></td>
                                                  <td><?= $t_os ?></td>
                                                  <td><?= $t_a ?></td>
                                                  <td><?= $t_os ?></td>
                                                  <td><?= $t_ok ?></td>
                                              </tr>
                                          </tbody>
                                          <tfoot>
                                              <tr>
                                                  <th>Stock</th>
                                                  <th><?= $ts-$t_ts ?></th>
                                                  <th><?= $os-$t_os ?></th>
                                                  <th><?= $a-$t_a ?></th>
                                                  <th><?= $os-$t_os ?></th>
                                                  <th><?= $ok-$t_ok ?></th>
                                              </tr>
                                          </tfoot>
                                      </table>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                              <!--end::Small Box Widget 1-->
                          </div>
                          <!--end::Col-->
                      </div>
                      <!--end::Row-->
                  </div>
              </div>
              <div class="app-content">
                  <!--begin::Container-->
                  <div class="container-fluid">
                      <div class="card mb-4">
                          <div class="card-body">
                              <div class="row my-3">
                                  <div class="w-auto col-md">
                                      <table id="datatablesSimple"
                                          class="table table-striped table-responsive table-hover text-left"
                                          style="width: 100%">
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
                                              <?php if($viewbesek): ?>
                                              <?php foreach($viewbesek as $besek): ?>
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
                                                                      <a href="<?= base_url('/besek/hapus/'.$besek['id']) ?>"
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