drop database EDM;

create database EDM;
use EDM;
create table Admin
(
	AdminID int(11) primary key,
    NameAdmin varchar(255),
    AdminName varchar(50),
    AdminPassword varchar(50),
    Phone varchar(20),
    Active tinyint(1),
    Datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table Catalog
(
    CatalogName varchar(265) primary key,
    Ordinal int(11)
);



create table Music
(
	MusicID int(11) primary key,
    MusicName varchar(255) ,
    Ulrmusic varchar(255),
    Composer varchar(255),
    DateMusic datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table Album
(
	AlbumID int(11) primary key,
    MusicID int(11),
    AlbumName varchar(50),
    Singer varchar(50),
    foreign key (MusicID) references Music(MusicID)
);
create table Posts
(
	PostID int(11) primary key,
    AdminID int(11),
    CatalogName varchar(255),
    NamePost varchar(255),
    Brief varchar(1000),
    Img varchar(255),
    Content text,
    ViewNumber int(11),
    PostHot tinyint(1),
    ActivePost tinyint(1),
    DatePost datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    AuthorPost varchar(50),
    foreign key (AdminID) references Admin(AdminID),
    foreign key (CatalogName) references Catalog(CatalogName)
);

