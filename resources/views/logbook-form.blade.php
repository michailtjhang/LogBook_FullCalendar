<x-modal-action action="{{ $action }}">
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
            <div class="mb-3">
                <input type="date" name="date" value="{{ $data->date ?? request()->date }}" class="form-control" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <textarea name="description" class="form-control">{{ $data->description ?? request()->description }}</textarea>
            </div>
        </div>
    </div>
</x-modal-action>