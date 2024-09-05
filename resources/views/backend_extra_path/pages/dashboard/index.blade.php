@extends('backend_extra_path.layouts.master')

@section('title')
Dashboard Page - Admin Panel
@endsection


@section('navbar-content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@endsection

@section('admin-content')
@if ($user->type == 'Admin')

<div class="row">
    @if($user->branch_id !== null)
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="position-relative p-3 bg-green" style="height: 150px">
                        <div class="ribbon-wrapper ribbon-xl">
                            <div class="ribbon bg-red">
                                {{$user->branch->branchCode}} <br>
                                {{$user->branch->name}}
                            </div>
                        </div>
                        <h3> Today : {{date('d-M-Y')}}
                        </h3>
                        <h2>Hello {{$user->name}}</h2>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
                <div class="inner">
                    <h3>{{$visasApplicationsadmin->where("status","Pending")->count()}}</h3>

                    <p>Pending Visa</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('application-list.index')}}" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
                <div class="inner">
                    <h3>{{$visasApplicationsadmin->where("status","Approved")->count()}}</h3>

                    <p>Approved Visa</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('application-list.index')}}" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
                <div class="inner">
                    <h3>{{$visasApplicationsadmin->where("status","Processing")->count()}}</h3>

                    <p>Processing Visa</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('application-list.index')}}" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
                <div class="inner">
                    <h3>{{$visasApplicationsadmin->where("status","Complited")->count()}}</h3>

                    <p>Completed Visa</p>

                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('application-list.index')}}" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
                <div class="inner">
                    <h3>{{ $agents}}</h3>

                    <p>Total Agent</p>

                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('agent.index')}}" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
                <div class="inner">
                    <h3>{{ $customers }}</h3>

                    <p>Total Customers</p>

                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('inventorySetup.customer.index')}}" class="small-box-footer bg-success">More info <i class="fas fa-arrow-circle-right"></i></a>

            </div>
        </div>



    </div>

</div>
@endif


@if ($user->type == 'Branch')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplicationsBranch->count()}}</h3>

                <p>All Application</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplicationsBranch->where("status","Pending")->count()}}</h3>

                <p>Pending Application</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplicationsBranch->where("status","Approved")->count()}}</h3>

                <p>Approved Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>

    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplicationsBranch->where("status","Processing")->count()}}</h3>
                <p>Processing Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplicationsBranch->where("status","Complited")->count()}}</h3>

                <p>Completed Visa</p>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$customersbranch}}</h3>

                <p>Total Customer</p>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$agenetbranch}}</h3>

                <p>Total Agent</p>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{ $branchcommission}}</h3>

                <p>Total Commission</p>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
</div>
@endif

@if ($user->type == 'Agent')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->count()}}</h3>

                <p>All Application</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Pending")->count()}}</h3>

                <p>Pending Application </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Approved")->count()}}</h3>

                <p>Approved Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Processing")->count()}}</h3>

                <p>Processing Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Complited")->count()}}</h3>

                <p>Completed Visa</p>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{ $commission }}</h3>

                <p>Total Commission</p>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6"></div>
    <style>
        .highlight-table {
            background-color: #f8f9fa;
            border: 1px solid black;
            border-radius: 8px;
        }
        .highlight-table thead {
            background-color: #007bff; 
            color: #ffffff; 
        }
        .highlight-table tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }
        .highlight-table tbody tr:hover {
            background-color: #d1ecf1;
        }
        .highlight-table tbody td {
           color: black;
           font-weight: bold;
           align-items: center;
        }
    </style>
    <div class="col-md-12" style="display: flex;justify-content: center;">
        <div class="col-md-6">
            <table class="table table-bordered highlight-table">
                <thead>
                    <tr>
                        <th class="text-center">Uinque Code</th>
                        <th class="text-center">Branch Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{$user->code ??''}}</td>
                        <td class="text-center">{{$user['branchData']['name']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


@if ($user->type == 'Customer')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->count()}}</h3>

                <p>All Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Pending")->count()}}</h3>

                <p>Pending Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Approved")->count()}}</h3>

                <p>Approved Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Processing")->count()}}</h3>

                <p>Processing Applicant</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>

        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-default">
            <div class="inner">
                <h3>{{$visasApplications->where("status","Complited")->count()}}</h3>

                <p>Completed Visa</p>

            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>

        </div>
    </div>


</div>
@endif




@endsection