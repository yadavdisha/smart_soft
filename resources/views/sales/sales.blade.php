@extends('layouts.admin')

@section('title', trans('general.title.new', ['type' => trans_choice('general.sales', 1)]))

@section('content')
<!-- Default box -->
  <div class="box box-success">
    {!! Form::open(['url' => 'incomes/invoices', 'files' => true, 'role' => 'form']) !!}

<div class="box-body">
        {{ Form::selectGroup('vendor_id', 'Party Name', 'user', $vendors) }}

        {{ Form::textGroup('invoice_date', 'Invoice Date', 'calendar',['id' => 'invoice_date', 'class' => 'form-control', 'required' => 'required', 'data-inputmask' => '\'alias\': \'yyyy/mm/dd\'', 'data-mask' => ''], null) }}

        {{ Form::textGroup('invoice_number', 'Invoice Number', 'file-text-o') }}

        {{ Form::textGroup('order_id', 'Order ID', 'shopping-cart',[]) }}

        {{ Form::selectGroup('supply_state_id', 'Place of Supply', 'user', $states) }}

        <div class="form-group col-md-12">
            {!! Form::label('items', 'Items', ['class' => 'control-label']) !!}
            <div class="table-responsive">
                <table class="table table-bordered" style="font-size: 13px;" id="items">
                    <thead>
                        <tr style="background-color: #f9f9f9;">
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'Actions' }}</th>
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'Name' }}</th>
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'HSN Code' }}</th>
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'Item Type' }}</th>       
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'Quantity' }}</th>
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'Unit' }}</th>
                            <th  colspan="1" rowspan="1" class="text-center" >{{ 'Rate' }}</th>
                            <th  rowspan="1" colspan="1" class="text-center">{{ 'Discount' }}</th>
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'GST Type' }}</th>
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'Tax Amount' }}</th>
                            <th  colspan="1" rowspan="2" class="text-center">{{ 'Total Amount' }}</th>
                            
                        </tr>
                        <tr style="background-color: #f9f9f9;">
                           <th colspan="1"  class="text-center">
                                {{ Form::radio('rateType', '0' , true) }} <span> Exc. GST</span><br>
                                {{ Form::radio('rateType', '1') }} <span> Inc. GST</span>
                            </th>



                            <th colspan="1" >
                                {{ Form::radio('discountType', '0' , true) }} <span> "Rs" </span><br>
                                {{ Form::radio('discountType', '1') }} <span> "%" </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $item_row = 0; ?>
                        <tr id="item-row-{{ $item_row }}">

                            <!-- Delete Button -->
                            <td class="text-center" style="vertical-align: middle;">
                                <button type="button" onclick="$(this).tooltip('destroy'); $('#item-row-{{ $item_row }}').remove(); 
                                itemCalculate();" data-toggle="tooltip" title="{{ trans('general.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </td>

                            <!-- Item Name -->
                            <td>
                                <!-- <input class="form-control typeahead" required="required" placeholder="{{ 'Enter Item Name' }}" name="item[{{ $item_row }}][name]" type="text" id="item-name-{{ $item_row }}">
                                <input name="item[{{ $item_row }}][item_id]" type="hidden" id="item-id-{{ $item_row }}"> -->
                              <select id="item-name-{{ $item_row }}"  name="item[{{ $item_row }}][name]"  id="item-name-{{ $item_row }}" class="select2 items-dropdown">
                                <option disabled selected>Select Item</option>
                                 <?php
                                 foreach($items as $item){
                                    
                                   echo "<option value='".$item."'>".$item."</option>";
                                 }
                                 ?>
                                 
                                </select>
                                

                                 <!-- <select id="item-name-{{ $item_row }}"  name="item[{{ $item_row }}][name]"  id="item-name-{{ $item_row }}" class="form-control select2 item-list">
                                       <?php
                                 // foreach($items as $item){
                                 //   echo "<option value=".$item.">".$item."</option>";
                                 // }
                                 ?> 
                                </select> -->
                            </td>

                            <!-- HSN Code -->
                            <td>
                                {!! Form::select('item[' . $item_row . '][tax_id]', $hsn , 'HSN Code', ['id'=> 'item-hsn-'. $item_row, 'class' => 'select2 hsn-code', 'placeholder' => 'Select HSN']) !!}
                            </td>

                            <!-- Item Type -->
                            <td>
                                <select class="select2 item-type-class" required="required"  name="item[{{ $item_row }}][type]"  id="item-type-{{ $item_row }}">
                                    <option disabled selected>Select Type</option>
                                    <option value="Goods">Goods</option>
                                    <option value="Services">Services</option>
                                </select>
                            </td>

                            <!-- Quantity -->
                            <td>
                                <input class="form-control text-center" required="required" name="item[{{ $item_row }}][quantity]" type="text" id="item-quantity-{{ $item_row }}">
                            </td>


                            <!-- Unit -->
                            <td>
                                {!! Form::select('item[' . $item_row . '][unit_id]', $units , 'UNIT', ['id'=> 'item-tax-'. $item_row, 'class' => 'select2', 'placeholder' => 'Select GST']) !!}
                            </td>

                            <!-- Rate -->
                            <td>
                                <input class="form-control text-right" required="required" name="item[{{ $item_row }}][price]" type="text" id="item-price-{{ $item_row }}">
                            </td>

                            <!-- Discount -->
                            <td>
                                <input class="form-control typeahead" required="required" placeholder="{{ 'Discount' }}" name="item[{{ $item_row }}][discount]" type="text" id="item-discount-{{ $item_row }}">
                                <input name="item[{{ $item_row }}][item_id]" type="hidden" id="item-id-{{ $item_row }}">
                            </td>
                            
                            <!-- GST ID -->
                            <td>
                                {!! Form::select('item[' . $item_row . '][gst_id]', $gst , 'GST', ['id'=> 'item-gst-'. $item_row, 'class' => 'select2 gst-type', 'placeholder' => 'Select GST']) !!}
                            </td>
   
                            <!-- Total Tax -->
                            <td class="text-right" style="vertical-align: middle;">
                                 <span id="item-tax-info-0" class="item-tax-info" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Please Select All Options First" data-html="true" style="float:left"><i style="font-size:1.5vw;color:blue" class="fa">&#xf129;</i></span>
                                <span id="item-total-tax-{{ $item_row }}">0</span>
                            </td>

                            <!-- Product Total -->
                            <td class="text-right" style="vertical-align: middle;">
                                <span id="item-total-{{ $item_row }}">0</span>
                            </td>

                       

                        </tr>

                        <?php $item_row++; ?>
                        <!-- Add Item Button -->
                        <tr id="addItem">
                            <td class="text-center"><button type="button" onclick="addItem();" data-toggle="tooltip" title="{{ trans('general.add') }}" class="btn btn-xs btn-primary" data-original-title="{{ trans('general.add') }}"><i class="fa fa-plus"></i></button></td>

                            <td class="text-right" colspan="10"></td>
                        </tr>

                        <tr>
                            <td class="text-right" colspan="10"><strong>{{ 'Total Taxable Value' }}</strong></td>

                            <td class="text-right"><span id="sub-total">0</span></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="10"><strong>{{ 'Total Tax Amount' }}</strong></td>

                            <td class="text-right"><span id="tax-total">0</span></td>
                        </tr>
                        <tr>
                            <td class="text-right" colspan="10"><strong>{{ 'Total Invoice Amount' }}</strong></td>

                            <td class="text-right"><span id="grand-total">0</span></td>
                        </tr>
                    </tbody>
                        
                </table>
            </div>
        </div>
        {{ Form::textareaGroup('notes', trans_choice('general.notes', 2)) }}

        {{ Form::fileGroup('attachment', trans('general.attachment')) }}
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        {{ Form::saveButtons('incomes/invoices') }}
    </div>
    <!-- /.box-footer -->

    {!! Form::close() !!}


    <!-- Modal -->
<div id="add-item-Modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Item</h4>
      </div>
      <div class="modal-body">
        <form class="add-item-form">
            <div class="box-body">
                {{ Form::textGroup('name', 'Item Name' , 'id-card-o') }}

                {{ Form::textGroup('sku', 'Item SKU' , 'key') }}

                {{ Form::selectGroup('hsn', 'HSN Code' , 'barcode', $hsn, '00000000' , []) }}

                {{ Form::selectGroup('unit_id', 'Unit' , 'balance-scale', $units, '59', []) }}

                {{ Form::itemTypeGroup('type', 'Item Type' ) }}

                {{ Form::textareaGroup('details', 'Item Details') }}
                <div style="float:right">
             <input type="submit" name="submit" value="Save" class="btn btn-success"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
             
        </form>
      </div>
      
    </div>

  </div>
</div>

   
@endsection



@section('js')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('dist/js/select2.full.min.js') }}"></script>
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('js/bootstrap-datepicker.min.js') }}">
    <script src="{{ asset('js/bootstrap-fancyfile.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@endsection

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-fancyfile.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style type="text/css">
.input-group .select2-container{
  width:100% !important;  
}

   td input.form-control{
        border-radius: 9%;
        height:4.2vh;
        border-color: grey;

    }

    th{
        font-size: 1.8vh;
    }
    th[rowspan]{
    vertical-align: top !important;
}
</style>

