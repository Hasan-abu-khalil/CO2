@extends('admin/layout/layout')

@section('title', 'Co2')
@section('content')


<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Co2</h6>
                </div>
            </div>

            @include('Admin.Co2.add_co2')
            @include('Admin.Co2.update_co2')

            <div class="mx-3">
                <a href="" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#addCo2Modal">
                    <i class="fas fa-solid fa-plus"></i> Add New Co2</a>
            </div>

            <div class="card-body px-2 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="Co2Table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Unit</th>
                                <th>Percentage Amount</th>
                                <th>Amount %</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Chart Section
            <div class="card-body col-6">
                <canvas id="co2Chart" width="400" height="200"></canvas>
            </div> -->
        </div>
    </div>
</div>


@endsection