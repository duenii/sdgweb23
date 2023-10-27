@extends('layouts.home')

@section('tatle', 'Create User')
@section('content')

<div class="main-panel">
  <div class="content-wrapper">
      <div class="page-header">
          <h3 class="page-title"> User </h3>
          <nav aria-label="breadcrumb">
              
              {{-- <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('http://127.0.0.1/register') }}" target="_blank" class="btn btn btn-gradient-success">เพิ่มข้อมูล</a></li>
              </ol> --}}
          </nav>
      </div>
      <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                  <div class="card-body table-responsive">

                      
                       
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                               
                                
                                <table class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th> # </th>
                                      <th> First name </th>
                                      <th> email </th>                         
                                      <th> role </th>
                                      {{-- <th> action </th> --}}
                                      
                                    </tr>
                                  </thead>
                                
                                </table>
                              </div>
                            </div>
                            
                          </div>
                         
                        </div>
                        
                     
                  </div>
              </div>
          </div>

      </div>
  </div>

</div>

 @endsection