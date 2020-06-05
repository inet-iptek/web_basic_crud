const keyword = document.querySelector('.keyword');
const container = document.querySelector('.container');


// Ajax Live Search
keyword.addEventListener('keyup', function() {
    // Ajax Live Search using fetch

    // fetch()

    fetch('ajax/ajax_search.php?keyword=' + keyword.value)
        .then((response) => response.text())
        .then((response) => (container.innerHTML = response));
});
