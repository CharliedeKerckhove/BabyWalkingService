USE dbs67541;


-- CREATE DATA TABLES

CREATE TABLE IF NOT EXISTS Staff 
(
StaffID INT NOT NULL AUTO_INCREMENT,
FirstName VARCHAR(50) NOT NULL,
LastName VARCHAR(50) NOT NULL,
PhoneNumber CHAR(11) NOT NULL,
Email VARCHAR(100),
Address VARCHAR(100),
Postcode CHAR(8),
StaffPassword VARCHAR(250),
FirstAid CHAR(1),
DBSCheck CHAR(1),
CONSTRAINT PK_Staff PRIMARY KEY(StaffID),
CONSTRAINT CHK_Postcode CHECK (Postcode LIKE 'TW%' || Postcode LIKE 'KT%' || Postcode LIKE 'RH%' || Postcode LIKE 'GU%')
);



CREATE TABLE IF NOT EXISTS Service 
(
ServiceID CHAR(5) NOT NULL,
ServiceName VARCHAR(50) NOT NULL,
Length INT(2),
Price INT(3),
CONSTRAINT PK_Service PRIMARY KEY(ServiceID)
);


CREATE TABLE IF NOT EXISTS Facilities 
(
FacilitiesID CHAR(5) NOT NULL,
FacilityName VARCHAR(50),
CONSTRAINT PK_Facilities PRIMARY KEY(FacilitiesID)
);


CREATE TABLE IF NOT EXISTS Location
(
LocationID CHAR(5) NOT NULL,
LocationName VARCHAR(100),
CityTown VARCHAR(100),
Postcode CHAR(8),
CONSTRAINT PK_Location PRIMARY KEY(LocationID),
CONSTRAINT CHK_Postcode CHECK (Postcode LIKE 'TW%' || Postcode LIKE 'KT%' || Postcode LIKE 'RH%' || Postcode LIKE 'GU%')
);

CREATE TABLE IF NOT EXISTS Venue
(
VenueID CHAR(5) NOT NULL,
LocationID CHAR(5) NOT NULL,
FacilitiesID CHAR(5) NOT NULL,
CONSTRAINT PK_Venue PRIMARY KEY(VenueID),
CONSTRAINT FK_Location FOREIGN KEY(LocationID) REFERENCES Location(LocationID),
CONSTRAINT FK_Facilities FOREIGN KEY(FacilitiesID) REFERENCES Facilities(FacilitiesID)
);

CREATE TABLE IF NOT EXISTS Booking
(
BookingID INT NOT NULL AUTO_INCREMENT,
ServiceID CHAR(5) NOT NULL,   
BookingDate DATE NOT NULL,
BookingTime TIME NOT NULL,
CollectionAddress VARCHAR(100),
CollectionPostcode CHAR(8),
ChildID INT NOT NULL,
CONSTRAINT PK_Booking PRIMARY KEY(BookingID),
CONSTRAINT CHK_Date CHECK (BookingDate > CURRENT_DATE),
CONSTRAINT CHK_Postcode CHECK (CollectionPostcode LIKE 'TW%' || CollectionPostcode LIKE 'KT%' || CollectionPostcode LIKE 'RH%' || CollectionPostcode LIKE 'GU%'),
CONSTRAINT FK_BookingService FOREIGN KEY(ServiceID) REFERENCES Service(ServiceID)
);


CREATE TABLE IF NOT EXISTS StaffAllocation
(
StaffAllocationID CHAR(5) NOT NULL,
StaffID INT NOT NULL,
LocationID CHAR(5) NOT NULL,
BookingID INT NOT NULL,
CONSTRAINT PK_StaffAllocation PRIMARY KEY(StaffAllocationID),
CONSTRAINT FK_AllocatedLocationStaff FOREIGN KEY(LocationID) REFERENCES Location(LocationID),
CONSTRAINT FK_AllocatedStaff FOREIGN KEY(StaffID) REFERENCES Staff(StaffID),
CONSTRAINT FK_BookingSlot FOREIGN KEY(BookingID) REFERENCES Booking(BookingID)
);


CREATE TABLE IF NOT EXISTS Carer
(
CarerID INT NOT NULL AUTO_INCREMENT,
FirstName VARCHAR(50) NOT NULL,
LastName VARCHAR(50) NOT NULL,
PhoneNumber CHAR(11) NOT NULL,
Email VARCHAR(100),
CarerPassword VARCHAR(250),
CONSTRAINT PK_Carer PRIMARY KEY(CarerID)
);


