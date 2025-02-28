<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de Mantenimiento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            margin: 0;
            text-align: center;
            
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .header .workshop-info {
            text-align: right;
        }
        .header .workshop-info h2 {
            margin: 0;
            font-size: 18px;
        }
        .header .workshop-info p {
            margin: 0;
            font-size: 14px;
        }
        .header .date {
            text-align: center;
            flex-grow: 1;
        }
        .header .date p {
            margin: 0;
            font-size: 14px;
        }
        .details, .items {
            margin-bottom: 20px;
        }
        .details table, .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .details table td, .items table th, .items table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .items table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ env('APP_LOGO_URL') }}" alt="Logo">
            </div>
            <div class="date">
                <p>Fecha: {{ date('d/m/Y') }}</p>
            </div>
            <div class="workshop-info">
                <h2>Taller Mecánico XYZ</h2>
                <p>Dirección: Calle Falsa 123</p>
                <p>Teléfono: 555-1234</p>
                <p>Email: taller@ejemplo.com</p>
            </div>
        </div>
        <div class="details">
            <h2>Detalles del Cliente</h2>
            <table>
                <tr>
                    <td>Nombre:</td>
                    <td>{{ $mantenimiento->cliente->name }}</td>
                </tr>
                <tr>
                    <td>Dirección:</td>
                    <td>{{ $mantenimiento->cliente->address }}</td>
                </tr>
                <tr>
                    <td>Teléfono:</td>
                    <td>{{ $mantenimiento->cliente->phone }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $mantenimiento->cliente->email }}</td>
                </tr>
            </table>
        </div>
        <div class="items">
            <h2>Detalles del Mantenimiento</h2>
            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mantenimiento->servicios as $servicio)
                    <tr>
                        <td>{{ $servicio->name }}</td>
                        <td>1</td>
                        <td>{{ $servicio->price }}</td>
                        <td>{{ $servicio->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            <h2>Total: {{ $mantenimiento->servicios->sum('price') }}</h2>
        </div>
        <div class="footer">
            <p>Gracias por su preferencia.</p>
        </div>
    </div>
</body>
</html>