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
                          <a href="/qurban/export" type="button" class="btn btn-success">Exsport Exel</a>
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
                                      <form action="/qurban/tambah" method="post">
                                          <div class="mb-3">
                                              <label for="cabang" class="form-label">cabang</label>
                                              <input type="text" class="form-control" name="cabang">
                                          </div>
                                          <div class="mb-3">
                                              <label for="sapi_bumm" class="form-label">Sapi BUMM</label>
                                              <input type="text" class="form-control" name="sapi_bumm">
                                          </div>
                                          <div class="mb-3">
                                              <label for="sapib_bumm" class="form-label">Sapi BUMM Orang</label>
                                              <input type="text" class="form-control" name="sapib_bumm">
                                          </div>
                                          <div class="mb-3">
                                              <label for="kambing_bumm" class="form-label">Kambing BUMM</label>
                                              <input type="text" class="form-control" name="kambing_bumm">
                                          </div>
                                          <div class="mb-3">
                                              <label for="sapi_mandiri" class="form-label">Sapi Mandiri</label>
                                              <input type="text" class="form-control" name="sapi_mandiri">
                                          </div>
                                          <div class="mb-3">
                                              <label for="kambing_mandiri" class="form-label">KAmbing Mandiri</label>
                                              <input type="text" class="form-control" name="alamat">
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
                                      <th>Sapi BUMM</th>
                                      <th>Sapi BUMM Orang</th>
                                      <th>Kambing BUMM</th>
                                      <th>Sapi Mandiri</th>
                                      <th>Kambing Mandiri</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $no = 1; ?>
                                  <?php if($qurban): ?>
                                  <?php foreach($qurban as $cabang): ?>
                                  <tr class="align-middle">
                                      <td><?= $no++; ?></td>
                                      <td><?php echo $cabang['cabang']; ?></td>
                                      <td><?php echo $cabang['sapi_bumm']; ?></td>
                                      <td><?php echo $cabang['sapib_bumm']; ?></td>
                                      <td><?php echo $cabang['kambing_bumm']; ?></td>
                                      <td><?php echo $cabang['sapi_mandiri']; ?></td>
                                      <td><?php echo $cabang['kambing_mandiri']; ?></td>
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
                                                              <form action="<?= site_url('/qurban/edit') ?>"
                                                                  method="post">
                                                                  <div class="mb-3">
                                                                      <input type="hidden" id="id"
                                                                          value="<?php echo $cabang['id']; ?>" name="id"
                                                                          readonly>
                                                                      <label for="cabang"
                                                                          class="form-label">Cabang</label>
                                                                      <input type="text" class="form-control"
                                                                          name="cabang"
                                                                          value="<?php echo $cabang['cabang']; ?>"
                                                                          disabled>
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="sapi_bumm" class="form-label">Sapi
                                                                          BUMM</label>
                                                                      <input type="text" class="form-control"
                                                                          name="sapi_bumm"
                                                                          value="<?php echo $cabang['sapi_bumm']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="sapib_bumm" class="form-label">Sapi
                                                                          BUMM Orang</label>
                                                                      <input type="text" class="form-control"
                                                                          name="sapib_bumm"
                                                                          value="<?php echo $cabang['sapib_bumm']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="kambing_bumm"
                                                                          class="form-label">Kambing BUMM</label>
                                                                      <input type="text" class="form-control"
                                                                          name="kambing_bumm"
                                                                          value="<?php echo $cabang['kambing_bumm']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="sapi_mandiri" class="form-label">Sapi
                                                                          Cabang</label>
                                                                      <input type="text" class="form-control"
                                                                          name="sapi_mandiri"
                                                                          value="<?php echo $cabang['sapi_mandiri']; ?>">
                                                                  </div>
                                                                  <div class="mb-3">
                                                                      <label for="kambing_mandiri"
                                                                          class="form-label">Kambing Cabang</label>
                                                                      <input type="text" class="form-control"
                                                                          name="kambing_mandiri"
                                                                          value="<?php echo $cabang['kambing_mandiri']; ?>">
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
                                                          <a href="<?= base_url('/qurban/hapus/'.$cabang['id']) ?>"
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