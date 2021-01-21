SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `proyecto_auditoria`
--




CREATE TABLE `anexos` (
  `id_anexo` int(11) NOT NULL AUTO_INCREMENT,
  `id_ejecucion_auditoria` int(11) NOT NULL,
  `nombre_anexo` varchar(255) NOT NULL,
  `estado_anexo` tinyint(1) NOT NULL,
  `ruta_anexo` varchar(255) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_anexo`),
  KEY `fk_anexo_ejecuAud` (`id_ejecucion_auditoria`),
  CONSTRAINT `fk_anexo_ejecuAud` FOREIGN KEY (`id_ejecucion_auditoria`) REFERENCES `ejecucion_auditoria` (`id_ejecucion_auditoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;


INSERT INTO anexos VALUES
("8","1","senasoft.txt","1","../../File/1/anexos-auditor/senasoft.txt","1","2021-01-20 04:37:55"),
("9","1","VIDEO MATERNAL A .pptx","1","../../File/1/anexos-auditor/VIDEO MATERNAL A .pptx","1","2021-01-20 04:59:46"),
("10","2","hola","1","askjcbjka","1","2021-01-20 17:46:00"),
("11","1","IMAGENS SETTING TOOL EN ESPAÑOL.docx","0","../../File/1/anexos-auditor/IMAGENS SETTING TOOL EN ESPAÑOL.docx","1","2021-01-20 18:59:33");




CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_encargado` int(11) NOT NULL,
  `nombre_unidad` varchar(45) NOT NULL,
  `certificado` enum('si certificado','no certificado') NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_area`),
  UNIQUE KEY `nombre_unidad` (`nombre_unidad`),
  KEY `fk_unidadNegocio_usuario` (`id_usuario_encargado`),
  CONSTRAINT `fk_unidadNegocio_usuario` FOREIGN KEY (`id_usuario_encargado`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;


INSERT INTO areas VALUES
("16","1","Tecnología","si certificado","1","2021-01-15 06:42:51"),
("20","2","Tesorería","si certificado","1","2021-01-15 06:46:21");




CREATE TABLE `auditoria_programacion` (
  `id_auditoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(11) NOT NULL,
  `id_usu_auditor` int(11) NOT NULL,
  `tipo_auditoria` varchar(45) NOT NULL,
  `fecha_programacion` date NOT NULL,
  `estado_auditoria` enum('Programada','En proceso','Finalizada') NOT NULL COMMENT 'Agregar los estados de una auditoria',
  `observacion` mediumtext DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_auditoria`),
  KEY `fk_auditoria_area` (`id_area`),
  KEY `fk_auditoria_usuario` (`id_usu_auditor`),
  CONSTRAINT `fk_auditoria_area` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_auditoria_usuario` FOREIGN KEY (`id_usu_auditor`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


INSERT INTO auditoria_programacion VALUES
("1","16","1","Auditoria de aseguramiento","2021-01-01","En proceso","","1","2021-01-18 05:10:11"),
("2","16","1","Calidad","2020-12-01","Programada","aaaaa","0","2021-01-19 00:18:13"),
("3","20","1","Aseguramiento","2021-01-01","En proceso","","0","2021-01-20 15:06:50"),
("4","20","1","Calidad","2021-01-01","Programada","","0","2021-01-20 15:06:14");




CREATE TABLE `backup` (
  `id_backup` int(11) NOT NULL AUTO_INCREMENT,
  `dia_respaldo` int(11) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_backup`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


INSERT INTO backup VALUES
("1","2","1","2021-01-20 22:20:38");




CREATE TABLE `ejecucion_auditoria` (
  `id_ejecucion_auditoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_auditoria_programada` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_ejecucion_auditoria`),
  KEY `fk_audP_audE` (`id_auditoria_programada`),
  CONSTRAINT `fk_audP_audE` FOREIGN KEY (`id_auditoria_programada`) REFERENCES `auditoria_programacion` (`id_auditoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO ejecucion_auditoria VALUES
("1","1","2021-01-18","","1","2021-01-18 05:10:12"),
("2","3","2021-01-20","","1","2021-01-20 15:06:50");




CREATE TABLE `hallazgo` (
  `id_hallazgo` int(11) NOT NULL AUTO_INCREMENT,
  `id_ejecucion_auditoria` int(11) NOT NULL,
  `fecha_hallazgo` datetime NOT NULL,
  `tema_hallazgo` mediumtext NOT NULL,
  `acciones_planteadas` mediumtext NOT NULL,
  `aspecto_mejora` mediumtext NOT NULL,
  `ruta_evidencia` varchar(255) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  PRIMARY KEY (`id_hallazgo`),
  KEY `fk_hallazgo_auditoria` (`id_ejecucion_auditoria`),
  CONSTRAINT `fk_hallazgo_auditoria` FOREIGN KEY (`id_ejecucion_auditoria`) REFERENCES `ejecucion_auditoria` (`id_ejecucion_auditoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


INSERT INTO hallazgo VALUES
("1","1","2021-01-18 03:53:44","aaaaaaa","aaaaaaa","aaaaaaa","aaaaaaaa","1"),
("2","2","2021-01-27 20:49:34","bbbbbbbbbbbbbbbbb","bbbbbbbbbbbbbbbbbbb","bbbbbbbbbbbbbbbbbbbb","bbbbbbbbbbbbbb","1"),
("3","1","2021-01-20 20:52:54","ccccccccccccc","ccccccccccccc","ccccccccccccccc","cccccccccccccc","1");




CREATE TABLE `persona` (
  `id_persona` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pri_per` varchar(45) NOT NULL,
  `nombre_seg_per` varchar(45) DEFAULT NULL,
  `apellido_pri_per` varchar(45) NOT NULL,
  `apellido_seg_per` varchar(45) DEFAULT NULL,
  `tipo_doc_per` varchar(45) NOT NULL,
  `num_documento` varchar(45) NOT NULL,
  `num_celular` varchar(45) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `fecha_nac_per` date NOT NULL,
  `genero_per` enum('Masculino','Femenino','Prefiero no decirlo') NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


INSERT INTO persona VALUES
("1","Sergio","Andrés","Zambrano","Morales","Cédula de ciudadanía ","1003813222","3158843108","sergio.zambrano878@gmail.com","2000-09-08","Masculino","0","2021-01-09 03:48:25"),
("2","María","","Trujillo","","Cédula de ciudadanía ","1000758853","0000000","isabel.trujillo@gmail.com","2021-01-10","Femenino","0","2021-01-11 00:50:44"),
("3","Sergio","Andrés","Zambrano","","Cedula de ciudadania","1234567890","3166666666","sazambrano2@misena.edu.co","2011-08-19","Masculino","0","2021-01-17 00:34:40"),
("4","Nicolas","","Escobar","","Cedula de ciudadania","0987654321","3166666666","ecnicolas123@gmail.com","2011-08-19","Masculino","0","2021-01-17 00:35:32");




CREATE TABLE `plan_mejoramiento` (
  `id_plan_mejoramiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_hallazgo` int(11) NOT NULL,
  `fecha_evidencia` date NOT NULL,
  `ruta_evidencia` varchar(255) DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado_plaMejor` enum('Abierto','Sin avance','Cerrado','Vencido') NOT NULL,
  PRIMARY KEY (`id_plan_mejoramiento`),
  KEY `fk_plan_hallazgo` (`id_hallazgo`),
  CONSTRAINT `fk_plan_hallazgo` FOREIGN KEY (`id_hallazgo`) REFERENCES `hallazgo` (`id_hallazgo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


INSERT INTO plan_mejoramiento VALUES
("1","1","2021-01-07","aaaaaaaaaaa","1","2021-01-20 20:51:03","Abierto"),
("2","2","2021-01-04","aaaaaaaaaaaaaa","1","2021-01-20 20:51:03","Abierto");




CREATE TABLE `prorroga_mejoramiento` (
  `id_prorroga_mejoramiento` int(11) NOT NULL AUTO_INCREMENT,
  `id_plan_mejoramiento` int(11) NOT NULL,
  `fecha_adicional` varchar(45) NOT NULL,
  `estado_prorroga` tinyint(1) NOT NULL,
  `observacion` varchar(200) DEFAULT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_prorroga_mejoramiento`),
  KEY `fk_prorroga_planMejora` (`id_plan_mejoramiento`),
  CONSTRAINT `fk_prorroga_planMejora` FOREIGN KEY (`id_plan_mejoramiento`) REFERENCES `plan_mejoramiento` (`id_plan_mejoramiento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(45) NOT NULL,
  `estado_rol` tinyint(4) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


INSERT INTO rol VALUES
("1","Administrador","1","0","2021-01-09 03:45:54"),
("2","Auditor","1","0","2021-01-09 03:45:54"),
("3","Coordinador de área","1","0","2021-01-09 03:46:20"),
("4","Coordinador de auditoría","1","0","2021-01-09 03:46:20");




CREATE TABLE `trasa_anexos` (
  `id_trasa_anexos` int(11) NOT NULL AUTO_INCREMENT,
  `id_anexo` int(11) NOT NULL,
  `id_usuario_validacion` int(11) NOT NULL,
  `fecha_validacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `observa_anexo` text DEFAULT NULL,
  PRIMARY KEY (`id_trasa_anexos`),
  KEY `fk_tras_anexo` (`id_anexo`),
  CONSTRAINT `fk_tras_anexo` FOREIGN KEY (`id_anexo`) REFERENCES `anexos` (`id_anexo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


INSERT INTO trasa_anexos VALUES
("9","8","1","2021-01-20 04:37:53",""),
("10","9","1","2021-01-20 04:59:45","");




CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `cod_contrato_usu` varchar(45) NOT NULL,
  `pass_usu` varchar(150) NOT NULL,
  `estado_usu` tinyint(4) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuario_persona` (`id_persona`),
  CONSTRAINT `fk_usuario_persona` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


INSERT INTO usuario VALUES
("1","1","AAA-000","$2y$10$slJVsM09zeZA8JlgHi6gDehEwhXRlDZWKW1Z5svckR4tG8WV6HyO.","1","0","2021-01-20 12:56:54"),
("2","2","AAA-001","$2y$10$d4b3I39wNi96oCtoO8imIeSxoWhjjzjBNcSeD2TBxDA3v6UzpfPBK","1","0","2021-01-09 05:52:46"),
("5","3","AAA-002","$2y$10$vtaZFpiwpRLZZNDdZ6TyW.RsbtXcCcJLyVSf7/3HoxZ6CZmuExsFi","0","0","2021-01-17 15:08:34"),
("6","4","AAA-003","$2y$10$ml6d1Yv5DjDkF4RssJl.Reude.dMKOf93gtwo8fAQ1GopdKKpdtsW","1","1","2021-01-17 16:50:12");




CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usuario_creacion` int(11) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_usuario_rol`),
  KEY `fk_usuarioRol_rol` (`id_rol`),
  KEY `fk_usuarioRol_usuarios` (`id_usuario`),
  CONSTRAINT `fk_usuarioRol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarioRol_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


INSERT INTO usuario_rol VALUES
("1","1","1","0","2021-01-09 03:50:02"),
("2","1","2","0","2021-01-09 03:50:02"),
("4","2","3","0","2021-01-14 19:58:46"),
("5","1","4","0","2021-01-14 14:54:41"),
("6","1","3","0","2021-01-14 14:54:41");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;