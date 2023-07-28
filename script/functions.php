<?php
    function tanggal_indonesia($tanggal) {
        $nama_hari = date('l', strtotime($tanggal));
        $nama_bulan = date('F', strtotime($tanggal));
        $tahun = date('Y', strtotime($tanggal));
    
        $daftar_hari = array(
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        );
    
        $daftar_bulan = array(
            'January'   => 'Januari',
            'February'  => 'Februari',
            'March'     => 'Maret',
            'April'     => 'April',
            'May'       => 'Mei',
            'June'      => 'Juni',
            'July'      => 'Juli',
            'August'    => 'Agustus',
            'September' => 'September',
            'October'   => 'Oktober',
            'November'  => 'November',
            'December'  => 'Desember'
        );
    
        return $daftar_hari[$nama_hari] . ', ' . date('d', strtotime($tanggal)) . ' ' . $daftar_bulan[$nama_bulan] . ' ' . $tahun;
    }
?>