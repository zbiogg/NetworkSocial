<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Load More Post -->
<script>
	var page = 2;
	function loadmore() {
        if(pageloadmore==0){
            var url_load="/posts/newfeedposts?page=";
            console.log('newfeed');
        }else{
            var url_load="/posts/friendposts?page=";
            console.log('13');
        }
        $('#loading').append("<div class='text-center' style='padding:5px 0px'><div class='spinner-border  text-muted' style='width: 1.5rem; height: 1.5rem' role='status'><span class='sr-only'>Loading...</span></div></div>");
		$.ajax({
		  type: "GET",
		  url: url_load+page,
		  cache: false,
		  success: function(data){      
                $("#allpost").append(data);
                $('#loading').html('');

		  }
		});
        nextpageload=page+1;
        $.ajax({
		  type: "GET",
		  url: url_load+nextpageload,
		  cache: false,
		  success: function(datanext){
            if(datanext){
                pagecmt=nextpageload;
            }else{
                $('#loadmore').html("<h6 class='mx-auto'>Bạn đã xem hết bài viết</h6>");
                $('#loading').remove();
            }
		  }
		});
        
        
	}
</script>
<!-- Add Post -->
<script>
    $(document).ready(function(){
        $("#uploadPost").on('submit',function(  ){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var formData = new FormData($('form#uploadPost')[0]);
            $.ajax({
                url: 'addPost',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) { 
                    $('#allpost').prepend("<div class='text-center' style='padding: 5px 0px'><div class='spinner-border  text-muted' style='width: 1.5rem; height: 1.5rem' role='status'><span class='sr-only'>Loading...</span></div> Đang tải..</div>");
                    $('#content_post').val('');
                    $('#img_post').val('');
                    $('#img_show').attr("src","");
                    $('#img_show').hide();
                    $('#allpost').load('/posts/newfeedposts').fadeIn(5000);
                    $('#wrap_qtypostprofile').load(location.href+" #qtypostprofile");
                    
                        
                }
            }); 
        });

        
    });    
</script>
<!-- Delete Post -->
<script>
    
    function deletePost(postID){
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            var dlModal ='#deleteModal'+postID;
            var postDelete = '#post_'+postID;
            
            
        $.ajax({
            url: 'posts/deletePost',
            type: 'POST',
            data: {'postID':postID},
            success: function (data) {
                $(dlModal).fadeOut(1200, function(){
                    $(dlModal).hide();
                    $('body').removeClass('modal-open');
                    
                });
                $('.modal-backdrop').remove();
                
                
                $(postDelete).fadeOut(600, function(){
                    $(postDelete).remove();
                });
                $('#wrap_qtypostprofile').load(location.href+" #qtypostprofile");
            }
            });
    }
</script>
<!-- Edit Post -->
<script>
    function editPost(postID){
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            var idform='form#editPost'+postID;
            var formData = new FormData($(idform)[0]);
            var edModal ='#editModal'+postID;
            var postEdit = '#post_'+postID;
            var content_post_id='#content_post'+postID;
            var img_post_id='#img_post'+postID;
        $.ajax({
            url: 'posts/editPost',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) { 
                console.log(data.post_Content);
                
                $(edModal).fadeOut(500, function(){
                    $(edModal).hide();
                    $('body').removeClass('modal-open');
                    
                });
                $('.modal-backdrop').remove();
                
                
                
                
                $(content_post_id).html(data.post_Content);
                $(img_post_id).attr("src","img/posts/"+data.post_Image);
                
                
            }
        }); 
            
    }
</script>
<!-- edit Avt -->
<script>
    function uploadAvt(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var FormDataUpAvt= new FormData($('form#uploadAvt')[0]);
        $.ajax({
            url: 'profile/editAvt',
            type: 'POST',
            data: FormDataUpAvt,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data){
                console.log('haha');
                $('#wrap_avt_profile').load(location.href+ " #avt_profile");
                $('#model-avt').fadeOut(500, function(){
                    $('#model-avt').hide();
                    $('body').removeClass('modal-open');
                    
                });
                $('.modal-backdrop').remove();
            }
        });
    }
