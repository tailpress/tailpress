// Navigation toggle
window.addEventListener('load', function () {
    let main_navigation = document.getElementById('primary-navigation');

    document.querySelector('#primary-menu-toggle').addEventListener('click', function (e) {
        e.preventDefault();
        main_navigation.classList.toggle('hidden');
    });
});
