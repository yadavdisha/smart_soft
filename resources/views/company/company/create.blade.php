@extends('layouts.admin')



@section('content')
  <ul class="nav nav-tabs">
    <li class="active"><a href="#">Company</a></li>
    <li><a href="#">Bank Accounts</a></li>
    <li><a href="#">Branches</a></li>
    
  </ul>
 
  {!! Form::open(array('url' => '/company')) !!}
  <div id="company"  class="parts">
     <br>
  <br>
      {{ Form::textGroup('name', 'Company Name' , 'industry') }}
      {{ Form::textGroup('pan', 'PAN' , 'key') }}
  </div>
  <div id="company-bank-accounts" class="parts">
    <br>
    <span class="new-button"><a href="#accountModal" class="btn btn-success btn-sm"  data-toggle="modal"><span class="fa fa-plus"></span> &nbsp;{{ trans('general.add_new') }}</a></span>
     <table class="table table-striped table-hover" id="tbl-items">
                <thead>
                    <tr>
                        <th class="col-md-1 hidden">Account Identifier</th>
                        <th class="col-md-1 hidden">Entity Name</th>
                        <th class="col-md-1">Holder Name</th>
                         <th class="col-md-1">Bank Name</th>
                         <th class="col-md-1">Account Number</th>
                         <th class="col-md-1">Ifsc</th>
                         <th class="col-md-1 hidden">Notes</th>                
                        <th class="col-md-1 text-center">actions</th>
                    </tr>
                </thead>

                <tbody>
                   
                    
                </tbody>
            </table>
     <!--  <table class="table table-striped">
        <thead>
            <th>Account Identifier</th>
            <th>Entity Name</th>
            <th>Holder Name</th>
            <th>Bank Name</th>
            <th>Account Number</th>
            <th>Ifsc Code</th>
            <th>Notes</th>
 </thead>
          <tbody>
             <td>
<div class="form-group">
    <input type="text" class="form-control" id="account-i-0" name="accounts[0][account_identifier]">
</div>
             </td>
             <td>
                 <div class="form-group">
    <input type="text" class="form-control" id="e-name-0" name="accounts[0][entity_name]">
</div>
             </td>
             <td>
                 <div class="form-group">
    <input type="text" class="form-control" id="holder-0" name="accounts[0][holder_name]">
</div>
             </td>
             <td><div class="form-group">
    <input type="text" class="form-control" id="bank-0" name="accounts[0][bank_name]">
</div></td>
             <td><div class="form-group">
    <input type="text" class="form-control" id="account-no-0" name="accounts[0][account_number]">
</div></td>
             <td>
                 <div class="form-group">
    <input type="text" class="form-control" id="ifsc-0" name="accounts[0][ifsc]">
</div>
             </td> 
             <td>
                 <div class="form-group">
    <textarea type="text" class="form-control" id="notes-0" name="accounts[0][account_number]" rows="1"></textarea>
</div>
             </td>
          </tbody>
      </table> -->
  </div>


  <div id="company-branches" class="parts">
    <br>
     <span class="new-button"><a href="#branchesModal" class="btn btn-success btn-sm"  data-toggle="modal"><span class="fa fa-plus"></span> &nbsp;{{ trans('general.add_new') }}</a></span>

      <table class="table table-striped table-hover" id="tbl-items">
                <thead>
                    <tr>
                        <th class="col-md-1">@sortablelink('id', 'ID')</th>
                        <th class="col-md-1">@sortablelink('name', 'Name')</th>
                        <th class="col-md-1">@sortablelink('pan', 'PAN')</th>
                        <th class="col-md-1">Status</th>
                        <th class="col-md-1 text-center">actions</th>
                    </tr>
                </thead>

                <tbody>
                   
                        <tr>
                            <td class="col-md-1"></td>
                            <td class="col-md-1"></td>
                            <td class="col-md-1"></td>
                            <td class="col-md-1"></td>
                            
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-toggle-position="left" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        
                                        
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    
                </tbody>
            </table>
  </div>

  <div id="company-gstin" class="parts"></div>
 

   {!! Form::close() !!}

  <!-- Modal -->
