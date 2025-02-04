<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<h1>Payment Info & Invoice</h1>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
<table>
    @if(isset($payment) && isset($payment['amount_type']))
        @foreach($payment['amount_type'] as $key => $value)
            @if($application->charges == $payment['basic_total'])
                @if($payment['basic'][$key] == 'yes') 
                <tr>
                    <th>{{$payment['amount_type'][$key] ?? ''}}</th>
                    <th>{{$payment['amount'][$key] ?? ''}}</th>

                </tr>
                @endif
            @else
                @if($payment['advance'][$key] == 'yes') 
                    <tr>
                        <th>{{$payment['amount_type'][$key] ?? ''}}</th>
                        <th>{{$payment['amount'][$key] ?? ''}}</th>

                    </tr>
                @endif
            @endif
          
        @endforeach
    @endif
    <tr>
        <th></th>
        <td>
            @if($application->charges == $payment['basic_total'])
            {{$payment['basic_total']}}
            @elseif($application->charges == $payment['advance_total'])
            {{$payment['advance_total']}}

            @endif

        </td>
    </tr>
</table>
</body>
</html>