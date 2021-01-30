/*
Navicat MySQL Data Transfer

Source Server         : MYSQL
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : cofessa_app

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2020-04-17 20:28:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for correos
-- ----------------------------
DROP TABLE IF EXISTS `correos`;
CREATE TABLE `correos` (
  `correo_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `correo` varchar(64) CHARACTER SET utf8 NOT NULL,
  `motivo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `mensaje` longtext CHARACTER SET utf8 NOT NULL,
  `envio` datetime NOT NULL,
  PRIMARY KEY (`correo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of correos
-- ----------------------------
INSERT INTO `correos` VALUES ('1', 'Miguel Martínez', 'martinez@prueba.app', 'Prueba', 'Mensaje de prueba <b>caballero</b>', '2019-09-20 21:01:32');
INSERT INTO `correos` VALUES ('2', 'Miguel Martínez', 'martinez@prueba.app', 'Prueba', 'Mensaje de prueba <b>caballero</b>', '2019-09-20 21:02:26');
INSERT INTO `correos` VALUES ('3', 'Miguel Martínez', 'martinez@prueba.app', 'Prueba 2', 'Esta es la prueba 2', '2019-09-20 21:03:30');
INSERT INTO `correos` VALUES ('4', 'Miguel Martínez', 'martinez@prueba.app', 'Prueba 3', 'Prueba 3', '2019-09-20 21:04:12');

-- ----------------------------
-- Table structure for menu_documentos
-- ----------------------------
DROP TABLE IF EXISTS `menu_documentos`;
CREATE TABLE `menu_documentos` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `creado_por` (`creado_por`) USING BTREE,
  KEY `actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `menu_documentos_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `menu_documentos_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menu_documentos
-- ----------------------------
INSERT INTO `menu_documentos` VALUES ('1', 'Tablas e indicadores', '2019-09-24 12:35:52', '2019-10-06 00:09:51', '1', '2');
INSERT INTO `menu_documentos` VALUES ('2', 'Tratados internacionales', '2019-09-24 18:11:20', null, '1', null);
INSERT INTO `menu_documentos` VALUES ('3', 'Información fiscal', '2019-09-25 00:55:25', '2019-10-02 13:38:19', '1', '1');
INSERT INTO `menu_documentos` VALUES ('4', 'Contratos, escritos y formatos', '2019-10-02 13:44:37', '2019-10-02 22:06:03', '1', '1');

-- ----------------------------
-- Table structure for menu_enlaces_interes
-- ----------------------------
DROP TABLE IF EXISTS `menu_enlaces_interes`;
CREATE TABLE `menu_enlaces_interes` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `creado_por` (`creado_por`) USING BTREE,
  KEY `actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `menu_enlaces_interes_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `menu_enlaces_interes_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menu_enlaces_interes
-- ----------------------------
INSERT INTO `menu_enlaces_interes` VALUES ('1', 'Sección 1', '2019-09-25 23:10:03', '2019-10-06 00:22:14', '1', '2');
INSERT INTO `menu_enlaces_interes` VALUES ('2', 'Sección 2', '2019-10-02 22:09:57', null, '1', null);
INSERT INTO `menu_enlaces_interes` VALUES ('3', 'Sección 3', '2019-10-07 16:03:49', null, '2', null);
INSERT INTO `menu_enlaces_interes` VALUES ('4', 'Sección 4', '2019-10-07 16:05:15', null, '2', null);
INSERT INTO `menu_enlaces_interes` VALUES ('5', 'Sección 5', '2019-10-07 16:06:15', null, '2', null);

-- ----------------------------
-- Table structure for noticias
-- ----------------------------
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias` (
  `noticia_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) CHARACTER SET utf8 NOT NULL,
  `resumen` longtext CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`noticia_id`),
  KEY `fk__noticias__creado_por` (`creado_por`) USING BTREE,
  KEY `fk__noticias__actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `noticias_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of noticias
-- ----------------------------
INSERT INTO `noticias` VALUES ('7', 'Disciplina Fiscal en Paquete Económico 2020', 'La disciplina fiscal del Paquete Económico para 2020 está “a prueba de fuego”, es una propuesta que puede generar dudas, pero que no hay malos comentarios sobre ésta, destacó el jefe de la Oficina de la Presidencia, Alfonso Romo Garza.\r\n', 'http://cofessa.com.mx/', '1-1570334220.jpg', '2019-10-05 22:56:03', '2019-10-05 22:57:00', '2', '2');
INSERT INTO `noticias` VALUES ('8', 'Prueban sistema de cobro digital en tres ciudades', 'La tortillería La Herradura, que se ubica a la entrada de Tulancingo, Hidalgo, es la primera en el país que acepta el cobro digital (CoDi), la nueva plataforma para realizar pagos por medio de un teléfono celular.', 'http://google.com', '1-1570334326.jpg', '2019-10-05 22:58:46', null, '2', null);
INSERT INTO `noticias` VALUES ('9', 'La reforma fiscal pendiente', 'Más pronto que tarde tendrá que disminuir el gasto (poco probable) o aumentar los ingresos dado el poco margen que se tiene para aumentar el endeudamiento', 'http://yahoo.com', '1-1570334482.jpg', '2019-10-05 23:01:22', null, '2', null);
INSERT INTO `noticias` VALUES ('10', 'Urge Reforma a Ley de Coordinación Fiscal', 'El gobernador de Querétaro y presidente de Conago, Francisco Domínguez Servién, expuso que la ley data desde hace 40 años, por lo que instó a que haya una revisión de la distribución de recursos.', 'http://bing.com', '1-1570334560.jpg', '2019-10-05 23:02:40', null, '2', null);
INSERT INTO `noticias` VALUES ('11', 'S&P y Fitch ven riesgos en Paquete Económico 2020', 'Fitch Ratings y Standard & Poor’s Global Ratings, advirtieron que los supuestos macroeconómicos con los que se construyó el Paquete Económico de 2020 son optimistas y se corre el riesgo de que no se logren las metas esperadas', 'http://yandex.ru', '1-1570334661.jpg', '2019-10-05 23:04:21', null, '2', null);
INSERT INTO `noticias` VALUES ('12', 'Conocer lista de condonaciones de impuestos es un parteaguas en acceso a la información', 'Lo relevante es que el poder Judicial determinó que cuando se solicite información sobre condonaciones de impuestos o beneficios a contribuyentes no opera el secreto fiscal', 'https://www.eleconomista.com.mx/politica/Conocer-lista-de-condonaciones-de-impuestos-es-un-parteaguas-en-acceso-a-la-informacion-en-manos-del-SAT-Luis-Perez-de-Acha-20191005-0011.html', '1-1570334923.jpg', '2019-10-05 23:08:43', '2020-02-25 14:20:18', '2', '1');

-- ----------------------------
-- Table structure for operaciones
-- ----------------------------
DROP TABLE IF EXISTS `operaciones`;
CREATE TABLE `operaciones` (
  `operacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL,
  `tipo_operacion_id` int(1) unsigned NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 NOT NULL,
  `token` varchar(35) CHARACTER SET utf8 NOT NULL,
  `fecha_expiracion` datetime NOT NULL,
  PRIMARY KEY (`operacion_id`),
  KEY `fk_tokens_validacion_usuarios` (`usuario_id`) USING BTREE,
  KEY `tipo_operacion_id` (`tipo_operacion_id`) USING BTREE,
  CONSTRAINT `operaciones_ibfk_1` FOREIGN KEY (`tipo_operacion_id`) REFERENCES `tipos_operaciones` (`tipo_operacion_id`),
  CONSTRAINT `operaciones_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of operaciones
-- ----------------------------

-- ----------------------------
-- Table structure for periodos_pagos
-- ----------------------------
DROP TABLE IF EXISTS `periodos_pagos`;
CREATE TABLE `periodos_pagos` (
  `id_periodo_pago` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `desc_periodo_pago` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `fecha_creacion_periodo_pago` datetime DEFAULT NULL,
  `fecha_modificacion_periodo_pago` datetime DEFAULT NULL,
  `fecha_eliminacion_periodo_pago` datetime DEFAULT NULL,
  PRIMARY KEY (`id_periodo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of periodos_pagos
-- ----------------------------
INSERT INTO `periodos_pagos` VALUES ('1', '2000', '2018-06-30 00:59:47', '2018-06-30 03:36:30', null);
INSERT INTO `periodos_pagos` VALUES ('2', '2001', '2018-06-30 01:08:21', '2018-07-02 03:05:11', null);
INSERT INTO `periodos_pagos` VALUES ('3', '2003', '2018-09-21 14:59:18', '2018-09-21 15:00:02', null);
INSERT INTO `periodos_pagos` VALUES ('4', '2002', '2018-09-21 15:14:57', null, null);
INSERT INTO `periodos_pagos` VALUES ('5', '2004', '2018-09-23 20:28:01', '2018-09-23 20:28:20', null);
INSERT INTO `periodos_pagos` VALUES ('6', '2005', '2018-09-24 21:57:19', null, null);
INSERT INTO `periodos_pagos` VALUES ('7', '2006', '2018-10-02 15:35:52', '2018-10-02 15:36:19', null);

-- ----------------------------
-- Table structure for servicios
-- ----------------------------
DROP TABLE IF EXISTS `servicios`;
CREATE TABLE `servicios` (
  `servicio_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resumen` varchar(80) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `imagen` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`servicio_id`),
  KEY `fk__servicios__creado_por` (`creado_por`) USING BTREE,
  KEY `fk__servicios__actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `servicios_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of servicios
-- ----------------------------
INSERT INTO `servicios` VALUES ('1', 'Envío declaración personas físicas', 'http://w3schools.com', '1-1570336324.png', '2019-09-19 21:36:05', '2020-01-23 00:29:26', '1', '1');
INSERT INTO `servicios` VALUES ('2', 'Envío declaracíón personas morales', 'https://www.siat.sat.gob.mx/PTSC/', '1-1570336371.jpg', '2019-09-19 21:51:49', '2019-10-05 23:32:51', '1', '2');
INSERT INTO `servicios` VALUES ('4', '¿Necesitas factura electrónica o timbrado de nóminas?', 'http://cofessa.com.mx/contact.php', '1-1570336529.jpg', '2019-10-05 23:35:29', null, '2', null);
INSERT INTO `servicios` VALUES ('5', 'Consulta de devoluciones automáticas', 'http://google.com', '1-1570336767.jpg', '2019-10-05 23:38:54', '2019-10-05 23:39:27', '2', '2');
INSERT INTO `servicios` VALUES ('6', 'Programa de devoluciones automáticas (retenedores)', 'http://bing.com', '1-1570336856.jpg', '2019-10-05 23:40:56', null, '2', null);
INSERT INTO `servicios` VALUES ('7', 'Pago referenciado', 'http://yandex.ru', '1-1570336910.png', '2019-10-05 23:41:50', null, '2', null);
INSERT INTO `servicios` VALUES ('8', 'Trámites y servicios', 'https://php.net', '1-1570337061.png', '2019-10-05 23:44:21', null, '2', null);
INSERT INTO `servicios` VALUES ('9', 'Oficina virtual', 'http://gob.mx/sat', '1-1570337139.jpg', '2019-10-05 23:45:39', null, '2', null);

-- ----------------------------
-- Table structure for submenu_documentos
-- ----------------------------
DROP TABLE IF EXISTS `submenu_documentos`;
CREATE TABLE `submenu_documentos` (
  `submenu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`submenu_id`),
  KEY `creado_por` (`creado_por`) USING BTREE,
  KEY `actualizado_por` (`actualizado_por`) USING BTREE,
  KEY `submenu_documentos_ibfk_3` (`menu_id`) USING BTREE,
  CONSTRAINT `submenu_documentos_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `submenu_documentos_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `submenu_documentos_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `menu_documentos` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of submenu_documentos
-- ----------------------------
INSERT INTO `submenu_documentos` VALUES ('2', '2', 'México - América del Norte', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoEUA.doc', '2019-09-24 16:21:57', '2019-10-07 01:13:27', '1', '2');
INSERT INTO `submenu_documentos` VALUES ('3', '2', 'México - Argentina', 'http://www.cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoArgentina.pdf', '2019-09-24 18:03:05', '2019-10-07 01:13:56', '1', '2');
INSERT INTO `submenu_documentos` VALUES ('4', '3', 'Leyes federales de México', 'http://www.diputados.gob.mx/LeyesBiblio/index.htm', '2019-09-25 00:56:22', '2019-10-07 01:17:33', '1', '2');
INSERT INTO `submenu_documentos` VALUES ('5', '1', 'Tablas ISR 2013 mensual', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/TISR13/TMenISR13.pdf', '2019-10-06 00:11:45', '2019-10-06 23:46:05', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('6', '1', 'Tablas ISR 2013 quincenal', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/TISR13/TQuiISR13.pdf', '2019-10-06 00:12:46', '2019-10-06 23:46:19', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('7', '3', 'Leyes estatales de México', 'http://www.diputados.gob.mx/LeyesBiblio/gobiernos.htm', '2019-10-06 00:18:36', '2019-10-07 01:22:48', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('10', '1', 'Tablas ISR Decenal 2013', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/TISR13/TDeceISR13.pdf', '2019-10-06 23:44:56', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('11', '1', 'Tablas ISR Semanal 2013', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/TISR13/TSemISR13.pdf', '2019-10-06 23:48:51', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('12', '1', 'Tablas ISR Diaria 2013', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/TISR13/TDiaISR13.pdf', '2019-10-06 23:49:25', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('13', '1', 'Tablas ISR Arrendamiento 2013', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/TISR13/TArrendISR13.pdf', '2019-10-06 23:49:57', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('14', '1', 'Tablas ISR Enajenación Inmuebles', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/TISR13/TEnaInmueISR13.pdf', '2019-10-06 23:51:15', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('15', '1', 'Días inhábiles 2013', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/INFFISCAL13/diasinhabiles2013.pdf', '2019-10-06 23:51:59', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('16', '1', 'Cantidades Actualizadas 2013', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/INFFISCAL13/canact2013.pdf', '2019-10-06 23:52:35', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('17', '1', 'Multas Actualizadas CFF', 'http://cofessa.com.mx/pdf/Tablas%20e%20Indicadores/INFFISCAL13/multascff2013.doc', '2019-10-06 23:53:57', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('18', '1', 'Tablas Obrero-Patronales 2013', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/INFFISCAL13/tablasop2013.pdf', '2019-10-06 23:54:34', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('19', '1', 'Costos y Factores Mano de Obra', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/INDFINAN/cyfmo2012.pdf', '2019-10-07 00:55:15', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('20', '1', 'Equivalencias Moneda Extranjera', 'http://cofessa.com.mx/pdf/Tablas%20e%20Indicadores/INDFINAN/equivalencias%20moneda%20extranjera.xls', '2019-10-07 00:56:55', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('21', '1', 'Acta Deducciones Enajenación Inmuebles', 'http://cofessa.com.mx/pdf/Tablas%20e%20Indicadores/Indicadores%20Financieros/ActDeducEnajenacioninmuebles.xls', '2019-10-07 00:58:42', '2019-10-07 00:59:07', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('22', '1', 'Paí­ses con REFIPRES', 'http://www.cofessa.com.mx/pdf/Tablas%20e%20Indicadores/Indicadores%20Financieros/PAISES%20CON%20REGIMENES%20FISCALES%20PREFERENTES.pdf', '2019-10-07 00:59:57', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('23', '2', 'México - Alemania', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoAlemania.doc', '2019-10-07 01:14:41', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('24', '4', 'Modelo Contrato Mutuo', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/contratomutuo.doc', '2019-10-07 01:24:10', '2019-10-07 15:37:54', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('25', '4', 'Modelo Contrato de Comodato', 'http://www.cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/Contrato%20Comodato.doc', '2019-10-07 01:25:00', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('26', '2', 'México - Brasil', 'http://www.cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoBrasil.pdf', '2019-10-07 14:44:11', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('27', '2', 'México - Canadá', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20CanadaMexico.doc', '2019-10-07 14:44:59', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('28', '2', 'México - Chile', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoChile.doc', '2019-10-07 14:46:08', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('29', '2', 'México - China', 'http://www.cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoChina.pdf', '2019-10-07 14:47:42', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('30', '2', 'México - Reino Unido', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoReynoUnido.doc', '2019-10-07 14:49:20', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('31', '2', 'México - Italia', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoItalia.doc', '2019-10-07 14:51:04', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('32', '2', 'México - Suiza', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoSuiza.doc', '2019-10-07 14:52:16', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('33', '2', 'México - Japón', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoJapon.doc', '2019-10-07 14:53:17', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('34', '2', 'México - España', 'http://cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20MexicoEspana.doc', '2019-10-07 14:54:28', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('35', '2', 'México - Australia', 'http://www.cofessa.com.mx/pdf/Tratados%20Internacionales/Tratado%20Tributario%20Mexico-Australia.pdf', '2019-10-07 14:55:30', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('36', '2', 'Estatus de Convenios', 'ftp://ftp2.sat.gob.mx/asistencia_servicio_ftp/publicaciones/legislacion13/cuadro_17052013.pdf', '2019-10-07 14:56:09', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('37', '2', 'Lista Países Convenio IETU', 'http://www.sat.gob.mx/sitio_internet/servicios/noticias_boletines/33_10771.html', '2019-10-07 15:01:02', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('38', '3', 'Paquete Fiscal 2012', 'http://www.shcp.gob.mx/ApartadosHaciendaParaTodos/paquete_economico_2012/index.html', '2019-10-07 15:06:25', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('39', '3', 'Trámites padrón de importadores', 'http://www.aduanas.gob.mx/aduana_mexico/2008/tramites/140_21127.html', '2019-10-07 15:08:36', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('40', '3', 'Guía de importación', 'http://www.aduanas.gob.mx/aduana_mexico/2008/importando_exportando/142_10068.html', '2019-10-07 15:12:12', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('41', '3', 'Recintos fiscalizados', 'http://www.aduanas.gob.mx/aduana_mexico/2008/tramites/140_10480.html', '2019-10-07 15:13:47', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('42', '3', 'Depósito fiscal', 'http://www.aduanas.gob.mx/aduana_mexico/2008/tramites/140_10490.html', '2019-10-07 15:16:09', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('43', '3', 'Certificación de empresas', 'http://www.aduanas.gob.mx/aduana_mexico/2008/tramites/140_10496.html', '2019-10-07 15:19:09', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('44', '3', 'Copias certificadas de pedimentos', 'http://www.aduanas.gob.mx/aduana_mexico/2008/servicios/144_17089.html', '2019-10-07 15:20:27', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('45', '3', 'Agente y apoderado aduanal', 'http://www.aduanas.gob.mx/aduana_mexico/2008/servicios/144_10197.html', '2019-10-07 15:21:01', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('46', '3', 'Orientación adeudos fiscales', 'http://www.sat.gob.mx/pontealcorriente/', '2019-10-07 15:22:36', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('47', '3', 'Información SIPRED', 'http://www.sat.gob.mx/sitio_internet/e_sat/oficina_virtual/108_4570.html', '2019-10-07 15:24:19', '2019-10-07 15:25:06', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('48', '3', 'Órdenes de fiscalización', 'https://www.consulta.sat.gob.mx/sivaofinter/siv_CapRfc.asp?Us=&Dato=sHoIH8DH5-73DxKJvZ23AOV-&Pis=', '2019-10-07 15:27:09', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('49', '3', 'Validación de CFDI', 'https://verificacfdi.facturaelectronica.sat.gob.mx/', '2019-10-07 15:28:38', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('50', '3', 'Validación de comprobantes de ingresos', 'https://www.consulta.sat.gob.mx/SICOFI_WEB/ModuloSituacionFiscal/VerificacionComprobantes.asp', '2019-10-07 15:31:22', '2019-10-07 15:34:43', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('51', '4', 'Modelo contrato de arrendamiento', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/Contrato%20de%20arrendamiento.doc', '2019-10-07 15:38:49', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('52', '4', 'Contrato subarrendamiento', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/Contrato%20de%20subarrendamiento.doc', '2019-10-07 15:39:31', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('53', '4', 'Contrato servicios prefesionales', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/Contrato%20Servicios%20Profesionales.doc', '2019-10-07 15:41:11', '2019-10-07 15:41:33', '2', '2');
INSERT INTO `submenu_documentos` VALUES ('54', '4', 'Formato de solicitud FIEL', 'ftp://ftp2.sat.gob.mx/asistencia_servicio_ftp/publicaciones/solcedi/solfea.pdf', '2019-10-07 15:44:05', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('55', '4', 'Contrato de arrendamiento financiero', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/Contrato%20Arrendamiento%20Financiero.doc', '2019-10-07 15:48:43', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('56', '4', 'Contrato comisión mercantil', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/Contrato%20Comision%20Mercantil.doc', '2019-10-07 15:49:21', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('57', '4', 'Modelo constitución de S.A.', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Contratos/Modelo%20Constitucion%20de%20SA.doc', '2019-10-07 15:50:49', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('58', '4', 'Escrito renuncia voluntaria', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Escritos/Renuncia%20Voluntaria.doc', '2019-10-07 15:52:46', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('59', '4', 'Solicitud de constancia de sueldo', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Escritos/FORMATO_SOL_DEC_PF.doc', '2019-10-07 15:53:14', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('60', '4', 'Formato de vacaciones', 'http://cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Escritos/formato%20vacaciones.xls', '2019-10-07 15:53:43', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('61', '4', 'Formato CLEM-01 IMSS', 'http://www.cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Formatos/Formatos%20del%20IMSS/clem01.pdf', '2019-10-07 15:55:40', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('62', '4', 'Formato AFIL-01 IMSS', 'http://www.cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Formatos/Formatos%20del%20IMSS/afil01.pdf', '2019-10-07 15:56:18', null, '2', null);
INSERT INTO `submenu_documentos` VALUES ('63', '4', 'Formato AFIL-02 IMSS', 'http://www.cofessa.com.mx/pdf/Escritos%2c%20Contratos%20y%20formatos/Formatos/Formatos%20del%20IMSS/afil02.pdf', '2019-10-07 15:59:45', null, '2', null);

-- ----------------------------
-- Table structure for submenu_enlaces_interes
-- ----------------------------
DROP TABLE IF EXISTS `submenu_enlaces_interes`;
CREATE TABLE `submenu_enlaces_interes` (
  `submenu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned NOT NULL,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`submenu_id`),
  KEY `creado_por` (`creado_por`) USING BTREE,
  KEY `actualizado_por` (`actualizado_por`) USING BTREE,
  KEY `menu_id` (`menu_id`) USING BTREE,
  CONSTRAINT `submenu_enlaces_interes_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `submenu_enlaces_interes_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `submenu_enlaces_interes_ibfk_3` FOREIGN KEY (`menu_id`) REFERENCES `menu_enlaces_interes` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of submenu_enlaces_interes
-- ----------------------------
INSERT INTO `submenu_enlaces_interes` VALUES ('1', '1', 'Avisos en ceros SAT', 'https://loginda.siat.sat.gob.mx/nidp/wsfed/ep?id=ciec&sid=0&option=credential&sid=0', '2019-09-26 22:32:24', '2019-10-07 01:44:40', '1', '2');
INSERT INTO `submenu_enlaces_interes` VALUES ('2', '1', 'Consulta transacciones SAT', 'https://www.consulta.sat.gob.mx/_mem_bin/FormsLogin.asp?/consultatransaccion/', '2019-10-03 00:10:22', '2019-10-07 01:45:02', '1', '2');
INSERT INTO `submenu_enlaces_interes` VALUES ('3', '1', 'Puntuación de infonavit', 'https://micuenta.infonavit.org.mx/wps/portal/mci2/login/!ut/p/z1/04_Sj9CPykssy0xPLMnMz0vMAfIjo8ziDVCAo4FTkJGTsYGBu7OJfjghBVEY0sgKgfqjwEqMzBxNnJwMHQ0s3IKdDBwdA4MN3b1CDNx9jaEK8JhRkBthkOmoqAgAXY6VvA!!/dz/d5/L2dBISEvZ0FBIS9nQSEh/', '2019-10-03 00:13:26', '2019-10-07 01:45:55', '1', '2');
INSERT INTO `submenu_enlaces_interes` VALUES ('4', '1', 'Citas SAT', 'https://citas.sat.gob.mx/citasat/agregarcita.aspx', '2019-10-07 16:09:46', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('5', '1', 'Corrección pagos SAT', 'https://www.correccion.sat.gob.mx/_mem_bin/FormsLogin.asp?/CorreccionInternet/Correcciones.asp', '2019-10-07 16:10:24', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('6', '1', 'Clave CURP', 'https://www.gob.mx/curp/', '2019-10-07 16:13:08', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('7', '2', 'Registro actividades vulnerables', 'https://sppld.sat.gob.mx/sppld/faces/LoginApplet.jsf?_adf.ctrl-state=vkhf92heo_7', '2019-10-07 16:14:36', '2019-10-07 16:15:03', '2', '2');
INSERT INTO `submenu_enlaces_interes` VALUES ('8', '2', 'Factura electrónica PEGASO', 'https://pegasotecnologiacfdi.net/ServAdmEmisionPROD/Acceso.aspx', '2019-10-07 16:16:07', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('9', '2', 'Anual asalariados', 'https://www.siat.sat.gob.mx/PTSC/', '2019-10-07 16:16:27', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('10', '2', 'IDSE IMSS', 'http://idse.imss.gob.mx/imss/', '2019-10-07 16:17:16', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('11', '2', 'SOLCEDI', 'https://portalsat.plataforma.sat.gob.mx/solcedi/', '2019-10-07 16:18:47', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('12', '2', 'TRALIX facturas', 'https://boveda.misfacturas.net/', '2019-10-07 16:19:15', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('13', '3', 'Reimpresión de acuses', 'https://www.acuse.sat.gob.mx/_mem_bin/FormsLogin.asp?/ReimpresionInternet/REIMDefault.htm', '2019-10-07 16:19:56', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('14', '3', 'CIF SAT', 'https://rfc.siat.sat.gob.mx/PTSC/RFC/menu/', '2019-10-07 16:21:09', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('15', '3', 'Envío de DIOT', 'https://tramitesdigitales.sat.gob.mx/InformativaDeTerceros.Internet/Login.aspx?ReturnUrl=%2fInformativaDeTerceros.Internet%2fDefault.aspx', '2019-10-07 16:22:07', '2019-10-07 16:25:15', '2', '2');
INSERT INTO `submenu_enlaces_interes` VALUES ('16', '3', 'Solicitud de Número de Seguro Social', 'https://serviciosdigitales.imss.gob.mx/gestionAsegurados-web-externo/asignacionNSS;JSESSIONIDASEGEXTERNO=wbIJLjl78Odrl7ZW3Wqiy8I5TXErz18rJ1RJNZa6Mm3IWge7QtvZ!1468337648', '2019-10-07 16:22:51', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('17', '3', 'CertiSAT', 'https://portalsat.plataforma.sat.gob.mx/certisat/index.jsp', '2019-10-07 16:26:32', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('18', '3', 'Alta patronal', 'http://imss.gob.mx/imssdigital', '2019-10-07 16:27:06', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('19', '4', 'Validador XML firma electrónica', 'https://ceportalvalidacionprod.clouda.sat.gob.mx/', '2019-10-07 16:28:49', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('20', '4', 'Mis cuentas RIF', 'https://rfs.siat.sat.gob.mx/PTSC/RFS/menu/', '2019-10-07 16:29:17', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('21', '4', 'Impuesto sobre nóminas (ISN)', 'http://www.pagafacil.gob.mx/bancomer/declara/declara.php', '2019-10-07 16:30:08', '2019-10-07 16:31:00', '2', '2');
INSERT INTO `submenu_enlaces_interes` VALUES ('22', '4', 'SIPARE (IMSS)', 'http://sipare.imss.gob.mx/sipare_webapp/index.jsp', '2019-10-07 16:32:10', '2019-10-07 16:35:19', '2', '2');
INSERT INTO `submenu_enlaces_interes` VALUES ('23', '4', 'Requerimientos infonavit', 'https://empresarios.infonavit.org.mx/wps/portal', '2019-10-07 16:32:49', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('24', '4', 'Recuperación CFDIs', 'https://cfdiau.sat.gob.mx/nidp/app/login?id=SATUPCFDiCon&sid=5&option=credential&sid=5', '2019-10-07 16:36:19', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('25', '5', 'Estado de Cuenta Infonavit', 'https://micuenta.infonavit.org.mx/wps/portal/mci2/login/', '2019-10-07 16:38:57', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('26', '5', '¿Cuánto debo de crédito infonavit?', 'http://portal.infonavit.org.mx/wps/wcm/connect/infonavit/trabajadores/cuanto_debo_de_mi_credito/cuanto+debo+de+mi+credito', '2019-10-07 16:39:53', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('27', '5', 'Opinión fiscal 32-D', 'https://siat.sat.gob.mx/PTSC/', '2019-10-07 16:40:26', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('28', '5', 'Chat 1 a 1 SAT', 'http://chatsat.mx/', '2019-10-07 16:40:53', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('29', '5', 'Validar CFDI', 'https://verificacfdi.facturaelectronica.sat.gob.mx/', '2019-10-07 16:42:05', null, '2', null);
INSERT INTO `submenu_enlaces_interes` VALUES ('30', '5', 'Buzón tributario', 'https://www.siat.sat.gob.mx/PTSC/', '2019-10-07 16:42:40', null, '2', null);

-- ----------------------------
-- Table structure for tbl_datos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_datos`;
CREATE TABLE `tbl_datos` (
  `dato_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `valor` double(7,4) NOT NULL,
  `publicacion` date NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`dato_id`),
  KEY `fk__datos__creado_por` (`creado_por`) USING BTREE,
  KEY `fk__datos__actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `tbl_datos_ibfk_1` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `tbl_datos_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_datos
-- ----------------------------
INSERT INTO `tbl_datos` VALUES ('1', 'TIIE-28', '8.2000', '2019-09-13', '2019-09-19 14:17:55', '2019-09-27 20:15:21', '1', '1');
INSERT INTO `tbl_datos` VALUES ('2', 'Tasa Objetivo', '8.0000', '2019-09-16', '2019-09-19 15:02:06', '2019-09-27 20:16:45', '1', '1');
INSERT INTO `tbl_datos` VALUES ('3', 'CETES 28', '7.7200', '2019-09-10', '2019-09-22 14:27:17', '2019-09-27 20:19:12', '1', '1');
INSERT INTO `tbl_datos` VALUES ('4', 'Costo promedio ponderado', '6.5800', '2019-08-26', '2019-09-27 20:30:54', '2019-09-27 20:34:33', '1', '1');
INSERT INTO `tbl_datos` VALUES ('5', '% Recargos plazo', '0.9800', '2019-01-01', '2019-09-27 20:32:20', '2019-10-05 23:56:06', '1', '2');
INSERT INTO `tbl_datos` VALUES ('6', '% Recargos moratorios', '1.4700', '2019-01-01', '2019-09-27 20:35:32', '2019-10-05 23:56:39', '1', '2');

-- ----------------------------
-- Table structure for tbl_indicadores
-- ----------------------------
DROP TABLE IF EXISTS `tbl_indicadores`;
CREATE TABLE `tbl_indicadores` (
  `indicador_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `valor` decimal(7,4) NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`indicador_id`),
  KEY `fk__indicadores__creado_por` (`creado_por`) USING BTREE,
  KEY `fk__indicadores__actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `tbl_indicadores_ibfk_1` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `tbl_indicadores_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_indicadores
-- ----------------------------
INSERT INTO `tbl_indicadores` VALUES ('1', 'Dólar DOF 19/Sep/19', '19.3528', '2019-09-18 23:33:41', '2019-10-05 23:49:56', '1', '2');

-- ----------------------------
-- Table structure for tbl_salarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_salarios`;
CREATE TABLE `tbl_salarios` (
  `salario_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vigencia` date NOT NULL,
  `valor_a` decimal(7,4) NOT NULL,
  `valor_b` decimal(7,4) NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`salario_id`),
  KEY `fk__salarios__creado_por` (`creado_por`) USING BTREE,
  KEY `fk__salarios__actualizdo_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `tbl_salarios_ibfk_1` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `tbl_salarios_ibfk_2` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tbl_salarios
-- ----------------------------
INSERT INTO `tbl_salarios` VALUES ('1', '2019-01-01', '102.6000', '102.6000', '2019-09-22 14:41:04', '2019-10-05 23:57:44', '1', '2');

-- ----------------------------
-- Table structure for tipos_operaciones
-- ----------------------------
DROP TABLE IF EXISTS `tipos_operaciones`;
CREATE TABLE `tipos_operaciones` (
  `tipo_operacion_id` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `desc` varchar(22) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`tipo_operacion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of tipos_operaciones
-- ----------------------------
INSERT INTO `tipos_operaciones` VALUES ('1', 'CONFIRMAR_CORREO');
INSERT INTO `tipos_operaciones` VALUES ('2', 'CONFIRMAR_CONTRASENIA');
INSERT INTO `tipos_operaciones` VALUES ('3', 'BORRAR_CUENTA');
INSERT INTO `tipos_operaciones` VALUES ('4', 'RECUPERAR_CUENTA');

-- ----------------------------
-- Table structure for urls_actualidades
-- ----------------------------
DROP TABLE IF EXISTS `urls_actualidades`;
CREATE TABLE `urls_actualidades` (
  `actualidad_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`actualidad_id`),
  KEY `creado_por` (`creado_por`) USING BTREE,
  KEY `actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `urls_actualidades_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `urls_actualidades_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of urls_actualidades
-- ----------------------------
INSERT INTO `urls_actualidades` VALUES ('2', 'Salario mínimo 2019', 'https://salariominimo2018mexico.com/tabla-de-salarios-minimos-generales-y-profesionales-mexico-2019/', '2019-10-06 00:03:08', '2019-10-06 20:10:24', '2', '2');
INSERT INTO `urls_actualidades` VALUES ('3', 'Reformas fiscales 2019', 'https://www.fiscalia.com/modules.php?name=Content&pa=showpage&pid=143', '2019-10-06 00:03:37', '2019-10-06 20:13:32', '2', '2');
INSERT INTO `urls_actualidades` VALUES ('4', 'Días festivos 2019', 'http://www.dias-festivos-mexico.com.mx/2019-mexico/', '2019-10-06 20:14:43', null, '2', null);
INSERT INTO `urls_actualidades` VALUES ('5', 'Buscador Conceptos CFDI 3.3', 'http://200.57.3.46:443/PyS/catPyS.aspx', '2019-10-06 20:16:11', null, '2', null);
INSERT INTO `urls_actualidades` VALUES ('6', 'Catálogos SAT Excel CFDI 3.3', 'http://www.sat.gob.mx/informacion_fiscal/factura_electronica/Documents/catCFDI.xls', '2019-10-06 20:16:56', null, '2', null);

-- ----------------------------
-- Table structure for urls_publicaciones
-- ----------------------------
DROP TABLE IF EXISTS `urls_publicaciones`;
CREATE TABLE `urls_publicaciones` (
  `publicacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`publicacion_id`),
  KEY `creado_por` (`creado_por`) USING BTREE,
  KEY `actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `urls_publicaciones_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `urls_publicaciones_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of urls_publicaciones
-- ----------------------------
INSERT INTO `urls_publicaciones` VALUES ('2', 'Recurso revocación en línea', 'http://imcp.org.mx/wp-content/uploads/2016/01/RESE%C3%91A-NOTICIAS-FISCALES-17.pdf', '2019-10-06 00:04:59', '2019-10-06 20:20:56', '2', '2');
INSERT INTO `urls_publicaciones` VALUES ('3', 'Decreto infonavit inscripción', 'http://imcp.org.mx/wp-content/uploads/2017/09/RESE%C3%91A-NOTICIAS-CROSS-4-IMSS.pdf', '2019-10-06 00:06:03', '2019-10-06 20:22:22', '2', '2');
INSERT INTO `urls_publicaciones` VALUES ('4', 'Síntesis Informativa Fiscal', 'http://imcp.org.mx/wp-content/uploads/2018/01/Enero9.pdf', '2019-10-06 20:23:16', null, '2', null);
INSERT INTO `urls_publicaciones` VALUES ('5', 'Aspectos Fiscales', 'http://contaduriapublica.org.mx/aspectos-fiscales/', '2019-10-06 20:26:24', null, '2', null);
INSERT INTO `urls_publicaciones` VALUES ('6', 'Tablas Vigentes ISR 2018', 'http://www.sat.gob.mx/informacion_fiscal/tablas_indicadores/Documents/Tarifas_pprov_retenciones_2018', '2019-10-06 20:28:34', null, '2', null);

-- ----------------------------
-- Table structure for urls_publicaciones_dof
-- ----------------------------
DROP TABLE IF EXISTS `urls_publicaciones_dof`;
CREATE TABLE `urls_publicaciones_dof` (
  `publicacion_dof_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `creacion` datetime NOT NULL,
  `actualizacion` datetime DEFAULT NULL,
  `creado_por` int(10) unsigned NOT NULL,
  `actualizado_por` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`publicacion_dof_id`),
  KEY `creado_por` (`creado_por`) USING BTREE,
  KEY `actualizado_por` (`actualizado_por`) USING BTREE,
  CONSTRAINT `urls_publicaciones_dof_ibfk_1` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `urls_publicaciones_dof_ibfk_2` FOREIGN KEY (`actualizado_por`) REFERENCES `usuarios` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of urls_publicaciones_dof
-- ----------------------------
INSERT INTO `urls_publicaciones_dof` VALUES ('2', 'Resolución miscelánea fiscal 2019', 'https://www.sat.gob.mx/normatividad/60276/resolucion-miscelanea-fiscal-', '2019-10-06 00:08:03', '2019-10-06 23:32:01', '2', '2');
INSERT INTO `urls_publicaciones_dof` VALUES ('3', 'Anexo 16 RMF 2019', 'http://file///C:/Users/SALVADOR/Downloads/RMF_2019_ANEXO16_100519.pdf', '2019-10-06 00:08:48', '2019-10-06 23:32:44', '2', '2');
INSERT INTO `urls_publicaciones_dof` VALUES ('4', 'Anexo 15 RMF 2019', 'http://file///C:/Users/SALVADOR/Downloads/RMF_2019_ANEXO15_060519.pdf', '2019-10-06 23:33:28', null, '2', null);
INSERT INTO `urls_publicaciones_dof` VALUES ('5', 'Anexo 14 RMF 2019', 'https://www.sat.gob.mx/cs/Satellite?blobcol=urldata&blobkey=id&blobtable=MungoBlobs&blobwhere=1461173688237&ssbinary=true', '2019-10-06 23:33:59', null, '2', null);
INSERT INTO `urls_publicaciones_dof` VALUES ('6', 'Ejemplar de hoy', 'http://dof.gob.mx/index.php', '2019-10-06 23:34:42', null, '2', null);

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `usuario_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `contra` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(10) unsigned NOT NULL,
  `token_sesion` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_activacion` datetime DEFAULT NULL,
  `fecha_eliminacion` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `users_email_unique` (`correo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'gpaaan', 'gpaaan@gmx.net', '$2y$10$9jrPZ.P/hH2f9kMUMqgxRuUAWLvBNnx06G9jFr22ZTBSLWjxllo8a', '0', '3bwjBDVdgS09KsKKY02r2J0O32sjVQwIfyGGlxdmOJTTPQIpxlJ04IVMe1xd', '2019-02-06 22:25:09', '2020-02-25 14:41:30', '2019-03-08 22:17:09', null);
INSERT INTO `usuarios` VALUES ('2', 'nrmiatze', 'nrmiatze@gmx.net', '$2y$10$aUb40UCTyUKNTmN8G/rIgevesfE9DZZwB5HrbNEG5HxNBuRWyZEEC', '0', 'QlJqMQTLfGc1ltJs3sUMPqnQfokpsqBwNdie96MsqIpsW0wHBqal8XcO3YMZ', '2019-10-04 22:16:44', '2019-10-05 00:10:01', '2019-10-05 00:10:01', null);
