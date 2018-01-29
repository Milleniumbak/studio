
DROP SEQUENCE IF EXISTS "scompra_pkcompra_seq";

DROP SEQUENCE IF EXISTS "sdimension_pkdimension_seq";

DROP SEQUENCE IF EXISTS "stipopapel_pktipopapel_seq";

/* Drop Tables */

DROP TABLE IF EXISTS "scompra" CASCADE;

DROP TABLE IF EXISTS "sdimension" CASCADE;

DROP TABLE IF EXISTS "stipopapel" CASCADE;

/* Create Tables */

CREATE TABLE "scompra"
(
	"pkcompra" integer NOT NULL DEFAULT nextval(('"scompra_pkcompra_seq"'::text)::regclass),
	"fkusuario" integer NOT NULL,
	"fkimgevent" integer NOT NULL,
	"cantidad" smallint NOT NULL,
	"precio" decimal(10,2) NOT NULL,
	"fktipopapel" smallint NULL,
	"fkdimension" smallint NULL,
	"tipocompra" integer NOT NULL
);

CREATE TABLE "sdimension"
(
	"pkdimension" smallint NOT NULL DEFAULT nextval(('"sdimension_pkdimension_seq"'::text)::regclass),
	"codigo" varchar(25)	 NULL,
	"descripcion" varchar(50)	 NULL,
	"precio" decimal(10,2) NULL
);

CREATE TABLE "stipopapel"
(
	"pktipopapel" smallint NOT NULL DEFAULT nextval(('"stipopapel_pktipopapel_seq"'::text)::regclass),
	"codigo" varchar(25)	 NULL,
	"descripcion" varchar(50)	 NULL,
	"precio" decimal(10,2) NULL
);

/* Create Table Comments, Sequences for Autonumber Columns */

CREATE SEQUENCE "scompra_pkcompra_seq" INCREMENT 1 START 1;

CREATE SEQUENCE "sdimension_pkdimension_seq" INCREMENT 1 START 1;

CREATE SEQUENCE "stipopapel_pktipopapel_seq" INCREMENT 1 START 1;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE "scompra" ADD CONSTRAINT "PK_scompraimpresa"
	PRIMARY KEY ("pkcompra")
;


ALTER TABLE "sdimension" ADD CONSTRAINT "PK_sdimension"
	PRIMARY KEY ("pkdimension")
;

ALTER TABLE "stipopapel" ADD CONSTRAINT "PK_stipopapel"
	PRIMARY KEY ("pktipopapel")
;

/* Create Foreign Key Constraints */

ALTER TABLE "scompra" ADD CONSTRAINT "FK_scompraimpresa_sdimension"
	FOREIGN KEY ("fkdimension") REFERENCES "sdimension" ("pkdimension") ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE "scompra" ADD CONSTRAINT "FK_scompraimpresa_simgevent"
	FOREIGN KEY ("fkimgevent") REFERENCES "simgevent" ("pkimgevent") ON DELETE No Action ON UPDATE No Action
;

ALTER TABLE "scompra" ADD CONSTRAINT "FK_scompraimpresa_stipopapel"
	FOREIGN KEY ("fktipopapel") REFERENCES "stipopapel" ("pktipopapel") ON DELETE No Action ON UPDATE No Action
;
