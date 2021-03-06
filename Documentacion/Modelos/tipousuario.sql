/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 12.1 		*/
/*  Created On : 29-abr.-2017 11:46:11 a. m. 				*/
/*  DBMS       : PostgreSQL 						*/
/* ---------------------------------------------------- */

/* Drop Sequences for Autonumber Columns */

DROP SEQUENCE IF EXISTS stipousuario_pktipousuario_seq
;

/* Drop Tables */

DROP TABLE IF EXISTS stipousuario CASCADE
;

/* Create Tables */

CREATE TABLE stipousuario
(
	pktipousuario smallint NOT NULL   DEFAULT NEXTVAL(('"stipousuario_pktipousuario_seq"'::text)::regclass),
	codigo char(3) NOT NULL,
	descripcion varchar(25) NOT NULL
)
;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE stipousuario ADD CONSTRAINT PK_stipousuario
	PRIMARY KEY (pktipousuario)
;

/* Create Table Comments, Sequences for Autonumber Columns */

CREATE SEQUENCE stipousuario_pktipousuario_seq INCREMENT 1 START 1
;
