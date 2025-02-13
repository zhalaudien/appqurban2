      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <div class="col-sm-6">
                      </div>
                      <div>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#inputdata">Input Data</button>
                          <a href="/cabang/export" type="button" class="btn btn-success">Exsport Exel</a>
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
                                      <form action="/cabang/tambah" method="post">
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
                  <div class="w-auto card mb-4">
                      <!-- /.card-header -->
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
                                              <th>Ketua Cabang</th>
                                              <th>No HP</th>
                                              <th>cabang Cabang</th>
                                              <th>No HP</th>
                                              <th>Alamat</th>
                                              <th>Perwakilan</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($viewcabang): ?>
                                          <?php foreach($viewcabang as $cabang): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?php echo $cabang['cabang']; ?></td>
                                              <td><?php echo $cabang['ketua_cabang']; ?></td>
                                              <td><?php echo $cabang['no_hp']; ?></td>
                                              <td><?php echo $cabang['panitia_qurban']; ?></td>
                                              <td><?php echo $cabang['no2_hp']; ?></td>
                                              <td><?php echo $cabang['alamat']; ?></td>
                                              <td><?php echo $cabang['perwakilan']; ?></td>
                                              <td>
                                                  <div class="btn-group mb-2" role="group"
                                                      aria-label="Basic mixed styles example">
                                                      <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                          data-bs-target="#edit<?php echo $cabang['id']; ?>">
                                                          Edit</a>
                                                      <div class="modal fade" id="edit<?php echo $cabang['id']; ?>"
                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                          aria-hidden="true">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-body">
                                                                      <form action="<?= site_url('/cabang/edit') ?>"
                                                                          method="post">
                                                                          <div class="mb-3">
                                                                              <input type="hidden" id="id"
                                                                                  value="<?php echo $cabang['id']; ?>"
                                                                                  name="id" readonly>
                                                                              <label for="cabang"
                                                                                  class="form-label">Cabang</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="cabang"
                                                                                  value="<?php echo $cabang['cabang']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="ketua_cabang"
                                                                                  class="form-label">Ketua
                                                                                  Cabang</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="ketua_cabang"
                                                                                  value="<?php echo $cabang['ketua_cabang']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="no_hp" class="form-label">No
                                                                                  HP</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="no_hp"
                                                                                  value="<?php echo $cabang['no_hp']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="pantia_qurban"
                                                                                  class="form-label">Panitia
                                                                                  Cabang</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="pantia_qurban"
                                                                                  value="<?php echo $cabang['panitia_qurban']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="no2_hp" class="form-label">No
                                                                                  HP</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="no2_hp"
                                                                                  value="<?php echo $cabang['no2_hp']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="perwakilan"
                                                                                  class="form-label">Perwakilan</label>
                                                                              <select class="form-select"
                                                                                  name="perwakilan">
                                                                                  <option
                                                                                      value="<?php echo $cabang['perwakilan']; ?>">
                                                                                      <?php echo $cabang['perwakilan']; ?>
                                                                                  </option>
                                                                                  <option value="sragen">Sragen</option>
                                                                                  <option value="karanganyar">
                                                                                      Karanganyar
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
                                                                  <a href="<?= base_url('/cabang/hapus/'.$cabang['id']) ?>"
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