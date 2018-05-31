
function numsonly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
    // 8 for backspace
    // 32 for space
    // 88 for X
    // 120 for x
    // 9 for tab
    if (unicode !=8 && unicode !=32 && unicode != 88 && unicode != 120 && unicode != 9)
    {  
        // unicode<48||unicode>57 &&
        if (unicode<48||unicode>57)  //if not a number
        return false //disable key press
    }
}

$(document).ready(function () {
    // When the DOM is ready, attach the event handler.
    $('.numsonly').keypress(function (event) {            
        var unicode=event.charCode? event.charCode : event.keyCode
        // 8 for backspace
        // 32 for space
        // 9 for tab
        if (unicode !=8 && unicode !=32 && unicode != 9)
        {  
            // unicode<48||unicode>57 &&
            if (unicode<48||unicode>57)  //if not a number
            return false //disable key press
        }
    });
});