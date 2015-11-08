@extends('app')

@section('content')
    <div class="panel panel-warning">
        <div class="panel-heading">География визитов за последнюю неделю</div>
            <div class="panel-body" id="mapBody">
                <div id="mapdiv" style="width: 900px; height: 600px;"></div>
            </div>
        </div>
		<div class="panel panel-default">
			<div class="panel-heading">Home</div>

			<div class="panel-body">
				You are logged in!
			</div>
	</div>
@endsection
@section('scripts')
    @parent
    <script>
        var w = window.innerWidth;
        changeWidth(w);
        setInterval(function(){
            newW=window.innerWidth;
            if(newW!=w) {
                w=newW;
                changeWidth(w);
            }
        }, 2);
        function changeWidth(w) {
            if (w < 768) {
                wR = w * 0.85;
            }
            else {
                wR = w * 0.45;
            }
            hR = wR / 1.5;
            $('#mapdiv').css('width', wR).css('height', hR);
        }
    </script>
    <script>
        AmCharts.ready(function() {
            // create AmMap object
            var map = new AmCharts.AmMap();
            // set path to images
            map.pathToImages = "/ammap/images/";

            /* create data provider object
             map property is usually the same as the name of the map file.

             getAreasFromMap indicates that amMap should read all the areas available
             in the map data and treat them as they are included in your data provider.
             in case you don't set it to true, all the areas except listed in data
             provider will be treated as unlisted.
             */
            var dataProvider = {
                map: "worldLow",
                areas:[
                    @foreach($locations->countries as $one)
                    {id:"{{$one}}"},
                    @endforeach
                ],
                images:[
                    @foreach($locations->cities as $city)
                    {latitude:{{$city['lat']}},
                        longitude:{{$city['lon']}},
                        type:"circle", color:"#6c00ff",
                        scale:{{$locations->cityCounts[$city['id']]*0.01+0.5}},

                        labelShiftY:2,
                        title:"{{$city['name_ru']}}",
                        description:"Количество уникальных пользователей: {{$locations->cityCounts[$city['id']]}}"},
                    @endforeach
                ]
            };
            // pass data provider to the map object
            map.dataProvider = dataProvider;

            /* create areas settings
             * autoZoom set to true means that the map will zoom-in when clicked on the area
             * selectedColor indicates color of the clicked area.
             */
            map.areasSettings = {
                autoZoom: true,
                selectedColor: "#CC0000"
            };

            // let's say we want a small map to be displayed, so let's create it
            map.smallMap = new AmCharts.SmallMap();

            // write the map to container div
            map.write("mapdiv");
        });
    </script>
@stop
