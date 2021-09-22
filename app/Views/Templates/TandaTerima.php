    <!-- Content -->
    <div class="regular size9">
        <table class="line-12-0 default-table-1">
            <tr>
                <td style="width: 25mm;">Pekerjaan</td>
                <td style="width: 5mm;">:</td>
                <td><?php echo $data->namaPaket; ?></td>
            </tr>
            <tr>
                <td>Unit</td>
                <td>:</td>
                <td><?php echo $data->prodi; ?></td>
            </tr>
            <tr>
                <td colspan="3">Telah diterima barang/jasa sebagai berikut:</td>
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
            <?php $nomor = 1; ?>
            <?php foreach ($data->barang->getItems() as $barang): ?>
            <tr>
                <td><?php echo $nomor; ?></td>
                <td class="left"><?php echo $barang->nama; ?> (<span class="italic"><?php echo $barang->spesifikasi; ?></span>)</td>
                <td><?php echo $barang->satuan; ?></td>
                <td class="right"><?php echo $barang->harga; ?></td>
                <td><?php echo $barang->jumlah; ?></td>
                <td class="right"><?php echo $barang->getHargaTotal(); ?></td>
                <td>-</td>
            </tr>
            <?php $nomor++; ?>
            <?php endforeach; ?>
            <tr class="bold">
                <td colspan="5">Nilai</td>
                <td class="right"><?php echo $data->barang->getNilaiTotal(); ?></td>
                <td></td>
            </tr>
            <tr class="bold">
                <td colspan="5">TOTAL</td>
                <td class="right"><?php echo $data->barang->getNilaiTotal(); ?></td>
                <td></td>
            </tr>
            <tr class="bold">
                <td class="left" colspan="7">Terbilang: <?php echo $data->barang->getNilaiTotalString(); ?> rupiah</td>
            </tr>
        </table>

        <table class="default-table-1 line-12-8">
            <tr>
                <td style="width: 50%;">
                    <p>Diterima oleh,</p>
                    <p>Unit Kerja Pemakai Barang/Jasa</p>
                    <p><?php echo $data->prodi; ?></p>
                </td>
                <td style="width: 50%;">
                    <p>Denpasar, <?php echo $data->suratTT->getDateString(); ?></p>
                    <p>Yang menyerahkan,</p>
                    <p>Pejabat Pembuat Komitmen (PPK) Barang/Jasa pada Fakultas Pariwisata</p>
                </td>
            </tr>
            <tr>
                <td style="height: 18mm;" colspan="2"></td>
            </tr>
            <tr>
                <td><?php echo $data->kepalaUnit; ?></td>
                <td>I Nyoman Sudiarta</td>
            </tr>
            <tr>
                <td>NIP. <?php echo $data->nipKepalaUnit; ?></td>
                <td>NIP. 196503152005011001</td>
            </tr>
        </table>

        <table class="default-table-1 line-12-8">
            <tr>
                <td style="height: 12mm;" colspan="2"></td>
            </tr>    
            <tr>
                <td>Mengetahui,</td>
            </tr>
            <tr>
                <td>KAPRODI</td>
            </tr>
            <tr>
                <td style="height: 18mm;" colspan="2"></td>
            </tr>
            <tr>
                <td><?php echo $data->kaprodi; ?></td>
            </tr>
            <tr>
                <td>NIP. <?php echo $data->nipKaprodi; ?></td>
            </tr>
        </table>
    </div>
    <!-- Content END -->
</body>
</html>