@endsection



@section('scripts')
    <script type="text/javascript">
        var item_row = '{{ $item_row }}';

        var globalRow=0;


        function addItem() {
            html  = '<tr id="item-row-' + item_row + '">';

            //Delete Button
            html  += '  <td class="text-center" style="vertical-align: middle;">';
            html  += '    <button type="button" onclick="$(this).tooltip(\'destroy\'); $(\'#item-row-' + item_row + '\').remove(); itemCalculate();" data-toggle="tooltip" title="{{ trans('general.delete') }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>';
            html  += '  </td>';


            html  += '</tr>'
            $('#items tbody #addItem').before(html);
            item_row++;
        }



       $(document).ready(function(){
            //Date picker
            $('#invoice_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });


            //$('#vendor_id').select2($("<option value=\"add_item\"><b>Add Vendor</b></option>"));

            
            //Select2 For Vendor ID
            $('#vendor_id').select2({
                placeholder: "{{ 'Select Vendors' }}",
            })
            .on("select2:select", function(e) { 
                   // what you would like to happen
                   if($(this).val() == "add_item")
                      alert("Here it IS!");

                  $.ajax({
                url: '{{ url("vendorInfo") }}',
                type: 'POST',
                dataType: 'JSON',
                data: {'vendor_id':$(this).val()},
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                     
                    if (data) {
                        //$('#supply_state_id').select2("val", data[0]);
                        $('#supply_state_id').val(data[0]).trigger('change.select2');// for changing the values in select2 tag
                        //console.log(state);

                       itemCalculate();
                    }
                }
            });


            })
            .on('select2:open', () => {
                    $(".select2-results:not(:has(a))").append('<a href="#" style="padding: 1%;display:inline;">Add New</a>');
            });



            //Select2 For State ID
            $('#supply_state_id').select2({
                placeholder: "{{ 'Select Supply State' }}",
            }).on("select2:select", function(e) { 
                   // what you would like to happen
                   var selectedOption = ($(e.currentTarget).val());
                   //console.log(selectedOption);
                   itemCalculate();
            });

            //$(document).on('click', '#add, #select2-results-2, .select2-results,.select2-drop', function(){
            //    alert();
            //});
            


            $(document).on('click', '.form-control.typeahead', function() {
                input_id = $(this).attr('id').split('-');

                item_id = parseInt(input_id[input_id.length-1]);

                itemCalculate();

                $(this).typeahead({
                    minLength: 3,
                    displayText:function (data) {
                        return data.name;
                    },
                    source: function (query, process) {
                        $.ajax({
                            url: autocomplete_path,
                            type: 'GET',
                            dataType: 'JSON',
                            data: 'query=' + query + '&type=invoice&currency_code=' + $('#currency_code').val(),
                            success: function(data) {
                                return process(data);
                            }
                        });
                    },
                    afterSelect: function (data) {
                        $('#item-id-' + item_id).val(data.item_id);
                        $('#item-quantity-' + item_id).val('1');
                        $('#item-price-' + item_id).val(data.sale_price);
                        $('#item-tax-' + item_id).val(data.tax_id);

                        // This event Select2 Stylesheet
                        $('#item-tax-' + item_id).trigger('change');

                        $('#item-total-' + item_id).html(data.total);

                        itemCalculate();
                    }
                });
            });

            //When any Item data is changed
            $(document).on('keyup', '#items tbody .form-control', function(){
                itemCalculate();
            });

            $(document).on('change','.gst-type',function(){
            
              itemCalculate();
            });

            $(document).on('change', '#vendor_id', function (e) {
                $.ajax({
                    url: '{{ url("vendor") }}',
                    type: 'GET',
                    dataType: 'JSON',
                    data: 'customer_id=' + $(this).val(),
                    success: function(data) {
                        $('#currency_code').val(data.currency_code);

                        // This event Select2 Stylesheet
                        $('#currency_code').trigger('change');
                    }
                });
            });
        });

       $(document).on('click','input[name="rateType"],input[name="discountType"]',function(){
        itemCalculate();
       });


       function itemCalculate() {
        var row;
            $.ajax({
                url: '{{ url("items/itemCalculate") }}',
                type: 'POST',
                dataType: 'JSON',
                data: $('#supply_state_id, input[name=\'discountType\']:checked, #items input[type=\'text\'],#items input[type=\'hidden\'], #items textarea, #items select,input[name=\'rateType\']:checked'),
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                    if (data) {
                         console.log(data);
                        $.each( data.items, function( key, itemData ) {
                            $.each( itemData , function (attr , subvalue) {
                                if(attr == 'total')
                                    $('#item-total-' + key).html(subvalue);
                                if(attr == 'totalTax')
                                    $('#item-total-tax-' + key).html(subvalue);
                            //$('#item-total-tax-' + key).html(subvalue);
                            //$('#item-total-' + key).html(subvalue);
                             row=key;
                            });
                            
                        });
                        
                        $('#sub-total').html(data.sub_total);
                        $('#tax-total').html(data.tax_total);
                        $('#grand-total').html(data.grand_total);
                         $("#item-tax-info-"+row).attr('data-content',"CGST:"+data.items[0].cgst+"<br>SGST:"+data.items[0].sgst+"<br>IGST:"+data.items[0].igst+"<br>UGST:"+data.items[0].ugst).data('bs.popover').setContent();//used for reinitializing the popover element after changing content
                    }
                }
            });
        }
     