CREATE TABLE IF NOT EXISTS Child
(
ChildID INT NOT NULL AUTO_INCREMENT,
CarerID INT NOT NULL,
FirstName VARCHAR(50) NOT NULL,
Age INT(2) NOT NULL,
Allergies VARCHAR(250) NOT NULL,
CONSTRAINT PK_Child PRIMARY KEY(ChildID),
CONSTRAINT FK_Carer FOREIGN KEY(CarerID) REFERENCES Carer(CarerID)
);


 CREATE TABLE IF NOT EXISTS AllergyList
(
AllergiesID CHAR(5) NOT NULL,
AllergyName VARCHAR(100),
CONSTRAINT PK_Allergies PRIMARY KEY(AllergiesID)
);

CREATE TABLE IF NOT EXISTS Reviews
(
ReviewID INT(10) NOT NULL AUTO_INCREMENT,
ReviewName VARCHAR(50) NOT NULL,
ReviewScore INT(2) NOT NULL,
ReviewText VARCHAR(250),
CONSTRAINT PK_Reviews PRIMARY KEY(ReviewID)    
);

/*
CREATE TABLE IF NOT EXISTS ChildAllergies
(
ChildAllergiesID CHAR(5) NOT NULL,
ChildID INT NOT NULL,
AllergiesID CHAR(5),
CONSTRAINT PK_ChildAllergies PRIMARY KEY(ChildAllergiesID),
CONSTRAINT FK_Child FOREIGN KEY(ChildID) REFERENCES Child(ChildID),
CONSTRAINT FK_Allergies FOREIGN KEY(AllergiesID) REFERENCES AllergyList(AllergiesID)
);
*/

CREATE TABLE IF NOT EXISTS ChildAllocation
(
ChildAllocationID INT NOT NULL AUTO_INCREMENT,
ChildID INT NOT NULL,
LocationID CHAR(5) NOT NULL,
BookingID INT NOT NULL,
CONSTRAINT PK_ChildAllocation PRIMARY KEY(ChildAllocationID),
CONSTRAINT FK_AllocatedChild FOREIGN KEY(ChildID) REFERENCES Child(ChildID),
CONSTRAINT FK_AllocatedLocationChild FOREIGN KEY(LocationID) REFERENCES Location(LocationID),
CONSTRAINT FK_ChildBooking FOREIGN KEY(BookingID) REFERENCES Booking(BookingID)
);

-- INDEX DATA
CREATE INDEX StaffLogin_X ON Staff(Email,StaffPassword);
CREATE INDEX Location_X ON Location(LocationName,Postcode);
CREATE INDEX Carer_X ON Carer(CarerID,FirstName,LastName,PhoneNumber);
CREATE INDEX CarerLogin_X ON Carer(Email,CarerPassword);
CREATE INDEX Child_X ON Child(ChildID,FirstName);
-- CREATE INDEX ChildAllergies_X ON ChildAllergies(ChildAllergiesID,ChildID,AllergiesID);
CREATE INDEX Booking_X ON Booking(BookingID,BookingDate,BookingTime);
CREATE INDEX Service_X ON Service(ServiceID,Price);

-- INSERT DATA
INSERT INTO Service VALUES ('SE001','Walking','1','25');
INSERT INTO Service VALUES ('SE002','Walking','2','40');
INSERT INTO Service VALUES ('SE003','Walking','3','60');

INSERT INTO Facilities VALUES ('F1001','Toilet');
INSERT INTO Facilities VALUES ('F1002','Disabled Toilet');
INSERT INTO Facilities VALUES ('F1003','Cafe');
INSERT INTO Facilities VALUES ('F1004','Parking');
INSERT INTO Facilities VALUES ('F1005','Paddling Pool');
INSERT INTO Facilities VALUES ('F1006','Changing Facilities');
INSERT INTO Facilities VALUES ('F1007','Pond');
INSERT INTO Facilities VALUES ('F1008','Kickabout Area');
INSERT INTO Facilities VALUES ('F1009','Playground');
INSERT INTO Facilities VALUES ('F1010','Garden');
INSERT INTO Facilities VALUES ('F1011','Tennis Court');
INSERT INTO Facilities VALUES ('F1012','Table Tennis');
INSERT INTO Facilities VALUES ('F1013','Historic Building');

