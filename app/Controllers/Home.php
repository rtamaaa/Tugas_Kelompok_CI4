<?php

namespace App\Controllers;
use App\Models\VisitorModel;


class Home extends BaseController
{

    public function index(): string
    {
        $visitorModel = new VisitorModel();

        // Get user IP and current date/time
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");

        // Check if the user has visited today
        $s = $visitorModel->where(['ip' => $ip, 'date' => $date])->countAllResults();

        // If not, insert a new record
        if ($s == 0) {
            $visitorModel->insert([
                'ip' => $ip,
                'date' => $date,
                'hits' => 1,
                'online' => $waktu,
                'time' => $timeinsert,
            ]);
        } else {
            // Otherwise, update the existing record
            $visitorModel->set('hits', 'hits+1', false)
                         ->set('online', $waktu)
                         ->where(['ip' => $ip, 'date' => $date])
                         ->update();
        }

        // Get today's visitors
        $pengunjunghariini = $visitorModel->where(['date' => $date])->groupBy('ip')->countAllResults();

        // Get total hits
        $dbpengunjung = $visitorModel->selectSum('hits')->first();
        $totalpengunjung = isset($dbpengunjung['hits']) ? $dbpengunjung['hits'] : 0;

        // Get online visitors
        $bataswaktu = time() - 300; // 5 minutes ago
        $pengunjungonline = $visitorModel->where('online >', $bataswaktu)->countAllResults();

        // Pass data to the view
        return view('test', [
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
        ]);
    }
}
