

CREATE TABLE `tbladdhealthstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tbladdlogo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tbladdofficeroftheday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `added_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbladdofficeroftheday VALUES("1","jeffern d. malinao","barangay kagawad","2024-01-05 00:01:47","system administrator");
INSERT INTO tbladdofficeroftheday VALUES("2","flor cabillar","barangay kagawad","2024-01-05 00:02:12","system administrator");
INSERT INTO tbladdofficeroftheday VALUES("3","clarish sargado","barangay kagawad","2024-01-05 00:02:27","system administrator");



CREATE TABLE `tbladdofficialsposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tbladdpurok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purok` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tbladdpurpose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purpose` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `author` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblannouncement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateofannouncement` datetime NOT NULL DEFAULT current_timestamp(),
  `announcement` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblannouncementphoto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcementid` varchar(10) NOT NULL,
  `filename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblblotter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `yearRecorded` varchar(5) NOT NULL,
  `dateRecorded` date NOT NULL,
  `datetimeRecorded` datetime NOT NULL DEFAULT current_timestamp(),
  `complainant` varchar(100) NOT NULL,
  `cage` varchar(3) NOT NULL,
  `caddress` varchar(200) NOT NULL,
  `ccontact` varchar(15) NOT NULL,
  `personToComplain` varchar(100) NOT NULL,
  `page` varchar(3) NOT NULL,
  `paddress` varchar(200) NOT NULL,
  `pcontact` varchar(15) NOT NULL,
  `complaint` varchar(200) NOT NULL,
  `actionTaken` varchar(50) NOT NULL,
  `sStatus` varchar(25) NOT NULL,
  `locationOfIncidence` varchar(200) NOT NULL,
  `recordedby` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblcaptain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblcaptain VALUES("1","katrina","de ramos","1700929532288_katrina.jpg","katrina","$2y$10$dmjmYVa8w9C09ENSp88tweVkqIZlaWiKtociS1mvrbC3ggc3AU9cO");
INSERT INTO tblcaptain VALUES("2","christopher","estrera","1700929553733_tooper.jpg","tooper","$2y$10$rNGXXHrU3Cu9uMUOOpgGSuINHlPGOQ/ra4vSjsLD5/TjENHDl3tWW");



CREATE TABLE `tblclearance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clearanceNo` varchar(25) NOT NULL,
  `residentid` varchar(10) NOT NULL,
  `findings` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `orNo` varchar(25) NOT NULL,
  `samount` varchar(5) NOT NULL,
  `dateRecorded` datetime NOT NULL DEFAULT current_timestamp(),
  `recordedBy` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblhousehold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `householdno` varchar(10) NOT NULL,
  `purok` varchar(50) NOT NULL,
  `totalhouseholdmembers` varchar(3) NOT NULL,
  `headoffamily` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tbllogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `logdate` datetime NOT NULL DEFAULT current_timestamp(),
  `action` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbllogs VALUES("1","Administrator","2023-11-25 23:52:02","added resident named malinao, jeffern dulla");
