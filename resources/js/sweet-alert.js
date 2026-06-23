window.sweet_alert = function sweet_alert(response) {
    Swal.fire({
        icon: response.icon,
        title: response.message,
        timer: response.autoClose,
        showConfirmButton: false,
    });
}
