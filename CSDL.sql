drop database EDM;

create database EDM;
use EDM;
create table Admin
(
	AdminID int(11),
    NameAdmin varchar(255),
    AdminName varchar(50) PRIMARY KEY,
    AdminPassword varchar(50),
    Phone varchar(20),
    Active tinyint(1),
    Datetime datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
);

create table Catalog
(
    CatalogName varchar(255) primary key,
    Ordinal int(11)
);

create table Posts
(
	PostID int(11) primary key AUTO INCREMENT,
    AdminName varchar(50),
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
    foreign key (AdminName) references Admin(AdminName),
    foreign key (CatalogName) references Catalog(CatalogName)
);

create table Album
(
	AlbumID int(11) primary key AUTO INCREMENT,
    AlbumName varchar(50),
    Singer varchar(50),
    Active TINYINT(1)
);



create table Music
(
	MusicID int(11) primary key AUTO INCREMENT,
    AlbumID int(11),
    MusicName varchar(255) ,
    Ulrmusic varchar(1000),
    Composer varchar(255),
    Active TINYINT(1),
    DateMusic datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    foreign key (AlbumID) references Album(AlbumID)
);

INSERT INTO `admin` (`AdminID`, `NameAdmin`, `AdminName`, `AdminPassword`, `Phone`, `Active`, `Datetime`) VALUES ('17043', 'Ho Duc Hieu', 'sonlicha', '123', '0965745034', '1', CURRENT_TIMESTAMP);
INSERT INTO `catalog` (`CatalogName`, `Ordinal`) VALUES ('NEWS', '1'), ('BLOG', '2');

