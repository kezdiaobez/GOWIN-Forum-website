window.onload = function() {
    // Get the user's timezone
    const userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

    // If timezone is available, send it to the server via fetch
    if (userTimeZone) {
        fetch('whatsnew.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `timezone=${encodeURIComponent(userTimeZone)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log('Timezone sent:', data); // Log the response from the server
        })
        .catch(error => {
            console.error('Error sending timezone:', error);
        });
    }
};
