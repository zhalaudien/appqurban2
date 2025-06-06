      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <div class="app-content">
                  <!--begin::Container-->
                  <div class="container-fluid">
                      <div class="row g-4">
                          <!-- Form Input Hewan -->
                          <div class="col-12 col-lg-12">
                              <div class="card shadow-sm">
                                  <!--begin::Header-->
                                  <div class="card-header bg-info text-white">
                                      <h6 class="mb-0">Input Permintaan Besek</h6>
                                  </div>
                                  <!--end::Header-->
                                  <!--begin::Form-->
                                  <form class="needs-validation" action="/kirimbesek/tambah" method="post" novalidate>
                                      <!--begin::Body-->
                                      <div class="card-body">
                                          <!--begin::Row-->
                                          <div class="row g-3">
                                              <div class="col-md-2">
                                                  <label for="cabang" class="form-label">Cabang</label>
                                                  <input type="text" class="form-control" name="cabang">
                                              </div>
                                              <div class="col-md-2">
                                                  <label for="ts" class="form-label">Besek TS</label>
                                                  <input type="text" class="form-control" name="ts">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-2">
                                                  <label for="tk" class="form-label">Besek TK</label>
                                                  <input type="text" class="form-control" name="tk">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-2">
                                                  <label for="a" class="form-label">Besek M</label>
                                                  <input type="text" class="form-control" name="a">
                                              </div>
                                              <div class="col-md-2">
                                                  <label for="os" class="form-label">Besek OS</label>
                                                  <input type="text" class="form-control" name="os">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-2">
                                                  <label for="ok" class="form-label">Besek OK</label>
                                                  <input type="text" class="form-control" name="ok">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-2">
                                                  <label for="ks" class="form-label">Kepala Sapi</label>
                                                  <input type="text" class="form-control" name="ks">
                                              </div>
                                              <div class="col-md-2">
                                                  <label for="kb" class="form-label">Kepala Kambing</label>
                                                  <input type="text" class="form-control" name="kb">
                                              </div>
                                              <div class="col-md-2">
                                                  <label for="kks" class="form-label">Kaki Sapi</label>
                                                  <input type="text" class="form-control" name="kks">
                                              </div>
                                              <div class="col-md-2">
                                                  <label for="kls" class="form-label">kulit Sapi</label>
                                                  <input type="text" class="form-control" name="kls">
                                              </div>
                                              <!--end::Col-->
                                          </div>
                                          <!--end::Row-->
                                      </div>
                                      <!--end::Body-->
                                      <!--begin::Footer-->
                                      <div class="card-footer">
                                          <button class="btn btn-info" type="submit">Save Data</button>
                                          <a href="/kirimbesek/export" type="button" class="btn btn-success">Exsport
                                              Exel</a>
                                      </div>
                                      <!--end::Footer-->
                                  </form>
                                  <!--end::Form-->
                              </div>
                              <!--end::Small Box Widget 1-->
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
                                                          <th>TS</th>
                                                          <th>TK</th>
                                                          <th>M</th>
                                                          <th>OS</th>
                                                          <th>OK</th>
                                                          <th>K Sapi</th>
                                                          <th>K Kambing</th>
                                                          <th>KK Sapi</th>
                                                          <th>KL Sapi</th>
                                                          <th>Status</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php $no = 1; ?>
                                                      <?php if ($join): ?>
                                                          <?php foreach ($join as $cabang): ?>
                                                              <tr class="align-middle">
                                                                  <td><?= $no++; ?></td>
                                                                  <td><?php echo $cabang['cabang']; ?></td>
                                                                  <td><?php echo $cabang['r_ts']; ?></td>
                                                                  <td><?php echo $cabang['r_tk']; ?></td>
                                                                  <td><?php echo $cabang['r_a']; ?></td>
                                                                  <td><?php echo $cabang['r_os']; ?></td>
                                                                  <td><?php echo $cabang['r_ok']; ?></td>
                                                                  <td><?php echo $cabang['r_ks']; ?></td>
                                                                  <td><?php echo $cabang['r_kb']; ?></td>
                                                                  <td><?php echo $cabang['r_kks']; ?></td>
                                                                  <td><?php echo $cabang['r_kls']; ?></td>
                                                                  <td><?php echo $cabang['status']; ?></td>
                                                                  <td>
                                                                      <div class="btn-group mb-2" role="group"
                                                                          aria-label="Basic mixed styles example">
                                                                          <a type="button" class="btn btn-warning"
                                                                              data-bs-toggle="modal"
                                                                              data-bs-target="#edit<?php echo $cabang['id']; ?>">
                                                                              Edit</a>
                                                                          <div class="modal fade" id="edit<?php echo $cabang['id']; ?>"
                                                                              tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                              aria-hidden="true">
                                                                              <div class="modal-dialog">
                                                                                  <div class="modal-content">
                                                                                      <div class="modal-header">
                                                                                          <h5 class="modal-title">Cabang
                                                                                              <?php echo $cabang['cabang']; ?></h5>
                                                                                          <button type="button" class="btn-close"
                                                                                              data-bs-dismiss="modal"
                                                                                              aria-label="Close"></button>
                                                                                      </div>
                                                                                      <div class="modal-body">
                                                                                          <form class="row g-3 needs-validation"
                                                                                              action="/kirimbesek/edit" method="post">
                                                                                              <div class="row g-3">
                                                                                                  <input type="hidden" id="id"
                                                                                                      value="<?php echo $cabang['id']; ?>"
                                                                                                      name="id">
                                                                                                  <input type="hidden" id="cabang"
                                                                                                      value="<?php echo $cabang['cabang']; ?>"
                                                                                                      name="cabang">
                                                                                                  <input type="hidden" name="date_input" value="<?php echo date('Y-m-d H:i:s'); ?>">
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">TS</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_ts"
                                                                                                              value="<?php echo $cabang['r_ts']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">TK</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_tk"
                                                                                                              value="<?php echo $cabang['r_tk']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">M_</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_a"
                                                                                                              value="<?php echo $cabang['r_a']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">OS</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_os"
                                                                                                              value="<?php echo $cabang['r_os']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">OK</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_ok"
                                                                                                              value="<?php echo $cabang['r_ok']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">KS</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_ks"
                                                                                                              value="<?php echo $cabang['r_ks']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">KB</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_kb"
                                                                                                              value="<?php echo $cabang['r_kb']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">KKS</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_kks"
                                                                                                              value="<?php echo $cabang['r_kks']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                                  <div class="col-md-4">
                                                                                                      <div class="input-group">
                                                                                                          <span
                                                                                                              class="input-group-text">KLS</span>
                                                                                                          <input type="text"
                                                                                                              class="form-control"
                                                                                                              name="r_kls"
                                                                                                              value="<?php echo $cabang['r_kls']; ?>">
                                                                                                      </div>
                                                                                                  </div>
                                                                                              </div>
                                                                                              <div class="mb-3">
                                                                                                  <label for="status"
                                                                                                      class="form-label">INFO</label>
                                                                                                  <select class="form-select"
                                                                                                      name="status">
                                                                                                      <option
                                                                                                          value="<?php echo $cabang['status']; ?>">
                                                                                                          <?php echo $cabang['status']; ?>
                                                                                                      </option>
                                                                                                      <option value="Dikirim">Dikirim
                                                                                                      </option>
                                                                                                      <option value="Proses">
                                                                                                          Proses
                                                                                                      </option>
                                                                                                      <option value="Pending">Pending
                                                                                                      </option>
                                                                                                  </select>
                                                                                              </div>
                                                                                              <div class="modal-footer">
                                                                                                  <button type="button"
                                                                                                      class="btn btn-secondary"
                                                                                                      data-bs-dismiss="modal">Close</button>
                                                                                                  <button
                                                                                                      class="btn btn-primary">Update</button>
                                                                                              </div>
                                                                                          </form>
                                                                                      </div>
                                                                                  </div>
                                                                              </div>
                                                                          </div>
                                                                          <a type="button" class="btn btn-success"
                                                                              href="<?= base_url('/kirimbesek/print/' . $cabang['id']) ?>"
                                                                              target="_blank">
                                                                              Print
                                                                          </a>
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
                          </div>
                          <div class="col-12 col-lg-12">
                              <div class="row g-4">
                                  <!-- Data Hewan -->
                                  <div class="col-12">
                                      <div class="card border-warning shadow-sm">
                                          <div class="card-header bg-warning text-dark">
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
                                                          <th>TS</th>
                                                          <th>TK</th>
                                                          <th>M</th>
                                                          <th>OS</th>
                                                          <th>OK</th>
                                                          <th>K Sapi</th>
                                                          <th>K Kambing</th>
                                                          <th>KK Sapi</th>
                                                          <th>KL Sapi</th>
                                                          <th>Date Input</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php $no = 1; ?>
                                                      <?php if ($permintaan): ?>
                                                          <?php foreach ($permintaan as $cabang): ?>
                                                              <tr class="align-middle">
                                                                  <td><?= $no++; ?></td>
                                                                  <td><?php echo $cabang['cabang']; ?></td>
                                                                  <td><?php echo $cabang['ts']; ?></td>
                                                                  <td><?php echo $cabang['tk']; ?></td>
                                                                  <td><?php echo $cabang['a']; ?></td>
                                                                  <td><?php echo $cabang['os']; ?></td>
                                                                  <td><?php echo $cabang['ok']; ?></td>
                                                                  <td><?php echo $cabang['ks']; ?></td>
                                                                  <td><?php echo $cabang['kb']; ?></td>
                                                                  <td><?php echo $cabang['kks']; ?></td>
                                                                  <td><?php echo $cabang['kls']; ?></td>
                                                                  <td><?php echo $cabang['date_input']; ?>
                                                                  </td>
                                                                  <td>
                                                                      <div class="btn-group mb-2" role="group"
                                                                          aria-label="Basic mixed styles example">
                                                                          <a type="button" class="btn btn-success"
                                                                              href="<?= base_url('/kirimbesek/permintaan/' . $cabang['id']) ?>"
                                                                              target="_blank">
                                                                              Print
                                                                          </a>
                                                                          <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                                              data-bs-target="#hapusdata<?php echo $cabang['id']; ?>">
                                                                              Hapus
                                                                          </a>
                                                                      </div>
                                                                      <!-- Modal -->
                                                                      <div class="modal fade" id="hapusdata<?php echo $cabang['id']; ?>"
                                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                          aria-hidden="true">
                                                                          <div class="modal-dialog">
                                                                              <div class="modal-content">
                                                                                  <div class="modal-body">
                                                                                      <h2 class="h2">Apakah anda yakin ?</h2>
                                                                                      <p>Menghapus data
                                                                                          <?php echo $cabang['cabang']; ?>
                                                                                      </p>
                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                      <button type="button" class="btn btn-warning"
                                                                                          data-bs-dismiss="modal">Batal</button>
                                                                                      <a href="<?= base_url('/kirimbesek/permintaanhapus/' . $cabang['id']) ?>"
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
                          </div>
                      </div>
      </main>
      <!--end::App Main-->