    <div class="container">
        <div class="card mx-2 my-4">
            <div class="card-header">
                <a class="btn btn-primary" href="/penyedia/new" role="button">
                    <i class="fas fa-plus mr-1"></i> Tambah Penyedia
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive p-2">
                    <table class="table table-striped table-hover table-sm" id="table-penyedia">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Pemilik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo "/penyedia/$item->id"; ?>">
                                        <?php echo $item->nama; ?>
                                    </a>
                                </td>
                                <td><?php echo $item->alamat; ?></td>
                                <td><?php echo $item->pemilik; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