INSERT INTO Location VALUES ('L1000','','','');
INSERT INTO Location VALUES ('L1001','Alexandra Recreation Ground','Epsom','KT17 4AN');
INSERT INTO Location VALUES ('L1002','Epsom Common Nature Reserve','Epsom','KT18 7JE');
INSERT INTO Location VALUES ('L1003','Hogsmill Riverside Open Space','Epsom','KT19 0HP');
INSERT INTO Location VALUES ('L1004','Rosebery Park','Epsom','KT18 5AQ');
INSERT INTO Location VALUES ('L1005','Allen House Grounds','Guildford','GU1 4DS');
INSERT INTO Location VALUES ('L1006','Guildford Castle Grounds','Guildford','GU1 3UW');
INSERT INTO Location VALUES ('L1007','Riverside Nature Reserve','Guildford','GU4 7LY');
INSERT INTO Location VALUES ('L1008','Stoke Park','Guildford','GU1 1ER');
INSERT INTO Location VALUES ('L1009','Sutherland Memorial Park','Guildford','GU4 7LX');
INSERT INTO Location VALUES ('L1010','Priory Park','Reigate','RH2 7RL');
INSERT INTO Location VALUES ('L1011','Sunbury Walled Garden','Sunbury','TW16 6AB');
INSERT INTO Location VALUES ('L1012','Frimley Lodge Park','Camberley','GU16 6HY');
INSERT INTO Location VALUES ('L1013','Windlesham Field of Remembrance','Windlesham', 'GU20 6AE');
INSERT INTO Location VALUES ('L1014','Broadwater Park','Godalming','GU7 3BB');
INSERT INTO Location VALUES ('L1015','Farnham Park','Farnham','GU9 0AU');
INSERT INTO Location VALUES ('L1016','Frensham Common','Farnham','GU10 3EE');
INSERT INTO Location VALUES ('L1017','Phillips Memorial Park','Godalming','GU7 1EG');
INSERT INTO Location VALUES ('L1018','Winkworth Arboretum','Godalming','GU8 4AD');
INSERT INTO Location VALUES ('L1019','Box Hill','Dorking','KT20 7LB');
INSERT INTO Location VALUES ('L1020','Horsell Moor Recreation Ground','Woking','GU21 4NJ');
INSERT INTO Location VALUES ('L1021','Goldsworth Park Recreation Ground','Woking','GU21 3RT');
INSERT INTO Location VALUES ('L1022','West Byfleet Recreation Ground','West Byfleet','KT14 6EG');
INSERT INTO Location VALUES ('L1023','Waterers Park','Woking','GU21 2JH');
INSERT INTO Location VALUES ('L1024','Painshill','Cobham','KT11 1JE');
INSERT INTO Location VALUES ('L1025','Norbury Park','Leatherhead','KT22 9DX');

INSERT INTO Staff VALUES ('1','Tamsin','de Kerckhove','07762971717','dekerckhove@virginmedia.com','92 Scotland Bridge road, New Haw, Surrey','KT15 3HH',PASSWORD('password123'),'Y','Y');
INSERT INTO Staff VALUES ('2','Floyd','Mayweather','07319957790','floydboi@gmail.com','Hillier Mews, Hillier Road, Guildford, Surrey','GU1 2JZ',PASSWORD('boxing'),'Y','Y');
INSERT INTO Staff VALUES ('3','George','Clooney','07884390403','ClooneyGeorge@hotmail.com','Flat 2, Coombe House, Hartland Rd, Addlestone, Surrey','KT15 1JU',PASSWORD('123454321'),'N','Y');
INSERT INTO Staff VALUES ('4','Kylie','Jenner','01483695149','KJenner@outlook.co.uk','3, Larks Way, Knaphill, Woking, Surrey','GU21 5AJ',PASSWORD('makeup'),'Y','Y');
INSERT INTO Staff VALUES ('5','Dwayne','Johnson','07748875683','rock@rockyrock.rock','25 St. Leonards Road, Windsor, Berkshire','SL4 3BP',PASSWORD('rock'),'N','N');
INSERT INTO Staff VALUES ('6','Ed','Sheeran','07844623359','ed@sheeran.com','Church Road, Old Windsor, Windsor, Berkshire','SL4 1LD',PASSWORD('aTeam'),'Y','Y');
INSERT INTO Staff VALUES ('7','Cristiano','Ronaldo','07299854755','CR7@juventus.it','50, Tilehouse Road, Guildford, Surrey','GU4 8AJ',PASSWORD('ronaldo7'),'N','N');
INSERT INTO Staff VALUES ('8','Katy','Perry','07319957790','candy@fireworks.net','68 High Road, Byfleet, Surrey','KT14 7QL',PASSWORD('fireworks1'),'Y','N');
INSERT INTO Staff VALUES ('9','Ellen','DeGeneres','07414412568','EDG@hotmail.com','Pyrford Place, Warren Lane, Woking, Surrey','KT13 9UJ',PASSWORD('LGBT'),'Y','Y');
INSERT INTO Staff VALUES ('10','Kendrick','Lamar','07612252252','i@sky.co.uk','Hazel Road, West Byfleet, Surrey','KT14 3YT',PASSWORD('dancer123'),'N','N');


