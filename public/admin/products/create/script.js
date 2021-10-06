$(function () {
    CKEDITOR.replace('description');
    CKEDITOR.replace('detail');
    bsCustomFileInput.init();
    $('.select2').select2()
    $('#attribute-list').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    const baseUrl = $('base').attr('href')

    $(document).on('click', '#attributeModal .btn-add-attr-values', function () {
        const attrValueInput = `
            <div class="input-group mb-2 attr-value-input-group">
                <input type="text" class="form-control attr-value-input" name="attribute_values[]" placeholder="Nhập giá trị thuộc tính">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger btn-sm btn-delete-option" type="button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `
        $('#attributeModal .attr-group').append(attrValueInput)
    })

    $(document).on('click', '#attributeModal .btn-delete-option', function () {
        if ($('#attributeModal .attr-value-input-group').length > 1) {
            $(this).parent().parent().remove()
        }
    })

    $(document).on('click', '.btn-edit-attr', function () {
        const dataAttr = $(this).data('attr')
        const urlUpdate = baseUrl + `admin/product/attributes/${dataAttr.id}`
        $('#attributeModalUpdate form.attr-form').attr('action', urlUpdate)
        const attrName = dataAttr.name
        $('#attributeModalUpdate input[name="attr_name"]').val(attrName)
        const attrValues = Object.assign([], dataAttr.attribute_values)
        const attrValueGroup = []
        for (const value of attrValues) {
            const attrValueInput = `
                <div class="input-group mb-2 attr-value-input-group">
                    <input type="text" class="form-control attr-value-input old-value-input" data-value-id="${value.id}" name="attribute_values[${value.id}]" value="${value.name}" placeholder="Nhập giá trị thuộc tính">
                    <div class="input-group-append">
                        <button class="btn btn-outline-danger btn-sm btn-delete-option" type="button">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `
            attrValueGroup.push(attrValueInput)
        }
        $('#attributeModalUpdate .attr-group .attr-value-group').html(attrValueGroup)
        $('#attributeModalUpdate').modal('show')
    })

    $(document).on('click', '#attributeModalUpdate .btn-add-attr-values', function () {
        const attrValueInput = `
            <div class="input-group mb-2 attr-value-input-group">
                <input type="text" class="form-control attr-value-input" name="new_attribute_values[]" placeholder="Nhập giá trị thuộc tính">
                <div class="input-group-append">
                    <button class="btn btn-outline-danger btn-sm btn-delete-option" type="button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `
        $('.attr-group .attr-value-group').append(attrValueInput)
    })

    const attrValuesDelete = []
    $(document).on('click', '#attributeModalUpdate .btn-delete-option', function () {
        if ($('#attributeModalUpdate .attr-value-input-group').length > 1) {
            console.log($(this).parent().parent().find($('#attributeModalUpdate input.old-value-input')));
            const valueId = $(this).parent().parent().find($('#attributeModalUpdate input.old-value-input')).data('value-id')
            console.log(valueId);
            if (!attrValuesDelete.includes(valueId)) {
                attrValuesDelete.push(valueId)
            }
            $(this).parent().parent().remove()
        }
        $('#attributeModalUpdate input[name="attribute_values_delete"]').val(JSON.stringify(attrValuesDelete))
    })

    $(document).on('change', '.select2', function () {
    })
});
