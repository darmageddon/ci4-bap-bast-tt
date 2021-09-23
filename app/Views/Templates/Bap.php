    <!-- Content -->
    <div class="regular size105">
        <!-- Nomor Surat -->
        <div style="text-align: center;">
            <p class="bold">BERITA ACARA PEMERIKSAAN BARANG/PEKERJAAN</p>
            <p>Nomor : <?php echo $bap->nomor ;?></p>
        </div>
        <!-- Nomor Surat END -->

        <div style="text-align: justify;">
            
            <p class="line-12-8">Pada hari ini, <?php echo $bap->tanggal->getDay() ;?> tanggal <?php echo $bap->tanggal->getDayString() ;?> bulan <?php echo $bap->tanggal->getMonthString() ;?> tahun <?php echo $bap->tanggal->getYearString() ;?>, telah mengadakan pemeriksaan dan meneliti barang/pekerjaan hasil pengadaan :</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 40mm;">Pekerjaan</td>
                    <td style="width: 4mm;">:</td>
                    <td><?php echo $paket ;?></td>
                </tr>
                    <tr>
                    <td>Surat Pesanan (SP)</td>
                    <td>:</td>
                    <td>Nomor : <?php echo $sp->nomor ;?>, tanggal <?php echo $sp->tanggal->getDate() ;?></td>
                </tr>
                <tr>
                    <td>Nilai Pesanan</td>
                    <td>:</td>
                    <td>Rp <?php echo $kwitansi->number; ?> (<span class="italic"><?php echo $kwitansi->text; ?> Rupiah</span>)</td>
                </tr>
                <tr>
                    <td>Pelaksana Pekerjaan</td>
                    <td>:</td>
                    <td><?php echo $penyedia->nama;?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $penyedia->alamat;?></td>
                </tr>
            </table>

            <p class="line-12-0">Dengan hasil pemeriksaan pekerjaan sebagai berikut :</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 14mm;">1.</td>
                    <td><p>Barang/pekerjaan hasil <?php echo $paket; ?> yang diperiksa dalam keadaan baik dan lengkap sesuai dengan pesanan yang tercantum pada Surat Pesanan (SP) serta secara fisik prestasi pekerjaan telah mencapai 100 % (seratus persen).</p></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><p>Barang/pekerjaan hasil pengadaan, siap untuk dipergunakan dan difungsikan sebagaimana mestinya.</p></td>
                </tr>
            </table>

            <p class="line-12-0">Berdasarkan Surat Pesanan (SP) Nomor : <?php echo $sp->nomor; ?>, tanggal <?php echo $sp->tanggal->getDate(); ?>, maka barang/pekerjaan hasil pengadaan tersebut diatas dapat diterima dengan baik dan kepada rekanan pelaksana pekerjaan dapat dibayarkan sejumlah nilai kontrak sesuai prestasi fisik pekerjaan yaitu 100% x Rp <?php echo $kwitansi->number; ?> = Rp <?php echo $kwitansi->number; ?> (<span class="italic"><?php echo $kwitansi->text; ?></span>).</p>

            <p class="line-12-8">Demikian Berita Acara Pemeriksaan Barang/Pekerjaan ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.</p>

            <table class="default-table-1">
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

    </div>
    <!-- Content END -->
</body>
</html>
