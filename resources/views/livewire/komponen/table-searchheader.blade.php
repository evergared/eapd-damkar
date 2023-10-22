<div class="mb-3 mb-md-0 input-group">
    <input wire:model.stop="columnSearch.{{$field}}"  type="text" placeholder="Cari {{ ucfirst($field)}}" maxlength="10" class="form-control">
</div>