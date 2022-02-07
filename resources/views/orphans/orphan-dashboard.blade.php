<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-md-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Orphan Dashboard') }}
                </h2>
            </div>
            <div class="col-md-6"></div>
            <div class="col-md-3" style="text-align: right">
               Wallet: {{auth()->user()->wallet}} $
            </div>
        </div>

    </x-slot>

    <div class="py-12">
        <h2 style="text-align: center">My Sponsor </h2>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1?>
                    @foreach($mySponsors as $orphan)

                        <tr>
                            <th scope="row">{{$i++}}</th>
                            <td>{{$orphan->name}}</td>
                            <td><img src="{{asset('admin/img'.$orphan->image)}}" alt=""></td>
                            <td>{{$orphan->pivot->start_warranty_date}}</td>
                            <td>{{$orphan->pivot->warranty_value}}</td>
                            <td>{{$orphan->pivot->warranty_period}}</td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
