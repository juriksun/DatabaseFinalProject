//Course:Databases
//Submmition: Final Project
//Student: Alexander Djura
//Student: Shamir Kritzler
//Languige: javaScript,Node.js
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
//disconnection
connection.end();