var course = {
    add: function(){
        var course_num = $("input[name=course_num]").val();
        var course_name = $("input[name=course_name]").val();
        var semester = $("input[name=semester]").val();
        var year = $("input[name=year]").val();
        var num_of_hours = $("input[name=num_of_hours]").val();
        var lecturer_id = $("input[name=lecturer_id]").val();

        if(course_num == "" || course_name == "" || semester == "" || year == "" || num_of_hours == "" || lecturer_id == ""){
            $("#statusMassage").html("You must fill all the fields to add new course!!!");
        } else {
            $.post("./php/add_course.php", {
                c_num: course_num, c_name: course_name, c_semester: semester, c_year: year, c_hours: num_of_hours, l_id: lecturer_id
            }, function(data){
                if(data == "true"){
                    $("#statusMassage").html("Course added");
                    loadData("./php/get_courses_info.php", "#courseTable");
                }else{
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    edit: function(){
        var course_num = $("input[name=course_num]").val();
        var course_name = $("input[name=course_name]").val();
        var semester = $("input[name=semester]").val();
        var year = $("input[name=year]").val();
        var num_of_hours = $("input[name=num_of_hours]").val();
        var lecturer_id = $("input[name=lecturer_id]").val();

        if(course_num == "" || (course_name == "" && semester == "" && year == "" && num_of_hours == "" && lecturer_id == "")){
            $("#statusMassage").html("You must enter course number");
        } else {
            $.post("./php/update_course.php", {
                c_num: course_num, c_name: course_name, c_semester: semester, c_year: year, c_hours: num_of_hours, l_id: lecturer_id
            }, function(data){
                if(data == "true"){
                    $("#statusMassage").html("Course edit");
                    loadData("./php/get_courses_info.php", "#courseTable");
                }else{
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    erase: function(){
        var course_num = $("input[name=course_num]").val();
        var course_name = $("input[name=course_name]").val();
        var semester = $("input[name=semester]").val();
        var year = $("input[name=year]").val();
        var num_of_hours = $("input[name=num_of_hours]").val();
        var lecturer_id = $("input[name=lecturer_id]").val();

        if(course_num == "" || course_name != "" || semester != "" || year != "" || num_of_hours != "" || lecturer_id != ""){
            $("#statusMassage").html("You must enter course number only!");
        } else {
            $.post("./php/erase_course.php", {
                c_num: course_num
            }, function (data) {
                if (data == "true") {
                    $("#statusMassage").html("Course deleted");
                    loadData("./php/get_courses_info.php", "#courseTable");
                } else {
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    }
};

var classroom = {
    add: function(){
        var floor_num = $("input[name=floor_num]").val();
        var class_num = $("input[name=class_num]").val();
        var building_name = $("input[name=building_name]").val();

        if(floor_num == "" || class_num == "" || building_name == ""){
            $("#statusMassage").html("You must fill all fields to add new Classroom!!!");
        } else {
            $.post("./php/add_class.php", {
                f_num: floor_num, c_num: class_num, b_name: building_name
            }, function(data){
                if(data == "true"){
                    $("#statusMassage").html("Classroom added");
                    loadData("./php/get_classes_info.php", "#classTable");
                }else{
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    edit: function(){
        var floor_num = $("input[name=floor_num]").val();
        var class_num = $("input[name=class_num]").val();
        var building_name = $("input[name=building_name]").val();

        if(class_num == "" || (floor_num == "" && building_name == "")){
            $("#statusMassage").html("You must enter class number");
        } else {
            $.post("./php/update_class.php", {
                f_num: floor_num, c_num: class_num, b_name: building_name
            }, function(data){
                if(data == "true"){
                    $("#statusMassage").html("Class edit");
                    loadData("./php/get_classes_info.php", "#classTable");
                }else{
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    erase: function(){
        var floor_num = $("input[name=floor_num]").val();
        var class_num = $("input[name=class_num]").val();
        var building_name = $("input[name=building_name]").val();

        if(class_num == "" || floor_num != "" || building_name != ""){
            $("#statusMassage").html("You must enter classroom number only!");
        } else {
            $.post("./php/erase_class.php", {
                c_num: class_num
            }, function (data) {
                if (data == "true") {
                    $("#statusMassage").html("Class deleted");
                    loadData("./php/get_classes_info.php", "#classTable");
                } else {
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    search: function(){
        var class_num = $("input[name=xxx]").val();

        if(class_num == ""){
            $("#statusMassage").html("You must enter class number only!");
        } else {
            $.post("./php/get_class_query_info.php", {
                c_num: class_num
            }, function (data) {
                    $("#classTable").html(data);
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    }
};

var lecturer = {
    add: function(){
        var lecturer_id = $("input[name=lecturer_id]").val();
        var first_name = $("input[name=first_name]").val();
        var last_name = $("input[name=last_name]").val();
        var phone = $("input[name=phone]").val();
        var birthdate = $("input[name=birthdate]").val();
        var address = $("input[name=address]").val();

        if(lecturer_id != "" && phone != "" && first_name == "" && last_name == "" && birthdate == "" && address == ""){
            $.post("./php/add_lecturer_phone.php", {
                l_id:lecturer_id, phone_num:phone
            }, function(data){
                if(data == "true"){
                    $("#statusMassage").html("Phone added");
                    loadData("./php/get_lecturers_info.php", "#lecturerTable");
                }else{
                    $("#statusMassage").html(data);
                }
            });
        } else if(lecturer_id == "" || first_name == "" || last_name == "" || birthdate == "" || address == "" || phone == ""){
            $("#statusMassage").html("You must fill all fields to add new lecturer!!!");
        }else {
            $.post("./php/add_lecturer.php", {
                    l_id: lecturer_id, f_name: first_name, l_name: last_name, phone_num: phone, b_date: birthdate, address: address
            }, function(data){
                if(data == "true"){
                    $("#statusMassage").html("Lecturer added");
                    loadData("./php/get_lecturers_info.php", "#lecturerTable");
                }else{
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    edit: function(){
        var lecturer_id = $("input[name=lecturer_id]").val();
        var first_name = $("input[name=first_name]").val();
        var last_name = $("input[name=last_name]").val();
        var phone = $("input[name=phone]").val();
        var birthdate = $("input[name=birthdate]").val();
        var address = $("input[name=address]").val();

        if(lecturer_id == "" || (first_name == "" && phone == "" && last_name == "" && birthdate == "" && address == "")){
            $("#statusMassage").html("You must enter lecturer id");
        }else if(phone != ""){
            $("#statusMassage").html("You can't update the number");
        } else {
            $.post("./php/update_lecturer.php", {
                l_id:lecturer_id, f_name:first_name, l_name:last_name, b_date:birthdate, address: address
            }, function(data){
                if(data == "true"){
                    $("#statusMassage").html("Lecturer added");
                    loadData("./php/get_lecturers_info.php", "#lecturerTable");
                }else{
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    erase: function(){
        var lecturer_id = $("input[name=lecturer_id]").val();
        var first_name = $("input[name=first_name]").val();
        var last_name = $("input[name=last_name]").val();
        var phone = $("input[name=phone]").val();
        var birthdate = $("input[name=birthdate]").val();
        var address = $("input[name=address]").val();

        if(lecturer_id == "" || first_name != "" || last_name != "" || birthdate != "" || address != ""){
            $("#statusMassage").html("You must enter lecturer ID only or Phone for delete!");
        } else {
            $.post("./php/erase_lecturer.php", {
                l_id: lecturer_id, phone_num: phone
            }, function (data) {
                if (data == "true1") {
                    $("#statusMassage").html("Lecturer deleted");
                    loadData("./php/get_lecturers_info.php", "#lecturerTable");
                }else if (data == "true2") {
                    $("#statusMassage").html("Lecturer number deleted");
                    loadData("./php/get_lecturers_info.php", "#lecturerTable");
                }
                else {
                    $("#statusMassage").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    },
    search: function(){
        var lecturer_id = $("input[name=xxx]").val();

        if(lecturer_id == ""){
            $("#statusMassage").html("You must enter lecturer ID only!");
        } else {
            $.post("./php/get_lecturer_query_info.php", {
                l_id: lecturer_id
            }, function (data) {
                $("#lecturerTable").html(data);
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    }
};

var schedule = {
    update: function(){
        var course_num = $("input[name=course_num]").val();
        var lecturer_id = $("input[name=lecturer_id]").val();
        var class_num = $("input[name=class_num]").val();
        var day = $("input[name=day]").val();
        var hour = $("input[name=hour]").val();
        if(course_num == "") {
            $("#statusMassage").html("You must fill all fields!!!");
        } else{
            hour = (!hour)?hour:(hour+":00:00");
            $.post("./php/update_schedule.php", {
                l_id:lecturer_id, co_num:course_num, cl_num:class_num, day:day, hour:hour
            }, function (data) {
                if (data == "true") {
                    $("#statusMassage").html("The course"+ "Associate with class" +class_num);
                    loadData("./php/get_unpaired_courses_table_info.php", "#unpairedCoursesTable");
                } else {
                    $("#statusMassage").html("The not course Associate");
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");

    }
};
/*, hour:(!hour)?hour:hour+":00:00"*/

function loadData(file, element){
    var aElement = $(element);
    $.post(file, function(data){
        aElement.html(data);
    });
}

function eraseDelay(element, msg){
    setTimeout(function(){
        $(element).html(msg);
    },5000);
}

var index = {
    search: function(){
        var startDay = $("#fromDay").val();
        var endDay = $("#toDay").val();
        var startHour = $("input[name=fromHour]").val();
        var endHour = $("input[name=toHour]").val();
        startHour = (!startHour)?startHour:(startHour+":00:00");
        endHour = (!endHour)?endHour:(endHour+":00:00");
        if(startDay == "" || endDay == "" || startHour == "" || endHour == "") {
            $("#statusMassage").html("You must fill all fields!!!");

        } else{

            $.post("./php/get_schedule_query_info.php", {
                    s_day:startDay, e_day:endDay, s_hour:startHour, e_hour:endHour
            }, function (data) {
                if (data == "true") {
                    $("#statusMassage").html("Teaches updated");
                    loadData("./php/get_unpaired_courses_table_info.php", "#unpairedCoursesTable");
                } else {
                    $("#scheduleTable").html(data);
                }
            });
        }
        eraseDelay("#statusMassage", "Enter and submit");
    }
};