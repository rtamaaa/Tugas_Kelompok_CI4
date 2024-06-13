<?php
$ip = $this->input->ip_address(); // Mendapatkan IP user
$date = date("Y-m-d"); // Mendapatkan tanggal sekarang
$waktu = time(); //
$timeinsert = date("Y-m-d H:i:s");

//cek berdasarkan ip, 
$s = $this->db->query("SELECT * FROM visitor WHERE ip='".$ip."' AND date='".$date."'")->num_rows();
$ss = isset($s)?($s):0;
// Kalau belum ada, simpan data user tersebut ke database
if($ss == 0){
    $this->db->query("INSERT INTO visitor(ip, date, hits, online, time)  VALUES ('".$ip."','".$date."','1','".$waktu."','".$timeinsert."')");
}
else{
    $this->db->query("UPDATE visitor SET hits=hits+1, online='".$waktu."' WEHERE ip ='".$ip."' AND date ='".$date."'");
}
$pengunjunghariini = $this->db->query("SELECT * FROM visitor where date='".$date."'GROUP BY ip")->num_rows();
    $dbpengunjung = $this->db->query("SELECT COUNT(hits) as hits FROM visitor")->row();
    $totalpengunjung = isset($dbpengunjung->hits)?($dbpengunjung->hits):0;
    $bataswaktu = time() - 300;
    $pengunjungonline = $this->db->query("SELECT * FROM visitor WHERE online > '".$bataswaktu."'")->num_rows;