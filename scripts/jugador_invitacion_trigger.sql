CREATE TRIGGER `triger_usuario_acepta_invitacion` AFTER UPDATE ON `invitacion`
 FOR EACH ROW INSERT INTO
  jugador(partido_id, usuario_id, id)
VALUES(old.partido_id, old.usuario_id, null)