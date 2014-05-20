var tts;
$(function() {
    $('#menu h1, #menu a, #home').each(function(index) {
        var $element = $(this);
        if($element.hasClass("casting-pub")) {
        } else {
            var currentText = $element.html();
            $element.html('');
            setTimeout(function() {
                populate(currentText, $element, 0)
            }, index*Math.random()*200);

            $(document).click(function() {
                $element.shouldStopPopulate = true;
            });
        }
    });
    $('.datas').each(function(index) {
        var $element = $(this);
        var currentText = $element.html();
        $element.html('');
        setTimeout(function() {
            populate(currentText, $element, 0)
        }, 1);

        $(document).click(function() {
            $element.shouldStopPopulate = true;
        });
    });
    $(document).mousemove(function(event) {
        var mouseX = event.pageX;
        var mouseY = event.pageY;

        var containerCenterX = $('#neron').offset().left;
        var containerCenterY = $('#neron').offset().top;

        var x = (mouseX - containerCenterX)/$(document).width()*60;
        var y = (mouseY - containerCenterY)/$(document).height()*60;
        var z = Math.sqrt(x*x+y*y);
        if(z > 30) {
            x = x * 30/z;
            y = y * 30/z;
        }
        $('#neron #eye').css('background-position', (x-32.5+50)+'px '+(y-32.5+50)+'px');
    });
});

var randomString = function(L){
    var s= '';
    var randomchar=function(){
        var n= Math.floor(Math.random()*62);
        if(n<10) return n; //1-10
        if(n<36) return String.fromCharCode(n+55); //A-Z
        return String.fromCharCode(n+61); //a-z
    }
    while(s.length< L) s+= randomchar();
    return s;
}

var populate = function(currentText, $element, index) {
    if(index == undefined) index = 0;

    if(currentText.length > 100) {
        $element.html(currentText.substring(0, Math.max(0, index)));
    } else {
        $element.html(randomString(index));
    }

    if(index < currentText.length && !$element.shouldStopPopulate) {
        var delay = 60;
        if(currentText.length > 10) delay = 30;
        if(currentText.length > 100) delay = 15;
        setTimeout(function() {populate(currentText, $element, index+1)}, delay);
    } else {
        $element.html(currentText);
    }

    if($element.shouldStopPopulate) {
        $element.html(currentText);
    }
}