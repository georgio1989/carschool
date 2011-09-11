-- Szerver verzió: 5.1.37
-- PHP verzió: 5.3.0

-- Adatbázis feltöltése a szükséges adatokkal

USE autosiskola;
SET NAMES utf8;
DELETE FROM menu;
DELETE FROM felhasznalok;
DELETE FROM oldal_elemek;

-- Oldal elemek beírása
INSERT INTO oldal_elemek VALUES("Üdvözöljük a Kis Boborján","autós iskola honlapján!","Made by Gyuri",
"
Nem viszek be érvénytelen adatokat!
"
);

-- Menü tábla adatainak felvitele
INSERT INTO menu VALUES("Kezdőlap","home","0");
INSERT INTO menu VALUES("Hírek","hirek","0");
INSERT INTO menu VALUES("Kapcsolat","kapcsolat","0");

-- Minta felhasználók felvitele
INSERT INTO felhasznalok VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3","5","Kis Boborján","admin@admin.hu","06304101992","Paks","Nagy A u. 5","");



