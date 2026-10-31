<?php
//$time = json_decode($_POST['time'], true);
if(isset($_POST['different'])){
    $different = $_POST['different'];
}
if(isset($_POST['title'])){
    $title = $_POST['title'];
}
$category = $_POST['category'];
$time = $_POST['time'];
$counter = $_POST['counter'];
$title = $_POST['title'];
if(isset($_POST['user'])){
    $user = $_POST['user'];
}
if(isset($_POST['is_solved'])){
    $is_solved = $_POST['is_solved'];
}
?>
<div id="time" data-time="<?= htmlspecialchars($time, ENT_QUOTES, 'UTF-8') ?>"></div>
<div id="counter" data-counter="<?= $counter ?>"></div>
<?php if(isset($title)):?>
    <div id="title" data-titlee="<?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>"></div>
<?php endif;?>
<?php if(isset($is_solved)):?>
    <div id="is_solved" data-is_solved="<?= htmlspecialchars($is_solved, ENT_QUOTES, 'UTF-8') ?>"></div>
<?php endif;?>
<?php if(isset($user)):?>
    <div id="user" data-user="<?= htmlspecialchars($user, ENT_QUOTES, 'UTF-8') ?>"></div>
<?php endif;?>
<?php if(isset($different)):?>
    <div id="different"></div>
<?php endif;?>
<div id="category" data-category="<?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8') ?>"></div>

<!DOCTYPE html>
<html>
<head>
<script>
console.log('executed');
function formatTimeAgo(defaultDate) {
    // Parse the input date string as if it's in UTC (default timezone)
    const userDate = new Date(defaultDate);
    console.log(userDate);
    now2 = new Date();
    now = new Date(now2.getTime() + now2.getTimezoneOffset() * 60000);
    console.log(now);
    const diffMs = now - userDate;
    console.log(diffMs);
    userDate2 = new Date(userDate.getTime() - userDate.getTimezoneOffset() * 60000);
    const diffMinsTotal = Math.floor(diffMs / (1000 * 60));
    const diffHoursTotal = Math.floor(diffMinsTotal / 60);
    const diffDays = Math.floor(diffHoursTotal / 24);
    const hours2 = userDate2.getHours().toString().padStart(2, '0');
    const minutes2 = userDate2.getMinutes().toString().padStart(2, '0');
    if (diffMinsTotal < 60) {
        return `${diffMinsTotal} minute${diffMinsTotal !== 1 ? 's' : ''} ago at ${hours2}:${minutes2}`;
    } else if (diffHoursTotal < 24) {
        let hours = diffHoursTotal;
        let minutes = diffMinsTotal % 60;
	console.log(`${hours} hour${hours !== 1 ? 's' : ''} ${minutes} minute${minutes !== 1 ? 's' : ''} ago at ${hours2}:${minutes2}`);
        return `${hours} hour${hours !== 1 ? 's' : ''} ${minutes} minute${minutes !== 1 ? 's' : ''} ago at ${hours2}:${minutes2}`;
    } else {
	console.log(`${diffDays} day${diffDays !== 1 ? 's' : ''}`);
        return `${diffDays} day${diffDays !== 1 ? 's' : ''} ago at ${hours2}:${minutes2}`;
    }
}
const keys = ["timeAgo", "counter", "execute", "category"];
const times = JSON.parse(document.getElementById("time").dataset.time);
const counter = document.getElementById("counter").dataset.counter;
let result = []
const category = document.getElementById("category").dataset.category;
const execute = true;
const form = document.createElement("form");
if(!document.querySelector("#different")){
    console.log("executed");
    const title = document.getElementById("title").dataset.titlee;
    keys.push("title");
    times.forEach((time, index) => {
	result.push(formatTimeAgo(time));
    });
    values = [result, counter, execute, category, title];
    form.method = "POST";
    form.action = "content.php";
} else {
    times.forEach((time, index) => {
        result.push(formatTimeAgo(time.date));
    });
    if(document.querySelector("#title")){
        const title = document.getElementById("title").dataset.titlee;
	values = [result, counter, execute, category, title];
	keys.push("title");
    } else if(document.querySelector("#user")){
	const user = document.getElementById("user").dataset.user;
	values = [result, counter, execute, category, user];
	keys.push("user");
    } else if(document.querySelector("#is_solved")){
	const is_solved = document.getElementById("is_solved").dataset.is_solved;
	values = [result, counter, execute, category, is_solved];
	keys.push("is_solved");
    } else {
        values = [result, counter, execute, category];
    }
    form.method = "GET";
    form.action = "forum.php";
}
console.log("keys" + keys);
console.log("result", result);
console.log("category" + category)
keys.forEach(key => {
    const input = document.createElement("input");
    input.type = "hidden";
    input.name = key;
    input.value = values[keys.indexOf(key)];
    console.log("input", key);
    console.log("value", values[keys.indexOf(key)]);
    form.appendChild(input);
});
document.body.appendChild(form);
form.submit();
</script>
</head>
</html>
