(function(){
    $(document).ajaxComplete(function() {
        var tdElements = $("tbody tr");
        tdElements[0].style.background = "#bfbfbf";
        for (var i = 2; i < tdElements.length; i += 2) {
            tdElements[i].style.background = "#e6e6e6";
        }
    })
})();
var pageTemplate =  '<div id=wrapper>'+
                        '<header>'+
                            '<a href="index.html"><h1>Alex & Shamir Database Project</h1></a>'+
                        '</header>'+
                        '<nav>'+
                            '<ul id=upperMenu>'+
                                '<li><a href="schedule.html">פערי קורסים</a>'+
                                '<li><a href="Classrooms.html">כיתות</a>'+
                                '<li><a href="courses.html">קורסים</a>'+
                                '<li><a href="lecturers.html">מרצים</a>'+
                                '<li><a href="index.html">דף הבית</a>'+
                            '</ul>'+
                        '</nav>'+
                        '<main>';
                            /*
                            *All your data
                            */
var endOfTemplate =     '</main>'+
                        '<footer><b>&#169Written by Alexander Djura & Shamir Kritzler - all rights reserved&#169</b></footer>'+
                    '</div>';//end of wrapper

function OnLoad(){
    var page=window.location.href;
    var allMenu=document.getElementById("upperMenu");
    var linksOfMenu= allMenu.getElementsByTagName ("a");

    for (j=linksOfMenu.length-1; j>=0; j--){
        current=page.indexOf(linksOfMenu[j].href);
        if (current !=-1){
            break;
        }
    }

    linksOfMenu[j].parentNode.className='markedsublist';
    var objli=linksOfMenu[j].parentNode.parentNode ;
}

function reloadPage(){
    location.reload();
}

/**
 * Created by Shamir on 19-Dec-16.
 */
