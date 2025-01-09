      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <!-- Small boxes (Stat box) -->
                      <div class="row">
                          <div class="col-lg-3 col-6">
                              <!-- small box -->
                              <div class="small-box text-bg-primary">
                                  <div class="inner">
                                      <h5>Total Sapi BUMM : 150</h5>
                                  </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-3 col-6">
                              <!-- small box -->
                              <div class="small-box text-bg-success">
                                  <div class="inner">
                                      <h5>Total Kambing BUMM : 150</h5>
                                  </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-3 col-6">
                              <!-- small box -->
                              <div class="small-box text-bg-warning">
                                  <div class="inner">
                                      <h5>Total Sapi Mandiri : 150</h5>
                                  </div>
                              </div>
                          </div>
                          <!-- ./col -->
                          <div class="col-lg-3 col-6">
                              <!-- small box -->
                              <div class="small-box text-bg-danger">
                                  <div class="inner">
                                      <h5>Total Kambing Mandiri : 150</h5>
                                  </div>
                              </div>
                          </div>
                          <!-- ./col -->
                      </div>
                      <!-- /.row -->
                      <div>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                              data-bs-target="#inputdata">Input Data</button>
                          <a href="/penerimaan/export" type="button" class="btn btn-success">Exsport Exel</a>
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
                                      <form action="/penerimaan/tambah" method="post">
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
                                              <label for="pengirim" class="form-label">Pengirim</label>
                                              <input type="text" class="form-control" name="pengirim">
                                          </div>
                                          <div class="mb-3">
                                              <label for="sapi" class="form-label">Jumlah Sapi</label>
                                              <input type="text" class="form-control" name="sapi">
                                          </div>
                                          <div class="mb-3">
                                              <label for="kambing" class="form-label">Jumlah Kambing</label>
                                              <input type="text" class="form-control" name="kambing">
                                          </div>
                                          <div class="mb-3">
                                              <label for="pembayaran" class="form-label">Pembayaran</label>
                                              <input type="text" class="form-control" name="pembayaran">
                                          </div>
                                          <div class="mb-3">
                                              <label for="shadaqoh" class="form-label">Shadaqoh</label>
                                              <input type="text" class="form-control" name="shadaqoh">
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
          <br>
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
                                      <th>Pengirim</th>
                                      <th>Jumlah Sapi</th>
                                      <th>Jumlah Kambing</th>
                                      <th>Pembayaran</th>
                                      <th>Shadaqoh</th>
                                      <th>Tanggal Input</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $no = 1; ?>
                                  <?php if($viewpenerimaan): ?>
                                  <?php foreach($viewpenerimaan as $terima): ?>
                                  <tr class="align-middle">
                                      <td><?= $no++; ?></td>
                                      <td><?php echo $terima['cabang']; ?></td>
                                      <td><?php echo $terima['pengirim']; ?></td>
                                      <td><?php echo $terima['sapi']; ?></td>
                                      <td><?php echo $terima['kambing']; ?></td>
                                      <td><?php echo $terima['pembayaran']; ?></td>
                                      <td><?php echo $terima['shadaqoh']; ?></td>
                                      <td><?php echo $terima['date_input']; ?></td>
                                      <td>
                                          <div class="btn-group mb-2" role="group"
                                              aria-label="Basic mixed styles example">
                                              <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                                  data-bs-target="#edit<?php echo $terima['id']; ?>">
                                                  Print</a>
                                              <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                  data-bs-target="#hapusdata<?php echo $terima['id']; ?>">
                                                  Hapus
                                              </a>
                                          </div>
                                          <!-- Modal -->
                                          <div class="modal fade" id="hapusdata<?php echo $terima['id']; ?>"
                                              tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                  <div class="modal-content">
                                                      <div class="modal-body">
                                                          <h2 class="h2">Apakah anda yakin ?</h2>
                                                          <p>Menghapus data
                                                              <?php echo $terima['cabang']; ?>, pengirim
                                                              <?php echo $terima['pengirim']; ?>
                                                          </p>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-warning"
                                                              data-bs-dismiss="modal">Batal</button>
                                                          <a href="<?= base_url('/penerimaan/hapus/'.$terima['id']) ?>"
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