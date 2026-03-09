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
                                                  <?php if ($idpanitia): ?>
                                                      <?php foreach ($idpanitia as $id): ?>
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
                                          <?php if ($viewpanitia): ?>
                                              <?php foreach ($viewpanitia as $p): ?>
                                                  <tr class="align-middle">
                                                      <td><?= $no++; ?></td>
                                                      <td><?php echo $p['nama']; ?></td>
                                                      <td><?php echo $p['nama_cabang']; ?></td>
                                                      <td><?php echo $p['no_hp']; ?></td>
                                                      <td><?php echo $p['nama_seksi']; ?></td>
                                                      <td><?php echo $p['jabatan']; ?></td>
                                                      <td>
                                                          <a href="/panitia/edit/<?php echo $p['id']; ?>"
                                                              class="btn btn-warning">Edit</a>
                                                          <a href="/panitia/hapus/<?php echo $p['id']; ?>"
                                                              class="btn btn-danger"
                                                              onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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