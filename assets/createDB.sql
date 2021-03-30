--Use to create database for this page
CREATE DATABASE personal_web_page;

CREATE TABLE users (
    uuid int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    email varchar(256),
    username varchar(256),
    password varchar(256)
);

CREATE TABLE blog_posts (
    upid int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    title varchar(1024),
    text text
)