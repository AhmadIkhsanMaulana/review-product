<?php

    class controller{

        //fungsi login
        function login($conn, $table, $username, $password, $redirect){
            $sql = "SELECT * FROM $table WHERE username = '$username' and password = '$password' ";
            $go = mysqli_query($conn, $sql);
            $check = mysqli_num_rows($go);
            if($check > 0){
                echo"<script>alert('Selamat Datang $username');document.location.href='$redirect'</script>";
            } else {
                echo"<script>alert('Gagal Login. Cek username & password !');document.location.href='index.php'</script>";
            }
        }
        //penutup fungsi login

        //fungsi simpan
        function save($conn, $table, array $field, $redirect){
            $sql = "INSERT INTO $table SET ";

            foreach($field as $key => $value){
                $sql.=" $key =  '$value',";
            }

            $sql = rtrim($sql,',');

            $go = mysqli_query($conn,$sql);
            if($go){
                echo"<script>alert('Berhasil disimpan');document.location.href='$redirect'</script>";
            } else {
                echo"<script>alert('Gagal disimpan');document.location.href='$redirect'</script>";
            }
        }
        //penutup fungsi save

        //fungsi tampil
        function view($conn,$table){
            $sql = "SELECT * FROM $table";
            $go = mysqli_query($conn,$sql);

            while ($data = mysqli_fetch_assoc($go))
                $contents[] = $data;
                return @$contents;   
            
        }
        //penutup fungsi tampil

        //fungsi hapus
        function delete($conn, $table, $where, $redirect){
            $sql = "DELETE FROM $table WHERE $where ";
            $go = mysqli_query($conn,$sql);
            if($go){
                echo"<script>alert('Berhasil dihapus');document.location.href='$redirect'</script>";
            } else {
                echo"<script>alert('Gagal dihapus');document.location.href='$redirect'</script>";
            }
        }
        //penutup fungsi hapus

        //fungsi edit
        function edit($conn, $table, $where){
            $sql = "SELECT * FROM $table WHERE $where";
            $go = mysqli_query($conn,$sql);
            $tampung = mysqli_fetch_assoc($go);
            return $tampung;
        }
        //penutup fungsi edit

        //fungsi ubah
        function update($conn, $table, array $field, $where, $redirect){
            $sql = "UPDATE $table SET ";
            foreach ($field as $key => $value) {
                $sql.=" $key = '$value',";
            }

            $sql = rtrim($sql,',');
            $sql.= " WHERE $where";

        

            $go = mysqli_query($conn, $sql);
            if($go){
                echo"<script>alert('Berhasil diubah');document.location.href='$redirect'</script>";
            } else {
                echo"<script>alert('Gagal diubah');document.location.href='$redirect'</script>";
            }
        }
        //penutup ubah

        //fungsi upload foto
        function upload($foto, $tempat){
            $address = $foto['tmp_name'];
            $namefile = $foto['name'];
            move_uploaded_file($address,"$tempat/$namefile");
            return $namefile;
        }
        // penutup upload
    } 
    //Penutup class
  
?>
