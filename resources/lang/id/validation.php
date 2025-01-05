<?php

return [
    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'max' => [
        'string' => ':attribute tidak boleh lebih dari :max karakter.',
        'file' => ':attribute tidak boleh lebih dari :max kilobyte.',
    ],
    'min' => [
        'string' => ':attribute harus minimal :min karakter.',
    ],
    'confirmed' => 'Konfirmasi :attribute tidak sesuai.',
    'unique' => ':attribute sudah digunakan.',
    'image' => ':attribute harus berupa gambar.',
    'mimes' => ':attribute harus berupa file dengan format: :values.',
    'in' => ':attribute tidak valid.',

    'attributes' => [
        'name' => 'Nama',
        'nip' => 'NIP/NIK',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
        'photo' => 'Foto',
        'group_id' => 'Grup',
    ],
];
