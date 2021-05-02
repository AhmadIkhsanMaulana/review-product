<?php  
include "config/connection.php";
include "library/controller.php";

$go = new controller();
$table = "login";
//enkripsi menggunakan metode base64
@$password = base64_encode($_POST['pass']);
@$field = array('username'=>$_POST['user'], 'password'=>$password);
$redirect = '?menu=user';
@$where = "id = $_GET[id]";

if(isset($_POST['simpan'])){
    $go->save($conn, $table, $field, $redirect);
}
if(isset($_GET['hapus'])){
    $go->delete($conn, $table, $where, $redirect);
}

if(isset($_GET['edit'])){
    $edit =$go->edit($conn, $table, $where);
}
if(isset($_GET['ubah'])){
    $go->update($conn, $table, $field, $where, $redirect);
}
?>
<br>
<br>
<h1 class="text-center mt-5">User Dashboard</h1>
<div class="container">
    <form class="mt-5" action="" method="post">
        <table align="center">
            <tr class="row">
                <td><label class="col-sm-2 col-form-label">Username</label></td>
                <td>
                <input type="text" class="form-control" name="user" value="<?php echo @$edit['username'] ?>"required>
                </td>
            </tr>
            <tr class="row">
                <td><label class="col-sm-2 col-form-label">Password</label></td>
                <td><input type="Password" class="form-control" name="pass" value="<?php echo base64_decode(@$edit['password']) ?>" required></td>
            </tr>
            <tr class="row mt-3">
                <td>
                <?php if(@$_GET['id']==""){ ?>
                    <input type="submit" class="btn btn-primary form-control" name="simpan" value="SIMPAN">
                <?php }else{ ?>
                    <input type="submit" class="btn btn-primary form-control" name="ubah" value="UBAH">
                <?php } ?>
            </td>
            </tr>  
        </table>
    </form>
    <br>
    <br>
    <h2>User Data</h2>
    <hr>
    <br>
    <table class="table table-bordered mt-5 display" id="table">
        <!--Title-->
        <thead>
            <tr align="center">
                <th>No</th>
                <th>Username</th>
                <th>password</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $data = $go->view($conn,$table);
                $no = 0;
                if($data == ""){
                    echo"<tr><td colspan='4'>No Record</td></tr>";
                } else {
                foreach($data as $r){
                $no++
            ?>
            <!--Isi Data-->
            <tr align="center">
                <td><?php echo $no; ?></td>
                <td><?php echo $r['username']?></td>
                <td><?php echo $r['password']?></td>
                <td class="form-control">
                    <a class="btn btn-danger"  href="?menu=user&hapus&id=<?php echo $r['id'] ?>" onclick="return confirm('Hapus Data?')">HAPUS</a>
                    <a class="btn btn-primary" href="?menu=user&edit&id=<?php echo $r['id'] ?>">EDIT</a>
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>