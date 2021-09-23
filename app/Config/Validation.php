<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    // Penyedia
    public $penyedia = [
		'nama' => 'required',
		'alamat' => 'required',
        'pemilik' => 'required',
        'jabatan' => 'required|max_length[256]',
	];

	public $penyedia_errors = [
		'nama' => [
			'required' => 'Nama tidak boleh kosong.',
		],
        'alamat' => [
			'required' => 'Alamat tidak boleh kosong.',
		],
        'pemilik' => [
			'required' => 'Pemilik tidak boleh kosong.',
		],
        'jabatan' => [
			'required' => 'Jabatan tidak boleh kosong.',
			'max_length' => 'Jabatan tidak boleh lebih dari 256 karakter.'
		],
	];

    // Pegawai
    public $pegawai = [
		'nama' => 'required',
		'nip' => 'required',
        'jabatan' => 'required|max_length[256]',
	];

	public $pegawai_errors = [
		'nama' => [
			'required' => 'Nama tidak boleh kosong.',
		],
        'nip' => [
			'required' => 'NIP tidak boleh kosong.',
		],
        'jabatan' => [
			'required' => 'Jabatan tidak boleh kosong.',
			'max_length' => 'Jabatan tidak boleh lebih dari 256 karakter.'
		],
	];

    // Kegiatan
    public $kegiatan = [
        "bulan" => 'required',
        "kegiatan" => 'required',
        "paket" => 'required',
        "prodi" => 'required',
        "nilai_kwitansi" => 'required',
        "penyedia" => 'required',
        "unit" => 'required',
        "kaprodi" => 'required',
        "sp_nomor" => 'required',
        "sp_tanggal" => 'required|valid_date[d/m/Y]',
        "bap_nomor" => 'required',
        "bap_tanggal" => 'required|valid_date[d/m/Y]',
        "bast_nomor" => 'required',
        "bast_tanggal" => 'required|valid_date[d/m/Y]',
        "tt_tanggal" => 'required|valid_date[d/m/Y]',
    ];

    public $kegiatan_errors = [
        "bulan" => [
            'required' => "Bulan tidak boleh kosong."
        ],
        "kegiatan" => [
            'required' => "Kegiatan tidak boleh kosong."
        ],
        "paket" => [
            'required' => "Paket tidak boleh kosong."
        ],
        "prodi" => [
            'required' => "Prodi tidak boleh kosong."
        ],
        "nilai_kwitansi" => [
            'required' => "Nilai Kwitansi tidak boleh kosong."
        ],
        "penyedia" => [
            'required' => "Penyedia tidak boleh kosong."
        ],
        "unit" => [
            'required' => "Unit tidak boleh kosong."
        ],
        "kaprodi" => [
            'required' => "Kaprodi tidak boleh kosong."
        ],
        "sp_nomor" => [
            'required' => "Nomor SP tidak boleh kosong."
        ],
        "sp_tanggal" => [
            'required' => "Tanggal SP tidak boleh kosong.",
            'valid_date' => "Format Tanggal SP tidak sesuai."
        ],
        "bap_nomor" => [
            'required' => "Nomor BAP tidak boleh kosong."
        ],
        "bap_tanggal" => [
            'required' => "Tanggal BAP tidak boleh kosong.",
            'valid_date' => "Format Tanggal BAP tidak sesuai."
        ],
        "bast_nomor" => [
            'required' => "Nomor BAST Kwitansi tidak boleh kosong."
        ],
        "bast_tanggal" => [
            'required' => "Tanggal BAST tidak boleh kosong.",
            'valid_date' => "Format Tanggal BAST tidak sesuai."
        ],
        "tt_tanggal" => [
            'required' => "Tanggal TT tidak boleh kosong.",
            'valid_date' => "Format Tanggal TT tidak sesuai."
        ],
    ];

    // Barang
    public $barang = [
        "nama" => 'required',
        "spesifikasi" => 'required',
        "kategori" => 'required',
        "jumlah" => 'required|is_natural_no_zero',
        "satuan" => 'required',
        "harga" => 'required|is_natural_no_zero',
    ];

    public $barang_errors = [
        "nama" => [
            'required' => "Nama Barang tidak boleh kosong."
        ],
        "spesifikasi" => [
            'required' => "Spesifikasi tidak boleh kosong."
        ],
        "kategori" => [
            'required' => "Kategori tidak boleh kosong."
        ],
        "jumlah" => [
            'required' => "Jumlah Barang tidak boleh kosong.",
            'is_natural_no_zero' => "Jumlah Barang harus lebih dari nol.",
        ],
        "satuan" => [
            'required' => "Satuan tidak boleh kosong."
        ],
        "harga" => [
            'required' => "Harga tidak boleh kosong.",
            'is_natural_no_zero' => "Harga harus lebih dari nol.",
        ],
    ];
}
