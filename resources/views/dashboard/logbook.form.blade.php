<x-modal-action action={{ $action }}>
    @if ($data->id)
        @method('put')
    @endif

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3" invisible>
                <input type="datetime-local" name="date" class="form-control" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3" invisible>
                <textarea name="description" class="form-control"></textarea>
            </div>
        </div>
    </div>
</x-modal-action>