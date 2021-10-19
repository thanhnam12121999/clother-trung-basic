<form action="{{ empty($category) ? route('admin.categories.store') : route('admin.categories.update', ['category' => $category->id]) }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
    @if (!empty($category))
        @method('PUT')
    @endif
    @csrf
    <section class="content-header">
        <div class="breadcrumb">
            <button type="submit" class="btn btn-primary btn-sm mr-3">
                <span class="glyphicon glyphicon-floppy-save"></span>
                Lưu[Thêm]
            </button>
            <a class="btn btn-default btn-sm" href="{{ route('admin.products.index') }}" role="button">
                <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
            </a>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box" id="view">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category-name">Tên danh mục <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="category-name" name="name" value="{{ !empty($category) ? $category->name ?? old('name') : old('name') }}"
                                    placeholder="Nhập tên danh mục">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                            <div class="form-group">
                                <label for="category-image">Ảnh danh mục <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="category-image" name="image">
                                        <label class="custom-file-label" for="category-image">{{ !empty($category) ? $category->image : 'Chọn ảnh danh mục' }}</label>
                                    </div>
                                </div>
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả danh mục</label>
                                <textarea name="description" class="form-control" rows="5"
                                    placeholder="Nhập mô tả danh mục">{{ !empty($category) ? $category->description ?? old('description') : old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</form>
