<!DOCTYPE html>
<html lang="en">
<head>
<h1>ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS USER</h2>
    <script>
        // JavaScript function to send an AJAX request
        function executePhpCode() {
            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            // Configure the request
	    var deletion_method = document.getElementById("deletion_method").getAttribute("data-php-var");
            if(deletion_method == "user_deletion"){
	        xhr.open('POST', 'delete_user.php', true);
	    } else {
		xhr.open('POST', 'delete_all.php', true);
	    }
            ethr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            // Set up a callback function for when the request is completed
	    /*
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Handle the response from the server
                    alert('PHP code executed: ' + xhr.responseText);
                } else {
                    alert('Request failed. Status: ' + xhr.status);
                }
            };
	    */
            // Send the request with any data (optional)
            xhr.send('action=execute_code');
        }
    </script>
</head>
<body>
<div id="deletion_method" data-php-var=<?=$_POST['deletion_method']?>></div>
<button onclick="executePhpCode()">DELETE USER AND OR RELATED POSTS</button>
</body>
<html>
