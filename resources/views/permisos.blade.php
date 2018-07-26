<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            $(function() {
                $(".check").change(function(){
                    console.log("MAD");
                    $.ajax({
                        url: $('#_url').val() + "/updatePermiso",
                        data: {
                            id_permiso: $(this).data('id_permiso'),
                            id_rol: $(this).data('id_rol'),
                            enable: $(this).prop('checked'),
                            _token: $("[name=_token]").val()
                        },
                        method: 'POST'
                    });
                });
            });
        </script>
        <style>
            .elem {
                width: 9%;
                display: inline-block;
                height: 50px;
            }

            .first {
                width: 20%;
                max-width: 20%;
                margin-left:20px;
            }

            .theader .first {
                margin-left: 0px !important;
            }

            .theader {
                position: fixed;
                top:0;
                width: 100%;
                background:black;
                color: white;
            }
            .tbody {
                margin-top:50px;
            }

        </style>
    </head>
    <body>
        <input type="hidden" id="_url" value="{{url('/')}}">
        {{csrf_field()}}
        <div class="table"> 
            <div class="theader">
                <div class="row">
                <div class="elem first"></div>
                @foreach($roles as $index=>$rol)
                    <div class="elem">{{ $rol->nombre }}</div>
                @endforeach
            </div>
                </div>
            <div class="tbody">
                @foreach($permisos as $route)
                    <div class="row">
                        <div class="elem first">{{$route->ruta}}</div>
                        @foreach($roles as $rol)
                                <div class="elem">
                                    <input class="check" type="checkbox" data-id_permiso="{{$route->id}}" data-id_rol="{{$rol->id}}" {{$rol->permisos->contains($route->id) ? 'checked' : ''}}>
                                </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            
        </table>
    </body>
</html>