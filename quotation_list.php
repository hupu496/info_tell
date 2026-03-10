<?php
require_once 'db_config.php';

$sql = "SELECT id, project_name, quotation_for, buyer, due_date 
FROM reciept ORDER BY id DESC";

$result = $conn->query($sql);
?>
<style>

.page-card{
background:white;
border-radius:12px;
padding:20px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.title-box{
background:#2878EB;
color:white;
padding:18px;
border-radius:10px;
text-align:center;
font-size:22px;
font-weight:600;
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
}

thead{
background:#2878EB;
color:white;
}

thead th{
padding:12px;
font-weight:600;
}

tbody td{
padding:12px;
border-bottom:1px solid #eee;
}

tbody tr:nth-child(even){
background:#f6f6f6;
}

.view-btn{
background:#2878EB;
color:white;
padding:6px 16px;
border-radius:6px;
text-decoration:none;
font-size:14px;
}

.view-btn:hover{
background:#1d5fd1;
color:white;
}

</style>

<div class="container mt-4">

<div class="page-card">

<div class="title-box">
Quotation List
</div>

<table>

<thead>
<tr>
<th>SNO</th>
<th>DATE</th>
<th>PROJECT NAME</th>
<th>COMPANY NAME</th>
<th>BUYER NAME</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
$i=1;
while($row=$result->fetch_assoc()){
?>

<tr>

<td><?php echo $i++; ?></td>

<td><?php echo date("Y-m-d",strtotime($row['due_date'])); ?></td>

<td><?php echo $row['project_name']; ?></td>

<td><?php echo $row['quotation_for']; ?></td>

<td><?php echo $row['buyer']; ?></td>

<td>
<a class="view-btn" href="receipt.php?id=<?php echo $row['id']; ?>">
VIEW
</a>
</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function(){
$('table').DataTable();
});
</script>
