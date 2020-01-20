<?php
$UID = "superadmin";
$PWD = "123qwe";
$connInfo = array("Database" => "1234_Presensi", $UID, $PWD);
$serverName = "DEKSTOP-DLHURVP";

$conn = sqlsrv_connect($serverName, $connInfo);

if (!$conn) {
	die("Failed" . sqlsrv_errors());
} else {

}
$query = $this->db->query("SELECT Count(KERJA_MASUK) AS IJIN FROM ABSENSI WHERE KERJA_MASUK = '00:00:00' ")->result();
$row1 = $query->result_array();



//$res = json_encode(array($row),JSON_NUMERIC_CHECK);
?>
