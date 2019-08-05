<?php

/**
 * demo.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

return [
    'no_demo_text'           => 'Maaf, tidak ada teks penjelasan-penjelasan tambahan <abbr title=":route">laman halaman</abbr> ini.',
    'see_help_icon'          => 'Namun, ikon <i class="fa fa-question-circle"></i> di pojok kanan atas mungkin memberi tahu Anda lebih banyak.',
    'index'                  => 'Selamat Datang di <strong>'.config('app.name').'</strong>! Di halaman ini Anda mendapatkan gambaran singkat tentang keuangan Anda. Untuk informasi lebih lanjut, lihat Akun &rarr; <a href=":asset">Setelan Akun</a> dan tentu saja halaman <a href=":budgets">Budgets123_4_6_32_23_32_19_7_321Reports</a>. Atau hanya melihat-lihat dan melihat di mana Anda berakhir.',
    'accounts-index'         => 'Akun aset adalah rekening bank pribadi Anda. Akun pengeluaran adalah akun yang dibelanjakan, seperti di toko dan pada teman. Akun pendapatan adalah rekening yang Anda terima dari, seperti gaji atau penghasilan lainnya. Kewajiban adalah untuk hutang dan pinjaman, seperti hutang kartu kredit, pinjaman bank, leasing, atau pinjaman lainnya. Pada halaman ini Anda dapat mengedit atau menghapusnya.',
    'budgets-index'          => 'Halaman ini menunjukkan ikhtisar anggaran Anda. Bagian atas menunjukkan jumlah yang tersedia untuk dianggarkan. Ini dapat disesuaikan untuk segala periode dengan mengklik jumlah di sebelah kanan. Jumlah yang sebenarnya Anda habiskan ditunjukkan di bilah di bawah ini. Di bawah ini adalah biaya per anggaran dan apa yang telah Anda anggarkan untuk mereka.',
    'reports-index-start'    => config('app.name').' mendukung sejumlah jenis laporan. Baca tentang mereka dengan mengklik <i class="fa fa-question-circle"></i>-icon di pojok kanan atas.',
    'reports-index-examples' => 'Pastikan untuk memeriksa contoh-contoh ini: <a href=":one">gambaran keuangan bulanan</a>, <a href=":two">ikhtisar keuangan tahunan</a> dan <a href=":three">gambaran umum anggaran</a>.',
    'currencies-index'       => config('app.name').' mendukung banyak mata uang. Meski default ke Euro itu bisa diatur ke US Dollar dan banyak mata uang lainnya. Seperti yang bisa Anda lihat, sejumlah kecil mata uang telah disertakan namun Anda dapat menambahkannya sendiri jika menginginkannya. Mengubah mata uang default tidak akan mengubah mata uang dari transaksi yang ada namun: '.config('app.name').' mendukung penggunaan beberapa mata uang pada saat bersamaan.',
    'transactions-index'     => 'Biaya ini, deposito dan transfer tidak terlalu imajinatif. Mereka telah dihasilkan secara otomatis.',
    'piggy-banks-index'      => 'Seperti yang bisa Anda lihat, ada tiga celengan. Gunakan tombol plus dan minus untuk mempengaruhi jumlah uang di setiap celengan. Klik nama celengan untuk melihat administrasi masing-masing celengan.',
    'import-index'           => 'Semua file CSV dapat diimpor ke '.config('app.name').'. Data dari bunq dan Spectre pun bisa diimpor kesini. Sedangkan data dari provider keuangan dan bank akan di implementasikan di waktu mendatang. Sebagai demo-user tentu saja Anda dapat melihat contoh datanya. Beberapa transaksi demo akan dibuat secara otomatis untuk menunjukkan bagaimana alur proses kerjanya.',
    'profile-index'          => 'Keep in mind that the demo site resets every four hours. Your access may be revoked at any time. This happens automatically and is not a bug.',
];
