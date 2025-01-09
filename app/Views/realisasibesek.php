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
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Input Data cabang</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/realisasi/tambah" method="post">
                                          <div class="mb-3">
                                              <label for="cabang" class="form-label">cabang</label>
                                              <input type="text" class="form-control" name="cabang">
                                          </div>
                                          <div class="mb-3">
                                              <label for="ketua_cabang" class="form-label">Ketua Cabang</label>
                                              <input type="text" class="form-control" name="ketua_cabang">
                                          </div>
                                          <div class="mb-3">
                                              <label for="no_hp" class="form-label">No HP</label>
                                              <input type="text" class="form-control" name="no_hp">
                                          </div>
                                          <div class="mb-3">
                                              <label for="cabang_qurban" class="form-label">cabang Cabang</label>
                                              <input type="text" class="form-control" name="cabang_qurban">
                                          </div>
                                          <div class="mb-3">
                                              <label for="no2_hp" class="form-label">No HP</label>
                                              <input type="text" class="form-control" name="no2_hp">
                                          </div>
                                          <div class="mb-3">
                                              <label for="alamat" class="form-label">Alamat</label>
                                              <input type="text" class="form-control" name="alamat">
                                          </div>
                                          <div class="mb-3">
                                              <label for="perwakilan" class="form-label">Perwakilan</label>
                                              <select class="form-select" name="perwakilan">
                                                  <option value="sragen">Sragen</option>
                                                  <option value="karanganyar">Karanganyar</option>
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
                                  <?php if($realisasi): ?>
                                  <?php foreach($realisasi as $cabang): ?>
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
                                      <td><?php echo $cabang['realisasi']; ?></td>

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
                                                          <div class="modal-body">
                                                              <form action="<?= site_url('/realisasi/edit') ?>"
                                                                  method="post">
                                                                  <div class="mb-3">
                                                                      <input type="hidden" id="id"
                                                                          value="<?php echo $cabang['id']; ?>" name="id"
                                                                          readonly>
                                                                      <label for="cabang"
                                                                          class="form-label">Cabang</label>
                                                                      <input type="text" class="form-control"
                                                                          name="cabang"
                                                                          value="<?php echo $cabang['cabang']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="ts" class="form-label">TS
                                                                      </label>
                                                                      <input type="text" class="form-control" name="ts"
                                                                          value="<?php echo $cabang['ts']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="tk" class="form-label">Tk</label>
                                                                      <input type="text" class="form-control" name="tk"
                                                                          value="<?php echo $cabang['tk']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="a" class="form-label">M</label>
                                                                      <input type="text" class="form-control" name="a"
                                                                          value="<?php echo $cabang['a']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="os" class="form-label">OS</label>
                                                                      <input type="text" class="form-control" name="os"
                                                                          value="<?php echo $cabang['os']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="ok" class="form-label">Ok</label>
                                                                      <input type="text" class="form-control" name="ok"
                                                                          value="<?php echo $cabang['ok']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="ks" class="form-label">KS</label>
                                                                      <input type="text" class="form-control" name="ks"
                                                                          value="<?php echo $cabang['ks']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="kb" class="form-label">KB</label>
                                                                      <input type="text" class="form-control" name="kb"
                                                                          value="<?php echo $cabang['kb']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="kks" class="form-label">KKS</label>
                                                                      <input type="text" class="form-control" name="kks"
                                                                          value="<?php echo $cabang['kks']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="kls" class="form-label">KLS</label>
                                                                      <input type="text" class="form-control" name="kls"
                                                                          value="<?php echo $cabang['kls']; ?>">
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
                                                  data-bs-target="#hapusdata<?php echo $cabang['id']; ?>">
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