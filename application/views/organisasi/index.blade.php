@extends('include_template/template')

@php 
	$ci = get_instance();
@endphp

@section('style')

@endsection

@section('content')

<div class="container">

	@php
		echo anchor($ci->session->userdata('urlback'), 'Refresh Data', array('class' => 'btn btn-secondary'));
	@endphp

	@php
		echo anchor('organisasi/add', 'Tambah Data', array('class' => 'btn btn-primary'));
	@endphp

<form action="<?php echo site_url('organisasi/search'); ?>" method="post">
	<div class="input-group mb-3">
	  <input name="keyword" type="text" class="form-control" placeholder="Pencarian .." aria-label="Search" aria-describedby="button-addon2" value="{{ $keyword }}">
	  <div class="input-group-append">
	    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
	  </div>
	</div>
</form>

	@if ($keyword <> '')
		@php
			echo anchor('organisasi', 'Reset', ['class' => 'btn btn-secondary']);
		@endphp
	@endif
	
	@if (! empty($tabel_data))
		@php
			echo $tabel_data;
		@endphp
	@endif

	@php
		echo $pagination;
	@endphp

</div>
@endsection

@section('javascript')

@endsection