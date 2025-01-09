      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <div>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#inputdata">Input Data</button>
                          <a href="/realisasi/export" type="button" class="btn btn-success">Exsport Exel</a>
                      </div>
                      <div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Input Realisasi cabang</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/realisasi/tambah" method="post">
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">Cabang</span>
                                              <input type="text" class="form-control" name="cabang" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">TS</span>
                                              <input type="text" class="form-control" name="ts" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">TK</span>
                                              <input type="text" class="form-control" name="tk" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">M</span>
                                              <input type="text" class="form-control" name="a" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">OS</span>
                                              <input type="text" class="form-control" name="os" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">OK</span>
                                              <input type="text" class="form-control" name="ok" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">KS</span>
                                              <input type="text" class="form-control" name="ks" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">KB</span>
                                              <input type="text" class="form-control" name="kb" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">KKS</span>
                                              <input type="text" class="form-control" name="kks" />
                                          </div>
                                          <div class="input-group mb-3">
                                              <span class="input-group-text" id="basic-addon1">KLS</span>
                                              <input type="text" class="form-control" name="kls" />
                                          </div>
                                          <div class="mb-3">
                                              <label for="realisasi" class="form-label">Realisasi</label>
                                              <select class="form-select" name="realisasi">
                                                  <option value="Sudah">Sudah</option>
                                                  <option value="Belum">Belum</option>
                                              </select>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary"
                                                  data-bs-dismiss="modal">Close</button>
                                              <button class="btn btn-primary">Simpan</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
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
                      <div class="card-header">
                          <div class="card-tools">
                              <ul class="pagination pagination-sm float-end">
                                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                              </ul>
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                          <table class="table">
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
                                  <?php if($join): ?>
                                  <?php foreach($join as $cabang): ?>
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
                                      <td><?php echo $cabang['realisasi']; ?>
                                      </td>
                                      <td>
                                          <div class="btn-group mb-2" role="group"
                                              aria-label="Basic mixed styles example">
                                              <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                  data-bs-target="#edit<?php echo $cabang['id']; ?>">
                                                  Edit</a>
                                              <div class="modal fade" id="edit<?php echo $cabang['id']; ?>"
                                                  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                      <div class="modal-content">
                                                          <div class="modal-header">
                                                              <h5 class="modal-title">Cabang
                                                                  <?php echo $cabang['cabang']; ?></h5>
                                                              <button type="button" class="btn-close"
                                                                  data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                              <form class="row g-3 needs-validation"
                                                                  action="<?= site_url('/realisasi/edit') ?>"
                                                                  method="post">
                                                                  <div class="row g-3">
                                                                      <input type="hidden" id="cabang"
                                                                          value="<?php echo $cabang['cabang']; ?>"
                                                                          name="cabang" readonly>
                                                                      <div class="col-md-4">
                                                                          <label for="validationCustom01"
                                                                              class="form-label">Amprah</label>
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">TS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_ts']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <label for="validationCustom02"
                                                                              class="form-label">Perkiraan</label>
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">TS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo ($cabang['sapi_bumm']*7)+$cabang['sapib_bumm']+($cabang['sapi_mandiri']*7); ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <label for="validationCustom02"
                                                                              class="form-label">Realisasi</label>
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">TS</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="ts"
                                                                                  value="<?php echo $cabang['ts']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">TK</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_tk']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">TK</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['kambing_bumm']+$cabang['kambing_mandiri']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">TK</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="tk"
                                                                                  value="<?php echo $cabang['tk']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">M_</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_a']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">M_</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['a']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">M_</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="a"
                                                                                  value="<?php echo $cabang['a']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">OS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_os']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">OS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo number_format(($cabang['sapi_bumm']*120)+(($cabang['sapib_bumm']/7)*120)+($cabang['sapi_mandiri']*120)), ''; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">OS</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="os"
                                                                                  value="<?php echo $cabang['os']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">OK</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_ok']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">OK</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo ($cabang['kambing_bumm']*11)+($cabang['kambing_mandiri']*11); ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">OK</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="ok"
                                                                                  value="<?php echo $cabang['ok']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_ks']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo number_format($cabang['sapi_bumm']+($cabang['sapib_bumm']/7)+($cabang['sapi_mandiri'])), ''; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KS</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="ks"
                                                                                  value="<?php echo $cabang['ks']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KB</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_kb']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KB</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo ($cabang['kambing_bumm']+$cabang['kambing_mandiri']); ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KB</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="kb"
                                                                                  value="<?php echo $cabang['kb']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KKS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_kks']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KKS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo number_format(($cabang['sapi_bumm']+($cabang['sapib_bumm']/7)+($cabang['sapi_mandiri']))*2), ''; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KKS</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="kks"
                                                                                  value="<?php echo $cabang['kks']; ?>">
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KLS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo $cabang['p_kls']; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KLS</span>
                                                                              <input type="text" class="form-control"
                                                                                  value="<?php echo number_format($cabang['sapi_bumm']+($cabang['sapib_bumm']/7)+($cabang['sapi_mandiri'])), ''; ?>"
                                                                                  disabled readonly>
                                                                          </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                          <div class="input-group">
                                                                              <span class="input-group-text">KLS</span>
                                                                              <input type="text" class="form-control"
                                                                                  name="kls"
                                                                                  value="<?php echo $cabang['kls']; ?>">
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="realisasi"
                                                                          class="form-label">INFO</label>
                                                                      <select class="form-select" name="realisasi">
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
                                                                      <button type="button" class="btn btn-secondary"
                                                                          data-bs-dismiss="modal">Close</button>
                                                                      <button class="btn btn-primary">Update</button>
                                                                  </div>
                                                              </form>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                  data-bs-target="#<?php echo $cabang['id']; ?>">
                                                  Hapus
                                              </a>
                                          </div>
                                          <!-- Modal -->
                                          <div class="modal fade" id="hapusdata<?php echo $cabang['id']; ?>"
                                              tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                          <a href="<?= base_url('/realisasi/hapus/'.$cabang['id']) ?>"
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