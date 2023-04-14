<?php
require_once "config.php";
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
   case 'GET':
         if(!empty($_GET["nim"]))
         {
            $nim = strval($_GET["nim"]);
            $kode_mk = strval($_GET["kode_mk"]);
            get_mhs($nim, $kode_mk);
         } 
         else
         {
            get_mhss();
         }
         break;
   case 'POST':
         if(!empty($_GET["nim"]) && !empty($_GET["kode_mk"]))
         {
            $nim = strval($_GET["nim"]);
            $kode_mk = strval($_GET["kode_mk"]);
            update_mhs($nim, $kode_mk);
         }
         else
         {
            insert_mhs();
         }     
         break; 
   case 'DELETE':
            $nim = strval($_GET["nim"]);
            $kode_mk = strval($_GET["kode_mk"]);
            delete_mhs($nim, $kode_mk);
            break;
   default:
      // Invalid Request Method
         header("HTTP/1.0 405 Method Not Allowed");
         break;
      break;
 }

   function get_mhss()
   {
      global $mysqli;
      $query="SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, perkuliahan.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai
      from mahasiswa
      join perkuliahan on mahasiswa.nim = perkuliahan.nim
      join matakuliah on matakuliah.kode_mk = perkuliahan.kode_mk;";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Get List Mahasiswa Successfully.',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   function get_mhs($nim, $kode_mk)
   {
      global $mysqli;

      $query = 'SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai
      from perkuliahan
      INNER JOIN mahasiswa on perkuliahan.nim = mahasiswa.nim
      INNER JOIN matakuliah on perkuliahan.kode_mk = matakuliah.kode_mk';

      if($nim != 0)
      {
         $query.=" WHERE mahasiswa.nim='$nim' AND matakuliah.kode_mk='$kode_mk'";
      }

      // $take = $query
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      
         if($data){
            $response=array(
                     'status' => 1,
                     'message' =>'Get Mahasiswa Successfully.',
                     'data' => $data
            );
         } else {
            $response=array(
                     'status' => 0,
                     'message' =>'Mahasiswa Not Found.',
                     'data' => $data
            );
         };

      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   function insert_mhs()
      {
         global $mysqli;
         if(!empty($_POST["nim"]) && !empty($_POST["kode_mk"]) && !empty($_POST["nilai"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array('nim' => '', 'kode_mk' => '','nilai' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));

         if($hitung == count($arrcheckpost)){

            $result = mysqli_query($mysqli, "INSERT INTO perkuliahan SET
            nim = '$data[nim]',
            kode_mk = '$data[kode_mk]',
            nilai = '$data[nilai]'");

            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Score Added Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Score Addition Failed.'
               );
            }

         } else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function update_mhs($nim, $kode_mk)
      {
         global $mysqli;
         if(!empty($_POST["nilai"])){
            $data=$_POST;
         }else{
            $data = json_decode(file_get_contents('php://input'), true);
         }

         $arrcheckpost = array( 'nilai' => '');
         $hitung = count(array_intersect_key($data, $arrcheckpost));

         if($hitung == count($arrcheckpost)){
          
            $result = mysqli_query($mysqli, "UPDATE perkuliahan 
            SET nilai = '$data[nilai]'
            WHERE nim='$nim' AND kode_mk='$kode_mk'");
         
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Score Updated Successfully.'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Score Updation Failed.'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_mhs($nim, $kode_mk)
   {
      global $mysqli;
      $result = "DELETE FROM `perkuliahan` WHERE nim='$nim' AND kode_mk='$kode_mk'";
      
      if(mysqli_query($mysqli, $result))
      {
         $response=array(
            'status' => 1,
            'message' =>'Score Deleted Successfully.'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Score Deletion Failed.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

 
?> 



