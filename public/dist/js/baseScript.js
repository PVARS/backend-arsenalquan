function sweetConfirm(type,message,callback) {
    var title = '';
    switch (type)
    {
        case 1 : {
            title = 'XOÁ';
            break;
        }

        case 2 : {
            title = 'KHOÁ';
            break;
        }

        case 3 : {
            title = 'CHỈNH SỬA';
            break;
        }

        case 4 : {
            title = 'MỞ KHOÁ';
            break;
        }

        case 5 : {
            title = 'THÊM MỚI';
            break;
        }

        case 6 : {
            title = 'THÔNG BÁO';
            break;
        }
        default : {
            break;
        }
    }
    Swal.fire({
        title: title,
        html: message,
        icon: 'warning',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Huỷ',
        showCancelButton: true,
        showCloseButton: true
    }).then(function (confirmed) {
        return callback(confirmed && confirmed.value == true);
    });
};