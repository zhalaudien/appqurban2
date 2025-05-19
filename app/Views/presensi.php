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
                          <div class="row">
                              <div class="d-grid gap-2">
                                  <?php if ($idpanitia): ?>
                                      <?php foreach ($idpanitia as $id): ?>
                                          <button type="button" class="btn btn-outline-primary"
                                              data-bs-toggle="modal"
                                              data-bs-target="#edit<?= esc($id['id']) ?>">
                                              <?= esc($id['seksi']) ?>
                                          </button>

                                          <!-- Modal -->
                                          <div class="modal fade" id="edit<?= esc($id['id']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog modal-lg">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title">Presensi <?= esc($id['seksi']) ?></h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <form method="post" action="<?= site_url('/presensi/simpan') ?>">
                                                          <div class="modal-body">
                                                              <table class="table">
                                                                  <thead>
                                                                      <tr>
                                                                          <th style="width: 10px">No</th>
                                                                          <th>Nama</th>
                                                                          <th>Cabang</th>
                                                                          <th>Keterangan</th>
                                                                          <th>Presensi</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                      <?php
                                                                        $ada = false;
                                                                        $no = 1;
                                                                        foreach ($panitia as $data):
                                                                            if ($data['seksi'] === $id['seksi']):
                                                                                $ada = true;
                                                                        ?>
                                                                              <tr class="align-middle">
                                                                                  <td><?= $no++; ?></td>
                                                                                  <td>
                                                                                      <?= esc($data['nama']) ?>
                                                                                      <input type="hidden" name="data[<?= esc($data['id']) ?>][nama]" value="<?= esc($data['nama']) ?>">
                                                                                  </td>
                                                                                  <td>
                                                                                      <?= esc($data['cabang']) ?>
                                                                                      <input type="hidden" name="data[<?= esc($data['id']) ?>][cabang]" value="<?= esc($data['cabang']) ?>">
                                                                                  </td>
                                                                                  <td>
                                                                                      <?= esc($data['ket']) ?>
                                                                                      <input type="hidden" name="data[<?= esc($data['id']) ?>][ket]" value="<?= esc($data['ket']) ?>">
                                                                                      <input type="hidden" name="data[<?= esc($data['id']) ?>][seksi]" value="<?= esc($data['seksi']) ?>">
                                                                                  </td>
                                                                                  <td>
                                                                                      <!-- Hidden input agar default selalu "tidak hadir" -->
                                                                                      <input type="hidden" name="data[<?= $data['id'] ?>][presensi]" value="tidak hadir">

                                                                                      <!-- Checkbox yang akan override jika dicentang -->
                                                                                      <div class="form-check form-switch">
                                                                                          <input name="data[<?= $data['id'] ?>][presensi]"
                                                                                              class="form-check-input"
                                                                                              type="checkbox"
                                                                                              id="presensi<?= $data['id'] ?>"
                                                                                              value="hadir"
                                                                                              <?= ($data['ket'] === 'hadir') ? 'checked' : '' ?>>
                                                                                      </div>
                                                                                  </td>
                                                                              </tr>
                                                                          <?php
                                                                            endif;
                                                                        endforeach;
                                                                        if (!$ada):
                                                                            ?>
                                                                          <tr>
                                                                              <td colspan="5"><em>Belum ada panitia di seksi ini.</em></td>
                                                                          </tr>
                                                                      <?php endif; ?>
                                                                  </tbody>
                                                              </table>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                              <button type="submit" class="btn btn-primary">Simpan</button>
                                                          </div>
                                                      </form>

                                                  </div>
                                              </div>
                                          </div>
                                      <?php endforeach; ?>
                                  <?php endif; ?>
                              </div>
                              <!-- Modal -->
                              <!-- /.card-body -->
                          </div>
                      </div>
                      <!--end::Container-->
                  </div>
                  <!--end::App Content-->
      </main>
      <!--end::App Main-->