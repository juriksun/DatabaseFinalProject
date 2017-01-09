//Course:Databases
//Submmition: Final Project
//Student: Alexander Djura
//Student: Shamir Kritzler
//Addition: for running you must install Node.js and "mysql" package

var mysql = require('mysql');

//connection
var connection = mysql.createConnection({
  host     : '127.0.0.1',
  port     : '3306',
  user     : 'root',
  password : '',
  database : 'class_calendar'
 });
 
//checking connection
connection.connect(function(err){
	if(!err) {
		console.log("Database is connected ...");    
	} else {
		console.log("Error connecting database ...");    
	}
});

//create lecturer
connection.query('CREATE TABLE IF NOT EXISTS lecturer (' +
    ' lecturer_id VARCHAR(10) NOT NULL,' +
    ' first_name VARCHAR(10) NOT NULL,' +
    ' last_name VARCHAR(10) NOT NULL,' +
    ' birthdate VARCHAR(10) NOT NULL,' +
    ' address VARCHAR(30) NOT NULL,' +
    ' PRIMARY KEY(lecturer_id))',
    function(err, result){
        if(err) {
            console.log(err);
        } else {
            console.log("Table lecturer Created");
        }
    });

//create class table
connection.query('CREATE TABLE IF NOT EXISTS class (' +
                ' floor_num int(1) NOT NULL,' +
                ' class_num int(4) NOT NULL,' +
				' building_name VARCHAR(1) NOT NULL,' +
                ' PRIMARY KEY(class_num))',
	function(err, result){
		if(err) {
			console.log(err);
		} else {
			console.log("Table class Created");
		}
});

//create course
connection.query('CREATE TABLE IF NOT EXISTS course (' +
                ' course_num int(4) NOT NULL,' +
                ' course_name VARCHAR(30) NOT NULL,' +
				' semester VARCHAR(1) NOT NULL,' +
				' year int(1) NOT NULL,' +
				' num_of_hours int(1) NOT NULL,' +
                ' lecturer_id VARCHAR(10) NOT NULL,'+
                ' FOREIGN KEY (lecturer_id) REFERENCES lecturer(lecturer_id) ON UPDATE CASCADE,' +
                ' PRIMARY KEY(course_num))',
	function(err, result){
		if(err) {
			console.log(err);
		} else {
			console.log("Table course Created");
		}
});


connection.query('CREATE TABLE IF NOT EXISTS phone (' +
    ' lecturer_id VARCHAR(10) NOT NULL,' +
    ' phone_num VARCHAR(11) NOT NULL,' +
    ' PRIMARY KEY(phone_num),'+
    ' FOREIGN KEY (lecturer_id) REFERENCES lecturer(lecturer_id) ON DELETE CASCADE ON UPDATE CASCADE)',
    function(err, result){
        if(err) {
            console.log(err);
        } else {
            console.log("Table phone Created");
        }
    });

//create takes_place
connection.query('CREATE TABLE IF NOT EXISTS takes_place (' +
    ' class_num int(4) NOT NULL,' +
    ' course_num int(4) NOT NULL,' +
    ' day ENUM(\'Sun\',\'Mon\',\'Tue\',\'Wed\',\'Thu\',\'Fri\') NOT NULL,' +
    ' hour TIME NOT NULL,' +
    ' PRIMARY KEY(class_num, course_num),' +
    ' FOREIGN KEY (class_num) REFERENCES class(class_num) ON DELETE CASCADE ON UPDATE CASCADE,' +
    ' FOREIGN KEY (course_num) REFERENCES course(course_num) ON DELETE CASCADE ON UPDATE CASCADE)',
    function(err, result){
        if(err) {
            console.log(err);
        } else {
            console.log("Table takes_place Created");
        }
    });

//insert data into class table
connection.query('INSERT INTO class (floor_num, class_num, building_name) VALUES' +
    '(2, 200,\'Pernick\'),'+
    '(2, 246,\'Pernick\'),'+
    '(1, 2105,\'Mitchell\'),' +
    '(2, 247, \'Pernick\'),' +
    '(2, 2206, \'Mitchell\'),' +
    '(2, 2201, \'Mitchell\'),' +
    '(1, 2102, \'Mitchell\'),' +
    '(2, 2204, \'Mitchell\'),' +
    '(0, 30, \'Pernick\'),' +
    '(0, 62, \'Pernick\');'
);

