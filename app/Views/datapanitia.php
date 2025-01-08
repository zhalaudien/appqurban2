      <!--begin::App Main-->
      <main class="app-main">
          <!--begin::App Content Header-->
          <div class="app-content-header">
              <!--begin::Container-->
              <div class="container-fluid">
                  <!--begin::Row-->
                  <div class="row">
                      <div class="col-sm-6">
                          <h3 class="mb-0">Data Panitia</h3>
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
                                      <th>Nama</th>
                                      <th>Cabang</th>
                                      <th>No HP</th>
                                      <th>Seksi</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php $no = 1; ?>
                                  <?php if($viewpanitia): ?>
                                  <?php foreach($viewpanitia as $panitia): ?>
                                  <tr class="align-middle">
                                      <td><?= $no++; ?></td>
                                      <td><?php echo $panitia['nama']; ?></td>
                                      <td><?php echo $panitia['cabang']; ?></td>
                                      <td><?php echo $panitia['no_hp']; ?></td>
                                      <td><?php echo $panitia['seksi']; ?></td>
                                      <td><?php echo $panitia['ket']; ?></td>
                                      <td>
                                          <div class="btn-group mb-2" role="group" aria-label="Basic example">
                                              <button type="button" class="btn btn-success">Edit</button>
                                              <button type="button" class="btn btn-danger">Delet</button>
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