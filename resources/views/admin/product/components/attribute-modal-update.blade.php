<!-- Modal -->
<div class="modal fade" id="attributeModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="attr-form" action="" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên thuộc tính <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="attr_name" placeholder="Nhập tên thuộc tính" value="">
                    </div>
                    <div class="form-group attr-group">
                        <label>Giá trị thuộc tính <span class="text-danger">*</span></label>
                        <button type="button" class="btn btn-default btn-sm btn-add-attr-values">
                            Thêm giá trị thuộc tính <i class="fas fa-plus-circle"></i>
                        </button>
                        <div class="attr-value-group"></div>
                        <input type="hidden" name="attribute_values_delete" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
