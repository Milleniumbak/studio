/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 12.1 		*/
/*  Created On : 26-ene-2017 03:24:18 p.m. 				*/
/*  DBMS       : PostgreSQL 						*/
/* ---------------------------------------------------- */

/* Drop Tables */

DROP TABLE IF EXISTS cart CASCADE
;

/* Create Tables */

CREATE TABLE cart
(
	sessionId varchar(50) NOT NULL,
	cartData varchar(100) NULL
)
;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE cart ADD CONSTRAINT PK_Cart
	PRIMARY KEY (sessionId)
;