</script>
<!-- Edit cover -->
<script>
    function uploadCover(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var FormDataUpCover= new FormData($('form#uploadCover')[0]);
        $.ajax({
            url: 'profile/editCover',
            type: 'POST',
            data: FormDataUpCover,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data){
                console.log(data);
                $('#cover_profile').css("background-image","url('img/cover/"+data+"')");
                $('#model-cover').fadeOut(500, function(){
                    $('#model-cover').hide();
                    $('body').removeClass('modal-open');
                    
                });
                $('.modal-backdrop').remove();
            }
        });
    }
</script>
<!-- edit Info -->
<script>
    function editInfo(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var FormDataEditInfo = new FormData($('form#editInfo')[0])
        $.ajax({
            url: '/profile/editInfo',
            type: 'POST',
            data: FormDataEditInfo,
            cache: false,
            processData: false,
            contentType: false,
            success:function(data){
                console.log(data);
                $('#editInfoModal').fadeOut(500, function(){
                    $('#editInfoModal').hide();
                    $('body').removeClass('modal-open');
                    
                });
                $('.modal-backdrop').remove();
                $('#wrap_info_profile').load(location.href + " #info_profile");
            }
        });
    }
</script>
<!-- Add Commment -->
<script>

    function addCmt(postID){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            var idform='form#addCmt'+postID;
            var formData = new FormData($(idform)[0]);
        
        $.ajax({
            url: 'posts/addCmt',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (data) { 
                var cmtID='cmt'+data.id;
                $('#all_cmt'+postID).append("<div class='detail_cmt' id='"+cmtID+"'></div>");
                $('#'+cmtID).load('/posts/newcomment');
                $('#input_cmt'+postID).val('');
                document.activeElement.blur();
                $('#btn_cmt'+postID).load(location.href+" #btn_cmt"+postID);
                
                
            }
        }); 
            
    }
</script>
<!-- Loadmore CMT -->
<script>
    var pagecmt=2;
    function loadmoreCmt(postID){   
        $('#loadmoreCmt'+postID).append("<div class='text-center loadingCmt' style='padding:5px 0px'><div class='spinner-border  text-muted' style='width: 1.0rem; height: 1.0rem' role='status'><span class='sr-only'>Loading...</span></div></div>");
        $.ajax({
		  type: "GET",
		  url: "/posts/comments/"+postID+"?page="+pagecmt,
		  cache: false,
		  success: function(data){    
                $("#all_cmt"+postID).prepend(data);
                $('.loadingCmt').html('');
                
		  }
		});
        nextpagecmt=pagecmt+1;
        $.ajax({
		  type: "GET",
		  url: "/posts/comments/"+postID+"?page="+nextpagecmt,
		  cache: false,
		  success: function(datanext){
            if(datanext){
                pagecmt=nextpagecmt;
            }else{
                $('#loadmoreCmt'+postID).remove();
            }
		  }
		});
        
    }
</script>
<!-- loadmore posts profile -->
<script>
	var pageprofile = 2;
	function loadmoreprofile() {
        var idprofile=$('#idprofile').val();
        console.log(idprofile);
        $('#loading').append("<div class='text-center' style='padding:5px 0px'><div class='spinner-border  text-muted' style='width: 1.5rem; height: 1.5rem' role='status'><span class='sr-only'>Loading...</span></div></div>");
		$.ajax({
		  type: "GET",
		  url: "/profile/profileposts/"+idprofile+"?page="+pageprofile,
		  cache: false,
		  success: function(data){
            pageprofile = pageprofile + 1;
            if(data){      
                $("#allpost").append(data);
                $('#loading').html('');
		        
                 
            }else{
                $('#loading').remove();
                $('#loadmore').html("<p class='mx-auto' style='margin-top: 5px'>Bạn đã xem hết bài viết!!!</p>");
            }
		     

		  }
		});
        
        
	}
