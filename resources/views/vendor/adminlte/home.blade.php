@extends('adminlte::layouts.app')

@section('contentheader_title')
	Inicio
@endsection

@section('main-content')

	<section class="content">
		@if(Auth::user()->hasRole('admin'))
		<div class="row">

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3>{{$usuarios->count()}}</h3>

						<p>Usuarios</p>
					</div>
					<div class="icon">
						<i class="fa fa-users"></i>
					</div>
					<a  href="{{ route('user.index') }}" class="small-box-footer">
						Ir a Usuarios  <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-blue">
					<div class="inner">
						<h3>{{$campaigns->count()}}</h3>

						<p>Campañas</p>
					</div>
					<div class="icon">
						<i class="fa fa-building"></i>
					</div>
					<a  href="{{ route('campaign.index') }}" class="small-box-footer">
						Ir a Campañas  <i class="fa fa-arrow-circle-right"></i>
					</a>
				</div>
			</div>
		</div>
		@endif
	</section>


@endsection
