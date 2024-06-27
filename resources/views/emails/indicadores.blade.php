<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Indicadores Generados</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .chart-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .chart-description {
            margin-top: 10px;
            font-weight: bold;
        }
        .green {
            color: green;
        }
        .red {
            color: red;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #888;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('img/Logo-Quas.png')) }}" alt="Logo">
        </div>
        <h1>{{ $subjectTitle }}</h1>
        <p>Adjuntos a este correo encontrarás los gráficos de los indicadores generados.</p>
        <div>
            @foreach ($images as $chart)
                <div class="chart-container">
                    <img src="{{ $message->embed($chart['path']) }}" alt="{{ $chart['title'] }}">
                    <p class="chart-description">{{ $chart['title'] }} - {{ $chart['description'] }}: 
                        @if ($chart['data'] >= 100)
                            <span class="green">{{ $chart['data'] }}%</span>
                        @else
                            <span class="red">{{ $chart['data'] }}%</span>
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
        <div class="footer">
            <p>Quas-Factory</p>
            <p><a href="https://www.quas.cl">www.quas.cl</a></p>
        </div>
    </div>
</body>
</html>
