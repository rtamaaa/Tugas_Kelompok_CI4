<?php

namespace App\Controllers;

use App\Models\ContentModel;  //visitor dalam content masih dalam tahap pengembangan
use App\Models\VisitorModel;
use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $model = new ContentModel();
        $allContents = $model->findAll();
        $contents = array_slice($allContents, 0, 3);
        $berita = array_slice($allContents, 0, 4);

        $data['contents'] = $contents;
        $data['berita'] = $berita;

        $descriptions = array_column($data['contents'], 'deskripsi');
        $data['descriptions'] = array_slice($descriptions, 0, 3);

        // Get visitor data without content ID (general data)
        $visitorDataGeneral = $this->getVisitorData();
        $data = array_merge($data, $visitorDataGeneral);

        // if (!empty($contents)) {
        //     $contentId = $contents[0]['id'];
        //     $visitorDataById = $this->getVisitorDataCD($contentId);
        //     $data = array_merge($data, $visitorDataById);
        // }

        echo view('portal/topbar');
        echo view('portal/navbar');
        echo view('portal/slider', $data);
        echo view('portal/news', $data);
        echo view('portal/content', $data);
        return view('portal/footer');
    }

    // Get visitor data by content ID
    public function getVisitorData($contentId = null): array
    {
        $visitorModel = new VisitorModel();

        // Get user IP and current date/time
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");

        // Initialize variables
        $pengunjunghariini = 0;
        $totalpengunjung = 0;
        $pengunjungonline = 0;

        if ($contentId !== null) {
            // Check if the user has visited this content today
            $s = $visitorModel->where(['ip' => $ip, 'date' => $date, 'content_id' => $contentId])->countAllResults();

            // If not, insert a new record
            if ($s == 0) {
                $visitorModel->insert([
                    'ip' => $ip,
                    'date' => $date,
                    'hits' => 1,
                    'online' => $waktu,
                    'time' => $timeinsert,
                    'content_id' => $contentId,
                ]);
            } else {
                // Otherwise, update the existing record
                $visitorModel->set('hits', 'hits+1', false)
                             ->set('online', $waktu)
                             ->where(['ip' => $ip, 'date' => $date, 'content_id' => $contentId])
                             ->update();
            }

            // Get today's visitors for this content
            $pengunjunghariini = $visitorModel->where(['date' => $date, 'content_id' => $contentId])->groupBy('ip')->countAllResults();

            // Get total hits for this content
            $dbpengunjung = $visitorModel->selectSum('hits')->where('content_id', $contentId)->first();
            $totalpengunjung = isset($dbpengunjung['hits']) ? $dbpengunjung['hits'] : 0;

            // Get online visitors for this content
            $bataswaktu = time() - 300; // 5 minutes ago
            $pengunjungonline = $visitorModel->where('online >', $bataswaktu)->where('content_id', $contentId)->countAllResults();
        } else {
            // Get general visitor data
            // Count visitors for today
            $pengunjunghariini = $visitorModel->where(['date' => $date])->groupBy('ip')->countAllResults();

            // Get total hits
            $dbpengunjung = $visitorModel->selectSum('hits')->first();
            $totalpengunjung = isset($dbpengunjung['hits']) ? $dbpengunjung['hits'] : 0;

            // Get online visitors
            $bataswaktu = time() - 300; // 5 minutes ago
            $pengunjungonline = $visitorModel->where('online >', $bataswaktu)->countAllResults();
        }

        return [
            'pengunjunghariini' => $pengunjunghariini,
            'totalpengunjung' => $totalpengunjung,
            'pengunjungonline' => $pengunjungonline,
        ];
    }

    // Get total visitors for a specific content ID
    public function getVisitorDataCD($contentId): array
    {
        $visitorModel = new VisitorModel();

        // Get user IP and current date/time
        $ip = $this->request->getIPAddress();
        $date = date("Y-m-d");
        $waktu = time();
        $timeinsert = date("Y-m-d H:i:s");

        // Check if the user has visited this content today
        $s = $visitorModel->where(['ip' => $ip, 'date' => $date, 'content_id' => $contentId])->countAllResults();

        // If not, insert a new record
        if ($s == 0) {
            $visitorModel->insert([
                'ip' => $ip,
                'date' => $date,
                'hits' => 1,
                'online' => $waktu,
                'time' => $timeinsert,
                'content_id' => $contentId,
            ]);
        } else {
            // Otherwise, update the existing record
            $visitorModel->set('hits', 'hits+1', false)
                         ->set('online', $waktu)
                         ->where(['ip' => $ip, 'date' => $date, 'content_id' => $contentId])
                         ->update();
        }

        // Get total hits for this content
        $dbpengunjung = $visitorModel->selectSum('hits')->where('content_id', $contentId)->first();
        $totalpengunjungid = isset($dbpengunjung['hits']) ? $dbpengunjung['hits'] : 0;

        return [
            'totalpengunjungid' => $totalpengunjungid,
        ];
    }


    public function show(int $id): string
    {
        $model = new ContentModel();
        $contents = $model->find($id);

        if (!$contents) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Content not found");
        }

        $data['contents'] = $contents;
        $visitorData = $this->getVisitorData($id);
        $data = array_merge($data, $visitorData);

        echo view('portal/topbar');
        echo view('portal/navbar');
        return view('portal/singleview', $data);
    }
}