</script>
<!-- Request Friends -->
<script>
 function acceptFriend(senderID){
    $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
        url: 'friends/acceptFriend',
        type: 'POST',
        data: {'senderID':senderID},
        success: function (data) {
            $('.replyfriend'+senderID).fadeOut("slow",function(){
                $('.replyfriend'+senderID).html("<a><button class='btn btn-rela ml-auto' style='font-size: 12px;'>Bạn bè <i class='fa fa-check-square-o' aria-hidden='true'></i></button></a>").fadeIn("slow");
            });
            $('.replyfriend'+senderID).fadeIn("slow");
            $('#wrap_rela_status').load(location.href+" #rela_status");

        }
        });
 }

</script>
<!-- delete Request -->
<script>
    function deleteRequest(senderID){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
            url: 'friends/deleteRequest',
            type: 'POST',
            data: {'senderID':senderID},
            success: function (data) {
                $('.item_request'+senderID).fadeOut("slow", function(){
                $('.item_request'+senderID).remove();
            });

            }
        });
    }
</script>
<!-- add repCmr -->
 <script>

    function addrepCmt(cmtID){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                var idformcmt='form#addrepCmt'+cmtID;
                var formDatacmt = new FormData($(idformcmt)[0]);
            
            $.ajax({
                url: 'posts/addrepCmt',
                type: 'POST',
                data: formDatacmt,
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) { 
                    var repcmtID='repcmt'+data.id;
                    $('#all_repcmt'+cmtID).append("<div class='detail_repcmt' id='"+repcmtID+"'></div>");
                    $('#'+repcmtID).load('/posts/newreplycomment');
                    $('#input_rep_content'+cmtID).val('');
                    document.activeElement.blur();
                    
                    
                }
            }); 
                
        }
 </script>
<!-- show repcmt -->
 <script>
     function showrepCmt(cmtID){
        var $this = $(this),
            $toElement      = "#input_rep_content"+cmtID,
            $offset         =  -300,
            $speed          = 400;
        $("#input_repcmt"+cmtID).show();
        $('#all_repcmt'+cmtID).load('posts/replycomments/'+cmtID);
        $('#btn_repcmt'+cmtID).fadeOut();
        setTimeout(function(){
            $('html, body').animate({
                scrollTop: $($toElement).offset().top +$offset 
            }, $speed); 
            $("#input_rep_content"+cmtID).focus();
        },500);
     }
 </script>
 <!-- add Friend -->
 <script>
     function addFriend(receiverID){
    $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
        url: 'friends/addFriend',
        type: 'POST',
        data: {'receiverID':receiverID},
        success: function (data) {
            $('.add_friend'+receiverID).fadeOut("slow",function(){
                $('.add_friend'+receiverID).html("<a><button class='btn btn-rela ml-auto' style='font-size: 12px;'>Đã gửi lời mời kết bạn <i class='fa fa-reply' aria-hidden='true'></i></button></a>").fadeIn("slow");
            });
            $('.add_friend'+receiverID).fadeIn("slow");

            $('#wrap_rela_status').load(location.href+" #rela_status");
            
        }
        });
    }
 
 </script>
 <!-- delete susget -->
 <script>
     function deleteSGS(id){
        $('#item_sgs'+id).fadeOut("slow",function(){
            $('#item_sgs'+id).remove();
        });
     }
 </script>
 <!-- like post -->
 <script>
     function likePost(postID){
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'posts/likePost',
            type: 'POST',
            data: {'postID':postID},
            success: function (data) {
                if(data==1){
                    $('#likePost'+postID).css('color','#6495ED');
                    $('#likePost'+postID).css('font-weight','bold');

                }else if(data==0){
                    $('#likePost'+postID).css('color','');
                    $('#likePost'+postID).css('font-weight','normal');
                }
                $('#qty_like'+postID).load(location.href+" #qty_like"+postID);
                
            }
        });
     }
 </script>
