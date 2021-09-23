<div class="container">
    <form action="<?php echo "/kegiatan/$kgid/barang/new"; ?>" method="post">
        <div class="card mx-2 my-4">
            <div class="card-body">
                <?php if (isset($errorMessage)) : ?>
                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="alert alert-danger px-2 py-1" role="alert">
                        <?php echo $errorMessage; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for="input-nama">Nama Barang</label>
                            <input type="text" class="form-control" id="input-nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-spesifikasi">Spesifikasi</label>
                            <input type="text" class="form-control" id="input-spesifikasi" name="spesifikasi" value="<?php echo $spesifikasi; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-kategori">Kategori</label>
                            <input type="text" class="form-control" id="input-kategori" name="kategori" value="<?php echo $kategori; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-jumlah">Jumlah</label>
                            <input type="text" class="form-control" id="input-jumlah" name="jumlah" value="<?php echo $jumlah; ?>">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for="input-satuan">Satuan</label>
                            <input type="text" class="form-control" id="input-satuan" name="satuan" value="<?php echo $satuan; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-harga">Harga Satuan</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Harga Satuan" id="input-kwitansi" name="harga" value="<?php echo $harga; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">,00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="input-keterangan" name="keterangan" value="<?php echo $keterangan; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
