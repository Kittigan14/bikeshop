@extends("layouts.master")
@section('title') BikeShop | แก้ไขประเภทสินค้า @stop
@section('content')

<center>

    <h1>แก้ไขประเภทสินค้า </h1>
    <ul class="breadcrumb">
        <li><a href="{{ URL::to('product') }}">หน้าแรก</a></li>
        <li class="active">แก้ไขประเภทสินค้า </li>
    </ul>

</center>

{!! Form::model($category, [
    'action' => 'App\Http\Controllers\CategoryController@update',
    'method' => 'post',
    'enctype' => 'multipart/form-data'
]) !!}

<input type="hidden" name="id" value="{{ $category->id }}">

<div class="panel panel-default">

    <div class="panel-heading">

        @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <div class="panel-title" id="panel-title">

            <strong> ประเภทสินค้า </strong>

        </div>

    </div>
    <div class="panel-body" id="panel-body">
        <table>

            <tr>
                <td>{{ Form::label('name', 'ชื่อประเภท ') }}</td>
                <td>{{ Form::text('name', $category->name, ['class' => 'form-control']) }}</td>
            </tr>

        </table>

    </div>

    <div class="panel-footer" id="panel-footer">
        <button type="reset" class="btn btn-danger">
            <a href="{{ URL::to('category') }}"> ยกเลิก </a>    
        </button>
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> บันทึก</button>
    </div>

</div>

{!! Form::close() !!}

@endsection
