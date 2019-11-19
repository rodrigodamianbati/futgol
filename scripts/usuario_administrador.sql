-- Script OPCIONAL para configurar al usuario con id=1 como Administrador

use futgol;
UPDATE `futgol`.`usuario` SET `rol_id` = '2' WHERE `usuario`.`id` = 1;