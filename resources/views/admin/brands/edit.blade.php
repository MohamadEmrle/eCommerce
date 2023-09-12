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

                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">

                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.brands.update',$record->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> صوره العلامة </label>
                                                <input type="file" class="form-control" name="image">
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">
                                                <label> أسم العلامة </label>
                                                <input type="text" value="{{ $record->name }}" class="form-control" name="name"
                                                    autocomplete="off">
                                                <span class="file-custom"></span>
                                            </div>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="form-body">
                                                <label> وصف العلامة </label>
                                                <input type="text" value="{{ $record->description  }}" class="form-control" name="description"
                                                    autocomplete="off">
                                                <span class="file-custom"></span>
                                            </div>
                                            @error('description')
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