//insert data into lecturer table
connection.query('INSERT INTO lecturer (lecturer_id, first_name, last_name, birthdate, address) VALUES' +
    '(\'00001111\',	\'Shirly\',	\'Idan\', \'1960-07-05\', \'Tel aviv\'),'+
    '(\'00002222\', \'Itzhak\',	\'Nudler\', \'1958-11-14\', \'Ramat gan\'),'+
    '(\'00033333\', \'Avivit\',	\'Levy\', \'1964-07-15\', \'Hadera\'),'+
    '(\'00104444\', \'Haim\',	\'Michael\', \'1964-06-02\', \'Haifa\'),'+
    '(\'01005555\', \'Igal\',	\'Hoffner\', \'1975-05-12\', \'Lod\'),'+
    '(\'00016666\', \'Marcelo\', \'Shihman\', \'1968-09-14\', \'Beer sheva\'),'+
    '(\'10007777\', \'Riva\',	\'Shalom\', \'1960-12-25\', \'Nazereth\'),'+
    '(\'01008888\', \'Yonit\',	\'Rusho\', \'1971-01-10\', \'Netanya\'),'+
    '(\'01109999\', \'Amnon\',	\'Dekel\', \'1978-04-04\', \'Eilat\'),'+
    '(\'12345678\', \'Avihay\',	\'Meged\', \'1966-09-05\', \'Kfar saba\');'
);
//insert data into course table
connection.query('INSERT INTO course (course_num, course_name, semester, year, num_of_hours, lecturer_id) VALUES' +
				'(1111, \'Physics\', \'A\', 1, 4, \'00001111\'),' +
				'(2222, \'Web_Development\', \'A\', 3, 3, \'00002222\'),' +
				'(3333, \'Communication\', \'A\', 3, 3, \'00033333\'),' +
				'(4444, \'Data_Structure\', \'A\', 2, 3, \'00104444\'),' +
				'(5555, \'Automation\', \'A\', 3, 5, \'01005555\'),' +
				'(6666, \'Programming_Languages\', \'C\', 2, 2, \'00016666\'),' +
				'(7777, \'Unix\', \'C\', 3, 2, \'10007777\'),' +
				'(8888, \'Database\', \'A\', 3, 3, \'01008888\'),' +
				'(9999, \'Java\', \'B\', 2, 4, \'01109999\'),' +
				'(1010, \'Algorithms\', \'B\', 2, 5, \'12345678\');'
);

//insert data into takes_place table
connection.query('INSERT INTO takes_place (class_num, course_num, day, hour) VALUES' +
    '(200, 1111, \'Sun\', \'08:00:00\'),' +
    '(246, 2222, \'Mon\', \'11:00:00\'),' +
    '(2105, 3333, \'Mon\', \'14:00:00\'),' +
    '(247, 4444, \'Wed\', \'10:00:00\'),' +
    '(2206, 5555, \'Wed\', \'14:00:00\'),' +
    '(2201, 6666, \'Thu\', \'18:00:00\'),' +
    '(2102, 7777, \'Thu\', \'08:00:00\'),' +
    '(2105, 8888, \'Fri\', \'13:00:00\'),' +
    '(30, 9999, \'Fri\', \'16:00:00\'),' +
    '(62, 1010, \'Tue\', \'08:00:00\');'
);

connection.query('INSERT INTO phone (lecturer_id, phone_num) VALUES' +
    '(\'00001111\',	\'054-1090980\'),'+
    '(\'00001111\',	\'052-1909898\'),'+
    '(\'00002222\', \'054-8978898\'),'+
    '(\'00033333\', \'051-8981891\'),'+
    '(\'00104444\', \'053-0959800\'),'+
    '(\'00104444\', \'054-5985192\'),'+
    '(\'00104444\', \'054-8980898\'),'+
    '(\'01005555\', \'055-9001192\'),'+
    '(\'00016666\', \'054-8989008\'),'+
    '(\'00016666\', \'054-1983898\'),'+
    '(\'10007777\', \'056-8909898\'),'+
    '(\'01008888\', \'054-3989008\'),'+
    '(\'01109999\', \'053-8019898\'),'+
    '(\'01109999\', \'054-8900891\'),'+
    '(\'12345678\', \'052-0989190\');'
);

