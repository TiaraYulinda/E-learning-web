<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.1/jquery.min.js"></script>

    <title>Hello, world!</title>

    <style type="text/css">
        .box{
            width: 600px;
            margin:0 auto;
            border: 1px solid #ccc;
        }
    </style>
  </head>
  <body>
        <br>
        <div class="container box">
            <div class="form-group">
                <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state">
                    @foreach ($country_list as $country)
                        <option value="{{ $country->country}}">{{ $country->country}}</option>
                    @endforeach
                </select>
            </div>
            <br/>
            <div class="form-group">
                <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="city">
                    <option value="">Select State</option>
                </select>
            </div>
            <br/>
            <div class="form-group">
                <select name="city" id="city" class="form-control input-lg dynamic">
                    <option value="">Select city</option>
                </select>
            </div>
            {{ csrf_field() }}
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.dynamic').change(function(){
                    if($(this).val() != '')
                    {
                        var select = $(this).attr("id");
                        var value = $(this).val();
                        var dependent = $(this).data('dependent');
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url: "{{ route('dynamicdependent.fetch') }}",
                            method: "POST",
                            data: { select:select, value:value, _token:_token, dependent:dependent },
                            success:function(result)
                            {
                                $('#'+dependent).html(result);
                            }
                        })
                    }
                });
                // $('#semester').change(function(){
                //     $('#matkul').val('');
                });
            });
        </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>