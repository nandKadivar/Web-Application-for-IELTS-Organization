@extends('layouts.admin')

@section('title')
Create Listening Mock Test
@endsection

@section('main-section')
<div class="main-panel">
    <div class="content-wrapper">
      @if(session()->has('status'))
        <h1>{{session()->get('status')}}</h1>
      @endif
      <div class="row">
        <div class="col-sm-12">
          <div class="home-tab">
            <div class="tab-content tab-content-basic">
              <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content"> 
                {{-- <div class="row">
                  <div class="col-sm-12">
                    <div class="statistics-details d-flex align-items-center justify-content-between">
                      <div class="d-flex flex-column align-items-center">
                        <p class="statistics-title">Total Tests</p>
                        <h3 class="rate-percentage">57</h3>
                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-8</span></p>
                      </div>
                      <div class="d-flex flex-column align-items-center">
                        <p class="statistics-title">Responses</p>
                        <h3 class="rate-percentage">54</h3>
                        <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+17</span></p>
                      </div>
                      <div class="d-flex flex-column align-items-center">
                        <p class="statistics-title">Evaluated</p>
                        <h3 class="rate-percentage">54</h3>
                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>2</span></p>
                      </div>
                      <div class="d-flex flex-column align-items-center">
                        <p class="statistics-title">New Sessions</p>
                        <h3 class="rate-percentage">68.8</h3>
                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p>
                      </div>
                      <div class="d-flex flex-column align-items-center">
                        <p class="statistics-title">Avg. Time on Site</p>
                        <h3 class="rate-percentage">2m:35s</h3>
                        <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p>
                      </div>
                    </div>
                  </div>
                </div> --}}
                <div class="row">
                    <h2 class='d-flex align-items-center'><i class="mdi mdi-headphones"></i> Listeing Test</h2>
                    <div class="row col-md-6">
                        <form class="forms-sample" method="post" enctype="multipart/form-data" action="{{route('admin.create.mocktest')}}">
                            @csrf
                            <div class='d-flex col-md-12 flex-row align-items-center justify-content-between'>
                                <div class="form-group">
                                  <label for="exampleInputUsername1">Mock Test Id</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" name='id' value='{{uniqid()}}' readonly>
                                </div>
    
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Module</label>
                                    {{-- <input type="text" class="form-control" id="exampleInputUsername1" name='module' value='listening' hidden> --}}
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="module" value='Listening' readonly>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputUsername1">Description</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" name='description' placeholder="Test description">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Upload Test Paper</label>
                              <input type="file" class="form-control" style="background-color: #fff; color: #333" name='paper'>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Upload Audio</label>
                                <input type="file" class="form-control" style="background-color: #fff; color: #333" name='audio'>
                              </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Upload Answer Key</label>
                              <input type="file" class="form-control" style="background-color: #fff; color: #333" name='answer'>
                            </div>
                            {{-- <button type="submit" class="btn btn-primary me-2">Create</button> --}}
                            @error('paper')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            @error('audio')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            @error('answer')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                            <div class="d-flex col-md-12 flex-row align-items-center justify-content-between">
                                <button type="reset" class="btn btn-light">Reset</button>

                                <button type="submit" class="btn btn-primary btn-icon-text" style="color: #fff">
                                  {{-- <i class=" btn-icon-prepend"></i> --}}
                                  Create Test
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <footer class="footer">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">IELTS Organization</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
      </div>
    </footer>
    <!-- partial -->
</div>

<script>
  document.getElementById('schedule-group').style.display="none";
  $(document).ready(function(){
    $('.toast').toast('show');
  });

  Notiflix.Notify.Init({ fontFamily:"Quicksand",useGoogleFont:true,position:"right-bottom",closeButton:true, }); 
  Notiflix.Notify.Success('Sol lucet omnibus');
</script>
@endsection