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
                          <a href="/datasapi/export" type="button" class="btn btn-success">Exsport Exel</a>
                      </div>
                      <div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="exampleModalLabel"
                          aria-hidden="true">
                          <div class="modal-dialog">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h1 class="modal-title fs-5" id="exampleModalLabel">Input Data Sapi</h1>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="/datasapi/tambah" method="post">
                                          <div class="mb-3">
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
                                          <div class="mb-3">
                                              <label for="berat" class="form-label">Berat</label>
                                              <input type="text" class="form-control" name="berat">
                                          </div>
                                          <div class="mb-3">
                                              <label for="nomor" class="form-label">Nomor Sapi</label>
                                              <input type="text" class="form-control" name="nomor">
                                          </div>
                                          <div class="mb-3">
                                              <label for="harga" class="form-label">Harga</label>
                                              <input type="text" class="form-control" name="harga">
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
                                          <div class="modal fade" id="hapusdata<?php echo $sapi['id']; ?>" tabindex="-1"
                                              aria-labelledby="exampleModalLabel" aria-hidden="true">
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