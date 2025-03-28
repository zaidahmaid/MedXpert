@extends('admindashboard.layout')

@section('title' , 'List of Patients')

@section('contant')
<!-- Main Content -->
    

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">List Of Patients</h1>
        <p class="mb-4">Manage and view detailed information about registered patients, including their medical history, appointments, and treatment progress.</p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Table of Patients</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Specialization</th>
                                <th>City</th>
                                <th>Rate/5</th>
                                <th>Start date</th>
                                <th>More Info</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Specialization</th>
                                <th>City</th>
                                <th>Rate/5</th>
                                <th>Start date</th>
                                <th>More Info</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Shad Decker</td>
                                <td>Regional Director</td>
                                <td>Edinburgh</td>
                                <td>4</td>
                                <td>2008/11/13</td>
                                <td>btn</td>
                            </tr>
                            <tr>
                                <td>Michael Bruce</td>
                                <td>Javascript Developer</td>
                                <td>Singapore</td>
                                <td>3.5</td>
                                <td>2011/06/27</td>
                                <td>btn</td>
                            </tr>
                            <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td>4.5</td>
                                <td>2011/01/25</td>
                                <td>btn</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->



</div>


@endsection