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
                                              <th>Realisasi</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if ($dataqurban): ?>
                                              <?php foreach ($dataqurban as $cabang): ?>
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
                                                      <td><?php echo $cabang['realisasi']; ?>
                                                      </td>
                                                      <td>
                                                          <a type="button-sm" class="btn btn-warning" data-bs-toggle="modal"
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
                                                                              action="<?= site_url('/realisasi/edit') ?>"
                                                                              method="post">
                                                                              <div class="row g-3">
                                                                                  <input type="hidden" id="id"
                                                                                      value="<?php echo $cabang['id']; ?>"
                                                                                      name="id">
                                                                                  <input type="hidden" id="cabang"
                                                                                      value="<?php echo $cabang['cabang']; ?>"
                                                                                      name="cabang" disabled>
                                                                                  <div class="col-md-4">
                                                                                      <label for="validationCustom01"
                                                                                          class="form-label">Amprah</label>
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">TS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_ts']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <label for="validationCustom02"
                                                                                          class="form-label">Perkiraan</label>
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">TS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['sapib_bumm'] + (($cabang['sapi_bumm'] + $cabang['sapi_mandiri']) * 7); ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <label for="validationCustom02"
                                                                                          class="form-label">Realisasi</label>
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">TS</span>
                                                                                          <input type="text"
                                                                                              class="form-control" name="r_ts"
                                                                                              value="<?php echo $cabang['r_ts']; ?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">TK</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_tk']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">TK</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['kambing_bumm'] + $cabang['kambing_mandiri']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">TK</span>
                                                                                          <input type="text"
                                                                                              class="form-control" name="r_tk"
                                                                                              value="<?php echo $cabang['r_tk']; ?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">M_</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_a']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">M_</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_a']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">M_</span>
                                                                                          <input type="text"
                                                                                              class="form-control" name="r_a"
                                                                                              value="<?php echo $cabang['r_a']; ?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">OS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_os']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">OS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo number_format(($cabang['sapi_bumm'] + ($cabang['sapib_bumm'] / 7) + $cabang['sapi_mandiri']) * $b_sapi), ''; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">OS</span>
                                                                                          <input type="text"
                                                                                              class="form-control" name="r_os"
                                                                                              value="<?php echo $cabang['r_os']; ?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">OK</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_ok']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">OK</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo (($cabang['kambing_bumm'] + $cabang['kambing_mandiri']) * $b_kb); ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">OK</span>
                                                                                          <input type="text"
                                                                                              class="form-control" name="r_ok"
                                                                                              value="<?php echo $cabang['r_ok']; ?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_ks']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo number_format($cabang['sapi_bumm'] + ($cabang['sapib_bumm'] / 7) + ($cabang['sapi_mandiri'])), ''; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KS</span>
                                                                                          <input type="text"
                                                                                              class="form-control" name="r_ks"
                                                                                              value="<?php echo $cabang['r_ks']; ?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KB</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_kb']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KB</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo ($cabang['kambing_bumm'] + $cabang['kambing_mandiri']); ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KB</span>
                                                                                          <input type="text"
                                                                                              class="form-control" name="r_kb"
                                                                                              value="<?php echo $cabang['r_kb']; ?>">
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KKS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo $cabang['p_kks']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KKS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo number_format(($cabang['sapi_bumm'] + ($cabang['sapib_bumm'] / 7) + ($cabang['sapi_mandiri'])) * 2), ''; ?>"
                                                                                              disabled readonly>
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
                                                                                              value="<?php echo $cabang['p_kls']; ?>"
                                                                                              disabled readonly>
                                                                                      </div>
                                                                                  </div>
                                                                                  <div class="col-md-4">
                                                                                      <div class="input-group">
                                                                                          <span
                                                                                              class="input-group-text">KLS</span>
                                                                                          <input type="text"
                                                                                              class="form-control"
                                                                                              value="<?php echo number_format($cabang['sapi_bumm'] + ($cabang['sapib_bumm'] / 7) + ($cabang['sapi_mandiri'])), ''; ?>"
                                                                                              disabled readonly>
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
                                                                                  <label for="realisasi"
                                                                                      class="form-label">INFO</label>
                                                                                  <select class="form-select"
                                                                                      name="realisasi">
                                                                                      <option
                                                                                          value="<?php echo $cabang['realisasi']; ?>">
                                                                                          <?php echo $cabang['realisasi']; ?>
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