INSERT INTO tbllogs VALUES("2","Administrator","2023-11-25 23:53:49","added resident named cabillar, flor ");
INSERT INTO tbllogs VALUES("3","Administrator","2023-11-26 00:00:57","added resident named sargado, clarish ");
INSERT INTO tbllogs VALUES("4","Administrator","2023-11-26 00:02:44","added resident named ampuan, acmali ");
INSERT INTO tbllogs VALUES("5","Administrator","2023-11-26 00:05:20","added resident named tesoro, jasper ");
INSERT INTO tbllogs VALUES("6","Administrator","2023-11-26 00:08:02","added resident named de ramos, katrina ");
INSERT INTO tbllogs VALUES("7","Administrator","2023-11-26 00:10:02","added resident named estrera, christopher arieta");
INSERT INTO tbllogs VALUES("8","Administrator","2023-11-26 00:13:03","added resident named mokit madid, abdul ");
INSERT INTO tbllogs VALUES("9","Administrator","2023-11-26 00:14:34","added barangay official named malinao, jeffern dulla");
INSERT INTO tbllogs VALUES("10","Administrator","2023-11-26 00:19:12","added barangay official named cabillar, flor ");
INSERT INTO tbllogs VALUES("11","Administrator","2023-11-26 00:20:17","added barangay official named estrera, christopher arieta");
INSERT INTO tbllogs VALUES("12","Administrator","2023-11-26 00:21:03","added barangay official named sargado, clarish ");
INSERT INTO tbllogs VALUES("13","Administrator","2023-11-26 00:22:43","added barangay official named mokit madid, abdul ");
INSERT INTO tbllogs VALUES("14","Administrator","2023-11-26 00:23:30","added barangay official named ampuan, acmali ");
INSERT INTO tbllogs VALUES("15","Administrator","2023-11-26 00:23:48","added staff named clarish sargado");
INSERT INTO tbllogs VALUES("16","Administrator","2023-11-26 00:24:05","added staff named acmali ampuan");
INSERT INTO tbllogs VALUES("17","Administrator","2023-11-26 00:24:31","added staff named jasper tesoro");
INSERT INTO tbllogs VALUES("18","Administrator","2023-11-26 00:25:32","added purok leader named katrina de ramos");
INSERT INTO tbllogs VALUES("19","Administrator","2023-11-26 00:25:53","added purok leader named christopher estrera");
INSERT INTO tbllogs VALUES("20","administrator","2024-01-05 00:01:47","added officer named jeffern d. malinao");
INSERT INTO tbllogs VALUES("21","administrator","2024-01-05 00:02:12","added officer named flor cabillar");
INSERT INTO tbllogs VALUES("22","administrator","2024-01-05 00:02:27","added officer named clarish sargado");



CREATE TABLE `tblofficial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sPosition` varchar(50) NOT NULL,
  `completeName` varchar(50) NOT NULL,
  `pcontact` varchar(25) NOT NULL,
  `paddress` varchar(200) NOT NULL,
  `termStart` date NOT NULL,
  `termEnd` date NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblofficial VALUES("1","captain","malinao, jeffern dulla","09317348750","1760 molave street, new pandan, panabo city, davao del norte","2023-11-26","2025-11-26","ongoing term");
INSERT INTO tblofficial VALUES("2","kagawad(ordinance)","cabillar, flor ","09123456789","ising, carmen, panabo city, davao del norte","2023-10-17","2025-12-21","ongoing term");
INSERT INTO tblofficial VALUES("3","kagawad(public safety)","estrera, christopher arieta","09825120109","panabo city, davao del norte","2023-07-19","2025-11-29","ongoing term");
INSERT INTO tblofficial VALUES("4","kagawad(tourism)","sargado, clarish ","09719852715","panabo city, davao del norte","2023-08-13","2025-03-16","ongoing term");
INSERT INTO tblofficial VALUES("5","kagawad(budget & finance)","mokit madid, abdul ","09718542518","panabo city, davao del norte","2023-06-19","2025-05-21","ongoing term");
INSERT INTO tblofficial VALUES("6","sk chairman","ampuan, acmali ","09827415771","panabo city, davao del norte","2023-09-25","2025-08-21","ongoing term");



CREATE TABLE `tblpermit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permitNo` varchar(25) NOT NULL,
  `residentid` varchar(10) NOT NULL,
  `findings` varchar(100) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `orNo` varchar(25) NOT NULL,
  `samount` varchar(5) NOT NULL,
  `dateRecorded` datetime NOT NULL DEFAULT current_timestamp(),
  `recordedBy` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




