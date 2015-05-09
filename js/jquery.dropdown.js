/* 
 * dropdown java script
 */

var header = undefined;
var menu = undefined;
var menuButton = undefined;
 
$(document).ready(function(){
    header = $("header");
    menu = $("header nav ul");
    menuButton = $("<div class='menu'><a href='#'>menu</a></div>");
    menuButton.click(showMenu);
    header.append(menuButton);
})
 
function showMenu (event) {
    if (menu.is(":visible"))
        menu.slideUp({complete:function(){$(this).css('display','')}});
    else
        menu.slideDown();
}