INSERT INTO Carer VALUES ('1','Zeus','Richards','07436200296','zeusrichards86@hotmail.co.uk',PASSWORD('lightning'));
INSERT INTO Carer VALUES ('2','Harrison','Reed','07090562171','reedharrison@gmail.com',PASSWORD('hazarooney'));
INSERT INTO Carer VALUES ('3','Clark','Wilcox','07965094888','cautiousclark@ccsecurity.com',PASSWORD('cautionIsKey9483'));
INSERT INTO Carer VALUES ('4','Zane','Christensen','07168448692','Zane@Christensen.co.uk',PASSWORD('ruffles123'));
INSERT INTO Carer VALUES ('5','Jon','Snow','07990150768','winteriscoming@got.us',PASSWORD('whitewalkersrevil'));
INSERT INTO Carer VALUES ('6','Linda','Wyatt','07740064124','lindy94@sky.co.uk',PASSWORD('password1963'));
INSERT INTO Carer VALUES ('7','Jazmine','Browning','07079364281','jazzygyal@glitter.com',PASSWORD('unicorns74'));
INSERT INTO Carer VALUES ('8','Harriet','Merritt','07264578052','hmerrit@virginmedia.com',PASSWORD('qwertyuiop'));
INSERT INTO Carer VALUES ('9','Pippa','Hatfield','07763940519','hatty666@gmail.com',PASSWORD('lovedevil666'));
INSERT INTO Carer VALUES ('10','Tina','Lard','07063408974','fatlard@tina.com',PASSWORD('alpaca22'));
INSERT INTO Carer VALUES ('11','Debra','Parkinson','07748844398','debbieparkinson@sky.com',PASSWORD('stjoesphs'));
INSERT INTO Carer VALUES ('12','Hanna','Appleton','07661431556','hannaspanna@clarknet.com',PASSWORD('spanners123'));


INSERT INTO AllergyList VALUES ('A1000','None');
INSERT INTO AllergyList VALUES ('A1001','Milk');
INSERT INTO AllergyList VALUES ('A1002','Soy');
INSERT INTO AllergyList VALUES ('A1003','Eggs');
INSERT INTO AllergyList VALUES ('A1004','Gluten');
INSERT INTO AllergyList VALUES ('A1005','Peanuts');
INSERT INTO AllergyList VALUES ('A1006','Tree Nuts');
INSERT INTO AllergyList VALUES ('A1007','Fish');
INSERT INTO AllergyList VALUES ('A1008','Shellfish');
INSERT INTO AllergyList VALUES ('A1009','Grass and Pollen');
INSERT INTO AllergyList VALUES ('A1010','Medication');
INSERT INTO AllergyList VALUES ('A1011','Insect Bites');


INSERT INTO Child VALUES ('1','8','Arnold','5','None');
INSERT INTO Child VALUES ('2','4','Matt','11','Peanuts, Tree Nuts');
INSERT INTO Child VALUES ('3','5','Jessica','4','Gluten, Milk, Soy');
INSERT INTO Child VALUES ('4','1','William','6','Gluten');
INSERT INTO Child VALUES ('5','2','Bethany','8','None');
INSERT INTO Child VALUES ('6','7','Susie','8','Peanuts, Tree Nuts');
INSERT INTO Child VALUES ('7','8','Jess','13','Fish, Shellfish');
INSERT INTO Child VALUES ('8','10','Chris','7','Grass and Pollen');
INSERT INTO Child VALUES ('9','12','Alice','10','Insect Bites');
INSERT INTO Child VALUES ('10','3','Jack','9','Fish, Shellfish, Insect Bites');
INSERT INTO Child VALUES ('11','6','Jacob','6','Milk, Eggs');
INSERT INTO Child VALUES ('12','11','Eleanor','9','None');
INSERT INTO Child VALUES ('13','2','Rosie','11','Medication, Insect Bites');
INSERT INTO Child VALUES ('14','9','Katie','3','Fish, Shellfish, Medication');
INSERT INTO Child VALUES ('15','7','Alexander','7','Peanuts, Gluten, Milk, Soy, Eggs, Tree Nuts');

