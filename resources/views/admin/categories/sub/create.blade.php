@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">

                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة قسم رئيسي </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">

                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.categories.sub.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> صوره القسم </label>
                                                <input type="file" class="form-control" name="image">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>العلامات التجارية</label>
                                                <select id="brand_id" name="brand_id" class="form-control">
                                                    <option>اختار...</option>
                                                    @foreach ($brands as $brand )
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>المجوعة الرئيسية</label>
                                                <select id="praent_id" name="praent_id" class="form-control">
                                                    <option></option>
                                                </select>
                                                @error('praent_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <label> أسم القسم </label>
                                                <input type="text" class="form-control" name="name"
                                                    autocomplete="off">
                                                <span class="file-custom"></span>
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="form-body">
                                                <label> وصف القسم </label>
                                                <input type="text" class="form-control" name="description"
                                                    autocomplete="off">
                                                <span class="file-custom"></span>
                                            </div>
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="form-body">
                                                <label> موضع القسم </label>
                                                <input type="text" class="form-control" name="position"
                                                    autocomplete="off">
                                                <span class="file-custom"></span>
                                            </div>
                                            @error('position')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="form-actions">

                                                <input type="submit" class="btn btn-primary" value="حفظ">
                                                {{--  <i class="la la-check-square-o"></i>  --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(e) {

        $('#brand_id').change(function() {
            var id = $(this).val();
			console.log(id);
            if(id) {
                $.ajax({
                    url: "{{ url('admin/categories/sub/ajax') }}/"+id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $("#praent_id").find('option:not(:first)').remove();
						if (data['categories'])
						{
							$.each(data['categories'],function(key,value){
								$("#praent_id").append("<option value='"+value['id']+"'>"+value['name']+"</option>");
							});
						}

                    }
                });
            }else{
                $('#praent_id').empty();
            }
        });
    });
</script>
