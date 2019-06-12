<div class="form-group row justify-content-center">
    <div>
        {{ Form::label('name', 'Product', ['class' => 'col-sm-2 col-form-label']) }}
    </div>
    <div class="col-sm-10">
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-12 text-center">
        {{ Form::submit('Salvar', ['class' => 'btn btn-success mt-2']) }}
    </div>
</div>