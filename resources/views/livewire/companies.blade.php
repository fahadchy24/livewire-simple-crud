@extends('layouts.app')

@section('content')
<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between py-2">
                            <h4>Companies</h4>
                            <div>
                                <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#companyModal">
                                    Add New Company
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd table-striped">
                            <thead>
                                <tr>
                                    <th>SL no</th>
                                    <th>Company Name</th>
                                    <th>Company Email</th>
                                    <th>Company Logo</th>
                                    <th>Website</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->logo }}</td>
                                    <td>{{ $company->website }}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#" wire:click="" class="btn btn-primary">
                                            Edit
                                        </button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#" wire:click="" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No Record Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $companies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection