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

// dezactivează căsuța de upload a unei fotografii la un click pe checkbox

  function disableMyInput(){  
       if(document.getElementById("checkMe").checked == true){  
           document.getElementById("tata_ci").disabled = true;  
       }else{
         document.getElementById("tata_ci").disabled = false;
       }  
  }  

// verifică extensia unei fotografii la upload

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Fișierul, " + sFileName + " este invalid, puteți încărca doar fotografii cu extensiile: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}


function validateSize(input) {
    const fileSize = input.files[0].size / 1024 / 1024; // in MiB
         var sFileName = input.value;
    if (fileSize > 10) {
      alert('Imaginea nu trebuie să depășească 10 Mb în dimensiune. Alegeți altă imagine.');
      input.value = "";
    } else {
      // Proceed further
    }
  }


