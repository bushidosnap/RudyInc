@extends('layouts.app')

@section('title', 'Create Transaction')
@section('content')
@parent
    <div class="container">

        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{$error}}</div>
            @endforeach
        @endif --}}

        <div class="row bg-secondary rounded shadow-lg pb-5">
            <div class="row pt-3 pl-5 text-white">
                <h1>Create Transaction</h1>
            </div>
            <div class="col-sm-12 pl-5 pr-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('tailor.createOrder')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}   
                                <div class="form-group">
                                    <label for="clientname">Search by Client E-mail</label>
                                    <input type="text" autocomplete="off"class="form-control @error('client_name') is-invalid @enderror" name="client_name" id="client_name" placeholder="Client E-mail" >
                                    <input type="hidden" class="form-control" id="client_id" name="client_id">
                                    @error('client_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div id="nameList">
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                        
                                         $('#client_name').keyup(function(){ 
                                                var query = $(this).val();
                                                if(query != '')
                                                {
                                                 var _token = $('input[name="_token"]').val();
                                                 $.ajax({
                                                  url:"{{ route('autocomplete.fetch') }}",
                                                  method:"POST",
                                                  data:{query:query, _token:_token},
                                                  success:function(data){
                                                    $('#nameList').fadeIn();  
                                                    $('#nameList').html(data);
                                                  }
                                                 });
                                                }else{
                                                    $('#nameList').fadeOut();
                                                }
                                            });
                                        
                                            $(document).on('click', 'li', function(){  
                                                $('#client_name').val($(this).text());  
                                                $('#nameList').fadeOut();  
                                            });  
                                        
                                        });
                                    </script>
                                        
                                    <input type="hidden" id="tailor_id" name="tailor_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" id="status" name="status" value="1">
                                </div>
                                <div class="form-group">
                                    <label for="finishdate">Finish Date</label>
                                    <input type="datetime-local" class="form-control @error('date_finish') is-invalid @enderror" id="date_finish" name="date_finish">
                                    @error('date_finish')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            
                                <div class="text-white">
                                    <h4>Product Details</h4>
                                </div>
                                <table class="table table-bordered productTable">
                                    <thead>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col" width="100">Price</th>
                                        <th scope="col" width="100">Quantity</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody>
                                        <td><input type="text" name="name[0]" id="name" placeholder="Product Name" class="form-control @error('name') is-invalid @enderror">
                                            {{-- @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror --}}
                                        </td>
                                        <td><input type="text" name="description[0]" id="description" placeholder="Product Details" class="form-control @error('description') is-invalid @enderror">
                                            {{-- @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror --}}
                                        </td>
                                        <td><input type="text" name="price[0]" id="price" placeholder="Price" class="form-control @error('price') is-invalid @enderror">
                                            {{-- @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror --}}
                                        </td>
                                        <td><input type="number" name="qty[0]" id="qty" value="1" min="1" class="form-control @error('qty') is-invalid @enderror">
                                            {{-- @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror --}}
                                        </td>
                                        <td><select name="category[0]" id="category" class="form-control @error('category') is-invalid @enderror">
                                        <option disabled selected value>-- Select a Category --</option>    
                                        <option value="make" default>Make</option>    
                                        <option value="repair">Repair</option>    
                                        <option value="merchandise">Merchandise</option>    
                                        </select>
                                            {{-- @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror --}}
                                        </td>
                                        <td><a href="#" class="btn btn-danger">Remove</a></td>
                                    </tbody>
                                </table>
                                <div>
                                    <a href="#" class="btn btn-success btn_addProduct">Add</a>
                                </div>
                                <div class="text-right pr-2">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                        </form>
                        <script>
                            $(function(){
                            var i = 0;
                            $('.btn_addProduct').on('click', function(){
                            
                            ++i;
                            var rowtoAdd = '<tr>'+
                                                '<td><input type="text" name="name['+i+']" id="name" placeholder="Product Name" class="form-control @error('+product_name+') is-invalid @enderror"></td>'+
                                                '<td><input type="text" name="description['+i+']" id="description" placeholder="Product Details" class="form-control @error('+description+') is-invalid @enderror"></td>'+
                                                '<td><input type="text" name="price['+i+']" id="price" placeholder="Price" class="form-control @error('+price+') is-invalid @enderror"></td>'+
                                                '<td><input type="number" name="qty['+i+']" id="qty" value="1" min="1" class="form-control @error('+qty+') is-invalid @enderror"></td>'+
                                                '<td><select name="category['+i+']" id="category" class="form-control @error('+category+') is-invalid @enderror">'+                                                            
                                                    '<option disabled selected value>-- Select a Category --</option>'+    
                                                    '<option value="make" default>Make</option>'+    
                                                    '<option value="repair">Repair</option>'+    
                                                    '<option value="merchandise">Merchandise</option>'+    
                                                    '</select>'+
                                                '</td>'+
                                                '<td><a href="#" class="btn btn-danger btn_removeProduct">Remove</a></td>'+
                                            '</tr>';
                            $('tbody').append(rowtoAdd);
                            });
                            
                            $('tbody').on('click', '.btn_removeProduct', function(){
                            $(this).parent().parent().remove();
                            });
                            });
                            </script>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection