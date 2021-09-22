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
}