/*
INSERT INTO ChildAllergies VALUES ('CA001','1','A1005');
INSERT INTO ChildAllergies VALUES ('CA002','1','A1006');
INSERT INTO ChildAllergies VALUES ('CA003','2','A1009');
INSERT INTO ChildAllergies VALUES ('CA004','2','A1001');
INSERT INTO ChildAllergies VALUES ('CA005','2','A1003');
INSERT INTO ChildAllergies VALUES ('CA006','2','A1011');
INSERT INTO ChildAllergies VALUES ('CA007','3','A1000');
INSERT INTO ChildAllergies VALUES ('CA008','4','A1000');
INSERT INTO ChildAllergies VALUES ('CA009','5','A1008');
INSERT INTO ChildAllergies VALUES ('CA010','5','A1007');
INSERT INTO ChildAllergies VALUES ('CA011','6','A1000');
INSERT INTO ChildAllergies VALUES ('CA012','7','A1009');
INSERT INTO ChildAllergies VALUES ('CA013','8','A1000');
INSERT INTO ChildAllergies VALUES ('CA014','9','A1004');
INSERT INTO ChildAllergies VALUES ('CA015','10','A1008');
INSERT INTO ChildAllergies VALUES ('CA016','10','A1001');
INSERT INTO ChildAllergies VALUES ('CA017','11','A1000');
INSERT INTO ChildAllergies VALUES ('CA018','12','A1009');
INSERT INTO ChildAllergies VALUES ('CA019','13','A1002');
INSERT INTO ChildAllergies VALUES ('CA020','14','A1002');
INSERT INTO ChildAllergies VALUES ('CA021','14','A1003');
INSERT INTO ChildAllergies VALUES ('CA022','14','A1004');
INSERT INTO ChildAllergies VALUES ('CA023','14','A1007');
INSERT INTO ChildAllergies VALUES ('CA024','15','A1011');
INSERT INTO ChildAllergies VALUES ('CA025','15','A1010');
*/

