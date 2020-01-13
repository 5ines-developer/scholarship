document.addEventListener('DOMContentLoaded', function() {
    M.Sidenav.init(document.querySelectorAll('.sidenav'));
    M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'), {
        constrainWidth: false,
        alignment:'right'
    })
    var instances = M.FormSelect.init(document.querySelectorAll('select'));
    M.Modal.init(document.querySelectorAll('.modal'));

    var elems = document.querySelectorAll('.collapsible');
     var instances = M.Collapsible.init(elems);
});