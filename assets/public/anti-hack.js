document.onkeydown = function(e) {	
  if(event.keyCode == 123) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
  }
     if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)) {
     return false;
  }
      if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)) {
     return false;
  }
       if(e.ctrlKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
}



    if (document.addEventListener) { // IE >= 9; other browsers
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        }, false);
    } else { // IE < 9
        document.attachEvent('oncontextmenu', function() {
            window.event.returnValue = false;
        });
    }
	
	
	
		// anti hack and copypaste setting by kawankreatif.com 
	window.onkeypress = function(event) {
    if(event.keyCode === 123) {
     event.preventDefault();
  }
    if (event.charCode === 115 && event.ctrlKey) {
        event.preventDefault();
    }
	if (event.charCode === 99 && event.ctrlKey) {
        event.preventDefault();
    }
		if (event.charCode === 117 && event.ctrlKey) {
        event.preventDefault();
    }
			if (event.charCode === 97 && event.ctrlKey) {
        event.preventDefault();
    }
		if (event.ctrlKey || event.shiftKey && event.charCode === 105 ) {
        event.preventDefault();
    }
			if (event.ctrlKey || event.shiftKey && event.charCode === 99 ) {
        event.preventDefault();
    }
				if (event.ctrlKey || event.shiftKey && event.charCode === 106 ) {
        event.preventDefault();
    }
	};