INSERT INTO Venue VALUES ('V1001','L1001','F1001');
INSERT INTO Venue VALUES ('V1002','L1001','F1002');
INSERT INTO Venue VALUES ('V1003','L1001','F1003');
INSERT INTO Venue VALUES ('V1004','L1001','F1004');
INSERT INTO Venue VALUES ('V1005','L1001','F1008');
INSERT INTO Venue VALUES ('V1006','L1001','F1009');
INSERT INTO Venue VALUES ('V1007','L1001','F1011');
INSERT INTO Venue VALUES ('V1008','L1002','F1001');
INSERT INTO Venue VALUES ('V1009','L1002','F1004');
INSERT INTO Venue VALUES ('V1010','L1002','F1007');
INSERT INTO Venue VALUES ('V1011','L1002','F1010');
INSERT INTO Venue VALUES ('V1012','L1002','F1013');
INSERT INTO Venue VALUES ('V1013','L1003','F1001');
INSERT INTO Venue VALUES ('V1014','L1003','F1008');
INSERT INTO Venue VALUES ('V1015','L1003','F1004');
INSERT INTO Venue VALUES ('V1016','L1004','F1001');
INSERT INTO Venue VALUES ('V1017','L1004','F1002');
INSERT INTO Venue VALUES ('V1018','L1004','F1004');
INSERT INTO Venue VALUES ('V1019','L1004','F1007');
INSERT INTO Venue VALUES ('V1020','L1004','F1008');
INSERT INTO Venue VALUES ('V1021','L1004','F1009');
INSERT INTO Venue VALUES ('V1022','L1005','F1001');
INSERT INTO Venue VALUES ('V1023','L1005','F1002');
INSERT INTO Venue VALUES ('V1024','L1005','F1003');
INSERT INTO Venue VALUES ('V1025','L1005','F1004');
INSERT INTO Venue VALUES ('V1026','L1005','F1006');
INSERT INTO Venue VALUES ('V1027','L1005','F1010');
INSERT INTO Venue VALUES ('V1028','L1005','F1013');
INSERT INTO Venue VALUES ('V1029','L1006','F1001');
INSERT INTO Venue VALUES ('V1030','L1006','F1002');
INSERT INTO Venue VALUES ('V1031','L1006','F1003');
INSERT INTO Venue VALUES ('V1032','L1006','F1004');
INSERT INTO Venue VALUES ('V1033','L1006','F1007');
INSERT INTO Venue VALUES ('V1034','L1006','F1009');
INSERT INTO Venue VALUES ('V1035','L1006','F1010');
INSERT INTO Venue VALUES ('V1036','L1006','F1013');
INSERT INTO Venue VALUES ('V1037','L1007','F1004');
INSERT INTO Venue VALUES ('V1038','L1007','F1005');
INSERT INTO Venue VALUES ('V1039','L1007','F1006');
INSERT INTO Venue VALUES ('V1040','L1007','F1008');
INSERT INTO Venue VALUES ('V1041','L1008','F1001');
INSERT INTO Venue VALUES ('V1042','L1008','F1003');
INSERT INTO Venue VALUES ('V1043','L1008','F1004');
INSERT INTO Venue VALUES ('V1044','L1008','F1008');
INSERT INTO Venue VALUES ('V1045','L1008','F1009');
INSERT INTO Venue VALUES ('V1046','L1008','F1010');
INSERT INTO Venue VALUES ('V1047','L1009','F1004');
INSERT INTO Venue VALUES ('V1048','L1010','F1001');
INSERT INTO Venue VALUES ('V1049','L1010','F1002');
INSERT INTO Venue VALUES ('V1050','L1010','F1003');
INSERT INTO Venue VALUES ('V1051','L1010','F1004');
INSERT INTO Venue VALUES ('V1052','L1010','F1005');
INSERT INTO Venue VALUES ('V1053','L1010','F1006');
INSERT INTO Venue VALUES ('V1054','L1010','F1011');
INSERT INTO Venue VALUES ('V1055','L1010','F1012');
INSERT INTO Venue VALUES ('V1056','L1011','F1001');
INSERT INTO Venue VALUES ('V1057','L1011','F1010');
INSERT INTO Venue VALUES ('V1058','L1012','F1001');
INSERT INTO Venue VALUES ('V1059','L1012','F1002');
INSERT INTO Venue VALUES ('V1060','L1012','F1004');
INSERT INTO Venue VALUES ('V1061','L1012','F1011');
INSERT INTO Venue VALUES ('V1062','L1013','F1001');
INSERT INTO Venue VALUES ('V1063','L1013','F1002');
INSERT INTO Venue VALUES ('V1064','L1013','F1004');
INSERT INTO Venue VALUES ('V1065','L1013','F1010');
INSERT INTO Venue VALUES ('V1066','L1014','F1001');
INSERT INTO Venue VALUES ('V1067','L1014','F1002');
INSERT INTO Venue VALUES ('V1068','L1014','F1003');
INSERT INTO Venue VALUES ('V1069','L1014','F1008');
INSERT INTO Venue VALUES ('V1070','L1014','F1009');
INSERT INTO Venue VALUES ('V1071','L1015','F1004');
INSERT INTO Venue VALUES ('V1072','L1015','F1009');
INSERT INTO Venue VALUES ('V1073','L1016','F1003');
INSERT INTO Venue VALUES ('V1074','L1016','F1004');
INSERT INTO Venue VALUES ('V1075','L1017','F1010');
INSERT INTO Venue VALUES ('V1076','L1018','F1001');
INSERT INTO Venue VALUES ('V1077','L1018','F1004');
INSERT INTO Venue VALUES ('V1078','L1018','F1005');
INSERT INTO Venue VALUES ('V1079','L1018','F1006');
INSERT INTO Venue VALUES ('V1080','L1019','F1003');
INSERT INTO Venue VALUES ('V1081','L1019','F1007');
INSERT INTO Venue VALUES ('V1082','L1019','F1008');
INSERT INTO Venue VALUES ('V1083','L1019','F1009');
INSERT INTO Venue VALUES ('V1084','L1019','F1013');
INSERT INTO Venue VALUES ('V1085','L1020','F1008');
INSERT INTO Venue VALUES ('V1086','L1020','F1009');
INSERT INTO Venue VALUES ('V1087','L1021','F1008');
INSERT INTO Venue VALUES ('V1088','L1021','F1009');
INSERT INTO Venue VALUES ('V1089','L1022','F1008');
INSERT INTO Venue VALUES ('V1090','L1022','F1009');
INSERT INTO Venue VALUES ('V1091','L1022','F1010');
INSERT INTO Venue VALUES ('V1092','L1023','F1001');
INSERT INTO Venue VALUES ('V1093','L1023','F1002');
INSERT INTO Venue VALUES ('V1094','L1023','F1003');
INSERT INTO Venue VALUES ('V1095','L1023','F1004');
INSERT INTO Venue VALUES ('V1096','L1023','F1008');
INSERT INTO Venue VALUES ('V1097','L1023','F1009');
INSERT INTO Venue VALUES ('V1098','L1023','F1010');
INSERT INTO Venue VALUES ('V1099','L1023','F1011');
INSERT INTO Venue VALUES ('V1100','L1024','F1001');
INSERT INTO Venue VALUES ('V1101','L1024','F1003');
INSERT INTO Venue VALUES ('V1102','L1024','F1004');
INSERT INTO Venue VALUES ('V1103','L1024','F1005');
INSERT INTO Venue VALUES ('V1104','L1024','F1006');
INSERT INTO Venue VALUES ('V1105','L1025','F1013');

