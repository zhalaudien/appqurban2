      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <div class="app-content">
                  <!--begin::Container-->
                  <div class="container-fluid">
                      <!--begin::Row-->
                      <div class="row">
                          <!--begin::Col-->
                          <div class="w-auto col-lg-6 col-6">
                              <!--begin::Small Box Widget 1-->
                              <div class="card card-info card-outline mb-4">
                                  <!--begin::Header-->
                                  <div class="card-header">
                                      <div class="card-title">Input Hewan Masuk</div>
                                  </div>
                                  <!--end::Header-->
                                  <!--begin::Form-->
                                  <form class="needs-validation" action="/penerimaan/tambah" method="post" novalidate>
                                      <!--begin::Body-->
                                      <div class="card-body">
                                          <!--begin::Row-->
                                          <div class="row g-3">
                                              <!--begin::Col-->
                                              <div class="col-md-6">
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
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-6">
                                                  <label for="pengirim" class="form-label">Pengirim</label>
                                                  <input type="text" class="form-control" name="pengirim">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-6">
                                                  <label for="sapi" class="form-label">Jumlah Sapi</label>
                                                  <input type="text" class="form-control" name="sapi">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-6">
                                                  <label for="kambing" class="form-label">Jumlah Kambing</label>
                                                  <input type="text" class="form-control" name="kambing">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-6">
                                                  <label for="pembayaran" class="form-label">Pembayaran</label>
                                                  <input type="text" class="form-control" name="pembayaran">
                                              </div>
                                              <!--end::Col-->
                                              <!--begin::Col-->
                                              <div class="col-md-6">
                                                  <label for="shadaqoh" class="form-label">Shadaqoh</label>
                                                  <input type="text" class="form-control" name="shadaqoh">
                                              </div>
                                              <!--end::Col-->
                                          </div>
                                          <!--end::Row-->
                                      </div>
                                      <!--end::Body-->
                                      <!--begin::Footer-->
                                      <div class="card-footer">
                                          <button class="btn btn-info" type="submit">Save Data</button>
                                      </div>
                                      <!--end::Footer-->
                                  </form>
                                  <!--end::Form-->
                              </div>
                              <!--end::Small Box Widget 1-->
                          </div>
                          <!--end::Col-->
                          <div class="w-auto col-lg-6 col-6">
                              <div class="card card-outline card-primary collapsed-card mb-2">
                                  <div class="card-header">
                                      <h3 class="card-title">Data Hewan</h3>
                                      <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                          </button>
                                      </div>
                                      <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="w-auto card-body">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>Hewan</th>
                                                  <th>Total Hewan</th>
                                                  <th>Hewan Masuk</th>
                                                  <th>Kekurangan Hewan</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr class="align-middle">
                                                  <td>Sapi BUMM</td>
                                                  <td><?= number_format($sapi_bumm+($sapib_bumm/7), 1, '.', '')?></td>
                                                  <td><?= $total_sapi_bumm ?></td>
                                                  <td><?= (number_format($sapi_bumm+($sapib_bumm/7), 1, '.', ''))-$total_sapi_bumm ?>
                                                  </td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Sapi Cabang</td>
                                                  <td><?= $sapi_mandiri ?></td>
                                                  <td><?= $total_sapi_cabang ?></td>
                                                  <td><?= $sapi_mandiri-$total_sapi_cabang ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Kambing BUMM</td>
                                                  <td><?= $kambing_bumm ?></td>
                                                  <td><?= $total_kambing_bumm ?></td>
                                                  <td><?= $kambing_bumm-$total_kambing_bumm ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Kambing Cabang</td>
                                                  <td><?= $kambing_mandiri ?></td>
                                                  <td><?= $total_kambing_cabang ?></td>
                                                  <td><?= $kambing_mandiri-$total_kambing_cabang ?></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                              <div class="card card-outline card-warning mb-2 ">
                                  <div class="card-header">
                                      <h3 class="card-title">Uang Masuk</h3>
                                      <div class="card-tools">
                                          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                          </button>
                                      </div>
                                      <!-- /.card-tools -->
                                  </div>
                                  <!-- /.card-header -->
                                  <div class="card-body">
                                      <table class="table table-striped">
                                          <thead>
                                              <tr>
                                                  <th>Uang Masuk</th>
                                                  <th>Jumlah</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr class="align-middle">
                                                  <td>BUMM</td>
                                                  <td>Rp. <?= number_format($uang_bumm, 0, ',', '.'); ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Cabang</td>
                                                  <td>Rp. <?= number_format($uang_cabang, 0, ',', '.'); ?></td>
                                              </tr>
                                              <tr class="align-middle">
                                                  <td>Shadaqoh</td>
                                                  <td>Rp. <?= number_format($shadaqoh, 0, ',', '.'); ?></td>
                                              </tr>
                                          </tbody>
                                          <tfoot>
                                              <tr class="align-middle">
                                                  <th> Total Uang Masuk </th>
                                                  <th> Rp.
                                                      <?= number_format(($uang_bumm+$uang_cabang+$shadaqoh), 0, ',', '.'); ?>
                                                  </th>
                                              </tr>
                                          </tfoot>
                                      </table>
                                  </div>
                                  <!-- /.card-body -->
                              </div>
                              <div class="card-body mb-2">
                                  <div class="list-group">
                                      <a href="/penerimaan/export" type="button"
                                          class="btn list-group-item list-group-item-action active" aria-current="true">
                                          Export Data To Exel
                                      </a>
                                  </div>
                              </div>
                              <!--end::Small Box Widget 1-->
                          </div>
                          <!--end::Col-->
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
                                                  <td>Rp. <?= number_format($terima['pembayaran'], 0, ',', '.'); ?></td>
                                                  <td>Rp. <?= number_format($terima['shadaqoh'], 0, ',', '.'); ?></td>
                                                  <td><?php echo $terima['date_input']; ?></td>
                                                  <td>
                                                      <div class="btn-group mb-2" role="group"
                                                          aria-label="Basic mixed styles example">
                                                          <a type="button" class="btn btn-success"
                                                              href="<?= base_url('/penerimaan/print/'.$terima['id']) ?>"
                                                              target="_blank">
                                                              Print
                                                          </a>
                                                          <a type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                              data-bs-target="#hapusdata<?php echo $terima['id']; ?>">
                                                              Hapus
                                                          </a>
                                                      </div>
                                                      <!-- Modal -->
                                                      <div class="modal fade" id="hapusdata<?php echo $terima['id']; ?>"
                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                          aria-hidden="true">
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