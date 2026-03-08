@extends('layout.admin')
@section('title','Transactions')
@push('css')
    <style> </style>
@endpush
@section('content')
    <div class="row mt-3">
        <div class="col-12" style="margin: auto;width: 80%;">

            <div class="card" >
                <div class="card-body">
                    <table data-tables="basic" class="table table-striped dt-responsive align-middle mb-0" >
                        <thead class="thead-sm text-uppercase fs-xxs">
                        <tr>
                            <th>SL</th>
                            <th>Trasanction No.</th>
                            <th>Currency</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $d)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$d->t_transaction_id}}</td>
                                <td>{{$d->t_currency}}</td>
                                <td>{{$d->t_amount}}</td>
                                <td>
                                    {{$d->t_reference}}
                                </td>
                                <td>
                                        <span class="badge badge-label text-bg-@php
                                            if($d->t_status=='pending')
                                            {
                                                echo "warning";
                                            }
                                            elseif ($d->t_status=='complete')
                                            {
                                                echo "success";
                                            }elseif ($d->t_status=='failed')
                                            {
                                                echo "info";
                                            }elseif ($d->t_status=='canceled')
                                            {
                                                echo "danger";
                                            }else{
                                                echo "primary";
                                            }
                                             @endphp">
                                            {{strtoupper($d->t_status)}}
                                        </span>
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($d->created_at)->format('d M, Y | h:i A')}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- end card-body-->
            </div>
            <!-- end card-->
        </div>
    </div>
@endsection
@push('js')
    <script>

    </script>
@endpush
