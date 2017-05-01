/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 12.1 		*/
/*  Created On : 29-abr.-2017 11:06:50 p. m. 				*/
/*  DBMS       : PostgreSQL 						*/
/* ---------------------------------------------------- */

/* Drop Sequences for Autonumber Columns */

DROP SEQUENCE IF EXISTS scompra_pkcompra_seq
;

DROP SEQUENCE IF EXISTS scompraimpresa_pkcompraimpresa_seq
;

DROP SEQUENCE IF EXISTS sdimension_pkdimension_seq
;

DROP SEQUENCE IF EXISTS stipopapel_pktipopapel_seq
;

/* Drop Tables */

DROP TABLE IF EXISTS scompra CASCADE
;

DROP TABLE IF EXISTS scompraimpresa CASCADE
;

DROP TABLE IF EXISTS sdimension CASCADE
;

DROP TABLE IF EXISTS stipopapel CASCADE
;

/* Create Tables */

CREATE TABLE scompra
(
	pkcompra integer NOT NULL   DEFAULT NEXTVAL(('"scompra_pkcompra_seq"'::text)::regclass),
	fecha timestamp NOT NULL,
	fkusuario integer NOT NULL,
	fkevent integer NOT NULL
)
;

CREATE TABLE scompraimpresa
(
	pkcompraimpresa integer NOT NULL   DEFAULT NEXTVAL(('"scompraimpresa_pkcompraimpresa_seq"'::text)::regclass),
	fkcompra integer NOT NULL,
	item integer,
	fkimgevent integer NOT NULL,
	cantidad smallint,
	precio decimal(10,2),
	fktipopapel smallint,
	fkdimension smallint,
	tipocompra integer
)
;

CREATE TABLE sdimension
(
	pkdimension smallint NOT NULL   DEFAULT NEXTVAL(('"sdimension_pkdimension_seq"'::text)::regclass),
	codigo varchar(25),
	descripcion varchar(50),
	precio decimal(10,2)
)
;

CREATE TABLE stipopapel
(
	pktipopapel smallint NOT NULL   DEFAULT NEXTVAL(('"stipopapel_pktipopapel_seq"'::text)::regclass),
	codigo varchar(25),
	descripcion varchar(50),
	precio decimal(10,2)
)
;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE scompra ADD CONSTRAINT PK_scompra
	PRIMARY KEY (pkcompra)
;

CREATE INDEX IXFK_scompra_seventosocial ON scompra (fkevent ASC)
;

CREATE INDEX IXFK_scompra_susuario ON scompra (fkusuario ASC)
;

ALTER TABLE scompraimpresa ADD CONSTRAINT PK_scompraimpresa
	PRIMARY KEY (pkcompraimpresa)
;

CREATE INDEX IXFK_scompraimpresa_scompra ON scompraimpresa (fkcompra ASC)
;

CREATE INDEX IXFK_scompraimpresa_sdimension ON scompraimpresa (fkdimension ASC)
;

CREATE INDEX IXFK_scompraimpresa_simgevent ON scompraimpresa (fkimgevent ASC)
;

CREATE INDEX IXFK_scompraimpresa_stipopapel ON scompraimpresa (fktipopapel ASC)
;

ALTER TABLE sdimension ADD CONSTRAINT PK_sdimension
	PRIMARY KEY (pkdimension)
;

ALTER TABLE stipopapel ADD CONSTRAINT PK_stipopapel
	PRIMARY KEY (pktipopapel)
;

/* Create Foreign Key Constraints */

ALTER TABLE scompra ADD CONSTRAINT FK_scompra_seventosocial
	FOREIGN KEY (fkevent) REFERENCES seventosocial (pkevento) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE scompra ADD CONSTRAINT FK_scompra_susuario
	FOREIGN KEY (fkusuario) REFERENCES susuario (pkusuario) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE scompraimpresa ADD CONSTRAINT FK_scompraimpresa_sdimension
	FOREIGN KEY (fkdimension) REFERENCES sdimension (pkdimension) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE scompraimpresa ADD CONSTRAINT FK_scompraimpresa_simgevent
	FOREIGN KEY (fkimgevent) REFERENCES simgevent (pkimgevent) ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE scompraimpresa ADD CONSTRAINT FK_scompraimpresa_stipopapel
	FOREIGN KEY (fktipopapel) REFERENCES stipopapel (pktipopapel) ON DELETE No Action ON UPDATE No Action
;

/* Create Table Comments, Sequences for Autonumber Columns */

CREATE SEQUENCE scompra_pkcompra_seq INCREMENT 1 START 1
;

CREATE SEQUENCE scompraimpresa_pkcompraimpresa_seq INCREMENT 1 START 1
;

CREATE SEQUENCE sdimension_pkdimension_seq INCREMENT 1 START 1
;

CREATE SEQUENCE stipopapel_pktipopapel_seq INCREMENT 1 START 1
;