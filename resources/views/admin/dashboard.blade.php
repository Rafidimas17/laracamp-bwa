@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card mt-3">
                    <div class="card-header">
                        My Camps
                    </div>
                    <div class="card-body">
                        @include('components.alert')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Camp</th>
                                    <th>Price</th>
                                    <th>Register Data</th>
                                    <th>Paid Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($checkout as $checkout)
                                    <tr>
                                        <td>{{$checkout->User->name}}</td>
                                        <td>{{$checkout->Camp->title}}</td>
                                        <td>
                                            <strong>
                                                Rp. {{$checkout->Camp->price}}
                                           
                                            </strong>    
                                        </td>
                                        <td>{{$checkout->created_at->format('M d Y')}}</td>
                                        <td>
                                           @if ($checkout->is_paid)
                                               <span class="badge bg-success">Paid</span>
                                               @else
                                               <span class="badge bg-warning">Waiting</span>
                                               
                                           @endif
                                        </td>
                                        <td> 
                                            @if (!$checkout->is_paid)    
                                            {{-- {{ $checkout->id }}                                             --}}
                                            <form action="{{ route('admin.checkout.update',$checkout->id) }}" method="post">
                                                @csrf
                                                <button class="btn btn-primary btn-sm">Set paid</button>
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No camps registered</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection