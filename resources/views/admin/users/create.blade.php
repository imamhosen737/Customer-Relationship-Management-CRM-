<form action="{{ route('users.store') }}" method="post">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value=" " placeholder="Name">
            @if($errors->has('name'))
                <div style="color: red; font-weight:bold">{{ $errors->first('name') }}</div>
            @endif
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value=" " placeholder="Email">
            @if($errors->has('email'))
                <div style="color: red; font-weight:bold">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password"  placeholder="Password">
             @if($errors->has('password'))
                <div style="color: red; font-weight:bold">{{ $errors->first('password') }}</div>
            @endif
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="status">Status</label><br>
            <select id="status" class="custom-select" name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

         <div class="form-group col-md-6">
            <label for="dpt_id">Department Name</label><br>
            <select id="dpt_id"  class="custom-select" name="department_id">
                @foreach($departments as $department)
                  <option value=" {{$department->id}} ">{{$department->name}}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <select id="role" class="custom-select" hidden name="role">
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
            </select>
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md-12">
            <input type="submit" class="btn btn-block btn-primary" value="Submit">
        </div>
    </div>

</form>
