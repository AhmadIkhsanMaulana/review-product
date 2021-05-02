<?php  
include "config/connection.php";
include "library/controller.php";

$go = new controller();
$table = 'jenis';
@$field = array('jenis'=>$_POST['jenis']);
$redirect = '?menu=jenis';
@$where = "jenisID = $_GET[id]";

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
<h1 class="text-center mt-5">Jenis Dashboard</h1>
<div class="container">
    <form class="mt-5" action="" method="post">
        <table align="center">
            <tr class="row">
                <td><label class="col-sm-2 col-form-label">Jenis</label></td>
                <td><input type="text" class="form-control" name="jenis" value="<?php echo @$edit['jenis'] ?>" required></td>
            </tr>
            <tr class="row mt-3 " align="center">
                <td>
                <?php if(@$_GET['id']==""){ ?>
                    <input type="submit" class="btn btn-primary form-control"  name="simpan" value="SIMPAN">
                <?php }else{ ?>
                    <input type="submit"class="btn btn-primary form-control" name="ubah" value="UBAH">
                <?php } ?>
            </td>
            </tr>
        </table>
    </form>
    <br>
    <br>
    <h2>Jenis Data</h2>
    <hr>
    <br>
    <table class="table table-bordered display" id="table">
        <!--Title-->
        <thead>
            <tr align="center">
                <th>No</th>
                <th>Jenis</th>
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
                <td><?php echo $r['jenis'] ?></td>
                <td class="form-control">
                    <a class="btn btn-danger" href="?menu=jenis&hapus&id=<?php echo $r['jenisID']?>" onclick="return confirm('Hapus Data?')">HAPUS</a>
                    <a class="btn btn-primary" href="?menu=jenis&edit&id=<?php echo $r['jenisID']?>">EDIT</a>
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>