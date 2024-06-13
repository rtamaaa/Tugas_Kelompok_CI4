<?php

if (!function_exists('indo_date')) {
    /**
     * Format date to Indonesian day and date format.
     *
     * @param string $date Date string in 'Y-m-d' format.
     * @return string Formatted date string.
     */
    function format_indo_date($date)
    {
        $days = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];

        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $timestamp = strtotime($date);
        $dayName = date('l', $timestamp);
        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('Y', $timestamp);

        $formattedDate = $days[$dayName] . ', ' . $day . ' ' . $months[$month] . ' ' . $year;

        return $formattedDate;
    }
}
