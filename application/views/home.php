<!--
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script type="text/javascript" src="../../assets/js/canvasjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
-->
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row page-titles">
			<div class="col-md-5 col-8 align-self-center">
				<h3 class="text-themecolor m-b-0 m-t-0">Home</h3>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>home">Home</a></li>
				</ol>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Absensi Pengawas</h4>
						<form action="<?php echo base_url() ?>home/index" method="POST" id='form1'>
							<div class="form-group row">

								<div class="col-md-3">
									<label>Tahun</label>
									<input id='tahun' class="form-control" type="number" min="1980" max="2099"
										   name="tahun" value="">
								</div>

								<div class="col-md-3">
									<label>Bulan</label>
									<select id='bulan' class="form-control" name="bulan">
										<option value="01">Januari</option>
										<option value="02">Februari</option>
										<option value="03">Maret</option>
										<option value="04">April</option>
										<option value="05">Mei</option>
										<option value="06">Juni</option>
										<option value="07">Juli</option>
										<option value="08">Agustus</option>
										<option value="09">September</option>
										<option value="10">Oktober</option>
										<option value="11">November</option>
										<option value="12">Desember</option>
									</select>
								</div>

							</div>

							<div class="form-group row">
								<div class="col-md-3">
									<input class="btn btn-primary"
										   type='submit' value="Tampilkan">
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<canvas id="myChart"></canvas>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<div class="card-body">
							<div id="container" style="width: 100%; height: 700px;">
								<script>
									<?php
									$query = $this->db->query("SELECT Count(KERJA_MASUK) AS IJIN FROM ABSENSI WHERE KERJA_MASUK = '00:00:00' ");//ijin
									foreach ($query->result_array() as $row) {
										//echo $row['IJIN'];
									}
									$query2 = $this->db->query("SELECT Count(KERJA_MASUK) AS MASUK FROM ABSENSI WHERE KERJA_MASUK <= '07:30:00'");//ijin
									foreach ($query2->result_array() as $row2) {
										//echo $row['MASUK'];
									}
									$query3 = $this->db->query("SELECT Count(KERJA_MASUK) AS TELAT FROM ABSENSI WHERE KERJA_MASUK > '07:30:00'");//ijin
									foreach ($query3->result_array() as $row3) {
										//echo $row['TELAT'];
									}
									?>
									var myChart;
									var options = {
										chart: {
											type: 'item',
											renderTo: 'container'
										},
										title: {
											text: 'Absensi'
										},
										series: [{
											data: [
												['Ijin',<?php echo $row['IJIN'] ?>],
												['Masuk',<?php echo $row2['MASUK'] ?>],
												['Telat',<?php echo $row3['TELAT'] ?>]
											],
											size: '80%',
											startAngle: -180,
											endAngle: 180
										}]
									};
									myChart = Highcharts.chart(options);
								</script>
							</div>
						</div>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<!--<h4 id="graphTitle">Chart Absensi</h4>-->
						<br>
						<?php
						$top = $this->db->query("select top 100 nama, kerja_masuk from absensi where kerja_masuk > '07:30:00' order by kerja_masuk desc");//top 100
						?>
						<style>
							table, th, td {
								border: 1px solid black;
								border-collapse: collapse;
							}

							th, td {
								padding: 5px;
								text-align: left;
								vertical-align: center;

							}
						</style>

						<div class="inside">
							<h4>Top 100 Telat</h4>
							<table style="width: 50% ; border: 1px solid black;height: 100px" class="left">
								<tr>
									<th>Nama</th>
									<?php foreach ($top->result_array() as $topVal) {
										echo "<tr><td>" .$topVal['nama']. "</td></tr>";
									};
									?>
								</tr>
							</table>
							<table class="right">
								<tr>
									<th>Jam Kerja Masuk</th>
									<?php foreach ($top->result_array() as $topVal) {
										echo "<tr><td>" .$topVal['kerja_masuk']. "</td></tr>";
									};
									?>
								</tr>
							</table>
						</div>
						<style type="text/css">
							#canvasBlock {
								height: 440px;
								width: 700px;
							}

							#myChart {
								height: 440px;
								width: 700px;
							}

							#graphTitle {
								text-align: center;
								font-size: 16px;
							}

							.left {
								width: 50%;
								float: left;
							}
							.right{
								width: 50%;
								float: right;
							}

						</style>
						<!-- canvas bawawh
						<script>
							var ctx = document.getElementById('canvasBlock');
							var myChart = new Chart(ctx, {
								type: 'bar',
								data: {
									labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
									datasets: [{
										label: 'Absensi',
										data: [12, 19, 3, 5, 2, 3],
										backgroundColor: [
											'rgba(255, 99, 132, 0.2)',
											'rgba(54, 162, 235, 0.2)',
											'rgba(255, 206, 86, 0.2)',
											'rgba(75, 192, 192, 0.2)',
											'rgba(153, 102, 255, 0.2)',
											'rgba(255, 159, 64, 0.2)'
										],

										borderWidth: 1
									}]
								},
								options: {
									title: {
										display: true,
										position: "top",
										text: "Rekap Absensi Keterlambatan",
										fontSize: 18,
										fontColor: "#000000"
									},
									scales: {
										yAxes: [{
											ticks: {
												beginAtZero: true
											}
										}]
									}
								}
							});
						</script>
						-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--
<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
			datasets: [{
				label: 'Absensi',
				data: [12, 19, 3, 5, 20, 3],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			title: {
				display: true,
				position: "top",
				text: "Rekap Absensi Pegawai",
				fontSize: 18,
				fontColor: "#000000"
			},
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	});
</script>
-->
<script type="text/javascript">
	var val3 = '<?php if ($postData) {
		echo $postData['bulan'];
	} else {
		echo "01";
	} ?>';
	var val4 = '<?php if ($postData) {
		echo $postData['tahun'];
	} else {
		echo 2019;
	} ?>';
	$('#bulan').val(val3);
	$('#tahun').val(val4);
</script>
