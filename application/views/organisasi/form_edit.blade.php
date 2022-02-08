@extends('include_template/template')

@php 
	$ci = get_instance();
@endphp

@section('style')

@endsection

@section('content')
<div class="container">
	@php
		echo form_open($form_action);
	@endphp
	<p>
		<label>Nama Organisasi</label>
		@php
			echo form_input($nama_organisasi);
		@endphp
	</p>
	<p>
		<label>Alamat</label>
		@php
			echo form_textarea($alamat);
		@endphp
	</p>
	<p>
		@php
			echo anchor($ci->session->userdata('urlback'), 'Kembali', ['class' => 'btn btn-secondary']);
		@endphp
		<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
	</p>
	@php
		echo form_close();
	@endphp
</div>
@endsection

@section('javascript')

@endsection