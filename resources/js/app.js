require('bootstrap')

var Turbolinks = require('turbolinks');
Turbolinks.start();

var userInfo = JSON.parse(localStorage.getItem('user_data'));

// if (userInfo) {
//     $.ajaxSetup({
//         headers: {
//             'Authorization': 'Bearer ' + userInfo.access_token
//         }
//     });
// } else {
//     window.location.href = 'http://127.0.0.1:8000/admin/login';
// }

if(!userInfo && window.location.href !== '{{ route("admin") }}'){
    window.location.href = 'http://127.0.0.1:8000/admin/login';
}