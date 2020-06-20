@foreach($posts as $post)
                <div class="nf-post" id="post_{{$post->postID}}">
                    <div class="header-post">
                        <a class="profile-post" href="profile?id={{$post->userID}}">
                        @if($user = DB::table('users')->find($post->userID))
                        <img src="@if($user->img_avt=='') img/avt/avt-default.png @else img/avt/{{$user->img_avt}}  @endif" height="40px" width="40px" style="border-radius: 50%; border: 1px solid #d2d2d2;">
                        </a> 
                        <div>
                            <a class="profile-post" href="profile?id={{$post->userID}}">
                            <span class="name-request ml-2">
                            {{$user->lastName}}
                            {{$user->firstName}}
                            </span>
                            </a>
                            <div class="post_time ml-2" title="{{$post->created_at}}">
                                <a id="timepost{{$post->postID}}" href="/posts/{{$post->postID}}" style="color:#555555">
                                    <span id="autotimepost{{$post->postID}}">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                </a>
                                <script>
                                    $(document).ready(function(){
                                        setInterval(function(){
                                            $('#timepost{{$post->postID}}').load(location.href+ " #autotimepost{{$post->postID}}");
                                        },60000);
                                    });
                                </script>
                            </div>
                        </div>
                        @endif
                        <div class="dropdown ml-auto">
                            <button class="btn btn-default dropdown-toggle" " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </button>
                            @if(Auth::user()->id==$post->userID)
                            <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item">
                                    <button class="btn btn-default" style="width: 100%;" data-toggle="modal" data-target="#editModal{{$post->postID}}">
                                        <h6 align="center">Chỉnh sửa</h6>
                                    </button>
                                </a>
                                <a class="dropdown-item">
                                    <button class="btn btn-default" style="width: 100%;" data-toggle="modal" data-target="#deleteModal{{$post->postID}}">
                                        <h6 align="center">Xóa</h6>
                                    </button>
                                    
                                </a>
                                
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal{{$post->postID}}">
                        
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Xóa bài viết</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <span>Bạn thực sự muốn xóa bài viết này?</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button onclick="deletePost({{$post->postID}})" class="btn btn-danger">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <div class="modal fade" id="editModal{{$post->postID}}">
                        <form id="editPost{{$post->postID}}" onsubmit="editPost({{$post->postID}})" action="javascript:void(0)" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title">Chỉnh sửa bài viết</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <input type="hidden" name="postid_hidden" value="{{$post->postID}}">
                                        <textarea class="input-post" rows="3" value="{{$post->post_Content}}" name="content_post"  placeholder="Nhập tiêu đề">{{$post->post_Content}}</textarea>
                                        <div class="img-post">
                                            <img id="img_show_now_{{$post->postID}}" class="" style="max-width: 100%; max-height: 100%; margin: 15px 0px ;" src="@if($post->post_Image) img/posts/{{$post->post_Image}} @endif">
                                            <input type="hidden" name="img_hidden" value="{{$post->post_Image}}">
                                            <div>
                                                <input type="file" accept="image/*"name="img_post" id="img_post_edit_{{$post->postID}}" onchange="document.getElementById('img_show_now_{{$post->postID}}').src = window.URL.createObjectURL(this.files[0])" />
                                                <div style="display: flex;">
                                                    <label for="img_post_edit_{{$post->postID}}" class="btn btn-avt mx-auto" style="margin-top: 10px; border: 1px solid #778899; border-radius: 5px; padding: 5px 5px 5px 5px;">
                                                    <i class="fa fa-camera mr-2" aria-hidden="true" style="font-size: 20px;"></i>Chọn ảnh
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-info" >Lưu</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="content-post">
                        <!-- <i class="fa fa-angellist" aria-hidden="true"></i>
                            <i class="fa fa-angellist" aria-hidden="true"></i>
                            <i class="fa fa-angellist" aria-hidden="true"></i> -->
                        <p id="content_post{{$post->postID}}" style="	white-space: pre-wrap;">{{$post->post_Content}}</p>
                    </div>
                    @if($post->post_Image!='')
                    <div class="img-post">
                        <img id="img_post{{$post->postID}}" class="img-thumbnail" src="img/posts/{{$post->post_Image}}" width="100%">
                    </div>
                    @endif
                    
                    <div class="stats">
                        <button id="likePost{{$post->postID}}" onclick="likePost({{$post->postID}})" class="col btn-stats btn"  style="@if(DB::table('likes')->where('like_userID',Auth::user()->id)->where('postID',$post->postID)->first()) color: #6495ED; font-weight: bold; @endif">
                        <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                        Thích
                        @if($like_qty=DB::table('likes')->where('postID',$post->postID)->count())
                        <span id="qty_like{{$post->postID}}">( {{$like_qty}} )</span>
                        @endif
                        </button>
                        <div style="width: 1px; height: 15px; background-color: #aaa;"></div>
                        <button id="btn_cmt{{$post->postID}}" class="col btn-stats btn" >
                        <i class="fa fa-comments-o" aria-hidden="true"></i>
                        Bình luận
                        @if($cmt_qty =DB::table('comments')->where('postID',$post->postID)->count())
                        <span id="qty_cmt{{$post->postID}}">( {{$cmt_qty}} )</span>
                        @endif
                        </button>
                    </div>
                    
                    <div id="post_cmt{{$post->postID}}" class="post_cmt">
                        @if($cmt_qty>5)
                        <div id="loadmoreCmt{{$post->postID}}" style="display: none; margin-top: 5px;">
                            <a class="mr-auto" href="javascript:void(0)" onclick="loadmoreCmt({{$post->postID}})" style="font-size: 13px; color:#20B2AA">Xem các bình luận trước</a>
                        </div>
                        @endif
                        <div class='all-cmt' id='all_cmt{{$post->postID}}'></div>
                        <div id="wrapformcmt{{$post->postID}}" style="display: none; padding: 10px 0px">
                            <a class="profile-cmt mr-2" href="profile?id=1" style="display: inline-flex; align-items: center;">
                                <img src="@if(Auth::user()->img_avt=='') img/avt/avt-default.png @else img/avt/{{Auth::user()->img_avt}}  @endif" height="35px" width="35px" style="border-radius: 50%; border: 1px solid #d2d2d2;">
                            </a>
                            <form id="addCmt{{$post->postID}}" onsubmit="addCmt({{$post->postID}})" action="javascript:void(0)" enctype="multipart/form-data" style="display: flex; width: 100%; margin: 0">
                                @csrf
                                <input type="hidden" name="postID" value="{{$post->postID}}">
                                <input id="input_cmt{{$post->postID}}" class=" input-cmt" name="content_cmt" type="text" placeholder="Viết bình luận" autocomplete="off">
                                <button type="submit" class="btn ml-1" style="border: 1px solid #a9a9a9"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            
                            </form>
                        </div>
                    </div>

                    <script>
                        $("#btn_cmt{{$post->postID}}").on('click', function(){
                            var $this = $(this),
                                $toElement      = "#input_cmt{{$post->postID}}",
                                $offset         =  -300,
                                $speed          = 400;
                            if($('#all_cmt{{$post->postID}}').is(':empty')){
                                if($('#qty_cmt{{$post->postID}}').is(':empty')){
                                    $('#all_cmt{{$post->postID}}').append("<div class='text-center' style='padding: 5px 0px'><div class='spinner-border  text-muted' style='width: 1.5rem; height: 1.5rem' role='status'><span class='sr-only'>Loading...</span></div></div>");
                                }
                                $("#all_cmt{{$post->postID}}").load("/posts/comments/{{$post->postID}}").fadeIn("slow");
                                $('#loadmoreCmt{{$post->postID}}').css("display","flex");
                                $('#wrapformcmt{{$post->postID}}').css("display","flex");
                
                            }
                            setTimeout(function(){
                                $('html, body').animate({
                                    scrollTop: $($toElement).offset().top +$offset 
                                }, $speed);     
                                $('#input_cmt{{$post->postID}}').focus();
                            },500);
                                
                            
                        
                           
                            
                    
                        });
                        
                    </script>
                            
                                
                </div>
                @endforeach