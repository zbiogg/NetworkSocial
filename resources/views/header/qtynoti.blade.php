<sup id="qty_noti">
@if($qty_noti=App\notification::where('receiverID',Auth::user()->id)->where('status',0)->count())
    <span style="font-size: 11px;font-weight: bold;padding:1px 4px; color:red;background-color: #fff">{{$qty_noti}}</span> 
@endif
</sup>