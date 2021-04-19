
<div class="container">
    <div class="customerAlert" style="position:absolute; right: 16px; top:16px; background:green;"></div>
    <div class="row bg-secondary rounded mt-4 pb-5">
        <div class="col-sm-12">

            <div class="d-flex align-items-baseline">
                <div class="row pt-2 pl-2 text-white mr-auto p-2"><h1>Customer's Dashboard</h1></div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <th scope="col">Order No.</th>
                            <th scope="col">Summary</th>
                            <th scope="col">Tailor</th>
                            <th scope="col">Date to Finish</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </thead>
                        @foreach ($customerShow as $customerShow)
                            <tr>
                                <td>{{$customerShow->id}}</td>
                                <td>
                                    <button type = "button" class = "btn btn-primary btn_showItem" id = "{{$customerShow->id}}">
                                        View Item/(s)
                                     </button>
                                     
                                     <div id = "demo{{$customerShow->id}}" class = "collapse in">
                                        
                                     </div>           
                                </td>
                                <td>{{$customerShow->name}}</td>
                                <td>{{\App\Helpers\Helper::showDateTime($customerShow->date_finish)}}</td>
                                @if($customerShow->status != 1)
                                <td><button class="btn btn-primary" disabled>{{\App\Helpers\Helper::showOrderStatus($customerShow->status)}}</button></td>
                                @else
                                <td><a href="#" 
                                    @if($customerShow->status == 1)
                                    class="btn btn-secondary btn_changeStatus"
                                    @elseif($customerShow->status == 2)
                                    class="btn btn-warning btn_changeStatus"
                                    @elseif($customerShow->status == 3)
                                    class="btn btn-success btn_changeStatus"
                                    @elseif($customerShow->status == 4)
                                    class="btn btn-primary btn_changeStatus"
                                    @endif
                                    id="{{$customerShow->id}}">{{\App\Helpers\Helper::showOrderStatus($customerShow->status)}}</a></td>
                                @endif
                                <td><a href="#" class="btn btn-warning btn_edit">Edit</a></td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- <input type="hidden" id="tailor_type" name="tailor_type" value="{{$tailorShow->tailor_id}}"> --}}
                    <script>
                        $(function(){
                            // var myType = {!! json_encode($user->type) !!};

                            $('.btn_changeStatus').on('click', function()
                            {
                                var $this = $(this);
                                var order_id = $this.attr("id");
                                var status = $this.data("value");
                                var _token = $('input[name="_token"]').val();
                                $this.text('Processing');
                                $.ajax({
                                    type: "POST",
                                    url: '/changeStatus',
                                    data: {'order_id': order_id, '_token':_token},
                                    success:function(data)
                                    {
                                        console.log(data[0]);

                                        if(data[0] == 'success')
                                        {
                                            
                                            if(data[1] == 2){
                                                showAlert(200, 'Status Updated Successfully');
                                                $this.removeClass('btn-secondary').addClass('btn-warning');
                                                $this.text('On-Going');
                                            }else if(data[1] == 3){
                                                showAlert(200, 'Status Updated Successfully');
                                                $this.removeClass('btn-secondary').addClass('btn-success');
                                                $this.text('Done');
                                            }else if(data[1] == 4){
                                                showAlert(200, 'The item has been collected');
                                                $this.removeClass('btn-secondary').addClass('btn-primary');
                                                $this.text('Collected');
                                            }
                                            
                                        }else if(JSON.parse(response) == "failed")
                                        {
                                            $('.customerAlert').css('background', 'red');
                                            $('.customerAlert').text('Unable to change status at the moment!');
                                        }
                                    },
                                    error: function(response)
                                    {
                                        alert('Error'+response);
                                    }
                                });
                            });

                            $('.btn_showItem').on('click', function()
                            {
                                var $this = $(this);
                                var order_id = $this.attr("id");
                                var _token = $('input[name="_token"]').val();
                                //console.log(order_id);
                                $.ajax({
                                    type:"POST",
                                    url: '/showProducts',
                                    data: {'order_id': order_id, '_token': _token},
                                    success:function(data)
                                    {
                                        //console.log('#demo' + order_id);
                                        $('#demo' + order_id).collapse('toggle');
                                        $('#demo' + order_id).html(data);
                                    },
                                    error:function(response)
                                    {
                                        alert('Error'+response);
                                    }
                                }); 

                            });
                            
                            function showAlert(code, message)
                            {
                                $('.customerAlert').css('background', (code === 200 ? 'green': 'red'));
                                $('.customerAlert').fadeIn();
                                $('.customerAlert').text(message);
                                setTimeout(() =>{
                                    $('.customerAlert').fadeOut();
                                },3000)
                            }            
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

