      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <div class="app-content">
                  <div class="container-fluid">
                      <div class="row">
                          <!--begin::Col-->
                          <div class="col-lg-6 col-6">
                              <!--begin::Small Box Widget 1-->
                              <div class="card card-info card-outline mb-4">
                                  <!--begin::Header-->
                                  <div class="card-header">
                                      <div class="card-title">Input Besek</div>
                                  </div>
                                  <!--end::Header-->
                                  <!--begin::Form-->
                                  <form class="needs-validation" action="/kirimkulit/tambah" method="post" novalidate>
                                      <!--begin::Body-->
                                      <div class="card-body">
                                          <!--begin::Row-->
                                          <div class="row">
                                              <!--begin::Col-->
                                              <div class="col-md-4">
                                                  <label for="jumlah" class="form-label">Jumlah Kulit Kambing</label>
                                                  <input type="text" class="form-control" name="jumlah">
                                              </div>
                                          </div>
                                      </div>
                                      <!--end::Row-->
                              </div>
                              <!--end::Body-->
                              <!--begin::Footer-->
                              <div class="card-footer">
                                  <button class="btn btn-info" type="submit">Save Data</button>
                                  <a href="/kirimkulit/export" type="button" class="btn btn-success">Exsport
                                      Exel</a>
                              </div>
                              <!--end::Footer-->
                              </form>
                              <!--end::Form-->
                          </div>
                          <!--end::Small Box Widget 1-->
                      </div>
                      <!--end::Col-->
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
                              <div class="col-md">
                                  <table id="datatablesSimple"
                                      class="table table-striped table-responsive table-hover text-left"
                                      style="width:100%">
                                      <thead>
                                          <tr>
                                              <th style="width: 10px">No</th>
                                              <th>Jumlah Kulit Kambing</th>
                                              <th>Tanggal Input</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($kirimkulit): ?>
                                          <?php foreach($kirimkulit as $kulit): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?php echo $kulit['jumlah']; ?></td>
                                              <td><?php echo $kulit['date_input']; ?></td>
                                              <td>
                                                  <div class="btn-group mb-2" role="group"
                                                      aria-label="Basic mixed styles example">
                                                      <a type="button" class="btn btn-success"
                                                          href="<?= base_url('/kirimkulit/print/'.$kulit['id']) ?>"
                                                          target="_blank">
                                                          Print
                                                      </a>
                                                      <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                          data-bs-target="#hapusdata<?php echo $kulit['id']; ?>">
                                                          Hapus
                                                      </a>
                                                  </div>
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="hapusdata<?php echo $kulit['id']; ?>"
                                                      tabindex="-1" aria-labelledby="exampleModalLabel"
                                                      aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-body">
                                                                  <h2 class="h2">Apakah anda yakin ?</h2>
                                                                  <p>Menghapus data
                                                                      <?php echo $kulit['date_input']; ?>
                                                                  </p>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-warning"
                                                                      data-bs-dismiss="modal">Batal</button>
                                                                  <a href="<?= base_url('/kirimkulit/hapus/'.$kulit['id']) ?>"
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