INSERT INTO Booking VALUES ('1','SE002','2019-05-02','12:30:00','Greek Palace, Eyston Drive, Weybridge, Surrey','KT13 4AZ', '2');
INSERT INTO Booking VALUES ('2','SE001','2020-01-01','15:15:00','183, Thrupps Lane, Hersham Village, Surrey','KT12 5TT', '1');
INSERT INTO Booking VALUES ('3','SE001','2020-01-01','15:15:00','183, Thrupps Lane, Hersham Village, Surrey','KT12 5TT', '7');
INSERT INTO Booking VALUES ('4','SE001','2019-07-08','10:30:00','44, Tilford Road, Farnham, Surrey','GU9 2SA', '4');
INSERT INTO Booking VALUES ('5','SE003','2019-11-21','21:00:00','2, Keswick Drive, Lightwater, Surrey','GU18 6YR', '5');
INSERT INTO Booking VALUES ('6','SE003','2019-11-21','21:00:00','2, Keswick Drive, Lightwater, Surrey','GU18 6YR', '13');
INSERT INTO Booking VALUES ('7','SE001','2019-02-01','12:00:00','Alpaca Home, Mortlake Road, Kew, Richmond, Surrey','TW9 7AT', '8');

INSERT INTO ChildAllocation VALUES ('1','3','L1004','4');
INSERT INTO ChildAllocation VALUES ('2','5','L1002','5');
INSERT INTO ChildAllocation VALUES ('3','13','L1002','6');
INSERT INTO ChildAllocation VALUES ('4','8','L1012','7');
INSERT INTO ChildAllocation VALUES ('5','2','L1006','1');
INSERT INTO ChildAllocation VALUES ('6','7','L1017','3');
INSERT INTO ChildAllocation VALUES ('7','1','L1017','2');

INSERT INTO StaffAllocation VALUES ('AS001','4','L1006','1');
INSERT INTO StaffAllocation VALUES ('AS002','6','L1017','2');
INSERT INTO StaffAllocation VALUES ('AS003','1','L1002','4');
INSERT INTO StaffAllocation VALUES ('AS004','9','L1004','3');
INSERT INTO StaffAllocation VALUES ('AS005','5','L1012','5');

INSERT INTO Reviews VALUES ('1', 'Sean', '5', 'Great service, kind and passionate carers working hard to make my life easier');
INSERT INTO Reviews VALUES ('2', 'Jack', '5', 'Helped me actually get some sleep, first power nap of parenthood thanks to these guys');
INSERT INTO Reviews VALUES ('3', 'Jess', '3', 'Really helped reduce my stress but my son now prefers time with the baby walking service rather than time with mummy!');
INSERT INTO Reviews VALUES ('4', 'Bob', '4', 'Very friendly and an easy to use website');
INSERT INTO Reviews VALUES ('5', 'Tia', '4', 'Booked a walk whilst my child had a strop about not being allowed to have ANOTHER cookie and now I have to resist the urge to book one everytime my children throw a tantrum.');
INSERT INTO Reviews VALUES ('6', 'Katie', '2', 'Late bringing my child back, child also cried when returned home');