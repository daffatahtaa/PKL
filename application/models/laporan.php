<?php

Class laporan extends CI_Model {

    public function sp_absensi_detail($data){
        if ($this->session->userdata['logged_in']['role'] === 'Admin') {
            $data['role']=1;
        }elseif ($this->session->userdata['logged_in']['role'] === 'Div') {
            $data['role']=2;
        }
        $data['orgeh']=$this->session->userdata['logged_in']['uker'];
        $query = $this->db->query("EXEC SP_REPORT_ABSENSI_DETAIL2
        ".$data['role'].",".$data['typePosisi'].",'".$data['kode']."'
        ,'".$data['orgeh']."','".$data['orgeh']."','".$data['posisi']."'");
        return $query->result();
    }

    public function sp_bi($data){
        if ($this->session->userdata['logged_in']['role'] === 'admin') {
            $data['role']=1;
        }elseif ($this->session->userdata['logged_in']['role'] === 'div') {
            $data['role']=2;
        }
        $a = $this->session->userdata;
        //var_dump($a['logged_in']);
        //var_dump($data['typePosisi']);
		//var_dump($data['role']);
        //die();
        $data['orgeh']=$this->session->userdata['logged_in']['uker'];
        $query = $this->db->query("EXEC SP_REPORT_BI
        ".$data['role'].",".$data['typePosisi'].",'".$data['kode']."'
        ,'".$data['orgeh']."','".$data['orgeh']."','".$data['posisi']."'
        ,'".$data['pernr']."','".$data['ket']."'");

        //var_dump($query);
        //var_dump($data['orgeh']);
        //var_dump($err = $this->db->error());
        //die();

        return $query->result_array();

        echo "<script> console.log($query->resutl_array()).output );</script>";
        //var_dump($data['role']);
		//var_dump($query->result_array());
		//die();
    }

    public function sp_report_ketidakhadiran($data){
        if ($this->session->userdata['logged_in']['role'] === 'Admin') {
            $data['role']='1';
        }elseif ($this->session->userdata['logged_in']['role'] === 'Div') {
            $data['role']='2';
        }
        $data['orgeh']=$this->session->userdata['logged_in']['uker'];
        $query = $this->db->query("EXEC SP_REPORT_KETIDAKHADIRAN
        '".$data['role']."',".$data['orgeh'].",'".$data['jenis']."'
        ,'".$data['awal']."','".$data['akhir']."'");
        return $query->result();
    }

    public function sp_absensi_lembur($data){
        $query = $this->db->query("select * from dummy_lembur where
            tanggal like '%".$data['bulan']."%'");
        return $query->result();
    }

    public function sp_absensi_dimaintain($data){
        if ($data['jenis'] == 'ALL') {
            if ($data['tanggal'] == 'ALL') {
                $query = $this->db->query("select * from dummy_dimaintain where
                    tanggal like '%".$data['bulan']."%'");
            }else{
                $query = $this->db->query("select * from dummy_dimaintain where
                    tanggal like '%".$data['bulan'].'-'.$data['tanggal']."%'");
            }
        }else{
            if ($data['tanggal'] == 'ALL') {
                $query = $this->db->query("select * from dummy_dimaintain where
                    tanggal like '%".$data['bulan']."%' and keterangan = '".$data['jenis']."'");
            }else{
                $query = $this->db->query("select * from dummy_dimaintain where
                    tanggal like '%".$data['bulan'].'-'.$data['tanggal']."%' and
                    keterangan = '".$data['jenis']."'");
            }
        }
        return $query->result();
    }
}

?>
