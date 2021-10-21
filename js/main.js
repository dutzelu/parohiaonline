setTimeout(function() {
    $('#dispari').fadeOut('fast');
}, 2000); // <-- time in milliseconds


 
var url = document.URL;
$('.sidebar li:has(a[href="'+url+'"])').addClass('active');

function printImg(url) {
    var win = window.open('');
    win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
    win.focus();
  }