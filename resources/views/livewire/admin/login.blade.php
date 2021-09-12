<!DOCTYPE html>
<html lang="en">

<head>
    @include('livewire.admin.container.head')
    <style>
        .text-small {
            color: red;
        }
    </style>
</head>

<body>
    <noscript>Trang web của bạn không hỗ trợ JavaScript</noscript>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" placeholder="Tên đăng nhập..." id="username" value="vupv">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" placeholder="Mật khẩu..." id="password" value="111111">
                                </div>
                                <div class="alert alert-danger d-none" role="alert"></div>
                                <a href="javascript:void(0)" class="btn btn-arsquan btn-user btn-block" id="btn-login">
                                    Đăng nhập
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    @include('livewire.admin.container.script')
    <script>
        function validation(){
            let errors = [];

            if($('#username').val() === ''){
                errors.push('Vui lòng nhập tên đăng nhập.');
            } else if($('#username').val().length < 3 || $('#username').val().length > 254){
                errors.push('Tên đăng nhập không được bé hơn 3 và lớn hơn 254 ký tự.');
            }

            if($('#password').val() === ''){
                errors.push('Vui lòng nhập mật khẩu.');
            } else if($('#password').val().length < 6 || $('#password').val().length > 50){
                errors.push('Mật khẩu không được bé hơn 6 và lớn hơn 50 ký tự.');
            }
            
            let error = handleError(errors);
            
            if(error){
                showMessage(error);
            } else {
                removeMessage();
                return true;
            }
        }

        $(function(){
            $('#btn-login').on('click', function(e){
                e.preventDefault();

                if(validation() === true){
                    let login_id = $('#username').val();
                    let password = $('#password').val();

                    $.ajax({
                        url: '{{ route("apiLogin") }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: { login_id: login_id, password: password },
                        success: function(reponse){
                            localStorage.setItem('user_data', JSON.stringify(reponse));
                            window.location.href = '{{ route("admin") }}';
                            $.ajaxSetup({
                                headers: {
                                    'Authorization': 'Bearer ' + reponse.access_token
                                }
                            });
                        },
                        error: function(error){
                            showMessage(error.responseJSON.message);
                        }
                    })
                }
            })
        })
    </script>
</body>

</html>