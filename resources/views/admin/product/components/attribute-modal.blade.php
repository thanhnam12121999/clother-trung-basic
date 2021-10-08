<!-- Modal -->
<div class="modal fade" id="attributeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="attr-form" action="{{ route('admin.attributes.store') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm thuộc tính</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên thuộc tính <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="attr_name" placeholder="Nhập tên thuộc tính" value="{{ old('attr_name') }}">
                    </div>
                    <div class="form-group attr-group">
                        <label>Giá trị thuộc tính <span class="text-danger">*</span></label>
                        <button type="button" class="btn btn-default btn-sm btn-add-attr-values">
                            Thêm giá trị thuộc tính <i class="fas fa-plus-circle"></i>
                        </button>
                        <div class="input-group mb-2 attr-value-input-group">
                            <input type="text" class="form-control attr-value-input" name="attribute_values[]" placeholder="Nhập giá trị thuộc tính">
                            <div class="input-group-append">
                                <button class="btn btn-outline-danger btn-sm btn-delete-option" type="button">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
