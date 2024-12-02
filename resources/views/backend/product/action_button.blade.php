<div class="dropdown">
    <a href="#" data-bs-toggle="dropdown"
       class="btn btn-light rounded btn-sm font-sm"> <i
            class="material-icons md-more_horiz"></i> </a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('product.edit',$product->id) }}">Edit
            info</a>
        @if (Auth::guard('admin')->user()->role == '2')
            <a class="dropdown-item text-danger"
               href="{{ route('product.delete', $product->id) }}"
               id="delete">Delete</a>
        @else
            @if (Auth::guard('admin')->user()->role == '1' ||
                    in_array('4', json_decode(Auth::guard('admin')->user()->staff->role->permissions)))
                <a class="dropdown-item text-danger"
                   href="{{ route('product.delete', $product->id) }}"
                   id="delete">Delete</a>
            @endif
        @endif
    </div>
</div>