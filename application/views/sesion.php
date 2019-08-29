<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Proyecto</title>


</head>
<body>

<div id="container">
	<h1>Hola a todos!</h1>
		<?= $this->session->data['username']; ?>
	<br/>
	Mail:	<?= $this->session->data['email']; ?>
	<div id="body">

	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