/*
 *Procedure for check Associating lecturer and takes_place
 */
connection.query(
                    ' CREATE PROCEDURE check_lecturer_and_takes_place(IN acourse_num INTEGER, IN asemester VARCHAR(1),' +
                    '  IN aday INTEGER, IN anum_of_hours INTEGER, IN astart_time INTEGER,' +
                    '  IN aend_time INTEGER, IN alecturer_id VARCHAR(10), IN aclass_num INTEGER)' +
                    ' BEGIN' +

                    '   DECLARE msg VARCHAR(255);' +
                    '   DECLARE acount_lecturer INTEGER;' +
                    '   DECLARE acount_takeplace INTEGER;' +

                    '   SELECT COUNT(course_plus1.course_num) INTO acount_lecturer' +
                    '   FROM(' +
                    '       SELECT (TIME_TO_SEC(takes_place.hour)/3600) as start_time,' +
                    '           (TIME_TO_SEC(DATE_ADD(takes_place.hour, INTERVAL anum_of_hours HOUR))/3600) as end_time,' +
                    '           course.course_num as course_num, takes_place.day as day' +
                    '       FROM takes_place INNER JOIN course ON course.course_num = takes_place.course_num' +
                    '       WHERE	course.lecturer_id = alecturer_id AND course.semester = asemester AND takes_place.day = aday' +
                    '           AND course.course_num != acourse_num' +
                    '   )AS course_plus1' +

                    '   WHERE(' +
                    '       (course_plus1.start_time <= astart_time' +
                    '           AND course_plus1.end_time > astart_time)' +
                    '       OR' +
                    '       (course_plus1.start_time < aend_time' +
                    '           AND course_plus1.end_time >= aend_time)' +
                    '       OR' +
                    '       (course_plus1.start_time >= astart_time' +
                    '           AND course_plus1.end_time <= aend_time)' +
                    '   )' +
                    '   ;' +

                    '   SELECT COUNT(course_plus2.course_num) INTO acount_takeplace' +
                    '   FROM(' +
                    '       SELECT (TIME_TO_SEC(takes_place.hour)/3600) as start_time,' +
                    '       (TIME_TO_SEC(DATE_ADD(takes_place.hour, INTERVAL anum_of_hours HOUR))/3600) as end_time,' +
                    '   course.course_num as course_num, takes_place.day as day' +
                    '   FROM takes_place INNER JOIN course ON course.course_num = takes_place.course_num' +
                    '   WHERE	takes_place.class_num = aclass_num AND course.semester = asemester AND takes_place.day = aday' +
                    '   AND course.course_num != acourse_num' +
                    '   )AS course_plus2' +

                    '   WHERE(' +
                    '   (course_plus2.start_time < astart_time' +
                    '   AND course_plus2.end_time >= astart_time)' +
                    '   OR' +
                    '   (course_plus2.start_time <= aend_time' +
                    '   AND course_plus2.end_time > aend_time)' +
                    '   OR' +
                    '   (course_plus2.start_time >= astart_time' +
                    '   AND course_plus2.end_time <= aend_time)' +
                    '   )' +
                    '   ;' +

                    '   IF((acount_lecturer > 0) OR (acount_takeplace > 0))' +
                    '   THEN' +
                    '   set msg = \"The are Problems with the requested change. Please check the Lecturer or the class scheduele\";' +
                    '   SIGNAL SQLSTATE \'45000\' SET MESSAGE_TEXT = msg;' +
                    '   END IF;' +
                    '   END;'
);



//trigger for delete one of phones if user want to enter more then 3
connection.query(
                    ' CREATE TRIGGER delete_phone BEFORE INSERT ON phone' +
                    ' FOR EACH ROW' +
                    ' BEGIN' +
                    ' DECLARE num_of_phones integer;' +
                    ' DECLARE msg VARCHAR(255);' +
                    ' SELECT COUNT(phone_num) INTO num_of_phones FROM phone WHERE lecturer_id = NEW.lecturer_id;' +
                    ' IF(num_of_phones > 2)' +
                    ' THEN' +
                    ' set msg = \"DIE: You broke the rules... I will now Smite you, hold still...\";' +
                    ' SIGNAL SQLSTATE \'45000\' SET MESSAGE_TEXT = msg;' +
                    ' END IF;' +
                    ' END;'
);

