@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    @include('admin.includes.alerts.success')
                    @include('admin.includes.alerts.errors')


                    <div class="card-body card-dashboard">
                        <table class="table display nowrap ">
                            <thead class="">
                                <tr>
                                    <th># </th>
                                    <th>المنيج </th>
                                    <th>الوصف </th>
                                    <th>الملاحظات </th>
                                    <th>السعر </th>
                                    <th>الحالة</th>
                                    <th>الزيارات</th>
                                    <th>صوره المنيج</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>

                                @isset($products)
                                    @php
                                        $row = 1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $row++ }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->note }}</td>
                                            <td>{{ $product->price }}</td>
                                            @if ($product->is_active == 1)
                                                <td>مفعل</td>
                                            @elseif($product->is_active == 0)
                                                <td>غير مفعل</td>
                                            @endif
                                            <td>{{ $product->viewed }}</td>

                                            <td><img class="img-rounded" width="200" height="136"
                                                    src="{{ asset('assets/images/products/' . $product->image) }}"</td>

                                            <td colspan="3">

                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="btn btn-outline-primary">تعديل</a>
                                                <a href="{{ route('admin.products.active_desactive', $product->id) }}"
                                                    class="btn btn-outline-warning">
                                                    @if ($product->is_active == 0)
                                                        تفعيل
                                                    @else
                                                        الغاء تفعيل
                                                    @endif
                                                </a>
                                                <a onclick="confirm('هل أنت متأكد من الحذف؟')" href="{{ route('admin.products.destroy', $product->id) }}"
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
