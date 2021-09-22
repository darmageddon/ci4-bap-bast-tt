<div class="container">
    <div class="card mx-2 my-4">
        <div class="card-body">
            <form action="<?php echo "/penyedia/$id/edit"; ?>" method="post">
                <?php if (isset($errorMessage)) : ?>
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="alert alert-danger px-2 py-1" role="alert">
                        <?php echo $errorMessage; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if (isset($successMessage)) : ?>
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="alert alert-success px-2 py-1" role="alert">
                        <?php echo $successMessage; ?>
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
                            <label for="input-alamat">Alamat</label>
                            <input type="text" class="form-control" id="input-alamat" name="alamat" value="<?php echo $alamat; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-pemilik">Pemilik</label>
                            <input type="text" class="form-control" id="input-pemilik" name="pemilik" value="<?php echo $pemilik; ?>">
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
            </form>
        </div>
        <div class="card-footer">
            <form action="<?php echo "/penyedia/$id/delete"; ?>" method="post">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
