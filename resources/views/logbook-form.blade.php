<x-modal-action action="{{ $action }}">
    @if ($data->id)
        @method('put')
    @endif

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <input type="text" name="title" {{ $data->title }} class="form-control" placeholder="Topik Harian">
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <input type="date" name="date" value="{{ $data->date ?? request()->date }}" class="form-control" readonly>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-3">
                <textarea name="description" class="form-control" placeholder="Detail sehari-hari">{{ $data->description }}</textarea>
            </div>
        </div>
        <div class="col-12 invisible">
            <div class="mb-3">
                <input type="text" class="form-control" name="users_id" >
            </div>
        </div>
    </div>
</x-modal-action>