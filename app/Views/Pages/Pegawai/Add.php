<div class="container">
    <div class="card mx-2 my-4">
        <div class="card-header">
            <h5>Tambah Pegawai</h5>
        </div>
        <form action="<?php echo "/pegawai/new$from"; ?>" method="post">
            <div class="card-body">
                <?php if (isset($errorMessage)) : ?>
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="alert alert-danger px-2 py-1" role="alert">
                        <?php echo $errorMessage; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="form-group">
                            <label for="input-nama">Nama</label>
                            <input type="text" class="form-control" id="input-nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-nip">NIP</label>
                            <input type="text" class="form-control" id="input-nip" name="nip" value="<?php echo $nip; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="input-jabatan" name="jabatan" value="<?php echo $jabatan; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
