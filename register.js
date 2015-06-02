function accountCreation(){
	  var username1 = document.getElementById ("username");
	  var password1 = document.getElementById ("password");
	  var password2 = document.getElementById ("repass");
	console.log(username1.value);
	console.log(password1.value);
	console.log(validUser(username1.value,password1.value,password2.value));
	if(validUser(username1.value,password1.value,password2.value) == false){
		return false;
	} else{
		var httpRequest = new XMLHttpRequest();
		
		httpRequest.open("GET", "../HealthyKids/register.php?username="+username1.value+"&password="+password1.value, true);
		httpRequest.send();
		
		httpRequest.onreadystatechange = function() {
			if (httpRequest.readyState === 4 && httpRequest.status === 200) {
				if(JSON.parse(httpRequest.responseText) == 10){
					error.innerHTML = "<label id = 'passwordError'> wrong account! </label>";
				} else if(JSON.parse(httpRequest.responseText) == 11) {
					window.location.replace("http://web.engr.oregonstate.edu/~bauerbr/HealthyKids/new.html");
				}
			
		
			}
		}
		
		
	}
}


function validUser(username,password,repass){
	var check = true;
	var error = document.getElementById('error');
	if((password.length < 5) || (password.length > 15)){
		error.innerHTML = "<label id = 'passwordError'> Password Invalid! </label>";
		check = false;
	}
	if(username.length > 40){
		error.innerHTML = "<label id = 'passwordError'> User-name Invalid! </label>";
		check = false;
	}
	if(password.localeCompare(repass) != 0){
		error.innerHTML = "<label id = 'passwordError'> Passwords do not match. </label>";
		check = false;
	}
	if(password.length == 0 && username.length == 0){
		error.innerHTML = "<label id = 'passwordError'> No password entered or User-name! </label>";
		check = false;
	} else if(username.length == 0){
		error.innerHTML = "<label id = 'passwordError'> No User-name entered </label>";
		check = false;
	} else if(password.length == 0){
		error.innerHTML = "<label id = 'passwordError'> No password entered! </label>";
		check = false;
	}
	
	return check;
}
//http://stackoverflow.com/questions/17564795/destroy-a-php-session-on-clicking-a-link This helped out with the next function




function login(){
	  var username2 = document.getElementById ("username");
	  var password3 = document.getElementById ("password");
	console.log(username2.value);
	console.log(password3.value);
	console.log(validUser(username2.value,password3.value,password3.value));
	if(validUser(username2.value,password3.value,password3.value) == false){
	return false;
	} else{
		console.log("bug");
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET", "../Final/ajax.php?username="+username2.value+"&password="+password3.value, true);
		xmlhttp.send();
		console.log("bug");
  
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
				console.log("Connection successful");
					if(JSON.parse(xmlhttp.responseText) == 10){
					error.innerHTML = "<label id = 'passwordError'> wrong account! </label>";
				} else if(JSON.parse(xmlhttp.responseText) == 15) {
					window.location.replace("http://web.engr.oregonstate.edu/~bauerbr/Final/final.php");
				}
			console.log(JSON.parse(xmlhttp.responseText));
				
		}
		}
	}
 
}


