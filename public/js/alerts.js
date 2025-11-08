document.addEventListener('DOMContentLoaded', function () {
    const alert = document.querySelector('.alert-custom');
    if (alert) {
        setTimeout(() => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        }, 3000);
    }
});
