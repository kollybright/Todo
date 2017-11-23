/**
 * Created by Kollybright on 11/23/2017.
 */

$(document).ready(function () {
    $('#input').hide();
    $('#up').hide();

//to add event
    $('#plus').click(function () {
        $(window).scrollTop(0);
        $('#input').slideDown();
        return false;
    });
//sending event to database
    $('#add').click(function(){
        var form = $('#form1').serialize();
        var link='insert.php';
        var Type='POST';
        $.ajax({
            type: Type,
            url: link,
            data: form,
            dataType:'html',
            success: function(result){

                if ( result="you need to enter both fields"){

                    document.getElementById('error').innerHTML = "you need to enter both fields";

                }
                if(result="reload"){

                    location.reload(true);
                }


            }
        });
    });


//to edit event
    $('.edit').click(function () {
        var identity = $(this).children().eq(0).val();
        var event = $(this).children().eq(1).val();
        var time = $(this).children().eq(2).val();


        // $.post('update.php',{id:identity});
        localStorage.setItem('idd',identity);
        $(window).scrollTop(0);
        $('#input').slideDown();
        $('#add').hide();
        $('#up').show();
        $('#event').val(event);
        $('#time').val(time)
        return false;

    });


//deleting event
    $('[name=delete]').click(function () {
        var iden = $(this).children().eq(0).val();
        $.post('delete.php', {the: iden}, function (result) {
            if(result="reload"){
                location.reload(true);
            }


        });

    });

});



//update function
function update() {

    var xml;
    if(window.XMLHttpRequest){
        xml=new XMLHttpRequest();//for Chrome, mozilla etc
    }
    else if(window.ActiveXObject){
        xml=new ActiveXObject("Microsoft.XMLHTTP");//for IE only
    }
    var events = document.getElementById("event").value;
    var times = document.getElementById("time").value;
    var ids= localStorage.getItem('idd');
    xml.onreadystatechange = function () {
        if (xml.readyState ==4 && xml.status==200) {
            if (xml.responseText="you need to enter both fields") {
                document.getElementById('error').innerHTML="you need to enter both fields";

            }
            if(xml.responseText="reload"){
                location.reload(true);
            }

        }
    }
    var url="update.php?event="+events+"&time="+times+"&id="+ids;


    xml.open("GET", url, true);


    xml.send();localStorage.removeItem('idd');

    localStorage.removeItem('idd');
}


