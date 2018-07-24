<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Merchants Field -->
<div class="form-group col-sm-12">
    {!! Form::label('merchants', 'Merchants:') !!}
    <div class="clearfix"></div>
    @foreach ($merchants as $merchant_id => $merchant_name)
        <div class="form-group col-sm-4">
            <label class="checkbox-inline">
                @if(isset($user))
                    {!! Form::checkbox('merchants[]', $merchant_id, in_array($merchant_id, $user->merchants()->pluck('id')->toArray())) !!} {{ $merchant_name }}
                @else
                    {!! Form::checkbox('merchants[]', $merchant_id, null) !!} {{ $merchant_name }}
                @endif
            </label>
        </div>
    @endforeach
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
