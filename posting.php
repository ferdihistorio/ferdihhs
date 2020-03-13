<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {
	# code...
	$response = array();
	//mendapatkan data
	$npm = $_POST['npm'];
	$nama = $_POST['nama'];
	$kelas = $_POST['kelas'];
	$sesi = $_POST['sesi'];

	require_once('dbConnect.php');
	//cek npm 
	$sql = "SELECT * FROM mahasiswa WHERE npm = '$npm'";
	$check = mysqli_fetch_array(mysqli_query($con,$sql));
	if (isset($check)) {
		# code...
		$response["value"] = 0;
		$response["message"] = "oops! NPM sudah terdaftar!";
		echo json_encode($response);
	} else {
		$sql = "INSERT INTO mahasiswa(npm,nama,kelas,sesi) VALUES('$npm','$nama','$kelas','$sesi')";
		if (mysqli_query($con,$sql)) {
			# code...
			$response = ['value'] = 1;
			$response = ['message'] = "Sukses Mendaftar";
			echo json_encode($response);
		} else {
			$response['value']=0;
			$response['message']="Coba lagi!!";
			echo json_encode($response);
		}
	}
	//tutup database
	mysqli_close($con);
}else {
	$response["value"]=0;
	$response["message"]="COba lagi!!!!";
	echo json_encode($response);
}