//trigger for checking if lecturer is available before update course to him
connection.query(
                    ' CREATE TRIGGER secure_lecturers_classes BEFORE UPDATE ON course'+
                    ' FOR EACH ROW'+
                    ' BEGIN'+

                    ' DECLARE acourse_num INTEGER;'+
                    ' DECLARE asemester VARCHAR(1);'+
                    ' DECLARE aday INTEGER;'+
                    ' DECLARE anum_of_hours INTEGER;'+
                    ' DECLARE astart_time INTEGER;'+
                    ' DECLARE aend_time INTEGER;'+
                    ' DECLARE alecturer_id VARCHAR(10);'+
                    ' DECLARE aclass_num INTEGER;'+

                    ' SET acourse_num = NEW.course_num;'+
                    ' SET asemester = NEW.semester;'+
                    ' SET anum_of_hours = NEW.num_of_hours;'+
                    ' SET alecturer_id = NEW.lecturer_id;'+

                    ' SELECT course_plus.start_time, course_plus.end_time, course_plus.class_num, course_plus.day'+
                    ' INTO astart_time, aend_time, aclass_num, aday'+
                    ' FROM'+
                    ' ('+
                    ' SELECT (TIME_TO_SEC(takes_place.hour)/3600) as start_time,'+
                    ' (TIME_TO_SEC(DATE_ADD(takes_place.hour, INTERVAL anum_of_hours HOUR))/3600) as end_time,'+
                    ' takes_place.class_num as class_num, course.course_num as course_num, takes_place.day as day'+
                    ' FROM takes_place INNER JOIN course ON course.course_num = takes_place.course_num'+
                    ' )AS course_plus'+
                    ' WHERE	course_plus.course_num = acourse_num;'+


                    ' CALL check_lecturer_and_takes_place(acourse_num, asemester, aday,'+
                    ' anum_of_hours, astart_time, aend_time, alecturer_id, aclass_num);'+
                    ' END;'
);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
 *Insert takes_places
 */

connection.query(
                    ' CREATE TRIGGER secure_lecturers_classes_by_takes_place_insert BEFORE INSERT ON takes_place'+
                    ' FOR EACH ROW'+
                    ' BEGIN'+

                    ' DECLARE acourse_num INTEGER;'+
                    ' DECLARE asemester VARCHAR(1);'+
                    ' DECLARE aday INTEGER;'+
                    ' DECLARE anum_of_hours INTEGER;'+
                    ' DECLARE astart_time INTEGER;'+
                    ' DECLARE aend_time INTEGER;'+
                    ' DECLARE alecturer_id VARCHAR(10);'+
                    ' DECLARE aclass_num INTEGER;'+

                    ' SET acourse_num = NEW.course_num;'+
                    ' SET aday = NEW.day;'+
                    ' SET astart_time = (TIME_TO_SEC(NEW.hour)/3600);'+
                    ' SET aclass_num = NEW.class_num;'+

                    ' SELECT course_plus.semester, course_plus.num_of_hours, course_plus.end_time, course_plus.lecturer_id'+
                    ' INTO asemester, anum_of_hours, aend_time, alecturer_id'+
                    ' FROM'+
                    ' ('+
                    ' SELECT course.semester as semester, course.num_of_hours as num_of_hours,'+
                    ' (course.num_of_hours + astart_time) as end_time, course.lecturer_id as lecturer_id,'+
                    ' course.course_num as course_num'+
                    ' FROM course'+
                    ' WHERE	course.course_num = acourse_num'+
                    ' )AS course_plus;'+

                    ' CALL check_lecturer_and_takes_place(acourse_num, asemester, aday,'+
                    ' anum_of_hours, astart_time, aend_time, alecturer_id, aclass_num);'+
                    ' END;'
);

//disconnection
connection.end();