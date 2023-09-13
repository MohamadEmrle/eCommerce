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
                                    <th>القسم </th>
                                    <th>الوصف </th>
                                    <th>الحالة</th>
                                    <th>صوره القسم</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>

                                @isset($categories)
                                    @php
                                        $row = 1;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $row++ }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            @if ($category->is_active == 1)
                                                <td>مفعل</td>
                                            @elseif($category->is_active == 0)
                                                <td>غير مفعل</td>
                                            @endif
                                            <td><img class="img-rounded" width="200" height="136"
                                                    src="{{ asset('assets/images/categories/sub/' . $category->image) }}"</td>

                                            <td colspan="3">

                                                <a href="{{ route('admin.categories.sub.edit', $category->id) }}"
                                                    class="btn btn-outline-primary">تعديل</a>

                                                <a href="{{ route('admin.categories.sub.active_desactive', $category->id) }}"
                                                    class="btn btn-outline-warning">
                                                    @if ($category->is_active == 0)
                                                        تفعيل
                                                    @else
                                                        الغاء تفعيل
                                                    @endif
                                                </a>
                                                <a onclick="confirm('هل أنت متأكد من الحذف؟')" href="{{ route('admin.categories.sub.destroy', $category->id) }}"
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
