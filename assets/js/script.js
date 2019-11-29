document.addEventListener('DOMContentLoaded', function() {
    var instances = M.Sidenav.init(document.querySelectorAll('.sidenav'));
    var gropDown = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
        constrainWidth: false,
        alignment:'right'
    })
    var instances = M.FormSelect.init(document.querySelectorAll('select'));
});