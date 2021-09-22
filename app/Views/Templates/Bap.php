    <!-- Content -->
    <div class="regular size105">
        <!-- Nomor Surat -->
        <div style="text-align: center;">
            <p class="bold">BERITA ACARA PEMERIKSAAN BARANG/PEKERJAAN</p>
            <p>Nomor : <?php echo $data->suratBAP->nomor ;?></p>
        </div>
        <!-- Nomor Surat END -->

        <div style="text-align: justify;">
            
            <p class="line-12-8">Pada hari ini, <?php echo $data->suratBAP->getDayName() ;?> tanggal <?php echo $data->suratBAP->getDayString() ;?> bulan <?php echo $data->suratBAP->getMonthName() ;?> tahun <?php echo $data->suratBAP->getYearString() ;?>, telah mengadakan pemeriksaan dan meneliti barang/pekerjaan hasil pengadaan :</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 40mm;">Pekerjaan</td>
                    <td style="width: 4mm;">:</td>
                    <td><?php echo $data->namaPaket ;?></td>
                </tr>
                    <tr>
                    <td>Surat Pesanan (SP)</td>
                    <td>:</td>
                    <td>Nomor : <?php echo $data->suratSP->nomor ;?>, tanggal <?php echo $data->suratSP->getDateString() ;?></td>
                </tr>
                <tr>
                    <td>Nilai Pesanan</td>
                    <td>:</td>
                    <td>Rp <?php echo $data->getNilaiKwitansi(); ?> (<span class="italic"><?php echo $data->getNilaiKwitansiString(); ?> rupiah</span>)</td>
                </tr>
                <tr>
                    <td>Pelaksana Pekerjaan</td>
                    <td>:</td>
                    <td><?php echo $data->namaPenyedia;?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $data->alamatPenyedia;?></td>
                </tr>
            </table>

            <p class="line-12-0">Dengan hasil pemeriksaan pekerjaan sebagai berikut :</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 14mm;">1.</td>
                    <td><p>Barang/pekerjaan hasil <?php echo $data->namaPaket;?> yang diperiksa dalam keadaan baik dan lengkap sesuai dengan pesanan yang tercantum pada Surat Pesanan (SP) serta secara fisik prestasi pekerjaan telah mencapai 100 % (seratus persen).</p></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><p>Barang/pekerjaan hasil pengadaan, siap untuk dipergunakan dan difungsikan sebagaimana mestinya.</p></td>
                </tr>
            </table>

            <p class="line-12-0">Berdasarkan Surat Pesanan (SP) Nomor : <?php echo $data->suratSP->nomor;?>, tanggal <?php echo $data->suratSP->getDateString();?>, maka barang/pekerjaan hasil pengadaan tersebut diatas dapat diterima dengan baik dan kepada rekanan pelaksana pekerjaan dapat dibayarkan sejumlah nilai kontrak sesuai prestasi fisik pekerjaan yaitu 100% x Rp <?php echo $data->getNilaiKwitansi(); ?> = Rp <?php echo $data->getNilaiKwitansi(); ?> (<span class="italic"><?php echo $data->getNilaiKwitansiString(); ?></span>).</p>

            <p class="line-12-8">Demikian Berita Acara Pemeriksaan Barang/Pekerjaan ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 50%;">Diserahkan oleh</td>
                    <td style="width: 50%;" rowspan="2">Pejabat Pembuat Komitmen (PPK) Barang/Jasa pada Fakultas Pariwisata</td>
                </tr>
                <tr>
                    <td><?php echo $data->namaPenyedia; ?></td>
                </tr>
                <tr>
                    <td style="height: 18mm;" colspan="2"></td>
                </tr>
                <tr>
                    <td><?php echo $data->namaPemilik; ?></td>
                    <td>I Nyoman Sudiarta</td>
                </tr>
                <tr>
                    <td><?php echo $data->jabatanPemilik; ?></td>
                    <td>NIP. 196503152005011001</td>
                </tr>
            </table>
        </div>

    </div>
    <!-- Content END -->
</body>
</html>