      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
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
                                              <th>TS</th>
                                              <th>TK</th>
                                              <th>M</th>
                                              <th>OS</th>
                                              <th>OK</th>
                                              <th>K Sapi</th>
                                              <th>K Kambing</th>
                                              <th>KK Sapi</th>
                                              <th>KL Sapi</th>
                                              <th>Info</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if ($amprah): ?>
                                              <?php foreach ($amprah as $cabang): ?>
                                                  <tr class="align-middle">
                                                      <td><?= $no++; ?></td>
                                                      <td><?php echo $cabang['cabang']; ?></td>
                                                      <td><?php echo $cabang['p_ts']; ?></td>
                                                      <td><?php echo $cabang['p_tk']; ?></td>
                                                      <td><?php echo $cabang['p_a']; ?></td>
                                                      <td><?php echo $cabang['p_os']; ?></td>
                                                      <td><?php echo $cabang['p_ok']; ?></td>
                                                      <td><?php echo $cabang['p_ks']; ?></td>
                                                      <td><?php echo $cabang['p_kb']; ?></td>
                                                      <td><?php echo $cabang['p_kks']; ?></td>
                                                      <td><?php echo $cabang['p_kls']; ?></td>
                                                      <td><?php echo $cabang['info']; ?></td>
                                                      <td>
                                                          <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                              data-bs-target="#edit<?php echo $cabang['id']; ?>">
                                                              Edit</a>
                                                          <div class="modal fade" id="edit<?php echo $cabang['id']; ?>"
                                                              tabindex="-1" aria-labelledby="exampleModalLabel"
                                                              aria-hidden="true">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-body">
                                                                          <form action="<?= site_url('/amprah/edit') ?>"
                                                                              method="post">
                                                                              <div class="mb-3">
                                                                                  <input type="hidden" id="id"
                                                                                      value="<?php echo $cabang['id']; ?>"
                                                                                      name="id" readonly>
                                                                                  <label for="cabang"
                                                                                      class="form-label">Cabang</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="cabang"
                                                                                      value="<?php echo $cabang['cabang']; ?>" disabled>
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_ts" class="form-label">TS
                                                                                  </label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="p_ts"
                                                                                      value="<?php echo $cabang['p_ts']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_tk"
                                                                                      class="form-label">Tk</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="p_tk"
                                                                                      value="<?php echo $cabang['p_tk']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_a"
                                                                                      class="form-label">M</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="p_a"
                                                                                      value="<?php echo $cabang['p_a']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_os"
                                                                                      class="form-label">OS</label>
                                                                                  <input type="p_os" class="form-control"
                                                                                      name="p_os"
                                                                                      value="<?php echo $cabang['p_os']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_ok"
                                                                                      class="form-label">Ok</label>
                                                                                  <input type="p_ok" class="form-control"
                                                                                      name="p_ok"
                                                                                      value="<?php echo $cabang['p_ok']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_ks"
                                                                                      class="form-label">KS</label>
                                                                                  <input type="p_ks" class="form-control"
                                                                                      name="p_ks"
                                                                                      value="<?php echo $cabang['p_ks']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_kb"
                                                                                      class="form-label">KB</label>
                                                                                  <input type="p_kb" class="form-control"
                                                                                      name="p_kb"
                                                                                      value="<?php echo $cabang['p_kb']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_kks"
                                                                                      class="form-label">KKS</label>
                                                                                  <input type="p_kks" class="form-control"
                                                                                      name="p_kks"
                                                                                      value="<?php echo $cabang['p_kks']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="p_kls"
                                                                                      class="form-label">KLS</label>
                                                                                  <input type="p_kls" class="form-control"
                                                                                      name="p_kls"
                                                                                      value="<?php echo $cabang['p_kls']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="info"
                                                                                      class="form-label">INFO</label>
                                                                                  <select class="form-select" name="info">
                                                                                      <option
                                                                                          value="<?php echo $cabang['info']; ?>">
                                                                                          <?php echo $cabang['info']; ?>
                                                                                      </option>
                                                                                      <option value="Sudah">Sudah</option>
                                                                                      <option value="Belum">Belum
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