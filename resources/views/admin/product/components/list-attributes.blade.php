<div class="card">
    <div class="card-header">
        <h3 class="card-title">Danh sách thuộc tính sản phẩm</h3>
      </div>
    <div class="card-body">
        <button type="button" data-toggle="modal" data-target="#attributeModal" class="btn btn-primary btn-sm mb-2">
            <span class="glyphicon glyphicon-floppy-save"></span>
            Thêm thuộc tính
        </button>
        @if (session()->has('failed_validate'))
            <div class="alert alert-danger">
                <strong>{{ session('failed_validate') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div id="table-responsive1" class="table-responsive">
            <table id="attribute-list" class="table table-hover table-bordered table-content">
                <thead>
                    <tr>
                        <th>Tên thuộc tính</th>
                        <th>Giá trị thuộc tính</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody class="attr-content">
                    @if ($attributes->isNotEmpty())
                        @foreach ($attributes as $attr)
                            <tr>
                                <td>
                                    {{ $attr->name }}
                                </td>
                                <td>
                                    @foreach ($attr->attributeValues as $key => $attrValue)
                                        @if ($key == count($attr->attributeValues) - 1)
                                            <span>{{ $attrValue->name }}</span>
                                        @else
                                            <span>{{ $attrValue->name }},</span>
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-xs btn-edit-attr" data-attr="{{ $attr }}">Sửa</button>
                                    <form class="d-inline-block" action="{{ route('admin.attributes.destroy', ['attribute' => $attr->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-xs btn-delete-attr">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                <h4 class="text-center">Chưa có thuộc tính sản phẩm</h4>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
