      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <div>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#">Input
                              Data</button>
                          <a href="/jadwal/export" type="button" class="btn btn-success">Exsport Exel</a>
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
                                      <form action="/jadwal/tambah" method="post">
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
                                              <th>Sapi BUMM</th>
                                              <th>Sapi BUMM Orang</th>
                                              <th>Kambing BUMM</th>
                                              <th>Sapi Cabang</th>
                                              <th>Kambing Cabang</th>
                                              <th>No Antrian</th>
                                              <th>Kirim Hewan</th>
                                              <th>Kirim Besek</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($jadwal): ?>
                                          <?php foreach($jadwal as $cabang): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?= $cabang['cabang']; ?></td>
                                              <td><?= $cabang['sapi_bumm']; ?></td>
                                              <td><?= $cabang['sapib_bumm']; ?></td>
                                              <td><?= $cabang['kambing_bumm']; ?></td>
                                              <td><?= $cabang['sapi_mandiri']; ?></td>
                                              <td><?= $cabang['kambing_mandiri']; ?></td>
                                              <td><?= $cabang['antrian']; ?></td>
                                              <td><?= $cabang['kirim_hewan']; ?></td>
                                              <td><?= $cabang['kirim_besek']; ?></td>
                                              <td>
                                                  <div class="btn-group mb-2" role="group"
                                                      aria-label="Basic mixed styles example">
                                                      <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                          data-bs-target="#edit<?= $cabang['id']; ?>">
                                                          Edit</a>
                                                      <div class="modal fade" id="edit<?= $cabang['id']; ?>"
                                                          tabindex="-1" aria-labelledby="exampleModalLabel"
                                                          aria-hidden="true">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-body">
                                                                      <form action="<?= site_url('/jadwal/edit') ?>"
                                                                          method="post">
                                                                          <input type="hidden"
                                                                              value="<?= $cabang['id']; ?>" name="id">
                                                                          <div class="mb-3">
                                                                              <label for="cabang"
                                                                                  class="form-label">Cabang</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="cabang"
                                                                                  value="<?= $cabang['cabang']; ?>"
                                                                                  readonly>
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="antrian" class="form-label">No
                                                                                  Antrian</label>
                                                                              <input type="text" class="form-control"
                                                                                  name="antrian"
                                                                                  value="<?= $cabang['antrian']; ?>">
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="ket" class="form-label">Jadwal
                                                                                  Kirim Hewan</label>
                                                                              <div class="form-group">
                                                                                  <select id="kirim_hewan"
                                                                                      name="kirim_hewan"
                                                                                      class="form-control">
                                                                                      <option
                                                                                          value="<?= $cabang['kirim_hewan']; ?>">
                                                                                          <?= $cabang['kirim_hewan']; ?>
                                                                                      </option>
                                                                                      <option
                                                                                          value="H-1 15 Juni 2024 Siang">
                                                                                          H-1
                                                                                          15 Juni 2024 Siang</option>
                                                                                      <option
                                                                                          value="H1 16 Juni 2024 Pagi">
                                                                                          H1 16
                                                                                          Juni 2024 Pagi</option>
                                                                                      <option
                                                                                          value="H1 16 Juni 2024 Siang">
                                                                                          H1
                                                                                          16 Juni 2024 Siang</option>
                                                                                      <option
                                                                                          value="H2 17 Juni 2024 Pagi">
                                                                                          H2 17
                                                                                          Juni 2024 Pagi</option>
                                                                                      <option
                                                                                          value="H2 17 Juni 2024 Siang">
                                                                                          H2
                                                                                          17 Juni 2024 Siang</option>
                                                                                      <option
                                                                                          value="H3 18 Juni 2024 Pagi">
                                                                                          H3 18
                                                                                          Juni 2024 Pagi</option>
                                                                                  </select>
                                                                              </div>
                                                                          </div>
                                                                          <div class="mb-3">
                                                                              <label for="ket" class="form-label">Jadwal
                                                                                  Kirim Besek</label>
                                                                              <div class="form-group">
                                                                                  <select id="kirim_besek"
                                                                                      name="kirim_besek"
                                                                                      class="form-control">
                                                                                      <option
                                                                                          value="<?= $cabang['kirim_besek']; ?>">
                                                                                          H<?= $cabang['kirim_besek']; ?>
                                                                                      </option>
                                                                                      <option value="H1 16 Juni 2024">H1
                                                                                          16 Juni 2024</option>
                                                                                      <option value="H2 17 Juni 2024">H2
                                                                                          17 Juni 2024</option>
                                                                                      <option
                                                                                          value="H3 18 Juni 2024 Pagi">
                                                                                          H3 18
                                                                                          Juni 2024</option>
                                                                                  </select>
                                                                              </div>
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
                                                          data-bs-target="#<?= $cabang['id']; ?>">
                                                          Hapus
                                                      </a>
                                                  </div>
                                                  <!-- Modal -->
                                                  <div class="modal fade" id="hapusdata<?= $cabang['id']; ?>"
                                                      tabindex="-1" aria-labelledby="exampleModalLabel"
                                                      aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-body">
                                                                  <h2 class="h2">Apakah anda yakin ?</h2>
                                                                  <p>Menghapus data
                                                                      <?= $cabang['cabang']; ?>
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
                  <div class="app-content">
                      <!--begin::Container-->
                      <div class="container-fluid">
                          <div class="card mb-4">
                              <!-- /.card-header -->
                              <div class="card-body p-0">
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th style="width: 10px">No</th>
                                              <th>Cabang</th>
                                              <th>Sapi BUMM</th>
                                              <th>Kambing BUMM</th>
                                              <th>Sapi Cabang</th>
                                              <th>Kambing Cabang</th>
                                              <th>No Antrian</th>
                                              <th>Kirim Hewan</th>
                                              <th>Kirim Besek</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($h1): ?>
                                          <?php foreach($h1 as $cabang): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?= $cabang['cabang']; ?></td>
                                              <td><?= $cabang['sapi_bumm']; ?></td>
                                              <td><?= $cabang['kambing_bumm']; ?></td>
                                              <td><?= $cabang['sapi_mandiri']; ?></td>
                                              <td><?= $cabang['kambing_mandiri']; ?></td>
                                              <td><?= $cabang['antrian']; ?></td>
                                              <td><?= $cabang['kirim_hewan']; ?></td>
                                              <td><?= $cabang['kirim_besek']; ?></td>
                                          </tr>
                                          <?php endforeach; ?>
                                          <?php endif; ?>
                                      </tbody>
                                      <tfoot>
                                          <tr>
                                              <th style="width: 10px"></th>
                                              <th>Jumlah</th>
                                              <th><?= number_format($sapi_bumm_h1+($sapib_bumm_h1/7), 1, '.', '') ?>
                                              </th>
                                              <th><?= $kambing_bumm_h1 ?></th>
                                              <th><?= $sapi_mandiri_h1 ?></th>
                                              <th><?= $kambing_mandiri_h1 ?></th>
                                              <th></th>
                                              <th></th>
                                              <th></th>
                                          </tr>
                                      </tfoot>
                                  </table>
                              </div>
                              <!-- /.card-body -->
                          </div>
                      </div>
                      <!--end::Container-->
                  </div>
                  <div class="app-content">
                      <!--begin::Container-->
                      <div class="container-fluid">
                          <div class="card mb-4">
                              <div class="card-body p-0">
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th style="width: 10px">No</th>
                                              <th>Cabang</th>
                                              <th>Sapi BUMM</th>
                                              <th>Kambing BUMM</th>
                                              <th>Sapi Cabang</th>
                                              <th>Kambing Cabang</th>
                                              <th>No Antrian</th>
                                              <th>Kirim Hewan</th>
                                              <th>Kirim Besek</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($h2): ?>
                                          <?php foreach($h2 as $cabang): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?= $cabang['cabang']; ?></td>
                                              <td><?= $cabang['sapi_bumm']; ?></td>
                                              <td><?= $cabang['kambing_bumm']; ?></td>
                                              <td><?= $cabang['sapi_mandiri']; ?></td>
                                              <td><?= $cabang['kambing_mandiri']; ?></td>
                                              <td><?= $cabang['antrian']; ?></td>
                                              <td><?= $cabang['kirim_hewan']; ?></td>
                                              <td><?= $cabang['kirim_besek']; ?></td>
                                          </tr>
                                          <?php endforeach; ?>
                                          <?php endif; ?>
                                      </tbody>
                                      <tfoot>
                                          <tr>
                                              <th style="width: 10px"></th>
                                              <th>Jumlah</th>
                                              <th><?= number_format($sapi_bumm_h2+($sapib_bumm_h2/7), 1, '.', '') ?>
                                              </th>
                                              <th><?= $kambing_bumm_h2 ?></th>
                                              <th><?= $sapi_mandiri_h2 ?></th>
                                              <th><?= $kambing_mandiri_h2 ?></th>
                                              <th></th>
                                              <th></th>
                                              <th></th>
                                          </tr>
                                      </tfoot>
                                  </table>
                              </div>
                              <!-- /.card-body -->
                          </div>
                      </div>
                      <!--end::Container-->
                  </div>
                  <div class="app-content">
                      <!--begin::Container-->
                      <div class="container-fluid">
                          <div class="card mb-4">
                              <div class="card-body p-0">
                                  <table class="table">
                                      <thead>
                                          <tr>
                                              <th style="width: 10px">No</th>
                                              <th>Cabang</th>
                                              <th>Sapi BUMM</th>
                                              <th>Kambing BUMM</th>
                                              <th>Sapi Cabang</th>
                                              <th>Kambing Cabang</th>
                                              <th>No Antrian</th>
                                              <th>Kirim Hewan</th>
                                              <th>Kirim Besek</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php if($h3): ?>
                                          <?php foreach($h3 as $cabang): ?>
                                          <tr class="align-middle">
                                              <td><?= $no++; ?></td>
                                              <td><?= $cabang['cabang']; ?></td>
                                              <td><?= $cabang['sapi_bumm']; ?></td>
                                              <td><?= $cabang['kambing_bumm']; ?></td>
                                              <td><?= $cabang['sapi_mandiri']; ?></td>
                                              <td><?= $cabang['kambing_mandiri']; ?></td>
                                              <td><?= $cabang['antrian']; ?></td>
                                              <td><?= $cabang['kirim_hewan']; ?></td>
                                              <td><?= $cabang['kirim_besek']; ?></td>
                                          </tr>
                                          <?php endforeach; ?>
                                          <?php endif; ?>
                                      </tbody>
                                      <tfoot>
                                          <tr>
                                              <th style="width: 10px"></th>
                                              <th>Jumlah</th>
                                              <th><?= number_format($sapi_bumm_h3+($sapib_bumm_h3/7), 1, '.', '') ?>
                                              </th>
                                              <th><?= $kambing_bumm_h3 ?></th>
                                              <th><?= $sapi_mandiri_h3 ?></th>
                                              <th><?= $kambing_mandiri_h3 ?></th>
                                              <th></th>
                                              <th></th>
                                              <th></th>
                                          </tr>
                                      </tfoot>
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