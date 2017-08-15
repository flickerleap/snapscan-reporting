<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Merchant Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('merchant_code', 'Merchant Code:') !!}
    {!! Form::text('merchant_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Api Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('api_key', 'Api Key:') !!}
    {!! Form::text('api_key', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('merchants.index') !!}" class="btn btn-default">Cancel</a>
</div>
