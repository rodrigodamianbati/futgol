<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Proyecto</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

</head>
<body>

<div id="container">
	<h1>Lista de países</h1>
	<p>
	<a class="btn btn-primary" href="<?= base_url('paises/create'); ?>" role="button">Agregar&nbsp;<span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
	</p>
	<div class="table-responsive col-lg-6">
	<table class="table table-hover">
		<thead>
		<th>Id</th>
		<th>Nombre</th>
		<th>Acciones</th>
		</thead>
		<tbody>
		<?php foreach ($paises as $pais): ?>
		<tr>
			<td><?php echo $pais->id; ?></td>
			<td>
				<?php echo $pais->nombre; ?>
			</td>
			<td>
				<a href="<?= base_url('paises/edit/'.$pais->id); ?>" class="btn btn-xs" role="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
				<a href="<?= base_url('paises/delete/'.$pais->id); ?>" class="btn btn-xs" href="#" role="button"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
			</td>
		</tr>
		<?php endforeach; ?>		
		</tbody>
	</table>
	</div>
	<p class="footer"></p>
</div>

</body>
</html>