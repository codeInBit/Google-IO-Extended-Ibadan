<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Adcash') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{--{{ config('app.name', 'Adcash') }}--}}
                    Google I/O
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><strong>Add New Order</strong></div>

                    <div class="panel-body">

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/createOrder') }}">
                            {{ csrf_field() }}

                            @if(Auth::user()->isAdmin())
                                <div class="form-group{{ $errors->has('madeBy') ? ' has-error' : '' }}">
                                    <label for="madeBy" class="col-md-4 control-label">User</label>
                                    <div class="col-md-6">
                                        <select name="madeBy" id="madeBy" class="form-control">
                                            @foreach($users as $user)
                                                <option value="{{ $user->name }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group{{ $errors->has('product') ? ' has-error' : '' }}">
                                <label for="product" class="col-md-4 control-label">Product</label>
                                <div class="col-md-6">
                                    <select name="product" id="product" class="form-control">
                                        @foreach($products as $product)
                                            <option value="{{ $product->productType }}">{{ $product->productType }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
                                <label for="quantity" class="col-md-4 control-label">Quantity</label>

                                <div class="col-md-6">
                                    <input id="quantity" type="number" class="form-control" name="quantity" min="1" required autofocus>

                                    @if ($errors->has('quantity'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('quantity') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Order
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--<div class="row">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-body">--}}
                        {{--<form class="form" role="form" method="POST" action="{{ url('/searchOrder') }}">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-4">--}}
                                    {{--<div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">--}}
                                        {{--<label for="search" class="control-label">Search</label>--}}
                                        {{--<div class="">--}}
                                            {{--<select name="search" id="search" class="form-control">--}}
                                                {{--<option value="all">All time</option>--}}
                                                {{--<option value="seven">Last 7 days</option>--}}
                                                {{--<option value="today">Today</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-5">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="searchTerm" class="control-label"> &nbsp;</label>--}}
                                        {{--<div class="">--}}
                                            {{--<input id="searchTerm" type="text" class="form-control" name="searchTerm" placeholder="Enter search term..." autofocus>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-md-3">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label for="quantity" class="control-label"> &nbsp;</label>--}}
                                        {{--<div class="">--}}
                                            {{--<button type="submit" class="btn btn-primary">--}}
                                                {{--Search--}}
                                            {{--</button>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">

                            @if (session('update'))
                                <div class="alert alert-success">
                                    {{ session('update') }}
                                </div>
                            @endif
                            @if (session('delete'))
                                <div class="alert alert-danger">
                                    {{ session('delete') }}
                                </div>
                            @endif

                            <table class="table table-bordered table-striped table-hover" id="table">
                                <thead>
                                <tr>
                                    <th>S|N</th>
                                    @if(Auth::user()->isAdmin())
                                        <th>User</th>
                                    @endif
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th colspan="2">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1 ?>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        @if(Auth::user()->isAdmin())
                                            <td>{{ $order->madeBy }}</td>
                                        @endif
                                        <td>{{ $order->product }}</td>
                                        <td>@if($order->product == "Pepsi Cola") 1.60EUR
                                            @elseif($order->product == "Coca Cola") 1.80EUR
                                            @endif
                                        </td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>@if(($order->product == "Pepsi Cola") && ($order->quantity >= 3)) {{ (1.60 *$order->quantity) - (0.2 * 1.60 * $order->quantity) }} EUR
                                            @elseif(($order->product == "Pepsi Cola") && ($order->quantity < 3)){{ 1.60* $order->quantity  }} EUR
                                            @elseif(($order->product ==  "Pepsi Cola") && ($order->quantity < 3)){{ 1.60* $order->quantity  }} EUR
                                            @elseif($order->product == "Coca Cola") {{ 1.80* $order->quantity  }} EUR
                                            @endif
                                        </td>
                                        <td>{{ date('d M Y, h:mA', strtotime ($order->created_at)) }}</td>
                                        <td>
                                            <button class="btn btn-success" data-toggle="modal" data-placement="right" title="Edit this order" data-target="#editModal" onclick="editOrder('{{$order -> id}}')"><i class="fa fa-pencil"></i></button>
                                        </td>
                                        <td>
                                            <a href="{{ url('/delete') }}/{{ $order->id }}" class="btn btn-danger"  data-toggle="tooltip" data-placement="right" title="Delete this order" onclick="return confirm('Do you really want to delete this order?')"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('/view')}}">
                        </div>
                        <h5 class="text-center">{{ $orders->links() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal start -->
    <div class="modal fade" id="editModal" role="dialog" aria-labelledby="editModalLabel">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    <h5 class="modal-title text-center"><strong>Edit Order</strong></h5>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="modal-body">
                            <form action="{{ url('/update') }}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    @if(Auth::user()->isAdmin())
                                        <div class="form-group">
                                            <label for="madeBy">User</label>
                                            <select name="madeBy" id="madeBy" class="form-control">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="product">Product</label>
                                        <select name="product" id="product" class="form-control">
                                            @foreach($products as $product)
                                                <option value="{{ $product->productType }}">{{ $product->productType }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="edit_quantity">Quantity</label>
                                        <input type="number" class="form-control" id="edit_quantity" name="quantity" min="1" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                                <input type="hidden" id="edit_id" name="edit_id">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit code ends -->

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script>
    var $rows = $('#table tr');
    $('#searchTerm').keyup(function() {
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

        $rows.show().filter(function() {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });

    function editOrder(id)
    {
        var view_url = $("#hidden_view").val();
        $.ajax({
            url: view_url,
            type:"GET",
            data: {"id":id},
            success: function(result){
                console.log(result);
                $("#edit_id").val(result.id);
                $("#edit_quantity").val(result.quantity);
            }
        });
    }
</script>
</body>
</html>

