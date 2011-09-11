-- Szerver verzió: 5.1.37
-- PHP verzió: 5.3.0

-- Adatbázis feltöltése mintaadatokkal

USE autosiskola;
SET NAMES utf8;

DELETE FROM helyszin;
DELETE FROM elozmeny;
DELETE FROM tanfolyam;
DELETE FROM akt_tanfolyam_ido;
DELETE FROM akt_tanfolyam;
DELETE FROM tanfolyam_jelentkezes;
DELETE FROM vizsga;
DELETE FROM akt_vizsga;
DELETE FROM vizsga_jelentkezes;

-- További minta felhasználók
INSERT INTO felhasznalok VALUES("2","n_bela","030bd260a93e44b08129647027961165","1","Nagy Béla","bela@bela.hu","123456","Decs","A u. 5","");
INSERT INTO felhasznalok VALUES("3","k_ferenc","92744baccc2c9c28d9f862d99eec6630","2","Kis Ferenc","ferenc@bela.hu","123456","Decs","A u. 5","");
INSERT INTO felhasznalok VALUES("4","t_pista","3b91295f83cf548ebd3dbf7a3811d8c6","1","Terep István","pista@bela.hu","123456","Decs","A u. 5","");
INSERT INTO felhasznalok VALUES("5","o_gabi","1b26226f7d439d388037c8e8eaa62d39","2","Orsós Gábor","gabi@bela.hu","123456","Decs","A u. 5","");

-- Helyszinkód
INSERT INTO helyszin VALUES("1","Szekszárd","Kölcsei lakótelep 3","1");
INSERT INTO helyszin VALUES("2","Szekszárd","Mór V. lakótelep 2","2");

-- Előzmények tábla feltöltése
INSERT INTO elozmeny VALUES("1","18 életév");

-- Tanfolyamok felvétele
INSERT INTO tanfolyam VALUES("1","Elsősegély");
INSERT INTO tanfolyam VALUES("2","Kressz");

-- Aktuális tanfolyamok felvétele
INSERT INTO akt_tanfolyam VALUES("1","1","25","20000","0","1");
INSERT INTO akt_tanfolyam VALUES("2","2","50","10000","10","1");

-- Akt tanfolyam idő
INSERT INTO akt_tanfolyam_ido VALUES("1","1","Hétfő 10:00-11:30","3","1");
INSERT INTO akt_tanfolyam_ido VALUES("2","1","Szerda 10:00-11:30","5","2");
INSERT INTO akt_tanfolyam_ido VALUES("3","2","Kedd 10:00-11:30","3","1");

-- Jelentkezések rá
INSERT INTO tanfolyam_jelentkezes VALUES("1","2","folyamatban","törlesztve","","","2011.02.13 20:11:00");
INSERT INTO tanfolyam_jelentkezes VALUES("2","4","folyamatban","folyamatban","","","");
INSERT INTO tanfolyam_jelentkezes VALUES("2","2","folyamatban","törlesztve","","","2011.02.13 20:11:00");

-- Vizsgák felvétele
INSERT INTO vizsga VALUES("1","Elsősegély");
INSERT INTO vizsga VALUES("2","Kressz");
INSERT INTO vizsga VALUES("3","Városi");

-- Aktuális vizsgák felvétele
INSERT INTO akt_vizsga VALUES("1","1","1","2011.05.10 09:00","3","5","25","20000","0","1");
INSERT INTO akt_vizsga VALUES("2","2","2","2011.05.11 10:00","5","3","50","10000","10","1");
INSERT INTO akt_vizsga VALUES("3","3","1","2011.05.11 12:00","5","3","1","7500","10","1");

-- Jelentkezések rá
INSERT INTO vizsga_jelentkezes VALUES("1","2","folyamatban","folyamatban","","","");
INSERT INTO vizsga_jelentkezes VALUES("2","4","folyamatban","törlesztve","","","2011..02.14 19:11:00");