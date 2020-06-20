<table class="table table-data2">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên người dùng</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Trạng thái</th>
            <th>Tác vụ</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($users=App\User::orderBy('created_at','desc')->paginate(20) as $user)
        <tr class="tr-shadow" id="user{{$user->id}}">

            <td>{{$user->id}}</td>
            <td>
                <span class="block-email">{{$user->firstName}}</span>
            </td>
            <td class="desc">
                <div>
                    {{$user->gender}}
                </div>
            </td>
            <td>{{$user->doB}}</td>
            
            <td id="wrap_stt{{$user->id}}">
                <div id="stt{{$user->id}}">
                @if($user->status==0)
                <span class="status--process">Hoạt động</span>
                @else
                <span class="status--denied">Bị Chặn</span>
                @endif
                </div>
            </td>
            <td>
                <div class="table-data-feature">
                <button onclick="blockUser({{$user->id}})" class="item" data-toggle="tooltip" data-placement="top" title="Chặn người dùng">
                    <i class="fa fa-ban"></i>
                </button>
                <button onclick="deleteUser({{$user->id}})" class="item" data-toggle="tooltip" data-placement="top" title="Xóa người dùng">
                    <i class="zmdi zmdi-delete"></i>
                </button>
                </div>
            </td>
            
        </tr>
        <tr class="spacer" id="spacer{{$user->id}}"></tr>
        @endforeach

    </tbody>
</table>