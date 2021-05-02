<?php
include "config/connection.php";
include "library/controller.php";

$go = new controller();
$tanggal = date('Y-m-d');
$table = "product";
$redirect = '?menu=product';
@$where = "productID = $_GET[id]";
@$tempat = "foto";


if(isset($_POST['simpan'])){
    $foto = $_FILES['foto'];
    $upload = $go->upload($foto, $tempat);
    @$field = array('nama'=>$_POST['product'],
                    'jenisID'=>$_POST['jenis'],
                    'foto'=>$upload,
                    'tglInput'=>$tanggal,
                    'ket'=>$_POST['ket']);
    $go->save($conn, $table, $field, $redirect);
}

if(isset($_GET['hapus'])){
    $go->delete($conn, $table, $where, $redirect);
}

if(isset($_GET['edit'])){
    $sql = "SELECT product .*, jenis FROM product
            INNER JOIN jenis on product.jenisID = jenis.jenisID
            WHERE $where";
    $go = mysqli_query($conn, $sql);
    $edit = mysqli_fetch_assoc($go);
}
if(isset($_GET['ubah'])){
    $foto = $_FILES['foto'];
    $upload = $go->upload($foto, $tempat);
    if(empty($_FILES['foto']['name'])){
        @$field = array('nama'=>$_POST['product'],
                'jenisID'=>$_POST['jenis'],
                'tglInput'=>$tanggal,
                'ket'=>$_POST['ket']);
        $go->update($conn, $table, $field, $where, $redirect);
    } else {
        @$field = array('nama'=>$_POST['product'],
        'jenisID'=>$_POST['jenis'],
        'foto'=>$upload,
        'tglInput'=>$tanggal,
        'ket'=>$_POST['ket']);
        $go->update($conn, $table, $field, $where, $redirect);
    }
 
}
?>
<br>
<br>
<h1 class="text-center mt-5">Product Dashboard</h1>
<div class="container">
    <form class="mt-5" method="post" enctype="multipart/form-data">
        <table align="center">
            <tr class="row">
                <td><label class="col-form-label">Nama Product</label></td>
                <td><input type="text" class="form-control" name="product" value="<?php echo @$edit['nama'] ?>" required></td>
            </tr>
            <tr class="row">
                <td><label class="col-sm-2 col-form-label">Jenis</label></td>
                <td><select class="form-select" name="jenis" required>
                    <option value="<?php echo $edit['jenisID']?>"><?php echo @$edit['jenis']?></option>
                    <?php
                        $jenis = $go->view($conn, "jenis");
                        foreach($jenis as $r){                
                    ?>
                        <option value="<?php echo $r['jenisID']?>"><?php echo $r['jenis'] ?></option>
                        <?php } ?>
                    <select>
                </td>
            </tr>
            <tr class="row">
                <td><label class="col-sm-2 col-form-label">Foto</label></td>
                <td><input type="file" class="form-control" name="foto" value="<?php echo @$edit['foto'] ?>" ></td>
            </tr>   
            <tr>
            <tr class="row">
                <td><label class="col-sm-2 col-form-label">Keterangan</label></td>
                <td><textarea class="form-control" name="ket" value="<?php echo @$edit['ket'] ?>" ></textarea></td>
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
    <h2>Product Data</h2>
    <hr>
    <br>
    <table class="table table-bordered display mt-5" id="table">
        <!--Title-->
        <thead>
            <tr align="center">
                <th>No</th>
                <th>Nama Product</th>
                <th>Jenis</th>
                <th>Foto</th>
                <th>Tanggal input</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 0;
                $sql = "SELECT product .*, jenis FROM product
                        INNER JOIN jenis on product.jenisID = jenis.jenisID";
                $go = mysqli_query($conn, $sql);
                while ($r = mysqli_fetch_assoc($go)) {
                $no++
            ?>
            <!--Isi Data-->
            <tr align="center">
                <td><?php echo $no; ?></td>
                <td><?php echo $r['nama']?></td>
                <td><?php echo $r['jenis']?></td>
                <td><img src="foto/<?php echo $r['foto']?>" width="50" height="50"></td>
                <td><?php echo $r['tglInput']?></td>
                <td><?php echo $r['ket']?></td>
                <td class="form-control">
                    <a class="btn btn-danger" href="?menu=product&hapus&id=<?php echo $r['productID'] ?>" onclick="return confirm('Hapus Data?')">HAPUS</a>
                    <a class="btn btn-primary" href="?menu=product&edit&id=<?php echo $r['productID'] ?>">EDIT</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
