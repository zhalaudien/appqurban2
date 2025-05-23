      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
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
                                          <?php if ($jadwal): ?>
                                              <?php foreach ($jadwal as $cabang): ?>
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
                                                                                      readonly disabled>
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
                                                                                          <option value="H-1 <?= $j_h_1; ?> Siang">H-1 <?= $j_h_1; ?> Siang</option>
                                                                                          <option value="H1 <?= $j_h; ?> Pagi">H1 <?= $j_h; ?> Pagi</option>
                                                                                          <option value="H1 <?= $j_h; ?> Siang">H1 <?= $j_h; ?> Siang</option>
                                                                                          <option value="H2 <?= $j_h2; ?> Pagi">H2 <?= $j_h2; ?> Pagi</option>
                                                                                          <option value="H2 <?= $j_h2; ?> Siang">H2 <?= $j_h2; ?> Siang</option>
                                                                                          <option value="H3 <?= $j_h3; ?> Pagi">H3 <?= $j_h3; ?> Pagi</option>
                                                                                          <option value="H3 <?= $j_h3; ?> Siang">H3 <?= $j_h3; ?> Siang</option>
                                                                                          <option value="H4 <?= $j_h4; ?> Pagi">H4 <?= $j_h4; ?> Pagi</option>
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
                                                                                              <?= $cabang['kirim_besek']; ?>
                                                                                          </option>
                                                                                          <option value="H1 <?= $j_h; ?>">H1 <?= $j_h; ?></option>
                                                                                          <option value="H2 <?= $j_h2; ?>">H2 <?= $j_h2; ?></option>
                                                                                          <option value="H3 <?= $j_h3; ?>">H3 <?= $j_h3; ?></option>
                                                                                          <option value="H4 <?= $j_h4; ?>">H4 <?= $j_h4; ?></option>
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
                                          <?php if ($h1): ?>
                                              <?php foreach ($h1 as $cabang): ?>
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
                                              <th><?= number_format($sapi_bumm_h1 + ($sapib_bumm_h1 / 7), 1, '.', '') ?>
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
                                          <?php if ($h2): ?>
                                              <?php foreach ($h2 as $cabang): ?>
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
                                              <th><?= number_format($sapi_bumm_h2 + ($sapib_bumm_h2 / 7), 1, '.', '') ?>
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
                                          <?php if ($h3): ?>
                                              <?php foreach ($h3 as $cabang): ?>
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
                                              <th><?= number_format($sapi_bumm_h3 + ($sapib_bumm_h3 / 7), 1, '.', '') ?>
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
                                          <?php if ($h4): ?>
                                              <?php foreach ($h4 as $cabang): ?>
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
                                              <th><?= number_format($sapi_bumm_h4 + ($sapib_bumm_h4 / 7), 1, '.', '') ?>
                                              </th>
                                              <th><?= $kambing_bumm_h4 ?></th>
                                              <th><?= $sapi_mandiri_h4 ?></th>
                                              <th><?= $kambing_mandiri_h4 ?></th>
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
      </main>
      <!--end::App Main-->