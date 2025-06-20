/**
 * Hiển thị toast bằng SweetAlert2 (Swal)
 * @param {'success'|'error'|'warning'|'info'|'question'} type - Loại icon
 * @param {string} message - Nội dung thông báo
 * @param {number} duration - Thời gian hiển thị (ms)
 */
window.showSwalToast = function(type = 'success', message = '', duration = 2000) {
    if (typeof Swal === 'undefined') {
        console.error('SweetAlert2 chưa được tải!');
        return;
    }

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: duration,
        timerProgressBar: true,
        customClass: {
            popup: 'colored-toast'
        }
    });
};