<!-- auto load -->
 <script>
    setInterval(function(){
    $('#wrap_online_list').load('/listonline');
    $('#wrap_qty_noti').load('/qtynoti');
    $('#wrap_qty_request').load('qtyrequest');
    },3000);
    function ok(){
        if(window.location.pathname=='/'){
        window.history.pushState("", "", '/notifications');
        $('#c_main').load('notifications'+" #wrap_noti");
        $('#drdown-Noti').css('display','none');
        }else if(window.location.pathname=='/notifications'){
        $('#drdown-Noti').css('display','none');
        }else{
            window.location.replace('/notifications');
        }
        
        
    }
    $('.navbar-toggler').on('click', function(){
        if($('#sidebar-collapse').css('display')=="none"){
            $(window).scrollTop($('#sidebar-collapse').position().top);
        }else{
            console.log('0');
        }
        
    })
</script>
<!-- 3 item header -->
<script>

		jQuery('.dropdown-toggle').on('click', function (e) {
		$(this).next().toggle();
		});
		jQuery('.dropdown-menu.keep-open').on('click', function (e) {
		e.stopPropagation();
		});
		function dropmenuitem(droptype){
			if(droptype!="drdown-Request"){
				$('#drdown-Request').css('display','none');
			}
			if(droptype!="drdown-Mess"){
				$('#drdown-Mess').css('display','none');
			}
			if(droptype!="drdown-Noti"){
				$('#drdown-Noti').css('display','none');
            }
            if(droptype=="drdown-Noti"){
                $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });
                $.ajax({
                    url: 'readNoti',
                    type: 'POST',
                    success: function (data) {
                        console.log(data);
                        $('#wrap_noti_header').load('/loadnoti');
                    }
                 });
            }
        }
</script>
    <!--Tìm kiếm  -->
<script>
    $(document).ready(function(){
        $("#searchForm").on('submit',function(e){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var content=$('#search_content').val();
            url_search='/search?content='+content;
            
            var formDataSearch = new FormData($('form#searchForm')[0]);
            $.ajax({
                url: '/search?content='+content,
                type: 'GET',
                data: {'content': content},
                success: function (data) {
                    $('#keysearch').html(content);
                    $('#title_keysearch').css('display','block');
                    $('#wrap_rs_users').load(url_search+" #rs_users");
                    $('#wrap_rs_posts').load(url_search+" #rs_posts");
                    window.history.pushState("", "", url_search);
                }
            }); 
        });
    });
            
</script>

<!-- option View All or Friend Post -->
<script>
    pageloadmore=0 //page posts all

    function selectView(select){
        if(select==1){
            $('#allpost').fadeOut(function(){
                $('#allpost').load('/posts/newfeedposts');
            });
            $('#allpost').fadeIn();
        }else{
            pageloadmore=1 //page posts friend
            $('#allpost').fadeOut(function(){
                $('#allpost').load('/posts/friendposts');
            });
            $('#allpost').fadeIn();
        }
    }
</script>
<!-- option view Trend -->
<script>
    pageloadmore=0 //page posts all

    function selectViewTrend(select){
        if(select==1){
            $('#allpost').fadeOut(function(){
                $('#allpost').load('/posts/trend-day');
            });
            $('#allpost').fadeIn();
        }else if(select==2){
            $('#allpost').fadeOut(function(){
                $('#allpost').load('/posts/trend-7day');
            });
            $('#allpost').fadeIn();
        }else if(select==3){
            $('#allpost').fadeOut(function(){
                $('#allpost').load('/posts/trend-month');
            });
            $('#allpost').fadeIn();
        }else if(select==4){
            $('#allpost').fadeOut(function(){
                $('#allpost').load('/posts/trend-year');
            });
            $('#allpost').fadeIn();
        }
    }
</script>

<!-- test -->
<script>
    $(document).ready(function(){
            time_lastNoti=new Date($.now());
            
            console.log(time_lastNoti);
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: '/checknewNoti',
                type: 'POST',
                data: {'time_lastNoti': time_lastNoti
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                }
            }); 
        
    });
    
</script>
