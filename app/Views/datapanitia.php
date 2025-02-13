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
                          <a href="/panitia/export" type="button" class="btn btn-success">Exsport Exel</a>
                      </div>
                      <div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Input Data Panitia</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/panitia/tambah" method="post">
                                          <div class="mb-3">
                                              <label for="nama" class="form-label">Nama</label>
                                              <input type="text" class="form-control" name="nama">
                                          </div>
                                          <div class="mb-3">
                                              <label for="cabang" class="form-label">Cabang</label>
                                              <input type="text" class="form-control" name="cabang">
                                          </div>
                                          <div class="mb-3">
                                              <label for="no_hp" class="form-label">No HP</label>
                                              <input type="text" class="form-control" name="no_hp">
                                          </div>
                                          <div class="mb-3">
                                              <label for="seksi" class="form-label">Seksi</label>
                                              <select class="form-select" name="seksi">
                                                  <?php if($idpanitia): ?>
                                                  <?php foreach($idpanitia as $id): ?>
                                                  <option value="<?php echo $id['seksi']; ?>">
                                                      <?php echo $id['seksi']; ?></option>
                                                  <?php endforeach; ?>
                                                  <?php endif; ?>
                                              </select>
                                          </div>
                                          <div class="mb-3">
                                              <label for="ket" class="form-label">Keterangan</label>
                                              <select class="form-select" name="ket">
                                                  <option value="anggota">Anggota</option>
                                                  <option value="koordinator">Koordinator</option>
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
                      <div class="card-body">
                          <div class="row my-3">
                              <div class="col-md">
                                  <table id="datatablesSimple"
                                      class="table table-striped table-responsive table-hover text-left"
                                      style="width:100%">
                                      <thead>
                                          <tr>
                                              <th style="width: 10px">No</th>
                                              <th>Nama</th>
                                              <th>Cabang</th>
                                              <th>No HP</th>
                                              <th>Seksi</th>
                                              <th>Keterangan</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($viewpanitia): ?>
                                          <?php foreach($viewpanitia as $panitia): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?php echo $panitia['nama']; ?></td>
                                              <td><?php echo $panitia['cabang']; ?></td>
                                              <td><?php echo $panitia['no_hp']; ?></td>
                                              <td><?php echo $panitia['seksi']; ?></td>
                                              <td><?php echo $panitia['ket']; ?></td>
                                              <td>
                                                  <div class="btn-group mb-2" role="group"
                                                      aria-label="Basic mixed styles example">
                                                      <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                          data-bs-target="#edit<?php echo $panitia['id']; ?>">
                                                          Edit</a>
                                                      <div class="modal fade" id="edit<?php echo $panitia['id']; ?>"
                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                          aria-hidden="true">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-body">
                                                                      <form action="<?= site_url('/panitia/edit') ?>"
                                                                          method="post">
                                                                          <div class="mb-3">
                                                                              <input type="hidden" id="id"
                                                                                  value="<?php echo $panitia['id']; ?>"
                                                                                  name="id" readonly>
                                                                              <label for="nama"
                                                                                  class="form-label">Nama</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="nama"
                                                                                  value="<?php echo $panitia['nama']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="cabang"
                                                                                  class="form-label">Cabang</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="cabang"
                                                                                  value="<?php echo $panitia['cabang']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="no_hp" class="form-label">No
                                                                                  HP</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="no_hp"
                                                                                  value="<?php echo $panitia['no_hp']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="seksi"
                                                                                  class="form-label">Seksi</label>
                                                                              <select class="form-select" name="seksi">
                                                                                  <option
                                                                                      value="<?php echo $panitia['seksi']; ?>">
                                                                                      <?php echo $panitia['seksi']; ?>
                                                                                  </option>
                                                                                  <?php if($idpanitia): ?>
                                                                                  <?php foreach($idpanitia as $id): ?>
                                                                                  <option
                                                                                      value="<?php echo $id['seksi']; ?>">
                                                                                      <?php echo $id['seksi']; ?>
                                                                                  </option>
                                                                                  <?php endforeach; ?>
                                                                                  <?php endif; ?>
                                                                              </select>
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="ket"
                                                                                  class="form-label">Keterangan</label>
                                                                              <select class="form-select" name="ket">
                                                                                  <option value="anggota">Anggota
                                                                                  </option>
                                                                                  <option value="koordinator">
                                                                                      Koordinator
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
                                                          data-bs-target="#hapusdata<?php echo $panitia['id']; ?>">
                                                          Hapus
                                                      </a>
                                                  </div>
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="hapusdata<?php echo $panitia['id']; ?>"
                                                      tabindex="-1" aria-labelledby="exampleModalLabel"
                                                      aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-body">
                                                                  <h2 class="h2">Apakah anda yakin ?</h2>
                                                                  <p>Menghapus data
                                                                      <?php echo $panitia['nama']; ?>
                                                                  </p>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <button type="button" class="btn btn-warning"
                                                                      data-bs-dismiss="modal">Batal</button>
                                                                  <a href="<?= base_url('/panitia/hapus/'.$panitia['id']) ?>"
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