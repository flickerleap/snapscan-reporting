<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $merchant->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $merchant->name !!}</p>
</div>

<!-- Merchant Code Field -->
<div class="form-group">
    {!! Form::label('merchant_code', 'Merchant Code:') !!}
    <p>{!! $merchant->merchant_code !!}</p>
</div>

<!-- Api Key Field -->
<div class="form-group">
    {!! Form::label('api_key', 'Api Key:') !!}
    <p>{!! $merchant->api_key !!}</p>
</div>