//This method uses element having class:'item-name-class' and autofills the item information 
//It is the first input of every row in items html table
  


     $(document).ready(function(){
        
     $(".item-tax-info").popover();
});

$(document).on('change','.hsn-code',function(){
var row = $(this).parent().parent().index();
//console.log(row);

$.ajax({
                url: '{{ url("/hsn") }}',
                type: 'POST',
                dataType: 'JSON',
                data: {'hsn_code':$(this).val()},
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                     
                    if (data) {
                        //console.log(data['item_type']);
                       document.getElementById('item-type-'+row).value=data['item_type'];
                       document.getElementById('item-gst-'+row).value=data['gst_id'];
                       $('.select2').trigger('change.select2');
                       itemCalculate();
                    }
                }
            });

});  
   

$(document).ready(function() {
    $('td .select2').select2();
});

$(document).ready(function() {
    $('.items-dropdown').on('select2:select',function(){
  
   var row = $(this).parent().parent().index();
    
    var itemName=$("#item-name-"+row).val();
    //console.log(itemName);
   
    globalRow=row;
    var xml=new XMLHttpRequest();
     xml.onreadystatechange=function(){
      if(this.readyState==4 && this.status==200){
        var item_details=JSON.parse(this.responseText);
        console.log(item_details);
        if(Object.keys(item_details).length>0){// Object.keys(item_details).length used to calculate length of object 
        var hsn=document.getElementById('item-hsn-'+row);
         hsn.value=item_details['hsn'];
         console.log(item_details['type']);
        document.getElementById('item-type-'+row).value=item_details['type'];
        document.getElementById('item-tax-'+row).value=item_details['unit_id'];
         document.getElementById('item-gst-'+row).value=item_details['gst'];
        $('.select2').trigger('change.select2'); //for updating select2 selected option
        itemCalculate();


               
      }
      }        
     };
     xml.open("GET","{{  url('/autofill')  }}?item="+itemName,true);
     xml.send();


    });
});


