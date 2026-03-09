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
                                              <th>Tanggal Input</th>
                                              <th>Nama</th>
                                              <th>Cabang</th>
                                              <th>Hewan</th>
                                              <th>Sumber</th>
                                              <th>Harga</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <?php $no = 1; ?>
                                          <?php foreach ($pequrban as $row): ?>
                                              <tr>
                                                  <td><?= esc($no++) ?></td>
                                                  <td><?= esc($row['updated_at']) ?></td>
                                                  <td><?= esc($row['nama']) ?></td>
                                                  <td><?= esc($row['nama_cabang']) ?></td>
                                                  <td><?= esc($row['jenis_hewan']) ?></td>
                                                  <td><?= esc($row['sumber']) ?></td>
                                                  <td><?= number_format($row['harga']) ?></td>
                                              </tr>
                                          <?php endforeach ?>
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