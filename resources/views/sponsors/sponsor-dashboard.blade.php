<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Sponsor Dashboard') }}
                </h2>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-3" style="text-align: right">
                Wallet: {{auth()->user()->wallet}} $
            </div>
        </div>

    </x-slot>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="py-12">
        <h2 style="text-align: center">Add Price</h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route('add.wallet')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="py-4 text-center form-control">Value</label>
                        <input type="number" class="form-control mb-2"  name="value_pay">
                        @error('value_pay')
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success form-control">Pay</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="py-12">
        <h2 style="text-align: center">My orphan </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Start Warranty Date</th>
                            <th scope="col">Warranty Value</th>
                            <th scope="col">Warranty Period</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1?>
                        @foreach($myOrphans as $orphan)

                            <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$orphan->name}}</td>
                            <td><img src="{{asset('admin/img'.$orphan->image)}}" alt=""></td>
                            <td>{{$orphan->pivot->start_warranty_date}}</td>
                            <td>{{$orphan->pivot->warranty_value}}</td>
                            <td>{{$orphan->pivot->warranty_period}}</td>
                                <td><a href="{{route('remove.orphan',$orphan->id)}}" class="btn btn-danger" >Delete</a></td>
                        </tr>
                        @endforeach


                        </tbody>
                    </table>
            </div>
        </div>

    </div>
    <div class="py-12">
        <h2 style="text-align: center">Add orphan </h2>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="{{route('add.orphan')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="py-4 text-center form-control">Orphan</label>
                        <select name="orphan_id" id="" class="form-control">
                            <option value=""></option>
                            @foreach($orphans as $orphan)
                                <option value="{{$orphan->id}}">{{$orphan->name}}</option>
                            @endforeach
                        </select>
                        @error('orphan_id')
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="py-4 text-center form-control">Warranty Value</label>
                        <input type="number" class="form-control mb-2"  name="warranty_value">
                        @error('warranty_value')
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="" class="py-4 text-center form-control">Warranty Period</label>
                        <input type="number" class="form-control mb-2"  name="warranty_period">
                        @error('warranty_period')
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success form-control">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
