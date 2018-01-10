<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Tax\Hsn;
use App\Models\Setting\Unit;
use App\Models\Setting\State;
use App\Models\Vendor\Vendor;
use App\Models\Tax\Gst;
use App\Models\Tax\Cess;
use App\Models\Item\Item;
use App\Models\Sale\Sale;
use App\Models\Sale\SalesItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;

class Sales extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hsn = Hsn::all()->pluck('hsn' , 'hsn');
        $units = Unit::all()->pluck ('unit' , 'id');
        $vendors = Vendor::all()->pluck ('name' , 'id');
        $gst = Gst::all()->pluck ('description' , 'id');
        $states = State::all()->pluck ('name' , 'id');
        $items=Item::pluck('name');
        $items=$items->toArray();
<<<<<<< HEAD
        $cess=Cess::all()->pluck ('description' , 'id');
        //dd($items);
        return view('sales.sales' , compact('gst' , 'vendors' , 'hsn' , 'units' , 'states','items','cess'));
=======

         $vendor_type= Sales::getEnumValues('vendors','vendor_type');
        $business_type= Sales::getEnumValues('vendors','business_type');
        $cess=Cess::all()->pluck ('description' , 'id');
        //dd($items);
        return view('sales.sales' , compact('gst' , 'vendors' , 'hsn' , 'units' , 'states','items','vendor_type','business_type','cess'));

>>>>>>> 9dfc35a31f70108c6b0e096742e52b9cb3ecffa1
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
=======

>>>>>>> 9dfc35a31f70108c6b0e096742e52b9cb3ecffa1
        $sale_table=Sale::create(json_decode($request->input('common-object'),true));
        $sale_id=$sale_table->id;
        $items_table=json_decode($request->input('table-object'),true);
        foreach($items_table as $item_row){
            //dd($item_row);
            SalesItem::insert(['sales_id'=>$sale_id,'item_id'=>$item_row['id'],'hsn'=>$item_row['hsn'],'item_type'=>$item_row['type'],'unit_price'=>$item_row['unit_price'],'quantity'=>$item_row['quantity'],'unit_id'=>$item_row['unit_id'],'discount'=>$item_row['discount'],'taxable_value'=>$item_row['taxable_value'],'gst_id'=>$item_row['gst'],'cgst'=>$item_row['cgst'],'sgst'=>$item_row['sgst'],'igst'=>$item_row['igst'],'ugst'=>$item_row['ugst'],'cess_id'=>$item_row['cess'],'tax_amount'=>$item_row['tax_amount'],'total_product_amount'=>$item_row['total_amount'],'cess_amount'=>$item_row['cess_amount']]);
        }

        return redirect("sales");


    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

//autoFill() returns the item details using item name
      public function autoFill(Request $req)
    {
        $data=$req->item;  //item is the get data from url
        //var_dump($data);
        $item_details=Item::where('name','=',$data)->get()->toArray();
        $hsn_row=HSN::where('hsn','=',$item_details[0]['hsn'])->pluck('gst_id','cess_id')->toArray();//returns an associative array with key as cess_id and value as gst_id of each row
         $gst_id=array_values($hsn_row);
         $cess_id=array_keys($hsn_row);
         $item_details[0]['gst']=$gst_id[0];
         $item_details[0]['cess']=$cess_id[0];

        
        //dd(json_encode($item_details[0]));
       
        return json_encode($item_details[0]);
       
    }

    public function vendorInfo(Request $req){
        $vendor_id=$req->input('vendor_id');
        $vendor_state=Vendor::where('id',$vendor_id)->pluck('state_id')->toArray();
        return json_encode($vendor_state);
    }
}
