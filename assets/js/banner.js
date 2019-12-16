document.getElementById('search').addEventListener('click', (e) => {
    e.preventDefault();

    if (location.pathname === "/") {
        location.hash = '';
        location.hash = 'root';
    } else {
        location.pathname = '/';
    }
});