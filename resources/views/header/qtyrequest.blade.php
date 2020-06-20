<sup id="qty_request">
@if($qty_request=App\relationship::where('action_userID','!=',Auth::user()->id)->where('userID_1',Auth::user()->id)->orwhere('userID_2',Auth::user()->id)->where('status',0)->count())
    <span style="font-size: 11px;font-weight: bold;padding:1px 4px; color:red;background-color: #fff">{{$qty_request}}</span> 
@endif
</sup>