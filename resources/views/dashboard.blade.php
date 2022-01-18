@extends('layouts.app')
@section('page_title')
<span>Dashboard</span>
@endsection
@section('content')
<form action="" method="get">

    <h2 class="text-center mt-5">Normal Input Field</h2>

    <div class="form-group">
        <label for="name">name</label>
        <input id="name" type="text" class="form-control" name="name" value="" placeholder="First name">
    </div>
    


    <h2 class="text-center mt-5">Double Input Field</h2>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value=" " placeholder="Email">
        </div>
        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value=" " placeholder="Password">
        </div>
    </div>



    <h2 class="text-center mt-5">Triple Input Field</h2>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="name">Email</label>
            <input type="text" class="form-control" name="name" id="name" value="" placeholder="Name">
        </div>
        <div class="form-group col-md-4">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="" placeholder="Email">
        </div>
        <div class="form-group col-md-4">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password">
        </div>
    </div>



    <h2 class="text-center mt-5">Normal Textarea</h2>

    <div class="form-group">
        <label for="desc">Bio / Description</label>
        <textarea id="desc" class="form-control" name="desc" value="" placeholder="Bio / description"></textarea>
    </div>



    <h2 class="text-center mt-5">CK Editor Textarea</h2>

    <div class="form-group">
        <label for="desc">Ck Editor</label>
        <textarea id="desc" class="form-control ckEditor" name="desc" value="" placeholder="Ck Editor"></textarea>
    </div>



    <h2 class="text-center mt-5">Radio Button</h2>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="role" id="Radios1" value="option1" checked>
        <label class="form-check-label" for="Radios1">
            Default radio
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="role" id="Radios2" value="option2">
        <label class="form-check-label" for="Radios2">
            Second default radio
        </label>
    </div>



    <h2 class="text-center mt-5">Dropdown Input Field</h2>

    <div class="form-group">
        <label for="country">Country</label><br>
        <select id="country" class="custom-select" name="country">
            <option value="usa">United States</option>
            <option value="usa">Bangladesh</option>
        </select>
    </div>

<h2 class="text-center mt-5">Datalist Input Field</h2>

    <div class="form-group">
        <input type="text" list="item" value="" class="custom-select">
        <datalist id="item">
            <option value="apple">Apple</option>
            <option value="banana">Banana</option>
            <option value="orange">Orange</option>
        </datalist>
    </div>

    <h2 class="text-center mt-5">Toogle Button</h2>

    <div class="form-group">
        <label for="subscribe">Toggle Button</label><br>
        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
            <input checked="" type="checkbox" id="subscribe" class="custom-control-input" name="subscribe">
            <label class="custom-control-label" for="subscribe">Yes</label>
        </div>
        <label for="subscribe" class="mb-0">Yes</label>
    </div>



    <h2 class="text-center mt-5">Check Box</h2>

    <div class="form-group">
        <label for="checkbox">Check Buttons </label>
        <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="done" id="checkbox" checked="">
            <label class="custom-control-label" for="checkbox">Yes</label>
        </div>
    </div>



    <h2 class="text-center mt-5">File Input</h2>

    <div class="form-group">
        <label for="customFile">Photo</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" name="file" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
    </div>



    <h2 class="text-center mt-5">Normal Submit Button</h2>

    <input type="submit" class="btn btn-primary" value="Submit">



    <h2 class="text-center mt-5">Middle Submit Button</h2>

    <div class="form-group text-center">
    <input type="submit" class="btn btn-primary" value="Submit">
    </div>



    <h2 class="text-center mt-5">Block Submit Button</h2>

    <input type="submit" class="btn btn-block btn-primary" value="Submit">




</form>





<h1 class="text-center mt-5">Table</h1>


{{-- Table starts from here --}}
<div class="container wrapper">
    <table class="table table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="col-md-2">Name</th>
                <th class="col-md-2">Position</th>
                <th class="col-md-2">Office</th>
                <th class="col-md-2">Age</th>
                <th class="col-md-2">Start date</th>
                <th class="col-md-2">Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Airi Satou</td>
                <td class="highlight">Super</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>

        </tbody>
    </table>
</div>
{{-- Table ends here --}}
@endsection