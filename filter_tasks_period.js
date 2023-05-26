function filterTasksByPeriod(period) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("task-list-body").innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "filter_tasks.php?filterType=" + period, true);
    xhr.send();
}