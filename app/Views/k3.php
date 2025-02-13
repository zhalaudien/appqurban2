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
                                  <form class="needs-validation" action="/k3/tambah" method="post" novalidate>
                                      <!--begin::Body-->
                                      <div class="card-body">
                                          <!--begin::Row-->
                                          <div class="row">
                                              <!--begin::Col-->
                                              <div class="col-md-4">
                                                  <label for="ks" class="form-label">Kepala Sapi</label>
                                                  <input type="text" class="form-control" name="ks">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="kb" class="form-label">Kepala Kambing</label>
                                                  <input type="text" class="form-control" name="kb">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="kks" class="form-label">Kaki Sapi</label>
                                                  <input type="text" class="form-control" name="kks">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="kls" class="form-label">Kulit Sapi</label>
                                                  <input type="text" class="form-control" name="kls">
                                              </div>
                                              <div class="col-md-4">
                                                  <label for="klsb" class="form-label">Kulit Kambing</label>
                                                  <input type="text" class="form-control" name="klsb">
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
                                  <div class="card-body">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>K3</th>
                                                  <th>KS</th>
                                                  <th>KKB</th>
                                                  <th>KKS</th>
                                                  <th>KLS</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr class="align-middle">
                                                  <td>Masuk</td>
                                                  <td><?= $ks ?></td>
                                                  <td><?= $kb ?></td>
                                                  <td><?= $kks ?></td>
                                                  <td><?= $kls ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Keluar</td>
                                                  <td><?= $t_ks ?></td>
                                                  <td><?= $t_kb ?></td>
                                                  <td><?= $t_kks ?></td>
                                                  <td><?= $t_kls ?></td>
                                              </tr>
                                          </tbody>
                                          <tfoot>
                                              <tr>
                                                  <th>Stock</th>
                                                  <td><?= $ks-$t_ks ?></td>
                                                  <td><?= $kb-$t_kb ?></td>
                                                  <td><?= $kks-$t_kks ?></td>
                                                  <td><?= $kls-$t_kls ?></td>
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
                                          style="width:100%">
                                          <thead>
                                              <tr>
                                                  <th style="width: 10px">No</th>
                                                  <th>K Sapi</th>
                                                  <th>K Kambing</th>
                                                  <th>KKS</th>
                                                  <th>KLS</th>
                                                  <th>KLK</th>
                                                  <th>Tanggal Input</th>
                                                  <th>Action</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php $no = 1; ?>
                                              <?php if($viewk3): ?>
                                              <?php foreach($viewk3 as $k3): ?>
                                              <tr class="align-middle">
                                                  <td><?= $no++; ?></td>
                                                  <td><?php echo $k3['ks']; ?></td>
                                                  <td><?php echo $k3['kb']; ?></td>
                                                  <td><?php echo $k3['kks']; ?></td>
                                                  <td><?php echo $k3['kls']; ?></td>
                                                  <td><?php echo $k3['klsb']; ?></td>
                                                  <td><?php echo $k3['date_input']; ?></td>
                                                  <td>
                                                      <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                          data-bs-target="#hapusdata<?php echo $k3['id']; ?>">
                                                          Hapus
                                                      </a>
                                                      <!-- Modal -->
                                                      <div class="modal fade" id="hapusdata<?php echo $k3['id']; ?>"
                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                          aria-hidden="true">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-body">
                                                                      <h2 class="h2">Apakah anda yakin ?</h2>
                                                                      <p>Menghapus data K3
                                                                          <?php echo $k3['date_input']; ?>
                                                                      </p>
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                      <button type="button" class="btn btn-warning"
                                                                          data-bs-dismiss="modal">Batal</button>
                                                                      <a href="<?= base_url('/k3/hapus/'.$k3['id']) ?>"
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