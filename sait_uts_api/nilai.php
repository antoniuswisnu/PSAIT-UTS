<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
    <style>
        div.scroll {

        width: 600px;
        height: 600px;
        overflow: scroll;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Data Nilai Mahasiswa UTS</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New</a>
                    </div>
		    <div class="scroll">
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                    $sql="SELECT mahasiswa.nim, mahasiswa.nama, mahasiswa.alamat, mahasiswa.tanggal_lahir, perkuliahan.kode_mk, matakuliah.nama_mk, matakuliah.sks, perkuliahan.nilai
                    from mahasiswa
                    join perkuliahan on mahasiswa.nim = perkuliahan.nim
                    join matakuliah on matakuliah.kode_mk = perkuliahan.kode_mk;";
                    if($result = mysqli_query($mysqli, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>No</th>";
                                        echo "<th>Nim</th>";
                                        echo "<th>Nama</th>";
                                        echo "<th>Alamat</th>";
                                        echo "<th>Tanggal Lahir</th>";
                                        echo "<th>Kode MK</th>";
                                        echo "<th>Nama MK</th>";
                                        echo "<th>SKS</th>";
                                        echo "<th>Nilai</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $no = 0;
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . ++$no . "</td>";
                                        echo "<td>" . $row['nim'] . "</td>";
                                        echo "<td>" . $row['nama'] . "</td>";
                                        echo "<td>" . $row['alamat'] . "</td>";
                                        echo "<td>" . $row['tanggal_lahir'] . "</td>";
                                        echo "<td>" . $row['kode_mk'] . "</td>";
                                        echo "<td>" . $row['nama_mk'] . "</td>";
                                        echo "<td>" . $row['sks'] . "</td>";
                                        echo "<td>" . $row['nilai'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['nim'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['nim'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['nim'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($mysqli);
                    ?>
                </div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>