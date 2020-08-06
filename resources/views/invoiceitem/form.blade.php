@csrf
<div class="form-group">
    <label for="invoice_number">Invoice Number</label>
    <input type="number" name="invoice_number" class="form-control" placeholder="Invoice number">
</div>

<div class="form-group">
    <label for="item_id">Item</label>
    <select name="item_id" class="form-control">
        @forelse($items as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @empty
            <option value="null">There is no item</option>
        @endforelse
    </select>
</div>
<div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" class="form-control" name="quantity" placeholder="Amount">
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary">
</div>
