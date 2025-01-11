      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">

          </div>
          <div class="app-content">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <!--begin::Col-->
                      <div class="col-lg-12 col-6">
                          <!--begin::Small Box Widget 1-->
                          <div class="card card-info card-outline mb-4">
                              <!--begin::Header-->
                              <div class="card-header">
                                  <div class="card-title">Input Data Sapi</div>
                              </div>
                              <!--end::Header-->
                              <!--begin::Form-->
                              <form class="needs-validation" action="/datasapi/tambah" method="post" novalidate>
                                  <!--begin::Body-->
                                  <div class="card-body">
                                      <!--begin::Row-->
                                      <div class="row g-3">
                                          <!--begin::Col-->
                                          <div class="col-md-3">
                                              <label for="cabang" class="form-label">Cabang</label>
                                              <select class="form-select" name="cabang">
                                                  <option value="BUMM Sragen">BUMM</option>
                                                  <?php if($viewcabang): ?>
                                                  <?php foreach($viewcabang as $cabang): ?>
                                                  <option value="<?php echo $cabang['cabang']; ?>">
                                                      <?php echo $cabang['cabang']; ?></option>
                                                  <?php endforeach; ?>
                                                  <?php endif; ?>
                                              </select>
                                          </div>
                                          <!--end::Col-->
                                          <!--begin::Col-->
                                          <div class="col-md-3">
                                              <label for="berat" class="form-label">Berat</label>
                                              <input type="text" class="form-control" name="berat">
                                          </div>
                                          <!--end::Col-->
                                          <!--begin::Col-->
                                          <div class="col-md-3">
                                              <label for="nomor" class="form-label">Nomor Sapi</label>
                                              <input type="text" class="form-control" name="nomor">
                                          </div>
                                          <!--end::Col-->
                                          <!--begin::Col-->
                                          <div class="col-md-3">
                                              <label for="harga" class="form-label">Harga</label>
                                              <input type="text" class="form-control" name="harga">
                                          </div>
                                          <!--end::Col-->
                                      </div>
                                      <!--end::Row-->
                                  </div>
                                  <!--end::Body-->
                                  <!--begin::Footer-->
                                  <div class="card-footer">
                                      <button class="btn btn-info" type="submit">Save Data</button>
                                      <a href="/datasapi/export" type="button" class="btn btn-success">Exsport
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
              <!--end::Container-->
          </div>
          <!--end::App Content Header-->
          <!--begin::App Content-->
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
                                              <th>Cabang</th>
                                              <th>Berat</th>
                                              <th>Nomor Sapi</th>
                                              <th>Harga</th>
                                              <th>Tanggal Input</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($viewsapi): ?>
                                          <?php foreach($viewsapi as $sapi): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?php echo $sapi['cabang']; ?></td>
                                              <td><?php echo $sapi['berat']; ?></td>
                                              <td><?php echo $sapi['nomor']; ?></td>
                                              <td><?php echo $sapi['harga']; ?></td>
                                              <td><?php echo $sapi['date_input']; ?></td>
                                              <td>
                                                  <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                      data-bs-target="#hapusdata<?php echo $sapi['id']; ?>">
                                                      Hapus
                                                  </a>
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="hapusdata<?php echo $sapi['id']; ?>"
                                                      tabindex="-1" aria-labelledby="exampleModalLabel"
                                                      aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-body">
                                                                  <h2 class="h2">Apakah anda yakin ?</h2>
                                                                  <p>Menghapus data sapi nomor
                                                                      <?php echo $sapi['nomor']; ?>, dari cabang
                                                                      <?php echo $sapi['cabang']; ?>
                                                                  </p>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-warning"
                                                                      data-bs-dismiss="modal">Batal</button>
                                                                  <a href="<?= base_url('/datasapi/hapus/'.$sapi['id']) ?>"
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