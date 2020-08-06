@csrf
<div class="form-group">
    <label for="invoice_number">Invoice Number</label>
    <input type="number" name="invoice_number" class="form-control" placeholder="Invoice number">
</div>
<div class="form-group">
    <label for="invoice_at">Invoice At</label>
    <input type="date" class="form-control" name="invoice_at" placeholder="Date">
</div>

<div class="form-group">
    <label for="currency">Currency</label>
    <select name="currency" class="form-control">
        <option value="riel">Riel</option>
        <option value="usd">USD</option>
    </select>
</div>
<div class="form-group">
    <label for="customer_id">Customer</label>
    <select name="customer_id" class="form-control" class="mdb-select md-form" searchable="Search here..">
        @forelse($customers as $customer)
            <option value="{{$customer->id}}">{{$customer->name}}</option>
        @empty
            <option value="null">There is no customer</option>
        @endforelse
    </select>
</div>
<div class="form-group">
    <h3>Add Product</h3>
    <table style="margin-top: 20px">
        <tr v-for="item in count">
            <td class="col-lg-9">
                <select name="products[@{{item}}][id]"  class="form-control" style="margin-top: 20px" class="mdb-select md-form" searchable="Search here..">
                  @foreach($items as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
            </td>
            <td class="col-lg-3">
                <input type="number" class="form-control" style="margin-top: 20px" name="products[@{{item}}][amount]" placeholder="Amount">
            </td>
        </tr>
    </table>
    <button class="btn btn-success" style="margin-top: 20px" v-on:click="AddMore" type="button">Add more product</button>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary">
</div>
