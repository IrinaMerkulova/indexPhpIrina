CREATE TABLE valitsus(
                         id INT Primary key AUTO_INCREMENT,
                         valitsuseSeis varchar(50),
                         punktid int default 0,
                         kommentaarid TEXT default ' ',
                         lisamisKuupaev date,
                         avalik int default 1);
INSERT INTO valitsus(valitsuseSeis, lisamisKuupaev)
Values('Juku Miku 1.valitsus', '2024-05-02');
INSERT INTO valitsus(valitsuseSeis, lisamisKuupaev)
Values('Juku Miku 5.valitsus', '2024-04-02');
https://meet.google.com/gyv-xztq-fbx