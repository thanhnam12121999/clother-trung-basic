@extends('admin.layouts.master')
@section('active-categories', 'active')
@section('breadcrumb', 'Chỉnh Sửa Danh Mục')
@section('contents')
    @include('admin.categories._form')
@endsection
@section('custom-script')
    <!-- bs-custom-file-input -->
    <script src="{{ asset('adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
@endsection
@section('my-script')
    <script type="text/javascript">
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endsection
