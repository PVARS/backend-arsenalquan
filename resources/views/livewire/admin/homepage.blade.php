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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>

                        <p>Số bài viết</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>

                        <p>Bài đăng hôm nay</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Tài khoản</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Khác</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="javascript:void(0)" class="small-box-footer">Xem thêm <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <div class="row">
            <section class="col-lg-6 connectedSortable ui-sortable">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 476px;"
                            width="476" height="250" class="chartjs-render-monitor"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bài viết có lượt xem nhiều nhất</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5px" class="text-center">#</th>
                                    <th style="width: 60px">Tiêu đề</th>
                                    <th style="width: 20px" class="text-center">Tác giả</th>
                                    <th style="width: 15px" class="text-center">Lượt xem</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 5px" class="text-center">1.</td>
                                    <td style="width: 60px" class="limited-text">Trực tiếp bóng đá Saudi Arabia - Việt
                                        Nam: Trận cầu lịch sử, quyết gieo sầu "ông lớn" (Vòng loại World Cup)</td>
                                    <td style="width: 20px" class="text-center">
                                        <span>Phan Văn Vũ</span>
                                    </td>
                                    <td style="width: 15px" class="text-center"><span class="badge bg-success">50</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dòng thời gian</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <div class="timeline">
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-red">10 Feb. 2014</span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header">Jay White đã đăng một bài viết</h3>
                            <div class="timeline-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, beatae quam, ea, corrupti adipisci perspiciatis dolor ab velit rem fuga maiores quidem vel consectetur? Ducimus suscipit nostrum itaque quo ut?
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-warning btn-sm">Xem bài viết</a>
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header">Jay White đã đăng một bài viết</h3>
                            <div class="timeline-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, beatae quam, ea, corrupti adipisci perspiciatis dolor ab velit rem fuga maiores quidem vel consectetur? Ducimus suscipit nostrum itaque quo ut?
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-warning btn-sm">Xem bài viết</a>
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header">Jay White đã đăng một bài viết</h3>
                            <div class="timeline-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, beatae quam, ea, corrupti adipisci perspiciatis dolor ab velit rem fuga maiores quidem vel consectetur? Ducimus suscipit nostrum itaque quo ut?
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-warning btn-sm">Xem bài viết</a>
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-green">3 Jan. 2014</span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header">Jay White đã đăng một bài viết</h3>
                            <div class="timeline-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, beatae quam, ea, corrupti adipisci perspiciatis dolor ab velit rem fuga maiores quidem vel consectetur? Ducimus suscipit nostrum itaque quo ut?
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-warning btn-sm">Xem bài viết</a>
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-yellow"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> 27 mins ago</span>
                            <h3 class="timeline-header">Jay White đã đăng một bài viết</h3>
                            <div class="timeline-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, beatae quam, ea, corrupti adipisci perspiciatis dolor ab velit rem fuga maiores quidem vel consectetur? Ducimus suscipit nostrum itaque quo ut?
                            </div>
                            <div class="timeline-footer">
                                <a class="btn btn-warning btn-sm">Xem bài viết</a>
                            </div>
                        </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
</section>

<script>
    //-------------
    //- DONUT CHART -
    //-------------
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
    var donutData = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio: false,
      responsive: true,
    }

    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
</script>