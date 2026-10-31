<!DOCTYPE html>
<html>
<head>
    <title>User List (Auto Refresh)</title>
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        form { margin: 0; }
        button { padding: 6px 12px; background: #c00; color: white; border: none; cursor: pointer; }
        button:hover { background: #900; }
    </style>
    <script defer>
        function loadUserTable() {
            fetch('adminapproval.php')
                .then(response => response.text())
                .then(html => {
		    //console.log(html);
                    document.getElementById('user-table-body').innerHTML = html;
                });
        }
	async function deleteUser(event, email) {
	    event.preventDefault();
	    if (!confirm("Delete this user?")) return;
	    await fetch('delete_user2.php', {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		body: `email=${encodeURIComponent(email)}`
	    });
	    loadUserTable(); // Refresh after delete
	}
	async function approveAll(event, emails) {
            event.preventDefault();
	    console.log('asdfljkh');
            if (!confirm("Approve all?")) return;
	    const params = new URLSearchParams();
	    emails.forEach(e => params.append('emails[]', e));
            await fetch('approveAll.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            });
            loadUserTable(); // Refresh after delete
        }
        setInterval(loadUserTable, 500); // Refresh every 3 seconds
        window.onload = loadUserTable;
    </script>
</head>
<body>
<h2 style="text-align:center;">User List (Auto Refresh)</h2>
<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="user-table-body">
        <!-- Filled by JavaScript via AJAX -->
    </tbody>
</table>
</body>
</html>