CREATE TABLE `tblresident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(25) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) NOT NULL,
  `bdate` varchar(25) NOT NULL,
  `bplace` varchar(200) NOT NULL,
  `age` varchar(3) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `purok` varchar(100) NOT NULL,
  `totalhousehold` varchar(5) NOT NULL,
  `differentlyabledperson` varchar(100) NOT NULL,
  `relationtohead` varchar(50) NOT NULL,
  `healthstatus` varchar(50) NOT NULL,
  `bloodtype` varchar(25) NOT NULL,
  `civilstatus` varchar(25) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `monthlyincome` varchar(15) NOT NULL,
  `householdnum` varchar(10) NOT NULL,
  `lengthofstay` varchar(10) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `gender` varchar(25) NOT NULL,
  `skills` varchar(100) NOT NULL,
  `igpitID` varchar(50) NOT NULL,
  `philhealthNo` varchar(50) NOT NULL,
  `philhealthnoexpdate` varchar(16) NOT NULL,
  `highestEducationalAttainment` varchar(50) NOT NULL,
  `houseOwnershipStatus` varchar(50) NOT NULL,
  `landOwnershipStatus` varchar(50) NOT NULL,
  `dwellingtype` varchar(25) NOT NULL,
  `sourceofwatersupply` varchar(50) NOT NULL,
  `lightningFacilities` varchar(25) NOT NULL,
  `sanitaryToilet` varchar(25) NOT NULL,
  `formerAddress` varchar(100) NOT NULL,
  `remarks` varchar(25) NOT NULL,
  `image` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblresident VALUES("1","malinao","jeffern","dulla","04/02/1997","tagum city, davao del norte","26","new pandan","nido","9","none","child","mental illness","a-","single","freelancer","40000","1760","295","catholic","filipino","male","eating, coding, sleeping","3486236","98-712571259-8","06/11/2025","college level","live with parents/relatives","owned","2nd option","truck/tanker peddler, bottled water","electric","water-sealed","none","good","1700927522878_jeffern.png","jeffern","$2y$10$/1NZSVKH8blUXo7uVpfNVuPDT3e9XpJ4hPiSXGB7D0d8VFu.iAeRu");
INSERT INTO tblresident VALUES("2","cabillar","flor","","08/03/1999","ising, carmen, panabo city, davao del norte","24","new pandan","liberty","7","none","child","mental illness","a-","single","government employee","26000","1724","5","christian","filipino","female","volleyball, drawing, reading, cooking","918275","78-678617285-1","07/21/2025","post graduate","live with parents/relatives","owned","2nd option","truck/tanker peddler, bottled water","electric","water-sealed","none","good","1700927629254_flor.jpg","flor","$2y$10$FIc8t3oBsT/TqCqWUQl35.DWraWkcXt8aZZ5G2v//CC2RrPt/0MQ.");
INSERT INTO tblresident VALUES("3","sargado","clarish","","07/29/1999","surigao city","24","new pandan","sustagen","5","none","child","mental illness","ab+","single","government employee","19000","1162","9","catholic","filipino","female","volleyball, dancing, reading","198275","89-712581928-7","11/29/2025","college level","rent","owned","2nd option","truck/tanker peddler, bottled water","electric","water-sealed","none","good","1700928057838_clarish.jpg","clarish","$2y$10$jXom3F1QrnVuPKVPYp3gfun5CX7oLp3GZjtPP5q/ZxXBE7fkZyb..");
INSERT INTO tblresident VALUES("4","ampuan","acmali","","06/26/2000","panabo city, davao del norte","23","new pandan","alaska","6","none","child","mental illness","b+","single","private employee","22000","1721","288","muslim","filipino","male","editing, animation, basketball","129857","89-712871598-1","12/19/2025","college level","live with parents/relatives","owned","2nd option","truck/tanker peddler, bottled water","electric","water-sealed","none","good","1700928164238_acmali.jpg","acmali","$2y$10$PNSUZn1o0HlPRnnpBwM.UeqHM8sufpb1Ztzz3tYyuuIJ8aEvxEDcS");
INSERT INTO tblresident VALUES("5","tesoro","jasper","","07/11/2000","panabo city, davao del norte","23","new pandan","sustagen","4","none","child","mental illness","ab+","live-in","government employee","19000","1957","166","catholic","filipino","male","basketball, editing, animation","198571","89-712879578-9","07/22/2025","college graduate","live with parents/relatives","owned","2nd option","truck/tanker peddler, bottled water","electric","water-sealed","none","good","1700928320924_jasper.jpg","jasper","$2y$10$xHFAiB4x3PaZQOdWUTKIueZQTNoRI/6/CSdCCphVD5aguRe48IjSe");
INSERT INTO tblresident VALUES("6","de ramos","katrina","","10/31/1997","mabuhay, carmen, panabo city, davao del norte","26","new pandan","alacta","7","none","child","mental illness","b+","single","government employee","21000","1673","216","catholic","filipino","female","eating, dancing, sleeping","129857","89-712897518-5","11/21/2025","college level","live with parents/relatives","owned","2nd option","truck/tanker peddler, bottled water","electric","water-sealed","none","good","1700928481950_katrina.jpg","katrina","$2y$10$kZU8znW9hz9/HrqS.owo/eXxWFBCpZIlTob/UGfD3vyo0zs7vvYju");
INSERT INTO tblresident VALUES("7","estrera","christopher","arieta","06/22/1999","panabo city, davao del norte","24","new pandan","alacta","9","none","child","mental illness","b+","live-in","government employee","19000","2617","227","catholic","filipino","male","editing, coding, crafting","128957","87-892175891-2","05/28/2025","college level","live with parents/relatives","owned","2nd option","truck/tanker peddler, bottled water","electric","water-sealed","none","good","1700928602493_tooper.jpg","tooper","$2y$10$qDNsBAxjqCaq4tIiLOU5dutKW8l7/SpH4mzqN39Sw0KzHUBJ9DWRi");
INSERT INTO tblresident VALUES("8","mokit madid","abdul","","04/22/2000","davao city","23","new pandan","liberty","3","none","child","mental illness","ab+","single","freelancer","40000","1885","27","muslim","filipino","male","data entry, product research, management","912875","78-786786125-1","02/03/2025","college level","rent","owned","2nd option","bottled water","electric","water-sealed","none","good","1700928783040_default.png","abdul","$2y$10$9xAczAJrqlrPQdhRJnoHu.QbaTXeIkBwGspP486lm.Ot5nUvARfr6");



CREATE TABLE `tblstaff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tblstaff VALUES("1","clarish","sargado","1700929428878_clarish.jpg","clarish","$2y$10$ApgUY5Y6n3aHRBxXf9v/FeaMwvLrsbkYFhkxNyOlaeOMd1O5hZPGi");
INSERT INTO tblstaff VALUES("2","acmali","ampuan","1700929445245_acmali.jpg","acmali","$2y$10$Pvn6OHyjpDuJ8ocuN0dn8O6aD2VJI1o36Oku7LC4ZXUJMbtM0db3O");
INSERT INTO tblstaff VALUES("3","jasper","tesoro","1700929471073_jasper.jpg","jasper","$2y$10$wD7G3JWDzZbjGEke9T3hL.fBKh4ZT1//PWTaYK9ng2dggxi8LkGj6");



CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO tbluser VALUES("1","system","administrator","admin","$2y$10$aLD7S1xlrH/4Cl5kZqOrcOjM6q5bmNrleR1VpnTDCP6vMq6TI1y3S","boy.svg","administrator");
INSERT INTO tbluser VALUES("2","jeffern","malinao","jeffern","$2y$10$shOWxp/cWzt2dFSDXIek0.eRZhaJW7Z1nzL8zzLxN3IEP7EhdY6z.","boy.svg","administrator");
INSERT INTO tbluser VALUES("3","flor","cabillar","flor","$2y$10$Mq2ddsdMnlX10Y62RYOrG.knlaG4rGCJraxUmvDHVGfDmGwGflS/m","girl.svg","administrator");

