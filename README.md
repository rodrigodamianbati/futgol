# FutGOL

## Objetivos
El sistema consiste en una aplicación web donde los usuarios podrán participar u organizar y llevar a cabo partidos de fútbol dentro de su localidad de manera más eficiente.

Los usuarios tendrán la posibilidad de reservar turnos en distintas canchas de fútbol cercanas a su ubicación y a su vez podrán invitar a sus conocidos y amigos a participar de dicho encuentro. Por otro lado, se buscará contar con usuarios propietarios de complejos futbolísticos los cuales alquilarán su espacio para la realización de los partidos.

## Configuracion
### Base de datos
application/config/database.php 
Entre los parametros configurables estan: hostname, username, password, database.

### URL de la aplicacion
application/config/config.php, 
con el parametro $config['base_url']

### Script de creación de la base de datos
futgol.sql

### Usuarios iniciales
a@a.com, con clave 123
b@b.com, con clave 123
