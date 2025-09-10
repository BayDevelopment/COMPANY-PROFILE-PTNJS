<?php

if (!function_exists('formatTanggalIndonesia')) {
    function formatTanggalIndonesia($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $pecah = explode('-', $tanggal);
        if (count($pecah) !== 3) return $tanggal;

        $tahun = $pecah[0];
        $bulanIndex = (int)$pecah[1];
        $hari = (int)$pecah[2];

        $namaBulan = $bulan[$bulanIndex] ?? 'Tidak diketahui';

        return "$hari $namaBulan $tahun";
    }
}



if (!function_exists('formatTanggalLengkapIndonesia')) {
    function formatTanggalLengkapIndonesia($tanggal)
    {
        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $timestamp = strtotime($tanggal);
        if (!$timestamp) return $tanggal; // Validasi input

        $hariText = $hari[date('l', $timestamp)] ?? 'Tidak diketahui';
        $tgl = date('d', $timestamp);
        $bulanText = $bulan[(int)date('m', $timestamp)] ?? 'Tidak diketahui';
        $tahun = date('Y', $timestamp);

        return "$hariText, $tgl $bulanText $tahun";
    }
}
