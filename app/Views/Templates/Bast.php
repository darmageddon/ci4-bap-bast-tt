    <!-- Content -->
    <div class="regular size9">
        <!-- Nomor Surat -->
        <div style="text-align: center;">
            <p class="bold">BERITA ACARA SERAH TERIMA BARANG/PEKERJAAN</p>
            <p><?php echo $data->suratBAST->nomor ;?></p>
        </div>
        <!-- Nomor Surat END -->

        <div style="text-align: justify;">
            
            <p class="line-12-8">Pada hari ini, <?php echo $data->suratBAST->getDayName(); ?> tanggal <?php echo $data->suratBAST->getDayString(); ?> bulan <?php echo $data->suratBAST->getMonthName(); ?> tahun <?php echo $data->suratBAST->getYearString(); ?>, bertempat di DENPASAR, kami yang bertanda tangan dibawah ini :</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 22mm;">Nama</td>
                    <td style="width: 5mm;">:</td>
                    <td>I Nyoman Sudiarta</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>Pejabat Pembuat Komitmen (PPK) Barang/Jasa pada Fakultas Pariwisata</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Fakultas Pariwisata</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Yang selanjutnya disebut <span class="bold">PPK</span></td>
                </tr>
                <tr>
                    <td style="height: 2mm;" colspan="3"></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?php echo $data->namaPemilik; ?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?php echo $data->jabatanPemilik; ?> <?php echo $data->namaPenyedia;?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $data->alamatPenyedia;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Yang selanjutnya disebut <span class="bold">Penyedia</span></td>
                </tr>
            </table>

            <p class="line-12-8">Berdasarkan Berita Acara Pemeriksaan Barang/Pekerjaan Nomor : $<?php echo $data->suratBAP->nomor ;?> tanggal <?php echo $data->suratBAP->getDateString() ;?> dengan ini menyatakan mengadakan serah terima barang/pekerjaan dengan ketentuan sebagai berikut :</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 5mm;">1.</td>
                    <td colspan="3"><span class="bold">Penyedia</span> telah menyerahkan kepada <span class="bold">PPK</span> :</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 38mm;">Pekerjaan</td>
                    <td style="width: 5mm;">:</td>
                    <td><?php echo $data->namaPaket;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Surat Pesanan (SP)</td>
                    <td>:</td>
                    <td>Nomor : <?php echo $data->suratSP->nomor ;?>, tanggal <?php echo $data->suratSP->getDateString() ;?></td>
                </tr>
                <tr>
                <td></td>
                    <td>Nilai Pesanan</td>
                    <td>:</td>
                    <td>Rp <?php echo $data->getNilaiKwitansi(); ?> (<span class="italic"><?php echo $data->getNilaiKwitansiString(); ?> rupiah</span>)</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Dilaksanakan oleh</td>
                    <td>:</td>
                    <td><?php echo $data->namaPenyedia;?></td>
                </tr>
                <tr>
                <td></td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td><?php echo $data->alamatPenyedia;?></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td colspan="3"><p><span class="bold">PPK</span> telah menerima barang/pekerjaan yang telah diselesaikan dengan baik dan lengkap oleh <span class="bold">Penyedia</span> sesuai dengan Surat Pesanan (SP).</p></td>
                </tr>
            </table>

            <p class="line-12-8">Demikian Berita Acara Serah Terima Barang/Pekerjaan ini dibuat dengan sesungguhnya untuk dapat dipergunakan sebagaimana mestinya.</p>

            <table class="default-table-1">
                <tr>
                    <td style="width: 50%;">Untuk dan atas nama Fakultas Pariwisata Universitas Udayana</td>
                    <td style="width: 10mm;"></td>
                    <td style="width: 45%;" rowspan="2">
                        <p>Untuk dan atas nama Penyedia</p>
                        <p><?php echo $data->namaPenyedia;?></p>
                    </td>
                </tr>
                <tr>
                    <td>Pejabat Pembuat Komitmen (PPK) Barang/Jasa pada Fakultas Pariwisata</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="height: 15mm;" colspan="3"></td>
                </tr>
                <tr>
                    <td>I Nyoman Sudiarta</td>
                    <td></td>
                    <td><?php echo $data->namaPemilik;?></td>
                </tr>
                <tr>
                    <td>NIP. 196503152005011001</td>
                    <td></td>
                    <td><?php echo $data->jabatanPemilik;?></td>
                </tr>
            </table>
        </div>

    </div>
    <!-- Content END -->
</body>
</html>