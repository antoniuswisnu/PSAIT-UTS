<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
 $nim = $_GET['nim'];
 $kode_mk = $_GET['kode_mk'];
 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 //Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
 curl_setopt($curl, CURLOPT_URL, 'localhost/sait_uts_api/nilai_api.php?nim='.$nim.'&kode_mk='.$kode_mk.'');
 $res = curl_exec($curl);
 $json = json_decode($res, true);
//var_dump($json);
?>
    <div class="wrapper mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Score</h2>
                    </div>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="updateNilaiDo.php" method="post">
                        <input type = "hidden" name="id_perkuliahan" value="<?php echo"$id_perkuliahan";?>">    
                        <input type = "hidden" name="nim" value="<?php echo"$nim";?>">    
                        <input type = "hidden" name="kode_mk" value="<?php echo"$kode_mk";?>">    

                    
                        <div class="form-group mt-4">
                            <label>Nilai</label>
                            <input type="number" name="nilai" class="form-control" value="<?php echo($json["data"][0]["nilai"]); ?>">
                        </div>
                        <input type="submit" class="btn btn-primary mt-3" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>