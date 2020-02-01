//This is the main error checker.  This creates the error messages on the screen and changes the color of the form
//  field that needs editing.
function ErrorCheck(name,message,extra) {
	document.getElementById(name).style.background = "white"; 
	if(document.getElementById(name).value == '') {
		document.getElementById('errors').innerHTML += "<div class='ErrorMessage'>" + message + "</div>";
		document.getElementById(name).style.background = "#FFDFE6"; 
		return 1;
	} else if(extra_validate != null) {
		chk = extra_validate(name,extra);
		if(chk == null) { return 0; } else { document.getElementById('errors').innerHTML += "<div class='ErrorMessage'>" + chk + "</div>"; return 1; }
	}
	
	return 0;
}

function matchPasswordsAdd(name, name2){
	document.getElementById(name).style.background = "white"; 
	document.getElementById(name2).style.background = "white"; 
	if( document.getElementById('chrPassword').value == '' || document.getElementById('chrPassword2').value == ''){
			document.getElementById('errors').innerHTML += "<div class='ErrorMessage'>" + 'Please enter a password and verify it' + "</div>";
			document.getElementById(name).style.background = "#FFDFE6"; 
			document.getElementById(name2).style.background = "#FFDFE6"; 
			return 1;
	}
	else if(document.getElementById(name).value != document.getElementById(name2).value) {
			document.getElementById('errors').innerHTML += "<div class='ErrorMessage'>" + 'Password does not match' + "</div>";
			document.getElementById(name).style.background = "#FFDFE6"; 
			document.getElementById(name2).style.background = "#FFDFE6"; 
			return 1;		
	}
	return 0;
}

function matchPasswords(name, name2, message) {
	document.getElementById(name).style.background = "white"; 
	document.getElementById(name2).style.background = "white"; 
	if( document.getElementById('chrPassword').value != '' || document.getElementById('chrPassword2').value != ''){		
		if(document.getElementById(name).value != document.getElementById(name2).value) {
			document.getElementById('errors').innerHTML += "<div class='ErrorMessage'>" + message + "</div>";
			document.getElementById(name).style.background = "#FFDFE6"; 
			document.getElementById(name2).style.background = "#FFDFE6"; 
			return 1;
		}
	}
	return 0;
}

// Extra validations to check with.  
function extra_validate(name,check_this) { 
	// This checks for any and all known email formats.
	if(check_this == 'email') {
		var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(document.getElementById(name).value)) { 
			return "This is an invalid email address."; 
		} else {
		
			var XMLHttpRequestObject = false; 
		
			if (window.XMLHttpRequest) { XMLHttpRequestObject = new XMLHttpRequest();
			} else if (window.ActiveXObject) {
				XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
			}
			
			/*if(XMLHttpRequestObject) {
				XMLHttpRequestObject.open("GET", "ajax_emailcheck.php?chrEmail="+ document.getElementById(name).value);
			
				XMLHttpRequestObject.onreadystatechange = function() { 
					if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) { 
						if(XMLHttpRequestObject.responseText == 1) { 
							document.getElementById('errors').innerHTML += "<div class='ErrorMessage'>This email address already exists in the Database.</div>";
						}
					} 
				} 
			
				XMLHttpRequestObject.send(null); 
			}*/
		}
	}
	// Currently this only supports North American phone numbers.  All formats included
	if(check_this == 'phone') {
		var filter  = /^\(?\d{3}(\)?|\s?|-?|.?)?\s?\d{3}(-?|.?)\d{4}$/;
		if (!filter.test(document.getElementById(name).value)) { return "This is an invalid phone number."; }
	}
	// This is the postal code for North America.  It checks the Canadian/American/Mexican postal codes.
	if(check_this == 'postal_code') {
		var filter = /^(\d{5}(-\d{4}\d?)?)$|^([A-Za-z]\d[A-Za-z] \d[A-Za-z]\d)$/;
		if (!filter.test(document.getElementById(name).value)) { return "This is an invalid postal code."; }
	}
}

// This resets the errors if some were listed on the page previously.
function reset_errors() {
	if(document.getElementById('errors').value != '') {	document.getElementById('errors').innerHTML = ""; }
}

// Encode the URI.  This is used to send information back and forth from the server in an encoded method.
var escapeCounter = 0;
function encItem (val) {
	if(escapeCounter++ > 0) {
		return "&" + val + "=" + encodeURI( document.getElementById(val).value );
	} else {
		return val + "=" + encodeURI( document.getElementById(val).value );
	}
}

// The security part of the edit / add / change pages.  Lets you hide the nasty stuff
function securityBody(name) {
	if(document.getElementById('securityBody').style.display == 'none') {
		document.getElementById('securityTitle').innerHTML = '- '+ name +' Security';
		document.getElementById('securityBody').style.display = "block";
	} else {
		document.getElementById('securityTitle').innerHTML = '+ '+ name +' Security';
		document.getElementById('securityBody').style.display = "none";
	}
}
