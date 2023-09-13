@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @include('admin.includes.alerts.success')
                    @include('admin.includes.alerts.errors')


                    <div class="card-body card-dashboard">
                        <table class="table">
                            <thead class="">
                                <tr>
                                    <th># </th>
                                    <th>العلامة </th>
                                    <th>الوصف </th>
                                    <th>الحالة</th>
                                    <th>صوره العلامة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>

                                @isset($brands)
                                    @php
                                        $row = 1;
                                    @endphp
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $row++ }}</td>
                                            <td>{{ $brand->name }}</td>
                                            <td>{{ $brand->description }}</td>
                                            @if ($brand->is_active == 1)
                                                <td>مفعل</td>
                                            @elseif($brand->is_active == 0)
                                                <td>غير مفعل</td>
                                            @endif
                                            <td><img class="img-rounded" width="200" height="136"
                                                    src="{{ asset('assets/images/brands/' . $brand->image) }}"</td>

                                            <td colspan="3">

                                                <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                                    class="btn btn-outline-primary">تعديل</a>

                                                <a  href="{{ route('admin.brands.active_desactive', $brand->id) }}"
                                                    class="btn btn-outline-warning">
                                                    @if ($brand->is_active == 0)
                                                        تفعيل
                                                    @else
                                                        الغاء تفعيل
                                                    @endif
                                                </a>
                                                <a onclick="confirm('هل أنت متأكد من الحذف؟')" href="{{ route('admin.brands.destroy', $brand->id) }}"
                                                    class="btn btn-outline-danger">حذف</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
