    <div class="container">
        <div class="card mx-2 my-4">
            <div class="card-header">
                <a class="btn btn-primary" href="/pegawai/new" role="button">
                    <i class="fas fa-plus mr-1"></i> Tambah Pegawai
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table table-striped table-hover table-sm" id="table-pegawai">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo "/pegawai/$item->id"; ?>">
                                        <?php echo $item->nama; ?>
                                    </a>
                                </td>
                                <td><?php echo $item->nip; ?></td>
                                <td><?php echo $item->jabatan; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
