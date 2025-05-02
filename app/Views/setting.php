      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <div class="app-content">
                  <div class="container-fluid">
                      <div class="w-auto col-lg-6 col-6">
                          <div class="w-auto card card-outline card-primary mb-4">
                              <div class="card-header">
                                  <h3 class="card-title"></h3>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body">
                                  <?php if ($viewsetting): ?>
                                      <?php foreach ($viewsetting as $setting): ?>
                                          <table class="table table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>Perkiraan Produksi Besek</th>
                                                      <th> </th>
                                                      <th> </th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>Kambing</td>
                                                      <td><?php echo $setting['b_kb']; ?></td>
                                                      <td>/Ekor</td>
                                                  </tr>
                                                  <tr>
                                                      <td>Sapi</td>
                                                      <td><?php echo $setting['b_sapi']; ?></td>
                                                      <td>/Ekor</td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                          <table class="table table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>Jadwal Pengiriman</th>
                                                      <th> </th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>Jadwal H-1</td>
                                                      <td><?php echo $setting['j_h_1']; ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Jadwal H</td>
                                                      <td><?php echo $setting['j_h']; ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Jadwal H2</td>
                                                      <td><?php echo $setting['j_h2']; ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Jadwal H3</td>
                                                      <td><?php echo $setting['j_h3']; ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Jadwal H4</td>
                                                      <td><?php echo $setting['j_h4']; ?></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                          <table class="table table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>Biaya Penyembelihan</th>
                                                      <th> </th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                      <td>Rp. <?= number_format($setting['biaya'], 0, ',', '.'); ?></td>
                                                  </tr>
                                              </tbody>
                                          </table>
                                          <table class="table table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>
                                                          <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                              data-bs-target="#edit<?php echo $setting['id']; ?>">
                                                              Setting</a>
                                                          <div class="modal fade" id="edit<?php echo $setting['id']; ?>"
                                                              tabindex="-1" aria-labelledby="exampleModalLabel"
                                                              aria-hidden="true">
                                                              <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                      <div class="modal-body">
                                                                          <form action="<?= site_url('/setting/edit') ?>"
                                                                              method="post">
                                                                              <div class="mb-3">
                                                                                  <input type="hidden" id="id"
                                                                                      value="<?php echo $setting['id']; ?>"
                                                                                      name="id" readonly>
                                                                                  <label for="nama"
                                                                                      class="form-label">Besek Kambing</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="b_kb"
                                                                                      value="<?php echo $setting['b_kb']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="dinas"
                                                                                      class="form-label">Besek Sapi</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="b_sapi"
                                                                                      value="<?php echo $setting['b_sapi']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="dinas"
                                                                                      class="form-label">Jadwal Hari ke -1</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="j_h_1"
                                                                                      value="<?php echo $setting['j_h_1']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="dinas"
                                                                                      class="form-label">Jadwal Hari H</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="j_h"
                                                                                      value="<?php echo $setting['j_h']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="dinas"
                                                                                      class="form-label">Jadwal Hari ke 2</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="j_h2"
                                                                                      value="<?php echo $setting['j_h2']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="dinas"
                                                                                      class="form-label">Jadwal Hari ke 3</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="j_h3"
                                                                                      value="<?php echo $setting['j_h3']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="dinas"
                                                                                      class="form-label">Jadwal Hari ke 4</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="j_h4"
                                                                                      value="<?php echo $setting['j_h4']; ?>">
                                                                              </div>
                                                                              <div class="mb-3">
                                                                                  <label for="dinas"
                                                                                      class="form-label">Biaya Penyembelihan</label>
                                                                                  <input type="text" class="form-control"
                                                                                      name="biaya"
                                                                                      value="<?php echo $setting['biaya']; ?>">
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
                                                      </th>
                                                  </tr>
                                              </thead>
                                          </table>
                                      <?php endforeach; ?>
                                  <?php endif; ?>
                              </div>
                              <!-- /.card-body -->
                          </div>
                          <!--end::Small Box Widget 1-->
                      </div>
                      <!--end::Row-->
                  </div>
              </div>

      </main>
      <!--end::App Main-->