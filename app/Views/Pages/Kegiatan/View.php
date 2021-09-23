<div class="container">
    <form action="<?php echo "/kegiatan/$id"; ?>" method="post">
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
                <?php if (isset($successMessage)) : ?>
                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="alert alert-success px-2 py-1" role="alert">
                        <?php echo $successMessage; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for="input-bulan">Bulan</label>
                            <select class="form-control" id="input-bulan" name="bulan">
                                <option <?php echo ($bulan == 1) ? 'selected ' : ''; ?>value="1">Januari</option>
                                <option <?php echo ($bulan == 2) ? 'selected ' : ''; ?>value="2">Februari</option>
                                <option <?php echo ($bulan == 3) ? 'selected ' : ''; ?>value="3">Maret</option>
                                <option <?php echo ($bulan == 4) ? 'selected ' : ''; ?>value="4">April</option>
                                <option <?php echo ($bulan == 5) ? 'selected ' : ''; ?>value="5">Mei</option>
                                <option <?php echo ($bulan == 6) ? 'selected ' : ''; ?>value="6">Juni</option>
                                <option <?php echo ($bulan == 7) ? 'selected ' : ''; ?>value="7">Juli</option>
                                <option <?php echo ($bulan == 8) ? 'selected ' : ''; ?>value="8">Agustus</option>
                                <option <?php echo ($bulan == 9) ? 'selected ' : ''; ?>value="9">September</option>
                                <option <?php echo ($bulan == 10) ? 'selected ' : ''; ?>value="10">Oktober</option>
                                <option <?php echo ($bulan == 11) ? 'selected ' : ''; ?>value="11">November</option>
                                <option <?php echo ($bulan == 12) ? 'selected ' : ''; ?> value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input-kegiatan">Kegiatan</label>
                            <input type="text" class="form-control" id="input-kegiatan" name="kegiatan" value="<?php echo $kegiatan; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-paket">Paket</label>
                            <input type="text" class="form-control" id="input-paket" name="paket" value="<?php echo $paket; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-prodi">Prodi</label>
                            <input type="text" class="form-control" id="input-prodi" name="prodi" value="<?php echo $prodi; ?>">
                        </div>
                        <div class="form-group">
                            <label for="input-prodi">Nilai Kwitansi</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" class="form-control" aria-label="Nilai Kwitansi" id="input-kwitansi" name="nilai_kwitansi" value="<?php echo $nilai_kwitansi; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text">,00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for="input-penyedia">Penyedia</label>
                            <div class="input-group">
                                <select class="form-control" id="input-penyedia" name="penyedia">
                                    <?php foreach ($listPenyedia as $item): ?>
                                    <option <?php echo ($item->id == $penyedia->id) ? 'selected ' : ''; ?>value="<?php echo $item->id; ?>"><?php echo $item->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo "/penyedia/$penyedia->id?kegiatan=$id"; ?>" id="dropdown-penyedia" data-kegiatan-id="<?php echo $id; ?>">View / Edit</a>
                                        <a class="dropdown-item" href="<?php echo "/penyedia/new?kegiatan=$id" ?>">Tambah Penyedia</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-penyedia">Unit</label>
                            <div class="input-group">
                                <select class="form-control" id="input-unit" name="unit">
                                    <?php foreach ($listPegawai as $pegawai): ?>
                                    <option <?php echo ($pegawai->id == $unit->id) ? 'selected ' : ''; ?>value="<?php echo $pegawai->id; ?>"><?php echo $pegawai->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo "/pegawai/$unit->id?kegiatan=$id"; ?>" id="dropdown-unit" data-kegiatan-id="<?php echo $id; ?>">View / Edit</a>
                                        <a class="dropdown-item" href="<?php echo "/pegawai/new?kegiatan=$id" ?>">Tambah Unit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-penyedia">Kaprodi</label>
                            <div class="input-group">
                                <select class="form-control" id="input-kaprodi" name="kaprodi">
                                    <?php foreach ($listPegawai as $pegawai): ?>
                                    <option <?php echo ($pegawai->id == $kaprodi->id) ? 'selected ' : ''; ?>value="<?php echo $pegawai->id; ?>"><?php echo $pegawai->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo "/pegawai/$kaprodi->id?kegiatan=$id"; ?>" id="dropdown-kaprodi" data-kegiatan-id="<?php echo $id; ?>">View / Edit</a>
                                        <a class="dropdown-item" href="<?php echo "/pegawai/new?kegiatan=$id" ?>">Tambah Kaprodi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-8">
                        <hr class="border border-info"/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for="input-sp-tanggal">Surat Pesanan (SP)</label>
                            <div class="input-group">
                                <input type="text" class="form-control col-8" name="sp_nomor" placeholder="Nomor SP" value="<?php echo $sp->nomor; ?>">
                                <input type="text" class="form-control col-4" id="input-sp-tanggal" placeholder="Tanggal SP" name="sp_tanggal" value="<?php echo $sp->tanggal; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-bap-tanggal">Berita Acara Pemeriksaan (BAP)</label>
                            <div class="input-group">
                                <input type="text" class="form-control col-8" name="bap_nomor" placeholder="Nomor BAP" value="<?php echo $bap->nomor; ?>">
                                <input type="text" class="form-control col-4" id="input-bap-tanggal" placeholder="Tanggal BAP" name="bap_tanggal" value="<?php echo $bap->tanggal; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="form-group">
                            <label for="input-bap-tanggal">Berita Acara Serah Terima (BAST)</label>
                            <div class="input-group">
                                <input type="text" class="form-control col-8" name="bast_nomor" placeholder="Nomor BAST" value="<?php echo $bast->nomor; ?>">
                                <input type="text" class="form-control col-4" id="input-bast-tanggal" placeholder="Tanggal BAST" name="bast_tanggal" value="<?php echo $bast->tanggal; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-bap-tanggal">Tanda Terima (TT)</label>
                            <input type="text" class="form-control" id="input-tt-tanggal" placeholder="Tanggal Tanda Terima" name="tt_tanggal" value="<?php echo $tt->tanggal; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <button type="submit" class="btn btn-success" name="action_update" value="Update">Simpan</button>
                    <button type="submit" class="btn btn-danger" name="action_delete" value="Delete">Hapus</button>
                </div>
            </div>
        </div>
    </form>

    <div class="card mx-2 my-4">
        <div class="card-header">
            <a class="btn btn-info" href="<?php echo "/kegiatan/$id/barang/new"; ?>" role="button">
                <i class="fas fa-plus mr-1"></i> Tambah Barang
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive p-2">
                <table class="table table-striped table-hover table-sm" id="table-barang" style="min-width: 768px;">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Spesifikasi</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listBarang as $item): ?>
                        <tr>
                            <td>
                                <a href="<?php echo "/kegiatan/$id/barang/$item->id"; ?>">
                                    <?php echo $item->nama; ?>
                                </a>
                            </td>
                            <td><?php echo $item->spesifikasi; ?></td>
                            <td><?php echo $item->kategori; ?></td>
                            <td><?php echo $item->satuan; ?></td>
                            <td><?php echo $item->harga; ?></td>
                            <td><?php echo $item->harga_total; ?></td>
                            <td><?php echo $item->keterangan; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
