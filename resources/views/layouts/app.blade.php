<!DOCTYPE html>
<html lang="en">

<head>
    @include('livewire.admin.container.head')
    @include('livewire.admin.container.script')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('livewire.admin.container.navbar')
        @include('livewire.admin.container.sidebar')
        <div class="content-wrapper">
            {{ $slot }}
        </div>
    </div>
    @include('livewire.admin.container.footer')
</body>

</html>