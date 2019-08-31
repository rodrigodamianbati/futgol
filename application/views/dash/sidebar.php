<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url(); ?>resources/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->data['username']; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Opciones para el administrador -->
        <li class="active"><a href="<?= base_url('/'); ?>"><i class="fa fa-arrow-up"></i> <span>Inicio</span></a></li>
        <?php if ($this->session->data['rol']==2){ ?>
        <li class="header">ADMINISTRACION</li>
          <li class="active"><a href="<?= base_url('ciudades'); ?>"><i class="fa fa-table"></i> <span>Ciudades</span></a></li>
          <li class="active"><a href="#"><i class="fa fa-address-book"></i> <span>Usuarios</span></a></li>
        <?php } ?>
        <li class="header">JUGADOR</li>
        <li class="active"><a href="#"><i class="fa fa-shopping-bag"></i> <span>Mis reservas</span></a></li>
        <li class="active"><a href="#"><i class="fa fa-money"></i> <span>Mis invitaciones</span></a></li>
        <li class="header">PROPIETARIO</li>
        <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Mis complejos</span></a></li>
        <li class="active"><a href="#"><i class="fa fa-sun-o"></i> <span>Pedidos de reserva</span></a></li>


      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>