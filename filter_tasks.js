function filterTasks() {
    var filterType = document.getElementById("filter-type").value;
    var taskDate = document.getElementById("task-date").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("task-list-body").innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "filter_tasks.php?filterType=" + filterType + "&taskDate=" + taskDate, true);
    xhr.send();
}

document.getElementById("filter-type").addEventListener("change", filterTasks);
document.getElementById("task-date").addEventListener("change", filterTasks);