$(document).on('submit','.add-item-form',function(event){
console.log("lol");
event.preventDefault();
$.ajax({
                url: '{{ url("/items/ajaxStore") }}',
                type: 'POST',
                dataType: 'JSON',
                data: $('input[name="name"],input[name="sku"],#hsn,#unit_id,input[name="type"]:checked,#details'),
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(data) {
                     
                    if (data) {
                        console.log(data);
                var hsn=document.getElementById('item-hsn-'+globalRow);
              hsn.value=data['hsn'];
         console.log(data);
        document.getElementById('item-type-'+globalRow).value=data['type'];
        document.getElementById('item-tax-'+globalRow).value=data['unit_id'];
         document.getElementById('item-gst-'+globalRow).value=data['gst'];
         var option = new Option(data.name,data.name, true, true);  // Option(innerHTML,value,selected,actual Selection)
         $('#item-name-'+globalRow).append(option);

          $('.select2').trigger('change.select2'); //for updating select2 selected option
          itemCalculate();
          $('#add-item-Modal').modal('hide');
                    }
                }
            });
});

$(document).ready(function(){ //function for adding a "Add new Button in options of select2"
$('.items-dropdown').select2({
   "language": {
       "noResults": function(){
           return "No Results Found <a href='#' class='btn btn-sm btn-info add-new-item' style='width:100%'>Add new item</a>";
       }
   },
    escapeMarkup: function (markup) {
        return markup;
    }
});
});

$(document).on('click','.add-new-item',function(){


 
        $('#add-item-Modal form').trigger('reset'); //for resetting values
        $('#type_1').css({"background-color":"#E7E7E7","color":"black"});
        $('#type_0').css({"background-color":"#E7E7E7","color":"black"}); //for resetting the radio button in modal
        $('#type_0').removeClass("active");
        $('#type_1').removeClass("active");
        $('#item-name-'+globalRow).select2('close');
        $('#add-item-Modal').modal();
        
        
    

});

$(document).ready(function(){
$(".item-type-class").select2({
    minimumResultsForSearch: Infinity
});
});

$(document).ready(function(){
$('.radio-inline').on('click','label',function(){
if($(this).attr('id')=="type_0"){
  $(this).css({"background-color":"#398439","color":"white"});
  $('#type_1').css({"background-color":"#E7E7E7","color":"black"});
}
else{
$(this).css({"background-color":"#AC2925","color":"white"});
  $('#type_0').css({"background-color":"#E7E7E7","color":"black"});
}
});
});


    </script>
@endsection