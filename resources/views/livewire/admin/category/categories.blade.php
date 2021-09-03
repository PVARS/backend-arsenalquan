<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $title }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Tên danh mục</label>
                            <input type="text" class="form-control" placeholder="Danh mục">
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Người tạo</label>
                            <select id="inputStatus" class="form-control custom-select">
                                <option selected="" disabled="">Vui lòng chọn</option>
                                <option>On Hold</option>
                                <option>Canceled</option>
                                <option>Success</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button class="btn btn-primary float-right" type="button" id="btn-search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            &nbsp;Tìm kiếm
                        </button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0 table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Danh mục</th>
                                    <th>Người tạo</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center">Số bài viết</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody id="tbody"></tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var API_CATEGORIRES = "{{ $baseAPI }}" + "/category";
    
    $(function(){
        $('#btn-search').on('click', function(){
            $.ajax({
                url: API_CATEGORIRES,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(xhr){
                    xhr.setRequestHeader('Authorization', 'Bearer GD9WYMTtRWpZhLNlQGbjG1QhQ5LLvYyC0cJyBeSP');
                },
                success: function(reponse){
                    let html = '';
                    if(reponse) {
                        $.each(reponse, function(key, val){
                            html 
                                += '<tr>'
                                + '   <td class="text-center">' + key + '</td>'
                                + '   <td>' + val['category'] + '</td>'
                                + '   <td>' + val['created_by'] + '</td>'
                                + '   <td class="text-center">' + val['created_at'] + '</td>'
                                + '   <td class="text-center">0</td>'
                                + '   <td class="text-center">'
                                + '       <button class="btn btn-primary" data-id="' + val['id'] + '"><i class="fas fa-edit"></i></button>'
                                + '       <button class="btn btn-danger" data-id="' + val['id'] + '"><i class="fas fa-trash"></i></button>'
                                + '   </td>'
                                + '</tr>';
                                console.log(html)
                        });
                    } else {
                        html 
                            += '<tr>'
                            + '   <th rowpan=5>Không có dữ liệu</th>'
                            + '<tr>';
                    }
                    $('#tbody').html(html);
                },
                error: function(error){
                    console.log(error)
                }
            })
        })
    })
</script>