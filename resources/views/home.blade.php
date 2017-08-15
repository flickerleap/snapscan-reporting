@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Reporting
        </h1>
   </section>
   <div class="content">
	@include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
	            	@if(isset($payments))

	            		<div class="col-sm-12">

	            			@include('reports.payments')

	            		</div>

				    @elseif(isset($codes))    	

	                   {!! Form::model('dashboard', ['route' => ['dashboard'], 'method' => 'post']) !!}

	                        <div class="form-group col-sm-12">
							    {!! Form::label('code_id', 'Code:') !!}
							    {!! Form::select('code_id', $codes, null, ['class' => 'form-control']) !!}
							</div>

							<div class="form-group col-sm-6">
							    {!! Form::label('start_date', 'Start Date:') !!}
							    {!! Form::selectRange('start_date_day', 1, 31, date('j'), ['class' => 'form-control col-1']) !!}
							    {!! Form::selectMonth('start_date_month', date('n'), ['class' => 'form-control col-1']) !!}
							    {!! Form::selectRange('start_date_year', 2012, date('Y'), date('Y'), ['class' => 'form-control col-1']) !!}
							    {!! Form::selectRange('start_date_hour', 0, 23, 0, ['class' => 'form-control col-1']) !!}
							    {!! Form::selectRange('start_date_minute', 0, 59, 0, ['class' => 'form-control col-1']) !!}
							</div>

							<div class="form-group col-sm-6">
							    {!! Form::label('end_date', 'End Date:') !!}
							    {!! Form::selectRange('end_date_day', 1, 31, date('j'), ['class' => 'form-control col-1']) !!}
							    {!! Form::selectMonth('end_date_month', date('n'), ['class' => 'form-control col-1']) !!}
							    {!! Form::selectRange('end_date_year', 2012, date('Y'), date('Y'), ['class' => 'form-control col-1']) !!}
							    {!! Form::selectRange('end_date_hour', 0, 23, date('G'), ['class' => 'form-control col-1']) !!}
							    {!! Form::selectRange('end_date_minute', 0, 59, date('i'), ['class' => 'form-control col-1']) !!}
							</div>

							<!-- Submit Field -->
							<div class="form-group col-sm-12">
							    {!! Form::submit('Get Report', ['class' => 'btn btn-primary']) !!}
							</div>

	                   {!! Form::close() !!}

				    @else    	

	                   {!! Form::model('dashboard', ['route' => ['dashboard'], 'method' => 'post']) !!}

	                        <div class="form-group col-sm-12">
							    {!! Form::label('merchant_id', 'Merchant:') !!}
							    {!! Form::select('merchant_id', $merchants, null, ['class' => 'form-control']) !!}
							</div>

							<!-- Submit Field -->
							<div class="form-group col-sm-12">
							    {!! Form::submit('Next', ['class' => 'btn btn-primary']) !!}
							</div>

	                   {!! Form::close() !!}

				    @endif
               </div>
           </div>
       </div>

    </div>
@endsection
