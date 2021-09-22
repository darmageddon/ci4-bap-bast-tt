    <div class="container">
        <div class="card mx-2 my-4">
            <div class="card-header">
                <a class="btn btn-primary" href="/kegiatan/new" role="button">
                    <i class="fas fa-plus mr-1"></i> Tambah Kegiatan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table table-striped table-hover table-sm" id="table-kegiatan">
                        <thead>
                            <tr>
                                <th>Bulan</th>
                                <th>Paket</th>
                                <th>Nilai Kwitansi</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?php echo $item->bulan; ?></td>
                                <td><?php echo $item->paket; ?></td>
                                <td><?php echo $item->kwitansi; ?></td>
                                <td>
                                    <a data-toggle="modal" href="#download" role="button" data-id="<?php echo $item->id; ?>" data-paket="<?php echo $item->paket; ?>">Download</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Download -->
    <div class="modal fade" id="download" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Download PDF</h5>
                </div>
                <div class="modal-body">
                    <h6 id="title-kegiatan"></h6>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a id="link-bap" href="#" target="_blank">
                                <i class="fas fa-cloud-download-alt"></i> BAP
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a id="link-lampiran-bap" href="#" target="_blank">
                                <i class="fas fa-cloud-download-alt"></i> Lampiran BAP
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a id="link-bast" href="#" target="_blank">
                                <i class="fas fa-cloud-download-alt"></i> BAST
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a id="link-lampiran-bast" href="#" target="_blank">
                                <i class="fas fa-cloud-download-alt"></i> Lampiran BAST
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a id="link-tt" href="#" target="_blank">
                                <i class="fas fa-cloud-download-alt"></i> Tanda Terima
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
