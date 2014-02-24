function changeAction(type) {    
        		if(type == "login") {
        			var url = "http://" + document.loginForm.universe.value + "/index.php";
        			document.getElementById('loginForm').action = url;		
        		} else if (type=="getpw") {
        			var url = "http://" + document.loginForm.universe.value + "/mail.php";
        			document.loginForm.action = url;
        		    document.loginForm.submit();
        		} else if(type == "register") {
        			var url = "http://" + document.registerForm.universe.value + "/register.php";
        			document.registerForm.action = url;
        		}
        }
