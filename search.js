function search() {
    var searchInput = document.getElementById('searchInput').value;
    var foundPages = {
        'page1': 'page1.html',
        'page2': 'page2.html',
        // Add more pages and their corresponding URLs here
    };

    if (foundPages.hasOwnProperty(searchInput)) {
        window.location.href = foundPages[searchInput];
    } else {
        window.location.href = 'notfound.html';
    }
}
