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
          <li class="active"><a href="<?= base_url('usuarios'); ?>"><i class="fa fa-address-book"></i> <span>Usuarios</span></a></li>
        <?php } ?>
        <li class="header">JUGADOR</li>
        <li class="active"><a href="<?= base_url('reservas'); ?>"><i class="fa fa-calendar"></i> <span>Mis reservas</span></a></li>
        <li class="active"><a href="<?= base_url('invitaciones'); ?>"><i class="fa fa-user-plus"></i> <span>Mis invitaciones</span></a></li>
        <li class="active"><a href="<?= base_url('partidos'); ?>"><i class="fa fa-soccer-ball-o"></i> <span>Mis partidos</span></a></li>
        <?php if ($this->session->data['rol']==2 || $this->session->data['rol']==3){ ?> 
        <li class="header">PROPIETARIO</li>
        <li class="active"><a href="<?= base_url('complejos'); ?>"><i class="fa fa-home"></i> <span>Mis complejos</span></a></li>
        <li class="active"><a href="<?= base_url('canchas'); ?>"><i class="fa fa-home"></i> <span>Mis canchas</span></a></li>
        <li class="active"><a href="<?= base_url('reservas/reservaspedidas'); ?>"><i class="fa fa-sun-o"></i> <span>Pedidos de reserva</span></a></li>
        <?php } ?> 

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>