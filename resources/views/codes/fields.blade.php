<!-- Reference Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reference', 'Reference:') !!}
    {!! Form::text('reference', null, ['class' => 'form-control']) !!}
</div>

<!-- Merchant Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('merchant_id', 'Merchant Id:') !!}
    {!! Form::number('merchant_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Legacy Field -->
<div class="form-group col-sm-6">
    {!! Form::label('legacy', 'Legacy:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('legacy', false) !!}
        {!! Form::checkbox('legacy', '1', null) !!} 1
    </label>
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('codes.index') !!}" class="btn btn-default">Cancel</a>
</div>
