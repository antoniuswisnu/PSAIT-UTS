<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header mt-5">
                        <h2>Tambah Nilai</h2>
                    </div>
                    <p>Silakan isi formulir ini dan kirimkan untuk menambahkan catatan siswa ke database.</p>
                    <form action="insertNilaiDo.php" method="post">

                    <div class="form-group mt-3">
                        <label>NIM</label>
                        <select class="form-select" aria-label="Default select example" name="nim">
                            <option value="sv_001">sv_001</option>
                            <option value="sv_002">sv_002</option>
                            <option value="sv_003">sv_003</option>
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label>Kode MK</label>
                        <select class="form-select" aria-label="Default select example" name="kode_mk">
                            <option value="svpl_001">svpl_001</option>  
                            <option value="svpl_002">svpl_002</option>
                            <option value="svpl_002">svpl_003</option>
                        </select>
                    </div>

                        <div class="form-group mt-3">
                            <label>Nilai</label>
                            <input type="mobile" name="nilai" class="form-control">
                        </div>
                        
                        <input type="submit" class="btn btn-primary mt-3" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>