    <!-- Content -->
    <div class="regular size9">
        <table class="line-12-8 default-table-1">
            <tr>
                <td style="width: 25mm;">Lampiran</td>
                <td style="width: 5mm;">:</td>
                <td>Berita Acara Pemeriksaan Barang/Pekerjaan</td>
            </tr>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td><?php echo $bap->nomor; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><?php echo $bap->tanggal->getDate(); ?></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><?php echo $paket; ?></td>
            </tr>
        </table>

        <table class="barang line-12-8">
            <tr class="header bold">
                <td style="width: 7mm">No</td>
                <td style="width: 51mm">Nama Barang / Spesifikasi</td>
                <td style="width: 20mm">Satuan</td>
                <td style="width: 28mm">Harga Satuan</td>
                <td style="width: 17mm">Jumlah</td>
                <td style="width: 28mm">Total (Rp)</td>
                <td>Keterangan</td>
            </tr>
            <?php foreach ($barang->items as $item): ?>
            <tr>
                <td><?php echo $item->nomor; ?></td>
                <td class="left"><?php echo $item->nama; ?> (<span class="italic"><?php echo $item->spesifikasi; ?></span>)</td>
                <td><?php echo $item->satuan; ?></td>
                <td class="right"><?php echo $item->harga->value; ?></td>
                <td><?php echo $item->jumlah; ?></td>
                <td class="right"><?php echo $item->total->value; ?></td>
                <td>-</td>
            </tr>
            <?php endforeach; ?>
            <tr class="bold">
                <td colspan="5">Nilai</td>
                <td class="right"><?php echo $barang->total->value; ?></td>
                <td></td>
            </tr>
            <tr class="bold">
                <td colspan="5">TOTAL</td>
                <td class="right"><?php echo $barang->total->value; ?></td>
                <td></td>
            </tr>
            <tr class="bold">
                <td class="left" colspan="7">Terbilang: <?php echo $barang->total->text; ?> rupiah</td>
            </tr>
        </table>

        <table class="default-table-1 line-12-8">
            <tr>
                <td style="width: 50%;">Diserahkan oleh</td>
                <td style="width: 50%;" rowspan="2">Pejabat Pembuat Komitmen (PPK) Barang/Jasa pada Fakultas Pariwisata</td>
            </tr>
            <tr>
                <td><?php echo $penyedia->nama; ?></td>
            </tr>
            <tr>
                <td style="height: 18mm;" colspan="2"></td>
            </tr>
            <tr>
                <td><?php echo $penyedia->pemilik; ?></td>
                <td>I Nyoman Sudiarta</td>
            </tr>
            <tr>
                <td><?php echo $penyedia->jabatan; ?></td>
                <td>NIP. 196503152005011001</td>
            </tr>
        </table>
    </div>
    <!-- Content END -->
</body>
</html>
