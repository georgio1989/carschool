-- Szerver verzió: 5.1.37
-- PHP verzió: 5.3.0


DROP DATABASE if exists autosiskola;
CREATE DATABASE autosiskola CHARACTER SET utf8;
USE autosiskola;
SET NAMES utf8;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `akt_tanfolyam`
--

CREATE TABLE IF NOT EXISTS `akt_tanfolyam` (
  `t_azonosito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `t_kod` int(10) unsigned NOT NULL,
  `max_letszam` int(10) unsigned DEFAULT NULL,
  `ar` int(10) unsigned DEFAULT NULL,
  `kedvezmeny` int(10) unsigned DEFAULT NULL,
  `elozmenykod` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`t_azonosito`),
  KEY `akt_tanfolyam_FKIndex1` (`t_kod`),
  KEY `akt_tanfolyam_FKIndex2` (`elozmenykod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `akt_tanfolyam_ido`
--

CREATE TABLE IF NOT EXISTS `akt_tanfolyam_ido` (
  `azon` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `t_azonosito` int(10) unsigned NOT NULL,
  `idopont` varchar(40) NOT NULL,
  `oktato` int(10) unsigned DEFAULT NULL,
  `helyszinkod` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`azon`),
  KEY `akt_tanfolyam_ido_FKIndex1` (`t_azonosito`),
  KEY `akt_tanfolyam_ido_FKIndex2` (`oktato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `akt_vizsga`
--

CREATE TABLE IF NOT EXISTS `akt_vizsga` (
  `v_azonosito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_kod` int(10) unsigned DEFAULT NULL,
  `helyszinkod` int(10) unsigned DEFAULT NULL,
  `idopont` datetime DEFAULT NULL,
  `vizsgaztato` int(10) unsigned DEFAULT NULL,
  `felugyelo` int(10) unsigned DEFAULT NULL,
  `max_letszam` int(10) unsigned DEFAULT NULL,
  `ar` int(10) unsigned DEFAULT NULL,
  `kedvezmeny` int(10) unsigned DEFAULT NULL,
  `elozmenykod` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`v_azonosito`),
  KEY `akt_vizsga_FKIndex1` (`v_kod`),
  KEY `akt_vizsga_FKIndex2` (`helyszinkod`),
  KEY `akt_vizsga_FKIndex3` (`vizsgaztato`),
  KEY `akt_vizsga_FKIndex4` (`felugyelo`),
  KEY `akt_vizsga_FKIndex5` (`elozmenykod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `elozmeny`
--

CREATE TABLE IF NOT EXISTS `elozmeny` (
  `elozmenykod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `elozmeny_megnev` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`elozmenykod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `felhasznalok`
--

CREATE TABLE IF NOT EXISTS `felhasznalok` (
  `azonosito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `felhaszn_nev` varchar(50) NOT NULL,
  `jelszo` varchar(32) NOT NULL,
  `jog` int(10) NOT NULL,
  `teljes_nev` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefon` VARCHAR(11) DEFAULT NULL,
  `telepules` varchar(80) DEFAULT NULL,
  `utca_hsz` varchar(80) DEFAULT NULL,
  `utolso_belepes` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`azonosito`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `helyszin`
--

CREATE TABLE IF NOT EXISTS `helyszin` (
  `helyszinkod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `telepules` varchar(80) DEFAULT NULL,
  `utca_hsz` varchar(80) DEFAULT NULL,
  `terem` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`helyszinkod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `meglevo_elozmenyek`
--

CREATE TABLE IF NOT EXISTS `meglevo_elozmenyek` (
  `azonosito` int(10) unsigned NOT NULL,
  `elozmenykod` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`azonosito`),
  KEY `meglevo_elozmenyek_FKIndex1` (`elozmenykod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `modulnev` varchar(50) DEFAULT NULL,
  `url` varchar(20) DEFAULT NULL,
  `jog` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `oldal_elemek`
--

CREATE TABLE IF NOT EXISTS `oldal_elemek` (
  `fejcim0` varchar(50) DEFAULT NULL,
  `fejcim1` varchar(50) DEFAULT NULL,
  `labszov` varchar(50) DEFAULT NULL,
  `feltetel` TEXT
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `tanfolyam`
--

CREATE TABLE IF NOT EXISTS `tanfolyam` (
  `t_kod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `t_nev` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`t_kod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `tanfolyam_jelentkezes`
--

CREATE TABLE IF NOT EXISTS `tanfolyam_jelentkezes` (
  `t_azonosito` int(10) unsigned NOT NULL,
  `azonosito` int(10) unsigned NOT NULL,
  `allapot` varchar(11) DEFAULT NULL,
  `torlesztes` varchar(11) DEFAULT NULL,
  `ertekelo` int(10) unsigned DEFAULT NULL,
  `mikor` datetime DEFAULT NULL,
  `t_ideje` datetime DEFAULT NULL,
  PRIMARY KEY (`t_azonosito`,`azonosito`),
  KEY `tanfolyam_jelentkezes_FKIndex1` (`t_azonosito`),
  KEY `tanfolyam_jelentkezes_FKIndex2` (`azonosito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `vizsga`
--

CREATE TABLE IF NOT EXISTS `vizsga` (
  `v_kod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `v_nev` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`v_kod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `vizsga_jelentkezes`
--

CREATE TABLE IF NOT EXISTS `vizsga_jelentkezes` (
  `v_azonosito` int(10) unsigned NOT NULL,
  `azonosito` int(10) unsigned NOT NULL,
  `allapot` varchar(11) DEFAULT NULL,
  `torlesztes` varchar(11) DEFAULT NULL,
  `ertekelo` int(10) unsigned DEFAULT NULL,
  `mikor` datetime DEFAULT NULL,
  `t_ideje` datetime DEFAULT NULL,
  PRIMARY KEY (`v_azonosito`,`azonosito`),
  KEY `vizsga_jelentkezes_FKIndex1` (`v_azonosito`),
  KEY `vizsga_jelentkezes_FKIndex2` (`azonosito`),
  KEY `vizsga_jelentkezes_FKIndex3` (`azonosito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------
--
-- Tábla szerkezet: `hirek`
--

CREATE TABLE IF NOT EXISTS `hirek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cim` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `tartalom` text COLLATE utf8_hungarian_ci NOT NULL,
  `szerzo` int(11) NOT NULL,
  `mikor` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- --------------------------------------------------------

--
-- Megkötések a táblához `akt_tanfolyam`
--
ALTER TABLE `akt_tanfolyam`
  ADD CONSTRAINT `akt_tanfolyam_ibfk_1` FOREIGN KEY (`t_kod`) REFERENCES `tanfolyam` (`t_kod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akt_tanfolyam_ibfk_2` FOREIGN KEY (`elozmenykod`) REFERENCES `elozmeny` (`elozmenykod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `akt_tanfolyam_ido`
--
ALTER TABLE `akt_tanfolyam_ido`
  ADD CONSTRAINT `akt_tanfolyam_ido_ibfk_1` FOREIGN KEY (`t_azonosito`) REFERENCES `akt_tanfolyam` (`t_azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akt_tanfolyam_ido_ibfk_2` FOREIGN KEY (`oktato`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Megkötések a táblához `akt_vizsga`
--
ALTER TABLE `akt_vizsga`
  ADD CONSTRAINT `akt_vizsga_ibfk_1` FOREIGN KEY (`v_kod`) REFERENCES `vizsga` (`v_kod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akt_vizsga_ibfk_2` FOREIGN KEY (`helyszinkod`) REFERENCES `helyszin` (`helyszinkod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akt_vizsga_ibfk_3` FOREIGN KEY (`vizsgaztato`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akt_vizsga_ibfk_4` FOREIGN KEY (`felugyelo`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akt_vizsga_ibfk_5` FOREIGN KEY (`elozmenykod`) REFERENCES `elozmeny` (`elozmenykod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `meglevo_elozmenyek`
--
ALTER TABLE `meglevo_elozmenyek`
  ADD CONSTRAINT `meglevo_elozmenyek_ibfk_1` FOREIGN KEY (`elozmenykod`) REFERENCES `elozmeny` (`elozmenykod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `tanfolyam_jelentkezes`
--
ALTER TABLE `tanfolyam_jelentkezes`
  ADD CONSTRAINT `tanfolyam_jelentkezes_ibfk_1` FOREIGN KEY (`t_azonosito`) REFERENCES `akt_tanfolyam` (`t_azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tanfolyam_jelentkezes_ibfk_2` FOREIGN KEY (`azonosito`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `vizsga_jelentkezes`
--
ALTER TABLE `vizsga_jelentkezes`
  ADD CONSTRAINT `vizsga_jelentkezes_ibfk_1` FOREIGN KEY (`v_azonosito`) REFERENCES `akt_vizsga` (`v_azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vizsga_jelentkezes_ibfk_2` FOREIGN KEY (`azonosito`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vizsga_jelentkezes_ibfk_3` FOREIGN KEY (`azonosito`) REFERENCES `felhasznalok` (`azonosito`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
