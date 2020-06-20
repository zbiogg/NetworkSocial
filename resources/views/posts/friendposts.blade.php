@if($rl1=App\relationship::where('userID_1',Auth::user()->id)->where('status',1)->pluck('userID_2')) @endif
@if($rl2=App\relationship::where('userID_2',Auth::user()->id)->where('status',1)->pluck('userID_1')) @endif 
@if( $posts= App\posts::whereIn('userID',$rl2)->orwhereIn('userID',$rl1)->orwhere('userID',Auth::user()->id)->orderBy('created_at','desc')->paginate(20) )
@include('posts.allpost')
@endif
