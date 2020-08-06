@csrf
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" placeholder="Name" class="form-control">

</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="editor" cols="30" rows="10" class="form-control"></textarea>
</div>
<div class="form-group">
    <label for="currency">Currency</label>
    <select name="currency" class="form-control">
        <option value="kh">Real</option>
        <option value="en">Dollar</option>
    </select>
</div>
<div class="form-group">
    <label for="sale_price">Sale Price</label>
    <input type="text" name="sale_price" class="form-control">
</div>

<div class="form-group">
    <label for="purchase_price">Purchase Price</label>
    <input type="text" name="purchase_price" class="form-control">
</div>
<div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" name="quantity" class="form-control">
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select name="category" class="form-control">
        @forelse($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @empty
        @endforelse
    </select>
</div>
<div class="form-group">
    <label for="enabled">Enable</label>
    <select name="enabled" class="form-control">
        <option value="1">Enable</option>
        <option value="0">Forbid</option>
    </select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary">
</div>
