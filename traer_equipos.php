<?php include("db.php"); ?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = $_GET['q'];

if ($q=='') {
  $q = 'pok';  
} 

session_unset();
$sql="SELECT id FROM task WHERE entidad = '".$q."'";
$result = mysqli_query($conn,$sql);
$result_="";
//echo "Returned rows are: " .mysqli_num_rows($result);
if (mysqli_num_rows($result) ==1) {
  //echo "puente_";  
  foreach ($result as $r ) {
    //echo "_puente".$r['id'];
    $sql="SELECT * FROM equipo WHERE task_id = '".$r['id']."'";
    $result_ = mysqli_query($conn,$sql);
    //echo "Returned rows are: " .mysqli_num_rows($result_);
  }  
//echo "Returned rows are: " .mysqli_num_rows($result_);
}
/*
echo "<table>
<tr>
<th>Entidad</th>
<th>NIT</th>
<th>Direccion</th>
<th>Telefono</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['entidad'] . "</td>";
    echo "<td>" . $row['nit'] . "</td>";
    echo "<td>" . $row['direccion'] . "</td>";
    echo "<td>" . $row['telefono'] . "</td>";    
    echo "</tr>";
}
echo "</table>";
*/
?>
<?php if ($q !="pok") { ?>
  <label>Seleccione un equipo de <strong><?php echo $q; ?></strong>, ó escriba uno nuevo: </label>

  <datalist id="ti_">                       
  <?php foreach ($result_ as $r): ?>
  <option value="<?php echo $r['equipo']; ?>">"<?php echo 'Equipo: '.$r['equipo'].', Marca: '.$r['marca'].', Placa: '.$r['placa'].', Serie: '.$r['serie']; ?>"</option>
  <?php endforeach; ?>              
</datalist>
   
 <?php  
 }
?>  

<input type="text" class="form-control" name="equipo" id="equipo" list="ti_" placeholder="Equipo" style="background-color: #b0dfe5; border-color:#ffffff">

</body>
</html>