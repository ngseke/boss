CREATE DATABASE BOSS default character set utf8 collate utf8_general_ci;
SET NAMES utf8;
USE BOSS;

CREATE TABLE MEMBER(
  ID VARCHAR(30) PRIMARY KEY,
  Password VARCHAR(20) NOT NULL,
  Email VARCHAR(50) NOT NULL,
  Phone VARCHAR(10) NOT NULL,
  RegDate TIMESTAMP,
  Birth DATETIME,
  Gender ENUM('M', 'F', 'N'),
  Address VARCHAR(100),
  Position ENUM('S', 'A', 'C') NOT NULL
);
