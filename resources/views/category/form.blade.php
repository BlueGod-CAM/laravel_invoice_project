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
    <label for="enabled">Enable</label>
    <select name="enabled" class="form-control">
        <option value="1">Enable</option>
        <option value="0">Forbid</option>
    </select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-primary">
</div>
