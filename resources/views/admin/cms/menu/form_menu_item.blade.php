<div class="item-handle">
    <span class="item-title">
        {{ $menu->title }}
    </span>
    <div class="item-control">
        <span class="item-type">
            Trang
        </span>
        <button type="button" class="btn item-edit"><span></span></button>
    </div>
</div>
<div class="ct-item">
    <div action="#">
        <div class="form-group mb-2">
            <p class="mb-2">Nhãn điều hướng</p>
            <input type="text" name="label[item_{{ $menu->id }}]" value="{{ $menu->title }}" class="form-control" placeholder="Title" >
        </div>
        <div class="form-group mb-2">
            <p class="mb-2">Link</p>
            <input type="text" name="link[item_{{ $menu->id }}]" value="{{ $menu->link }}" class="form-control" placeholder="Link..." >
        </div>
        <div class="cl-group">
            <a class="red act-delete" href="#">Xóa</a>
        </div>
    </div>
</div>