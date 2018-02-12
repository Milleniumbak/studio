DROP TABLE IF EXISTS "sautorizacion" CASCADE;

CREATE TABLE "sautorizacion"
(
	"token" varchar(155)	 NOT NULL,
	"topic" varchar(50)	 NOT NULL,
	"imei_device" varchar(50)	 NOT NULL,
	"fkusuario" integer NOT NULL,
	"fecha_registro" timestamp NOT NULL,
	CONSTRAINT token_key PRIMARY KEY (token)
);
