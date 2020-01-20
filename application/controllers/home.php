<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();

        $this->load->model('menu');
		$this->load->database();
	   $this->load->model('tuser');
	   $this->load->model('laporan');
		
	}
	public function index()
	{
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$data['title']="Portal Absen BRI";
		$this->form_validation->set_rules('bulan', 'Bulan Awal', 'required');
        $this->form_validation->set_rules('tahun', 'Bulan Akhir', 'required');
		if ($this->form_validation->run() == FALSE) {
			$jenis = 'NAMA';
			$typePosisi = 1;
			$posisi = date('Y-m');
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;
			$data['pernr']='default';
			$data['ket']='default';
			$data['postData'] = $data;

			$result['data']=$this->laporan->sp_bi($data);
			//$query1 = $this->db->query("Select * from ABSENSI  WHERE KERJA_MASUK > '07.30.00'")->result();
			//$query = $this->db->query("SELECT Count(KERJA_MASUK) AS IJIN FROM ABSENSI WHERE KERJA_MASUK = '00:00:00' ");//ijin
			//foreach ($query->result_array() as $row){
			//	echo $row['IJIN'];
			//}
			//$err = sqlsrv_errors();
			//$user = $this->db['hostname']
			//$f = sqlsrv_query($this->db[],$query1);
			//var_dump($this->db);



			//var_dump($query);
			//echo $query['IJIN'];
			//var_dump($err);
			//var_dump($result['data']=$this->laporan->sp_bi($data));
			//die();
			//var_dump($result);
			//var_dump($data);
			//var_dump($this->load->database());
			//var_dump($this->session->userdata);
			//$connInfo = array("Database" => "1234_PRESENSI", "UID"=>"superadmin2", "PWD"=>"123qwe",'ReturnDatesAsStrings'=>true);
			//$serverName = "DEKSTOP-DLHURVP";
			//$conn = sqlsrv_connect($serverName, $connInfo);
			//var_dump($conn);

			//$query = $this->db->query("SELECT * FROM ABSENSI WHERE KERJA_MASUK >= '07.30.00'");
			//foreach ($query->result_array() as $row){
			//	echo $row['NAMA'];
			//	echo $row['KERJA_MASUK'];
			//	echo $row['UKER'];
			//}

			//die();

			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('home', $result);
			$this->load->view('templates/footer');
		}else{
			$tahun = $this->input->post('tahun');
			$bulan = $this->input->post('bulan');
			$jenis = 'NAMA';
			$typePosisi = 1;
			$posisi = $tahun.'-'.$bulan;
			$data['typePosisi']=$typePosisi;
			$data['kode']=$jenis;
			$data['posisi']=$posisi;
			$data['pernr']='default';
			$data['ket']='default';
			$result['data']=$this->laporan->sp_bi($data);
			$result['postData'] = $data;

			//var_dump($tahun);
			//var_dump($data);

			$this->load->view('templates/header',$data);
			$this->load->view('templates/sidebar', $menu);
			$this->load->view('home', $result);
			$this->load->view('templates/footer');
		}
	}

	public function m_pegawai()
	{
		$menus = $this->menu->menus();
		$menu = array('menus' => $menus);
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar', $menu);
		$this->load->view('m_pegawai');
		$this->load->view('templates/footer');
	}

}
