create table Pays (
    idPays int PRIMARY KEY,
    nom Varchar(20),
    groupe Varchar(1),
    points int
);

create table Match (
    idMatch int PRIMARY KEY,
    idP1 int,
    idp2 int,
    points1 int,
    points2 int,
    groupe Varchar(1),
    FOREIGN KEY (idP1) references Pays(idPays),
    FOREIGN KEY (idP2) references Pays(idPays)
);

create table tournoi (
    idTournoi int PRIMARY KEY,
    tdate date,
    nFinal int,
    idP1 int,
    idP2 int,
    points1 int,
    points2 int,
    FOREIGN KEY (idP1) references Pays(idPays),
    FOREIGN KEY (idP2) references Pays(idPays)
);

create sequence seqMatch;
create sequence seqTournoi;

insert into Pays values ( 1,'Qatar','A',0);
insert into Pays values ( 2,'Ecuator','A',0);
insert into Pays values ( 3,'Senegal','A',0);
insert into Pays values ( 4,'Netherlands','A',0);

insert into Pays values (5,'England','B',0);
insert into Pays values ( 6,'Iran','B',0);
insert into Pays values ( 7,'USA','B',0);
insert into Pays values ( 8,'Wales','B',0);

insert into Pays values ( 9,'Argentina','C',0);
insert into Pays values ( 10,'Saudi Arabia','C',0);
insert into Pays values ( 11,'Mexico','C',0);
insert into Pays values ( 12,'Poland','C',0);

insert into Pays values ( 13,'France','D',0);
insert into Pays values ( 14,'Australia','D',0);
insert into Pays values ( 15,'Danemark','D',0);
insert into Pays values ( 16,'Tunisia','D',0);

insert into Pays values ( 17,'Spain','E',0);
insert into Pays values ( 18,'Costa Rica','E',0);
insert into Pays values ( 19,'Germany','E',0);
insert into Pays values ( 20,'Japan','E',0);

insert into Pays values ( 21,'Belgium','F',0);
insert into Pays values ( 22,'Canada','F',0);
insert into Pays values ( 23,'Morroco','F',0);
insert into Pays values ( 24,'Croatia','F',0);

insert into Pays VALUES( 25,'Brazil','G',0);
insert into Pays VALUES( 26,'Serbia','G',0);
insert into Pays VALUES( 27,'Switzerland','G',0);
insert into Pays VALUES( 28,'Cameroon','G',0);

insert into Pays VALUES( 29,'Portugal','H',0);
insert into Pays VALUES( 30,'Ghana','H',0);
insert into Pays VALUES( 31,'Uruguay','H',0);
insert into Pays VALUES( 32,'Korea Republic','H',0);

drop table match;
drop table tournoi;
drop table pays;
drop sequence seqMatch;