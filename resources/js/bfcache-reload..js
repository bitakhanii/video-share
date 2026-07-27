window.addEventListener('pageshow', function (event) {
    console.log('pageshow fired, persisted:', event.persisted);
    if (event.persisted) {
        window.location.reload();
    }
});