<div id="accountModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Account</h4>
      </div>
      <div class="modal-body" style="overflow-y: hidden">
         
         {{ Form::textGroup('aci', 'Account Identifier' , 'industry') }}

         {{ Form::textGroup('en', 'Entity Name' , 'industry') }}

         {{ Form::textGroup('hn', 'Holder Name' , 'industry') }}

         {{ Form::textGroup('bn', 'Bank Name' , 'industry') }}

          {{ Form::textGroup('an', 'Account Number' , 'industry') }}

           {{ Form::textGroup('ifsc', 'Ifsc Code' , 'industry') }}

            {{ Form::textGroup('notes', 'Notes' , 'industry') }}


         
      </div>
      <div class="modal-footer">
         <button  class="btn btn-success" id="account_save">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="branchesModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Branch</h4>
      </div>
      <div class="modal-body" style="overflow-y: hidden">
       {{ Form::textGroup('aci', 'Account Identifier' , 'industry') }}

         {{ Form::textGroup('gstin', 'GSTIN' , 'industry') }}

         {{ Form::textGroup('brname', 'Branch Name' , 'industry') }}

         {{ Form::textGroup('phone', 'Phone' , 'industry') }}

          {{ Form::emailGroup('email', 'Email' , 'industry') }}

           {{ Form::textareaGroup('address', 'Address') }}

             {{ Form::selectGroup('city', 'City' , 'industry',["0"=>"lol"] ) }}

            {{ Form::selectGroup('state', 'State' , 'industry',["0"=>"lol"]) }}

             {{ Form::selectGroup('country', 'Country' , 'industry',["0"=>"lol"]) }}

              {{ Form::textGroup('pincode', 'Pin Code' , 'industry',["0"=>"lol"]) }}
               
               {{ Form::textGroup('gstin', 'GSTIN' , 'industry') }}              

      </div>
      <div class="modal-footer">
        <button  class="btn btn-success" id="branch_save">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




@endsection

@section('js')
    <script src="{{ asset('js/bootstrap-fancyfile.js') }}"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
    <script src="{{ asset('dist/js/select2.full.min.js') }}"></script>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-fancyfile.css') }}">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <style type="text/css">
         #company-bank-accounts,#company-branches,#company-gstin{
            display:none;
         }

     </style>
@endsection

@section('scripts')
    <script type="text/javascript">
    var tabno=0;
    var row=0;
        var text_yes = '{{ trans('general.goods') }}';
        var text_no = '{{ trans('general.service') }}';

        $(document).ready(function(){
            $('#type_0').trigger('click');

            $('#name').focus();

            $("#unit_id").select2({
                placeholder: "{{ trans('general.form.select.field', ['field' => trans_choice('general.unit' , 2)]) }}"
            });

            $("#hsn").select2({
                placeholder: "{{ trans('general.form.select.field', ['field' => trans('general.hsn')]) }}"
            });

        });


$(document).ready(function(){
$('.radio-inline label').removeClass('active');
$('.radio-inline').on('click','label',function(){
if($(this).attr('id')=="type_0"){
  $(this).css({"background-color":"#398439","color":"white"});
  $('#type_1').css({"background-color":"#E7E7E7","color":"black"});
}
else{
$(this).css({"background-color":"red","color":"white"});
  $('#type_0').css({"background-color":"#E7E7E7","color":"black"});
}
});

$('.nav-tabs').on('click','li',function(){

$(this).addClass('active');
$('.parts').eq(tabno).css({display:"none"});
$('.nav-tabs li').eq(tabno).removeClass('active');
tabno=$(this).index();
$('.parts').eq(tabno).css({display:"block"});


});

$('#account_save').click(function(){
var accnt_id=$('#aci').val();
var entity_name=$('#en').val();
var holder_name=$('#hn').val();
var bank_name=$('#bn').val();
var account_number=$('#an').val();
var ifsc_code=$('#ifsc').val();
var notes=$('#notes').val();
var htmlRow=$('#company-bank-accounts tbody').append('<tr id="account-row-'+row+'"><td class="col-md-1 hidden"><span>'+accnt_id+'<input type="hidden" name="accounts['+row+'][account_identifier]" value='+accnt_id+'></span></td><td class="col-md-1 hidden"><span>'+entity_name+'<input type="hidden" name="accounts['+row+'][entity_name]" value='+entity_name+'></span></td><td class="col-md-1"><span>'+holder_name+'<input type="hidden" name="accounts['+row+'][holder_name]" value='+holder_name+'></span></td><td class="col-md-1"><span>'+bank_name+'<input type="hidden" name="accounts['+row+'][bank_name]" value='+bank_name+'></span></td><td class="col-md-1"><span>'+account_number+'<input type="hidden" name="accounts['+row+'][account_number]" value='+account_number+'></span></td><td class="col-md-1"><span>'+ifsc_code+'<input type="hidden" name="accounts['+row+'][ifsc_code]" value='+ifsc_code+'></span></td><td class="col-md-1 hidden"><span>'+notes+'<input type="hidden" name="accounts['+row+'][notes]" value='+notes+'></span></td><td class="text-center"><div class="btn-group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-toggle-position="left" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button><ul class="dropdown-menu dropdown-menu-right"></ul></div></td></tr>');

row++;
$('#accountModal').modal('hide');
$('#accountModal input').val("");
});


});



    </script>
@endsection
