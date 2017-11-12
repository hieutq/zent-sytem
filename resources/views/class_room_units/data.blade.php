 @if(count($theories) > 0)
	@foreach($theories as $key => $theory)
    	<tr>
         	<td class="text-center">{{$key+1}}</td>
         	<td class="text-center">{{$theory->name}}</td>
            <td class="text-center"> 
            	<a href="#" class="show-content-exercise btn btn-outline btn-circle btn-sm blue" data-name = "" data-toggle="modal" data-target="#myModal-{{$theory->id}}-{{$class_room_unit_id}}">
                    <i class="fa fa-eye" aria-hidden="true"></i> Chi tiết
                </a>

                <!-- Modal -->
                <div class="modal fade" id="myModal-{{$theory->id}}-{{$class_room_unit_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header ">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title green" id="myModalLabel">{{$theory->name}}</h4>
                      </div>
                      <div class="modal-body">
                        {!! $theory->content !!}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline btn-circle btn-sm blue" data-dismiss="modal">Đóng</button>
                      </div>
                    </div>
                  </div>
                </div>

             </td>
            
            <td class="text-center">{{date('d-m-Y H:i:s ', strtotime($theory->created_at))}}</td>
            <td class="text-center"> 
              <input type="hidden" id="checked-{{$theory->id}}-{{$class_room_unit_id}}" value="{{$theory->checked}}">

            	@if($theory->checked)
                  
                 <i id="action-{{$theory->id}}-{{$class_room_unit_id}}" class="fa fa-check-circle" onclick="addTheory({{$theory->id}}, {{$class_room_unit_id}})" data-id="{{$theory->id}}" data-class_rom_unit_id="{{$class_room_unit_id}}" aria-hidden="true" style="cursor: pointer; color: #3598dc;font-size: 20px;"></i>
              @else 

                <i id="action-{{$theory->id}}-{{$class_room_unit_id}}" class="fa fa-circle-o"  onclick="addTheory({{$theory->id}}, {{$class_room_unit_id}})" aria-hidden="true" style="cursor: pointer; color: #3598dc;font-size: 20px;"></i>

              @endif
              

            	{{-- <input type="checkbox" class="make-switch" @if($theory->checked) checked @endif data-on-color="success" data-off-color="warning" data-id="{{$theory->id}}" data-class> --}}
                
            </td>
           
        </tr> 
    @endforeach
   
@endif
<script>
  function addTheory(theory_id, class_room_unit_id) {

    var checked = $('#checked-' + theory_id + '-' + class_room_unit_id).val();

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
              type: "PUT",
              url: "{{URL::asset('classroom-unit/update-theory')}}",
              data: {
                class_room_unit_id: class_room_unit_id,
                theory_id: theory_id,
                checked: checked,
              },
              success: function(res)
              {
                
                if (res.message == 'deleted') {
                  $('#action-' + theory_id + '-' + class_room_unit_id).removeClass('fa-check-circle').addClass('fa-circle-o');
                  $('#checked-' + theory_id + '-' + class_room_unit_id).val(0);
                  toastr.success('Xóa thành công');
                } 

                if (res.message == 'added') {
                  $('#action-' + theory_id + '-' + class_room_unit_id).removeClass('fa-circle-o').addClass('fa-check-circle');
                  $('#checked-' + theory_id + '-' + class_room_unit_id).val(1);
                  toastr.success('Thêm thành công');
                }
                

              },
              error: function (xhr, ajaxOptions, thrownError) {

                console.log('error');

                toastr.error(thrownError);
              }
        });

    }

</script>